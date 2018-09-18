<?php
// 'Read_Tag' object

class Video_Tag
{
    private $conn;
    private $table_name = "Video_Tag";
    // constructor
    public $Name;
    public $Type;
    public $Video_ID;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read_Tag()
    {
        // select query
        $query = "SELECT * FROM " . $this->table_name . " WHERE Video_ID = ?";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // bind variable
        $stmt->bindValue(1, $this->Video_ID);
        // execute query
        $stmt->execute();
        return $stmt;
    }

    public function read_Video()
    {

    }

    public function save()
    {
        // Insert query
        $query = "INSERT INTO " . $this->table_name . "(Tag_Name,Video_ID) VALUE (:tn,:vid)";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // bind variable
        $stmt->bindValue(":tn", $this->Name);
        $stmt->bindValue(":vid", $this->Video_ID);
        // execute query
        $stmt->execute();
    }


}