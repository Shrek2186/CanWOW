<?php
if(isset($_SESSION['Query'])){
    echo $_SESSION['Query']['query'].'<br>';
    echo $_SESSION['Query']['Video'].'<br>';
}
