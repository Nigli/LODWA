<?php
require 'config.php';
use program\Program, program\ProgramDAO;
$prog = ProgramDAO::GetProgram();
var_dump($prog);
