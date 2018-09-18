<?php
move_uploaded_file($_FILES['Screenshot']['tmp_name'], "../../source/image/video_img/" . $_FILES['Screenshot']['name']);
