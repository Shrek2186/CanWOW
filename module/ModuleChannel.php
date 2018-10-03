<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/canwow-server/' . "control/ControlMember.php";

use shrek\ControlMember as CM;

$cm = new CM();

$array = $cm->SelectChannel($_GET['ID']);
?>

<?php
function PrintChannelList($array)
{
    foreach ($array as $channel) {
        ?>
        <div class="row">
            <div class="col-lg-4">
                <img class="img-responsive" src="libs/img/justin-timberlake-Say%20Something.jpg">
            </div>
            <div class="col-lg-8">
                <div class="row channel-box">
                    <?php if (isset($_COOKIE['memberID'])) { ?>
                        <div onclick="deleteChannel(<?php echo $channel['ID']; ?>)" class="delete-btn">
                            <button class="delete btn">刪除頻道</button>
                        </div>
                    <?php } ?>
                    <div class="col-sm-12">標題：<?php echo $channel['title']; ?></div>
                    <div class="col-sm-12">簡介：<?php echo $channel['content']; ?></div>
                    <div class="col-sm-12">節目數量：<?php echo $channel['sum']; ?></div>
                    <div class="col-sm-12">最近更新時間：<?php echo $channel['update_date']; ?></div>
                </div>
            </div>
        </div>
        <?php
    }
} ?>
<?php
function AddChannelList()
{
    ?>
    <button type="button" class="btn btn-info" data-toggle="collapse"
            data-target="#addChannel">新增頻道
    </button>
    <div id="addChannel" class="collapse">
        <div id="login-controls" class="form-controls">
            <form id="login-form" name="login-form" method="POST" action="">
                <input type="text" name="channel_title" id="channel_title"
                       class="form-control" placeholder="頻道標題"/>
                <input type="text" name="channel_content"
                       id="channel_content"
                       class="form-control" placeholder="頻道簡介"/>
                <button type="submit" name="login" id="login"
                        onclick="addChannel()"
                        class="btn btn-default btn-block btn-custom">建立頻道
                </button>
            </form>
        </div>
    </div>
    <?php
} ?>

<?php
$cm->connect = NULL;
?>

