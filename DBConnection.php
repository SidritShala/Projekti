<?php

class DBConnection
{
    private $server = "localhost";
    private $username = 'root';
    private $password = '';
    private $database = 'illyrian playhouse';


    function startConn()
    {
        if (!$conn = mysqli_connect($this->server, $this->username, $this->password, $this->database)) {
            return null;
        } else {
            return $conn;
        }
    }
}

?>    