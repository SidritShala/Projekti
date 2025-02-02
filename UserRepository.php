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
                $users[] = new UserEntity(
                    $row['username'], 
                    $row['email'], 
                    $row['password'], 
                    $row['role'], 
                    $row['address'], 
                    $row['birth_date']
                );
            }
        }

        return $users;
    }

    public function getUserByEmail($email)
    {
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            return new UserEntity(
                $row['username'], 
                $row['email'], 
                $row['password'], 
                $row['role'],  
                $row['address'], 
                $row['birth_date']
            );
        }

        return null;
    }

    public function addUser($username, $email, $password, $role, $address, $birth_date)
    {
        $query = "INSERT INTO users (username, email, password, role, address, birth_date) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("ssssss", $username, $email, $password, $role, $address, $birth_date);
        return $stmt->execute();
    }

    public function deleteUser($email)
    {
        $query = "DELETE FROM users WHERE email = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("s", $email);
        return $stmt->execute();
    }

    public function updateUser($email, $username, $password, $role, $address, $birth_date)
    {
        $query = "UPDATE users SET username = ?, password = ?, role = ?, address = ?, birth_date = ? WHERE email = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("sssss", $username, $password, $role, $address, $birth_date, $email);
        return $stmt->execute();
    }
}

?>