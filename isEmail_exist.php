<?php
// 此PHP檔用於註冊階段檢查Email有無被註冊過
//header("Content-Type: text/xml");   // XML文件
$Email = $_POST["Email"];   // 接收傳過來的Email(用戶註冊的Email)
require_once('database/mem_info_open.php');     // 建立member的資料庫連接

//--------------建立搜尋指令並發出請求-------------
$sql = "SELECT `Email` FROM `mem_info` WHERE `Email` LIKE '$Email'";
// echo "搜尋指令:" . $sql . "<br>";    測試用
$result = mysqli_query($member_link, $sql);
//--------------結束 建立搜尋指令並發出請求-------------
//--------------驗證信箱有無被註冊過------------
if ($result) {
    //echo "資料庫搜尋紀錄成功!" . "<br>";       測試用
    if ($result->fetch_assoc()) {
        echo true;
        //echo "此Email已被註冊過了" . "<br>";     測試用
    } else {
        echo false;
       //echo "此Email尚未被註冊" . "<br>";       測試用
    }
}
/*
else {
    echo "此Email尚未被註冊" . "<br>";
    die("資料庫搜尋紀錄失敗!<br/>");
}
*/
//--------------結束 驗證信箱有無被註冊過------------