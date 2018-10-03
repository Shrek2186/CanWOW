<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/canwow-server/' . "control/ControlMember.php";

use shrek\ControlMember as CM;

$cm = new CM();
if (isset($_COOKIE['memberID'])) {
    $cm->SelectMember($_COOKIE['memberID']);
    $sticker = $cm->member['sticker'];
    $email = $cm->member['email'];
    $password = $cm->member['password'];
    $last_name = $cm->member['last_name'];
    $first_name = $cm->member['first_name'];
    $phone = $cm->member['phone'];
    $birth = $cm->member['birth'];
}

$cm->connect = NULL;


