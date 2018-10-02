function giveWarning(data) {
    if (data.id === "last_name") {
        if (checkLastname()) {
            document.getElementById("warning_ln").style.display = "none";
        } else {
            document.getElementById("warning_ln").style.display = "inline";
        }
    }
    if (data.id === "first_name") {
        if (checkFirstname()) {
            document.getElementById("warning_fn").style.display = "none";
        } else {
            document.getElementById("warning_fn").style.display = "inline";
        }
    }
    if (data.id === "register_password") {
        if (checkPassword()) {
            document.getElementById("warning_pw").style.display = "none";
        } else {
            document.getElementById("warning_pw").style.display = "inline";
        }
    }
    if (data.id === "re_password") {
        if (checkRepassword()) {
            document.getElementById("warning_repw").style.display = "none";
        } else {
            document.getElementById("warning_repw").style.display = "inline";
        }
    }
    //檢查Email
    if (data.id === "register_email") {
        switch (checkEmail()) {
            case 1:
                document.getElementById("warning_em_error").style.display = "inline";
                document.getElementById("warning_em_exist").style.display = "none";
                break;
            case 2:
                document.getElementById("warning_em_error").style.display = "none";
                document.getElementById("warning_em_exist").style.display = "inline";
                break;
            case 3:
                document.getElementById("warning_em_error").style.display = "none";
                document.getElementById("warning_em_exist").style.display = "none";
        }
    }

    if (data.id === "phone") {
        if (checkPhone()) {
            document.getElementById("warning_ph").style.display = "none";
        } else {
            document.getElementById("warning_ph").style.display = "inline";
        }
    }
}

function check_all() {
    var Warning = "註冊未成功，資訊有誤:";
    var Sent = true;
    if (!checkLastname()) {
        Warning = Warning + "\n．姓氏未正確輸入";
        Sent = false;
    }
    if (!checkFirstname()) {
        Warning = Warning + "\n．名字未正確輸入";
        Sent = false;
    }
    if (!checkPassword()) {
        Warning = Warning + "\n．密碼未正確輸入";
        Sent = false;
    }
    if (!checkRepassword()) {
        Warning = Warning + "\n．密碼不一致";
        Sent = false;
    }
    switch (checkEmail()) {
        case 1:
            Warning = Warning + "\n．電子信箱未正確輸入";
            Sent = false;
            break;
        case 2:
            Warning = Warning + "\n．該電子信箱已被註冊";
            Sent = false;
            break;
    }
    if (!checkPhone()) {
        Warning = Warning + "\n．手機號碼未正確輸入";
        Sent = false;
    }
    if (!Sent) {
        alert(Warning);
    } else {
        alert("資料正確");
    }
    return Sent;
}

function checkLastname() {
    var Last_name = document.getElementById("last_name");
    return Last_name.value;
}

function checkFirstname() {
    var First_name = document.getElementById("first_name");
    return First_name.value;
}

function checkPassword() {
    var Password = document.getElementById("register_password");
    var Test_code = /^[a-zA-Z0-9]{8,16}$/;  // 密碼需為8~16個英文或數字，不可有其他的符號
    return Test_code.test(Password.value);//password.value && (password.value.length >= 8 && password.value.length <= 16);
}

function checkRepassword() {
    var Password = document.getElementById("register_password");
    var Re_password = document.getElementById("re_password");
    return Re_password.value === Password.value;
}

function checkEmail() {
    /*
    若Email形式不符合則 return 1;
    */
    var Email = document.getElementById("register_email");
    if (!validEmail(Email.value)) {
        return 1;
    } else if (existEmail(Email.value)) {
        return 2;
    } else {
        return 3;
    }
}

function checkPhone() {
    var Phone = document.getElementById("phone");
    var Test_Code = /^09[0-9]{8}$/;
    return Test_Code.test(Phone.value);
}

function validEmail(Email) {
    return Email === '' ? false : !(!/^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$/.test(Email));
}

function existEmail(Email) {
    var exist = null;
    var register = null;
    $.ajax({
        url: 'module/ModuleEmailCheck.php',
        dataType: "json",
        async: false,
        type: 'POST',
        data: {Email: Email},
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.responseText);
            alert(ajaxOptions);
            alert(thrownError);
        },
        success: function (result) {
            exist = result;
            if (exist == 1) {
                register = true;
            }
        }
    });
    return register;
}

$(function () {
    $.ms_DatePicker({
        YearSelector: ".select_year",
        MonthSelector: ".select_month",
        DaySelector: ".select_day"
    });
    $.ms_DatePicker();
});

function registerSent() {
    alert("註冊");
    var Email = document.getElementById("register_email");
    var Password = document.getElementById("register_password");
    var FirstName = document.getElementById("first_name");
    var LastName = document.getElementById("last_name");
    var Phone = document.getElementById("phone");
    var Year = document.getElementById("birth_year");
    var Month = document.getElementById("birth_month");
    var Day = document.getElementById("birth_day");
    alert("資料準備送出");
    if (check_all()) {
        alert("送出");
        $.ajax({
            url: 'module/ModuleRegister.php',
            dataType: "json",
            async: false,
            type: 'POST',
            data: {
                register_email: Email.value,
                register_password: Password.value,
                first_name: FirstName.value,
                last_name: LastName.value,
                phone: Phone.value,
                year: Year.value,
                month: Month.value,
                day: Day.value
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.responseText);
                alert(ajaxOptions);
                alert(thrownError);
            },
            success: function (response) {
                if (response == 1) {
                    alert('註冊成功!!');
                    window.location.reload();//刷新當前頁
                }
            }
        });
    }

}

function loginSent() {
    var Email = document.getElementById("login_email");
    var Password = document.getElementById("login_password");
    $.ajax({
        url: 'module/ModuleLogin.php',
        dataType: "json",
        async: false,
        type: 'POST',
        data: {login_email: Email.value, login_password: Password.value},
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.responseText);
            alert(ajaxOptions);
            alert(thrownError);
        },
        success: function (response) {
            switch (response) {
                case 1:
                    alert('登入成功!!');
                    window.location.reload();//刷新當前頁
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

function logoutRequest() {
    document.cookie = "memberID=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    window.location.reload();
}