<?php
if (!isset($_SESSION)) {
    session_start();
}
    session_destroy();        //測試用(暫時拿來當刪除鍵)
?>

<!DOCTYPE html>
<html>
<head>
    <title>CanWoW</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" href="css/w3.css">
</head>
<body>
<div class="w3-opacity-min w3-sepia-min" id="header">
    <div class="w3-padding w3-display-left">
        <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="toolbar()">&#9776;</button>
        <a href="index.php">
            <img style="width: 110px; height: 40px;" src="source/image/logo.jpg">
        </a>
    </div>
    <div style="position: relative; margin-left: 200px; margin-top: 6px; width: 50%;">
        <input style="width: 80%" type="text" name="Search_Text" id="Search_Text" required>
        <input type="submit" value="搜尋">
    </div>
    <div class="w3-padding w3-display-right btn-group">
        <a href="Login.php"
           style="text-decoration: none; display: <?php echo (isset($_SESSION['member']['Email'])) ? "none" : "inline"; ?>">登入</a>
        <button type="button"
                class="w3-button w3-circle w3-teal btn btn-primary dropdown-toggle"
                data-toggle="dropdown"
                style="width:30px; height:30px; font-size: x-small; display: <?php echo (isset($_SESSION['member']['Email'])) ? "inline" : "none"; ?>"><span
                    class="w3-display-middle"><?php if (isset($_SESSION['member']['F_name'])) {
                    echo $_SESSION['member']['F_name'];
                } ?></span></button>

    </div>
</div>
<div id="toolbar" class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none; background-color: #4CAF50">
    <a href="test.php">測試</a>
</div>
<div id="video_list">
    video_list
</div>
<div id="video_info">
    <div class="w3-yellow w3-padding w3-display-topright">

    </div>
    video_info
</div>

<script>
    var toolbar_exist = 0;

    function toolbar() {
        /* if(toolbar_exist){
             toolbar_exist = 0;
             //w3_close();
         }*/
        if (!toolbar_exist) {
            w3_open();
            toolbar_exist = 1;
        } else {
            toolbar_exist = 0;
            w3_close();
        }
    }

    function w3_open() {
        document.getElementById("video_list").style.marginLeft = "15%";
        document.getElementById("toolbar").style.top = "40px";
        document.getElementById("toolbar").style.width = "15%";
        document.getElementById("toolbar").style.display = "block";
        //document.getElementById("openNav").style.display = 'none';
    }

    function w3_close() {
        document.getElementById("video_list").style.marginLeft = "0%";
        document.getElementById("toolbar").style.display = "none";
        //  document.getElementById("openNav").style.display = "inline-block";
    }
</script>

</body>
</html>
