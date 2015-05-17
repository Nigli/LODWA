<?php
namespace traderec;
use PDO,utils\Conn;
class TradeRecDAO {
    public static function GetTradeRecs(){
        $db= Conn::GetConnection();
        $res = $db->prepare("SELECT id_tr,fk_tr_type,fk_future,futures_name,month,year,num_contr,tr_program_name,description,entry_choice, "
                . "FORMAT(entry_price, dec_places) AS entry_price,FORMAT(price_target,dec_places) AS price_target,FORMAT(stop_loss,dec_places) AS stop_loss,"
                . "date_format(date,'%e %M %Y') AS date,date_format(date,'%k%s') AS time "
                . "FROM trade_rec "
                . "LEFT JOIN futures_cont ON fk_future=id_futures "
                . "LEFT JOIN trade_program ON fk_tr_program=id_tr_program "
                . "ORDER BY id_tr DESC");
        $res->execute();
        $tr = $res->fetchAll(PDO::FETCH_CLASS, "traderec\TradeRec");
        return $tr;//!!!have to check if array exists
    }
    public static function GetLastTradeRec($fk_future=null){
        $db= Conn::GetConnection();
        $res = $db->prepare("SELECT id_tr,fk_tr_type,fk_future,futures_name,month,year,num_contr,tr_program_name,description,entry_choice, "
                . "FORMAT(entry_price, dec_places) AS entry_price,FORMAT(price_target,dec_places) AS price_target,FORMAT(stop_loss,dec_places) AS stop_loss,"
                . "date_format(date,'%e %M %Y') AS date,date_format(date,'%k%s') AS time "
                . "FROM trade_rec "
                . "LEFT JOIN futures_cont ON fk_future=id_futures "
                . "LEFT JOIN trade_program ON fk_tr_program=id_tr_program "
                . "WHERE fk_future = if(:fk_future IS NULL,fk_future,:fk_future) ORDER BY id_tr DESC LIMIT 1");
        $res->bindParam(':fk_future',$fk_future);
        $res->execute();
        $tr=$res->fetch(PDO::FETCH_ASSOC);
        return $tr;
    }    
    public static function GetLast5TradeRecs(){
        $db= Conn::GetConnection();
        $res = $db->prepare("SELECT id_tr,fk_tr_type,fk_future,futures_name,month,year,num_contr,tr_program_name,description,entry_choice, "
                . "FORMAT(entry_price, dec_places) AS entry_price,FORMAT(price_target,dec_places) AS price_target,FORMAT(stop_loss,dec_places) AS stop_loss,"
                . "date_format(date,'%e %M %Y') AS date,date_format(date,'%k%s') AS time "
                . "FROM trade_rec "
                . "LEFT JOIN futures_cont ON fk_future=id_futures "
                . "LEFT JOIN trade_program ON fk_tr_program=id_tr_program "
                . "ORDER BY id_tr DESC LIMIT 5");
        $res->execute();
        $tr=$res->fetchAll(PDO::FETCH_CLASS, "traderec\TradeRec");
        return $tr;
    }
    public static function InsertTradeRec($tr){
        $db= Conn::GetConnection();
        $res = $db->prepare("INSERT INTO trade_rec (id_tr,fk_tr_type,fk_future,month,year,num_contr,entry_choice,entry_price,price_target,stop_loss,date) VALUES ('',:fk_tr_type,:fk_future,:month,:year,:num_contr,:entry_choice,:entry_price,:price_target,:stop_loss,now())");
        $res->bindParam(':fk_future',$tr->fk_future);
        $res->bindParam(':fk_tr_type',$tr->fk_tr_type);
        $res->bindParam(':month',$tr->month);
        $res->bindParam(':year',$tr->year);
        $res->bindParam(':num_contr',$tr->num_contr);
        $res->bindParam(':entry_choice',$tr->entry_choice);
        $res->bindParam(':entry_price',$tr->entry_price);
        $res->bindParam(':price_target',$tr->price_target);
        $res->bindParam(':stop_loss',$tr->stop_loss);
        $res->execute();
    }
}