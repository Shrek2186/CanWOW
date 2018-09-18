<?php
require_once("database/mem_info_open.php");     //連結member資料庫
$Sticker_Path = "C:/xampp/htdocs/CanWOW_0213/source/image/Sticker/";
foreach ($_FILES["Picture"]["error"] as $Key => $Error) {
    if ($Error == UPLOAD_ERR_OK) {

        $Tmp_Name = $_FILES["Picture"]["tmp_name"][$Key];
        $Name = basename($_FILES["Picture"]["name"][$Key]);

        move_uploaded_file($Tmp_Name, $Sticker_Path . $Name);

        if($member_link){
            //$sql = "INSERT INTO `subscription`(`Subscriber`,`Channel_Master`) VALUES ('$subscriber','$Channel_Master')";
        }
    }
}


//<form action="Upload_Sticker.php" id="myAwesomeDropzone" class="dropzone"></form>     html文本