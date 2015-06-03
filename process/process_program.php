<?php
require '../config.php';
use program\ProgramDAO,utils\Validate;
$valid = Validate::admin($_POST);
if($valid['program-submit']==="update"){
    ProgramDAO::UpdateProgram($valid);
}elseif($valid['program-submit']==="delete"){
    ProgramDAO::RemoveProgram($valid);
}else{
    ProgramDAO::NewProgram($valid);
}
