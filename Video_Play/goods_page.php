<?php
header('Content-Type: application/json');
require_once('../database/good_open.php');

$Video_ID = $_POST['Video_ID'];
$Index = $_POST['Index'];
$Max_Num = $_POST['Max_Num'];

$sql = "SELECT `Ad_ID`,`Clickthrough`,good.good_info.Good_ID,`Good_Name`,`Good_Price`,`Good_Count`,`Good_Buy`,`url`,`First_name` 
        FROM good.good_info RIGHT JOIN video.advertisement ON video.advertisement.Good_ID = good.good_info.Good_ID 
        LEFT JOIN member.mem_info ON good.good_info.Seller = member.mem_info.Email 
        WHERE `Video_ID` LIKE '$Video_ID' LIMIT $Index,$Max_Num";

$result = mysqli_query($good_link, $sql);

if ($result) {
    $i = 0;
    while ($Show = $result->fetch_assoc()) {
        $Good[$i] = $Show;
        $i = $i + 1;
    }
} else {
    die('搜尋代言商品失敗!!');
}
//echo $i;
//print_r($Good);
if (isset($Good)) {
    if (count($Good) < $Max_Num) {    //判斷是否已經沒商品了
        //echo '結束!!';
        $Good[$i]['Good_Count'] = 'ao6xk7';
    }
} else {
    $Good[$i]['Good_Count'] = 'ao6xk7';
}

//print_r($Good);

echo json_encode($Good);




