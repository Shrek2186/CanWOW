<?php
require_once ('../database/video_open.php');
// 更新廣告點擊率(+1)
$AD_ID = $_POST['AD_ID'];
$sql = "UPDATE `advertisement` SET Clickthrough = Clickthrough+1 WHERE Ad_ID LIKE '$AD_ID'";
$update_videoInfo_result = mysqli_query($video_link, $sql);

// 新增廣告點擊紀錄
if(isset($_POST['Member'])){
    $member = $_POST['Member'];
    $sql = "INSERT INTO `ad_record`(`Ad_ID`, `Email`) VALUES ('$AD_ID', '$member')";
}else{
    $sql = "INSERT INTO `ad_record`(`Ad_ID`) VALUES ('$AD_ID')";
}
$insert_adRecord_result = mysqli_query($video_link, $sql);

if($update_videoInfo_result && $insert_adRecord_result){
    echo 1;
}else{
    echo 0;
}