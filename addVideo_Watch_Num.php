<?php
require_once ('database/video_open.php');

$sql = "UPDATE `statistics` SET Video_Watch_Num = Video_Watch_Num+1 WHERE `Video_ID` LIKE '$_POST[Video_ID]'";
$result = mysqli_query($video_link, $sql);
if ($result){
    echo 1;
}else{
    echo 0;
}