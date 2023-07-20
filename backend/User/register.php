<?php
session_start();
require_once("../connect/connectDB.php");
$username = $email = $password = $repeatPassword = "";
$errors = $phone = $token = '';

define("APPPATH", "./");

include APPPATH . "PHPMailer.php";
include APPPATH . "Exception.php";
include APPPATH . "OAuth.php";
include APPPATH . "POP3.php";
include APPPATH . "SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

if (isset($_POST['submit'])) { // Check if the form is submitted
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $repeatPassword = $_POST["repeatPassword"];
    $token = md5(rand());

    if (isset($_POST['phone'])) {
        $phone = $_POST['phone'];
        if (!preg_match("/^[0-9]{10,12}$/", $phone) && $phone != '') {
            $errors = 'Invalid Phone';
        }
    }

    if ($password != $repeatPassword) {
        $errors = 'Passwords don\'t match!';
    } 
    
    // Check if the email exists in the database
    $sql = "SELECT * FROM tb_user WHERE email = '$email'";
    $result = executeResult($sql);
        if ($result != null) {
            $errors = 'Email already exists.';
        } 
        
        if( empty($errors)) {
            // Insert the new user into the database with hashed password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO tb_user (username, email, phone, token, password) VALUES ($username, $email, $phone, $token, $hashedPassword)";
            $insertResult = execute($sql);

            if ($insertResult) {
                //#1
                $receiver = $_POST["email"]  ; // Corrected variable name
                $subject = "Welcome to our website"; // Set a default subject
                $message = "Thank you for registering on our website! Your token is: $token"; // Include the token in the message

                //#2
                $mail = new PHPMailer;
                $mail->isSMTP();
                $mail->SMTPDebug = SMTP::DEBUG_OFF;
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 587;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->SMTPAuth = true;
                $mail->Username = 'nhilnts2210037@fpt.edu.vn';
                $mail->Password = 'rzushtjlbjnppcft'; // sử dụng mật khẩu ứng dụng
                $mail->FromName = "test Mail";

                //#3
                $mail->setFrom('nhilnts2210037@fpt.edu.vn');
                $mail->addAddress($receiver);
                $mail->Subject = $subject;
                $mail->msgHTML($message);

                //#4
                if (!$mail->send()) {
                    $errors = "Lỗi: " . $mail->ErrorInfo;
                    header("Location: ../../register.php");
                    echo "<script>alert('Fail !')</script>";
                    exit(); // Added exit() after header redirect to stop further execution
                } else {
                    header("Location: ../../confirm-code-Mail.php");
                    echo "<script>alert('Successfully sent!')</script>";
                    exit(); // Added exit() after header redirect to stop further execution
                }
            }
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="../css/login-register.css"/>
</head>
<body>
    <section>
        <div class="form-box">
            <div class="form-value">
                <form action="" method="post">
                    <h2 class="login-h2">Register Form</h2>
                    <?php if (!empty($errors)) { ?>
                        <p style="color: red;"><?php echo $errors; ?></p>
                    <?php } ?>
                    <div class="inputbox">
                        <ion-icon name="person"></ion-icon>
                        <input type="text" name="username">
                        <label for="">Username:</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="mail"></ion-icon>
                        <input type="email" name="email" required >
                        <label for="">Email :</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="mail"></ion-icon>
                        <input type="text" name="phone" required >
                        <label for="">Phone :</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-open"></ion-icon>
                        <input type="password" name="password" required>
                        <label for="">Your Password :</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed"></ion-icon>
                        <input type="password" name="repeatPassword" required>
                        <label for="">Repeat Your Password :</label>
                    </div>
                    <button type="submit" name="submit">Submit</button>
                    <div class="register">
                        <p> Tôi đã có tài khoản <a href="login.php"> Đăng Nhập </a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>