<?php
use traderec\TradeRecDAO;
$lasttrs = TradeRecDAO::GetTradeRecs();
$listnumb = 0;
?>
<div id="tr_list">
    <h2>Trade Recommendations</h2>    
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Contract</th>
                <th>Entry Choice</th>
                <th>Entry Price</th>
                <th>Price Target</th>
                <th>Stop Loss</th>
                <th>Date</th>
                <th>Time</th>
            </tr>
        </thead>
        <?php
        foreach ($lasttrs as $k=>$tr){
            $listnumb++;?>
            <tr>
                <td data-title=''><?php echo $listnumb ?></td>
                <td data-title='Futures Name'><?php echo $tr->futures_name ?></td>
                <td data-title='Entry Choice'><?php echo $tr->entry_choice ?></td>
                <td data-title='Entry Price'><?php echo $tr->entry_price ?></td>
                <td data-title='Price Target'><?php echo $tr->price_target ?></td>
                <td data-title='Stop Loss'><?php echo $tr->stop_loss ?></td>
                <td data-title='Date'><?php echo $tr->date ?></td>
                <td data-title='Time'><?php echo $tr->time ?></td>
            </tr>
        <?php        
        }
        ?>
    </table>
</div>