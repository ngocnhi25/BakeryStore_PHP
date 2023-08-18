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

$errors = [];
$errors["newemail"] = '';
$errorNum = 0; // Initialize error counter to 0

function sendEmail_change_Password($get_name, $get_email, $new_token){
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
        $mail->Subject = 'Change email from NgocNhiBakery';
        $mail_template = "
    <h2>You received this email because we received a request to update the password for your Account </h2>
    <h5>Verify your email address to update the new password with the below given link</h5>
    <br><br>
    <a href='http://localhost/Group3-BakeryStore/src/User/verify-change-pass.php?token=$new_token&email=$get_email'>Click me</a>
    ";
        $mail->Body = $mail_template;
        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

if(isset($_POST['save_email'])) {
    $get_email = $_POST['newemail'];
    $new_token = md5(rand());
    $get_name = $_POST['username'];

    $sql_checkmail = "SELECT * FROM tb_user WHERE email = '$get_email' LIMIT 1";
    $sql_checkmail_run = mysqli_query($conn, $sql_checkmail);

     if (mysqli_num_rows($sql_checkmail_run) > 0) {
        $errors["newemail"] = mysqli_error($conn);
        $errorNum++;
    } else {
        if (!$sql_checkmail_run) {
            $sql_update = "UPDATE tb_user SET token = '$new_token' WHERE email = '$get_email' and username = '$get_name' ";
            $sql_update_run = mysqli_query($conn, $sql_update);
            if ($sql_update_run) {
                sendEmail_change_Password($get_name, $get_email, $new_token);
                echo 'success';
            } else {
                $errors["newemail"] = 'Sent Mail verify Fail!';
                $errorNum++;
            }
        } else {
            $errors["newemail"] = 'New Email that you entered is exist!';
            $errorNum++;
        }
    }
}

// Convert errors array to JSON and output it
echo json_encode($errors);
?>
