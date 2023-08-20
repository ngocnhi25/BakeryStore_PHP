<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
require_once("../connect/connectDB.php");

$errors = [];
$errors["pass"] = '';
$errorNum = 0; // Initialize error counter to 0

if(isset($_POST['current-password'])){
    $current_pass = md5($_POST['current-password']);
    if ($current_pass == '') {
        $errors["pass"] = 'Current Password cannot be blank';
        $errorNum++;
    }
}

if(isset($_POST['email'])){
    $email = trim($_POST['email']);
}

if ($errorNum == 0) {
    $sql = "SELECT * FROM tb_user WHERE email = '$email' AND password = '$current_pass' ";
    $sql_user_run = mysqli_query($conn, $sql);

    if (mysqli_num_rows($sql_user_run) > 0) {
        echo 'success'; 
    } else {
        echo 'fail';
    }
} else {
    echo json_encode($errors); 
}
?>
