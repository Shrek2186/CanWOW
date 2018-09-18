<meta charset="UTF-8">
<?php
$Link = array(
    'host' => "localhost",
    'account' => "root",
    'password' => "a1996851121",
    'dbname' => "Messenger_Board"
);
$Database_Connect = 'mysql:host=' . $Link['host'] . '; dbname=' . $Link['dbname'];
try {
    $G_Connect = new PDO($Database_Connect, $Link['account'], $Link['password']);
    $G_Connect->query("SET NAMES 'utf8'");
    $G_Connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}
?>