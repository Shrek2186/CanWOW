<?php
$Link = array(
    'host' => 'localhost',
    'account' => 'root',
    'password' => '',
    'dbname' => 'Video'
);
$Database_Connect = 'mysql:host=' . $Link['host'] . '; dbname=' . $Link['dbname'];
try {
    $Connect = new PDO($Database_Connect, $Link['account'], $Link['password']);
    $Connect->query('SET NAMES \'utf8\'');
    $Connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo 'Connection failed:' . $e->getMessage();
    exit();
}


