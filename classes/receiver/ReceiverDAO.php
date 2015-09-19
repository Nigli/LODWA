<?php
namespace receiver;
use PDO,
    utils\Conn;
class ReceiverDAO {
    public static function getReceivers($pagin, $filter) {/* GET ALL RECEIVERS - RETURNS ARRAY OF OBJECTS */
        $db = Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $res = $db->prepare("SELECT * FROM receivers "
                    . "LEFT JOIN receiver_type ON fk_receiver_type=id_receiver_type "
                    . "LEFT JOIN subscriptions ON fk_id_receiver=id_receiver "
                    . "WHERE fk_receiver_type = if(:type= 0,fk_receiver_type, :type) "
                    . "AND fk_strategy = if(:strategy= 0,fk_strategy, :strategy) "
                    . "AND broker_acc= if(:broker_acc= 'ALL',broker_acc, :broker_acc) "
                    . "AND active = 1 "
                    . "GROUP BY id_receiver "
                    . "LIMIT :limit "
                    . "OFFSET :offset");
            $res->bindParam(':limit', $pagin->limit, PDO::PARAM_INT);
            $res->bindParam(':offset', $pagin->offset, PDO::PARAM_INT);
            $res->bindParam(':type', $filter['type'], PDO::PARAM_INT);
            $res->bindParam(':broker_acc', $filter['ba'], PDO::PARAM_STR);
            $res->bindParam(':strategy', $filter['strategy'], PDO::PARAM_INT);
            $res->execute();
            $receivers = $res->fetchAll(PDO::FETCH_CLASS, "receiver\Receiver");
            return $receivers;
        } catch (\PDOException $e) {
            Conn::logConnectionErr($e->getMessage());
            return FALSE;
        }
    }
    public static function getInactiveReceivers($pagin, $filter) {/* GET ONLY INACTIVE RECEIVERS FOR RECEIVER FILTER */
        $db = Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $res = $db->prepare("SELECT * FROM receivers "
                    . "LEFT JOIN receiver_type ON fk_receiver_type=id_receiver_type "
                    . "WHERE active = 0 "
                    . "AND fk_receiver_type = if(:type= '0',fk_receiver_type, :type) "
                    . "AND broker_acc= if(:broker_acc= 'ALL',broker_acc, :broker_acc) "
                    . "GROUP BY id_receiver "
                    . "LIMIT :limit "
                    . "OFFSET :offset");
            $res->bindParam(':limit', $pagin->limit, PDO::PARAM_INT);
            $res->bindParam(':offset', $pagin->offset, PDO::PARAM_INT);
            $res->bindParam(':type', $filter['type'], PDO::PARAM_INT);
            $res->bindParam(':broker_acc', $filter['ba'], PDO::PARAM_STR);
            $res->execute();
            $receivers = $res->fetchAll(PDO::FETCH_CLASS, "receiver\Receiver");
            return $receivers;
        } catch (\PDOException $e) {
            Conn::logConnectionErr($e->getMessage());
        }
    }
    public static function getReceiverById($id) {
        $db = Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $res = $db->prepare("SELECT * FROM receivers "
                    . "LEFT JOIN receiver_type ON fk_receiver_type=id_receiver_type "
                    . "LEFT JOIN subscriptions ON fk_id_receiver=id_receiver "
                    . "WHERE id_receiver = :id_receiver "
                    . "LIMIT 1");
            $res->bindParam(':id_receiver', $id);
            $res->execute();
            $receivers = $res->fetchObject("receiver\Receiver");
            return $receivers;
        } catch (\PDOException $e) {
            Conn::logConnectionErr($e->getMessage());
        }
    }
    public static function getReceiverByHash($hash_email) {/* GET RECEIVER BY HASH - USED FOR UNSUBS FROM EMAIL TEMP */
        $db = Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $res = $db->prepare("SELECT * FROM receivers "
                    . "LEFT JOIN receiver_type ON fk_receiver_type=id_receiver_type "
                    . "LEFT JOIN subscriptions ON fk_id_receiver=id_receiver "
                    . "WHERE hash_email = :hash_email "
                    . "LIMIT 1");
            $res->bindParam(':hash_email', $hash_email);
            $res->execute();
            $receivers = $res->fetchObject("receiver\Receiver");
            return $receivers;
        } catch (\PDOException $e) {
            Conn::logConnectionErr($e->getMessage());
        }
    }
    public static function getReceiversByStrat($strategy_id) {/*     * GET ALL CLIENTS BY STRATEGY - RETURN ARRAY OF OBJECTS* */
        $db = Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $res = $db->prepare("SELECT * FROM receivers "
                    . "LEFT JOIN subscriptions ON fk_id_receiver=id_receiver "
                    . "WHERE active = 1 "
                    . "AND fk_strategy = :strategy_id");
            $res->bindParam(':strategy_id', $strategy_id);
            $res->execute();
            $receivers = $res->fetchAll(PDO::FETCH_CLASS, "receiver\Receiver");
            return $receivers;
        } catch (\PDOException $e) {
            Conn::logConnectionErr($e->getMessage());
        }
    }
    public static function getTypes() {
        $db = Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $res = $db->prepare("SELECT * FROM receiver_type");
            $res->execute();
            $receivers = $res->fetchAll(PDO::FETCH_ASSOC);
            return $receivers; //!!!have to check if exists
        } catch (\PDOException $e) {
            Conn::logConnectionErr($e->getMessage());
        }
    }
    public static function countReceivers($filter) {
        $db = Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $res = $db->prepare("SELECT COUNT(DISTINCT id_receiver) FROM receivers "
                    . "LEFT JOIN receiver_type ON fk_receiver_type=id_receiver_type "
                    . "LEFT JOIN subscriptions ON fk_id_receiver=id_receiver "
                    . "WHERE active = 1 "
                    . "AND fk_receiver_type = if(:type= 0,fk_receiver_type, :type) "
                    . "AND fk_strategy = if(:strategy= 0,fk_strategy, :strategy) "
                    . "AND broker_acc= if(:broker_acc= 'ALL', broker_acc, :broker_acc)");
            $res->bindParam(':type', $filter['type'], PDO::PARAM_INT);
            $res->bindParam(':broker_acc', $filter['ba'], PDO::PARAM_STR);
            $res->bindParam(':strategy', $filter['strategy'], PDO::PARAM_INT);
            $res->execute();
            $receivers = $res->fetchColumn();
            return $receivers;
        } catch (\PDOException $e) {
            Conn::logConnectionErr($e->getMessage());
        }
    }
    public static function countInactiveReceivers($filter) {
        $db = Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $res = $db->prepare("SELECT COUNT(DISTINCT id_receiver) FROM receivers "
                    . "LEFT JOIN receiver_type ON fk_receiver_type=id_receiver_type "
                    . "WHERE active = 0 "
                    . "AND fk_receiver_type = if(:type= 0,fk_receiver_type, :type) "
                    . "AND broker_acc= if(:broker_acc= 'ALL', broker_acc, :broker_acc)");
            $res->bindParam(':type', $filter['type'], PDO::PARAM_INT);
            $res->bindParam(':broker_acc', $filter['ba'], PDO::PARAM_STR);
            $res->execute();
            $receivers = $res->fetchColumn();
            return $receivers;
        } catch (\PDOException $e) {
            Conn::logConnectionErr($e->getMessage());
        }
    }
    public static function newReceiver($receiver) {
        $db = Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $rec = $db->prepare("INSERT INTO receivers "
                    . "(id_receiver,fk_receiver_type,first_name,last_name,email,date_added,hash_email,na_number,broker_acc) "
                    . "VALUES('',:fk_receiver_type,:first_name,:last_name,:email,now(),md5(:email),:na_number,:broker_acc)");
            $rec->bindParam(':fk_receiver_type', $receiver->fk_receiver_type, PDO::PARAM_INT);
            $rec->bindParam(':first_name', $receiver->first_name, PDO::PARAM_STR);
            $rec->bindParam(':last_name', $receiver->last_name, PDO::PARAM_STR);
            $rec->bindParam(':email', $receiver->email, PDO::PARAM_STR);
            $rec->bindParam(':na_number', $receiver->na_number, PDO::PARAM_STR);
            $rec->bindParam(':broker_acc', $receiver->broker_acc, PDO::PARAM_INT);
            $rec->execute();
            return $db->lastInsertId();
        } catch (\PDOException $e) {
            Conn::logConnectionErr($e->getMessage());
        }
    }
    public static function updateReceiver($receiver) {
        $db = Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $res = $db->prepare("UPDATE receivers "
                    . "SET fk_receiver_type=:fk_receiver_type, "
                    . "first_name=:first_name, "
                    . "last_name=:last_name, "
                    . "email=:email, "
                    . "na_number=:na_number, "
                    . "broker_acc=:broker_acc, "
                    . "active=1 "
                    . "WHERE id_receiver=:id_receiver");
            $res->bindParam(':id_receiver', $receiver->id_receiver, PDO::PARAM_INT);
            $res->bindParam(':fk_receiver_type', $receiver->fk_receiver_type, PDO::PARAM_INT);
            $res->bindParam(':first_name', $receiver->first_name, PDO::PARAM_STR);
            $res->bindParam(':last_name', $receiver->last_name, PDO::PARAM_STR);
            $res->bindParam(':email', $receiver->email, PDO::PARAM_STR);
            $res->bindParam(':na_number', $receiver->na_number, PDO::PARAM_STR);
            $res->bindParam(':broker_acc', $receiver->broker_acc, PDO::PARAM_INT);
            $res->execute();
            return TRUE;
        } catch (\PDOException $e) {
            Conn::logConnectionErr($e->getMessage());
        }
    }
    public static function getSubscriptionBySubsId($subscriber_id) {/* GET ARRAY OF SUBSCRIPTIONS BASED ON SUBSCRIBERS ID */
        $db = Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $res = $db->prepare("SELECT * FROM subscriptions "
                    . "LEFT JOIN strategy ON fk_strategy = id_strategy "
                    . "WHERE fk_id_receiver = :id_receiver");
            $res->bindParam(':id_receiver', $subscriber_id, PDO::PARAM_INT);
            $res->execute();
            return $res->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            Conn::logConnectionErr($e->getMessage());
        }
    }
    public static function removeSubscriptionBySubscriber($subscriber_id) {/* REMOVES SUBSCRIBER FROM SUBSCRIPTION LIST (BY SUBS ID) */
        $db = Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $res = $db->prepare("DELETE FROM subscriptions "
                    . "WHERE fk_id_receiver = :id_receiver");
            $res->bindParam(':id_receiver', $subscriber_id, PDO::PARAM_INT);
            $res->execute();
            return TRUE;
        } catch (\PDOException $e) {
            Conn::logConnectionErr($e->getMessage());
        }
    }
    public static function removeSubscriptionByStrategy($strategy) {/* REMOVES SUBSCRIBER FROM SUBSCRIPTION LIST (BY STRATEGY ID) */
        $db = Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $res = $db->prepare("DELETE FROM subscriptions "
                    . "WHERE fk_strategy = :fk_strategy");
            $res->bindParam(':fk_strategy', $strategy['id_strategy'], PDO::PARAM_INT);
            $res->execute();
            return TRUE;
        } catch (\PDOException $e) {
            Conn::logConnectionErr($e->getMessage());
        }
    }
    public static function insertSubscription($subscriber_id, $strategy_id, $num_subscriptions) {
        $db = Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $res = $db->prepare("INSERT INTO subscriptions "
                    . "(id_subs, fk_id_receiver, fk_strategy, num_subs) "
                    . "VALUES('',:id_receiver,:fk_strategy,:num_subs)");
            $res->bindParam(':id_receiver', $subscriber_id, PDO::PARAM_INT);
            $res->bindParam(':fk_strategy', $strategy_id, PDO::PARAM_INT);
            $res->bindParam(':num_subs', $num_subscriptions, PDO::PARAM_INT);
            $res->execute();
            return TRUE;
        } catch (\PDOException $e) {
            Conn::logConnectionErr($e->getMessage());
        }
    }
    public static function unsubscribeReceiver($receiver) {
        $db = Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $res = $db->prepare("UPDATE receivers "
                    . "SET active = if(:active=1, 0, 1), "
                    . "date_inactive=if(:active=1, now(), null) "
                    . "WHERE id_receiver=:id");
            $res->bindParam(':id', $receiver['id_receiver'], PDO::PARAM_INT);
            $res->bindParam(':active', $receiver['active'], PDO::PARAM_INT);
            $res->execute();
            return TRUE;
        } catch (\PDOException $e) {
            Conn::logConnectionErr($e->getMessage());
        }
    }
}
