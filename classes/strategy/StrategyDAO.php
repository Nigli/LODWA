<?php
namespace strategy;
use PDO,utils\Conn;
class StrategyDAO {
    public static function GetStrategies(){
        $db= Conn::GetConnection();
        try{
            $res = $db->prepare("SELECT id_strategy, strategy_name, GROUP_CONCAT(futures_name ORDER BY futures_name ASC SEPARATOR ',') AS futures_name "
                    . "FROM strategy "
                    . "LEFT JOIN futures_cont ON id_strategy=fk_strategy "
                    . "WHERE strategy.status = 1 "
                    . "GROUP BY strategy_name");
            $res->execute();
            $tr = $res->fetchAll(PDO::FETCH_CLASS, "strategy\Strategy");
            return $tr;//!!!have to check if array exists
        }catch(PDOException $e){
            echo "error". $e->getMessage();
        }
    }
    public static function Newstrategy($strategy){
        $db= Conn::GetConnection();            
        try{
            $res = $db->prepare("INSERT INTO strategy "
                . "(id_strategy,strategy_name) "
                . "VALUES ('',:strategy_name)");
            $res->bindParam(':strategy_name',$strategy['strategy_name']);
            $res->execute();
        }catch(PDOException $e){
            echo "error". $e->getMessage();
        }
    }
    public static function Updatestrategy($strategy){
        $db= Conn::GetConnection();            
        try{
            $res = $db->prepare("UPDATE strategy "
                . "SET strategy_name=:strategy_name "
                . "WHERE id_strategy=:id_strategy");
            $res->bindParam(':id_strategy',$strategy['id_strategy']);
            $res->bindParam(':strategy_name',$strategy['strategy_name']);
            $res->execute();
        }catch(PDOException $e){
            echo "error". $e->getMessage();
        }
    }
    public static function RemoveStrategy($strategy){
        $db= Conn::GetConnection();            
        try{
            $res = $db->prepare("UPDATE strategy "
                . "SET status=0 "
                . "WHERE id_strategy=:id_strategy");
            $res->bindParam(':id_strategy',$strategy['id_strategy']);
            $res->execute();
        }catch(PDOException $e){
            echo "error". $e->getMessage();
        }
    }
}