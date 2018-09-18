<?php
//  開啟SESSION
if (!isset($_SESSION)) {
    session_start();
}
require_once('../database/mem_info_open.php');     // 建立member的資料庫連接
$Email = $_POST['Email'];
$Password = $_POST['Password'];
$sql = "SELECT `Email`,`password`,`Last_name`,`First_name`,`Birthday`,`Phone` FROM `mem_info` WHERE `Email` LIKE '$Email'";
//echo $sql.'</br>';    測試用
$result = mysqli_query($member_link, $sql);
if ($result) {
    if ($Show = $result->fetch_assoc()) {
        if ($Password == $Show['password']) {
            echo 1;
            $_SESSION['member'] = array();
            $_SESSION['member']['Email'] = $Show['Email'];
            $_SESSION['member']['password'] = $Show['password'];
            $_SESSION['member']['L_name'] = $Show['Last_name'];
            $_SESSION['member']['F_name'] = $Show['First_name'];
            $_SESSION['member']['birthday'] = $Show['Birthday'];
            $_SESSION['member']['phone'] = $Show['Phone'];
        } else {
            echo 3;
        }
    } else {
        echo 2;
    }
} else {
    echo 4;
}
//echo ;    回傳是用echo而不是return