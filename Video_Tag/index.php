<?php
include 'header.php';
$Tag->Video_ID = $_GET['v'];
$stmt = $Tag->read_Tag();
?>
<div class="col-xs-12 " id="video-tag" >
    <ol>
        <?php
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
//    echo "<button><a href=\"Tags.php?Tag_ID={$Tag_ID}\" style=\"text-decoration: none\">{$Tag_Name}</a></button>";
            echo "<li><i class=\"fa fa-tag tag\"></i><a href=\"Tags.php?Tag_ID={$Tag_ID}\" style=\"text-decoration: none\">{$Tag_Name}</a></li>";
        }
        ?>
    </ol>


    <button class="w3-button w3-hover-black w3-round" style="background-color: #404040" id="Add_Tag">新增標籤</button>
    <div id="New_Tag" style="display: none">
        <form action="Video_Tag/action.php" method="post">
            <label for="Input_Tag">為影片輸入標籤：</label>
            <input type="text" name="Input_Tag" id="Input_Tag" class="w3-input w3-border w3-round w3-grey" placeholder="here !!" required>
            <input type="hidden" name="Video_ID" value="<?php echo($_GET['v']) ?>" placeholder="ID">
            <input type="submit" class="w3-button w3-hover-black w3-round" style="background-color: #404040" name="Submit" value="新增">
        </form>
    </div>
</div>
<?php include 'footer.php' ?>

<!--    <div class="col-xs-12  col-md-4 " id="video-tag">-->
<!--        <ol>-->
<!--            <li><i class="fa fa-tag tag"></i>音樂</li>-->
<!--            <li><i class="fa fa-tag tag"></i>POP</li>-->
<!--            <li><i class="fa fa-tag tag"></i>流行歌曲</li>-->
<!--            <li><i class="fa fa-tag tag"></i>英文歌詞</li>-->
<!--        </ol>-->
<!--    </div>-->
