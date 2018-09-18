<?php
require_once ('database/mem_info_open.php');
require_once ('database/play_list_open.php');
$sql = "DELETE FROM `play_list` WHERE `Play_list_ID` LIKE '$_POST[playList]'";
$result_data = mysqli_query($member_link, $sql);
/*
$sql = "DROP TABLE $_POST[playList]";
$result_table = mysqli_query($playList_link, $sql);
*/
if($result_data){
    echo 1;
}else{
    echo 0;
}
