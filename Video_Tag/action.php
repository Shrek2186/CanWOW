<?php
include 'header.php';
$Tag->Name = $_POST['Input_Tag'];
$Tag->Video_ID = $_POST['Video_ID'];
$Tag->save();
header("Location: ../video_play.php?v=" . $_POST['Video_ID']);