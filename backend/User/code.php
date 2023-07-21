<?php
session_start();
require_once("../../connect/connectDB.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require_once("../User/vendor/autoload.php");

function sendEmail_verify($username,$email,$token){
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->SMTPAuth   = true;         
                                       //Send using SMTP
    $mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
    $mail->Username = 'nhilnts2210037@fpt.edu.vn';
    $mail->Password = 'rzushtjlbjnppcft'; // sử dụng mật     
                              
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('nhilnts2210037@fpt.edu.vn', $username);
    $mail->addAddress($email);     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Email Verification from NgocNhiBakery ';
    $mail_template = "
    <h2> You have registered with NgocNhiBakery </h2>
    <h5> Verify your email address to login with below given link </h5>
    <br><br>
    <a href='http://localhost/project_hk2_fpt/backend/User/confirm-code-Mail.php?token=$token' >Click me </a>
    ";
    $mail->Body   = $mail_template;
    $mail->send();
    echo 'Message has been sent';

}


if (isset($_POST['submit-btn'])){
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $repeatPassword = $_POST["repeatPassword"];
    $token = md5(rand()); // Generate a unique token

    sendEmail_verify($username,$email,$token);
    echo 'Sent or not';

    // Check if the email exists in the database
//     $sql_checkmail = "SELECT email FROM tb_user WHERE email = '$email' LIMIT 1";
//     $sql_checkmail_run = mysqli_query($con,  $sql_checkmail);
//     if (mysqli_num_rows($sql_checkmail_run) > 0 ) {
//        $_SESSION['status'] = "Email already exists !" ;
//        header("Location: register.php");
//     }else{
//         // insert new User into database
//         $sql_newUser = "INSERT INTO tb_user (username, email, phone, token, password)
//          VALUES ('$username', '$email', '$phone', '$token', '$password')";
//         $sql_newUser_run = mysqli_query($con, $sql_newUser);

//         if($sql_newUser_run){
//             sendEmail_verify("$username" , "$email" ,"$token" );
//             $_SESSION['status'] = "Register Successfully ! Please verify your Email Adress !";
//             header("Location: register.php");
//         }else{
//             $_SESSION['status'] = "Registration Fail !";
//             header("Location: register.php");
//         }
// }
}
?>