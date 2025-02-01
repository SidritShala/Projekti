<?php

include_once 'DBUser.php';
include_once 'UserRepository.php';

class UserController
{
    private $users = [];
    private $errorMessage;
    private $successMessage;

    public function __construct()
    {
        $this->users = [];
        $this->errorMessage = "";
        $this->successMessage = "";
    }

    public function getAllUsers()
    {
        $repo = new UserRepository();
        return $repo->getAllUsers();
    }

    public function loadUsers()
    {
        $userDBHandler = new DBUser();
        $this->users = $userDBHandler->getAllUsers();
    }

    public function handleUserCheck()
    {
        if (isset($_POST['checkUserBtn'])) {
            $userId = $_POST['userId'];

            $userDBHandler = new DBUser();
            $user = $userDBHandler->getUserById($userId);

            if ($user) {
                $this->successMessage = "User exists.";
            } else {
                $this->errorMessage = "User not found.";
            }
        }
    }

    public function getUsers()
    {
        return $this->users;
    }

    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    public function getSuccessMessage()
    {
        return $this->successMessage;
    }
}

?>