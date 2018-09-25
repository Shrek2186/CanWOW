<style>
    .warnning {
        color: red;
        display: none;
    }
    ul {
        list-style: none;
    }
</style>
<div id="myNav" class="overlay">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div class="container">
        <div id="login-box">
            <div id="login-controls" class="form-controls">
                <div class="logo">
                    <h1 class="logo-caption" style="padding-bottom: 1em">登入</h1>
                </div>
                <form id="login-form" name="login-form" method="POST" action="">
                    <input type="email" name="email" id="email" placeholder="電子信箱" class="form-control"/>
                    <input type="password" name="password" id="password" autocomplete="current-password"
                           placeholder="密碼" class="form-control"/>
                    <button type="submit" name="login" id="login" onclick="LoginSent()"
                            class="btn btn-default btn-block btn-custom">登入
                    </button>
                </form>
                <button type="button" class="btn btn-default btn-block btn-custom" onclick="registerOpen()">註冊</button>
            </div>
            <div id="register-controls" class="form-controls"  style="display: none">
                <div class="logo ">
                    <h1 class="logo-caption" style="padding-bottom: 1em">註冊</h1>
                </div>
                <form id="registerForm" name="registerForm" method="POST" action="sent_registerForm.php" onclick="return false">
                    <ul>
                        <li>
                            <input class="form-control" type="text" name="L_name" id="L_name" placeholder="姓氏" onblur="giveWarning(this)"><span
                                    id="Warn_Lname" class="warnning">請輸入您的姓氏</span>
                        </li>
                        <li id="L_Fname"><input class="form-control" type="text" name="F_name" id="F_name" placeholder="名字"
                                                onblur="giveWarning(this)"><span id="Warn_Fname"
                                                                                 class="warnning">請輸入您的名字</span>
                        </li>
                        <li id="L_Email"><input class="form-control" type="text" name="Email" id="Email" placeholder="電子信箱"
                                                onblur="giveWarning(this)"><span id="Warn_Email_wrong"
                                                                                 class="warnning">請輸入有效的電子信箱</span><span
                                    id="Warn_Email_exist" class="warnning">此信箱已註冊</span>
                        </li>
                        <li id="L_password"><input class="form-control" type="password" name="password" id="password" placeholder="密碼"
                                                   onblur="giveWarning(this)"><span id="Warn_pw_wrong"
                                                                                    class="warnning">請輸入8~16個英文或數字</span>
                        </li>
                        <li id="L_repassword"><input class="form-control" type="password" name="re_password" id="re_password" placeholder="確認密碼"
                                                     onblur="giveWarning(this)"><span id="Warn_no_match"
                                                                                      class="warnning">密碼不符</span>
                        </li>
                        <li id="L_phone"><input class="form-control" type="text" name="phone" id="phone" placeholder="手機號碼"
                                                onblur="giveWarning(this)"><span id="Warn_phone_wrong"
                                                                                 class="warnning">請輸入有效的電話號碼</span>
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
                <button onclick="registerClose()" class="btn btn-default btn-block btn-custom">已有帳號？按此登入</button>
            </div>
        </div>

    </div>
</div>
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
    $("#sent_info").click(function () {
        if (check_all()) {
            document.registerForm.submit();
        }
    })

    function LoginSent() {
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
                        alert('密碼錯誤!!');
                        break;
                    case 3:
                        alert('無此帳號!!');
                        break;
                    case 4:
                        alert('伺服器錯誤!!');
                        break;
                }
            }
        });
    }

    function registerOpen() {
        document.getElementById("login-controls").style.display = "none";
        document.getElementById("register-controls").style.display = "block";
    }

    function registerClose() {
        document.getElementById("login-controls").style.display = "block";
        document.getElementById("register-controls").style.display = "none";
    }
</script>