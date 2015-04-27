<?php
class TradeRecDAO {
    public static function GetTradeRec(){
        $db= Conn::GetConnection();
        $res = $db->prepare("SELECT * FROM trade_rec");
        $res->execute();
        $receivers = $res->fetchAll(PDO::FETCH_CLASS, "TradeRec");
        return $receivers;//!!!have to check if array exists
    }
    public static function GetLastTradeRec($fk_future=null){
        $db= Conn::GetConnection();
        $res = $db->prepare("SELECT id_tr,fk_future,month,year,num_contr,entry_choice,entry_price,price_target,stop_loss,date,futures_name,description,tr_strategy "
                . "FROM trade_rec "
                . "LEFT JOIN futures_cont ON fk_future=id_futures "
                . "LEFT JOIN trade_rec_strategy ON fk_tr_strategy=id_tr_strategy "
                . "WHERE fk_future = if(:fk_future IS NULL,fk_future,:fk_future) ORDER BY id_tr DESC LIMIT 1");
        $res->bindParam(':fk_future',$fk_future);
        $res->execute();
        $res->setFetchMode(PDO::FETCH_CLASS, "TradeRec");
        $receivers = $res->fetch();
        return $receivers;//!!!have to check if array exists
    }
    public static function NewTradeRec($fk_future,$fk_tr_strategy,$month,$year,$num_contr,$entry_choice,$entry_price,$price_target,$stop_loss){
        $db=Conn::GetConnection();
        $res = $db->prepare("INSERT INTO trade_rec (id_tr,fk_future,fk_tr_strategy,month,year,num_contr,entry_choice,entry_price,price_target,stop_loss,date) VALUES ('',:fk_future,:fk_tr_strategy,:month,:year,:num_contr,:entry_choice,:entry_price,:price_target,:stop_loss,now())");
        $res->bindParam(':fk_future',$fk_future);
        $res->bindParam(':fk_tr_strategy',$fk_tr_strategy);
        $res->bindParam(':month',$month);
        $res->bindParam(':year',$year);
        $res->bindParam(':num_contr',$num_contr);
        $res->bindParam(':entry_choice',$entry_choice);
        $res->bindParam(':entry_price',$entry_price);
        $res->bindParam(':price_target',$price_target);
        $res->bindParam(':stop_loss',$stop_loss);
        $res->execute();
    }
}