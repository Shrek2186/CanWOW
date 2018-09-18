<?php
?>
<div class="dropdown">
    <button type="button" class="btn btn-danger hvr-icon-wobble-vertical dropdown-toggle"
            onclick="Build_List('Build')">
        <i class="fa fa-plus hvr-icon"></i>加入收藏清單
    </button>

    <div class="dropdown-menu" style="background-color: #252525" id="Build">
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
                               class="w3-button w3-hover-black w3-round"
                               style="background-color: #404040">
                        <?php
                    } else {
                        echo '您還未建立播放清單喔';
                    }
                    ?>
                </form>
                <br>
                <form method="post" action="addVideoList.php">
                    <button type="button"
                            class="w3-button w3-hover-black w3-round"
                            style="background-color: #404040"
                            onclick="List('Build_List')"><i class="fa fa-plus-circle hvr-icon"></i> 新增清單
                    </button>
                    <div class="list" id="Build_List" style="display: none">
                            <span onclick="this.parentElement.style.display='none'"
                                  class="w3-button"
                                  style="position: relative; margin-left: 75%">X</span>
                        <h5>清單名稱 : </h5>
                        <input type="hidden" name="member_Email" value="<?php echo $member; ?>">
                        <input type="text" name="Video_List_Name"
                               class="w3-input w3-border w3-round w3-grey" placeholder="請輸入新清單的名稱">
                        <input type="hidden" name="ori_pageLocation"
                               value="<?php echo $_SERVER['REQUEST_URI']; //顯示當前網址(回傳用)?>">
                        <!---------段落間格------------>
                        <div style="height: 10px"></div>
                        <!---------段落間格------------>
                        <input type="submit" value="新增"
                               class="w3-button w3-hover-black w3-round"
                               style="background-color: #404040">
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
