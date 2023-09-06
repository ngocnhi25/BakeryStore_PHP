<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
require_once("../connect/connectDB.php");

if(isset($_POST["update-password-btn"])){
    $email = mysqli_real_escape_string($conn ,$_POST["email"]) ;
    $confirm_newPassword = $_POST["confirm_newPassword"] ;
    $token  = mysqli_real_escape_string($conn , $_POST["token"]) ;

    if (isset($_POST["newPassword"])) {
        $newPassword = $_POST["newPassword"];
        if (empty($newPassword)) {
            $_SESSION['status'] = "New Password must not be blank.";
            header("Location: forgot-inputNewPass.php?token=$token&email=$email") ;
            exit();
        }
        if (strpos($newPassword, ' ') !== false) {
            $_SESSION['status'] = "New Password must not contain spaces.";
            header("Location: forgot-inputNewPass.php?token=$token&email=$email") ;
            exit();
        }
        if (!preg_match("/^[a-zA-Z0-9!@#$%^&*()_+{}:;<>?~]{6,20}$/", $newPassword)) {
            $_SESSION['status'] = "New Password must be between 6 and 20 characters ";
            header("Location: forgot-inputNewPass.php?token=$token&email=$email") ;
            exit();
        }
    }

    if ($newPassword !== $confirm_newPassword) {
        $_SESSION['status'] = " Password and Confirm Password dose not match!";
        header("Location: forgot-inputNewPass.php?token=$token&email=$email") ;
        exit();
    }


    if(!empty($token)){
        //check token is valid or not
        $sql_checkToken = "SELECT token FROM tb_user WHERE token = '$token' LIMIT 1";
        $sql_checkToken_run = mysqli_query($conn,  $sql_checkToken );

        if (mysqli_num_rows($sql_checkToken_run) > 0){
            $hashpass = md5($newPassword); 
                $sql_update_password = "UPDATE tb_user SET password = '$hashpass' , status = 1 WHERE token = '$token' ";
                $sql_update_password_run = mysqli_query($conn, $sql_update_password );
                
                if($sql_update_password_run){
                    $_SESSION['status'] = " Update password succsessfully . Please login !";
                    header("Location: login.php") ;
                    exit();
                }else{
                    $_SESSION['status'] = " Did not update password! Something wrong!";
                    header("Location: forgot-inputNewPass.php?token=$token&email=$email") ;
                    exit();
                }
        }else{
            $_SESSION['status'] = " Invalid Token!";
            header("Location: forgot-inputNewPass.php?token=$token&email=$email") ;
            exit();
        }
    }else{
        $_SESSION['status'] = " No token Avaiblable !";
        header("Location: forgot-inputNewPass.php?token=$token&email=$email") ;
        exit();
    }

}
?>