<style>
    .warning {
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
                    <input type="email" name="login_email" id="login_email" placeholder="電子信箱" class="form-control"/>
                    <input type="password" name="login_password" id="login_password" autocomplete="current-password"
                           placeholder="密碼" class="form-control"/>
                    <button type="submit" name="login" id="login" onclick="loginSent()"
                            class="btn btn-default btn-block btn-custom">登入
                    </button>
                </form>
                <button type="button" class="btn btn-default btn-block btn-custom" onclick="registerOpen()">註冊</button>
            </div>
            <div id="register-controls" class="form-controls" style="display: none">
                <div class="logo ">
                    <h1 class="logo-caption" style="padding-bottom: 1em">註冊</h1>
                </div>
                <form id="register_form" name="registerForm" method="POST" action=""
                      onclick="return false">
                    <ul>
                        <li>
                            <input class="form-control" type="text" name="last_name" id="last_name" placeholder="姓氏"
                                   onblur="giveWarning(this)">
                            <span id="warning_ln" class="warning">請輸入您的姓氏</span>
                        </li>
                        <li>
                            <input class="form-control" type="text" name="first_name" id="first_name" placeholder="名字"
                                   onblur="giveWarning(this)">
                            <span id="warning_fn" class="warning">請輸入您的名字</span>
                        </li>
                        <li>
                            <input class="form-control" type="email" name="register_email" id="register_email"
                                   placeholder="電子信箱" onblur="giveWarning(this)">
                            <span id="warning_em_error" class="warning">請輸入有效的電子信箱</span>
                            <span id="warning_em_exist" class="warning">此信箱已註冊</span>
                        </li>
                        <li>
                            <input class="form-control" type="password" name="register_password" id="register_password"
                                   placeholder="密碼" onblur="giveWarning(this)">
                            <span id="warning_pw" class="warning">請輸入 8～16 個英文或數字</span>
                        </li>
                        <li><input class="form-control" type="password" name="re_password" id="re_password"
                                   placeholder="確認密碼" onblur="giveWarning(this)">
                            <span id="warning_repw" class="warning">密碼不符</span>
                        </li>
                        <li>
                            <input class="form-control" type="text" name="phone" id="phone" placeholder="手機號碼"
                                   onblur="giveWarning(this)">
                            <span id="warning_ph" class="warning">請輸入有效的電話號碼</span>
                        </li>
                        <li>
                            <label>生日：</label><br/>
                            <select name="birth_year" id="birth_year" class="select_year" rel="1997"></select>
                            <select name="birth_month" id="birth_month" class="select_month" rel="4"></select>
                            <select name="birth_day" id="birth_day" class="select_day" rel="25"></select>
                        </li>
                    </ul>
                    <button type="submit" name="login" id="login" onclick="registerSent()"
                            class="btn btn-default btn-block btn-custom">註冊
                    </button>
                </form>
                <button onclick="registerClose()" class="btn btn-default btn-block btn-custom">已有帳號？按此登入</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="libs/js/verification.js"></script>