<meta charset="UTF-8">
<?php
$Link = array(
    'host' => "localhost",
    'account' => "root",
    'password' => "",
    'dbname' => "Member"
);
$Database_Connect = 'mysql:host=' . $Link['host'] . '; dbname=' . $Link['dbname'];
try {
    $M_Connect = new PDO($Database_Connect, $Link['account'], $Link['password']);
    $M_Connect->query("SET NAMES 'utf8'");
    $M_Connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}
?>