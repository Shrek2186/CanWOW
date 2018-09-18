<?php
if (!isset($_SESSION)) {
    session_start();
}
unset($_SESSION['member']);
header("Location: index.php");