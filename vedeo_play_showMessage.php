<?php
//if (!isset($_SESSION)) {
//    session_start();
//}
require_once("Connect_Video.php");
require_once("Connect_Member.php");
require_once("database/mem_info_open.php");     // 方方
require_once("database/play_list_open.php");   // 方方
require_once("database/good_open.php");
require_once("database/video_open.php");
$Video_ID = $_GET['v'];
?>

<!--------------------------留言板-------------------------->
<div>
    <?php
    if (isset($_SESSION['member']['Email'])) {
        ?>
        <div style="width: 50%;margin: 20px 0;">
            <div>
                <!--                <img src="libs/img/logo.jpg" class="w3-circle uploader-img-box">-->
            </div>
            <form action="Guestbook_Action.php" method="post" name="Guest_Book">
                <input required
                       type="hidden"
                       name="Video_ID"
                       value="<?php echo($_GET['v']) ?>"
                       placeholder="ID">
                <div>
                    <!--留言-->
                    <input class="w3-input" style="width:100%;background-color: #444444;border-bottom-color: grey"
                           type="text" name="Content"
                           placeholder="新增留言" required>
                </div>
                <div>
                    <input type="submit"
                           class="w3-round w3-right"
                           style="padding: 5px 10px;margin-top: 5px;border-color:#bd4147;background-color:transparent;cursor:pointer;font-size: 16px;color: white"
                           name="" value="送出">
                </div>
            </form>
        </div>
        <?php
    } ?>

</div>
<!------------------------留言板結束------------------>

<!------------------------搜尋影片留言---------------------------->
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
    <div id="comment" style="margin: 10px 0">
        <!----------------------留言---------------------->
        <div>
            <div>
                <!--            <img src="source/image/logo.jpg" class="w3-circle uploader-img-box">-->
            </div>
            <div>
                <!--留言者名稱-->
                <?php print("$row_giver[First_name]"); ?>
            </div>
            <div>
                <!--留言-->
                <?php print("$row_guest[Content]"); ?>
            </div>
            <div>
                <!--每個留言都有一個回覆表單-->
                <form action="Reply_Action.php" method="post">
                    <input type="hidden" name="Guestbook_ID" value="<?php echo("$row_guest[Guestbook_ID]") ?>"
                           placeholder="ID">
                    <input required type="hidden" name="Video_ID" value="<?php echo($_GET['v']) ?>"
                           placeholder="ID">
                    <div class="input-group" style="width: 30%">
                        <input type="text" name="Content"
                               class="form-control"
                               style="background-color: #444444;border-color: grey; color: white" placeholder="新增回覆"
                               required>
                        <div class="input-group-btn">
                            <input type="submit" value="回覆"
                                   class="btn btn-default"
                                   style="border-color:#bd4147;background-color:transparent;cursor:pointer;color: white">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!----------------------留言 結束---------------------->
        <!---------------------搜尋所有回覆---------------------------->
        <?php //echo("<br>");
        $select_reply = $Connect->prepare("SELECT Giver, Content FROM Guest_Book_Reply WHERE Guestbook_ID=:id");
        $select_reply->bindValue(':id', "$row_guest[Guestbook_ID]", PDO::PARAM_STR);
        $select_reply->execute();
        //若有回覆則顯示回覆按鈕
        if ($select_reply->rowCount() > 0) {
            ?>
            <!----------------------回覆框收縮按鈕---------------------->
            <button id="Look_Reply<?php echo $reply_ID ?>"
                    onclick="ReplyButt(this.id, 'All_Reply<?php echo $reply_ID ?>')"
                    style="border: 0; background-color: transparent; padding: 0"
                    class="">
                查看回覆
            </button>
            <!----------------------回覆框收縮按鈕 結束---------------------->
            <?php
        }
        //印出所有關於Guestbook_ID的回覆（Content)以及回覆者（Giver）?>
        <!-------------印出回覆 (p.s.把全部留言包起來，但萬一有很多留言就會直接全部顯示呦)---------------->
        <div id="All_Reply<?php echo $reply_ID ?>" style="display: none">
            <?php
            while ($row_reply = $select_reply->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <!--            回覆div-->
                <div style="margin-top: 5px; margin-left: 25px">
                    <div>
                        <!--                    <img src="source/image/logo.jpg" class="w3-circle uploader-img-box">-->
                    </div>
                    <div>
                        <!--留言者名稱-->
                        <?php print("$row_giver[First_name]"); ?>
                    </div>
                    <div>
                        <!--留言-->
                        <?php print("$row_reply[Content]"); ?>
                    </div>
                    <div>
                        <!----------------回覆-------------------->
                        <form action="Reply_Action.php" method="post">
                            <input type="hidden" name="Guestbook_ID"
                                   value="<?php echo("$row_guest[Guestbook_ID]") ?>"
                                   placeholder="ID">
                            <input required type="hidden" name="Video_ID" value="<?php echo($_GET['v']) ?>"
                                   placeholder="ID">
                            <div class="input-group" style="width: 30%">
                                <input type="text" name="Content"
                                       class="form-control"
                                       style="color:white; background-color: #444444;border-color: grey" placeholder="新增回覆"
                                       required>
                                <div class="input-group-btn">
                                    <input type="submit" value="回覆"
                                           class="btn btn-default"
                                           style="border-color:#bd4147;background-color:transparent;cursor:pointer;color: white">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <?php
            }
            ?>
        </div>
    </div>
    <?php
    $reply_ID = $reply_ID + 1;
}
?>

<!---------------------所有的回覆div結束---------------------------->

<script>
    //--------------查看回覆按鈕---------------
    function ReplyButt(Reply_IDName) {
        alert('aa');
        var x = document.getElementById(Reply_IDName);
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }

    //-------------查看回覆按鈕結束------------
</script>
