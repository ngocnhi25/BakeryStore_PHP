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



// Register.php
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
        <a href='http://localhost/Group3-BakeryStore/src/User/code-User.php?token=$token'>Click me</a>
        ";
        $mail->Body = $mail_template;
        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

// forgot-inputEmail.php
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
    <a href='http://localhost/Group3-BakeryStore/src/User/forgot-inputNewPass.php?token=$token&email=$get_email'>Click me</a>
    ";
        $mail->Body = $mail_template;
        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}


// 1. Register page - code
if (isset($_POST["submit-register-btn"])){

    if (isset($_POST["username"])) {
        // Perform validation checks
        $username = trim($_POST["username"]);
    
        if (empty($username)) {
            $_SESSION['status'] = "Username must not be blank.";
            header("Location: register.php");
            exit();
        } 
        
        if (strpos($username, ' ') !== false) {
            $_SESSION['status'] = "Username must not contain spaces.";
            header("Location: register.php");
            exit();
        }

        if (!preg_match("/^[a-zA-Z0-9]{6,20}$/", $username)) {
            $_SESSION['status'] = "Username must be between 6 and 20 characters long and consist of letters and numbers only.";
            header("Location: register.php");
            exit();
        }
    }

    if (isset($_POST["password"])){
        $password = $_POST["password"];
        if (empty($password)) {
            $_SESSION['status'] = "Password must not be blank.";
            header("Location: register.php");
            exit();
        } 
        
        if (strpos($password, ' ') !== false) {
            $_SESSION['status'] = "Password must not contain spaces.";
            header("Location: register.php");
            exit();
        }

        if (!preg_match("/^[a-zA-Z0-9!@#$%^&*()_+{}:;<>?~]{6,20}$/", $password)) {
            $_SESSION['status'] = "Password must be between 6 and 20 characters long and consist of letters, numbers, and special characters only.";
            header("Location: register.php");
            exit();
        }
    }
   
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $repeatPassword = $_POST["repeatPassword"];
    $token = md5(rand()); // Generate a unique token

     // Hash the password for security
     $hashed_password = md5($password);

    // Perform validation checks
    if ($password != $repeatPassword) {
        $_SESSION['status'] = "Passwords don not match!";
        header("Location: register.php");
        exit();
    }

    if (!preg_match("/^[0-9]{10,12}$/", $phone)) {
        $_SESSION['status'] = "Invalid Phone Number!";
        header("Location: register.php");
        exit();
    }


    // Check if the email exists in the database
    // status 0 = chua verify email , chua xac that 
    // status 1 = da xac that 

    $sql_checkmail = "SELECT email FROM tb_user WHERE email = '$email' AND status = '0'  LIMIT 1";
    $sql_checkmail_run = mysqli_query($conn,  $sql_checkmail);
   if (mysqli_num_rows($sql_checkmail_run) > 0) {
        $_SESSION['status'] = "Email already exists but not verify yet ! Please check email to verify ";
        header("Location: register.php");
        exit();
    }

    $sql_checkmail2 = "SELECT email FROM tb_user WHERE email = '$email' AND status = '1'  LIMIT 1";
    $sql_checkmail2_run = mysqli_query($conn,  $sql_checkmail2);
    if (mysqli_num_rows($sql_checkmail2_run) > 0) {
        $_SESSION['status'] = "Email already exists ! Please login ! ";
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

// 2. Login page -code
if(isset($_POST["submit-login-btn"])){
    if(!empty(trim($_POST["email"])) && !empty(trim($_POST["email"])) ){
        $email = $_POST["email"];
        $password = md5($_POST["password"]);
        $token_login = md5(rand());
        
        $sql_login = "SELECT * FROM tb_user WHERE email = '$email'  and password = '$password' LIMIT 1" ;
        $sql_login_run = mysqli_query($conn,$sql_login);

        if (mysqli_num_rows($sql_login_run) > 0) {
            $row = mysqli_fetch_array(($sql_login_run));
            if ($row['status'] == "1" && $row['stt_delete'] == "0") {
                $sql_update_login_recent_day =  "UPDATE tb_user SET recent_day_login = NOW() , token_login = '$token_login' WHERE email = '$email' LIMIT 1";
                $sql_update_login_recent_day_run = mysqli_query($conn, $sql_update_login_recent_day);              
                if ($sql_update_login_recent_day_run) {
                    $_SESSION['authenticeted'] = TRUE;
                    $_SESSION['auth_user'] = [
                        'user_id' => $row['user_id'],
                        'username' => $row['username'],
                        'role' => $row['role'],
                        'token_login' => $row['token_login'],
                    ];
                    if ($_SESSION["auth_user"]["role"] == 3) {
                        $_SESSION['status'] = " You logged in successfully !";
                        header("Location: ../backend/admin_owner.php");
                        exit();
                    } elseif ($_SESSION["auth_user"]["role"] == 2) {
                        $_SESSION['status'] = " You logged in successfully !";
                        header("Location: ../backend/admin_employee.php");
                        exit();
                    } else {
                        $_SESSION['status'] = " You logged in successfully !";
                        header("Location: ../home.php");
                        exit();
                    }
                } else {
                    $_SESSION['status'] = "Failed to update recent day login!";
                    header("Location: ../home.php");
                    exit();
                }
            }else{
                $_SESSION['status'] = "Email is not verified or can be deleted !";
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

// 3. forgot-inputEmail.php
 // Input Email to update new password 
if (isset($_POST["submit-resetPass"])) {
    $email = $_POST["email"];
    $token = md5(rand()); // Generate a unique token

    $sql_checkmail = "SELECT * FROM tb_user WHERE email = '$email' LIMIT 1";
    $sql_checkmail_run = mysqli_query($conn, $sql_checkmail);

    if (mysqli_num_rows($sql_checkmail_run) > 0) {
        $row = mysqli_fetch_array($sql_checkmail_run);
        if ($row["status"] == "1" && $row['stt_delete'] == "0" ) {
            $get_name = $row["username"];
            $get_email = $row["email"];

            $sql_update = "UPDATE tb_user SET token = '$token' WHERE email = '$get_email' and username = '$get_name' ";
            $sql_update_run = mysqli_query($conn, $sql_update);

            if ($sql_update_run) {
                sendEmail_update_Password($get_name, $get_email,$token);
                $_SESSION['status'] = "We emailed you a password reset link! Please verify your email :  $get_email ";
                 header("Location: forgot-inputEmail.php");
                exit();
            } else {
                $_SESSION['status'] = "Send Mail update Fail!";
                header("Location: forgot-inputEmail.php");
                exit();
            }

        } else {
            $_SESSION['status'] = "Email is not verified or can be deleted !";
            header("Location: forgot-inputEmail.php");
            exit();
        }
        
    } else {
        $_SESSION['status'] = "Email does not exist. Please register your account!";
        header("Location: forgot-inputEmail.php");
        exit();
    }
}


// 4 . forgot-inputNewPass.php
// Input new password into database 

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
                $sql_update_password = "UPDATE tb_user SET password = '$hashpass' WHERE token = '$token'";
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






// . Web+token ( verify email registered)

if(isset($_GET["token"])){
    $token = $_GET["token"] ;
    $sql_verify = " SELECT token , status FROM tb_user WHERE token = '$token' LIMIT 1";
    $sql_verify_run = mysqli_query($conn,  $sql_verify);

    if(mysqli_num_rows($sql_verify_run) > 0 ){
        $row = mysqli_fetch_array($sql_verify_run);
        if($row['status'] == "0"){
            $clicked_token = $row['token'] ;
            $sql_update = "UPDATE tb_user SET status = '1' WHERE token = '$clicked_token' LIMIT 1";
            $sql_update_run = mysqli_query($conn, $sql_update );

            if( $sql_update_run){
                $_SESSION['status'] = "Your Account has been verified successfully !";
                header("Location: login.php ") ;
                exit();
            }else{
                $_SESSION['status'] = "Verification Failed !";
                header("Location: login.php ") ;
                exit();
            }
        }else {
            $_SESSION['status'] = "Email already verified . Please login !";
            header("Location: login.php ") ;
            exit();
        }
    }}else {
    $_SESSION['status'] = " Not Allowed !";
    header("Location: login.php ") ;
    exit();
}
