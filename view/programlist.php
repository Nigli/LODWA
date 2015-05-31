<?php
use program\ProgramDAO,futures\FuturesContractDAO;
$prog = ProgramDAO::GetProgram();
$future = FuturesContractDAO::GetFutures();
?>
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
            <button form="left" id="reset-left" class="reset" type="reset" value="reset">Clear</button>
            <button form="left" id="delete-left" class="delete" type="submit" value="delete">Delete</button>
            <button form="left" id="update-left" class="update" type="submit" value="update">Update</button>
            <button form="left" id="new-left" type="submit" value="new">New</button>
        </div>
        <div id="bottom-right">
            <button form="right" id="reset-right" class="reset" type="reset" value="reset">Clear</button>
            <button form="right" id="delete-right" class="delete" type="submit" value="delete">Delete</button>
            <button form="right" id="update-right" class="update" type="submit" value="update">Update</button>
            <button form="right" id="new-right" type="submit" value="new">New</button>
        </div>
    </div>
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
                <td data-title='Futures Program Name' class="td_hidden"><?php echo $fut->tr_program_name ?></td>
            </tr>
        <?php
        }
        ?>
    </table>    
</div>
<div id="program_list">
    <h2>Trading Programs</h2>
    <table>
        <thead>
            <tr>
                <th></th>
                <th>#</th>
                <th>Program Name</th>
                <th>Futures Contracts</th>
            </tr>
        </thead>
        <?php
        $listnumb =0;
        foreach ($prog as $k=>$program){
            $listnumb++;?>
            <tr>
                <td data-title=''><?php echo $listnumb ?></td>
                <td data-title='Program Name'><?php echo $program->tr_program_name ?></td>
                <td data-title='Futures Contracts'>
                    <?php
                    for($i=0;$i<count($program->futures_name);$i++){
                        echo $program->futures_name[$i].($i!=count($program->futures_name)-1?", ":"");
                    }
                    ?>
                </td>
                <td data-title='Id Program' class="td_hidden"><?php echo $program->id_tr_program ?></td>
            </tr>
        <?php
        }
        ?>
    </table>    
</div>
<script>
    $("#futures_list tbody tr").on("click", function () {
        $rec = {futures_name:$(this).find("[data-title='Futures Name']").html(),
                futures_description:$(this).find("[data-title='Futures Description']").html(),
                id_futures:$(this).find("[data-title='Id Futures']").html(),
                futures_dec:$(this).find("[data-title='Futures Decimal Places']").html(),
                futures_prog:$(this).find("[data-title='Futures Program Name']").html()
                };
        $.each($rec, function(key, value){
            $("#"+key).val(value);
            $("#futures_desc").html($rec.futures_description);
        });
        $("#futures_list tbody tr").removeClass("activetr");
        $(this).addClass("activetr");
        $("html, body").animate({ scrollTop: 0 }, 600);        
        $("#update-left").show();
            $("#delete-left").show();
            $("#reset-left").show();
            $("#new-left").hide();
        });    
    $("#reset-left").on("click",function(){
        $(this).hide();
        $("#update-left").hide();
        $("#delete-left").hide();
        $("#new-left").show();
        $("#id_program").val("");
        $("#futures_desc").html("");
    });
    $("#program_list tbody tr").on("click", function () {
        $rec = {program_name:$(this).find("[data-title='Program Name']").html(),                
                id_program:$(this).find("[data-title='Id Program']").html()
                };
        $.each($rec, function(key, value){
            $("#"+key).val(value);
        });
        $("#program_list tbody tr").removeClass("activetr");
        $(this).addClass("activetr");
        $("html, body").animate({ scrollTop: 0 }, 600);        
        $("#update-right").show();
            $("#delete-right").show();
            $("#reset-right").show();
            $("#new-right").hide();
        });    
    $("#reset-right").on("click",function(){
        $(this).hide();
        $("#update-right").hide();
        $("#delete-right").hide();
        $("#new-right").show();
        $("#id_futures").val("");
    });
</script>