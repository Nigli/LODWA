<?php
use futures\FuturesContractDAO,utils\Session;

$user = Session::get('user_status');/**GETS USER STATUS**/
$notice_future = Session::get("future");/**GETS NOTICE(creates notice var to use it in notification popup) FROM SESSION WITH INFO OF FUTURE SUCCESS**/
Session::unsets('future');

$future = FuturesContractDAO::getActiveFutures();/**GET FUTURES OBJECTS**/
$user=='3'?include 'admin/futureslist.php':'';/**CHECK IF USER IS ADMIN**/