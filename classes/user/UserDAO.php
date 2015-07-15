<?php

namespace user;

use PDO,
    utils\Conn;

class UserDAO {

    public static function getUsers() {
        $db = Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $res = $db->prepare("SELECT * FROM users "
                    . "LEFT JOIN user_status ON fk_status=id_status "
                    . "WHERE active = 1 "
                    . "ORDER BY status_name");
            $res->execute();
            $users = $res->fetchAll(PDO::FETCH_CLASS, "user\User");
            ;
            return $users;
        } catch (\PDOException $e) {
            Conn::logConnectionErr($e->getMessage());
        }
    }

    public static function getUserByEmail($user_email) {/*     * GET 1 USER BY EMAIL - RETURNS OBJECT* */
        $db = Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $res = $db->prepare("SELECT * FROM users "
                    . "LEFT JOIN user_status ON fk_status=id_status "
                    . "WHERE user_email=:user_email LIMIT 1");
            $res->bindParam(':user_email', $user_email);
            $res->execute();
            $user = $res->fetchObject("user\User");
            ;
            return $user;
        } catch (\PDOException $e) {
            Conn::logConnectionErr($e->getMessage());
        }
    }

    public static function countUsers() {
        $db = Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $res = $db->prepare("SELECT COUNT(*) FROM users");
            $res->execute();
            $users = $res->fetchColumn();
            return $users;
        } catch (\PDOException $e) {
            Conn::logConnectionErr($e->getMessage());
        }
    }

    public static function getStatus() {
        $db = Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $res = $db->prepare("SELECT id_status,status_name FROM user_status");
            $res->execute();
            $receivers = $res->fetchAll(PDO::FETCH_ASSOC);
            return $receivers;
        } catch (\PDOException $e) {
            Conn::logConnectionErr($e->getMessage());
        }
    }

    public static function newUser($user) {
        $db = Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $res = $db->prepare("INSERT INTO users "
                    . "(user_id,user_email,user_pass,fk_status) "
                    . "VALUES('',:user_email,:user_pass,:fk_status)");
            $res->bindParam(':user_email', $user['email']);
            $res->bindParam(':user_pass', $user['hash']);
            $res->bindParam(':fk_status', $user['status']);
            $res->execute();
            return true;
        } catch (\PDOException $e) {
            Conn::logConnectionErr($e->getMessage());
        }
    }

    public static function updateUser($user) {
        $db = Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $res = $db->prepare("UPDATE users "
                    . "SET user_email=:user_email, "
                    . "user_pass=:user_pass, "
                    . "fk_status=:user_status "
                    . "WHERE user_id=:user_id");
            $res->bindParam(':user_id', $user['id_user']);
            $res->bindParam(':user_email', $user['email']);
            $res->bindParam(':user_pass', $user['hash']);
            $res->bindParam(':user_status', $user['status']);
            $res->execute();
            return true;
        } catch (\PDOException $e) {
            Conn::logConnectionErr($e->getMessage());
        }
    }

    public static function removeUser($user) {
        $db = Conn::getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $res = $db->prepare("UPDATE users "
                    . "SET active=0 "
                    . "WHERE user_id=:user_id");
            $res->bindParam(':user_id', $user['id_user']);
            $res->execute();
            return true;
        } catch (\PDOException $e) {
            Conn::logConnectionErr($e->getMessage());
        }
    }

}
