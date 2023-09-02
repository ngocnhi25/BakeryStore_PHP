<?php
session_start();
unset($_SESSION["authenticeted"]);
unset($_SESSION["auth_user"]);
header("Location: ../User/login.php");
exit();
?>