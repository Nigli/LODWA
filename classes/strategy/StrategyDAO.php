<?php

namespace strategy;

use PDO,
    utils\Conn;

class StrategyDAO {

    public static function getActiveStrategies() {/*     * GET ACTIVE STRATEGIES - RETURNS ARRAY OF OBJECTS* */
        $db = Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $res = $db->prepare("SELECT * FROM strategy "
                    . "WHERE status = 1");
            $res->execute();
            $tr = $res->fetchAll(PDO::FETCH_CLASS, "strategy\Strategy");
            return $tr;
        } catch (\PDOException $e) {
            Conn::logConnectionErr($e->getMessage());
        }
    }

    public static function getStrategiesByFutureId($id_future) {/*     * * */
        $db = Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $res = $db->prepare("SELECT * FROM strategy, strat_futures "
                    . "WHERE fk_futures = :id_futures "
                    . "AND fk_strategy = id_strategy "
                    . "AND strategy.status = 1");
            $res->bindParam(':id_futures', $id_future);
            $res->execute();
            $tr = $res->fetchAll(PDO::FETCH_CLASS, "strategy\Strategy");
            return $tr;
        } catch (\PDOException $e) {
            Conn::logConnectionErr($e->getMessage());
        }
    }

    public static function getStrategyById($id_strategy) {/*     * GET STRATEGIES BY ID - RETURNS OBJECT* */
        $db = Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $res = $db->prepare("SELECT * FROM strategy "
                    . "WHERE id_strategy = :id_strategy "
                    . "LIMIT 1");
            $res->bindParam(':id_strategy', $id_strategy);
            $res->execute();
            $tr = $res->fetchObject("strategy\Strategy");
            return $tr;
        } catch (\PDOException $e) {
            Conn::logConnectionErr($e->getMessage());
        }
    }

    public static function newStrategy($strategy) {
        $db = Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $res = $db->prepare("INSERT INTO strategy "
                    . "(id_strategy,strategy_name) "
                    . "VALUES ('',:strategy_name)");
            $res->bindParam(':strategy_name', $strategy['strategy_name']);
            $res->execute();
            return $db->lastInsertId();
        } catch (\PDOException $e) {
            Conn::logConnectionErr($e->getMessage());
        }
    }

    public static function updateStrategy($strategy) {
        $db = Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $res = $db->prepare("UPDATE strategy "
                    . "SET strategy_name=:strategy_name "
                    . "WHERE id_strategy=:id_strategy");
            $res->bindParam(':id_strategy', $strategy['id_strategy']);
            $res->bindParam(':strategy_name', $strategy['strategy_name']);
            $res->execute();
            return TRUE;
        } catch (\PDOException $e) {
            Conn::logConnectionErr($e->getMessage());
        }
    }

    public static function deleteStrategyFuture($strategy) {
        $db = Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $res = $db->prepare("DELETE FROM strat_futures "
                    . "WHERE fk_strategy=:id_strategy");
            $res->bindParam(':id_strategy', $strategy['id_strategy']);
            $res->execute();
            return TRUE;
        } catch (\PDOException $e) {
            Conn::logConnectionErr($e->getMessage());
        }
    }

    public static function insertStrategyFuture($strategy, $future_id) {
        $db = Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $res = $db->prepare("INSERT INTO strat_futures "
                    . "(id_strat_futures, fk_strategy, fk_futures) "
                    . "VALUES('', :id_strategy, :id_futures)");
            $res->bindParam(':id_strategy', $strategy);
            $res->bindParam(':id_futures', $future_id);
            $res->execute();
            return TRUE;
        } catch (\PDOException $e) {
            Conn::logConnectionErr($e->getMessage());
        }
    }

    public static function removeStrategy($strategy) {
        $db = Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $res = $db->prepare("UPDATE strategy "
                    . "SET status=0 "
                    . "WHERE id_strategy=:id_strategy");
            $res->bindParam(':id_strategy', $strategy['id_strategy']);
            $res->execute();
            return TRUE;
        } catch (\PDOException $e) {
            Conn::logConnectionErr($e->getMessage());
        }
    }

}
