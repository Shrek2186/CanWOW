<?php
session_start();
include_once "module/ModuleVideoInfo.php";
include_once "module/ModuleMemberInfo.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>CanWOW</title>
    <?php include_once "common/web_header.php"; ?>
    <link rel="stylesheet" href="libs/css/design_videopage.css">
</head>
<body>
<!--登入頁面-->
<?php include_once "page_login.php"; ?>
<!--導覽列-->
<?php include_once "common/nav_top.php"; ?>
<!--工具列-->
<?php include_once "common/nav_left.php"; ?>
<!--影片頁面主內容-->
<div id="main-area">
    <?php include_once "content_videoplay.php" ?>
</div>
</body>
<!--網站頁尾-->
<?php include_once "common/web_footer.php"; ?>
<?php include_once "js_For_Video_Play.php"; ?>
</html>