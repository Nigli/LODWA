<?php

namespace traderec;

use PDO,
    utils\Conn;

class TradeRecDAO {

    public static function getTradeRecs($pagin, $filter) {/*     * GET ALL TR FILTERED - RETURN ARRAY OF OBJECTS* */
        $db = Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $res = $db->prepare("SELECT id_tr,fk_tr_type,fk_future,fk_strategy,futures_name,month,year,num_contr,id_strategy,strategy_name,description,entry_choice,duration, "
                    . "REPLACE(FORMAT(entry_price, dec_places),',','') AS entry_price,REPLACE(FORMAT(price_target,dec_places),',','') AS price_target,REPLACE(FORMAT(stop_loss,dec_places),',','') AS stop_loss,"
                    . "DATE_FORMAT(date_time,'%e %M %Y') AS date, DATE_FORMAT(date_time, '%H:%i') AS time "
                    . "FROM trade_rec "
                    . "LEFT JOIN futures_cont ON fk_future=id_futures "
                    . "LEFT JOIN strategy ON fk_strategy=id_strategy "
                    . "WHERE fk_future= IF(:filter_future = 0, fk_future, :filter_future) AND "
                    . "entry_choice= IF(:filter_entry_choice = '0', entry_choice, :filter_entry_choice) "
                    . "ORDER BY id_tr DESC "
                    . "LIMIT :limit "
                    . "OFFSET :offset");
            $res->bindParam(':limit', $pagin->limit, PDO::PARAM_INT);
            $res->bindParam(':offset', $pagin->offset, PDO::PARAM_INT);
            $res->bindParam(':filter_future', $filter['fk_future'], PDO::PARAM_INT);
            $res->bindParam(':filter_entry_choice', $filter['entry_choice'], PDO::PARAM_STR);
            $res->execute();
            $tr = $res->fetchAll(PDO::FETCH_CLASS, "traderec\TradeRec");
            return $tr;
        } catch (\PDOException $e) {
            Conn::logConnectionErr($e->getMessage());
        }
    }

    public static function getLast5TradeRecs() {/*     * GET LAST 5 TRs - RETURNS ARRAY OF OBJECTS* */
        $db = Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $res = $db->prepare("SELECT id_tr,fk_tr_type,fk_future,fk_strategy,futures_name,month,year,num_contr,id_strategy,strategy_name,description,entry_choice,duration, "
                    . "REPLACE(FORMAT(entry_price, dec_places),',','') AS entry_price,REPLACE(FORMAT(price_target,dec_places),',','') AS price_target,REPLACE(FORMAT(stop_loss,dec_places),',','') AS stop_loss,"
                    . "DATE_FORMAT(date_time,'%e %M %Y') AS date, DATE_FORMAT(date_time, '%H:%i') AS time "
                    . "FROM trade_rec "
                    . "LEFT JOIN futures_cont ON fk_future=id_futures "
                    . "LEFT JOIN strategy ON fk_strategy=id_strategy "
                    . "ORDER BY id_tr DESC LIMIT 5");
            $res->execute();
            $tr = $res->fetchAll(PDO::FETCH_CLASS, "traderec\TradeRec");
            return $tr;
        } catch (\PDOException $e) {
            Conn::logConnectionErr($e->getMessage());
        }
    }

    public static function getTradeRecType($id_type) {/*     * GET TR TYPE NAME BY ID - RETURNS COLUMN* */
        $db = Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $res = $db->prepare("SELECT tr_type FROM trade_types "
                    . "WHERE id_tr_type=:id_tr_type LIMIT 1");
            $res->bindParam(':id_tr_type', $id_type);
            $res->execute();
            $tr_type = $res->fetchColumn();
            ;
            return $tr_type;
        } catch (\PDOException $e) {
            Conn::logConnectionErr($e->getMessage());
        }
    }

    public static function insertTradeRec($tr) {/*     * INSERT NEW TR FROM EMAIL OBJECT - RETURNS TRUE* */
        $db = Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $res = $db->prepare("INSERT INTO trade_rec "
                    . "(id_tr,fk_tr_type,fk_future,fk_strategy,month,year,num_contr,entry_choice,duration,entry_price,price_target,stop_loss,date_time) "
                    . "VALUES ('',:fk_tr_type,:fk_future,:fk_strategy,:month,:year,:num_contr,:entry_choice,:duration,:entry_price,:price_target,:stop_loss,:date_time)");
            $res->bindParam(':fk_future', $tr->fk_future);
            $res->bindParam(':fk_tr_type', $tr->fk_tr_type);
            $res->bindParam(':fk_strategy', $tr->fk_strategy);
            $res->bindParam(':month', $tr->month);
            $res->bindParam(':year', $tr->year);
            $res->bindParam(':num_contr', $tr->num_contr);
            $res->bindParam(':entry_choice', $tr->entry_choice);
            $res->bindParam(':duration', $tr->duration);
            $res->bindParam(':entry_price', $tr->entry_price);
            $res->bindParam(':price_target', $tr->price_target);
            $res->bindParam(':stop_loss', $tr->stop_loss);
            $res->bindParam(':date_time', $tr->date_time);
            $res->execute();
            return TRUE;
        } catch (\PDOException $e) {
            Conn::logConnectionErr($e->getMessage());
        }
    }

    public static function countTrades($filter) {/*     * GET TOTAL NUMBER OF FILTERED TR - RETURNS COLUMN* */
        $db = Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $res = $db->prepare("SELECT COUNT(*) FROM trade_rec "
                    . "WHERE fk_future= IF(:filter_future = 0, fk_future, :filter_future) AND "
                    . "entry_choice= IF(:filter_entry_choice = '0', entry_choice, :filter_entry_choice)");
            $res->bindParam(':filter_future', $filter['fk_future'], PDO::PARAM_INT);
            $res->bindParam(':filter_entry_choice', $filter['entry_choice'], PDO::PARAM_STR);
            $res->execute();
            $receivers = $res->fetchColumn();
            return $receivers;
        } catch (\PDOException $e) {
            Conn::logConnectionErr($e->getMessage());
        }
    }

}
