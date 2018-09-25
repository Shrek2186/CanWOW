<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once "module/ModuleVideoInfo.php";
include_once "database/mem_info_open.php";
include_once "database/video_open.php";
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
                url: 'module/ModuleLogin.php',
                dataType: "json",
                async: false,
                type: 'POST',
                data: {email: Email.value, password: Password.value},
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.responseText);
                },
                success: function (response) {
                    switch (response) {
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
<body>
<!--登入頁面-->
<?php include_once "page_login.php"; ?>
<!--導覽列-->
<?php include_once "common/nav_top.php"; ?>
<!--工具列-->
<?php include_once "common/nav_left.php"; ?>
<!--影片頁面主內容-->
<div id="main-area"><?php include_once "content_videoplay.php" ?></div>
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
