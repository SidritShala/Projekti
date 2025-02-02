<?php
class DbProduct {
    private $server = "127.0.0.1";
    private $username = "root";
    private $password = "";
    private $database = "illyrian_playhouse";
    private $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->server . ";dbname=" . $this->database, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>