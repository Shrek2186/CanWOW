<?php
if (!isset($_SESSION)) {
    session_start();
}
//session_destroy();        //測試用(暫時拿來當刪除鍵)

?>
<!DOCTYPE html>
<html>
<head>
    <title>CanWOW</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<!--    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">-->
    <link rel="stylesheet" href="css/w3.css">
<!--    <link rel="stylesheet" href="bootstrap.css">-->

    <style>
        html, body, h1, h2, h3, h4, h5 {
            font-family: "Raleway", sans-serif
        }

        .container-fluid {
            padding: 0;
        }

        .navbar {
            margin: 0;
            border-radius: 0;
        }

        .navbar{
            padding-top: 5px;
            height: 60px;
        }
        .banner-image{
            width: 100%;
        }
        .carousel-caption{
            display: none;
        }

    </style>


</head>
<body onload="To_Classify_Page('3C 科技')">
<!-- !PAGE CONTENT!-->
<?php include('Navigation.php'); ?>
<?php include('index_banner.php') ?>
<?php include('index_content.php'); ?>
<!-- End page content -->
</body >
<script>
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

$(window).bind("scroll",function () {
    if($(document).scrollTop() + $(window).height() > $(document).height() - 20){
        Get_Recommend_Type();
    }
    //Page_Load = 1;
});

</script>
</html>

