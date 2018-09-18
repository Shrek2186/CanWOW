<?php
// connect to database
include_once 'config/database.php';

// include objects
include_once "objects/Video_Tag.php";

// class instances will be here

// get database connection
$database = new Database();
$db = $database->getConnection();

// initialize objects
$Tag = new Video_Tag($db);