<?php
session_start();

unset($_SESSION["authenticeted"]);
unset($_SESSION["auth_user"]);
$_SESSION["status"] = "You logged out successfully ! ";
header("Location: login.php");
exit();

?>