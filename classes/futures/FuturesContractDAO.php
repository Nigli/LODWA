<?php

namespace futures;

use PDO,
    utils\Conn;

class FuturesContractDAO {

    public static function getActiveFutures() {/*     * GET ACTIVE FUTURES - RETURNS ARRAY WITH OBJECTS* */
        $db = Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $res = $db->prepare("SELECT * FROM futures_cont "
                    . "WHERE status=1");
            $res->execute();
            $futures = $res->fetchAll(PDO::FETCH_CLASS, "futures\FuturesContract");
            return $futures;
        } catch (\PDOException $e) {
            Conn::logConnectionErr($e->getMessage());
        }
    }

    public static function getFuturesByStrategy($strategy_id) {/*     * GET ALL FUTURES BY ID - RETURNS ARRAY* */
        $db = Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $res = $db->prepare("SELECT * FROM futures_cont, strat_futures "
                    . "WHERE id_futures=fk_futures "
                    . "AND fk_strategy=:strategy_id "
                    . "AND futures_cont.status = 1");
            $res->bindParam(':strategy_id', $strategy_id);
            $res->execute();
            $futures = $res->fetchAll(PDO::FETCH_CLASS, "futures\FuturesContract");
            return $futures;
        } catch (\PDOException $e) {
            Conn::logConnectionErr($e->getMessage());
        }
    }

    public static function getFuturesById($futures_id) {/*     * GET 1 FUTURES BY ID - RETURNS OBJECT* */
        $db = Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $res = $db->prepare("SELECT * FROM futures_cont "
                    . "WHERE id_futures=:futures_id LIMIT 1");
            $res->bindParam(':futures_id', $futures_id);
            $res->execute();
            $futures = $res->fetchObject("futures\FuturesContract");
            ;
            return $futures;
        } catch (\PDOException $e) {
            Conn::logConnectionErr($e->getMessage());
        }
    }

    public static function newFutures($future) {
        $db = Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $res = $db->prepare("INSERT INTO futures_cont "
                    . "(id_futures,futures_name,description,dec_places) "
                    . "VALUES ('',:futures_name,:description,:dec_places)");
            $res->bindParam(':futures_name', $future['futures_name']);
            $res->bindParam(':description', $future['futures_desc']);
            $res->bindParam(':dec_places', $future['futures_dec']);
            $res->execute();
            return true;
        } catch (\PDOException $e) {
            Conn::logConnectionErr($e->getMessage());
        }
    }

    public static function updateFutures($future) {
        $db = Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $res = $db->prepare("UPDATE futures_cont "
                    . "SET futures_name=:futures_name, "
                    . "description=:description, "
                    . "dec_places=:dec_places "
                    . "WHERE id_futures=:id_futures");
            $res->bindParam(':id_futures', $future['id_futures']);
            $res->bindParam(':futures_name', $future['futures_name']);
            $res->bindParam(':description', $future['futures_desc']);
            $res->bindParam(':dec_places', $future['futures_dec']);
            $res->execute();
            return true;
        } catch (\PDOException $e) {
            Conn::logConnectionErr($e->getMessage());
        }
    }

    public static function deleteStrategyFuture($future) {
        $db = Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $res = $db->prepare("DELETE FROM strat_futures "
                    . "WHERE fk_futures=:id_futures");
            $res->bindParam(':id_futures', $future['id_futures']);
            $res->execute();
            return TRUE;
        } catch (\PDOException $e) {
            Conn::logConnectionErr($e->getMessage());
        }
    }

    public static function removeFutures($future) {
        $db = Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $res = $db->prepare("UPDATE futures_cont "
                    . "SET status=0 "
                    . "WHERE id_futures=:id_futures");
            $res->bindParam(':id_futures', $future['id_futures']);
            $res->execute();
            return true;
        } catch (\PDOException $e) {
            Conn::logConnectionErr($e->getMessage());
        }
    }

}
