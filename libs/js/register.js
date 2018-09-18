function giveWarning(data) {
    if (data.id === "L_name") {
        if (checkLname()) {
            document.getElementById("Warn_Lname").style.display = "none";
        } else {
            document.getElementById("Warn_Lname").style.display = "inline";
        }
    }
    if (data.id === "F_name") {
        if (checkFname()) {
            document.getElementById("Warn_Fname").style.display = "none";
        } else {
            document.getElementById("Warn_Fname").style.display = "inline";
        }
    }
    if (data.id === "password") {
        if (checkPassword()) {
            document.getElementById("Warn_pw_wrong").style.display = "none";
        } else {
            document.getElementById("Warn_pw_wrong").style.display = "inline";
        }
    }
    if (data.id === "re_password") {
        if (checkRepassword()) {
            document.getElementById("Warn_no_match").style.display = "none";
        } else {
            document.getElementById("Warn_no_match").style.display = "inline";
        }
    }
    //檢查Email
    if (data.id === "Email") {
        switch (checkEmail()) {
            case 1:
                document.getElementById("Warn_Email_wrong").style.display = "inline";
                document.getElementById("Warn_Email_exist").style.display = "none";
                break;
            case 2:
                document.getElementById("Warn_Email_wrong").style.display = "none";
                document.getElementById("Warn_Email_exist").style.display = "inline";
                break;
            case 3:
                document.getElementById("Warn_Email_wrong").style.display = "none";
                document.getElementById("Warn_Email_exist").style.display = "none";
        }
    }

    if (data.id === "phone") {
        if (checkPhone()) {
            document.getElementById("Warn_phone_wrong").style.display = "none";
        } else {
            document.getElementById("Warn_phone_wrong").style.display = "inline";
        }
    }
}

function check_all() {
    var Warning = "註冊未成功，資訊有誤:";
    var sent = true;
    if (!checkLname()) {Warning = Warning + "\n．姓氏未正確輸入"; sent = false;}
    if (!checkFname()) {Warning = Warning + "\n．名字未正確輸入"; sent = false;}
    if (!checkPassword()) {Warning = Warning + "\n．密碼未正確輸入"; sent = false;}
    if (!checkRepassword()) {Warning = Warning + "\n．密碼不一致"; sent = false;}
    switch (checkEmail()){
        case 1: Warning = Warning + "\n．電子信箱未正確輸入"; sent = false; break;
        case 2: Warning = Warning + "\n．該電子信箱已被註冊"; sent = false; break;
    }
    if (!checkPhone()) {Warning = Warning + "\n．手機號碼未正確輸入"; sent = false;}
    if(!sent){
        alert(Warning);
    }
    return sent;
}

function checkLname() {
    var L_name = document.getElementById("L_name");
    return L_name.value;
}

function checkFname() {
    var F_name = document.getElementById("F_name");
    return F_name.value;
}

function checkPassword() {
    var password = document.getElementById("password");
    var testCode = /^[a-zA-Z0-9]{8,16}$/;  // 密碼需為8~16個英文或數字，不可有其他的符號
    return testCode.test(password.value);//password.value && (password.value.length >= 8 && password.value.length <= 16);
}

function checkRepassword() {
    var password = document.getElementById("password");
    var re_password = document.getElementById("re_password");
    return re_password.value === password.value;
}

function checkEmail() {
    /*
    若Email形式不符合則 return 1;
    */
    var Email = document.getElementById("Email");
    if (!isEmail(Email.value)) {
        return 1;
    } else if (Email_exist(Email.value)) {
        return 2;
    } else {
        return 3;
    }
}

function isEmail(Email) {
    return Email === '' ? false : !(!/^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$/.test(Email));
}

function Email_exist(Email) {
    var exist = null;
    $.ajax({
        url: 'isEmail_exist.php',
        dataType: "json",
        async: false,
        type: 'POST',
        data: {Email: Email},
        error: function () {
            alert('Ajax request 發生錯誤');
        },
        success: function (result) {
            exist = result;
        }
    });
    return exist;
}

function checkPhone() {
    var phone = document.getElementById("phone");
    var testCode = /^09[0-9]{8}$/;
    return testCode.test(phone.value);
}

