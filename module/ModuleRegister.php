<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . '/canwow-server/' . "control/ControlMember.php";

use shrek\ControlMember as CM;
$cm = new CM();

//Receive Post Data
$email = $_POST['register_email'];
$password = $_POST['register_password'];
$last_name = $_POST['last_name'];
$first_name = $_POST['first_name'];
$birth = $_POST['year'] . "-" . $_POST['month'] . "-" . $_POST['day'];
$phone = $_POST['phone'];

try {
    $register_message = $cm->ActionRegister($email, $password, $last_name, $first_name, $birth, $phone);
    echo $register_message; //echo 1 註冊成功
} catch (\PDOException $e) {
    echo "Select information failed : " . $e->getMessage();
}
