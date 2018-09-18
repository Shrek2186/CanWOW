<?php
include_once 'Connect.php';
include_once 'PDO_Function.php';
if (isset($_POST['Video_ID'])) {
    $Video = '../source/video/' . $_POST['Video_ID'] . '.mp4';
    $Screenshot = '../source/image/video_img/' . $_POST['Video_ID'] . '.png';
    unlink($Video);
    unlink($Screenshot);
    $Video_Connect = new PDO_Function('', $Connect);
    $Video_Connect ->Delete_Video($_POST['Video_ID']);
    echo(1);
} else {//上傳後影片存放的資料夾，$_COOKIE['Origin'] ：修改前之影片名稱
    $Video = '../source/video/' . $_COOKIE['Origin'];
    $Screenshot = '../../source/image/video_img/' . $_COOKIE['Video_ID'] . '.png';
    unlink($Video);
    unlink($Screenshot);
}

$Connect = NULL;
