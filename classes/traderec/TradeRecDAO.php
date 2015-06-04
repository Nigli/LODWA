<?php
namespace traderec;
use PDO,utils\Conn;
class TradeRecDAO {
    public static function GetTradeRecs(){
        $db= Conn::GetConnection();
        $res = $db->prepare("SELECT id_tr,fk_tr_type,fk_future,futures_name,month,year,num_contr,id_strategy,strategy_name,description,entry_choice,duration, "
                . "REPLACE(FORMAT(entry_price, dec_places),',','') AS entry_price,REPLACE(FORMAT(price_target,dec_places),',','') AS price_target,REPLACE(FORMAT(stop_loss,dec_places),',','') AS stop_loss,"
                . "date, time "
                . "FROM trade_rec "
                . "LEFT JOIN futures_cont ON fk_future=id_futures "
                . "LEFT JOIN strategy ON fk_strategy=id_strategy "
                . "ORDER BY id_tr DESC");
        $res->execute();
        $tr = $res->fetchAll(PDO::FETCH_CLASS, "traderec\TradeRec");
        return $tr;//!!!have to check if array exists
    }
    public static function GetLast5TradeRecs(){
        $db= Conn::GetConnection();
        $res = $db->prepare("SELECT id_tr,fk_tr_type,fk_future,futures_name,month,year,num_contr,id_strategy,strategy_name,description,entry_choice,duration, "
                . "REPLACE(FORMAT(entry_price, dec_places),',','') AS entry_price,REPLACE(FORMAT(price_target,dec_places),',','') AS price_target,REPLACE(FORMAT(stop_loss,dec_places),',','') AS stop_loss,"
                . "date, time "
                . "FROM trade_rec "
                . "LEFT JOIN futures_cont ON fk_future=id_futures "
                . "LEFT JOIN strategy ON fk_strategy=id_strategy "
                . "ORDER BY id_tr DESC LIMIT 5");
        $res->execute();
        $tr=$res->fetchAll(PDO::FETCH_CLASS, "traderec\TradeRec");
        return $tr;
    }
    public static function GetTradeRecType($id_type){
        $db= Conn::GetConnection();
        $res = $db->prepare("SELECT tr_type FROM trade_types "
                . "WHERE id_tr_type=:id_tr_type LIMIT 1");
        $res->bindParam(':id_tr_type',$id_type);
        $res->execute();
        $tr_type = $res->fetchColumn();;
        return $tr_type;
    }
    public static function InsertTradeRec($tr){
        $db= Conn::GetConnection();
        $res = $db->prepare("INSERT INTO trade_rec (id_tr,fk_tr_type,fk_future,month,year,num_contr,entry_choice,duration,entry_price,price_target,stop_loss,date,time) VALUES ('',:fk_tr_type,:fk_future,:month,:year,:num_contr,:entry_choice,:duration,:entry_price,:price_target,:stop_loss,:date,:time)");
        $res->bindParam(':fk_future',$tr->fk_future);
        $res->bindParam(':fk_tr_type',$tr->fk_tr_type);
        $res->bindParam(':month',$tr->month);
        $res->bindParam(':year',$tr->year);
        $res->bindParam(':num_contr',$tr->num_contr);
        $res->bindParam(':entry_choice',$tr->entry_choice);
        $res->bindParam(':duration',$tr->duration);
        $res->bindParam(':entry_price',$tr->entry_price);
        $res->bindParam(':price_target',$tr->price_target);
        $res->bindParam(':stop_loss',$tr->stop_loss);
        $res->bindParam(':date',$tr->date);
        $res->bindParam(':time',$tr->time);
        $res->execute();
    }
}