<?php

use strategy\StrategyDAO,
    receiver\ReceiverDao;

/*
 * for each futures selected get strategie(s) connected with that futures
 * in hidden input put strategy value and post that value with form
 * if there is no future associated with any strategy value is 0 and form
 * can not be submited
 */
if (isset($_GET['f'])) {/* * GET['f'] PARAMETER IS SET IN js/layout.js FILE* *///1
    //selection by clicking
    require_once '../config.php';
    $strategies = StrategyDAO::getStrategiesByFutureId($_GET['f']);

    //if there are strategies from seleced futures id
    if ($strategies) {

        //if there is only one strategy
        if (count($strategies) == 1) {
            $receivers = ReceiverDao::getReceiversByStrat($strategies[0]->id_strategy);
            //if subscribers under that one strategy
            if ($receivers) {
                echo "Selected strategy: <input type='hidden' id='strategy_id' name='fk_strategy' value='" . $strategies[0]->id_strategy . "'/>" . $strategies[0]->strategy_name;
            }
            //if no subscribers under that on one strategy
            else {
                echo "Selected strategy doesn't have any subscribers!<input type='hidden' id='strategy_id' name='fk_strategy' value='0'/>";
            }
        }
        //if more then one strategies then select option
        else {
            echo "Select one of the strategies: ";
            ?>
            <select id='id_strategy' name='fk_strategy'>
                <?php
                foreach ($strategies as $strategy) {
                    //getting subscribers to those strategies, if no subscribers that strategy wont be shown
                    $receivers = ReceiverDao::getReceiversByStrat($strategy->id_strategy);
                    if ($receivers) {
                        ?>
                        <option value="<?php echo $strategy->id_strategy ?>"><?php echo $strategy->strategy_name ?></option>                    
                        <?php
                    }
                }
                ?>
            </select>
            <?php
        }
    }
    //if there are no strategies associated with selected futures
    else {
        echo "Selected strategy is not active!<input type='hidden' id='strategy_id' name='fk_strategy' value='0'/>";
    }
}
//initial selection of last TR
//getting subscribers to those strategies, if no subscribers, form can not be submited
else {
    $receivers = $this->lastTR ? ReceiverDao::getReceiversByStrat($this->lastTR->id_strategy) : null;
    $strategies = $this->lastTR ? StrategyDAO::getStrategiesByFutureId($this->lastTR->fk_future) : null;
    if ($strategies && $receivers) {
        echo "Selected strategy: <input type='hidden' id='strategy_id' name='fk_strategy' value='" . $this->lastTR->id_strategy . "'/>" . $this->lastTR->strategy_name;
    } elseif (!$strategies) {
        echo "Selected strategy is not active!<input type='hidden' id='strategy_id' name='fk_strategy' value='0'/>";
    } else {
        echo "Selected strategy dosn't have any subscribers!<input type='hidden' id='strategy_id' name='fk_strategy' value='0'/>";
    }
}