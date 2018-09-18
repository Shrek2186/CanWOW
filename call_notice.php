<?php
require_once('database/mem_info_open.php');
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['member'])) {
    $Email = $_SESSION['member']['Email'];
    //echo '您的通知:' . '<br>';
    //----------------------代言廣告邀請通知-------------------------------
    $sql = "SELECT `Event_ID`,`Requester`,`Content`,`Status`,`Event_Type`,`date` FROM `event` WHERE `Event_ID` LIKE '$_POST[Event_ID]'";
    $result = mysqli_query($member_link, $sql);
    if ($result) {
        if ($Show = $result->fetch_assoc()) {            //印出該通知

            if ($Show['Event_Type'] == 1) {       //通知 : 代言廣告邀請
                $Message['Ad_Req_content'] = explode("u3h_m_5a1", $Show['Content']);
                //print_r($Message['Ad_Req_content']);
                //$Req_Content_Num = 7;
                //$Mes_Ad_Req_Num = (count($Message['Ad_Req_content']) - 1) / $Req_Content_Num;
                echo '通知類型: 代言廣告邀請' . '<br>';
                echo '通知時間: ' . $Show['date'] . '<br>';
                echo '委託人: ' . $Show['Requester'] . '<br>';
                echo '委託商品: ' . '<a href="#">' . $Message['Ad_Req_content'][2] . '</a><br>';
                echo '代言影片: ' . '<a href="video_play.php?v=' . $Message['Ad_Req_content'][3] . '">' . $Message['Ad_Req_content'][4] . '</a><br>';
                echo '合約: ' . '<br>' . nl2br($Message['Ad_Req_content'][5]) . '<br>';
                echo '希望代言時間: ' . $Message['Ad_Req_content'][6] . '~' . $Message['Ad_Req_content'][7] . '<br><br>';
                //$Message['Ad_Request'][$Mes_Ad_Req_Content*$count+9] = 1;  代表觀看過了
                switch ($Show['Status']) {      //判斷代言邀請狀態

                    case 0:            //尚未做出代言回覆
                    case 1:
                        ?>
                        <form action="Ad_Request_Check.php" method="post">
                            <input type="hidden" name="Event_ID" id="Event_ID" value="<?php echo $Show['Event_ID']; ?>">
                            <input type="hidden" name="Deliver" id="Deliver" value="<?php echo $Email; ?>">
                            <input type="hidden" name="Receiver" id="Receiver" value="<?php echo $Show['Requester'] ?>">
                            <input type="hidden" name="Video_ID" id="Video_ID"
                                   value="<?php echo $Message['Ad_Req_content'][3]; ?>">
                            <input type="hidden" name="Good_ID" id="Good_ID"
                                   value="<?php echo $Message['Ad_Req_content'][1]; ?>">
                            <input type="submit" name="accept" id="accept" value="Accept"/>
                            <input type="submit" name="refuse" id="refuse" value="Refuse"/>
                        </form>
                        <?php
                        break;
                    case 2:             //接受代言回覆
                        echo '已接受此代言邀請!!'; break;
                    case 3:
                        echo '已拒絕此代言邀請!!'; break;
                }
            }

            if ($Show['Event_Type'] == 2) {       //通知 : 代言廣告邀請回覆
                $Message['Ad_Req_Reply'] = explode("u3h_m_5a1", $Show['Content']);
                echo '通知類型: 代言廣告邀請回覆' . '<br>';
                echo '通知時間: ' . $Show['date'] . '<br>';
                echo '委託結果: ' . $Show['Requester'] . $Message['Ad_Req_Reply'][1] . '您的代言邀請' . '<br>';
                ?>
                <form action="" method="post">
                    <input type="submit" name="ARR_Event" id="ARR_Event" value=" 點擊此處查看您的代言邀請!!">
                </form>
                <?php
            }
        } else {
            echo('無此通知');
        }

    } else {
        echo('搜尋通知失敗!!');
    }
    //----------------------End-------------------------------
} else {
    echo '您尚未登入網站喔!!';
}
?>


<!--   上一版的
            <form action="Ad_Request_Check.php" method="post">
                <input type="hidden" name="Event_ID" id="Event_ID" value="<?php //echo $Message['Ad_Req_content'][8];?>">
                <input type="hidden" name="Deliver" id="Deliver" value="<?php //echo $_SESSION['member']['Email'];?>">
                <input type="hidden" name="Receiver" id="Receiver" value="<?php //echo $Show['Requester'];?>">
                <input type="hidden" name="Video_ID" id="Video_ID"
                       value="<?php //echo $Message['Ad_Req_content'][3]; ?>">
                <input type="hidden" name="Good_ID" id="Good_ID"
                       value="<?php //echo $Message['Ad_Req_content'][1]; ?>">
                <input type="submit" name="accept" id="accept" value="Accept"/>
                <input type="submit" name="refuse" id="refuse" value="Refuse"/>
            </form>
-->

