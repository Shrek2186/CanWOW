<!--  影片資訊 -->
<div class="container-fluid bg-clear" id="video-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-offset-1 col-lg-10 padding">
                <div class="row">
                    <div class="col-sm-12 title-name"><h3><?php echo $video_name ?></h3></div>
                    <div class="col-sm-12">
                        <div class="row fixed-h">
                            <div class="col-sm-8 ">
                                <video class="float-box" id="<?php echo $_GET['v']; ?>" controls>
                                    <source src="source/video/<?php echo $_GET['v']; ?>.mp4" type="video/mp4">
                                </video>
                                <div class="float-box">

                                    <div id="video-uploader">
                                        <img src="source/image/shrek.jpg">
                                        <div class="subtitle">
                                            <ul class="nav navbar-nav">
                                                <li>
                                                    <button class="btn btn-default"><?php echo $video_uploader ?></button>
                                                </li>
                                                <?php include_once("fang_subscription.php"); ?>
                                                <li><?php include_once "fang_collect_list.php"; ?></li>
                                            </ul>
                                        </div>
                                        <div style="padding-top: 1.5em"><!--    padding-top    -->
                                            <button class="btn btn-default">觀看次數：<?php echo $video_watch ?></button>
                                            <button class="btn btn-default">影片分類：<?php echo $video_class ?></button>
                                            <button class="btn btn-default">上傳日期：<?php echo $upload_date ?></button>
                                        </div>
                                        <div style="padding-top: 1.5em"><!--    padding-top    -->
                                            <?php include_once "Video_Mood.php"; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 auto-h">
                                <div class="float-box-dark">
                                    <div id="chartContainer"></div>
                                    <!-- 標籤 -->
<!--                                    --><?php //include 'Video_Tag/index.php' ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 頁面標籤 -->
<div class="container-fluid bg-clear">
    <div class="container">
        <div class="row">
            <div class="col-lg-offset-1 col-lg-10 padding">
                <div class="row">
                    <div class="col-sm-12 title-name subtitle">
                        <ul class="nav navbar-nav">
                            <li class="active"><a data-toggle="tab" href="#menu-1">商品介紹</a></li>
                            <li><a data-toggle="tab" href="#menu-2">代言商品</a></li>
                            <li><a data-toggle="tab" href="#menu-3">留言</a></li>
                            <li><a data-toggle="tab" href="#menu-4">問與答</a></li>
                        </ul>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>


<!-- 留言區 -->
<div class="container-fluid bg-clear">
    <div class="container padding">
        <div class="row">
            <div class=" col-lg-10 col-lg-offset-1">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="tab-content">
                            <div id="menu-1" class="subtitle tab-pane fade in active">
                                <div class="title-name subtitle">
                                    <ul class="nav navbar-nav">
                                        <li><a>商品介紹</a></li>
                                    </ul>
                                </div>
                                <div class="float-box"><?php echo $video_intro ?></div>
                            </div>
                            <div id="menu-2" class="subtitle tab-pane fade">
                                <div class="title-name subtitle">
                                    <ul class="nav navbar-nav">
                                        <li><a>代言商品</a></li>
                                    </ul>
                                </div>
                                <div class="float-box">
                                    <ul id="goodContainer"></ul>
                                </div>
                            </div>
                            <div id="menu-3" class="subtitle tab-pane fade">
                                <div class="title-name subtitle">
                                    <ul class="nav navbar-nav">
                                        <li><a>留言</a></li>
                                    </ul>
                                </div>
                                <div class="float-box">
<!--                                    --><?php //include_once "vedeo_play_showMessage.php" ?>
                                </div>
                            </div>
                            <div id="menu-4" class="subtitle tab-pane fade">
                                <div class="title-name subtitle">
                                    <ul class="nav navbar-nav">
                                        <li><a>問與答</a></li>
                                    </ul>
                                </div>
                                <div class="float-box"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="title-name subtitle">
                            <ul class="nav navbar-nav">
                                <li><a>最新消息</a></li>
                            </ul>
                        </div>
                        <div class="float-box">
                        </div>
                        <div id="chartContainer"></div>
                        <div id="next_or_pre_page_bottom"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2"></div>
        </div>
    </div>
</div>
