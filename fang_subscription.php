<?php
include_once("database/mem_info_open.php");
//   ------ 搜尋頻道主的訂閱次數 ---------------------------------------------------------------------------------------------------------------------
$sql = "SELECT `Subscribed_Num` FROM `video_uploader` WHERE `Email` LIKE '$video_uploader'";
$result = mysqli_query($member_link, $sql);     //執行sql
if ($result) {
    if ($Sub_num = $result->fetch_assoc()) {
        // echo "訂閱( $Sub_num[Subscribed_Num])";
    } else {
        echo '搜尋頻道主訂閱次數出現問題!!' . '<br>';
        echo $sql;
    }
} else {
    echo '搜尋頻道主訂閱次數失敗!!';
} ?>
<li><button class="btn btn-default"><i class="fa fa-thumb-tack"></i><?php echo $Sub_num['Subscribed_Num']; ?></button>
    <?php
    //   ------ 訂閱功能 -----------------------------------------------------------------------------------------------------------------------------------
    if (isset($_SESSION['member']['Email'])) {      //判斷有無登入，若沒有則顯示登入的超連結
        $subscriber = $_SESSION['member']['Email'];     //取得目前登入者的Email
        $Channel_Master = $video_uploader;    //取得影片上傳者(頻道主)的Email
        $sql = "SELECT `Subscription_ID` FROM `subscription` WHERE `Subscriber` LIKE '$subscriber' AND `Channel_Master` LIKE '$Channel_Master'";    //搜尋該登入者是否有訂閱該頻道主
        $result = mysqli_query($member_link, $sql);     //執行sql
        if ($result) {      //資料庫搜尋成功
            $Sub = $result->fetch_assoc();      //取得資料(該登入者是否有訂閱該頻道主)
            //瑛志覺得不用這個吧! echo ($Sub) ? "已訂閱!!" : "未訂閱!!";    //判斷$Sub為True則是已訂閱，False則是未訂閱
            ?>
            <form id="subscri_form" method="post" action="subscription.php" style="position: absolute; z-index: -1;">
                <input type="hidden" name="subscriber" value="<?php echo $subscriber; ?>">
                <input type="hidden" name="Channel_Master" value="<?php echo $Channel_Master; ?>">
                <input type="hidden" name="Sub_or_unSub"
                       value="<?php echo ($Sub) ? 0 : 1; //判斷是要進行訂閱還是取消訂閱，若已訂閱則顯示0(取消訂閱)，未訂閱顯示1(訂閱)?>">
                <input type="hidden" name="ori_pageLocation"
                       value="<?php echo $_SERVER['REQUEST_URI']; //顯示當前網址(回傳用)?>">
                <!--            <input type="submit"-->
                <!--                   value="--><?php //echo ($Sub) ? "取消" : ""; ?><!--訂閱 ( -->
                <?php //echo $Sub_num['Subscribed_Num'] ?><!-- )">-->
            </form>
            <button  id="thumb-button" type="button" class="btn hvr-icon-pop" style="background-color: dimgray;
    color: whitesmoke;
    letter-spacing: 1px;"
                    onclick="document.getElementById('subscri_form').submit();">
                <?php if ($Sub) { ?>
                    <i class="fa fa-minus-circle hvr-icon"></i>取消訂閱
                <?php } else { ?>
                    <i class="fa fa-plus-circle hvr-icon"></i>訂閱
                <?php } ?>
            </button>
            <?php
        } else {    //資料庫搜尋失敗
            echo '是否訂閱搜尋失敗!!' . '<br>';
        }
    } else {     //未登入
        ?>
        <button id="thumb-button" type="button" class="btn hvr-icon-pop " style="background-color: dimgray;
    color: whitesmoke;
    letter-spacing: 1px;" onclick="alert('需登入才可訂閱喔!!');">
            <i class="fa fa-plus-circle hvr-icon"></i>訂閱
        </button>
        <?php
    }
    //   ------ 結束訂閱功能 -------------------------------------------------------------------------------------------------------------------------------
    ?>
</li>