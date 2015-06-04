<?php
if(isset($_GET['f'])){
    require_once '../config.php';
    echo "Selected strategy: ".utils\Session::get("cont".$_GET['f']);    

}else {
    echo "Selected strategy: ".$lastTR->strategy_name;
}