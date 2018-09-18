<?php
//-------------------------�إ�member����Ʈw�s��------------------------------------
//echo "Email��:" . $Email . "<br>";     ���ե�
$member_link = @mysqli_connect("localhost", "root", "") or die("�L�k�}�Ҹ�Ʈw!");
mysqli_select_db($member_link, "member");  // ���member��Ʈw
//�e�XUTF8�s�X��MySQL���O
mysqli_query($member_link, 'SET NAMES utf8');
/* ���ե�
if ($member_link) {
    echo "member��Ʈw�s�����\" . "<br>";
} else {
    echo "member��Ʈw�s������" . "<br>";
*/
//------------------------���� �إ�member����Ʈw�s��---------------------------------