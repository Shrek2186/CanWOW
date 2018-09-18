<?php
require_once ('database/video_open.php');
require_once ('database/mem_info_open.php');

$Request_Index = 'u3h_m_5a1';
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
echo $_POST['Event_ID'].'<br>';
echo $_POST['Deliver'].'<br>';
echo $_POST['Receiver'].'<br>';
echo $_POST['Video_ID'].'<br>';
echo $_POST['Good_ID'].'<br>';
// req_str : 1.是否接受 2.
$req_str = '0';
if (isset($_POST['accept'])) {
    $req_str = $req_str.$Request_Index.'接受'.$Request_Index.$_POST['Event_ID'];
    echo '接受'.'<br>';
    $sql = "UPDATE `advertisement` SET `Ad_Level` = 1 WHERE `Video_ID` LIKE '$_POST[Video_ID]' AND `Good_ID` LIKE '$_POST[Good_ID]'";   // 開啟廣告合約
    if($result = mysqli_query($video_link,$sql)){
        $sql = "INSERT INTO `event` (`Event_ID`, `Email`, `Requester`, `Content`, `Status`, `Event_Type`) VALUE ('$Event_ID','$_POST[Receiver]','$_POST[Deliver]','$req_str',0,2)";
        if ($result = mysqli_query($member_link,$sql)){
            echo '已接受代言邀請~';
        }else{
            die('接受代言交請人失敗');
        }

        $sql = "UPDATE `event` SET `Status` = 2 WHERE `Event_ID` LIKE '$_POST[Event_ID]'";
        if ($result = mysqli_query($member_link,$sql)){
            echo '修改事件狀態成功!!';
        }else{
            die('修改事件狀態失敗!!');
        }
    }else{
        die('開啟廣告合約失敗!!');
    }

} else if (isset($_POST['refuse'])) {
    $req_str = $req_str.$Request_Index.'拒絕'.$Request_Index.$_POST['Event_ID'];
    echo '拒絕'.'<br>';
    $sql = "DELETE FROM `advertisement` WHERE `Video_ID` LIKE '$_POST[Video_ID]' AND `Good_ID` LIKE '$_POST[Good_ID]'";   // 開啟廣告合約
    if($result = mysqli_query($video_link,$sql)){
        $sql = "INSERT INTO `event` (`Event_ID`, `Email`, `Requester`, `Content`, `Status`, `Event_Type`) VALUE ('$Event_ID','$_POST[Receiver]','$_POST[Deliver]','$req_str',0,2)";
        if ($result = mysqli_query($member_link,$sql)){
            echo '已拒絕代言邀請 QQ';
        }else{
            die('拒絕代言交請人失敗');
        }

        $sql = "UPDATE `event` SET `Status` = 3 WHERE `Event_ID` LIKE '$_POST[Event_ID]'";
        if ($result = mysqli_query($member_link,$sql)){
            echo '修改事件狀態成功!!';
        }else{
            die('修改事件狀態失敗!!');
        }
    }else{
        die('刪除廣告合約失敗!!');
    }
} else {
    echo '沒按按鈕'.'<br>';
}