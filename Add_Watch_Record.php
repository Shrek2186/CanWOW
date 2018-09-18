<?php
require_once("database/mem_info_open.php");
require_once("database/video_open.php");
$Email = $_POST['Email'];
$Video_ID = $_POST['Video_ID'];
$Duration = $_POST['Duration'];
$Query = $_POST['Query'];
// <===========================新增一筆用戶觀看紀錄===============================>
if ($Email != "Visitor") {   // 判斷用戶是否為會員
    if (empty($Query)) {    // 判斷是否為搜尋後得出的結果
        $sql = "INSERT INTO `watch_record`(`Email`,`Video_ID`,`Watch_Duration`) VALUES ('$Email','$Video_ID','$Duration')";     // 會員: 是 ， 搜尋: 否
    } else {
        $sql = "INSERT INTO `watch_record`(`Email`,`Keyword`,`Video_ID`,`Watch_Duration`) VALUES ('$Email','$Query','$Video_ID','$Duration')";     // 會員: 是 ， 搜尋: 是
    }
} else {
    if (empty($Query)) {    // 判斷是否為搜尋後得出的結果
        $sql = "INSERT INTO `watch_record`(`Video_ID`,`Watch_Duration`) VALUES ('$Video_ID','$Duration')";     // 會員: 否 ， 搜尋: 否
    } else {
        $sql = "INSERT INTO `watch_record`(`Keyword`,`Video_ID`,`Watch_Duration`) VALUES ('$Query','$Video_ID','$Duration')";     // 會員: 否 ， 搜尋: 是
    }
}
$result_insert_watch_record = mysqli_query($member_link, $sql);
// <===========================更新影片觀看總時長===============================>
$sql = "UPDATE `statistics` SET `Total_Watch_Duration` = `Total_Watch_Duration` + $Duration WHERE `Video_ID` LIKE '$Video_ID'";
$result_update_duration = mysqli_query($video_link, $sql);

if (!((isset($result_insert_watch_record) && $result_insert_watch_record) || !isset($result_insert_watch_record))) {
    echo 1;
} elseif (!$result_update_duration) {
    echo $Duration;
} else {
    echo 3;
}
