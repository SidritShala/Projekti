<?php

class DBConnection
{
    private $server = "127.0.0.1";
    private $username = "root";
    private $password = "";
    private $database = "illyrian_playhouse";
    private $conn;

    public function __construct()
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    }

    public function startConn()
    {
        $this->conn = new mysqli($this->server, $this->username, $this->password, $this->database);
        
        if ($this->conn->connect_error) {
            die("Database connection failed: " . $this->conn->connect_error);
        }
    
        // Heqim var_dump që tregon mesazhin për lidhjen
        // var_dump("Database connected successfully!"); <-- Hiqni këtë linjë

        return $this->conn;
    }
    

    public function closeConn()
    {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}

?>


