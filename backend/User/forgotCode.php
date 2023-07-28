<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
require_once("../../connect/connectDB.php");
require_once("../../backend/User/vendor/autoload.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendEmail_verify($username, $email, $token){
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
        $mail->addAddress($email,$username);

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Email Verification from NgocNhiBakery';
        $mail_template = "
        <h2>You have registered with NgocNhiBakery</h2>
        <h5>Verify your email address to log in with the below given link</h5>
        <br><br>
        <a href='http://localhost/project_hk2_fpt/backend/User/confirm-code-Mail.php?token=$token'>Click me</a>
        ";
        $mail->Body = $mail_template;
        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

if(isset($_POST["submit-buton"])){
    $email = $_POST["email"];
    $sql_checkmail = "SELECT email FROM tb_user WHERE email = '$email' LIMIT 1";
    $sql_checkmail_run = mysqli_query($conn,  $sql_checkmail);

    if (mysqli_num_rows($sql_checkmail_run) > 0) {
        $token = md5(rand()); // Generate a unique token

        $sql_update = "UPDATE tb_user SET token = '$token' WHERE email = '$email' LIMIT 1";
        $sql_update_run = mysqli_query($conn, $sql_update );

        if( $sql_update_run){
            sendEmail_verify('', $email, $token) ;
            $_SESSION['status'] = "Please verify your Email Address to update password!";
            header("Location: input-newPassword.php");
            exit();
        }else{
            $_SESSION['status'] = "Send Mail update Fail !";
            header("Location: forgotPassword.php ") ;
            exit();
        }
    }else{
        $_SESSION['status'] = "Email is not exsit . Please register your account !";
            header("Location: forgotPassword.php ") ;
            exit();
    }
}
?>