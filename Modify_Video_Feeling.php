<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once('database/video_open.php');

if ($member = $_SESSION['member']['Email']) {
//搜尋用戶是否有對此影片做過評價
    $sql = "SELECT `Feeling_Type` FROM `feeling` WHERE `Email` LIKE '$member' AND `Video_ID` LIKE '$_POST[Video_ID]'";
    if($result = mysqli_query($video_link, $sql)){
        if($felling = $result->fetch_assoc()){
            //判斷用戶所選評價是否與之前選擇評價相同
            if($felling['Feeling_Type'] == $_POST['Fell_type']){
                $sql = "DELETE FROM `feeling` WHERE `Email` LIKE '$member' AND `Video_ID` LIKE '$_POST[Video_ID]'";     //相同則表示用戶欲刪除評價紀錄
            }else{
                $sql = "UPDATE `feeling` SET `Feeling_Type` = '$_POST[Fell_type]' WHERE `Email` LIKE '$member' AND `Video_ID` LIKE '$_POST[Video_ID]'"; //相同則表示用戶欲修改評價紀錄
            }
        }else{
            $sql = "INSERT INTO `feeling`(`Video_ID`, `Email`, `Feeling_Type`) VALUES ('$_POST[Video_ID]', '$member', '$_POST[Fell_type]')";    //若無表示//相同則表示用戶欲新增評價紀錄
        }

        if($result = mysqli_query($video_link, $sql)){
            echo 1;
        }else{
            echo 0;
        }
    }else{
        echo 0;
    }
}else{
    echo 0;
}