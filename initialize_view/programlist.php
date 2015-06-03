<?php
use program\ProgramDAO,futures\FuturesContractDAO,utils\Session;
$prog = ProgramDAO::GetProgram();
$future = FuturesContractDAO::GetFutures();
$user = Session::get('user_status');
$user=='3'?include 'admin/programlist.php':'';