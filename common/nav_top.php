<!--上方導覽列-->
<nav id="navbar" class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-lg-offset-1 col-lg-10">
                    <!--開啟工具列-->
                    <ul class="nav navbar-nav navbar-left">
                        <li><a href="#"><span id="openNav" class="glyphicon glyphicon-th-list" onclick="toolbar();"></span></a></li>
                        <li><a style="padding-right: .25em;padding-left: .25em" href="index.php" target="_blank"><span
                                        class="glyphicon glyphicon-home"></span></a></li>
                        <li><a  href="index.php" target="_blank"><span>CanWOW</span></a></li>
                    </ul>
                    <!--按鈕-->
                    <ul class="nav navbar-nav navbar-right">
                        <li class="open_search"><a href="#" onclick="openSearch()"><span class="glyphicon glyphicon-search"></span></a>
                        </li>
                        <li><a href="Login.php" target="_blank"><span class="glyphicon glyphicon-user"></span></a></li>
                        <li><a href="notice.php" target="_blank"><span class="glyphicon glyphicon-bell"></span></a></li>
                        <li><a href="Upload_Video" target="_blank"><span class="glyphicon glyphicon-open"></span></a></li>
                        <li><a href="#"  onclick="openNav();"><span class="glyphicon glyphicon-log-in"></span></a></li>
                    </ul>
                    <!--首頁-->
                    <form class="navbar-form " id="mySearch" style="display: none" action="video_search.php">
                        <div class="form-group">
                            <input type="text" name="Search_Text" class="form-control" placeholder="輸入關鍵字">
                        </div>
                        <button class="btn hvr-icon-pulse" type="submit"><i class="fa fa-search-plus hvr-icon"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>