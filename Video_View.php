<?php
session_start();
?>
<html>
<head>
<meta charset="UTF-8">
<title>Video_View</title>
</head>
<?php 
require_once("Connect_Video.php");
require_once("Connect_Guestbook.php");
    $select_video=$V_Connect->query("SELECT Video_Name, Video_Uploader FROM Video_Info");
    $select_messenger=$G_Connect->query("SELECT Giver, Content FROM Guest_Book");
?>
<body>
	<h1>Test</h1>
	<video controls style="width: 50%"><source src="Media/Test.mp4" type="video/mp4">
	</video>
	<div>
		<?php
		while ($row_video = $select_video->fetch(PDO::FETCH_ASSOC)){
		print("$row_video[Video_Name], $row_video[Video_Uploader] \n");
	}
		?>
	</div>
    <?php
    if(0) {
        ?>
        <form action="Guestbook_Action.php" method="post" name="Guest_Book">
            <input required type="text" name="Content" value="" placeholder="留言">
            <input required type="text" name="Giver" value="" placeholder="名稱">
            <input type="submit" name="" value="送出留言">
        </form>
        <?php
    }?>
    <div>
        <?php
        while ($row_guest = $select_messenger->fetch(PDO::FETCH_ASSOC)){
            print("$row_guest[Giver], $row_guest[Content] \n");
        }
        ?>
    </div>

</body>
</html>
