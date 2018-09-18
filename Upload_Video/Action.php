<meta charset="UTF-8">
<?php
include_once 'Random.php';
foreach ($_FILES['Video']['error'] as $Key => $Error) {
    if ($Error == UPLOAD_ERR_OK) {
        $Tmp_Name = $_FILES['Video']['tmp_name'][$Key];
        $Name = basename($_FILES['Video']['name'][$Key]);
        move_uploaded_file($Tmp_Name, '../source/video/' . $Name);
        //設定原本的上傳影片名稱（修改前）
        setcookie('Origin', $Name, time() + 3600, '/');
        //儲存影片ID亂數
        setcookie('Video_ID', $Random, time() + 3600, '/');
    }
}