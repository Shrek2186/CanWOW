<?php
require_once('database/play_list_open.php');
require_once('database/mem_info_open.php');
//echo $_GET['videoList'].'<br>';
//echo $_GET['Video_ID'].'<br>';
//echo $_GET['ori_pageLocation'].'<br>';

$videoList = NULL;
$videoID = NULL;
if(isset($_GET['videoList'])){
    $videoList = $_GET['videoList'];
    $videoID = $_GET['Video_ID'];
}
if(isset($_POST['videoList'])){
    $videoList = $_POST['videoList'];
    $videoID = $_POST['Video_ID'];
}


$sql = "SELECT `Video_ID` FROM `Play_list` WHERE `Play_List_ID` LIKE '$videoList'";
$result_1 = mysqli_query($member_link, $sql);
if($Show = $result_1->fetch_assoc()){
    $new_Video_ID_List = str_replace(','.$videoID,'',$Show['Video_ID']);
    $sql = "UPDATE `play_list` SET `Video_ID` = '$new_Video_ID_List', `Video_Contain_Num` = Video_Contain_Num-1 WHERE `Play_List_ID` = '$videoList';";
    $result = mysqli_query($member_link, $sql);
    if ($result) {
        if(isset($_GET['ori_pageLocation'])) {
            header('Location: ' . $_GET['ori_pageLocation']);
        }
        if(isset($_POST['videoList'])) {
            echo 1;
        }
    } else {
        if(isset($_GET['videoList'])) {
            die('刪除收藏影片失敗!!');
        }
        if(isset($_POST['videoList'])) {
            echo 0;
        }

    }
}else{
    die('搜尋收藏影片失敗!!');
}
