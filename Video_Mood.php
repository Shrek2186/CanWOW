<!--------------評價div---------------->
<div class="feeling-box">
    <?php
    include_once("database/video_open.php");
    //   ------ 評價功能 -----------------------------------------------------------------------------------------------------------------------------------
    $feeling_type = array("like", "dislike", "heart", "laugh", "sad", "shock", "angry");
    $feeling_icon = array();
    //print_r($feeling_type);
    foreach ($feeling_type as $index => $type) {
        $sql = "SELECT COUNT(Email) AS type_sum FROM feeling WHERE Video_ID LIKE '$_GET[v]' AND `Feeling_Type` = $index";
        if ($result = mysqli_query($video_link, $sql)) {
            if ($sum = $result->fetch_assoc()) {
                if (isset($_SESSION['member']['Email'])) {
                    $member = $_SESSION['member']['Email'];
                    $sql = "SELECT `Email` FROM `feeling` WHERE `Email` LIKE '$member' AND `Feeling_Type` = $index AND `Video_ID` LIKE '$_GET[v]'";
                    //echo '<br>'.$sql.'<br>';
                    if ($result = mysqli_query($video_link, $sql)) {
                        $hint = $result->fetch_assoc();
                    } else {
                        echo '搜尋此用戶是否評價過此影片失敗';
                    }
                }
                ?>
<!--                <span onclick="feeling(--><?php //echo $index; ?><!--)"-->
                   <!--style="cursor: pointer; --><?php //echo isset($hint) && $hint ? 'color: red;' : ''; ?><!--">--><?php //echo $type; ?><!--</span> :-->
                <?php
                switch ($type) {
                    case 'like' :
//                        echo '<button type="button" class="btn hvr-icon-up" onclick="feeling(' . $index . ')"><i class="fa fa-thumbs-up hvr-icon"></i></button>';
                        echo '<button class="btn" type="button" onclick="feeling(' . $index . ')">可用</button>';
                        break;
                    case 'dislike' :
//                        echo '<button type="button" class="btn hvr-icon-down" onclick="feeling(' . $index . ')"><i class="fa fa-thumbs-down hvr-icon"></i></button>';
                        echo '<button class="btn" type="button" onclick="feeling(' . $index . ')">不可用</button>';
                        break;
                    case 'heart' :
//                        echo '<button type="button" class="btn hvr-icon-pulse" onclick="feeling(' . $index . ')"><i class="fa fa-heart hvr-icon"></i></button>';
                        echo '<button class="btn" type="button" onclick="feeling(' . $index . ')">真實</button>';
                        break;
                    case 'laugh' :
//                        echo '<button type="button" class="btn hvr-icon-grow" onclick="feeling(' . $index . ')"><i class="fa fa-smile-o hvr-icon"></i></button>';
                        echo '<button class="btn" type="button" onclick="feeling(' . $index . ')">不真實</button>';
                        break;
                    case 'shock' :
//                        echo '<button type="button" class="btn hvr-icon-buzz" onclick="feeling(' . $index . ')"><i class="fa fa-bolt hvr-icon"></i></button>';
                        echo '<button class="btn" type="button" onclick="feeling(' . $index . ')">喜歡</button>';
                        break;
                    case 'angry' :
//                        echo '<button type="button" class="btn hvr-icon-pulse-grow" onclick="feeling(' . $index . ')"><i class="fa fa-fire hvr-icon"></i></button>';
                        echo '<button class="btn" type="button" onclick="feeling(' . $index . ')">檢舉</button>';
                        break;
                    case 'sad' :
//                        echo '<button type="button" class="btn hvr-icon-shrink" onclick="feeling(' . $index . ')"><i class="fa fa-frown-o hvr-icon"></i></button>';
                        echo '<button class="btn" type="button" onclick="feeling(' . $index . ')">不喜歡</button>';
                        break;
                }
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
<!--<div id="video-mood">-->
<!--    <button type="button" class="btn hvr-icon-up"><i class="fa fa-thumbs-up hvr-icon"></i>-->
<!--    </button>-->
<!--    <button type="button" class="btn hvr-icon-down"><i-->
<!--                class="fa fa-thumbs-down hvr-icon"></i>-->
<!--    </button>-->
<!--    <button type="button" class="btn hvr-icon-pulse"><i class="fa fa-heart hvr-icon"></i>-->
<!--    </button>-->
<!--    <button type="button" class="btn hvr-icon-grow"><i class="fa fa-smile-o hvr-icon"></i>-->
<!--    </button>-->
<!--    <button type="button" class="btn hvr-icon-shrink"><i class="fa fa-frown-o hvr-icon"></i>-->
<!--    </button>-->
<!--    <button type="button" class="btn hvr-icon-buzz"><i class="fa fa-bolt hvr-icon"></i>-->
<!--    </button>-->
<!--    <button type="button" class="btn hvr-icon-pulse-grow"><i-->
<!--                class="fa fa-fire hvr-icon"></i>-->
<!--    </button>-->
<!--</div>-->

