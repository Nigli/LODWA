<?php

use strategy\StrategyDAO,
    receiver\ReceiverDAO,
    traderec\TradeRecDAO,
    utils\Enum;

/*
 * for each futures selected get strategie(s) connected with that futures
 * in hidden input put strategy value and post that value with form
 * if there is no future associated with any strategy value is 0 and form
 * can not be submited
 */

    
if (isset($_GET['f'])) {/* * GET['f'] PARAMETER IS SET IN js/layout.js FILE* *///
    //selection by clicking
    require_once '../config.php';
    date_default_timezone_set(Enum::CHICAGO_TIME);
    $date = new \DateTime();
    $now_date = $date->format("Y-m-d");
    $now_time = $date->format("H:i");
    $strategies = StrategyDAO::getStrategiesByFutureId($_GET['f']);
    if(isset($_GET['s'])) {
        $strategy_init = StrategyDAO::getStrategyById($_GET['s']);
    }
    //if there are strategies from seleced futures id
    if ($strategies) {

        //if there is only one strategy
        if (count($strategies) == 1) {
            $receivers = ReceiverDAO::getReceiversByStrat($strategies[0]->id_strategy);
            $trs = TradeRecDAO::getTradeRecDateByStratId($strategies[0]->id_strategy);
            $same_date = array();
            foreach ($trs as $tr) {
                if ($now_date == $tr->date) {
                    $same_date[] = $tr->date;
                }
            }
            $number_of_trs_today = count($same_date);
            if ($number_of_trs_today >= $strategies[0]->num_tr_day && $strategies[0]->num_tr_day != -1) {
                $strategies[0]->num_tr_day_status = 1;
            } else {
                $strategies[0]->num_tr_day_status = 0;
            }
            //if subscribers under that one strategy
            if ($receivers) {
                $responce['text'] = "Selected strategy: <input type='hidden' id='fk_strategy' name='fk_strategy' value='" . $strategies[0]->id_strategy . "'/>" . $strategies[0]->strategy_name;
                $responce['autotr'] = $strategies[0]->auto_tr;
                $responce['num_contracts'] = $strategies[0]->num_contracts;
                $responce['trstart']= $strategies[0]->start_time;           
                $responce['trend']= $strategies[0]->end_time;       
                $responce['cxrstart']= $strategies[0]->cxr_start_time;
                $responce['cxrend']= $strategies[0]->cxr_end_time;
                $responce['trnum']= $strategies[0]->cxr_end_time;
                $responce['trnum']= $strategies[0]->num_tr_day_status;      
            }
            //if no subscribers under that on one strategy
            else {
                $responce['text'] = "Selected strategy doesn't have any subscribers!<input type='hidden' id='fk_strategy' name='fk_strategy' value='0'/>";
            }
        }
        //if more then one strategies then select option
        else {
            foreach ($strategies as $strategy) {
                $all_strategies_receivers[] = ReceiverDAO::getReceiversByStrat($strategy->id_strategy);
            }

            //if none of the strategies has receivers
            if (count($all_strategies_receivers) == 0) {
                $responce['text'] = "Selected strategy doesn't have any subscribers!<input type='hidden' id='fk_strategy' name='fk_strategy' value='0'/>";
            }

            //if only one strategy has receivers 
            elseif (count(array_filter($all_strategies_receivers)) == 1) {
                $strategy = StrategyDAO::getStrategyById($all_strategies_receivers[0][0]->fk_strategy);

                $trs = TradeRecDAO::getTradeRecDateByStratId($strategy->id_strategy);
                $same_date = array();
                foreach ($trs as $tr) {
                    if ($now_date == $tr->date) {
                        $same_date = $tr->date;
                    }
                }
                $number_of_trs_today = count($same_date);
                if ($number_of_trs_today >= $strategy->num_tr_day && $strategy->num_tr_day != -1) {
                    $strategy->num_tr_day_status = 1;
                } else {
                    $strategy->num_tr_day_status = 0;
                }
                $responce['text']   = "Selected strategy: <input type='hidden' id='fk_strategy' value='" . $strategy->id_strategy . "'/>" . $strategy->strategy_name;
                $responce['autotr'] = $strategy->auto_tr;
                $responce['num_contracts'] = $strategy->num_contracts;
                $responce['trstart']= $strategy->start_time;           
                $responce['trend']  = $strategy->end_time;       
                $responce['cxrstart']= $strategy->cxr_start_time;
                $responce['cxrend'] = $strategy->cxr_end_time;
                $responce['trnum']  = $strategy->cxr_end_time;
                $responce['trnum']  = $strategy->num_tr_day_status;
            }

            //if more strategies has receivers  
            else {
                $responce['text'] = "Select one of the strategies: ";
                $responce['text'] .= "<select id='fk_strategy' name='fk_strategy'>";
                    foreach ($strategies as $strategy) {

                        //getting subscribers to those strategies, if no subscribers that strategy won't be shown
                        $receivers = ReceiverDAO::getReceiversByStrat($strategy->id_strategy);
                        $trs = TradeRecDAO::getTradeRecDateByStratId($strategy->id_strategy);
                        $same_date = array();
                        foreach ($trs as $tr) {
                            if ($now_date == $tr->date) {
                                $same_date[] = $tr->date;
                            }
                        }
                        $number_of_trs_today = count($same_date);
                        if ($number_of_trs_today >= $strategy->num_tr_day && $strategy->num_tr_day != -1) {
                            $strategy->num_tr_day_status = 1;
                        } else {
                            $strategy->num_tr_day_status = 0;
                        }
                        if ($receivers) {
                            $selected = (isset($_GET['s']) && $_GET['s'] == $strategy->id_strategy) ? "selected" : "";
                        
                            $responce['text'] .= "<option value='".$strategy->id_strategy."'".$selected.">".$strategy->strategy_name."</option>";                    
                            
                            $responce['data'][$strategy->id_strategy]['autotr'] = $strategy->auto_tr;
                            $responce['data'][$strategy->id_strategy]['num_contracts'] = $strategy->num_contracts;
                            $responce['data'][$strategy->id_strategy]['trstart']= $strategy->start_time;           
                            $responce['data'][$strategy->id_strategy]['trend']  = $strategy->end_time;       
                            $responce['data'][$strategy->id_strategy]['cxrstart']= $strategy->cxr_start_time;
                            $responce['data'][$strategy->id_strategy]['cxrend'] = $strategy->cxr_end_time;
                            $responce['data'][$strategy->id_strategy]['trnum']  = $strategy->cxr_end_time;
                            $responce['data'][$strategy->id_strategy]['trnum']  = $strategy->num_tr_day_status;
                        }
                    }
                $responce['text'] .= "</select>";
            }            
        }
    }

    //if there are no strategies associated with selected futures
    else {
        $responce['text'] = "Selected strategy is not active!<input type='hidden' id='fk_strategy' name='fk_strategy' value='0'/>";
    }
}
//initial selection of last TR
//getting subscribers to those strategies, if no subscribers, form can not be submited
else {
    require_once '../config.php';
    date_default_timezone_set(Enum::CHICAGO_TIME);
    $date = new \DateTime();
    $now_date = $date->format("Y-m-d");
    $now_time = $date->format("H:i");
    $lastTR = TradeRecDAO::getLast5TradeRecs()[0];
    $strategies = $lastTR ? StrategyDAO::getStrategiesByFutureId($lastTR->fk_future) : null;
   
//if there is only one strategy
   if (count($strategies) == 1) {
       $receivers = ReceiverDAO::getReceiversByStrat($strategies[0]->id_strategy);
       $trs = TradeRecDAO::getTradeRecDateByStratId($strategies[0]->id_strategy);
       $same_date = array();
       foreach ($trs as $tr) {
           if ($now_date == $tr->date) {
               $same_date[] = $tr->date;
           }
       }
       $number_of_trs_today = count($same_date);
       if ($number_of_trs_today >= $strategies[0]->num_tr_day && $strategies[0]->num_tr_day != -1) {
           $strategies[0]->num_tr_day_status = 1;
       } else {
           $strategies[0]->num_tr_day_status = 0;
       }
       //if subscribers under that one strategy
       if ($receivers) {
           $responce['text'] = "Selected strategy: <input type='hidden' id='fk_strategy' value='" . $strategies[0]->id_strategy . "'/>" . $strategies[0]->strategy_name;
           $responce['autotr'] = $strategies[0]->auto_tr;
           $responce['num_contracts'] = $strategies[0]->num_contracts;
           $responce['trstart']= $strategies[0]->start_time;           
           $responce['trend']= $strategies[0]->end_time;       
           $responce['cxrstart']= $strategies[0]->cxr_start_time;
           $responce['cxrend']= $strategies[0]->cxr_end_time;
           $responce['trnum']= $strategies[0]->cxr_end_time;
           $responce['trnum']= $strategies[0]->num_tr_day_status;
           
       }
       //if no subscribers under that on one strategy
       else {
           $responce['text'] = "Selected strategy doesn't have any subscribers!<input type='hidden' id='fk_strategy' name='fk_strategy' value='0'/>";
       }
   }
   //if more then one strategies then select option
   else {
       foreach ($strategies as $strategy) {
           $all_strategies_receivers[] = ReceiverDAO::getReceiversByStrat($strategy->id_strategy);
       }

       //if none of the strategies has receivers
       if (count($all_strategies_receivers) == 0) {
           $responce['text'] = "Selected strategy doesn't have any subscribers!<input type='hidden' id='fk_strategy' name='fk_strategy' value='0'/>";
       }

       //if only one strategy has receivers 
       elseif (count(array_filter($all_strategies_receivers)) == 1) {
           $strategy = StrategyDAO::getStrategyById($all_strategies_receivers[0][0]->fk_strategy);

           $trs = TradeRecDAO::getTradeRecDateByStratId($strategy->id_strategy);
           $same_date = array();
           foreach ($trs as $tr) {
               if ($now_date == $tr->date) {
                   $same_date = $tr->date;
               }
           }
           $number_of_trs_today = count($same_date);
           if ($number_of_trs_today >= $strategy->num_tr_day && $strategy->num_tr_day != -1) {
               $strategy->num_tr_day_status = 1;
           } else {
               $strategy->num_tr_day_status = 0;
            }
            $responce['text']   =  "Selected strategy: <input type='hidden' id='fk_strategy' name='fk_strategy' value='" . $strategy->id_strategy . "'/>" . $strategy->strategy_name;
            $responce['autotr'] = $strategy->auto_tr;
            $responce['num_contracts'] = $strategy->num_contracts;
            $responce['trstart']= $strategy->start_time;           
            $responce['trend']  = $strategy->end_time;       
            $responce['cxrstart']= $strategy->cxr_start_time;
            $responce['cxrend'] = $strategy->cxr_end_time;
            $responce['trnum']  = $strategy->cxr_end_time;
            $responce['trnum']  = $strategy->num_tr_day_status;
           
        }

       //if more strategies has receivers  
        else {
            $responce['data'] = null;
            $responce['text'] = "Select one of the strategies: ";
            $responce['text'] .= "<select id='fk_strategy' name='fk_strategy'>";
                foreach ($strategies as $strategy) {

                    //getting subscribers to those strategies, if no subscribers that strategy won't be shown
                    $receivers = ReceiverDAO::getReceiversByStrat($strategy->id_strategy);
                    $trs = TradeRecDAO::getTradeRecDateByStratId($strategy->id_strategy);
                    $same_date = array();
                    foreach ($trs as $tr) {
                        if ($now_date == $tr->date) {
                            $same_date[] = $tr->date;
                        }
                    }
                    $number_of_trs_today = count($same_date);
                    if ($number_of_trs_today >= $strategy->num_tr_day && $strategy->num_tr_day != -1) {
                        $strategy->num_tr_day_status = 1;
                    } else {
                        $strategy->num_tr_day_status = 0;
                    }
                    if ($receivers) {
                        $selected = (isset($_GET['s']) && $_GET['s'] == $strategy->id_strategy) ? "selected" : ""; 
                        $responce['text'] .= "<option value='".$strategy->id_strategy."'".$selected.">".$strategy->strategy_name."</option>";                    
                        
                        $responce['data'][$strategy->id_strategy]['autotr'] = $strategy->auto_tr;
                        $responce['data'][$strategy->id_strategy]['num_contracts'] = $strategy->num_contracts;
                        $responce['data'][$strategy->id_strategy]['trstart']= $strategy->start_time;           
                        $responce['data'][$strategy->id_strategy]['trend']  = $strategy->end_time;       
                        $responce['data'][$strategy->id_strategy]['cxrstart']= $strategy->cxr_start_time;
                        $responce['data'][$strategy->id_strategy]['cxrend'] = $strategy->cxr_end_time;
                        $responce['data'][$strategy->id_strategy]['trnum']  = $strategy->cxr_end_time;
                        $responce['data'][$strategy->id_strategy]['trnum']  = $strategy->num_tr_day_status;
                    }
                }
            $responce['text'] .= "</select>";
            
        }  
    }
}

echo json_encode($responce);