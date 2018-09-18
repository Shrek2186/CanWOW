<?php
require_once('database/play_list_open.php');
require_once('database/mem_info_open.php');
$play_List = $_POST['playList'];
//echo $_POST['member_Email'] . '<br>';
//echo $_POST['Video_ID'] . '<br>';
//echo $_POST['ori_pageLocation'] . '<br>';
//print_r($play_List);
//echo '<br>';
foreach ($play_List as $p) {
    /*
    $sql = "INSERT INTO `$p` (`Video_ID`, `date`) VALUES ('$_POST[Video_ID]', CURRENT_TIMESTAMP);";
    //echo $sql . '<br>';
    $result = mysqli_query($playList_link, $sql);
    */
    $sql = "UPDATE `play_list` SET Video_ID = CONCAT(Video_ID,',$_POST[Video_ID]'), `Video_Contain_Num` = Video_Contain_Num+1 WHERE `Play_List_ID` LIKE '$p'";
    $result_1 = mysqli_query($member_link, $sql);
    echo $sql;
    if ($result_1) {
        ?>
        <script>
            window.location.replace('<?php echo $_POST['ori_pageLocation'];?>');
        </script>
        <?php
    } else {
        die('gg');
    }
    /*
        $sql = "UPDATE `play_list` SET Video_Contain_Num = Video_Contain_Num+1 WHERE `Play_List_ID` LIKE '$p'";
        $result_num = mysqli_query($member_link, $sql);
        if ($result && $result_num) {
            ?>
            <script>
                window.location.replace('<?php echo $_POST['ori_pageLocation'];?>');
            </script>
            <?php
        } else {
            die('新增收藏影片失敗!!');
        }*/
}