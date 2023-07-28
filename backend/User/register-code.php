<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
require_once("../../connect/connectDB.php");
//Load Composer's autoloader
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
        <a href='http://localhost/project_hk2_fpt/backend/User/register-CFcode-Mail.php?token=$token'>Click me</a>
        ";
        $mail->Body = $mail_template;
        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}



if (isset($_POST["submit-btn"])){
    $username = $_POST["username"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];
    $repeatPassword = $_POST["repeatPassword"];
    $token = md5(rand()); // Generate a unique token

     // Hash the password for security
     $hashed_password = md5($password);

    // Perform validation checks
    if ($password != $repeatPassword) {
        $_SESSION['status'] = "Passwords don't match!";
        header("Location: register.php");
        exit();
    }

    if (!preg_match("/^[0-9]{10,12}$/", $phone)) {
        $_SESSION['status'] = "Invalid Phone Number!";
        header("Location: register.php");
        exit();
    }


    // Check if the email exists in the database
    $sql_checkmail = "SELECT email FROM tb_user WHERE email = '$email' LIMIT 1";
    $sql_checkmail_run = mysqli_query($conn,  $sql_checkmail);

   if (mysqli_num_rows($sql_checkmail_run) > 0) {
        $_SESSION['status'] = "Email already exists!";
        header("Location: register.php");
        exit();
    }

    // Insert new User into the database
    $sql_newUser = "INSERT INTO tb_user (username, email, phone, token, password, create_date)
            VALUES ('$username', '$email', '$phone', '$token', '$hashed_password', NOW())";
    $sql_newUser_run = mysqli_query($conn, $sql_newUser);

    if ($sql_newUser_run) {
            sendEmail_verify($username, $email, $token) ;
            $_SESSION['status'] = "Register Successfully! Please verify your Email Address!";
            header("Location: login.php");
            exit();
    } else {
        $_SESSION['status'] = "Registration Fail!";
        header("Location: register.php");
        exit();
    }
}


?>