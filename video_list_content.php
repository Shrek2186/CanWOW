<?php
require_once('database/video_open.php');
// 分類
//子分類
//結束子分類
//print_r($_GET['Recommend_Info']);
$sql_classification = $_GET['Recommend_Info'][0];
// 結束分類

$Recommand_Type = $_GET['Recommend_Info'][1];
$Recommand_Type_Icon = 'glyphicon glyphicon-alert'; //推薦列表的標題前面得icon
// 推薦:熱門
if ($Recommand_Type == '熱門') {
    $sql_order_by = 'Video_Watch_Num DESC';

    $sql = "SELECT video_info.Video_ID,`Video_Name`,`Video_Type`,`Video_Uploader`,`Path`,`Video_Date`,`First_name` FROM video.video_info LEFT JOIN
                member.mem_info ON video.video_info.Video_Uploader = member.mem_info.Email LEFT JOIN video.statistics ON 
                video.video_info.Video_ID = video.statistics.Video_ID WHERE Classification LIKE '$sql_classification' ORDER BY $sql_order_by LIMIT 3";

    $Recommand_Type_Icon = 'glyphicon glyphicon-thumbs-up'; //推薦列表的標題前面得icon
}
//推薦:最新
if ($Recommand_Type == '最新') {
    $sql_order_by = 'Video_Date DESC';

    $sql = "SELECT video_info.Video_ID,`Video_Name`,`Video_Type`,`Video_Uploader`,`Path`,`Video_Date`,`First_name` FROM video.video_info LEFT JOIN
                member.mem_info ON video.video_info.Video_Uploader = member.mem_info.Email LEFT JOIN video.statistics ON 
                video.video_info.Video_ID = video.statistics.Video_ID WHERE Classification LIKE '$sql_classification' ORDER BY $sql_order_by LIMIT 3";

    $Recommand_Type_Icon = 'glyphicon glyphicon-time'; //推薦列表的標題前面得icon
}
//推薦:訂閱
if (explode(" ", $Recommand_Type)[0] == '訂閱') {
    $sql_Channel_Master = explode(" ", $Recommand_Type)[1];
    $sql_order_by = 'Video_Date DESC';
    $sql_where = "`Classification` LIKE '$sql_classification' AND `Video_Uploader` Like '$sql_Channel_Master'";

    $sql = "SELECT video_info.Video_ID,`Video_Name`,`Video_Type`,`Video_Uploader`,`Path`,`Video_Date`,`First_name` FROM video.video_info LEFT JOIN
                member.mem_info ON video.video_info.Video_Uploader = member.mem_info.Email LEFT JOIN video.statistics ON 
                video.video_info.Video_ID = video.statistics.Video_ID WHERE $sql_where ORDER BY $sql_order_by LIMIT 3";

    $Recommand_Type_Icon = 'glyphicon glyphicon-pushpin'; //推薦列表的標題前面得icon
}


if ($result = mysqli_query($video_link, $sql)) {
    $i = 0;
    while ($Show = $result->fetch_assoc()) {
        $Video_Recommand[$i] = $Show;
        $i = $i + 1;
    }

    if (isset($Video_Recommand)) {
        if (explode(" ", $Recommand_Type)[0] == '訂閱') {
            $Recommand_Type = explode(" ", $Recommand_Type)[0] . ": " . $Video_Recommand[0]['First_name'];
        }
    }
    ?>
    <?php if (isset($Video_Recommand)) { ?>
        <div class="container">
            <div class="panel-group">

                <div class="panel panel-default ">
                    <div class="panel-heading"><span
                                class="<?php echo $Recommand_Type_Icon;?>"></span> <?php echo $Recommand_Type; ?></div>
                    <div class="panel-body">
                        <div class="row text-center">
                            <?php
                            foreach ($Video_Recommand as $Video) {
                                ?>
                                <div class="col-sm-4">
                                    <a href="video_play.php?v=<?php echo $Video['Video_ID']; ?>">
                                        <div class="thumbnail">
                                            <img src="https://img.youtube.com/vi/<?php echo $Video['Path']; ?>/sddefault.jpg"
                                                 alt="Paris">
                                            <p><strong><?php echo $Video['Video_Name']; ?></strong></p>
                                            <p><?php echo $Video['Video_Date']; ?></p>
                                            <p><?php echo $Video['First_name']; ?></p>
                                        </div>
                                    </a>
                                </div>
                                <?php
                            } ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <?php
    }
    ?>
<?php } else {
    echo '搜尋資料庫失敗!!<br>' . $sql . '<br>';
}