<?php
namespace program;
use PDO,utils\Conn;
class ProgramDAO {
    public static function GetProgram(){
        $db= Conn::GetConnection();
        $res = $db->prepare("SELECT id_tr_program, tr_program_name, GROUP_CONCAT(futures_name ORDER BY futures_name ASC SEPARATOR ',') AS futures_name "
                . "FROM trade_program "
                . "LEFT JOIN futures_cont ON id_tr_program=fk_tr_program "
                . "GROUP BY tr_program_name");
        $res->execute();
        $tr = $res->fetchAll(PDO::FETCH_CLASS, "program\Program");
        return $tr;//!!!have to check if array exists
    }
}