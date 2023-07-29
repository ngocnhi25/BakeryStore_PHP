<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
require_once("../../connect/connectDB.php");
require_once("../../backend/User/vendor/autoload.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendEmail_update_Password($get_name, $get_email, $token){
    try {
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = 'smtp.gmail.com'; 
        $mail->Username = 'nhilnts2210037@fpt.edu.vn'; 
        $mail->Password = 'rzushtjlbjnppcft'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS ;
        $mail->Port = 587;

        //Recipients
        $mail->setFrom('nhilnts2210037@fpt.edu.vn', 'NgocNhiBakery');
        $mail->addAddress($get_email,$get_name);

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Email Reset Password from NgocNhiBakery';
        $mail_template = "
    <h2>You are receiving this email because we received a password reset request for your Account </h2>
    <h5>Verify your email address to update the new password with the below given link</h5>
    <br><br>
    <a href='http://localhost/project_hk2_fpt/backend/User/forgot-inputNewPass.php?token=$token&email=$get_email'>Click me</a>
    ";
        $mail->Body = $mail_template;
        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

if (isset($_POST["submit-resetPass"])) {
    $email = $_POST["email"];
    $token = md5(rand()); // Generate a unique token

    $sql_checkmail = "SELECT email, username, status FROM tb_user WHERE email = '$email' LIMIT 1";
    $sql_checkmail_run = mysqli_query($conn, $sql_checkmail);

    if (mysqli_num_rows($sql_checkmail_run) > 0) {
        $row = mysqli_fetch_array($sql_checkmail_run);
        if ($row["status"] == "1") {
            $get_name = $row["username"];
            $get_email = $row["email"];

            $sql_update = "UPDATE tb_user SET token = '$token' WHERE email = '$get_email' LIMIT 1";
            $sql_update_run = mysqli_query($conn, $sql_update);

            if ($sql_update_run) {
                sendEmail_update_Password($get_name, $get_email,$token);
                $_SESSION['status'] = "We emailed you a password reset link!";
                 header("Location: forgot-inputEmail.php");
                exit();
            } else {
                $_SESSION['status'] = "Send Mail update Fail!";
                header("Location: forgot-inputEmail.php");
                exit();
            }

        } else {
            $_SESSION['status'] = "Email is not verified!";
            header("Location: forgot-inputEmail.php");
            exit();
        }
        
    } else {
        $_SESSION['status'] = "Email does not exist. Please register your account!";
        header("Location: forgot-inputEmail.php");
        exit();
    }
}

if(isset($_POST["update-password-btn"])){
    $email = mysqli_real_escape_string($conn ,$_POST["email"]) ;
    $newPassword = md5(mysqli_real_escape_string($conn ,$_POST["newPassword"])) ;
    $confirm_newPassword = md5(mysqli_real_escape_string($conn ,$_POST["confirm_newPassword"]));
    $token  = mysqli_real_escape_string($conn , $_POST["token"]) ;

    if(!empty($token)){
        //check token is valid or not
        $sql_checkToken = "SELECT token FROM tb_user WHERE token = '$token' LIMIT 1";
        $sql_checkToken_run = mysqli_query($conn,  $sql_checkToken );

        if (mysqli_num_rows($sql_checkToken_run) > 0){
            if($newPassword == $confirm_newPassword ){
                $sql_update_password = "UPDATE tb_user SET password = '$newPassword' WHERE token = '$token' LIMIT 1";
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
                $_SESSION['status'] = " Password and Confirm Password dose not match!";
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