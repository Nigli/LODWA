<div id="strategy_list">
    <h2>Trading Strategies</h2>
    <table>
        <thead>
            <tr>
                <th colspan="2">#</th>
                <th>Strategy Name</th>
                <th>Futures Contracts</th>
            </tr>
        </thead>
        <?php
        if($strategies){
            $listnumb =0;
            foreach ($strategies as $k=>$strategy){
                $listnumb++;?>
                <tr>
                    <td data-title=''><?php echo $listnumb ?></td>
                    <td data-title='Strategy Name' data-index="strategy_name"><?php echo $strategy->strategy_name ?></td>
                    <td data-title='Futures Contracts'>
                        <?php
                        $futures_list = "";
                        foreach($strategy->futures_info as $future_id=>$future_name){
                            $futures_list .= count($strategy->futures_info)>1?$future_name.", ":$future_name."";                     
                        }
                        $futures_list =rtrim($futures_list,", ");
                        echo $futures_list;
                        ?>
                    </td>
                    <?php
                    foreach($strategy->futures_info as $future_id=>$future_name){
                    ?>                        
                        <td data-index="futures_id<?php echo $future_id ?>" class="td_hidden"><?php echo $future_id ?></td>  
                    <?php
                    }
                    ?>   
                    <td data-index="id_strategy" class="td_hidden"><?php echo $strategy->id_strategy ?></td>       
                </tr>
            <?php
            }
        }else {            
        ?>
            <tr><td>No Trading Strategies in Database</td></tr>
        <?php
        }
        ?>
    </table>    
</div>