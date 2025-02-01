<?php

require_once 'DBUser.php';
require_once 'UserEntity.php';

class RegisterController {
    private $usernameError;
    private $emailError;
    private $passwordError;
    private $succedMessage;

    public function __construct() {
        $this->usernameError = '';
        $this->emailError = '';
        $this->passwordError = '';
        $this->succedMessage = '';
    }

    public function handleRegister() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registerBtn'])) {
            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $address = $_POST['address'] ?? '';
            $birthDate = $_POST['birthDate'] ?? '';

            if (empty($username)) {
                $this->usernameError = "Username is required.";
            }

            if (empty($email)) {
                $this->emailError = "Email is required.";
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->emailError = "Please enter a valid email address.";
            }

            if (empty($password)) {
                $this->passwordError = "Password is required.";
            } else if (!preg_match("/[A-Z]/", $password) ||
                       !preg_match("/[a-z]/", $password) ||
                       !preg_match("/[0-9]/", $password) ||
                       !preg_match("/[\W]/", $password) ||
                       strlen($password) < 8) {
                $this->passwordError = "Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.";
            }

            if ($this->usernameError || $this->emailError || $this->passwordError) {
                return;
            }

            $user = new UserEntity(null, $username, $email, $password, 'user', $address, $birthDate);
            $userDBHandler = new DBUser();

            if ($userDBHandler->getUserByEmailorUsername($email, $username)) {
                $this->emailError = "Email or username already exists.";
                return;
            }

            $userDBHandler->insertUser($user);
            $this->succedMessage = "Registration successful. Redirecting to login page...";
            header("Refresh: 3; URL=login.php");
            exit;
        }
    }

    public function getUsernameError() {
        return $this->usernameError;
    }

    public function getEmailError() {
        return $this->emailError;
    }

    public function getPasswordError() {
        return $this->passwordError;
    }

    public function getSuccedMessage() {
        return $this->succedMessage;
    }
}
?>
