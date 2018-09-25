<?php

include_once "/control/ControlMember.php";
use shrek\ControlMember as CM;

$cm = new CM();
$email= $_POST['email'];
$password = $_POST['password'];
$login_message = $cm->Login($email,$password);
echo $login_message;