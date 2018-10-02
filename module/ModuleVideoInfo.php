<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/canwow-server/'."control/ControlVideo.php";

use shrek\ControlVideo as CV;
$cv = new CV();
$cv->SelectInfo($_GET['v']);
$video_ID = $cv->video['Video_ID'];       //char 6 bytes
$video_name = $cv->video['Video_Name'];     //varchar 50 bytes
$video_type = $cv->video['Video_Type'];     //char 3 bytes
$video_uploader = $cv->video['Video_Uploader']; //varchar 50 bytes
$video_intro = $cv->video['Video_Intro'];    //text
$video_class = $cv->video['Classification'];    //varchar 30 bytes
$video_path = $cv->video['Path'];     //varchar 20 bytes
$video_watch = $cv->video['Video_Watch_Num'];    //int
$upload_date = $cv->video['Video_Date'];    //timestamp
$cv->connect = NULL;