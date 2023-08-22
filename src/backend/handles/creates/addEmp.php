<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
require_once("../../../connect/connectDB.php");

$errors = [];
$errors["errorName"] =
    $errors["errorPassword"] =
    $errors["errorRePassword"] =
    $errors["errorPhone"] = 
    $errors["errorEmail"] = '';
$errorNum = 0;
$status = 1 ; // Set the desired status value
$role = 2 ;


if (isset($_POST["username"])) {
    // Perform validation checks
    $username = trim($_POST["username"]);

    if (empty($username)) {
        $errors["errorName"] = 'Username must not be blank.';
        $errorNum = 1;
    } 
    
    if (strpos($username, ' ') !== false) {
        $errors["errorName"] = "Username must not contain spaces.";
        $errorNum = 1;
    }

    if (!preg_match("/^[a-zA-Z0-9]{6,20}$/", $username)) {
        $errors["errorName"] = "Username must be between 6 and 20 characters.";
        $errorNum = 1;
    }
}

if (isset($_POST["password"])) {
    $password = $_POST["password"];
    $repeatPassword = $_POST["re-password"];

    if (empty($password)) {
        $errors["errorPassword"] = "Password must not be blank.";
        $errorNum = 1;
    } 

    if (strpos($password, ' ') !== false) {
        $errors["errorPassword"] = "Password must not contain spaces.";
        $errorNum = 1;
    }

    if (strlen($password) < 5) {
        $errors["errorPassword"] = 'Username must be between 6 and 20 characters';
        $errorNum = 1 ; 
    }
        if ($password !== $repeatPassword) {
            $errors["errorRe Password"] = 'Password does match ' ; 
            $errorNum = 1 ; 
    }

}

if (isset($_POST["email"])) {
    $email = $_POST["email"];

    if (empty($email)) {
        $errors["errorEmail"] = "Invalid email format.";
        $errorNum = 1;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["errorEmail"] = "Invalid email format.";
        $errorNum = 1;
    }
}

if (isset($_POST["phone"])) {
    $phone = $_POST["phone"];

    if (!preg_match("/^[0-9]{10,12}$/", $phone)) {
        $errors["errorPhone"] = "Invalid phone number!";
        $errorNum = 1;
    }
}




if ($errorNum === 0) {

    // Hash the password before storing it in the database
    $hashed_password = md5($password);

    $sql_checkmail = "SELECT * FROM tb_user WHERE email = '$email'";
    $sql_checkmail_run = mysqli_query($conn,  $sql_checkmail);

    if (mysqli_num_rows($sql_checkmail_run) > 0) {
        echo 'exist';
    } else {
        $sql_newUser = "INSERT INTO tb_user (username, email, phone, password, status, role) VALUES ('$username', '$email', '$phone', '$hashed_password', $status, $role)";
        $sql_newUser_run = mysqli_query($conn, $sql_newUser);
        if ($sql_newUser_run) {
            echo 'success';
        } else {
            echo 'fail';
        }
    }

} else {
// Validation failed, send error messages back to frontend
echo json_encode($errors);
}

