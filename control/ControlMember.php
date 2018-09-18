<?php
namespace shrek;
include_once "database/ConnectDB.php";
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
        $cdb->database_name = "Member";
        $cdb->user_name = "root";
        $cdb->password = "";
        $this->connect = $cdb->Connection();
    }

    function SelectPlayList($videoID)
    {
        $select = $this->connect->prepare("SELECT * FROM playlist WHERE ID=:id ");
        $select->bindValue(':id', $videoID, \PDO::PARAM_STR);
        $select->execute();
        $result = $select->fetchAll(\PDO::FETCH_ASSOC);
    }

}