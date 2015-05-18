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
                        echo $program->futures_name[$i]."<br>";
                    }
                    ?>
                </td>
            </tr>
        <?php        
        }
        ?>
    </table>    
</div>