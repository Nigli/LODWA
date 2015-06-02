<script src="js/program.js" type="text/javascript"></script>
<div id="program_list_form" class="edit">
    <div id="top">
        <h2>Edit or add New</h2>
        <span id="rightspan">To edit future or program click on the table row</span><br>
    </div>
    <form id="left" method="post" action="process/process_program.php">
        <h3>Futures</h3>    
        <input id="id_futures" type="hidden" name="id_futures" value=""/>
        <label for="futures_name">Futures Name and Number of Decimal Places</label><br>
        <input id="futures_name" name="futures_name" type="text" value="" required=""/>        
        <input id="futures_dec" name="futures_des" type="number" required=""/><br>
        <label for="futures_desc">Write Description for Future</label><br>
        <textarea id="futures_desc" name="futures_desc" required=""></textarea><br>
        <label for="futures_prog">Assign to Trading Strategy</label><br>
        <select id="futures_prog" name="futures_prog"><?php foreach ($prog as $k=>$program){echo "<option>".$program->tr_program_name."</option>"; }?></select><br>        
    </form>
    <form id="right" method="post" action="process/process_program.php">
        <h3>Program</h3>     
        <input id="id_program" type="hidden" name="id_program" value=""/>
        <label for="program_name">Program Name</label><br>
        <input id="program_name" name="program_name" type="text" value="" required=""/>
    </form>
    <div id="bottom">
        <div id="bottom-left">
            <button form="left" id="reset-left" class="reset" name="submit" type="reset" value="reset">Clear</button>
            <button form="left" id="delete-left" class="delete" name="submit" type="submit" value="delete">Delete</button>
            <button form="left" id="update-left" class="update" name="submit" type="submit" value="update">Update</button>
            <button form="left" id="new-left" type="submit" name="submit" value="new">New</button>
        </div>
        <div id="bottom-right">
            <button form="right" id="reset-right" name="submit" class="reset" type="reset" value="reset">Clear</button>
            <button form="right" id="delete-right" name="submit" class="delete" type="submit" value="delete">Delete</button>
            <button form="right" id="update-right" name="submit" class="update" type="submit" value="update">Update</button>
            <button form="right" id="new-right" name="submit" type="submit" value="new">New</button>
        </div>
    </div>
</div>