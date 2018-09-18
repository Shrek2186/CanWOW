<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once("Connect_Video.php");
require_once("Connect_Member.php");
require_once("database/mem_info_open.php");     // 方方
require_once("database/play_list_open.php");   // 方方
require_once("database/good_open.php");
require_once("database/video_open.php");
$Video_ID = $_GET['v'];
include("Navigation.php");
?>
<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Video_View</title>
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <!--meta的那個似乎是HTML5響應式要用東西，會去感應目前裝置的螢幕大小-->
    <link rel="stylesheet" href="css/Mycss.css">
    <link rel="stylesheet" href="css/Video_page.css">
    <link rel="stylesheet" href="css/w3.css">
    <!----------Video_Play_div只是用來看布局的-------------->
    <!--<link rel="stylesheet" href="css/Video_Play_div.css">-->

    <!-- 測試上方條 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">-->
    <link rel="stylesheet" href="css/w3.css">
    <!-- 測試上方條 -->
</head>
<body>
<div id="video_list" class="box">
    <!--雜項放這-->
    <?php
    if (isset($_SESSION['member']['Email'])) {
        $member = $_SESSION['member']['Email'];
    }
    $select_ID = $Connect->prepare("SELECT Video_ID, Video_Type, Path FROM Video_Info WHERE Video_ID=:id ");
    $select_ID->bindValue(':id', $_GET['v'], PDO::PARAM_STR);
    $select_ID->execute();
    $result_ID = $select_ID->fetch(PDO::FETCH_ASSOC);
    ?>
    <?php if ($result_ID['Video_ID'] != NULL) { ?>
    <!--雜項放這結束-->
    <!--左大排div開始-->
    <div class="left-box">
        <!-- <button onclick="Show()">Show</button>  顯示影片資訊已播放時間-->
        <?php if ($result_ID['Video_Type'] == 'url') {
            ?>
            <iframe width="560" height="315" class="play-box"
                    src="https://www.youtube.com/embed/<?php echo $result_ID['Path'] ?>" frameborder="0"
                    allow="autoplay; encrypted-media" allowfullscreen></iframe>
            <?php
        } else { ?>
            <video id="<?php echo $_GET['v']; ?>" controls class="play-box">
                <source src="source/video/<?php echo $_GET['v']; ?>.mp4" type="video/mp4">
            </video>
<!--            測試用按鈕-->
<!--            <button id="test" onclick="Record()"> test </button>-->
        <?php }
        } else { ?>
            <h1 class="w3-red w3-display-middle">無此影片!!</h1>
        <?php } ?>
        <!--影片div結束-->
        <!---------段落間格------------>
        <div class="interval"></div>
        <!---------段落間格------------>
        <!--雜項放這-->
        <?php
        $sql = "SELECT Video_Watch_Num, Video_Name, Video_Uploader FROM Video_Info LEFT JOIN statistics ON Video_Info.Video_ID = statistics.Video_ID WHERE Video_Info.Video_ID = '$Video_ID'";
        $result = mysqli_query($video_link, $sql);
        $result_title = $result->fetch_assoc(); ?>
        <!--雜項放這結束-->
        <!--上傳者名字、大頭貼與影片的名字、觀看次數、評價、播放清單div-->
        <div class="uploader-box">
            <!--上傳者大頭貼、名字div-->
            <div class="stickers-box">
                <img src="source/image/logo.jpg" class="w3-circle uploader-img-box">
                <h6 style="text-align: center"><?php print("$result_title[Video_Uploader]"); ?></h6>
            </div>
            <!--上傳者大頭貼、名字div結束-->
            <!--影片名字div-->
            <div class="videonam-box">
                <h4><?php print("$result_title[Video_Name]"); ?></h4>
            </div>
            <!--影片名字div結束-->
            <!--影片標籤-->
            <?php //include 'Video_Tag/index.php' ?>
            <!--影片標籤結束-->
            <!--觀看次數、收藏、評價div-->
            <div class="look-feel-box">
                <div class="looknum-box">
                    <h4>
                        <?php
                        //   ------ 觀看次數功能 -----------------------------------------------------------------------------------------------------------------------------------
                        echo '觀看次數: ' . $result_title['Video_Watch_Num'];
                        //   ------ 結束觀看次數功能 -------------------------------------------------------------------------------------------------------------------------------
                        ?>
                    </h4>
                </div>
                <!--------------收藏div-------------->
                <div class="play-list-box">
                    <button type="button"
                            class="w3-round w3-border w3-border-black feeling-butt-box"
                            data-toggle="dropdown"
                            onclick="Build_List('Build')">收藏
                    </button>
                    <div class="w3-dropdown-content w3-container shadow" style="border: solid" id="Build">
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
                                        <input type="checkbox"
                                               name="playList[]"
                                               class="w3-check"
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
                                        <!---------段落間格------------>
                                        <div style="height: 10px"></div>
                                        <!---------段落間格------------>
                                        <input type="submit" value="確定"
                                               class="w3-button w3-white w3-hover-black w3-round"
                                               style="border: solid;">
                                        <?php
                                    } else {
                                        echo '您還未建立播放清單喔';
                                    }
                                    ?>
                                </form>
                                <form method="post" action="addVideoList.php">
                                    <button type="button"
                                            class="w3-button w3-white w3-hover-black w3-round"
                                            style="border: solid;"
                                            onclick="List('Build_List')">+ 新增清單
                                    </button>
                                    <div class="list" id="Build_List" style="display: none">
                                        <span onclick="this.parentElement.style.display='none'"
                                              class="w3-button  w3-display-topright"
                                              style="margin-top: 75%">&times;</span>
                                        <h6>名稱 : </h6>
                                        <input type="hidden" name="member_Email" value="<?php echo $member; ?>">
                                        <input type="text" name="Video_List_Name"
                                               class="border-bott">
                                        <input type="hidden" name="ori_pageLocation"
                                               value="<?php echo $_SERVER['REQUEST_URI']; //顯示當前網址(回傳用)?>">
                                        <!---------段落間格------------>
                                        <div style="height: 10px"></div>
                                        <!---------段落間格------------>
                                        <input type="submit" value="新增"
                                               class="w3-button w3-white w3-hover-black w3-round"
                                               style="border: solid;">
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
                </div>
                <!------------收藏div結束-------------->
                <!--------------評價div---------------->
                <div class="feeling-box">
                    <?php
                    //   ------ 評價功能 -----------------------------------------------------------------------------------------------------------------------------------
                    $feeling_type = array("like", "dislike", "heart", "laugh", "shock", "angry", "sad");
                    //print_r($feeling_type);
                    foreach ($feeling_type as $index => $type) {
                        $sql = "SELECT COUNT(Email) AS type_sum FROM feeling WHERE Video_ID LIKE '$_GET[v]' AND `Feeling_Type` = $index";
                        if ($result = mysqli_query($video_link, $sql)) {
                            if ($sum = $result->fetch_assoc()) {
                                if (isset($member)) {
                                    $sql = "SELECT `Email` FROM `feeling` WHERE `Email` LIKE '$member' AND `Feeling_Type` = $index AND `Video_ID` LIKE '$_GET[v]'";
                                    //echo '<br>'.$sql.'<br>';
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
                <!-------------評價div結束---------------->
            </div>
            <!--觀看次數、收藏、評價div結束-->
        </div>
        <!--上傳者名字、大頭貼與影片的名字、觀看次數、評價、播放清單div結束-->
        <!---------段落留白------------>
        <div class="interval"></div>
        <!---------段落留白------------>
        <!---------簡介、商品div------->
        <div class="info-box">
            <div class="w3-row">
                <a href="javascript:void(0)" onclick="Tabs(event, 'Info');">
                    <div class="tablink w3-bottombar w3-hover-light-grey w3-padding" style="float: left">簡介</div>
                </a>
                <a href="javascript:void(0)" onclick="Tabs(event, 'Buy');">
                    <div class="tablink w3-bottombar w3-hover-light-grey w3-padding" style="float: left">商品</div>
                </a>
            </div>
            <div id="Info" class="info-text-box mycontainer">
                <?php
                $select_video = $Connect->prepare("SELECT Video_Intro FROM Video_Info WHERE Video_ID=:id");
                $select_video->bindValue(':id', $_GET['v'], PDO::PARAM_STR);
                $select_video->execute();
                $result_Intro = $select_video->fetch(PDO::FETCH_ASSOC);
                print("$result_Intro[Video_Intro]");
                ?>
            </div>
            <div id="Buy" class="info-text-box mycontainer" style="display: none">
                <?php
                //   -------- 代言功能 ---------------------------------------------------------------------------------------------------------------------------------
                $sql = "SELECT `Good_ID` FROM `advertisement` WHERE `Video_ID` LIKE '$_GET[v]' AND `Ad_Level` = 1";
                if ($result_Ad = mysqli_query($video_link, $sql)) {
                    while ($G_ID = $result_Ad->fetch_assoc()) {
                        $sql = "SELECT `Seller`,`Good_Name`,`Good_Price` FROM `good_info` WHERE `Good_ID` LIKE '$G_ID[Good_ID]'";
                        if ($result_good = mysqli_query($good_link, $sql)) {
                            if ($Show = $result_good->fetch_assoc()) {
                                ?>
                                <a href="<?php //echo $G_ID['Good_ID']
                                ?>">
                                    <?php echo $Show['Good_Name'] ?></a>
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
                }
                ?>
                <a href="Ad_request.php?v_id=<?php echo $_GET['v'] . '&v_na=' . $result_title['Video_Name'] ?>"
                   style="color: red">送出代言邀請</a>
                <?php
                //   ------ 結束代言功能 -------------------------------------------------------------------------------------------------------------------------------
                ?>
            </div>
        </div>
        <!---------簡介、商品div結束------->
        <!---------段落留白------------>
        <div class="interval"></div>
        <!---------段落留白------------>
        <!--------------------------自己留言div-------------------------->
        <div class="uploader-box">
            <?php
            if (isset($_SESSION['member']['Email'])) {
                ?>
                <form action="Guestbook_Action.php" method="post" name="Guest_Book">
                    <div class="stickers-box">
                        <img src="source/image/logo.jpg" class="w3-circle uploader-img-box">
                    </div>
                    <div class="namtim-box">
                        <!-----留言者名稱------>
                        <h6><?php print($_SESSION['member']['Email']); ?></h6>
                        <input required
                               type="hidden"
                               name="Video_ID"
                               value="<?php echo($_GET['v']) ?>"
                               placeholder="ID">
                    </div>
                    <div class="mes-box">
                        <!--留言-->
                        <input required type="text" name="Content" placeholder="留言">
                    </div>
                    <div class="reply-box">
                        <input type="submit" name="" value="送出留言">
                    </div>
                </form>
                <?php
            } ?>

        </div>
        <!------------------------自己留言div結束------------------>

        <!------------------------自己的留言被回覆div---------------------------->
        <?php
        $select_messenger = $Connect->prepare("SELECT Giver, Content, Guestbook_ID FROM Guest_Book WHERE Video_ID=:id");
        $select_messenger->bindValue(':id', $_GET['v'], PDO::PARAM_STR);
        $select_messenger->execute();
        //初始化All_Reply(回覆的div的ID名稱用流水號)
        $reply_ID = 1;
        //印出所有關於Video_ID的留言（Content)以及留言者（Giver）
        while ($row_guest = $select_messenger->fetch(PDO::FETCH_ASSOC)) {
            $select_giver = $M_Connect->prepare("SELECT First_name FROM mem_info WHERE Email=:id");
            $select_giver->bindValue(':id', "$row_guest[Giver]", PDO::PARAM_STR);
            $select_giver->execute();
            $row_giver = $select_giver->fetch(PDO::FETCH_ASSOC); ?>
            <!---------段落留白------------>
            <div class="interval"></div>
            <!---------段落留白------------>
            <div class="uploader-box">
                <!--------回覆----------->
                <div class="stickers-box">
                    <img src="source/image/logo.jpg" class="w3-circle uploader-img-box">
                </div>
                <div class="namtim-box">
                    <!--留言者名稱-->
                    <?php print("$row_giver[First_name]"); ?>
                </div>
                <div class="mes-box">
                    <!--留言-->
                    <?php print("$row_guest[Content]"); ?>
                </div>
                <div class="reply-box">
                    <!--每個留言都有一個輸入框-->
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
            </div>
            <!----------------------自己的留言被回覆div結束---------------------->
            <!---------------------所有的回覆div---------------------------->
            <?php //echo("<br>");
            $select_reply = $Connect->prepare("SELECT Giver, Content FROM Guest_Book_Reply WHERE Guestbook_ID=:id");
            $select_reply->bindValue(':id', "$row_guest[Guestbook_ID]", PDO::PARAM_STR);
            $select_reply->execute();
            //印出所有關於Guestbook_ID的回覆（Content)以及回覆者（Giver）?>
            <!-------------把全部留言包起來，但萬一有很多留言就會直接全部顯示呦---------------->
            <div id="All_Reply<?php echo $reply_ID ?>" style="display: none">
                <?php
                while ($row_reply = $select_reply->fetch(PDO::FETCH_ASSOC)) { ?>
                    <div class="uploader-box">
                        <div class="stickers-box">
                        </div>
                        <div class="stickers-box">
                            <img src="source/image/logo.jpg" class="w3-circle uploader-img-box">
                        </div>
                        <div class="namtim-box">
                            <!--留言者名稱-->
                            <?php print("$row_giver[First_name]"); ?>
                        </div>
                        <div class="mes-box">
                            <!--留言-->
                            <?php print("$row_reply[Content]"); ?>
                        </div>
                        <div class="reply-box">
                            <!----------------回覆-------------------->
                            <form action="Reply_Action.php" method="post">
                                <input type="text" name="Content" placeholder="新增回覆" required>
                                <input type="hidden" name="Guestbook_ID"
                                       value="<?php echo("$row_guest[Guestbook_ID]") ?>"
                                       placeholder="ID">
                                <input required type="hidden" name="Video_ID" value="<?php echo($_GET['v']) ?>"
                                       placeholder="ID">
                                <input type="submit" value="回覆"
                                       style="border:0;cursor:pointer;background-color: white;font-size: 16px;color: gray">
                            </form>
                        </div>
                    </div>

                    <?php
                }
                ?>
            </div>
            <button id="Look_Reply<?php echo $reply_ID ?>" onclick="ReplyButt('All_Reply<?php echo $reply_ID ?>')"
                    style="margin-left: 45%;border: solid"
                    class="w3-button w3-white w3-hover-black w3-round">
                查看回覆
            </button>
            <?php
            $reply_ID = $reply_ID + 1;
        }
        ?>

    </div>
    <!---------------------所有的回覆div結束---------------------------->
    <!-----------------------左大排div結束------------------------->

    <!-----------------------右大排div開始------------------------->
    <div class="right-box">
        <div class="right-head-box">
            <!--推薦廣告-->
        </div>
        <!---------段落留白------------>
        <!--<div class="interval"></div>-->
        <!---------段落留白------------>
        <div class="vidlist-box">
            <div>
                <!--推薦影片清單-->
            </div>
        </div>
    </div>
    <!-----------------------右大排div結束------------------------->
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
                        console.log('Ajax request 發生錯誤');
                    },
                    success: function (result) {
                        if (result === 1) {
                            console.log('新增觀看次數成功!!');
                        }
                        if (result === 0) {
                            console.log('新增觀看次數失敗!!');
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
    jQuery(window).bind('beforeunload', function (e) {
        if (dur_time > 0) {
            var video_id = '<?php echo $_GET['v']; ?>';
            var Email = '<?php if(isset($_SESSION['member']['Email'])){echo $_SESSION['member']['Email'];}else{echo "Visitor";}?>';
            var query = null;
            <?php
            if(isset($_POST['Query'])){
            ?>
            query = '<?php echo $_POST['Query'];?>';
            <?php
            }
            ?>
            $.ajax({
                url: 'Add_Watch_Record.php',    //新增會員的觀看紀錄以及更新影片的觀看總時數
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

    //----------------簡介按鈕------------------------
    function Tabs(evt, IDName) {
        var i, x, tablinks;
        x = document.getElementsByClassName("info-text-box");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < x.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" w3-border-black", "");
        }
        document.getElementById(IDName).style.display = "block";
        evt.currentTarget.firstElementChild.className += " w3-border-black";
    }

    //--------------簡介按鈕結束-----------------------

    //----------------新增按鈕------------------------
    function List(IDName) {
        var i;
        var x = document.getElementsByClassName("list");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        document.getElementById(IDName).style.display = "block";
    }

    //--------------新增清單按鈕結束-----------------------

    //--------------查看回覆按鈕---------------
    function ReplyButt(Reply_IDName) {
        var x = document.getElementById(Reply_IDName);
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }

    //-------------查看回覆按鈕結束------------
</script>

</html>