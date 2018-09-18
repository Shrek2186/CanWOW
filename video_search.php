<?php
include_once "database/mem_info_open.php";
include_once "database/video_open.php";
include_once "module/ModuleSearch.php";

?>
<!DOCTYPE html>
<html>
<head>
    <title>CanWOW</title>
    <?php include_once "common/web_header.php"; ?>
    <link rel="stylesheet" href="libs/css/design_videopage.css">
</head>
<script>
    $(document).ready(function () {
        $("#login").click(function () {
            var Email = document.getElementById("email");
            var Password = document.getElementById("password");
            $.ajax({
                url: 'Login_Check.php',
                dataType: "json",
                async: false,
                type: 'POST',
                data: {Email: Email.value, Password: Password.value},
                error: function () {
                    alert('Ajax request error!');
                },
                success: function (result) {
                    switch (result) {
                        case 1:
                            alert('登入成功!!');
                            document.location.href = "index.php";
                            break;
                        case 2:
                            alert('無此帳號!!');
                            break;
                        case 3:
                            alert('密碼錯誤!!');
                            break;
                        case 4:
                            alert('伺服器錯誤!!');
                            break;
                    }
                }
            });
        })
    })
</script>
<style>
    i{
        margin-right: 0.5em;
        margin-left: 0.5em;
    }
</style>
<body>
<!--登入頁面-->
<?php include_once "page_login.php"; ?>
<!--導覽列-->
<?php include_once "common/nav_top.php"; ?>
<!--工具列-->
<?php include_once "common/nav_left.php"; ?>
<!--影片頁面主內容-->
<div id="main-area"><?php include_once "content_search.php" ?></div>
</body>
<!--網站頁尾-->
<?php include_once "common/web_footer.php"; ?>
<script src="libs/js/index.js"></script>
<script src="libs/js/birthday.js"></script>
<script src="libs/js/register.js"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<?php include_once "js_For_Video_Play.php"; ?>
</html>
<script>
    var mySearch_display = false;

    function openSearch() {
        //console.log('Hello openSearch !!');
        if (mySearch_display) {
            mySearch_display = false;
            document.getElementById('mySearch').style.display = "none";
//            document.getElementById('navbar').style.height = "60px";
        } else {
            mySearch_display = true;
            document.getElementById('mySearch').style.display = "block";
//            document.getElementById('navbar').style.height = "110px";
        }
    }
</script>
