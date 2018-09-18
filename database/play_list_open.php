<?php
$playList_link = @mysqli_connect("localhost", "root", "") or die("無法開啟資料庫!!");
mysqli_select_db($playList_link, "play_list");
mysqli_query($playList_link, 'SET NAMES utf8');