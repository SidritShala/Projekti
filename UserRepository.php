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
                // Heqim id dhe e përdorim vetëm username dhe të tjera
                $users[] = new UserEntity(
                    $row['username'],
                    $row['email'],
                    $row['password'],
                    $row['role'],
                    $row['address'],
                    $row['birth_date']
                    // id është i opsional, nuk kalohen këtu
                );
            }
        }

        return $users;
    }

    public function getUserByUsername($username)
    {
        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("s", $username); // Kërkojmë me 'username'
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
                // id është i opsional, nuk kalohen këtu
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

    public function deleteUser($username)
    {
        $query = "DELETE FROM users WHERE username = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("s", $username); // Fshijmë me 'username'
        return $stmt->execute();
    }

    public function updateUser($username, $newUsername, $newEmail, $newPassword, $newRole, $newAddress, $newBirthDate)
    {
        $query = "UPDATE users SET username = ?, email = ?, password = ?, role = ?, address = ?, birth_date = ? WHERE username = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("sssssss", $newUsername, $newEmail, $newPassword, $newRole, $newAddress, $newBirthDate, $username); // Azhurnojmë me 'username'
        return $stmt->execute();
    }
}

?>
