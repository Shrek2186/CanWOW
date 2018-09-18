<?php
require_once ('database/mem_info_open.php');
require_once ('database/play_list_open.php');
//echo $_POST['member_Email'].'<br>';
//echo $_POST['Video_List_Name'].'<br>';

//  --------資料表的名稱，之後應確保ID不會相同，此程式碼為暫用------------
//---取得id(亂數)---
//$random預設為10，更改此數值可以改變亂數的位數----(程式範例-PHP教學)
$random=6;
$randoma = null;
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
    $randoma=$randoma.$b;
}
echo $randoma;
//  --------End------------

$sql = "INSERT INTO `play_list` (`Play_List_ID`, `Email`, `Play_List_Name`, `Video_ID`)
        VALUES ('$randoma', '$_POST[member_Email]', '$_POST[Video_List_Name]', '0')";
//echo $sql;
//echo $sql.'<br>';
$result = mysqli_query($member_link, $sql);     //執行sql
/*  新增撥放清單資料表的程式碼
$sql = "CREATE TABLE `$randoma` (
  `Video_ID` char(6) NOT NULL PRIMARY KEY,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
$result_create_table = mysqli_query($playList_link, $sql);
*/
if($result){
    ?>
    <script>
        window.location.replace('<?php echo $_POST['ori_pageLocation'];?>');
    </script>
    <?php
}else{
    die('資料新增失敗!!');
}
