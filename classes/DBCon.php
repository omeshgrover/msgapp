<?php
if(!defined('DB_SERVER')){
    require_once("../settings.php");
}

class DBCon {
    private $host = DB_SERVER;
    private $username = DB_USERNAME;
    private $password = DB_PASSWORD;
    private $database = DB_NAME;
    
    public $conn;
    
    public function __construct() {
        if (!isset($this->conn)) {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
            if (!$this->conn) {
                echo 'Database server not connected';
                exit;
            }            
        }
    }
    public function __destruct(){
        $this->conn->close();
    }
}
?>