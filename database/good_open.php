<?php
$good_link = @mysqli_connect("localhost", "root", "") or die("無法開啟資料庫!!");
mysqli_select_db($good_link, "good");
mysqli_query($good_link, 'SET NAMES utf8');