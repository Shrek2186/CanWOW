<?php
require_once "database/video_open.php";
require_once "database/mem_info_open.php";
echo $_POST['Sharer'] . '<br>';
echo $_POST['Video_ID'] . '<br>';
echo $_POST['Video_Name'] . '<br>';
echo $_POST['Share_Receiver'] . '<br>';
echo $_POST['Share_Content'] . '<br>';

//寫進分享資料庫
$sql = "SELECT `Email` FROM `mem_info` WHERE `Email` LIKE '$_POST[Share_Receiver]'";
if ($result = mysqli_query($member_link, $sql)) {
    if ($result->fetch_assoc()) {
        if (isset($_POST['Share_Content'])) {
            $sql = "INSERT INTO `share`(`Sharer`,`Video_ID`,`Receiver`,`Content`) VALUES ('$_POST[Sharer]','$_POST[Video_ID]','$_POST[Share_Receiver]','$_POST[Share_Content]')";
        } else {
            $sql = "INSERT INTO `share`(`Sharer`,`Video_ID`,`Receiver`) VALUES ('$_POST[Sharer]','$_POST[Video_ID]','$_POST[Share_Receiver]')";
        }

        if (mysqli_query($video_link, $sql)) {
            echo "新增分享資料成功!!";
        } else {
            echo "新增分享失敗" . '<br>';
            echo $sql;
        }
    } else {
        echo '無此用戶!!';
    }
} else {
    echo "搜尋被分享者失敗!!";
    echo $sql;
}

//傳送分享到事件(待續)

$Share_Index = 'u3h_m_5a1';
//---取得id(亂數)---
//$random預設為10，更改此數值可以改變亂數的位數----(程式範例-PHP教學)
$random = 6;
$Event_ID = null;
//FOR回圈以$random為判斷執行次數
for ($i = 1; $i <= $random; $i = $i + 1) {
    //亂數$c設定三種亂數資料格式大寫、小寫、數字，隨機產生
    $c = rand(1, 3);
    //在$c==1的情況下，設定$a亂數取值為97-122之間，並用chr()將數值轉變為對應英文，儲存在$b
    if ($c == 1) {
        $a = rand(97, 122);
        $b = chr($a);
    }
    //在$c==2的情況下，設定$a亂數取值為65-90之間，並用chr()將數值轉變為對應英文，儲存在$b
    if ($c == 2) {
        $a = rand(65, 90);
        $b = chr($a);
    }
    //在$c==3的情況下，設定$b亂數取值為0-9之間的數字
    if ($c == 3) {
        $b = rand(0, 9);
    }
    //使用$randoma連接$b
    $Event_ID = $Event_ID . $b;
}
echo $Event_ID;
//  --------End------------
// $Share_str : 1.分享的影片ID 2.分享的影片名字 3.分享者寫的話
$Share_str = '0' . $Share_Index . $_POST['Video_ID'] . $Share_Index . $_POST['Video_Name'] . $Share_Index . $_POST['Share_Content'];
$sql = "INSERT INTO `event` (`Event_ID`,`Email`,`Requester`,`Content`,`Status`,`Event_Type`) VALUE ('$Event_ID','$_POST[Share_Receiver]','$_POST[Sharer]','$Share_str',0,3)";
if (mysqli_query($member_link, $sql)) {
    echo "新增分享訊息資料庫成功!!";
} else {
    echo "新增分享訊息資料庫失敗!!";
}