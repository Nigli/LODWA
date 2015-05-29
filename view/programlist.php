<?php
use program\ProgramDAO;
$prog = ProgramDAO::GetProgram();
$listnumb =0;
?>
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
            </tr>
        <?php        
        }
        ?>
    </table>
    <form>
        <div id="bottom">
            <div id="bottom-left">
                <button id="change" type="button" value="change">Change</button>
                <button id="update" type="submit" value="update">Update</button>
            </div>
        </div>
    </form>
</div>
<script>
    $("#change").on("click",function(){
        $(this).hide();
        $("#update").show();
    });
</script>