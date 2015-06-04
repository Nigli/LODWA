<script src="js/strategy.js" type="text/javascript"></script>
<div id="strategy_list_form" class="edit">
    <div id="top">
        <h2>Edit or add New</h2>
        <span id="rightspan">To edit future or strategy click on the table row</span><br>
    </div>
    <form id="left" method="post" action="process/process_futures.php">
        <h3>Futures</h3>    
        <input id="id_futures" type="hidden" name="id_futures" value=""/>
        <label for="futures_name">Futures Name and Number of Decimal Places</label><br>
        <input id="futures_name" name="futures_name" type="text" value="" required=""/>        
        <input id="futures_dec" name="futures_dec" type="number" required=""/><br>
        <label for="futures_desc">Write Description for Future</label><br>
        <textarea id="futures_desc" name="futures_desc" required=""></textarea><br>
        <label for="fk_strategy">Assign to Trading Strategy</label><br>
        <select id="fk_strategy" name="futures_prog"><?php foreach ($prog as $k=>$strategy){echo "<option value='".$strategy->id_strategy."'>".$strategy->strategy_name."</option>"; }?></select><br>        
    </form>
    <form id="right" method="post" action="process/process_strategy.php">
        <h3>Strategy</h3>     
        <input id="id_strategy" type="hidden" name="id_strategy" value=""/>
        <label for="strategy_name">Strategy Name</label><br>
        <input id="strategy_name" name="strategy_name" type="text" value="" required=""/>
    </form>
    <div id="bottom">
        <div id="bottom-left">
            <button form="left" id="reset-left" class="reset" name="futures-submit" type="reset" value="reset">Clear</button>
            <button form="left" id="delete-left" class="delete" name="futures-submit" type="submit" value="delete">Delete</button>
            <button form="left" id="update-left" class="update" name="futures-submit" type="submit" value="update">Update</button>
            <button form="left" id="new-left" type="submit" name="futures-submit" value="new">New</button>
        </div>
        <div id="bottom-right">
            <button form="right" id="reset-right" name="strategy-submit" class="reset" type="reset" value="reset">Clear</button>
            <button form="right" id="delete-right" name="strategy-submit" class="delete" type="submit" value="delete">Delete</button>
            <button form="right" id="update-right" name="strategy-submit" class="update" type="submit" value="update">Update</button>
            <button form="right" id="new-right" name="strategy-submit" type="submit" value="new">New</button>
        </div>
    </div>
</div>