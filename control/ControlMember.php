<?php

namespace shrek;
include_once "/database/ConnectDB.php";

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
                if (count($result) > 0) {
                    if ($result['password'] == $password) {
                        setcookie('verification', $result['email'], time() + 3600, '/');
//                        $login_message = 'login success';
                        $login_message = 1;
                    } else
//                        $login_message = 'password error';
                        $login_message = 3;
                } else
//                    $login_message = 'email error';
                    $login_message = 2;
            } else $login_message = 4;
//            $login_message = 'server error';
        } catch (\PDOException $e) {
            echo "Select information failed: " . $e->getMessage();
        }

        return $login_message;
    }

}