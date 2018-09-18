<?php
$_SESSION['cart']=isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
?>
<!-- container -->
<div class="container">
    <div class="row">

        <div class="col-md-12">
            <div class="page-header">
                <h1><?php echo isset($page_title) ? $page_title : "The Code of a Ninja"; ?></h1>
            </div>
        </div>
