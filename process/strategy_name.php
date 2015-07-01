<?php
if(isset($_GET['f'])){/**GET PARAMETER IS SET ON js/tr.js FILE**/
    require_once '../config.php';
    echo "Selected strategy: ".utils\Session::get("cont".$_GET['f']);    

}else {
    echo "Selected strategy: ".$lastTR->strategy_name;
}