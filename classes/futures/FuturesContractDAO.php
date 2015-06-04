<?php
namespace futures;
use PDO,utils\Conn;
class FuturesContractDAO {
    public static function GetFutures(){
        $db= Conn::GetConnection();
        try{
            $res = $db->prepare("SELECT id_futures,fk_strategy,futures_name,description,dec_places,strategy_name,futures_cont.status "
                . "FROM futures_cont "
                . "LEFT JOIN strategy ON id_strategy=fk_strategy "
                . "WHERE futures_cont.status = 1");
            $res->execute();
            $futures = $res->fetchAll(PDO::FETCH_CLASS, "futures\FuturesContract");
            return $futures;//!!!have to check if array exists
        }catch(PDOException $e){
            echo "error". $e->getMessage();
        }
    }
    public static function GetFuturesById($futures_id){
        $db= Conn::GetConnection();
        try{
            $res = $db->prepare("SELECT id_futures,fk_strategy,futures_name,description,dec_places,strategy_name "
                . "FROM futures_cont "
                . "LEFT JOIN strategy ON id_strategy=fk_strategy "
                . "WHERE id_futures=:futures_id LIMIT 1");
            $res->bindParam(':futures_id',$futures_id);
            $res->execute();
            $futures = $res->fetchObject("futures\FuturesContract");;
            return $futures;//!!!have to check if array exists
        }catch(PDOException $e){
            echo "error". $e->getMessage();
        }
    }
    public static function GetFuturesNames(){
        $db= Conn::GetConnection();
        try{
            $res = $db->prepare("SELECT  id_futures, futures_name FROM futures_cont");
            $res->execute();
            $futures = $res->fetchAll(PDO::FETCH_ASSOC);
            return $futures;//!!!have to check if array exists
        }catch(PDOException $e){
            echo "error". $e->getMessage();
        }
    }
    public static function NewFutures($future){
        $db= Conn::GetConnection();            
        try{
            $res = $db->prepare("INSERT INTO futures_cont "
                . "(id_futures,futures_name,fk_strategy,description,dec_places) "
                . "VALUES ('',:futures_name,:fk_strategy,:description,:dec_places)");
            $res->bindParam(':futures_name',$future['futures_name']);
            $res->bindParam(':fk_strategy',$future['futures_prog']);
            $res->bindParam(':description',$future['futures_desc']);
            $res->bindParam(':dec_places',$future['futures_dec']);
            $res->execute();
        }catch(PDOException $e){
            echo "error". $e->getMessage();
        }
    }
    public static function UpdateFutures($future){
        $db= Conn::GetConnection();            
        try{
            $res = $db->prepare("UPDATE futures_cont "
                . "SET futures_name=:futures_name, "
                . "fk_strategy=:fk_strategy, "
                . "description=:description, "
                . "dec_places=:dec_places "
                . "WHERE id_futures=:id_futures");
            $res->bindParam(':id_futures',$future['id_futures']);
            $res->bindParam(':futures_name',$future['futures_name']);
            $res->bindParam(':fk_strategy',$future['futures_prog']);
            $res->bindParam(':description',$future['futures_desc']);
            $res->bindParam(':dec_places',$future['futures_dec']);
            $res->execute();
        }catch(PDOException $e){
            echo "error". $e->getMessage();
        }
    }
    public static function RemoveFutures($future){
        $db= Conn::GetConnection();            
        try{
            $res = $db->prepare("UPDATE futures_cont "
                . "SET status=0 "
                . "WHERE id_futures=:id_futures");
            $res->bindParam(':id_futures',$future['id_futures']);
            $res->execute();
        }catch(PDOException $e){
            echo "error". $e->getMessage();
        }
    }
}
