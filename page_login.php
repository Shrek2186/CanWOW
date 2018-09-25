<div id="myNav" class="overlay">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div class="container">
        <div id="login-box">
            <div id="login-controls" class="form-controls">
                <div class="logo">
                    <h1 class="logo-caption">登入</h1>
                </div>
                <form id="login-form" name="login-form" method="POST" action="module/ModuleLogin.php" onclick="return false">
                    <input type="email" name="email" id="email" placeholder="電子信箱" class="form-control" />
                    <input type="password" name="password" id="password" autocomplete="current-password" placeholder="密碼" class="form-control" />
                    <button type="submit" name="login" id="login" class="btn btn-default btn-block btn-custom">登入</button>
                </form>

                <button type="button" class="btn btn-default btn-block btn-custom" onclick="registerOpen()">註冊</button>
            </div>
<!--            <div id="register-controls" class="form-controls">-->
<!--                <div class="logo ">-->
<!--                    <h1 class="logo-caption">註冊</h1>-->
<!--                </div>-->
<!--                <input type="text" name="l_username" placeholder="姓氏" class="form-control" />-->
<!--                <input type="text" name="f_username" placeholder="名字" class="form-control" />-->
<!--                <input type="email" name="email" placeholder="電子信箱" class="form-control" />-->
<!--                <input type="password" name="password" placeholder="密碼" class="form-control" />-->
<!--                <input type="password" name="password" placeholder="確認密碼" class="form-control" />-->
<!--                <input type="text" name="phone" placeholder="手機號碼" class="form-control" />-->
<!--                <button type="button" class="btn btn-default btn-block btn-custom">註冊</button>-->
<!--            </div>-->
        </div>
    </div>
</div>
