<!--    個人資料    -->
<?php $r['Video_ID']='KG93D9';
$r['Video_Name']="Justin Timberlake - Say Something (Official Video) ft. Chris Stapleton";
$_GET["Search_Text"]="音樂";
$r['Video_Uploader']='Shrek Huang';
$r['Video_Date']='2018-10-3';
$r['Video_Watch_Num']='1280';?>
<style>
    .stickers-box img {
        border-radius: 0.3em;
        width: 100px;
        vertical-align: middle;
        text-align: center;
        float: left;
    }
</style>
<div class="container-fluid bg-clear" id="video-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-offset-1 col-lg-10 padding">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row fixed-h">
                            <div class="col-sm-12">
                                <div class="float-box">
                                    <div class="row">
                                        <!--    個人照片    -->
                                        <div class="col-lg-2 stickers-box">

                                            <img src="source/image/shrek.jpg"style="margin-left: 10px">
                                            <div class="row" style="text-align: center">
                                                <div class="col-sm-12"><span style="line-height: 50px">Shrek Huang</span></div>
                                                <div class="col-sm-12"><span style="line-height: 50px">上傳者</span></div>
                                                <div class="col-sm-12"><span style="line-height: 50px">創意先驅 <i class="fa fa-rocket"></i></span></div>
                                            </div>
                                        </div>
                                        <!--    個人介紹   -->
                                        <div class="col-lg-10">
                                            <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--    影片清單    -->
<div class="container-fluid bg-clear">
    <div class="container">
        <div class="row">
            <div class="col-lg-offset-1 col-lg-10 padding">
                <div class="row">
                    <div class="col-sm-12 title-name subtitle">
                        <ul class="nav navbar-nav">
                            <li class="active"><a data-toggle="tab" href="#menu-1">影片清單</a></li>
                            <li><a data-toggle="tab" href="#menu-2">代言邀請</a></li>
                            <li><a data-toggle="tab" href="#menu-3">通知</a></li>
                            <li><a data-toggle="tab" href="#menu-4">社群</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--    影片清單    -->
<div class="container-fluid bg-clear">
    <div class="container padding">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="tab-content">
                            <div id="menu-1" class="subtitle tab-pane fade in active">
                                <div class="title-name subtitle">
                                    <ul class="nav navbar-nav">
                                        <li class="active"><a data-toggle="tab" href="#submenu-0">上傳</a></li>
                                        <li><a data-toggle="tab" href="#submenu-1">頻道</a></li>
                                        <li><a data-toggle="tab" href="#submenu-2">收藏</a></li>
                                    </ul>
                                </div>
                                <div class="tab-content">
                                    <div id="submenu-0" class="subtitle tab-pane fade in active">
                                        <div class="float-box">
                                            <h3 style="margin-bottom: 20px">我最近的上傳</h3>
<!--                                        <div class="row">-->
<!--                                            <div class="col-lg-4">-->
<!--                                                <img style="width: 100%" src="libs/img/justin-timberlake-Say%20Something.jpg">-->
<!--                                            </div>-->
<!--                                            <div class="col-lg-8">-->
<!--                                                <p>Justin Timberlake - Say Something (Official Video) ft. Chris Stapleton</p>-->
<!--                                            </div>-->
<!--                                        </div>-->
                                            <div >
                                                <form id="<?php echo $r['Video_ID'] ?>" method="post"
                                                      action="video_play.php?v=<?php echo $r['Video_ID'] ?>">
                                                    <input type="hidden" id="Query" name="Query"
                                                           value="<?php echo $_GET["Search_Text"]; ?>"/>
                                                </form>
                                                <div class="row"
                                                     onclick="document.getElementById('<?php echo $r["Video_ID"] ?>').submit();"
                                                     style="cursor: pointer">
                                                    <div class="col-md-4">
<!--                                                            <img style="border-radius: 0.3em;" class="img-responsive"-->
<!--                                                                 src="source/image/video_img/--><?php //echo $r['Video_ID'] ?><!--.png"-->
<!--                                                                 alt="Norway">-->
                                                        <img style="width: 100%;border-radius: 0.3em;" src="libs/img/justin-timberlake-Say%20Something.jpg">
                                                    </div>

                                                    <div class="col-md-8" style="    font-size: 18px;
    letter-spacing: 1px; ">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div><?php echo $r['Video_Name'] ?></div>
                                                            </div>
                                                            <div class="col-sm-12"
                                                                 style="position: relative;height: 150px;float: right">
                                                                <div style="position: absolute;top: 0;left: 0;height: 100px;width: 100%;">
                                                                    <div class="row">
                                                                        <div class="col-sm-12" style="height: 50px;line-height: 50px">
                                                                            <i style="font-size: 22px" class="fa fa-user-circle-o"></i><?php echo $r['Video_Uploader'] ?>
                                                                            <i style="font-size: 22px" class="fa fa-clock-o"></i><?php echo $r['Video_Date'] ?>
                                                                            <i style="font-size: 25px" class="fa fa-play-circle-o"></i><?php echo $r['Video_Watch_Num'] ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div style=" font-size: 20px;font-weight: 600;position: absolute;bottom: 0;right: 1em">
                                                                    $ 490 NT
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="submenu-1" class="subtitle tab-pane fade ">
                                        <div class="float-box">我建立的頻道</div>
                                    </div>
                                    <div id="submenu-2" class="subtitle tab-pane fade">
                                        <div class="float-box">我收藏的影片</div>
                                    </div>
                                </div>

                            </div>
                            <div id="menu-2" class="subtitle tab-pane fade">
                                <div class="title-name subtitle">
                                    <ul class="nav navbar-nav">
                                        <li class="active"><a data-toggle="tab" href="#submenu-3">收到的邀請</a></li>
                                        <li><a data-toggle="tab" href="#submenu-4">送出的邀請</a></li>
                                    </ul>
                                </div>
                                <div class="tab-content">
                                    <div id="submenu-1" class="subtitle tab-pane fade in active">
                                        <div class="float-box">收到的邀請</div>
                                    </div>
                                    <div id="submenu-2" class="subtitle tab-pane fade">
                                        <div class="float-box">送出的邀請</div>
                                    </div>
                                </div>
                            </div>
                            <div id="menu-3" class="subtitle tab-pane fade">
                                <div class="title-name subtitle">
                                    <ul class="nav navbar-nav">
                                        <li><a>通知</a></li>
                                    </ul>
                                </div>
                                <div class="float-box">
                                </div>
                            </div>
                            <div id="menu-4" class="subtitle tab-pane fade">
                                <div class="title-name subtitle">
                                    <ul class="nav navbar-nav">
                                        <li><a>社群</a></li>
                                    </ul>
                                </div>
                                <div class="float-box"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>