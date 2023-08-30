<?php
session_start();
if(isset($_SESSION["authenticeted"]) ){
    $_SESSION["status"] = "Please login your account before buying items !  ";
    header("Location: ../User/login.php");
    exit();
}
?>