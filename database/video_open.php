<?php
$video_link = @mysqli_connect("localhost", "root", "") or die("無法開啟資料庫!!");
mysqli_select_db($video_link, "video");
mysqli_query($video_link, 'SET NAMES utf8');