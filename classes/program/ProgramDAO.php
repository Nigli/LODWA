<?php
namespace program;
use PDO,utils\Conn;
class ProgramDAO {
    public static function GetProgram(){
        $db= Conn::GetConnection();
        try{
            $res = $db->prepare("SELECT id_tr_program, tr_program_name, GROUP_CONCAT(futures_name ORDER BY futures_name ASC SEPARATOR ',') AS futures_name "
                    . "FROM trade_program "
                    . "LEFT JOIN futures_cont ON id_tr_program=fk_tr_program "
                    . "WHERE trade_program.status = 1 "
                    . "GROUP BY tr_program_name");
            $res->execute();
            $tr = $res->fetchAll(PDO::FETCH_CLASS, "program\Program");
            return $tr;//!!!have to check if array exists
        }catch(PDOException $e){
            echo "error". $e->getMessage();
        }
    }
    public static function NewProgram($program){
        $db= Conn::GetConnection();            
        try{
            $res = $db->prepare("INSERT INTO trade_program "
                . "(id_tr_program,tr_program_name) "
                . "VALUES ('',:tr_program_name)");
            $res->bindParam(':tr_program_name',$program['program_name']);
            $res->execute();
        }catch(PDOException $e){
            echo "error". $e->getMessage();
        }
    }
    public static function UpdateProgram($program){
        $db= Conn::GetConnection();            
        try{
            $res = $db->prepare("UPDATE trade_program "
                . "SET tr_program_name=:tr_program_name "
                . "WHERE id_tr_program=:id_tr_program");
            $res->bindParam(':id_tr_program',$program['id_program']);
            $res->bindParam(':tr_program_name',$program['program_name']);
            $res->execute();
        }catch(PDOException $e){
            echo "error". $e->getMessage();
        }
    }
    public static function RemoveProgram($program){
        $db= Conn::GetConnection();            
        try{
            $res = $db->prepare("UPDATE trade_program "
                . "SET status=0 "
                . "WHERE id_tr_program=:id_tr_program");
            $res->bindParam(':id_tr_program',$program['id_program']);
            $res->execute();
        }catch(PDOException $e){
            echo "error". $e->getMessage();
        }
    }
}