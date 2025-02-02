
<?php
require_once 'DBUser.php';

class LoginController
{
    private $errorMessage;

    public function __construct()
    {
        $this->errorMessage = '';
    }

    public function handleLogin()
    {
        if (isset($_POST['Login'])) {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                $this->errorMessage = "Please fill in all the fields.";
                return;
            }

            $userDBHandler = new DBUser();
            $user = $userDBHandler->getUserEmailPass($email, $password);

            if (empty($user)) {
                $this->errorMessage = "Email or Password is invalid.";
            } else {
                session_start();
                if ($user['role'] == "user") {
                    $_SESSION['useremail'] = $email;
                    header("Location: index.php");
                } else {
                    $_SESSION['adminemail'] = $email;
                    header("Location: admindashboard.php");
                }
                exit;
            }
        }
    }

    public function getErrorMessage()
    {
        return $this->errorMessage;
    }
}
?>