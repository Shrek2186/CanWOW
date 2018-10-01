<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/canwow-server/' . "control/ControlMember.php";

use shrek\ControlMember as CM;

$cm = new CM();

$email = $_POST['register_email'];
$password = $_POST['register_password'];
$last_name = $_POST['last_name'];
$first_name = $_POST['first_name'];
$birth = $_POST['year'] . "-" . $_POST['month'] . "-" . $_POST['day'];
$phone = $_POST['phone'];

//echo $email."<br>";
//echo $password."<br>";
//echo $last_name."<br>";
//echo $first_name."<br>";
//echo $birth."<br>";
//echo $phone."<br>";
try {
    $register_message = $cm->register($email, $password, $last_name, $first_name, $birth, $phone, 1);
    echo $register_message;
} catch (\PDOException $e) {
    echo "Select information failed: " . $e->getMessage();
}

//header("Location: index.php");
