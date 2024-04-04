<?php

class DB {
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'library';
    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

      
        
    }

    public function getConnection() {
        return $this->conn;
    }
    public function query($sql) {
        return $this->conn->query($sql);
    }
  
    
    public function fetchAll($query) {
        $result = $this->conn->query($query);
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function __destruct() {
    
    }
}
?>
