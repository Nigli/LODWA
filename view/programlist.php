<?php
use program\ProgramDAO,futures\FuturesContractDAO,utils\Session;
$prog = ProgramDAO::GetProgram();
$future = FuturesContractDAO::GetFutures();
$user = Session::get('user_status');
$user=='3'?include 'admin/programlist.php':'';
?>
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
                <td data-title='Futures Program Id' class="td_hidden"><?php echo $fut->fk_tr_program ?></td>
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