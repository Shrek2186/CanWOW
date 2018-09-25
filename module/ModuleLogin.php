<?php

include_once "../control/ControlMember.php";

use shrek\ControlMember as CM;

$cm = new CM();
$email = $_POST['email'];
$password = $_POST['password'];
$login_message = $cm->Login($email, $password);
echo $login_message;

echo dirname(__FILE__);
echo '<br><br>';
echo $_SERVER['DOCUMENT_ROOT'];
