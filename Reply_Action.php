<?php
//連接資料庫
require_once ("Connect_Video.php");
//寫入資料庫
$sent = $Connect->prepare("INSERT INTO Guest_Book_Reply(Giver, Content, Guestbook_ID) VALUES (:gv, :ct, :id)");
$sent->bindValue(':gv', $_SESSION['member']['Email'], PDO::PARAM_STR);
$sent->bindValue(':ct', $_POST["Content"], PDO::PARAM_STR);
$sent->bindValue(':id', $_POST["Guestbook_ID"], PDO::PARAM_STR);
$sent->execute();
//寫入成功
echo("留言成功！");

header("Location: video_play.php?v=".$_POST['Video_ID']);