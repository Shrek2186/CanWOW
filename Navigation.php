<?php include_once "common/web_header.php"; ?>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            <li><a href="#" onclick="toolbar()"><span class="glyphicon glyphicon-th-list"></span>&nbsp;</a></li>
        </ul>
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-home"></span> CanWOW</a>
        </div>
        <form class="navbar-form navbar-left" method="get" action="Search.php">
            <div class="form-group">
                <input type="text" name="Search_Text" class="form-control" placeholder="輸入關鍵字">
            </div>

            <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
        </form>
        <ul class="nav navbar-nav navbar-right w3-container">
            <li><a href="Login.php"><span class="glyphicon glyphicon-user"></span> 註冊</a></li>
            <li><a href="notice.php"><span class="glyphicon glyphicon-bell"></span> 通知</a></li>
            <li><a href="Upload_Video"><span class="glyphicon glyphicon-open"></span> 上傳</a></li>
            <li style="display: <?php echo (isset($_SESSION['member']['Email'])) ? "none" : "inline"; ?>"><a
                        href="Login.php"><span class="glyphicon glyphicon-log-in"></span> 登入</a></li>
            <li style="display: <?php echo (isset($_SESSION['member']['Email'])) ? "inline" : "none"; ?>"><a href="#"
                                                                                                             data-toggle="dropdown"
                                                                                                             onclick="member_list()"><span
                            class="glyphicon glyphicon-triangle-bottom"></span> <?php echo $_SESSION['member']['F_name']; ?>
                </a>
            </li>
        </ul>
    </div>
    <!--下拉選單-->
    <div id="member_list" class="w3-dropdown-content w3-bar-block w3-card-4"
         style="z-index:5;right:0;top: 60px;position: fixed;background-color: #222222;color: #9d9d9d">
        <a href="member_page.php?page=Favorite" class="w3-bar-item w3-button">會員頁面</a>
        <a href="Shopping_Car/Index.php" class="w3-bar-item w3-button">商品頁面</a>
        <a href="Logout.php" class="w3-bar-item w3-button">登出</a>
    </div>
</nav>


<script>
    function toolbar() {
        if (mySidebar.style.display === 'block') {
            w3_close();
        } else {
            w3_open();
        }
    }

    // Get the Sidebar
    var mySidebar = document.getElementById("mySidebar");

    // Get the DIV with overlay effect
    var overlayBg = document.getElementById("myOverlay");

    // Toggle between showing and hiding the sidebar, and add overlay effect
    function w3_open() {
        mySidebar.style.display = 'block';
        overlayBg.style.display = "block";
        document.getElementById("video_list").style.marginLeft = "250px";
    }

    // Close the sidebar with the close button
    function w3_close() {
        mySidebar.style.display = "none";
        mySidebar.style.transition = "1s";
        overlayBg.style.display = "none";
        document.getElementById("video_list").style.marginLeft = "0%";
    }

    function member_list() {
        var x = document.getElementById("member_list");
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
        } else {
            x.className = x.className.replace(" w3-show", "");
        }
    }

    var x = 0;
    $(document).ready(function () {
        $(window).scroll(function () {
            x += 1;
            $("#ShowVideoId").text(Math.floor(x / 26));
        });
    });
</script>
