<?php

use strategy\StrategyDAO;

if (isset($_GET['f'])) {/* * GET PARAMETER IS SET ON js/tr.js FILE* */
    require_once '../config.php';

    $strategies = StrategyDAO::getStrategiesByFutureId($_GET['f']);
    if ($strategies) {
        if (count($strategies) == 1) {
            echo "Selected strategy: " . $strategies[0]->strategy_name;
        } else {
            echo "Select one of the strategies: ";
            ?>
            <select id='id_strategy' name='id_strategy'>
                <?php
                foreach ($strategies as $stategy) {
                    ?>
                    <option value="<?php echo $stategy->id_strategy ?>"><?php echo $stategy->strategy_name ?></option>
                    <?php
                }
                ?>
            </select>
            <?php
        }
    } else {
        echo "Selected strategy is not active!<input type='hidden' id='strategy_id' name='id_strategy' value='0'/>";
    }
} else {
    echo "Selected strategy: " . $lastTR->strategy_name;
}