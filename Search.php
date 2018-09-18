<?php //include ('Navigation.php')?>
<?php
if (!isset($_SESSION)) {
    session_start();
}
//session_destroy();        //測試用(暫時拿來當刪除鍵)
require_once('database/video_open.php');
require_once('database/mem_info_open.php');
if (isset($_SESSION['member']['Email'])) {
    $User_ID = $_SESSION['member']['Email'];            //得到目前使用者的ID
    //echo $User_ID . '<br>'; 顯示使用者ID(測試用)
}
$Keywords = explode(" ", trim($_GET["Search_Text"]));     //取得使用者所下關鍵字，若Keywords有空格則分割，trim()用來刪除字串前後空白

//print_r($Keywords); //顯示關鍵字(測試用)

//--------------新增一筆搜尋紀錄--------------
$query = $_GET["Search_Text"];
if (isset($_SESSION['member']['Email'])) {  //是否為會員
    $Email = $_SESSION['member']['Email'];
    $sql = "INSERT INTO `search_record`(`Email`,`Keywords`) VALUES ('$Email','$query')";
} else {
    $sql = "INSERT INTO `search_record`(`Keywords`) VALUES ('$query')";
}
$Result = mysqli_query($member_link, $sql);
if (!$Result) {
    echo "新增搜尋紀錄失敗!!" . '<br>';
    echo $sql . '<br>';
}
//------------搜尋---------------
$i = 0;
$sql_Where = "";
foreach ($Keywords as $k) {         //從member資料庫找出使用者專屬的關鍵字之標籤辭典(即此關鍵字對這個使用者來說可能是想搜什麼標籤)
    //--------------建立SQL搜尋命令---------------
    if ($i == 0) {
        //搜尋項目 : 1.影片標題 2.影片標籤 3.影片分類(20180729) 4.影片上傳者_外國姓(20180729) 5.影片上傳者_中國姓(20180729)
        $sql_Where .= "UPPER(video_info.Video_Name) LIKE UPPER('%" . $k . "%') 
                        OR UPPER(video_tag.Tag_Name) LIKE UPPER('%" . $k . "%')
                        OR UPPER(video_info.Classification) LIKE UPPER('%" . $k . "%')
                        OR UPPER(CONCAT(member.mem_info.First_name,member.mem_info.Last_name)) LIKE UPPER('%" . $k . "%')
                        OR UPPER(CONCAT(member.mem_info.Last_name,member.mem_info.First_name)) LIKE UPPER('%" . $k . "%')";
    } else {
        $sql_Where .= " OR UPPER(video_info.Video_Name) LIKE UPPER('%" . $k . "%') 
                        OR UPPER(video_tag.Tag_Name) LIKE UPPER('%" . $k . "%')
                        OR UPPER(video_info.Classification) LIKE UPPER('%" . $k . "%')
                        OR UPPER(member.mem_info.First_name) LIKE UPPER('%" . $k . "%')
                        OR UPPER(CONCAT(member.mem_info.First_name,member.mem_info.Last_name)) LIKE UPPER('%" . $k . "%')
                        OR UPPER(CONCAT(member.mem_info.Last_name,member.mem_info.First_name)) LIKE UPPER('%" . $k . "%')";
    }
    $i = $i + 1;
}

$sql = 'SELECT distinct video_info.Video_ID, video_info.Video_Name, video_info.Video_Date, statistics.Video_Watch_Num, statistics.sum_guest_book, Video_Type, Path,
        statistics.sum_guest_reply, statistics.feeling_sum_like, statistics.feeling_sum_dislike, statistics.feeling_sum_heart, statistics.feeling_sum_happy, 
        statistics.feeling_sum_shock, statistics.feeling_sum_angry,statistics.feeling_sum_sad 
        FROM `video_info` LEFT JOIN `video_tag` ON 
        video_info.Video_ID = video_tag.Video_ID LEFT JOIN `statistics` ON video_info.Video_ID = statistics.Video_ID LEFT JOIN member.mem_info ON video_info.Video_Uploader = member.mem_info.Email 
        WHERE ' . $sql_Where . ' 
        ORDER BY video_info.Video_Date DESC';

//echo '<br>' . $sql . '<br>'; //顯示sql語法(測試用)

$Result = mysqli_query($video_link, $sql);
$Result_Sort = NULL;
if ($Result) {
    //echo '資料庫連結成功!!' . '<br>'; //顯示連接資料庫結果(測試用)
    $i = 0;
    while ($Show = $Result->fetch_assoc()) {
        $Result_Sort[$i] = $Show;
        $i = $i + 1;
    }
    if ($Result_Sort) {
        echo '共有' . count($Result_Sort) . '筆資料' . '<br>';
        //print_r($Result_Sort);    //顯示搜尋結果(測試用)
        echo '<br>';
    } else {
        echo '很抱歉，並沒有找到符和搜尋的標題' . '<br>';
    }
} else {
    echo '資料庫連結失敗!!<br>';
    echo $sql;
}
//------------排序---------------
//echo '<br>========================排序前=========================<br>';
$i = 0;
//----------各屬性權重------------------
$Weight_like = 1;
$Weight_dislike = -0.5;
$Weight_heart = 1;
$Weight_happy = 1;
$Weight_shock = 0.5;
$Weight_angry = -0.5;
$Weight_sad = -0.5;
$Weight_Watch_Sum = 1.5;
$Weight_Guest_book_Sum = 1.5;
$Weight_Guest_book_Reply_Sum = 1;
//-----------計算分數------------------
if ($Result_Sort) {
    foreach ($Result_Sort as $r) {
        //echo '<br>------第' . ($i + 1) . '筆資料------<br>'; 顯示資料筆數(測試用)
        //--------顯示影片資料---------
        //print_r($r); //顯示陣列(測試用)
        //echo '<br>';
        //------計算分數--------
        $Result_Sort[$i]['Score'] = $r['Video_Watch_Num'] * $Weight_Watch_Sum + $r['sum_guest_book'] * $Weight_Guest_book_Sum +
            $r['sum_guest_reply'] * $Weight_Guest_book_Reply_Sum + $r['feeling_sum_like'] * $Weight_like + $r['feeling_sum_dislike'] * $Weight_dislike + $r['feeling_sum_heart'] * $Weight_heart +
            $r['feeling_sum_happy'] * $Weight_happy + $r['feeling_sum_shock'] * $Weight_shock + $r['feeling_sum_angry'] * $Weight_angry + $r['feeling_sum_sad'] * $Weight_sad;
        $i = $i + 1;
    }
//-----------依分數進行排序(泡沫排序)------------------
    for ($i = 0; $i < count($Result_Sort); $i++) {
        for ($j = $i; $j < count($Result_Sort); $j++) {
            if ($Result_Sort[$j]['Score'] > $Result_Sort[$i]['Score']) {
                $Change = $Result_Sort[$j];
                $Result_Sort[$j] = $Result_Sort[$i];
                $Result_Sort[$i] = $Change;
            }
        }
    }
    /*-----------排序後結果呈現(測試用)--------------
    echo '<br>========================排序後=========================<br>';
    $i = 0;
    foreach ($Result_Sort as $r) {
        echo '<br>------第' . ($i + 1) . '筆資料------<br>';
        //--------顯示影片資料---------
        print_r($r);
        echo '<br>';
        $i = $i + 1;
    }*/
}
?>
<!DOCTYPE html>
<html>
<title>ConWOW</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>
<?php //--------------結果呈現--------------
if ($Result_Sort) {
    foreach ($Result_Sort as $r) {
        ?>
        <form id="<?php echo $r['Video_ID']?>" method="post" action="video_play.php?v=<?php echo $r['Video_ID'] ?>">
            <input type="hidden" id="Query" name="Query" value="<?php echo $_GET["Search_Text"]; ?>"/>
            <a onclick="document.getElementById('<?php echo $r["Video_ID"]?>').submit();" style="cursor: pointer">
                <div class="w3-container" style="width:33%;height: 400px;float: left" >
                    <div class="w3-card-4" >
                        <?php if ($r['Video_Type'] == 'Youtube') {
                            ?>
                            <img src="https://img.youtube.com/vi/<?php echo $r['Path']; ?>/sddefault.jpg" alt="Norway"
                                 style="width:100%">
                            <?php
                        } else { ?>
                            <img src="source/image/video_img/<?php echo $r['Video_ID'] ?>.png" alt="Norway"
                                 style="width:100%">
                            <?php
                        } ?>
                        <div class="w3-container w3-center">
                            <p style="height: 10%"><?php echo $r['Video_Name'] ?></p>
                        </div>
                        <div>
                            <p>$ 490 NT</p>
                        </div>
                    </div>
                </div>
            </a>
        </form>
        <?php
    }
}
?>
</body>
</html>



