<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Capture</title>
    <link rel='stylesheet' href='../css_upload/bootstrap.min.css'>
    <script src='../js_upload/jquery.min.js'></script>
    <script src='Action.js'></script>
    <style>
        button {
            margin-top: 10%;
        }

        img {
            margin: 5% -1%;
        }
    </style>
</head>
<body>
<div id="Capture" class="container" style="margin-top: 35px;">
    <div class="row">
        <div class="col-md-12">
            <video id="my-video" controls autoplay style="width: 100%" onclick="Snap()" onplay="Snap()"
            ">
            <source src="../../source/video/<?php echo("$_COOKIE[Origin]") ?>">
            </video>
            <!--            <button onclick="PauseVid()" type="button">Get current time position</button>-->
            <!--            <button onclick="duration()" type="button">Get Video duration</button>-->
            <!--            <p id="duration"></p>-->
            <!--            <form>-->
            <!--                <input type="button" value="Start count!" onClick="timedCount()">-->
            <!--                <input type="text" id="txt">-->
            <!--                <input type="button" value="Stop count!" onClick="stopCount()">-->
            <!--            </form>-->
            <!--            <button type="button" id="Snap" onclick="Snap()">Take A Screenshot</button>-->
            <!--            <button type="button" id="Reset" onclick="Save()">Confirm To Save</button>-->
        </div>
        <div class="col-md-3">
            <!--            <img id="my-screenshot-1" onclick="Select(1)">-->
            <!--            <img id="my-screenshot-2" onclick="Select(2)">-->
            <!--            <img id="my-screenshot-3" onclick="Select(3)">-->
            <!--            <img id="my-screenshot-4" onclick="Select(4)">-->
            <!--            <img id="my-screenshot-1" onclick="Save(1)">-->
            <!--            <img id="my-screenshot-2" onclick="Save(2)">-->
            <!--            <img id="my-screenshot-3" onclick="Save(3)">-->
            <!--            <img id="my-screenshot-4" onclick="Save(4)">-->
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <img class="col-md-3" id="my-screenshot-1" onclick="Save(1)">
            <img class="col-md-3" id="my-screenshot-2" onclick="Save(2)">
            <img class="col-md-3" id="my-screenshot-3" onclick="Save(3)">
            <img class="col-md-3" id="my-screenshot-4" onclick="Save(4)">
        </div>
    </div>
</div>
</body>
<footer></footer>
<script>
    //    var SaveID;
    var count = 1;
    var CaptureID = 1;
    var ImgNumberControl = 4;
    //    var start_time;
    //    var end_time;

    function Snap() {
        var frame = CaptureVideoURL("my-video", 'png', CaptureID);
        var img = document.getElementById('my-screenshot-' + CaptureID);
        img.setAttribute('src', frame);
        if (CaptureID > ImgNumberControl - 1) {
            CaptureID = 1;
        } else {
            CaptureID++;
        }
    }

    //    function Select(SelectID) {
    //        if (SaveID = SelectID) {
    //            alert("選取圖片！");
    //        }
    //    }

    function Save(SaveID) {
        while (count <= ImgNumberControl) {
            $('#my-screenshot-' + count).css('border', 'none');
            count++;
        }
        $('#my-screenshot-' + SaveID).css('border', 'solid red medium');
        CaptureSave(SaveID);
        count = 1;
    }

    //
    var vid = document.getElementById("my-video");
    vid.currentTime = 1;

    function Default() {
        Snap();
        Save(1);
    }

    //
    //    function PauseVid() {
    //        vid.pause();
    //        end_time = vid.currentTime;
    //        alert('已播放時間 : ' + end_time);
    //    }
    //
    //    var c = 0;
    //    var t;
    //
    //    function timedCount() {
    //        vid.play();
    //        document.getElementById('txt').value = c;
    //        c = c + 1;
    //        t = setTimeout("timedCount()", 1000);
    //    }
    //
    //    function stopCount() {
    //        vid.pause();
    //        clearTimeout(t);
    //    }
    //
    //    function duration() {
    //        document.getElementById("duration").innerHTML = vid.duration+' 秒';
    //    }

</script>
</html>