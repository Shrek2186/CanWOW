<!--
<!DOCTYPE html>
<html>
<head>
    <title>Page Title</title>
    <script type="text/javascript" src="js/jquery.js"></script>
</head>
<body>

<form method="post" action="send_Ad_request.php">
    <input type="hidden" name="Requester" id="Requester" value="<?php //echo $_SESSION['member']['Email']?>">
    <input type="hidden" name="Video_ID" id="Video_ID" value="<?php //echo 'first';?>">
    <input type="hidden" name="Video_Name" id="Video_Name" VALUE="<?php // echo 'The Chainsmokers & Coldplay - Something Just Like This (Lyric)';?>">
    <ul>
        <li><input type="text" name="Good_ID" id="Good_ID" placeholder="您想代言的商品是"></li>
        <li><textarea name="Contract" id="Contract" type="text" rows="20" cols="65" placeholder="合約"></textarea></li>
        <li><label>代言開始日期：</label><br/>
            <select name="b_year" id="b_year" class="sel_year" rel="2018"></select>
            <select name="b_month" id="b_month" class="sel_month" rel="2"></select>
            <select name="b_date" id="b_date" class="sel_day" rel="21"></select></li>
        <li><label>代言結束日期：</label><br/>
            <select name="e_year" id="e_year" class="sel_year" rel="2018"></select>
            <select name="e_month" id="e_month" class="sel_month" rel="2"></select>
            <select name="e_date" id="e_date" class="sel_day" rel="22"></select></li>
    </ul>
    <input type="submit" value="送出代言申請">
</form>

</body>
<script type="text/javascript" src="js/request_date.js"></script>    時間下拉條的js檔
<script>
    $(function () {
        $.ms_DatePicker({
            YearSelector: ".sel_year",
            MonthSelector: ".sel_month",
            DaySelector: ".sel_day"
        });
        $.ms_DatePicker();
    });
</script>
</html>
-->
<?php
include("Navigation.php");
require_once('database/good_open.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Page Title</title>
    <script type="text/javascript" src="js/jquery.js"></script>
    <style>
        * {
            box-sizing: border-box;
        }

        input[type=text], select, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
        }

        label {
            padding: 12px 12px 12px 0;
            display: inline-block;
        }

        input[type=submit] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float: right;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }

        .container {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
        }

        .col-25 {
            float: left;
            width: 16.66%;
            margin-top: 6px;
        }

        .col-50 {
            float: left;
            width: 50%;
            margin-top: 6px;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
        @media (max-width: 600px) {
            .col-25, .col-50, input[type=submit] {
                width: 100%;
                margin-top: 0;
            }
        }
    </style>
</head>
<body>
<div id="video_list" class="w3-main" style="margin-top:43px; z-index: 4;">
    <div class="w3-container">
        <form method="post" action="send_Ad_request.php">
            <input type="hidden" name="Requester" id="Requester" value="<?php echo $_SESSION['member']['Email'] ?>">
            <input type="hidden" name="Video_ID" id="Video_ID" value="<?php echo $_GET['v_id']; ?>">
            <input type="hidden" name="Video_Name" id="Video_Name" VALUE="<?php echo $_GET['v_na']; ?>">
            <div class="row">
                <div class="col-25">
                    <label for="fname">代言商品</label>
                </div>
                <div class="col-50">
                    <!--<input type="text" name="Good_ID" id="Good_ID" placeholder="您想代言的商品是">-->

                    <?php
                    if (!isset($_SESSION)) {
                        session_start();
                    }
                    if (isset($_SESSION['member']['Email'])) {
                        $count = 0;
                        $Member = $_SESSION['member']['Email'];
                        $sql = "SELECT `Good_ID`,`Good_Name` FROM `good_info` WHERE `Seller` LIKE '$Member'";
                        if ($result = mysqli_query($good_link, $sql)) {
                            ?>
                            <select name="Good_ID" id="Good_ID">
                                <?php
                                while ($good = $result->fetch_assoc()) {
                                    echo '<option value="' . $good['Good_ID'] . '">' . $good['Good_Name'] . '</option>';
                                    $count = $count + 1;
                                }
                                if (!$count) {
                                    echo '<option value="" >您還尚未擁有商品喔!!</option>';
                                }
                                ?>
                            </select>
                            <?php
                        } else {
                            echo '搜尋用戶商品失敗';
                            echo $sql.'<br>';
                        }
                    } else {
                        echo '請先登入';
                    }
                    ?>

                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label>代言開始日期</label>
                </div>
                <div class="col-25">
                    <select name="b_year" id="b_year" class="sel_year" rel="2018"></select>
                </div>
                <div class="col-25">
                    <select name="b_month" id="b_month" class="sel_month" rel="2"></select>
                </div>
                <div class="col-25">
                    <select name="b_date" id="b_date" class="sel_day" rel="21"></select>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label>代言結束日期</label>
                </div>
                <div class="col-25">
                    <select name="e_year" id="e_year" class="sel_year" rel="2018"></select>
                </div>
                <div class="col-25">
                    <select name="e_month" id="e_month" class="sel_month" rel="2"></select>
                </div>
                <div class="col-25">
                    <select name="e_date" id="e_date" class="sel_day" rel="22"></select>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="subject">代言合約</label>
                </div>
                <div class="col-50">
                    <textarea name="Contract" id="Contract" type="text" style="height:200px"
                              placeholder="合約"></textarea>
                </div>
            </div>
    </div>
    <div class="row">
        <input class="w3-button w3-block" type="submit" value="送出代言申請">
    </div>
    </form>

</div>

</body>
<script type="text/javascript" src="js/request_date.js"></script>   <!-- 時間下拉條的js檔-->
<script>
    $(function () {
        $.ms_DatePicker({
            YearSelector: ".sel_year",
            MonthSelector: ".sel_month",
            DaySelector: ".sel_day"
        });
        $.ms_DatePicker();
    });
</script>
</html>