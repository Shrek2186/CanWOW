<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once('database/mem_info_open.php');
require_once('database/play_list_open.php');
require_once('database/video_open.php');
//session_destroy();        //測試用(暫時拿來當刪除鍵)

//插入導覽列
include("Navigation.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CanWOW</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div id="video_list" class="w3-main" style="margin-top:43px; z-index: 4;">
    <ul class="w3-ul w3-card-4">
        <?php
        $sql = "SELECT `Email`,`Video_ID`, `Play_List_Name`, `Play_List_Type`, `Video_Contain_Num`, `Upload_Date` FROM `play_list` WHERE `Play_List_ID` LIKE '$_GET[list]'";
        $result = mysqli_query($member_link, $sql);
        //--------------------播放清單基本資料--------------------
        $playList_info = $result->fetch_assoc();
        //--------------------結束播放清單基本資料--------------------
        ?>
        <li class="w3-bar">
            <button id="<?php echo $_GET['list']; ?>" onclick="delete_list(this.id)"
                    class="w3-bar-item w3-button w3-white w3-xlarge w3-right">×
            </button>
            <!--此影片播放清單的封面，按封面可全部播放-->
            <img src="source/image/logo.jpg" class="w3-bar-item  w3-large" style="width: 200px;height: 100px">
            <div class="w3-bar-item">
                <span class="w3-large"><?php echo $playList_info['Play_List_Name']; ?></span><br>
                <span class="w3-large"><?php echo $playList_info['Email']; ?></span><br>
                <span class="w3-large"><?php echo $playList_info['Video_Contain_Num']; ?></span><br>
                <span class="w3-large"><?php echo $playList_info['Upload_Date']; ?></span>
            </div>
        </li>
        <?php
        //---------------------------------------------------
        //$count = 0; //計算影片數目;
        $member = $_SESSION['member']['Email'];
        $video = explode(",", $playList_info['Video_ID']);
        foreach ($video as $v) {
            if ($v) {
                $sql = "SELECT `Video_Name`, `Video_Uploader`, `Video_ID` FROM `video_info` WHERE `Video_ID` LIKE '$v'";
                $get_video_info = mysqli_query($video_link, $sql);
                if ($get_video_info) {
                    //------------影片名子跟上傳者------------
                    $video_info = $get_video_info->fetch_assoc();
                    //------------結束影片名子跟上傳者------------
                } else {
                    die('gg');
                }
                ?>
                <li class="w3-bar" onclick="document.location.href='video_play.php?v=<?php echo $video_info['Video_ID'];?>';" style="cursor: pointer;">
                    <button id="<?php echo $video_info['Video_ID']; ?>" name="<?php echo $_GET['list']; ?>" style="z-index: 5;"
                            onclick="delete_video(this.name,this.id);"
                            class="w3-bar-item w3-button w3-white w3-xlarge w3-right">×
                    </button>
                    <img src="source/image/video_img/<?php echo $video_info['Video_ID'].'.png';?>" class="w3-bar-item  w3-large"
                         style="width: 200px;height: 100px">
                    <div class="w3-bar-item">
                        <span class="w3-large"><?php echo $video_info['Video_Name']; ?></span><br>
                        <span class="w3-large"><?php echo $video_info['Video_Uploader']; ?></span>
                    </div>
                </li>
                <?php
            }
        }
        if (!$playList_info['Video_Contain_Num']) {
            echo '此清單目前沒有影片!!';
        }
        //----------------------------------------------------
        /*
        $sql = "SELECT * FROM `$_GET[list]`";
        $result = mysqli_query($playList_link, $sql);
        if ($result) {
            while ($video = $result->fetch_assoc()) {
                //$count = $count + 1; //計算影片數目;
                $sql = "SELECT `Video_Name`, `Video_Uploader`, `Video_ID` FROM `video_info` WHERE `Video_ID` LIKE '$video[Video_ID]'";
                $get_video_info = mysqli_query($video_link, $sql);
                if ($get_video_info) {
                    //------------影片名子跟上傳者------------
                    $video_info = $get_video_info->fetch_assoc();
                    //------------結束影片名子跟上傳者------------
                } else {
                    die('gg');
                }
                ?>
                <li class="w3-bar">
                    <button id="<?php echo $video_info['Video_ID']; ?>" name="<?php echo $_GET['list']; ?>"
                            onclick="delete_video(this.name,this.id);"
                            class="w3-bar-item w3-button w3-white w3-xlarge w3-right">×
                    </button>
                    <img src="source/image/video_img/first.png" class="w3-bar-item  w3-large"
                         style="width: 200px;height: 100px">
                    <div class="w3-bar-item">
                        <span class="w3-large"><?php echo $video_info['Video_Name']; ?></span><br>
                        <span class="w3-large"><?php echo $video_info['Video_Uploader']; ?></span>

                    </div>
                </li>
                <?php
            }
            if ($playList_info['Video_Contain_Num']) {
                echo '此清單目前沒有影片!!';
            }
        } else {
            die('用戶基本資料搜尋失敗');
        }*/
        ?>
    </ul>
</div>
</body>
<script>
    //刪除清單頁面的影片
    function delete_video(list, video) {
        document.getElementById(video).parentNode.style.display = 'none';
        //從資料庫裡刪除資料
        //var delete = null;
        $.ajax({
            url: 'Cancel_Collect.php',
            dataType: "json",
            async: false,
            type: 'POST',
            data: {Video_ID: video, videoList: list},
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.responseText);
            },
            success: function (result) {
                if (result === 1) {
                    alert('刪除資料庫成功!!');
                }
                if (result === 0) {
                    alert('刪除資料庫失敗!!');
                }
            }
        });

        //return delete;
    }

    //刪除清單頁面的清單
    function delete_list(list) {
        //從資料庫裡刪除資料
        //var delete = null;
        $.ajax({
            url: 'DeleteVideoList.php',
            dataType: "json",
            async: false,
            type: 'POST',
            data: {playList: list},
            error: function () {
                alert('Ajax request 發生錯誤');
            },
            success: function (result) {
                if (result === 1) {
                    alert('刪除資料庫成功!!');
                    window.location.replace('<?php echo 'member_page.php';?>');
                }
                if (result === 0) {
                    alert('刪除資料庫失敗!!');
                }
            }
        });
        //return delete;
    }
</script>
</html>