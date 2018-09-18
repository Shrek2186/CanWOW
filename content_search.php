<div class="container-fluid bg-clear" style="height: 1000px"><!--    height: 1000px  -->
    <div class="container padding">
        <div class="row">
            <div class=" col-lg-10 col-lg-offset-1">
                <div class="row">
                    <div class="col-sm-12 title-name"><h3>搜尋結果</h3></div>
                    <?php //--------------結果呈現--------------
                    if ($Result_Sort) {
                        foreach ($Result_Sort as $r) {
                            ?>
                            <div class="col-sm-12">
                                <div class="float-box">
                                    <form id="<?php echo $r['Video_ID'] ?>" method="post"
                                          action="video_play.php?v=<?php echo $r['Video_ID'] ?>">
                                        <input type="hidden" id="Query" name="Query"
                                               value="<?php echo $_GET["Search_Text"]; ?>"/>
                                    </form>
                                    <div class="row"
                                         onclick="document.getElementById('<?php echo $r["Video_ID"] ?>').submit();"
                                         style="cursor: pointer">
                                        <div class="col-md-4"><?php if ($r['Video_Type'] == 'Youtube') {
                                                ?>
                                                <img style="border-radius: 0.3em;" class="img-responsive"
                                                     src="https://img.youtube.com/vi/<?php echo $r['Path']; ?>/sddefault.jpg"
                                                     alt="Norway">
                                                <?php
                                            } else { ?>
                                                <img style="border-radius: 0.3em;" class="img-responsive"
                                                     src="source/image/video_img/<?php echo $r['Video_ID'] ?>.png"
                                                     alt="Norway">
                                                <?php
                                            } ?></div>

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
                                                            <div class="col-sm-12"
                                                                 style="height: 50px;line-height: 50px"><i
                                                                        style="font-size: 22px"
                                                                        class="fa fa-user-circle-o"></i>shrek2186<i
                                                                        style="font-size: 22px"
                                                                        class="fa fa-clock-o"></i>2018-08-31<i
                                                                        style="font-size: 25px"
                                                                        class="fa fa-play-circle-o"></i>3459
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
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>

        </div>
    </div>
</div>