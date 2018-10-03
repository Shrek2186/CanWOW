<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . '/canwow-server/' . "control/ControlMember.php";

use shrek\ControlMember as CM;

$cm = new CM();
$title = $_POST['channel_title'];
$content = $_POST['channel_content'];
try {
    $channel_message = $cm->AddChannel($title,$content,$_COOKIE['memberID']);
    echo $channel_message; //echo 1 登入成功
} catch (\PDOException $e) {
    echo "Select information failed: " . $e->getMessage();
}
$cm->connect = NULL;
