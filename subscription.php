<?php
require_once("database/mem_info_open.php");
//echo '訂閱者: ' . $_POST['subscriber'] . '<br>';
//echo '頻道主: ' . $_POST['Channel_Master'] . '<br>';
//echo '影片: ' . $_POST['ori_videoID'] . '<br>';

$subscriber = $_POST['subscriber'];     //取得訂閱者Email
$Channel_Master = $_POST['Channel_Master'];     //取得被訂閱者Email

if($_POST['Sub_or_unSub'] == 1) {   //判斷是要進行訂閱還是取消訂閱。 0(取消訂閱) 1(訂閱)
    $sql_sub = "INSERT INTO `subscription`(`Subscriber`,`Channel_Master`) VALUES ('$subscriber','$Channel_Master')";    //訂閱
    $sql_sub_num = "UPDATE `video_uploader` SET Subscribed_Num = Subscribed_Num+1 WHERE `Email` LIKE '$Channel_Master'";
}else{
    $sql_sub = "DELETE FROM `subscription` WHERE `Subscriber` LIKE '$subscriber' AND `Channel_Master` LIKE '$Channel_Master'";  //取消訂閱
    $sql_sub_num = "UPDATE `video_uploader` SET Subscribed_Num = Subscribed_Num-1 WHERE `Email` LIKE '$Channel_Master'";
}
//echo $sql . '<br>';
$result = mysqli_query($member_link, $sql_sub); //執行sql命令
$result2 = mysqli_query($member_link, $sql_sub_num); //執行sql命令
if ($result && $result2) {
    echo "執行成功!!";
    ?>
    <script>
        window.location.replace('<?php echo $_POST['ori_pageLocation'];?>');
    </script>
    <?php
    //header('Location: ' . $_POST['ori_pageLocation']);  //返回之前頁面
}else{
    die('執行失敗!!');
}