<?php
require_once('../database/good_open.php');
//取得作為存入package欄位所需的間隔代碼(i.e.這個代碼區隔開不同的資訊單元)
$Package_Index = 'u3h_m_5a1';
//商品ID
//$length預設為10，更改此數值可以改變亂數的位數----(程式範例-PHP教學)
$Good_ID = NULL;
$length = 6;
//FOR回圈以$$length為判斷執行次數
for ($i = 1; $i <= $length; $i = $i + 1) {
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
    $Good_ID = $Good_ID . $b;
}
//  --------End------------

// -----Good_Package------
echo $Package_Index . '<br>';
print_r($_POST['Pack_Name']);
$Package_str = '0';
foreach ($_POST['Pack_Name'] as $index => $pack_name) {
    echo $pack_name . '<br>';
    echo $_POST['Pack_Price'][$index] . '<br>';
    echo $_POST['Pack_Num'][$index] . '<br>';
    echo nl2br($_POST['Pack_Intro'][$index]) . '<br>';
    $Package_str = $Package_str . $Package_Index . $pack_name . $Package_Index . $_POST['Pack_Price'][$index] . $Package_Index . $_POST['Pack_Num'][$index] . $Package_Index . $_POST['Pack_Intro'][$index];
}
echo $Package_str . '<br>';
$member = $_SESSION['member']['Email'];
$sql = "INSERT INTO `good_info` (`Good_ID`,`Good_Price`,`Good_Num`, `Seller`, `Good_Name`, `Good_Package`, `Good_text_intro`)   
        VALUES ('$Good_ID','$_POST[Good_Price]','$_POST[Good_Num]','$member','$_POST[Good_Name]','$Package_str','$_POST[Good_Intro]')";
echo $sql . '<br>';
$result = mysqli_query($good_link, $sql);
if ($result) {
    echo '商品上架成功!!';
} else {
    die('商品上架失敗!!');
}