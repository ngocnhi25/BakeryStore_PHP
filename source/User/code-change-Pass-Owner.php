<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
require_once("../connect/connectDB.php");
//Load Composer's autoloader
require_once("../User/vendor/autoload.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendEmail_update_Password_Owner($name, $email, $newtoken)
{
    try {
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = 'smtp.gmail.com';
        $mail->Username = 'nhilnts2210037@fpt.edu.vn';
        $mail->Password = 'rzushtjlbjnppcft';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        //Recipients
        $mail->setFrom('nhilnts2210037@fpt.edu.vn', 'NgocNhiBakery');
        $mail->addAddress($email, $name);

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Email Reset Password from NgocNhiBakery';
        $mail_template = "
    <h2>You are receiving this email because we received a password reset request for your Account </h2>
    <h5>Verify your email address to update the new password with the below given link</h5>
    <br><br>
    <a href='http://localhost/Group3-BakeryStore/source/User/forgot-inputNewPass-Owner.php?token=$newtoken&email=$email'>Click me</a>
    ";
        $mail->Body = $mail_template;
        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

$errors = [];
$errors["pass"] = '';
$errorNum = 0; // Initialize error counter to 0

if (isset($_POST['current-password'])) {
    $current_pass = md5($_POST['current-password']);
    if ($current_pass == '') {
        $errors["pass"] = 'Current Password cannot be blank';
        $errorNum++;
    }
}

if (isset($_POST['email'])) {
    $email = trim($_POST['email']);
}

if ($errorNum == 0) {
    $sql = "SELECT * FROM tb_user WHERE email = '$email' AND password = '$current_pass' ";
    $sql_user_run = mysqli_query($conn, $sql);
    if (mysqli_num_rows($sql_user_run) > 0) {
        $row = mysqli_fetch_array($sql_user_run);
        $name = $row["username"];
        $newtoken = md5(rand()); // Generate a unique token

        $sql_update = "UPDATE tb_user SET token = '$newtoken' , status = 0 WHERE email = '$email' and username = '$name' ";
        $sql_update_run = mysqli_query($conn, $sql_update);
        if ($sql_update_run) {
            sendEmail_update_Password_Owner($name, $email, $newtoken);
            echo 'success';
        } else {
            echo 'error';
        }
    } else {
        echo 'fail';
    }
} else {
    echo json_encode($errors);
}
