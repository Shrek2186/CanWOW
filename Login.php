<?php
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/w3.css">
    <link rel="stylesheet" type="text/css" href="css/Login.css">

    <!-----dropzone---- -->
    <link href="plugins/dropzone/dropzone.min.css" type="text/css" rel="stylesheet"/>
    <link href="plugins/dropzone/basic.min.css" type="text/css" rel="stylesheet"/>
    <script src="plugins/dropzone/dropzone-amd-module.min.js"></script>
    <script src="plugins/dropzone/dropzone.min.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script>
        Dropzone.options.myAwesomeDropzone = {
            dictDefaultMessage: "大頭貼",
            paramName: "Picture",
            uploadMultiple: true,
            maxFiles: 1,
            init: function () {
            }
        }
    </script>
</head>
<body>
<div class="w3-bar w3-top w3-black w3-xxlarge" style="z-index:4; max-height: 60px;">
    <a href="index.php">
        <span class="w3-bar-item w3-left">CanWOW</span>
    </a>
    <div style="position:absolute; margin-left: 60%; width: 400px; height: 100%" >
        <form  id="loginForm" name="loginForm" method="POST" action="Login_Check.php" onclick="return false">
            <div style="position: absolute; width: 130px; margin-left: 20px;">
                <p style="font-size: 10px; height: 5px">電子郵件</p>
                <input class="w3-bar-item" style="height: 20px; width: 130px; font-size: 10px;padding: 6px 6px" type="text" name="mem_mail" id="mem_mail"
                       required/>
            </div>
            <div style="position: absolute; width: 130px; margin-left: 160px;">
                <p style="font-size: 10px; height: 5px">密碼</p>
                <input class="w3-bar-item" style="height: 20px; width: 130px; font-size: 10px;padding: 6px 6px" type="password" name="mem_pass" id="mem_pass"
                       required/>
            </div>
            <div style="position: absolute; margin-left: 300px; margin-top: 25px;">
                <input class="w3-bar-item" id="Login" name="Login" style="width: 40px; height: 20px; font-size: 10px;padding: 1px 1px" type="submit"
                       value="登入">
            </div>
        </form>
    </div>

</div>
<div id="member_info">

</div>
<div id="register">
    <p class="w3-xxlarge" style="font-family: 'fantasy'; position: absolute; margin-top:2%; margin-left: 3%;">快速註冊!!</p>
    <div style="position: absolute; margin-top: 70px; margin-left: 20%;">
        <form id="registerForm" name="registerForm" method="POST" action="sent_registerForm.php" onclick="return false">
            <ul class="w3-ul">
                <li><input type="text" name="L_name" id="L_name" placeholder="姓氏" onblur="giveWarning(this)"><span
                            id="Warn_Lname" style="color: red; display: none;">請輸入您的姓氏</span></li>
                <li id="L_Fname"><input type="text" name="F_name" id="F_name" placeholder="名字"
                                        onblur="giveWarning(this)"><span id="Warn_Fname"
                                                                         style="color: red; display: none;">請輸入您的名字</span>
                </li>
                <li id="L_Email"><input type="text" name="Email" id="Email" placeholder="電子信箱"
                                        onblur="giveWarning(this)"><span id="Warn_Email_wrong"
                                                                         style="color: red; display: none;">請輸入有效的電子信箱</span><span
                            id="Warn_Email_exist" style="color: red; display: none;">此信箱已註冊</span>
                </li>
                <li id="L_password"><input type="password" name="password" id="password" placeholder="密碼"
                                           onblur="giveWarning(this)"><span id="Warn_pw_wrong"
                                                                            style="color: red; display: none;">請輸入8~16個英文或數字</span>
                </li>
                <li id="L_repassword"><input type="password" name="re_password" id="re_password" placeholder="確認密碼"
                                             onblur="giveWarning(this)"><span id="Warn_no_match"
                                                                              style="color: red; display: none;">密碼不符</span>
                </li>
                <li id="L_phone"><input type="text" name="phone" id="phone" placeholder="手機號碼"
                                        onblur="giveWarning(this)"><span id="Warn_phone_wrong"
                                                                         style="color: red; display: none;">請輸入有效的電話號碼</span>
                </li>
                <li>
                    <label>生日：</label><br/>
                    <select name="b_year" id="b_year" class="sel_year" rel="1997"></select>
                    <select name="b_month" id="b_month" class="sel_month" rel="4"></select>
                    <select name="b_date" id="b_date" class="sel_day" rel="25"></select>
                </li>
                <li><input style="width: 100%; max-width: 205px;" type="submit" name="sent_info" id="sent_info"
                           value="註冊"></li>
            </ul>
        </form>
    </div>
</div>


</body>
</html>

<script type="text/javascript" src="js/birthday.js"></script>
<script type="text/javascript" src="js/register_verification.js"></script>
<script>
    $(function () {
        $.ms_DatePicker({
            YearSelector: ".sel_year",
            MonthSelector: ".sel_month",
            DaySelector: ".sel_day"
        });
        $.ms_DatePicker();
    });

    $(document).ready(function () {
        $("#sent_info").click(function () {
            if (check_all()) {
                document.registerForm.submit();
            }
        })
        $("#Login").click(function () {
            var Email = document.getElementById("mem_mail");
            var Password = document.getElementById("mem_pass");
            $.ajax({
                url: 'Login_Check.php',
                dataType: "json",
                async: false,
                type: 'POST',
                data: {Email: Email.value, Password: Password.value},
                error: function () {
                    alert('Ajax request 發生錯誤');
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