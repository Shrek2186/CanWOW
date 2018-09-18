<?php
require_once('database/mem_info_open.php');
require_once('database/video_open.php');
require_once('database/good_open.php');
$Request_Index = 'u3h_m_5a1';

$b_date = $_POST['b_year'] . "-" . $_POST['b_month'] . "-" . $_POST['b_date'];
$e_date = $_POST['e_year'] . "-" . $_POST['e_month'] . "-" . $_POST['e_date'];

//---取得id(亂數)---
//$random預設為10，更改此數值可以改變亂數的位數----(程式範例-PHP教學)
$random=6;
$Event_ID = null;
//FOR回圈以$random為判斷執行次數
for ($i=1;$i<=$random;$i=$i+1)
{
    //亂數$c設定三種亂數資料格式大寫、小寫、數字，隨機產生
    $c=rand(1,3);
    //在$c==1的情況下，設定$a亂數取值為97-122之間，並用chr()將數值轉變為對應英文，儲存在$b
    if($c==1){$a=rand(97,122);$b=chr($a);}
    //在$c==2的情況下，設定$a亂數取值為65-90之間，並用chr()將數值轉變為對應英文，儲存在$b
    if($c==2){$a=rand(65,90);$b=chr($a);}
    //在$c==3的情況下，設定$b亂數取值為0-9之間的數字
    if($c==3){$b=rand(0,9);}
    //使用$randoma連接$b
    $Event_ID=$Event_ID.$b;
}
echo $Event_ID;
//  --------End------------
/*
echo $_POST['Requester'].'<br>';
echo $_POST['Video_ID'].'<br>';
echo $_POST['Good_ID'].'<br>';
echo nl2br($_POST['Contract']).'<br>';
echo $b_date.'<br>';
echo $e_date.'<br>';
*/
$sql = "SELECT `Good_Name` FROM `good_info` WHERE `Good_ID` LIKE '$_POST[Good_ID]'";
if ($result = mysqli_query($good_link, $sql)) {
    if ($Good_info = $result->fetch_assoc()) {
    } else {
        echo '查不到此商品!!';
    }
} else {
    die('搜尋商品名稱失敗!!');
}
// req_str : 1.代言的商品ID 2.代言的商品名字 3.請求的影片ID 4.請求的影片名字 5.合約 6.開始時間 7.結束時間 8.Event_ID
$req_str = $Request_Index . $_POST['Good_ID'] . $Request_Index . $Good_info['Good_Name'] . $Request_Index . $_POST['Video_ID'] . $Request_Index . $_POST['Video_Name'] . $Request_Index . $_POST['Contract'] . $Request_Index . $b_date . $Request_Index . $e_date . $Request_Index . $Event_ID;
//echo $req_str.'<br>';

$sql = "SELECT `Video_Uploader` FROM `video_info` WHERE `Video_ID` LIKE '$_POST[Video_ID]'";
echo $sql;
$result = mysqli_query($video_link, $sql);

if ($result && $Video_info = $result->fetch_assoc()) {
    $sql = "SELECT `Video_ID` FROM `advertisement` WHERE `Video_ID` LIKE '$_POST[Video_ID]' AND `Good_ID` LIKE '$_POST[Good_ID]'";
    $result = mysqli_query($video_link, $sql);
    if (!$result->fetch_assoc()) {    //判斷影片與商品有無合約
        $sql = "INSERT INTO `advertisement` (`Ad_ID`,`Video_ID`,`Good_ID`,`Ad_Contract`,`Begin_date`,`End_date`) VALUE ('$Event_ID','$_POST[Video_ID]','$_POST[Good_ID]','$_POST[Contract]','$b_date','$e_date')";
        if ($result = mysqli_query($video_link, $sql)) {
            $req_str = '0'.$req_str;
            $sql = "INSERT INTO `event` (`Event_ID`,`Email`,`Requester`,`Content`,`Status`,`Event_Type`) VALUE ('$Event_ID','$Video_info[Video_Uploader]','$_POST[Requester]','$req_str',0,1)";
            echo $sql . '<br>';
            if ($result = mysqli_query($member_link, $sql)) {
                echo '新增上傳者事件成功!!';
                header("Location: video_play.php?v=$_POST[Video_ID]");
            } else {
                die('新增上傳者事件失敗');
            }
        } else {
            die('新增廣告失敗!!');
        }
    } else {
        echo '此商品與此影片已有合約咯~';
    }
} else {
    die('搜尋影片上傳者失敗或無此上傳者!!');
}

