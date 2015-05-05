<?php

class NaInfoDAO {
    public static function GetNaInfo(){
        $db= Conn::GetConnection();
        $res = $db->prepare("SELECT * FROM na_info");
        $res->execute();
        $na_info = $res->fetch(PDO::FETCH_ASSOC);       
        return $na_info;
    }
}
