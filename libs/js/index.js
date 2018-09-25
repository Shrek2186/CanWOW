//    function GetHeight(){
//        var h = $(window).height();
//        h = h - 60;
//        return h;
//    };
//
//    $('.banner-image').css('height',GetHeight()+'px');
$(document).ready(function() {
    $(".carousel-caption").fadeIn('slow');
    $("#myCarousel").on('slide.bs.carousel', function () {
        $(".carousel-caption").hide();
        $(".carousel-caption").css('height','100px')
    });
    $("#myCarousel").on('slid.bs.carousel', function () {
        $(".carousel-caption").fadeIn('slow');
    });
});
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

function openNav() {
    document.getElementById("myNav").style.height = "100%";
}
function openSearch() {
    // document.getElementById("mySearch").style.height = "500px";
}


function closeNav() {
    document.getElementById("myNav").style.height = "0%";
    document.getElementById("login-controls").style.display = "block";
    document.getElementById("register-controls").style.display = "none";
}


$(function () {
    $.ms_DatePicker({
        YearSelector: ".sel_year",
        MonthSelector: ".sel_month",
        DaySelector: ".sel_day"
    });
    $.ms_DatePicker();
});

function registerOpen() {
    document.getElementById("login-controls").style.display = "none";
    document.getElementById("register-controls").style.display = "block";
}
function registerClose() {
    document.getElementById("login-controls").style.display = "block";
    document.getElementById("register-controls").style.display = "none";
}