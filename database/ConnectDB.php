<?php
/**
 * Created by PhpStorm.
 * User: huangcongren
 * Date: 2018/8/15
 * Time: 上午10:19
 */

namespace shrek;

class ConnectDB
{
 public $server_name;
 public $database_name;
 public $user_name;
 public $password;

 private $connection;
 private $link;

 function Connection(){
     $this->link="mysql:host=".$this->server_name.";dbname=".$this->database_name.";port=3306;charset=utf8";
     $this->connection=new \PDO($this->link,$this->user_name,$this->password);
     $this->connection->query("SET names utf8");
     $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
     return $this->connection;
 }
}