<?php $this->user_status == \utils\Enum::MANAGER_LEV1 ? include $this->strategy_form : ''; ?>
<div id="strategy_list">
    <h2>Trading Strategies</h2>
    <table>
        <thead>
            <tr>
                <th></th>
                <th></th>
                <th>Strategy</th>
                <th>Futures Contracts</th>
                <th>#TR/day</th>
                <th>Start TR</th>                
                <th>End TR</th>                
                <th>Start CXR</th>                
                <th>End CXR</th>
            </tr>
        </thead>
        <?php
        if ($this->strategies) {
            foreach ($this->strategies as $k => $strategy) {
                $this->index_numb++;
                ?>
                <tr>
                    <td class="strategy_info"><i class="fa fa-info"></i></td>
                    <td data-title='Strategy Name' data-index="strategy_name" class="td_hidden"><?php echo $strategy->strategy_name ?></td>                    
                    <td data-title='Strategy Symbol' data-index="strategy_symbol"><?php echo $strategy->strategy_symbol?></td>
                    <td data-title='Futures Contracts'>
                        <?php
                        $futures_list = "";
                        foreach ($strategy->futures_info as $future_id => $future_name) {
                            $futures_list .= count($strategy->futures_info) > 1 ? $future_name . ", " : $future_name . "";
                        }
                        $futures_list = rtrim($futures_list, ", ");
                        echo $futures_list;
                        ?>
                    </td>
                    <?php
                    foreach ($strategy->futures_info as $future_id => $future_name) {
                        ?>                        
                        <td data-index="futures_id<?php echo $future_id ?>" class="td_hidden"><?php echo $future_id ?></td>  
                        <?php
                    }
                    ?>   
                    <td data-index="id_strategy" class="td_hidden"><?php echo $strategy->id_strategy ?></td>  
                    <td data-title='Auto TR' data-index="auto_tr" class="td_hidden"><?php echo $strategy->auto_tr?$strategy->auto_tr:"no" ?></td>   
                    <td data-title='Num Contracts' data-index="num_contracts" class="td_hidden"><?php echo $strategy->num_contracts ?></td>                        
                    <td data-title='Num Futures' data-index="num_futures" class="td_hidden"><?php echo $strategy->num_futures ?></td>                          
                    <td data-title='Num Subscribers' data-index="num_receivers" class="td_hidden"><?php echo $strategy->num_receivers ?></td>  
                    <td data-title='Num TR/Day' data-index="num_tr_day"><?php echo ($strategy->num_tr_day != -1)? $strategy->num_tr_day : "unlimited" ?></td>  
                    <td data-title='Start Time' data-index="start_time"><?php echo $strategy->start_time ?></td>  
                    <td data-title='End Time' data-index="end_time"><?php echo $strategy->end_time ?></td>  
                    <td data-title='CXR Start Time' data-index="cxr_start_time"><?php echo $strategy->cxr_start_time ?></td>  
                    <td data-title='CXR End Time' data-index="cxr_end_time"><?php echo $strategy->cxr_end_time ?></td>  
                </tr>
                <?php
            }
        } else {
            ?>
            <tr><td>No Trading Strategies in Database</td></tr>
            <?php
        }
        ?>
    </table>    
</div>