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
                echo "Selected strategy: <input type='hidden' id='fk_strategy' data-trstart='" . $strategies[0]->start_time . "' data-trend='" . $strategies[0]->end_time . "' data-cxrstart='" . $strategies[0]->cxr_start_time . "' data-cxrend='" . $strategies[0]->cxr_end_time . "' data-trnum='" . $strategies[0]->num_tr_day_status . "' name='fk_strategy' value='" . $strategies[0]->id_strategy . "'/>" . $strategies[0]->strategy_name;
            }
            //if no subscribers under that on one strategy
            else {
                echo "Selected strategy doesn't have any subscribers!<input type='hidden' id='fk_strategy' name='fk_strategy' value='0'/>";
            }
        }
        //if more then one strategies then select option
        else {
            foreach ($strategies as $strategy) {
                $all_strategies_receivers[] = ReceiverDAO::getReceiversByStrat($strategy->id_strategy);
            }

            //if none of the strategies has receivers
            if (count($all_strategies_receivers) == 0) {
                echo "Selected strategy doesn't have any subscribers!<input type='hidden' id='fk_strategy' name='fk_strategy' value='0'/>";
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
                echo "Selected strategy: <input type='hidden' id='fk_strategy' data-trstart='" . $strategy->start_time . "' data-trend='" . $strategy->end_time . "' data-cxrstart='" . $strategy->cxr_start_time . "' data-cxrend='" . $strategy->cxr_end_time . "' data-trnum='" . $strategy->num_tr_day_status . "' name='fk_strategy' value='" . $strategy->id_strategy . "'/>" . $strategy->strategy_name;
            }

            //if more strategies has receivers  
            else {
                echo "Select one of the strategies: ";
                ?>
                <select id='fk_strategy' name='fk_strategy'>
                    <?php
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
                            ?>
                            <option data-trstart="<?php echo $strategy->start_time ?>" data-trend="<?php echo $strategy->end_time ?>" data-cxrstart="<?php echo $strategy->cxr_start_time ?>" data-cxrend="<?php echo $strategy->cxr_end_time ?>" data-trnum="<?php echo $strategy->num_tr_day_status ?>" value="<?php echo $strategy->id_strategy ?>" <?php echo (isset($_GET['s']) && $_GET['s'] == $strategy->id_strategy) ? "selected" : "" ?>><?php echo $strategy->strategy_name ?></option>                    
                            <?php
                        }
                    }
                    ?>
                </select>
                <?php
            }
        }
    }

    //if there are no strategies associated with selected futures
    else {
        echo "Selected strategy is not active!<input type='hidden' id='fk_strategy' name='fk_strategy' value='0'/>";
    }
}
//initial selection of last TR
//getting subscribers to those strategies, if no subscribers, form can not be submited
else {
    date_default_timezone_set(Enum::CHICAGO_TIME);
    $date = new \DateTime();
    $now_date = $date->format("Y-m-d");
    $now_time = $date->format("H:i");
//    $receivers = $this->lastTR ? ReceiverDAO::getReceiversByStrat($this->lastTR->id_strategy) : null;
    $strategies = $this->lastTR ? StrategyDAO::getStrategiesByFutureId($this->lastTR->fk_future) : null;
//    $trs = TradeRecDAO::getTradeRecDateByStratId($this->lastTR->id_strategy);
//    $same_date = array();
//    foreach ($strategies as $strategy) {
//        foreach ($trs as $tr) {
//            if ($now_date == $tr->date) {
//                $same_date[] = $tr->date;
//            }
//        }
//        $number_of_trs_today = count($same_date);
//        if ($number_of_trs_today >= $strategy->num_tr_day && $strategy->num_tr_day != -1) {
//            $num_tr_day_status = 1;
//        } else {
//            $num_tr_day_status = 0;
//        }
//    }
//    if ($strategies && $receivers) {
//        foreach ($strategies as $strategy) {
//            $all_strategies_receivers[] = ReceiverDAO::getReceiversByStrat($strategy->id_strategy);
//        }
//        
//        echo "Selected strategy: <input type='hidden' id='fk_strategy' name='fk_strategy' data-trstart='" . $strategies[0]->start_time . "' data-trend='" . $strategies[0]->end_time . "' data-cxrstart='" . $strategies[0]->cxr_start_time . "' data-cxrend='" . $strategies[0]->cxr_end_time . "'  data-trnum='" . $num_tr_day_status . "'  value='" . $this->lastTR->id_strategy . "'/>" . $this->lastTR->strategy_name;
//    } elseif (!$strategies) {
//        echo "Selected strategy is not active!<input type='hidden' id='fk_strategy' name='fk_strategy' value='0'/>";
//    } else {
//        echo "Selected strategy dosn't have any subscribers!<input type='hidden' id='fk_strategy' name='fk_strategy' value='0'/>";
//    }
    
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
           echo "Selected strategy: <input type='hidden' id='fk_strategy' data-trstart='" . $strategies[0]->start_time . "' data-trend='" . $strategies[0]->end_time . "' data-cxrstart='" . $strategies[0]->cxr_start_time . "' data-cxrend='" . $strategies[0]->cxr_end_time . "' data-trnum='" . $strategies[0]->num_tr_day_status . "' name='fk_strategy' value='" . $strategies[0]->id_strategy . "'/>" . $strategies[0]->strategy_name;
       }
       //if no subscribers under that on one strategy
       else {
           echo "Selected strategy doesn't have any subscribers!<input type='hidden' id='fk_strategy' name='fk_strategy' value='0'/>";
       }
   }
   //if more then one strategies then select option
   else {
       foreach ($strategies as $strategy) {
           $all_strategies_receivers[] = ReceiverDAO::getReceiversByStrat($strategy->id_strategy);
       }

       //if none of the strategies has receivers
       if (count($all_strategies_receivers) == 0) {
           echo "Selected strategy doesn't have any subscribers!<input type='hidden' id='fk_strategy' name='fk_strategy' value='0'/>";
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
           echo "Selected strategy: <input type='hidden' id='fk_strategy' data-trstart='" . $strategy->start_time . "' data-trend='" . $strategy->end_time . "' data-cxrstart='" . $strategy->cxr_start_time . "' data-cxrend='" . $strategy->cxr_end_time . "' data-trnum='" . $strategy->num_tr_day_status . "' name='fk_strategy' value='" . $strategy->id_strategy . "'/>" . $strategy->strategy_name;
       }

       //if more strategies has receivers  
       else {
           echo "Select one of the strategies: ";
           ?>
           <select id='fk_strategy' name='fk_strategy'>
               <?php
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
                       ?>
                       <option data-trstart="<?php echo $strategy->start_time ?>" data-trend="<?php echo $strategy->end_time ?>" data-cxrstart="<?php echo $strategy->cxr_start_time ?>" data-cxrend="<?php echo $strategy->cxr_end_time ?>" data-trnum="<?php echo $strategy->num_tr_day_status ?>" value="<?php echo $strategy->id_strategy ?>" <?php echo (isset($this->lastTR->id_strategy) && $this->lastTR->id_strategy == $strategy->id_strategy) ? "selected" : "" ?>><?php echo $strategy->strategy_name ?></option>                    
                       <?php
                   }
               }
               ?>
           </select>
           <?php
       }
   }
}