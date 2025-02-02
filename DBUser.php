
<?php
include_once 'DBConnection.php';

class DBUser
{
    private $connection;

    function __construct()
    {
        $conn = new DBConnection();
        $this->connection = $conn->startConn();
    }

    function insertUser($user)
    {
        $userName = $user->getUserName();
        $email = $user->getEmail();
        $password = $user->getPassword();
        $address = $user->getAddress();
        $birth_date = $user->getBirth_Date();

        $sql = "INSERT INTO users (username, email, password, role, address, birth_date) VALUES 
                ('$userName', '$email', '$password', 'user', '$address', '$birth_date')";

        if (mysqli_query($this->connection, $sql)) {
            echo 'User inserted successfully';
        } else {
            echo 'Error: ' . mysqli_error($this->connection);
        }
    }

    function getAllUsers()
    {
        $sql = "SELECT * FROM users";
        $users = [];

        if ($result = $this->connection->query($sql)) {
            while ($row = $result->fetch_assoc()) {
                $users[] = new UserEntity(
                    $row['id'],
                    $row['username'],
                    $row['email'],
                    $row['password'],
                    $row['role'],
                    $row['address'],
                    $row['birth_date']
                );
            }
        } else {
            return null;
        }
        return $users;
    }

    function getUserById($id)
    {
        $sql = "SELECT * FROM users WHERE id = '$id'";

        if ($statement = $this->connection->query($sql)) {
            $result = $statement->fetch_assoc();
            return $result;
        } else {
            return null;
        }
    }

    function getUserEmailPass($email, $password)
    {
        $sql = "SELECT * FROM users WHERE email = '$email' and password = '$password'";

        if ($statement = $this->connection->query($sql)) {
            $result = $statement->fetch_assoc();
            return $result;
        } else {
            return null;
        }
    }

    function getUserByEmailorUsername($email, $username)
    {
        $sql = "SELECT * FROM users WHERE email = '$email' OR username = '$username'";

        if ($statement = $this->connection->query($sql)) {
            $result = $statement->fetch_assoc();
            return $result;
        } else {
            return null;
        }
    }
}
?>