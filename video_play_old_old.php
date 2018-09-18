<?php
/*
if (!isset($_SESSION)) {
    session_start();
}*/
require_once("Connect_Video.php");
require_once("Connect_Member.php");
require_once("database/mem_info_open.php");     // 方方
require_once("database/play_list_open.php");   // 方方
require_once("database/good_open.php");
require_once("database/video_open.php");

include("Navigation.php");

$Video_ID = $_GET['v'];
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Video_View</title>
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>

    <!-- our custom CSS
    <link rel="stylesheet" href="Shopping_Car/libs/css/custom.css"/>-->
    <style>
        .video_play {
            width: 65%;
            margin-left: 10%;
            margin-top: 1%;
            position: relative;
            /*乾 為啥不行用!!vertical-align: middle;*/

        }

        .col-30 {
            /*float: left;*/
            width: 30%;
            margin-left: 10%;
            margin-top: 3%;
            position: relative;
        }

        .video_info {
            /*float: left;*/
            width: 65%;
            margin-left: 10%;
            margin-top: 1%;
            position: absolute;
            word-break: break-all; /*似乎沒用?*/
        }
    </style>
</head>
<body>
<div id="video_list" class="w3-main" style="margin-top:43px; z-index: 4;">
    <!-- <button onclick="Show()">Show</button>  顯示影片資訊已播放時間-->
    <?php
    if (isset($_SESSION['member']['Email'])) {
        $member = $_SESSION['member']['Email'];
    }
    $select_ID = $Connect->prepare("SELECT Video_ID FROM Video_Info WHERE Video_ID=:id ");
    $select_ID->bindValue(':id', $_GET['v'], PDO::PARAM_STR);
    $select_ID->execute();
    $result_ID = $select_ID->fetch(PDO::FETCH_ASSOC);
    ?>
    <?php if ($result_ID['Video_ID'] != NULL) { ?>
    <div class="video_info">
        <div>
            <video id="<?php echo $_GET['v']; ?>" controls>
                <source src="source/video/<?php echo $_GET['v']; ?>.mp4" type="video/mp4">
            </video>
        </div>
        <?php } else { ?>
            <h1 class="w3-red w3-display-middle">無此影片!!</h1>
        <?php } ?>
        <?php
        $sql = "SELECT statistics.Video_Watch_Num, Video_Name, Video_Uploader FROM Video_Info LEFT JOIN statistics ON Video_Info.Video_ID = statistics.Video_ID WHERE Video_Info.Video_ID = '$Video_ID'";
        $result = mysqli_query($video_link, $sql);
        $result_title = $result->fetch_assoc();
        ?>
        <div>
            <h3><?php print("$result_title[Video_Name]"); ?></h3>
        </div>
        <?php include 'Video_Tag/index.php' ?>
        <?php //include 'show_good.php' ?> <!--之後可以印入來用(只要修改show_good.php就好)-->
        <button type="button"
                class="w3-button w3-black"
                data-toggle="dropdown"
                onclick="Build_List('Build')">+
        </button>
        <div class="w3-dropdown-content" id="Build">
            <?php
            //   ------ 收藏功能 -----------------------------------------------------------------------------------------------------------------------------------
            if (isset($_SESSION['member']['Email'])) {
                $member = $_SESSION['member']['Email'];
                $sql = "SELECT `Play_List_ID`,`Video_ID`,`Play_List_Name` FROM `play_list` WHERE `Email` LIKE '$member'";
                $result = mysqli_query($member_link, $sql);     //執行sql
                $count = 0;
                if ($result) {      //資料庫搜尋成功
                    ?>
                    <form method="post" action="collect_video.php">
                        <input type="hidden" name="member_Email" value="<?php echo $member; ?>">
                        <input type="hidden" name="Video_ID" value="<?php echo $_GET['v']; ?>">
                        <input type="hidden" name="ori_pageLocation"
                               value="<?php echo $_SERVER['REQUEST_URI']; //顯示當前網址(回傳用)?>">
                        <?php
                        while ($G_ID = $result->fetch_assoc()) {
                            $count = $count + 1;
                            $cancel_collect = false;
                            $video = explode(",", $G_ID['Video_ID']);
                            ?>
                            <input type="checkbox" name="playList[]"
                                   value="<?php echo $G_ID['Play_List_ID']; ?>" <?php
                            if (in_array($_GET['v'], $video)) {
                                $cancel_collect = true;
                                echo 'checked ';
                                echo 'disabled';
                            }
                            ?>>
                            <?php echo $G_ID['Play_List_Name'];
                            if ($cancel_collect) {
                                ?>
                                <a href="Cancel_Collect.php?
                                    <?php echo 'videoList=' . $G_ID['Play_List_ID'] . '&Video_ID=' . $_GET['v'] . '&ori_pageLocation=' . $_SERVER['REQUEST_URI']; ?>">取消收藏</a>
                                <?php
                            }
                            ?>
                            <br>
                            <?php
                        }
                        if ($count) {
                            ?>
                            <input type="submit" value="收藏">
                            <?php
                        } else {
                            echo '您還未建立播放清單喔';
                        }
                        ?>
                    </form>
                    <form method="post" action="addVideoList.php">
                        <button type="button"
                                class="w3-button w3-black"
                                data-toggle="dropdown"
                                onclick="Build_List('Build_List')">新增清單
                        </button>
                        <div class="w3-dropdown-content w3-container" id="Build_List">
                            <input type="hidden" name="member_Email" value="<?php echo $member; ?>">
                            <input type="text" name="Video_List_Name" required>
                            <input type="hidden" name="ori_pageLocation"
                                   value="<?php echo $_SERVER['REQUEST_URI']; //顯示當前網址(回傳用)?>">
                            <input type="submit" value="新增">
                        </div>
                    </form>
                    <?php
                } else {    //資料庫搜尋失敗
                    echo '收藏搜尋失敗!!' . '<br>';
                }
            } else {
                echo '<br>' . '<a href="Login.php">未登入無法使用收藏功能(登入)</a>';  //顯示登入超連結
            }
            //   ------ 結束收藏功能 -------------------------------------------------------------------------------------------------------------------------------
            ?>
        </div>
        <div>
            <?php
            //   ------ 觀看次數功能 -----------------------------------------------------------------------------------------------------------------------------------
            echo '觀看次數: ' . $result_title['Video_Watch_Num'];
            //   ------ 結束觀看次數功能 -------------------------------------------------------------------------------------------------------------------------------
            ?>
        </div>
        <div>
            <?php
            //   ------ 評價功能 -----------------------------------------------------------------------------------------------------------------------------------
            $feeling_type = array("like", "dislike", "heart", "laugh", "shock", "angry", "sad");
            //print_r($feeling_type);
            foreach ($feeling_type as $index => $type) {
                $sql = "SELECT COUNT(Email) AS type_sum FROM feeling WHERE Video_ID LIKE '$_GET[v]' AND `Feeling_Type` = $index";
                if ($result = mysqli_query($video_link, $sql)) {
                    if ($sum = $result->fetch_assoc()) {
                        if (isset($_SESSION['member']['Email'])) {
                            $sql = "SELECT `Email` FROM `feeling` WHERE `Email` LIKE '$member' AND `Feeling_Type` = $index AND `Video_ID` LIKE '$_GET[v]'";
                            if ($result = mysqli_query($video_link, $sql)) {
                                $hint = $result->fetch_assoc();
                            } else {
                                echo '搜尋此用戶是否評價過此影片失敗';
                            }
                        }
                        ?>
                        <span onclick="feeling(<?php echo $index; ?>)"
                              style="cursor: pointer; <?php echo $hint ? 'color: red;' : ''; ?>"><?php echo $type; ?></span> :
                        <?php
                        echo $sum['type_sum'];
                    }
                } else {
                    echo "搜尋影片評價失敗!!";
                }
            }
            /*$sql = "SELECT COUNT(Email) AS NumberOfProducts FROM feeling WHERE Video_ID LIKE '$_GET[v]'";
            $get_video_feelings = $Connect->prepare("$sql");
            $get_video_feelings->bindValue('id', $_GET['v'], PDO::PARAM_STR);
            $get_video_feelings->execute();
            $video_feelings = $get_video_feelings->fetch(PDO::FETCH_ASSOC);
            if ($get_video_feelings) {

            } else {
                echo '影片評價搜尋失敗!!';
            }*/
            //   ------ 結束評價功能 -------------------------------------------------------------------------------------------------------------------------------
            ?>
        </div>
        <div class="row">
            <div>
                <h5><?php print("$result_title[Video_Uploader]"); ?></h5>
            </div>
            <?php
            //   ------ 搜尋頻道主的訂閱次數 ---------------------------------------------------------------------------------------------------------------------
            $sql = "SELECT `Subscribed_Num` FROM `video_uploader` WHERE `Email` LIKE '$result_title[Video_Uploader]'";
            $result = mysqli_query($member_link, $sql);     //執行sql
            if ($result) {
                if ($Sub_num = $result->fetch_assoc()) {
                    // echo "訂閱( $Sub_num[Subscribed_Num])";
                } else {
                    echo '搜尋頻道主訂閱次數出現問題!!' . '<br>';
                }
            } else {
                echo '搜尋頻道主訂閱次數失敗!!';
            }
            //   ------ 結束搜尋頻道主的訂閱次數 -----------------------------------------------------------------------------------------------------------------
            ?>
            <div>
                <?php
                //   ------ 訂閱功能 -----------------------------------------------------------------------------------------------------------------------------------
                if (isset($_SESSION['member']['Email'])) {      //判斷有無登入，若沒有則顯示登入的超連結
                    $subscriber = $_SESSION['member']['Email'];     //取得目前登入者的Email
                    $Channel_Master = $result_title['Video_Uploader'];    //取得影片上傳者(頻道主)的Email
                    $sql = "SELECT `Subscription_ID` FROM `subscription` WHERE `Subscriber` LIKE '$subscriber' AND `Channel_Master` LIKE '$Channel_Master'";    //搜尋該登入者是否有訂閱該頻道主
                    $result = mysqli_query($member_link, $sql);     //執行sql
                    if ($result) {      //資料庫搜尋成功
                        $Sub = $result->fetch_assoc();      //取得資料(該登入者是否有訂閱該頻道主)
                        //瑛志覺得不用這個吧! echo ($Sub) ? "已訂閱!!" : "未訂閱!!";    //判斷$Sub為True則是已訂閱，False則是未訂閱
                        ?>
                        <form method="post" action="subscription.php">
                            <input type="hidden" name="subscriber" value="<?php echo $subscriber; ?>">
                            <input type="hidden" name="Channel_Master" value="<?php echo $Channel_Master; ?>">
                            <input type="hidden" name="Sub_or_unSub"
                                   value="<?php echo ($Sub) ? 0 : 1; //判斷是要進行訂閱還是取消訂閱，若已訂閱則顯示0(取消訂閱)，未訂閱顯示1(訂閱)?>">
                            <input type="hidden" name="ori_pageLocation"
                                   value="<?php echo $_SERVER['REQUEST_URI']; //顯示當前網址(回傳用)?>">
                            <input type="submit"
                                   value="<?php echo ($Sub) ? "取消" : ""; ?>訂閱 ( <?php echo $Sub_num['Subscribed_Num'] ?> )">
                        </form>
                        <?php
                    } else {    //資料庫搜尋失敗
                        echo '是否訂閱搜尋失敗!!' . '<br>';
                    }
                } else {     //未登入
                    echo '<br>' . '<a href="Login.php">未登入無法使用訂閱功能(登入)</a>';  //顯示登入超連結
                }
                //   ------ 結束訂閱功能 -------------------------------------------------------------------------------------------------------------------------------
                ?>
            </div>
        </div>
        <?php
        /*
        //   -------- 代言功能 ---------------------------------------------------------------------------------------------------------------------------------
        $sql = "SELECT `Good_ID` FROM `advertisement` WHERE `Video_ID` LIKE '$_GET[v]' AND `Ad_Level` = 1";
        if ($result_Ad = mysqli_query($video_link, $sql)) {
            while ($G_ID = $result_Ad->fetch_assoc()) {
                $sql = "SELECT `Seller`,`Good_Name`,`Good_Price` FROM `good_info` WHERE `Good_ID` LIKE '$G_ID[Good_ID]'";
                if ($result_good = mysqli_query($good_link, $sql)) {
                    if ($Show = $result_good->fetch_assoc()) {
                        ?>
                        <a href="<?php //echo $G_ID['Good_ID']
                        ?>"><?php echo $Show['Good_Name'] ?></a>
                        <?php
                        echo '賣家:' . $Show['Seller'];
                        echo '價錢:' . $Show['Good_Price'] . '<br>';
                    } else {
                        echo '無此商品!!';
                    }
                } else {
                    echo '搜尋商品資訊失敗!!';
                }
            }
        } else {
            echo '搜尋該影片代言商品失敗!!!';
        }*/
        ?>
        <a href="Ad_request.php?v_id=<?php echo $_GET['v'] . '&v_na=' . $result_title['Video_Name'] ?>"
           style="color: red">送出代言邀請</a>
        <?php
        //   ------ 結束代言功能 -------------------------------------------------------------------------------------------------------------------------------
        ?>
        <br>
        <div>
            <?php
            $select_video = $Connect->prepare("SELECT Video_Intro FROM Video_Info WHERE Video_ID=:id");
            $select_video->bindValue(':id', $_GET['v'], PDO::PARAM_STR);
            $select_video->execute();
            $result_Intro = $select_video->fetch(PDO::FETCH_ASSOC);
            print("$result_Intro[Video_Intro]");
            ?>
        </div>
        <!-- 分享功能 -->
        <form action="Sharing.php" method="post">
            <input type="hidden" name="Sharer" value="<?php echo $_SESSION['member']['Email']; ?>">
            <input type="hidden" name="Video_ID" value="<?php echo $_GET['v']; ?>">
            <input type="hidden" name="Video_Name" value="<?php echo $result_title['Video_Name']; ?>">
            <br>
            <input type="text" name="Share_Receiver" placeholder="分享給(輸入Email)">
            <br>
            <textarea name="Share_Content" type="text" rows="4" cols="35" placeholder="跟你的朋友說點話吧!"></textarea>
            <br>
            <input type="submit" value="分享">
        </form>

        <br>
        <?php
        if (isset($_SESSION['member']['Email'])) {
            ?>
            <form action="Guestbook_Action.php" method="post" name="Guest_Book">
                <input required type="text" name="Content" placeholder="留言">
                <input required type="hidden" name="Video_ID" value="<?php echo($_GET['v']) ?>" placeholder="ID">
                <input type="submit" name="" value="送出留言">
            </form>
            <?php
        } ?>

        <div>
            <?php
            $select_messenger = $Connect->prepare("SELECT Giver, Content, Guestbook_ID FROM Guest_Book WHERE Video_ID=:id");
            $select_messenger->bindValue(':id', $_GET['v'], PDO::PARAM_STR);
            $select_messenger->execute();
            //印出所有關於Video_ID的留言（Content)以及留言者（Giver）
            while ($row_guest = $select_messenger->fetch(PDO::FETCH_ASSOC)) {
                $select_giver = $M_Connect->prepare("SELECT First_name FROM mem_info WHERE Email=:id");
                $select_giver->bindValue(':id', "$row_guest[Giver]", PDO::PARAM_STR);
                $select_giver->execute();
                $row_giver = $select_giver->fetch(PDO::FETCH_ASSOC);
                print("$row_giver[First_name], $row_guest[Content]");
                echo("<br>");
                $select_reply = $Connect->prepare("SELECT Giver, Content FROM Guest_Book_Reply WHERE Guestbook_ID=:id");
                $select_reply->bindValue(':id', "$row_guest[Guestbook_ID]", PDO::PARAM_STR);
                $select_reply->execute();
                //印出所有關於Guestbook_ID的回覆（Content)以及回覆者（Giver）
                while ($row_reply = $select_reply->fetch(PDO::FETCH_ASSOC)) {
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                    print("$row_giver[First_name], $row_reply[Content]");
                    echo("<br>");
                }
                ?>
                <!--每個留言都有一個輸入框-->
                <div>
                    <form action="Reply_Action.php" method="post">
                        <input type="text" name="Content" placeholder="新增回覆" required>
                        <input type="hidden" name="Guestbook_ID" value="<?php echo("$row_guest[Guestbook_ID]") ?>"
                               placeholder="ID">
                        <input required type="hidden" name="Video_ID" value="<?php echo($_GET['v']) ?>"
                               placeholder="ID">
                        <input type="submit" value="回覆"
                               style="border:0;cursor:pointer;background-color: white;font-size: 16px;color: gray">
                    </form>
                </div>
                <?php
            }
            ?>
        </div>

    </div>
</div>
</body>
<script>
    //------------------計算觀看演算法--------------------------

    var dur_time = 0;
    var Watch_rate_check = 0;
    var count = 0;
    var video_id = '<?php echo $_GET['v']; ?>';
    var video = document.getElementById(video_id);
    //console.log("耶耶:" + video);
    setInterval(
        function () {
            if (video.paused) {
            }
            if (!video.paused) {
                dur_time++;
            }
            if ((dur_time / video.duration) >= 0.05) {
                Watch_rate_check = 1;
                count++;
            }
            if (Watch_rate_check && count === 1) {
                $.ajax({
                    url: 'addVideo_Watch_Num.php',
                    dataType: "json",
                    async: false,
                    type: 'POST',
                    data: {Video_ID: video.id},
                    error: function () {
                        alert('Ajax request 發生錯誤');
                    },
                    success: function (result) {
                        if (result === 1) {
                            alert('新增觀看次數成功!!');
                        }
                        if (result === 0) {
                            alert('新增觀看次數失敗!!');
                        }
                    }
                });
            }
            Show();
        }, 1000);

    //顯示影片資訊已播放時間
    function Show() {
        console.log('dur: ' + dur_time + ' all: ' + video.duration + ' rate: ' + (dur_time / video.duration) + ' rate_check: ' + Watch_rate_check + ' video_id: ' + video.id);
    }

    //----------------使用者觀看紀錄--------------------------
    <?php if(isset($_SESSION['member']['Email'])){?>
    jQuery(window).bind('beforeunload', function (e) {
        if (dur_time > 0) {
            var video_id = '<?php echo $_GET['v']; ?>';
            var Email = '<?php echo $_SESSION['member']['Email']; ?>';
            var query;
            <?php
            if(isset($_POST['Query'])){
            ?>
            query = '<?php echo $_POST['Query']?>';
            <?php
            }
            ?>
            $.ajax({
                url: 'Add_Watch_Record.php',
                dataType: "json",
                async: false,
                type: 'POST',
                data: {Video_ID: video_id, Email: Email, Duration: dur_time, Query: query},
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.responseText);
                },
                success: function (result) {
                    if (result === 1) {
                    }
                    if (result === 0) {
                    }
                }
            });
        }
    });
    <?php }?>
    //---------------評價功能---------------------
    function feeling(feel_type) {
        var video_id = '<?php echo $_GET['v']; ?>';
        //alert(video_id+feel_type);
        $.ajax({
            url: 'Modify_Video_Feeling.php',
            dataType: "json",
            async: false,
            type: 'POST',
            data: {Video_ID: video_id, Fell_type: feel_type},
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.responseText);
            },
            success: function (result) {
                if (result === 1) {
                    alert('修改評價成功!!');
                }
                if (result === 0) {
                    alert('修改評價失敗!!');
                }
            }
        });
    }

    //---------------結束 評價功能-------------------
    //--------------下拉選單功能---------------------
    function Build_List(id) {
        var x = document.getElementById(id);
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
        } else {
            x.className = x.className.replace(" w3-show", "");
        }
        /*document.getElementById("Build_But").style.visibility='hidden';*/
    }

    //-----------結束下拉選單功能---------------------
</script>

</html>
