<?php
include("Navigation.php");
require_once('database/mem_info_open.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>CanWOW</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .col-75 {
            float: right;
            width: 75%;
            margin-top: 6px;
        }

        .w3-sidebar {
            float: left;
            width: 25%;
        }
    </style>
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>

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
<div id="video_list" class="w3-main" style="margin-top:43px; z-index: 4;">
    <!-------------簡單訊息------------->
    <div class="w3-sidebar w3-bar-block w3-card w3-light-grey">
        <?php
        $Email = $_SESSION['member']['Email'];
        $Cut_Index = 'u3h_m_5a1';
        $sql = "SELECT `Event_ID`,`Requester`,`Content`,`Status`,`Event_Type`,`date` FROM `event` WHERE `Email` LIKE '$Email' ORDER BY `date` DESC";
        if ($result = mysqli_query($member_link, $sql)) {
            while ($notice = $result->fetch_assoc()) {

                if ($notice['Event_Type'] == 1) {       //通知 : 代言廣告邀請
                    $video_name = explode($Cut_Index, $notice['Content'])[4];
                    $video_id = explode($Cut_Index, $notice['Content'])[3];
                    $sql = "SELECT `First_name` FROM `mem_info` WHERE `Email` LIKE '$notice[Requester]'";
                    if ($mem_result = mysqli_query($member_link, $sql)) {
                        if ($mem_info = $mem_result->fetch_assoc()) {
                            ?>
                            <button class="w3-bar-item w3-button tablink"
                                    onclick="openPage(<?php echo "'" . $notice['Event_ID'] . "'" ?>)"
                                    style="outline: none">
                                <div style="font-size: small">
                                    <a style="color: #00bcd4"
                                       href="index.php"><?php echo $mem_info['First_name']; ?></a>
                                    對您的
                                    <a style="color: #1e7e34"
                                       href="video_play.php?v=<?php echo $video_id; ?>"><?php echo $video_name; ?></a>
                                    影片提出代言請求
                                    <p style="font-size: smaller"><?php echo explode(' ', $notice['date'])[0]; ?></p>
                                </div>
                            </button>
                            <?php
                        } else {
                            echo '無此代言請求人';
                        }
                    } else {
                        echo '搜尋代言請求者名稱失敗';
                    }
                }

                if ($notice['Event_Type'] == 2) {       //通知 : 代言廣告邀請回覆
                    $reply = explode($Cut_Index, $notice['Content'])[1];
                    $request_id = explode($Cut_Index, $notice['Content'])[2];
                    $sql = "SELECT `First_name` FROM `mem_info` WHERE `Email` LIKE '$notice[Requester]'";
                    if ($mem_result = mysqli_query($member_link, $sql)) {
                        if ($mem_info = $mem_result->fetch_assoc()) {
                            ?>
                            <button class="w3-bar-item w3-button tablink"
                                    onclick="openPage(<?php echo "'" . $notice['Event_ID'] . "'" ?>)"
                                    style="outline: none">
                                <div style="font-size: small">
                                    <a style="color: #00bcd4"
                                       href="index.php"><?php echo $mem_info['First_name']; ?></a>
                                    <?php echo $reply; ?>了您的代言請求
                                    <p style="font-size: smaller">按此查看詳情</p>
                                    <p style="font-size: smaller"><?php echo explode(' ', $notice['date'])[0]; ?></p>
                                </div>
                            </button>
                            <?php
                        } else {
                            echo '無此代言請求人';
                        }
                    } else {
                        echo '搜尋代言請求者名稱失敗';
                    }
                }

                if ($notice['Event_Type'] == 3) {       //通知 : 影片分享
                    $sql = "SELECT `First_name` FROM `mem_info` WHERE `Email` LIKE '$notice[Requester]'";
                    if ($mem_result = mysqli_query($member_link, $sql)) {
                        if ($mem_info = $mem_result->fetch_assoc()) {
                            ?>
                            <button class="w3-bar-item w3-button tablink"
                                    onclick="window.location.href='video_play.php?v=<?php echo explode($Cut_Index, $notice['Content'])[1]; ?>';"
                                    style="outline: none">
                                <div style="font-size: small">
                                    <a style="color: #00bcd4"
                                       href="index.php"><?php echo $mem_info['First_name']; ?></a>
                                    分享了一部影片:<?php echo explode($Cut_Index, $notice['Content'])[2]; ?>
                                    <p style="font-size: smaller"><?php echo explode($Cut_Index, $notice['Content'])[3]; ?></p>
                                    <p style="font-size: smaller"><?php echo explode(' ', $notice['date'])[0]; ?></p>
                                </div>
                            </button>
                            <?php
                        } else {
                            echo '無此代言請求人';
                        }
                    } else {
                        echo '搜尋代言請求者名稱失敗';
                        echo $sql;
                    }
                }

                if ($notice['Event_Type'] == 4) {       //通知 : 影片分享
                    $sql = "SELECT `First_name` FROM `mem_info` WHERE `Email` LIKE '$notice[Requester]'";
                    if ($mem_result = mysqli_query($member_link, $sql)) {
                        if ($mem_info = $mem_result->fetch_assoc()) {
                            ?>
                            <button class="w3-bar-item w3-button tablink"
                                    onclick="openPage(<?php echo "'" . $notice['Event_ID'] . "'" ?>)"
                                    style="outline: none">
                                <div style="font-size: small">
                                    <?php echo $mem_info['First_name']; ?>
                                    向您發出了好友邀請!!
                                    <p style="font-size: smaller">按此查看詳情</p>
                                    <p style="font-size: smaller"><?php echo explode(' ', $notice['date'])[0]; ?></p>
                                </div>
                            </button>
                            <?php
                        } else {
                            echo '無此代言請求人';
                        }
                    } else {
                        echo '搜尋代言請求者名稱失敗';
                        echo $sql;
                    }
                }
            }
        } else {
            echo '搜尋用戶通知失敗!!';
        }
        ?>
    </div>
    <!-------------詳細訊息------------->
    <div class="col-75">
        <div class="w3-container">
            <div id="Message" class="w3-container">
                <h2>請選擇信息</h2>
            </div>
        </div>
    </div>
</div>

<script>
    function openPage(Event_ID) {
        //alert(Event_ID +','+ Event_Type);

        $.ajax({
            url: 'call_notice.php',
            dataType: "html",
            async: false,
            type: 'POST',
            data: {Event_ID: Event_ID},
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.responseText);
            },
            success: function (result) {
                document.getElementById('Message').innerHTML = result;
            }
        });
        /*
        var i;
        var x = document.getElementsByClassName("page");
        var tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
            tablinks[i].className = tablinks[i].className.replace(" w3-light-grey", "");
        }
        document.getElementById(pageName).style.display = "block";
        evt.currentTarget.className += " w3-light-grey";
        */
    }
</script>

</body>
</html>
