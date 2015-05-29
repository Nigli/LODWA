<?php

var_dump($_POST);

foreach ($_POST as $key=>$value) {
    if(is_numeric($key)){
        echo $_POST[$key];
    }
}