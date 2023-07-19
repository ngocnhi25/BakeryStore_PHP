<?php
define("APPPATH", "./");

require_once('../admin/connect/connectDB.php');
require_once('../admin/emailAutosend/Exception.php');
require_once('../admin/emailAutosend/OAuth.php');
require_once('../admin/emailAutosend/PHPMailer.php');
require_once('../admin/emailAutosend/POP3.php');
require_once('../admin/emailAutosend/SMTP.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

$email = "";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    setcookie("cookie_name", "", time() - 3600); // Set the expiration time in the past
}

if (isset($_POST["submit"])) {
    $email = $_POST["email"];

    // Establish a database connection
    $con = mysqli_connect($hostname, $usernamedb, $passworddb, $database);

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if the email exists in the database
    $sql = "SELECT * FROM tbUsers WHERE email = '" . mysqli_real_escape_string($con, $email) . "'";
    $result = executeResult($sql);

    if (count($result) != null ) {
        // Generate a random token
        $token = bin2hex(random_bytes(32));

        // Update the user's token in the database
        $sql = "UPDATE tbUsers SET token = '$token' WHERE email = '" . mysqli_real_escape_string($con, $email) . "'";
        $updateResult = execute($sql);

        if ($updateResult) {
            //#1
            $receiver = $email;
            $subject = 'Password Reset';
            $message = 'Please click the following link to reset your password: <a href="http://yourdomain.com/reset-password.php?token=' . $token . '">Reset Password</a>';

            //#2
            $mail = new PHPMailer();
            $mail->isSMTP();
            //Enable SMTP debugging
            // SMTP::DEBUG_OFF = off (for production use)
            // SMTP::DEBUG_CLIENT = client messages
            // SMTP::DEBUG_SERVER = client and server messages
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            //Set the encryption mechanism to use - STARTTLS or SMTPS
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->SMTPAuth = true;
            //Username to use for SMTP authentication - use full email address for gmail
            $mail->Username = 'truongdqvts2210038@fpt.edu.vn';
            $mail->Password = 'beebralhgdnwqlkw'; // sử dụng mật khẩu ứng dụng
            $mail->FromName = "truong";

            //#3
            $mail->setFrom('truongdqvts2210038@fpt.edu.vn');
            $mail->addAddress($receiver);
            $mail->Subject = $subject;
            $mail->msgHTML($message);

            if ($mail->send()) {
                header("Location: sendCode.php");
                exit();
            } else {
                $error = "Failed to send the reset password email. Please try again.";
            }
        } else {
            $error = "Failed to update the token. Please try again.";
        }
    } else {
        $error = "Email does not exist. Please enter a valid email address.";
    }

    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="../admin/CSS/login-register.css" />
</head>

<body>
    <section>
        <div class="form-box">
            <div class="form-value">
                <form action="" method="post">
                    <h2 class="login-h2">Forgot Password</h2>
                    <?php if (isset($error)) { ?>
                        <p style="color: red;"><?php echo $error; ?></p>
                    <?php } ?>
                    <div class="inputbox">
                        <ion-icon name="mail"></ion-icon>
                        <input type="email" name="email" required value="<?= htmlentities($email) ?>">
                        <label for="">Your Email : </label>
                    </div>
                    <button type="submit" name="submit">Submit</button>
                    <div class="register">
                        <p> Remember your password? <a href="login.php"> Log in </a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</html>
