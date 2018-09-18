<?php
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/w3.css">
    <link rel="stylesheet" href="plugins/venobox/venobox.css" type="text/css" media="screen"/>
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="plugins/venobox/venobox.min.js"></script>
    <script type="text/javascript" src="plugins/infiniteScroll/infinite-scroll.pkgd.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <style>
        html, body, h1, h2, h3, h4, h5 {
            font-family: "Raleway", sans-serif
        }
    </style>
</head>
<body style="overflow-y: hidden;">
<!--<h5>Video List</h5>-->
<div id="container">
    <div style="margin-left: 30%">
        <a class="venobox_custom" data-gall="Gallery" data-vbtype="iframe" href="video_play.php?v=first">
            <img src="source/image/video_img/first.png" style="width: 400px; height: 200px;">
        </a>
        <h5>The Chainsmokers & Coldplay - Something Just Like This (Lyric)</h5>
    </div>
    <div style="margin-left: 30%">
        <a class="venobox_custom" data-gall="Gallery" data-vbtype="iframe" href="video_play.php?v=second">
            <img src="source/image/video_img/second.png" style="width: 400px; height: 200px;">
        </a>
        <h5>告白氣球-周杰倫（周二珂 cover）</h5>
    </div>
    <div style="margin-left: 30%">
        <a class="venobox_custom" data-gall="Gallery" data-vbtype="iframe" href="video_play.php?v=third">
            <img src="source/image/video_img/third.png" style="width: 400px; height: 200px;">
        </a>
        <h5>Luis Fonsi - Despacito ft. Daddy Yankee</h5>
    </div>
</div>

<div class="page-load-status">
    <div class="loader-ellips infinite-scroll-request">
        <span class="loader-ellips__dot"></span>
        <span class="loader-ellips__dot"></span>
        <span class="loader-ellips__dot"></span>
        <span class="loader-ellips__dot"></span>
    </div>
    <p class="infinite-scroll-last">End of content</p>
    <p class="infinite-scroll-error">No more pages to load</p>
</div>
</body>
</html>

<script type="text/javascript">
    //-------------------------------------//
    // hack CodePen to load pens as pages

    function getPenPath() {
        return 'videoList_content2.php';
    }

    //-------------------------------------//
    // init Infinte Scroll

    $('#container').infiniteScroll({
        path: getPenPath,
        append: '#item',
        status: '.page-load-status',
        history: false
    });
</script>
