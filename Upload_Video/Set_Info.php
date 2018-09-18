<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once 'Connect.php';
include_once 'PDO_Function.php';
include_once '../database/mem_info_open.php';
require_once '../database/video_open.php';
//上傳後影片存放的資料夾，$_COOKIE['Origin'] ：修改前之影片名稱
$Video_Path = '../source/video/' . $_COOKIE['Origin'];
//上傳的影片類型（.mp4）
$File_Type = explode('.', $_COOKIE['Origin']);
//檢查矩陣最後一個元素
$Comma = count($File_Type) - 1;
//根據Video_ID所產生的新名字
$New_Name = $_COOKIE['Video_ID'] . '.' . $File_Type["$Comma"];
//上傳者Email
$uploader = $_SESSION['member']['Email'];
//修改名稱
if (rename($Video_Path, '../source/video/' . $New_Name)) {
    //PDO_Function(上傳者帳號,連接子)
    //上傳者帳號可以傳入session或是cookie
    $Video_Connect = new PDO_Function($uploader, $Connect);
    //Save_Video(使用者輸入新的影片名稱, 亂數 Video_ID, 影片類型)
    $Video_Connect->Save_Video($_COOKIE['Video_ID'], $_POST['Rename'], $File_Type["$Comma"], $_POST['Describe']);
} else {
    echo('修改名稱失敗');
}
$member = $_SESSION['member']['Email'];

$sql = "SELECT `Email` FROM `video_uploader` WHERE `Email` LIKE '$member'";
echo $sql;
if ($result = mysqli_query($member_link, $sql)) {
    if ($result->fetch_assoc()) {
        echo('上傳成功！');
        echo '<meta http-equiv=\'Refresh\' content=\'3,Index.php\'>';
    } else {
        $sql = "INSERT INTO `video_uploader` (`Email`) VALUE ('$member')";
        if ($result = mysqli_query($member_link, $sql)) {
            echo('上傳成功！');
            echo '<meta http-equiv=\'Refresh\' content=\'3,Index.php\'>';
        } else {
            die('影片上傳者資料新增失敗!!');
        }
    }
}else{
    die('搜尋資料庫失敗!!');
}

//-----------新增影片統計資料表----------------
$sql = "INSERT INTO `statistics`(`Video_ID`) VALUES ('$_COOKIE[Video_ID]')";
$result = mysqli_query($video_link,$sql);
if(!$result){
    echo "<br>新增影片統計資料標失敗!!<br>";
    echo $sql.'<br>';
}