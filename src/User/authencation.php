<?php
session_start();
if(isset($_SESSION["authenticeted"]) ){
    $_SESSION["status"] = "Please login your account !  ";
    header("Location: ../User/login.php");
    exit();
}
?>