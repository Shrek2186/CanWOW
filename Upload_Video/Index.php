<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Upload_Video</title>
    <link rel='stylesheet' href='css_upload/bootstrap.min.css'>
    <link rel='stylesheet' href='css_upload/dropzone.min.css'>
    <script src='js_upload/dropzone.min.js'></script>
    <script src='js_upload/jquery.min.js'></script>
    <script src='Capture/Action.js'></script>
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
                    $('#Video_Screenshot').append("<iframe id='Show' src='Capture/Index.php' " +
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
<div id="Video_Upload">
    <form action='Action.php' id='myAwesomeDropzone' class='dropzone'></form>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div id='Video_Set' style="display: none; margin: 5%">
                <form method='post' action='Set_Info.php'>
                    <label for="Rename">影片標題：</label><br>
                    <input id='Rename' name="Rename" type='text' required><br><br>
                    <label for="Describe">影片簡介：</label><br>
                    <textarea id='Describe' name="Describe" style="width: 80%; height: 200px"></textarea><br><br>
                    <input type='submit' value='確認並送出'>
                </form>
                <div id="Video_Delete" style="display: none; margin-top: 3%">
                    <label for="Delete">刪除影片：</label><br>
                    <button id="Delete" onclick='Delete()'>刪除!</button>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div id="Video_Screenshot" style="width: 100%; height: 600px">
            </div>
        </div>
    </div>
</div>
</body>
</html>