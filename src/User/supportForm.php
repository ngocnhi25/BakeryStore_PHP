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

function supportForm_User($username, $email, $content){
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
        $mail->setFrom($email,$username);
        $mail->addAddress('nhilnts2210037@fpt.edu.vn', 'NgocNhiBakery');

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Support request form User';
        $mail_template = "
        <h2> Information of User</h2>
        <p> - Username : $username</p>
        <p> - Email Address : $email </p>
        <p> - Support request content : $content </p>   
        ";
        $mail->Body = $mail_template;
        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}


if(isset($_POST["sb-FormSupport"])){
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $content =  $_POST["content"];

    if (isset($_POST["fullname"])) {
        // Perform validation checks
        $username = trim($_POST["fullname"]);
    
        if (empty($username)) {
            $_SESSION['status'] = "Username must not be blank.";
            header("Location: ../contact.php");
            exit();
        } 
    }

    if (!preg_match("/^[0-9]{10,12}$/", $phone)) {
        $_SESSION['status'] = "Invalid Phone Number!";
        header("Location:  ../contact.php");
        exit();
    }

    supportForm_User($username, $email, $content);
    $_SESSION['status'] = "Send email request support successfully !";
    header("Location: ../contact.php");
    exit();

}


?>