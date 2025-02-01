
<?php

include_once 'UserEntity.php';

class UserRepository
{
    private $connection;

    public function __construct()
    {
        $conn = new DBConnection;
        $this->connection = $conn->startConn();
    }

    public function getAllUsers()
    
    {
        $users = [];
        $query = "SELECT * FROM users";
        $result = $this->connection->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = new UserEntity($row['id'], $row['username'], $row['email'], $row['password'], $row['role'], $row['address'], $row['birth_date']);
            }
        }

        return $users;
    }

    public function getUserById($userId)
    {
        $query = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            return new UserEntity($row['id'], $row['username'], $row['email'], $row['password'], $row['role'],  $row['address'], $row['birth_date']);
        }

        return null;
    }

    public function addUser($username, $email)
    {
        $query = "INSERT INTO users (username, email) VALUES (?, ?)";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("ss", $username, $email);
        return $stmt->execute();
    }

    public function deleteUser($userId)
    {
        $query = "DELETE FROM users WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $userId);
        return $stmt->execute();
    }

    public function updateUser($userId, $username, $email)
    {
        $query = "UPDATE users SET username = ?, email = ? WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("ssi", $username, $email, $userId);
        return $stmt->execute();
    }
}

?>


