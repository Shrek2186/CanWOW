<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'].'/canwow-server/'."control/ControlMember.php";
use shrek\ControlMember as CM;

$cm = new CM();
$email= $_POST['login_email'];
$password = $_POST['login_password'];
try{
    $login_message = $cm->ActionLogin($email,$password);
    echo $login_message; //echo 1 登入成功
}
catch (\PDOException $e) {
    echo "Select information failed: " . $e->getMessage();
}
