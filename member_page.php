<?php
if (!isset($_SESSION)) {
    session_start();
}
//session_destroy();        //測試用(暫時拿來當刪除鍵)
//插入導覽列
include("Navigation.php");
require_once('database/video_open.php');
//判斷是否會員
if (isset($_SESSION['member']['Email'])) {
    $member = $_SESSION['member']['Email'];
    $sql = "SELECT `Last_name`, `First_name`, `Email`, `Birthday`, `Phone` FROM `mem_info` WHERE `Email` LIKE '$member'";
    $result = mysqli_query($member_link, $sql);
    if ($result) {
        if ($mem_info = $result->fetch_assoc()) {

        } else {
            die('錯誤信息:無此用戶');
        }
    } else {
        die('用戶基本資料搜尋失敗');
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>CanWOW</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<!-- !PAGE CONTENT! -->
<div id="video_list" class="w3-main" style="margin-top:43px; z-index: 4;">
    <div class="w3-panel" style="z-index: 4;">
        <div class="w3-row-padding" style="margin:0 -16px">
            <div class="w3-margin-top" style="width: 100%;height: 150px;background-color: white">
                <img src="source/image/Sticker/default.jpg" class="w3-circle" alt="Norway" style="width:10%">
            </div>
            <div class="w3-bar w3-white w3-large">
                <button class="w-bar-item w3-button tablink<?php echo ($_GET['page'] == 'Favorite') ? ' w3-light-grey' : ''; ?>"
                        style="outline:none;" onclick="openPage(event,'Favorite')">播放清單
                </button>
                <button class="w-bar-item w3-button tablink<?php echo (isset($_GET['page']) && $_GET['page'] == 'Subscription') ? ' w3-light-grey' : ''; ?>"
                        style="outline:none;" onclick="openPage(event,'Subscription')">訂閱頻道
                </button>
                <button class="w-bar-item w3-button tablink<?php echo (isset($_GET['page']) && $_GET['page'] == 'Personal_info') ? ' w3-light-grey' : ''; ?>"
                        style="outline:none;" onclick="openPage(event,'Personal_info')">個人資料
                </button>
                <button class="w-bar-item w3-button tablink<?php echo (isset($_GET['page']) && $_GET['page'] == 'Upload_Video') ? ' w3-light-grey' : ''; ?>"
                        style="outline:none;" onclick="openPage(event,'Upload_Video')">上傳影片
                </button>
            </div>
            <!--播放清單-->
            <div id="Favorite" class="w3-container page"
                 style="display:<?php echo ($_GET['page'] == 'Favorite') ? 'block;' : 'none;'; ?>">
                <h2>
                    <?php
                    $count = 0; //計算播放清單;
                    if (isset($_SESSION['member']['Email'])) {
                        $member = $_SESSION['member']['Email'];
                        $sql = "SELECT `Play_List_ID`, `Play_List_Name` FROM `play_list` WHERE `Email` LIKE '$member'";
                        $result = mysqli_query($member_link, $sql);
                        if ($result) {
                            while ($Show = $result->fetch_assoc()) {
                                $count = $count + 1;
                                ?>
                                <!-- 在這裡面塞html-->
                                <a href="play_list.php?list=<?php echo $Show['Play_List_ID']; ?>"
                                   class="w3-bar-item w3-button w3-padding"><?php echo $Show['Play_List_Name']; ?></a>
                                <!-- 在這裡面塞html-->
                                <?php
                            }
                            if (!$count) {
                                echo '您尚未建立播放清單!!';
                            }
                        } else {
                            die('用戶訂閱搜尋失敗');
                        }
                    }
                    ?>
                </h2>
            </div>
            <!--訂閱內容-->
            <div id="Subscription" class="w3-container page"
                 style="display:<?php echo (isset($_GET['page']) && $_GET['page'] == 'Subscription') ? 'block;' : 'none;'; ?>">
                <h2><?php
                    $count = 0; //計算訂閱頻道;
                    if (isset($_SESSION['member']['Email'])) {
                        $member = $_SESSION['member']['Email'];
                        $sql = "SELECT `Channel_Master` FROM `subscription` WHERE `Subscriber` LIKE '$member'";
                        $result = mysqli_query($member_link, $sql);
                        if ($result) {
                            while ($Show = $result->fetch_assoc()) {
                                $count = $count + 1;
                                $sql = "SELECT `First_name` FROM `mem_info` WHERE `Email` LIKE '$Show[Channel_Master]'";
                                $result_name = mysqli_query($member_link, $sql);
                                $Show_name = $result_name->fetch_assoc();
                                ?>
                                <a href="#"
                                   class="w3-bar-item w3-button w3-padding"><?php echo $Show_name['First_name']; ?></a>
                                <?php
                            }
                            if (!$count) {
                                echo '您尚未訂閱任何頻道!!';
                            }
                        } else {
                            die('用戶訂閱搜尋失敗');
                        }
                    }

                    ?>
                </h2>
            </div>
            <!--個人資料-->
            <div id="Personal_info" class="w3-container page"
                 style="display:<?php echo (isset($_GET['page']) && $_GET['page'] == 'Personal_info') ? 'block;' : 'none;'; ?>">
                <h1>個人資料</h1>
                <pre>
                    <ul class="w3-ul w3-large">
                        <li>名字 <?php echo $mem_info['Last_name'] . '&nbsp;' . $mem_info['First_name']; ?></li>
                        <li>信箱 <?php echo $mem_info['Email']; ?></li>
                        <li>密碼              </li>
                        <li>手機號碼 <?php echo $mem_info['Phone']; ?></li>
                        <li>生日 <?php echo $mem_info['Birthday']; ?></li>
                    </ul>
               <pre>
            </div>
            <!--上傳影片-->
            <div id="Upload_Video" class="w3-container page"
                 style="display:<?php echo (isset($_GET['page']) && $_GET['page'] == 'Upload_Video') ? 'block;' : 'none;'; ?>">
                <div id="video_list" class="w3-main" style="margin-top:43px; z-index: 4;">
                    <ul class="w3-ul w3-card-4">
                        <?php
                        $count = 0; //計算影片數目;
                        $member = $_SESSION['member']['Email'];
                        $sql = "SELECT `Video_ID`, `Video_Name`, `Video_Watch_Num`, `Video_Date`,`Video_Type` FROM `video_info` WHERE `Video_Uploader` LIKE '$member'";
                        $get_video_info = mysqli_query($video_link, $sql);
                        if ($get_video_info) {
                            while ($video_info = $get_video_info->fetch_assoc()) {
                                $count = $count + 1;
                                ?>
                                <li class="w3-bar"
                                    style="cursor: pointer;">
                                    <button id="<?php echo $video_info['Video_ID']; ?>"
                                            onclick="delete_video(this.id);"
                                            class="w3-bar-item w3-button w3-white w3-xlarge w3-right">×
                                    </button>
                                    <img src="source/image/video_img/<?php echo $video_info['Video_ID'] . '.png'; ?>"
                                         class="w3-bar-item  w3-large"
                                         style="width: 200px;height: 100px">
                                    <div class="w3-bar-item">
                                        <span class="w3-large"><?php echo $video_info['Video_Name']; ?></span><br>
                                        <span class="w3-large">上傳時間:<?php echo $video_info['Video_Date']; ?></span><br>
                                        <span class="w3-large">觀看次數:<?php echo $video_info['Video_Watch_Num']; ?></span>
                                    </div>
                                </li>
                                <?php
                            }
                        } else {
                            die('gg');
                        }
                        if (!$count) {
                            echo '您尚未上傳任何一部影片!!';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End page content -->
<script>
    function openPage(evt, pageName) {
        var i;
        var x = document.getElementsByClassName("page");
        var tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
            tablinks[i].className = tablinks[i].className.replace(" w3-light-grey", "");
        }
        document.getElementById(pageName).style.display = "block";
        evt.currentTarget.className += " w3-light-grey";
        history.replaceState(null, '', 'member_page.php?page=' + pageName); //動態修改影片路徑
    }

    function delete_video(video) {
        document.getElementById(video).parentNode.style.display = 'none';
        //從資料庫裡刪除資料
        //var delete = null;

        $.ajax({
            url: 'Upload_Video/Delete.php',
            dataType: "json",
            async: false,
            type: 'POST',
            data: {Video_ID: video},
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.responseText);
            },
            success: function (result) {
                if (result === 1) {
                    alert('刪除資料庫成功!!');
                }else {
                    alert('刪除資料庫失敗!!');
                }
            }
        });

        //return delete;
    }
</script>
</body>
</html>