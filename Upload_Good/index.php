<?php
if (!isset($_SESSION)) {
    session_start();
}
//session_destroy();        //測試用(暫時拿來當刪除鍵)

//插入導覽列
include("../Navigation.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>CanWOW</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-----------導覽列(Navigation)所需要的資料連接------------>
    <link rel='stylesheet' href='../Upload_Video/css_upload/dropzone.min.css'>
    <link rel="stylesheet" href="../css/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../plugins/venobox/venobox.css" type="text/css" media="screen"/>
    <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="../plugins/venobox/venobox.min.js"></script>
    <!----------------導入dropzone的資料連接------------------>
    <script src='../Upload_Video/js_upload/dropzone.min.js'></script>
    <script src='../Upload_Video/js_upload/jquery.min.js'></script>
    <script>
        Dropzone.options.myAwesomeDropzone = {
            dictDefaultMessage: '將影片拖曳到這裡，或點擊框框選取檔案',
            paramName: 'Video',
//            addRemoveLinks: true,
            uploadMultiple: true,
            init: function () {
                this.on('complete', function () {
                    $('#Video_Upload').hide();
                    $('#Video_Set').show();
                    $('#Video_Delete').show();
                    $('#Video_Screenshot').append("<iframe id='Show' src='../Upload_Video/Capture/Index.php' " +
                        "style='width:100%;height:100%'></iframe>");
                });
//                this.on("removedfile", function () {
//                    $("#Video_Rename").remove();
//                    $("#show").remove();
//                    $.ajax("Delete.php");
//                    alert('Delete');
//                });
            }
        }

        //        function Delete() {
        //            $("#Video_Upload").show();
        //            $('#Video_Rename').hide();
        //            $('#Video_Screenshot').remove();
        //            $.ajax("Delete.php");
        //        }
        function Delete() {
            $.ajax("Delete.php");
            location.reload();
        }
    </script>
</head>
<body>
<!--dropzon暫時不要
<div style="width: 200px;height: 200px;position: relative;top: 50px;left: 43%">
    <form action='../Upload_Video/Action.php' id='myAwesomeDropzone' class='dropzone'></form>
</div>-->
<div id="video_list" class="w3-main" style="margin-top:43px; z-index: 4;">
    <form action="addGood.php" method="post" class="w3-container w3-card-4 w3-light-grey w3-text-blue w3-margin">
        <!-----------------------------單一商品拍賣----------------------------------->
        <h2 class="w3-center">商品拍賣</h2>
        <div class="w3-row w3-section">
            <div class="w3-rest">
                <input class="w3-input w3-border" name="Good_Name" type="text" placeholder="商品名稱" required>
            </div>
        </div>

        <div class="w3-row w3-section">
            <div class="w3-rest">
                <input class="w3-input w3-border" name="Good_Price" type="number" placeholder="價格" required>
            </div>
        </div>

        <div class="w3-row w3-section">
            <div class="w3-rest">
                <input class="w3-input w3-border" name="Good_Num" type="number" placeholder="商品庫存" required>
            </div>
        </div>

        <div class="w3-row w3-section">
            <div class="w3-rest">
                <textarea name="Good_Intro" type="text" rows="4" cols="50" style="width: 100%"
                          placeholder="商品介紹" required></textarea>
            </div>
        </div>
        <!-----------------------------套餐組合----------------------------------->
        <h2 class="w3-center">餐餐自由配</h2>
        <div class="w3-cell-row" style="height: 500px" id="Package">
            <div class="w3-container w3-cell w3-mobile w3-third" style="width: 30%" id="aa">
                <div class="w3-card-4 " style="height: 90%">
                    <div class="w3-container w3-row w3-section">
                        <div class="w3-container"
                             style="height: 200px;width: 200px;left: 60px;top: 10px;position: relative;background-color: #4CAF50">
                            <!--------------------套餐縮圖放這裡------------------------->
                        </div>
                    </div>
                    <div class="w3-container w3-row w3-section">
                        <input name="Pack_Name[]" class="w3-input w3-border" type="text" placeholder="套餐名稱">
                    </div>
                    <div class="w3-container w3-row w3-section">
                        <input name="Pack_Price[]" class="w3-input w3-border" type="number" placeholder="價格">
                    </div>

                    <div class="w3-container w3-row w3-section">
                        <input name="Pack_Num[]" class="w3-input w3-border" type="number" placeholder="庫存">
                    </div>

                    <div class="w3-container w3-row w3-section">
                        <textarea name="Pack_Intro[]" type="text" rows="4" cols="35" placeholder="套餐介紹"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <span onclick="moreFunction()" class="w3-button w3-block w3-dark-grey">+ More</span>
        <input class="w3-button w3-block w3-section w3-blue w3-ripple w3-padding" type="submit" value="上架">
    </form>
</div>

<script>
    function moreFunction() {
        $('#Package').append($('#aa').clone());
    }
</script>
</body>
</html>