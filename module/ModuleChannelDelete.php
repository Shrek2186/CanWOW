<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . '/canwow-server/' . "control/ControlMember.php";

use shrek\ControlMember as CM;

$cm = new CM();
$ID = $_POST['channelID'];

try {
    $delete_message = $cm->DeleteChannel($ID);
    echo $delete_message; //echo 1 登入成功
} catch (\PDOException $e) {
    echo "Select information failed: " . $e->getMessage();
}
$cm->connect = NULL;
