<?php
class DBConnection {
    private $host = '127.0.0.1';
    private $username = 'root';
    private $password = '';  // Default password for XAMPP is usually empty
    private $dbname = 'illyrian_playhouse';

    public $conn;

    public function startConn() {
        // Try to establish a connection to the database
        try {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);

            // Check for connection errors
            if ($this->conn->connect_error) {
                throw new Exception("Connection failed: " . $this->conn->connect_error);
            }
            return $this->conn;
        } catch (Exception $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}
?>
