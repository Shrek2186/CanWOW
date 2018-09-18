<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once('database/mem_info_open.php');     // 建立member的資料庫連接
$Email = $_POST['Email'];
$password = $_POST['password'];
$L_name = $_POST['L_name'];
$F_name = $_POST['F_name'];
$birthday = $_POST['b_year'] . "-" . $_POST['b_month'] . "-" . $_POST['b_date'];
$phone = $_POST['phone'];
$sql = "INSERT INTO `mem_info` (`Email`, `password`, `Last_name`, `First_name`, `Birthday`, `Phone`, `mem_Level`)   
        VALUES ('$Email', '$password', '$L_name', '$F_name', '$birthday', '$phone', '1')";      //建立'新增會員指令'
$result = mysqli_query($member_link, $sql);     //送出請求
$_SESSION['member'] = array();
$_SESSION['member']['Email'] = $Email;
$_SESSION['member']['password'] = $password;
$_SESSION['member']['L_name'] = $L_name;
$_SESSION['member']['F_name'] = $F_name;
$_SESSION['member']['birthday'] = $birthday;
$_SESSION['member']['phone'] = $phone;

header("Location: index.php");
/*
echo 'sent_registerForm.php !!' . "</br>";
echo $_POST['L_name'] . "</br>";
echo $_POST['F_name'] . "</br>";
echo $_POST['Email'] . "</br>";
echo $_POST['password'] . "</br>";
echo $_POST['phone'] . "</br>";
echo $_POST['b_year'] . "</br>";
echo $_POST['b_month'] . "</br>";
echo $_POST['b_date'] . "</br>";
echo $birthday . "</br>";
if ($member_link) {
    echo "member資料庫連結成功" . "<br>";
} else {
    echo "member資料庫連結失敗" . "<br>";
}
echo $sql . "</br>";
if ($result) {
    echo "資料庫新增紀錄成功!" . "<br>";
}else {
    die("資料庫新增紀錄失敗!<br/>");
}
*/

