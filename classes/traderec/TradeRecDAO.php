<?php
namespace traderec;
use PDO,utils\Conn;
class TradeRecDAO {
    /**     
     * returns ALL trade recs as an array of objects, 
     * formats prices depending on decimal places,
     * formats date as *15 May 2015*
     **/
    public static function GetTradeRecs(){
        $db= Conn::GetConnection();
        $res = $db->prepare("SELECT id_tr,fk_tr_type,fk_future,futures_name,month,year,num_contr,tr_program_name,description,entry_choice, "
                . "REPLACE(FORMAT(entry_price, dec_places),',','') AS entry_price,REPLACE(FORMAT(price_target,dec_places),',','') AS price_target,REPLACE(FORMAT(stop_loss,dec_places),',','') AS stop_loss,"
                . "date, time "
                . "FROM trade_rec "
                . "LEFT JOIN futures_cont ON fk_future=id_futures "
                . "LEFT JOIN trade_program ON fk_tr_program=id_tr_program "
                . "ORDER BY id_tr DESC");
        $res->execute();
        $tr = $res->fetchAll(PDO::FETCH_CLASS, "traderec\TradeRec");
        return $tr;//!!!have to check if array exists
    }
    /*
     * returns LAST 5 trade recs as an array of objects, 
     * formats prices depending on decimal places,
     * formats date as *15 May 2015*
     **/
    public static function GetLast5TradeRecs(){
        $db= Conn::GetConnection();
        $res = $db->prepare("SELECT id_tr,fk_tr_type,fk_future,futures_name,month,year,num_contr,tr_program_name,description,entry_choice, "
                . "REPLACE(FORMAT(entry_price, dec_places),',','') AS entry_price,REPLACE(FORMAT(price_target,dec_places),',','') AS price_target,REPLACE(FORMAT(stop_loss,dec_places),',','') AS stop_loss,"
                . "date, time "
                . "FROM trade_rec "
                . "LEFT JOIN futures_cont ON fk_future=id_futures "
                . "LEFT JOIN trade_program ON fk_tr_program=id_tr_program "
                . "ORDER BY id_tr DESC LIMIT 5");
        $res->execute();
        $tr=$res->fetchAll(PDO::FETCH_CLASS, "traderec\TradeRec");
        return $tr;
    }
    public static function GetTradeRecType($type_id){
        $db= Conn::GetConnection();
        $res = $db->prepare("SELECT tr_type FROM trade_types "
                . "WHERE id_tr_type=:tr_type_id LIMIT 1");
        $res->bindParam(':tr_type_id',$type_id);
        $res->execute();
        $tr_type = $res->fetchColumn();;
        return $tr_type;
    }
    /**     
     * inserts ONE trade rec
     **/
    public static function InsertTradeRec($tr){
        $db= Conn::GetConnection();
        $res = $db->prepare("INSERT INTO trade_rec (id_tr,fk_tr_type,fk_future,month,year,num_contr,entry_choice,entry_price,price_target,stop_loss,date,time) VALUES ('',:fk_tr_type,:fk_future,:month,:year,:num_contr,:entry_choice,:entry_price,:price_target,:stop_loss,:date,:time)");
        $res->bindParam(':fk_future',$tr->fk_future);
        $res->bindParam(':fk_tr_type',$tr->fk_tr_type);
        $res->bindParam(':month',$tr->month);
        $res->bindParam(':year',$tr->year);
        $res->bindParam(':num_contr',$tr->num_contr);
        $res->bindParam(':entry_choice',$tr->entry_choice);
        $res->bindParam(':entry_price',$tr->entry_price);
        $res->bindParam(':price_target',$tr->price_target);
        $res->bindParam(':stop_loss',$tr->stop_loss);
        $res->bindParam(':date',$tr->date);
        $res->bindParam(':time',$tr->time);
        $res->execute();
    }
}