<?php
require_once('../database/good_open.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>CanWOW</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--導覽列所需的連接資料--->
    <link rel='stylesheet' href='../Upload_Video/css_upload/dropzone.min.css'>
    <link rel="stylesheet" href="../css/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../plugins/venobox/venobox.css" type="text/css" media="screen"/>
    <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="../plugins/venobox/venobox.min.js"></script>

</head>
<body>
<div id="video_list" class="w3-main" style="margin-top:43px; z-index: 4;">
    <div id="myGood_page" class="w3-container page">
        <h1>拍賣頁面</h1>
        <?php
        $sql = "SELECT * FROM `good_info` WHERE `Good_ID` LIKE '$_GET[good_id]'";
        $result = mysqli_query($good_link, $sql);

        if ($result) {
        if ($good = $result->fetch_assoc()) {
        ?>
        <pre>
                    <ul class="w3-ul w3-large">
                        <li>商品名稱      <?php echo $good['Good_Name']; ?></li>
                        <li>商品價格      <?php echo $good['Good_Price']; ?></li>
                        <li>商品庫存      <?php echo $good['Good_Num']; ?></li>
                        <li>商品介紹        <br><?php echo $good['Good_text_intro']; ?></li>
                    </ul>
                </pre>
        <div class="w3-container">
            <h1>餐餐自由配</h1>
            <?php
            //將套餐代碼反編譯的到套餐資訊陣列
            $package = explode("u3h_m_5a1", $good['Good_Package']);
            unset($package[0]);
            //$pack_content_num = 4; //目前只有 名稱 價格 庫存 介紹
            //$pack_num = count($package)/$pack_content_num;
            foreach ($package as $index => $pack_good) {
                if ($index % 4 == 2 || $index % 4 == 3) {
                    $pack_good = (int)$pack_good;
                }
                switch ($index % 4) {
                    case 1:
                        /* 1 */
                        ?>
                        <div id="Package" class="w3-card-4" style="width:50%;">
                        <div class="w3-container">
                            <!--------------------套餐縮圖放這裡------------------------->
                        </div>
                        <pre>
                        <ul class="w3-ul w3-large">
                        <li>套餐名稱      <?php echo ($index % 4 == 1) ? $pack_good : ''; ?>   </li>
                        <?php break;

                    case 2:
                        /* 2 */
                        ?>
                        <li>套餐價格      <?php echo ($index % 4 == 2) ? $pack_good : ''; ?>   </li>
                        <?php break;
                    case 3:
                        /* 3 */
                        ?>
                        <li>套餐庫存      <?php echo ($index % 4 == 3) ? $pack_good : ''; ?>   </li>
                        <?php break;
                    case 0;
                        /* 4 */
                        ?>
                        <li>套餐介紹 <br><?php echo ($index % 4 == 0) ? $pack_good : ''; ?>   </li>
                        </ul>
                        </pre>
                        </div>
                        <?php break;
                }
            }
            } else {
                echo '商品資料抓取失敗!!';
            }
            } else {
                die('資料庫連結');
            } ?>


        </div>
    </div>
</div>
</body>
</html>