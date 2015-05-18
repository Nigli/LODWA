<?php
if(isset($_GET['f'])){
    require_once '../config.php';
    echo "Selected program: ".utils\Session::get("cont".$_GET['f']);    

}else {
    echo "Selected program: ".$lastTR->tr_program_name;
}
