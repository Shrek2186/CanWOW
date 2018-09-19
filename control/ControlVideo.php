<?php

namespace shrek;
include_once "database/ConnectDB.php";

use shrek\ConnectDB as CDB;

class ControlVideo
{
    public $video;
    public $connect;

    function __construct()
    {
        $cdb = new CDB();
        $cdb->server_name = "localhost";
        $cdb->database_name = "video";
        $cdb->user_name = "root";
        $cdb->password = "";
        $this->connect = $cdb->Connection();
    }

    function SelectInfo($videoID)
    {
        $select = $this->connect->prepare("SELECT video_info.*,statistics.Video_Watch_Num FROM video_info LEFT JOIN statistics ON video_info.Video_ID = statistics.Video_ID WHERE video_info.Video_ID LIKE :id");
        $select->bindValue(':id', $videoID, \PDO::PARAM_STR);
        $select->execute();
        $result = $select->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($result as $array) {
            foreach ($array as $key => $value) {
                $this->video[$key] = $value;
            }
        }

        // 修改by方方
        $select = $this->connect->prepare("SELECT * FROM video_info WHERE video_ID=:id ");
    }
}