<?php
session_start();
require_once("../../connect/connectDB.php");

if(isset($_POST["login-btn"])){
    if(!empty(trim($_POST["email"])) && !empty(trim($_POST["email"])) ){
        $email = $_POST["email"];
        $password = $_POST["password"];
        
        $sql_login = "SELECT * FROM tb_user WHERE email = '$email'  and password = '$password' LIMIT 1" ;
        $sql_login_run = mysqli_query($conn,$sql_login);

        if(mysqli_num_rows($sql_login_run) > 0 ){
            $row = mysqli_fetch_array(($sql_login_run));
            if($row['status'] == "1"){
                $_SESSION['authenticeted']= TRUE;
                $_SESSION['auth_user'] = [
                    'username' => $row['username'],
                    'phone' => $row['phone'],
                    'email' => $row['email']
                ];
                $_SESSION['status'] = " You logged in successfully !";
            header("Location: index.php");
            exit();
            }else{
                $_SESSION['status'] = "Please verify email address to login !";
                header("Location: login.php");
                exit();
            }

        }else{
            $_SESSION['status'] = "Invalid Email or Password !";
            header("Location: login.php");
            exit();
        }
    }else{
        $_SESSION['status'] = "All filed are mandetory !";
        header("Location: login.php");
        exit();
    }
}

?>