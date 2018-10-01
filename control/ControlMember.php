<?php

namespace shrek;
include_once $_SERVER['DOCUMENT_ROOT'] . '/canwow-server/' . "database/ConnectDB.php";

use shrek\ConnectDB as CDB;

class ControlMember
{
    public $video;
    public $playlist;
    public $connect;

    function __construct()
    {
        $cdb = new CDB();
        $cdb->server_name = "localhost";
        $cdb->database_name = "member";
        $cdb->user_name = "root";
        $cdb->password = "";
        $this->connect = $cdb->Connection();
    }

    function SelectPlayList($videoID)
    {
        $select = $this->connect->prepare("SELECT * FROM playlist WHERE ID LIKE :id ");
        $select->bindValue(':id', $videoID, \PDO::PARAM_STR);
        $select->execute();
        $result = $select->fetchAll(\PDO::FETCH_ASSOC);
    }

    function Login($email, $password)
    {
        $login_message = '';
        try {
            $select = $this->connect->prepare("SELECT email,password FROM information WHERE email LIKE :em");
            $select->bindValue(':em', $email, \PDO::PARAM_STR);
            if ($select->execute()) {
                $result = $select->fetch(\PDO::FETCH_ASSOC);
                if (!empty($result['email'])) {
                    if ($result['password'] == $password) {
                        setcookie('verification', $result['email'], time() + 3600, '/');
                        $login_message = 1;//login success
                    } else $login_message = 2;//password error
                } else $login_message = 3;//email error
            } else $login_message = 4;//server error
        } catch (\PDOException $e) {
            echo "Select information failed: " . $e->getMessage();
        }
        return $login_message;
    }

    function register($email, $password, $last_name, $first_name, $birth, $phone, $class)
    {
        $register_message = '';
        try {
            $insert = $this->connect->prepare("INSERT INTO information (email,password,last_name,first_name,birth,phone,class) VALUE (:em,:pw,:ln,:fn,:bh,:ph,:cs)");
            $insert->bindValue(':em', $email, \PDO::PARAM_STR);
            $insert->bindValue(':pw', $password, \PDO::PARAM_STR);
            $insert->bindValue(':ln', $last_name, \PDO::PARAM_STR);
            $insert->bindValue(':fn', $first_name, \PDO::PARAM_STR);
            $insert->bindValue(':bh', $birth, \PDO::PARAM_STR);
            $insert->bindValue(':ph', $phone, \PDO::PARAM_STR);
            $insert->bindValue(':cs', $class, \PDO::PARAM_INT);
            if ($insert->execute()) {
                setcookie('verification', $email, time() + 3600, '/'); //電子信箱認證功能串接
                $register_message = 1;//register success
            }

        } catch (\PDOException $e) {
            echo "Select information failed: " . $e->getMessage();
        }
        return $register_message;
    }

}