<?php

class PDO_Function
{
    public $data_1, $active;

    public function __construct($account, $mysql_connect)
    {
        $this->data_1 = $account;
        $this->active = $mysql_connect;
    }

    public function Save_Video($video_id,$video_name,$video_type,$video_intro)
    {
        $statement = $this->active->prepare("INSERT INTO Video_Info(Video_ID,Video_Name,Video_Type,Video_Uploader,Video_Intro) 
        VALUES (:id, :vn, :vt, :vu, :vi)");
        $statement->bindValue(':id', $video_id, PDO::PARAM_STR);
        $statement->bindValue(':vn', $video_name, PDO::PARAM_STR);
        $statement->bindValue(':vt', $video_type, PDO::PARAM_STR);
        $statement->bindValue(':vu', $this->data_1, PDO::PARAM_STR);
        $statement->bindValue(':vi', $video_intro, PDO::PARAM_STR);
        $statement->execute();
    }
    public function Delete_Video($video_id)
    {
        $statement = $this->active->prepare("DELETE FROM Video_Info WHERE Video_ID LIKE :id");
        $statement->bindValue(':id', $video_id, PDO::PARAM_STR);
        $statement->execute();
    }
}