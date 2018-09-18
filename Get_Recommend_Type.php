<?php
header('Content-Type: application/json');

require_once('database/mem_info_open.php');
$Recommend_Type = array();
$Back_Recommend_Type = array();
$Back_Type_Num = 3;    //一次回傳三筆推薦型態
$Back_Recommend_Type_index = 3*$_GET['Page_Num'] - 3;
$Recommend_Type[0] = '熱門';
$Recommend_Type[1] = '最新';

if (isset($_SESSION['member']['Email'])) {      // 會員的個人化推薦型態
    $Email = $_SESSION['member']['Email'];

    //------------使用者所訂閱的頻道主--------------------
    $sql = "SELECT `Channel_Master` FROM `subscription` WHERE `Subscriber` LIKE '$Email'";

    $result = mysqli_query($member_link, $sql);
    if ($result) {

        while ($Show = $result->fetch_assoc()) {     //當推薦型態為三筆以後跳出迴圈
            $Recommend_Type[count($Recommend_Type)] = '訂閱 ' . $Show['Channel_Master'];
        }
    } else {
        echo $sql . '<br>';
        die('搜尋使用者訂閱清單失敗!!');
    }
    //-------------熱門標籤------------------
}

// <=========================推薦型態產生 結束============================>

//print_r($Recommend_Type);
//echo '<br>';

//----------從所有的推薦陣列中根據當前要加載的頁數決定取出多少筆放入回傳陣列中------------
while (count($Back_Recommend_Type) < $Back_Type_Num && count($Recommend_Type) >= $Back_Recommend_Type_index+1){
    $Back_Recommend_Type[count($Back_Recommend_Type)] = $Recommend_Type[$Back_Recommend_Type_index];
    $Back_Recommend_Type_index = $Back_Recommend_Type_index + 1;
}

//---------當已經沒有可以取的元素後放結束記號-----------------
while (count($Back_Recommend_Type) < 3) {     //當推薦型態小於三筆表示之後已經沒有可以推薦的東西了
    $Back_Recommend_Type[count($Back_Recommend_Type)] = 'ao6xk7'; // '沒了' 的英文XD
}
//print_r($Back_Recommend_Type);
//echo '<br>';
echo json_encode($Back_Recommend_Type);