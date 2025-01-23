<?php
session_start();
session_destroy();
header('Location: OnlineGameStore-LoginForm.php');
exit();
?>
