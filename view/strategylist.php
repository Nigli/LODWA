<div id="strategy_list">
    <h2>Trading Strategies</h2>
    <table>
        <thead>
            <tr>
                <th></th>
                <th>#</th>
                <th>Strategy Name</th>
                <th>Futures Contracts</th>
            </tr>
        </thead>
        <?php
        $listnumb =0;
        foreach ($prog as $k=>$strategy){
            $listnumb++;?>
            <tr>
                <td data-title=''><?php echo $listnumb ?></td>
                <td data-title='Strategy Name'><?php echo $strategy->strategy_name ?></td>
                <td data-title='Futures Contracts'>
                    <?php
                    for($i=0;$i<count($strategy->futures_name);$i++){
                        echo $strategy->futures_name[$i].($i!=count($strategy->futures_name)-1?", ":"");
                    }
                    ?>
                </td>
                <td data-title='Id Strategy' class="td_hidden"><?php echo $strategy->id_strategy ?></td>
            </tr>
        <?php
        }
        ?>
    </table>    
</div>
<div id="futures_list">
    <h2>Futures</h2>
    <table>
        <thead>
            <tr>
                <th></th>
                <th>#</th>
                <th>Futures Name</th>
                <th>Futures Description</th>
            </tr>
        </thead>
        <?php        
        $listnumb =0;
        foreach ($future as $k=>$fut){
            $listnumb++;?>
            <tr>
                <td data-title=''><?php echo $listnumb ?></td>
                <td data-title='Futures Name'><?php echo $fut->futures_name ?></td>
                <td data-title='Futures Description'><?php echo $fut->description ?></td>
                <td data-title='Id Futures' class="td_hidden"><?php echo $fut->id_futures ?></td>
                <td data-title='Futures Decimal Places' class="td_hidden"><?php echo $fut->dec_places ?></td>
                <td data-title='Futures Strategy Id' class="td_hidden"><?php echo $fut->fk_strategy ?></td>
                <td data-title='Futures Strategy Name' class="td_hidden"><?php echo $fut->strategy_name ?></td>
            </tr>
        <?php
        }
        ?>
    </table>    
</div>