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

$email = $password = $repeatPassword = "";
$errors = array();
$errors["pass"] = $errors["mail"] = '';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    setcookie("cookie_name", "", time() - 3600); // Set the expiration time in the past
}

if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $repeatPassword = $_POST["repeatPassword"];

    if ($password != $repeatPassword) {
        $errors["pass"] = 'Passwords don\'t match!';
    }

    if (empty($errors["pass"])) {
        // Establish a database connection
        $con = mysqli_connect($hostname, $usernamedb, $passworddb, $database);

        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Check if the email already exists in the database
        $sql = "SELECT * FROM tbUsers WHERE email = '" . mysqli_real_escape_string($con, $email) . "'";
        $result = executeResult($sql);

        if (count($result) == 0) {
            // Insert the new user into the database
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO tbUsers (email, password) VALUES ('" . mysqli_real_escape_string($con, $email) . "', '$hashedPassword')";
            $insertResult = execute($sql);

            if ($insertResult) {
                //#1
                $receiver = $email;
                $subject = 'PHP mailer';
                $message = 'F88 nha cai hang dau Chau Au';

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
                $mail->Username = '';
                $mail->Password = ''; // sử dụng mật khẩu ứng dụng
                $mail->FromName = "truong";

                //#3
                $mail->setFrom('truongdqvts2210038@fpt.edu.vn');
                $mail->addAddress($receiver);
                $mail->Subject = $subject;
                $mail->msgHTML($message);

                if (!$mail->send()) {
                    $errors["mail"] = "Failed to register. Please try again.";
                } else {
                    header("Location: login.php");
                    exit();
                }
            } else {
                $errors["mail"] = "Failed to register. Please try again.";
            }
        } else {
            $errors["mail"] = "Email already exists. Please enter another email.";
        }

        mysqli_close($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="../admin/CSS/login-register.css" />
</head>

<body>
    <section>
        <div class="form-box">
            <div class="form-value">
                <form action="" method="post">
                    <h2 class="login-h2">Register Form</h2>

                    <div style="text-align: center;    margin-top: 10px;">
                        <p style="color: red;">
                            <?php echo $errors["pass"] ?>
                            <?php echo $errors["mail"] ?>
                        </p>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="mail"></ion-icon>
                        <input type="email" name="email" required value="<?= htmlentities($email) ?>">
                        <label for="">Your Email : </label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-open"></ion-icon>
                        <input type="password" name="password" required>
                        <label for=""> Your Password : </label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed"></ion-icon>
                        <input type="password" name="repeatPassword" required>
                        <label for="">Repeat Your Password : </label>
                    </div>
                    <button type="submit" name="submit">Submit</button>
                    <div class="">
                        <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
                        </fb:login-button>

                        <div id="status">
                        </div>

                        <div id="fb-root"></div>
                        <script async defer crossorigin="anonymous"
                            src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v17.0"
                            nonce="NycYYZOm"></script>

                        <!-- Load the JS SDK asynchronously -->
                        <!-- <div class="fb-login-button" data-width="500" data-size="" data-button-type="" data-layout=""
                            data-auto-logout-link="false" data-use-continue-as="false"></div> -->
                    </div>
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
<script>
    function statusChangeCallback(response) {  // Called with the results from FB.getLoginStatus().
        console.log('statusChangeCallback');
        console.log(response);                   // The current login status of the person.
        if (response.status === 'connected') {   // Logged into your webpage and Facebook.
            testAPI();
        } else {                                 // Not logged into your webpage or we are unable to tell.
            document.getElementById('status').innerHTML = 'Please log ' +
                'into this webpage.';
        }
    }


    function checkLoginState() {               // Called when a person is finished with the Login Button.
        FB.getLoginStatus(function (response) {   // See the onlogin handler
            statusChangeCallback(response);
        });
    }


    window.fbAsyncInit = function () {
        FB.init({
            appId: '{app-id}',
            cookie: true,                     // Enable cookies to allow the server to access the session.
            xfbml: true,                     // Parse social plugins on this webpage.
            version: '{api-version}'           // Use this Graph API version for this call.
        });


        FB.getLoginStatus(function (response) {   // Called after the JS SDK has been initialized.
            statusChangeCallback(response);        // Returns the login status.
        });
    };

    function testAPI() {                      // Testing Graph API after login.  See statusChangeCallback() for when this call is made.
        console.log('Welcome!  Fetching your information.... ');
        FB.api('/me', function (response) {
            console.log('Successful login for: ' + response.name);
            document.getElementById('status').innerHTML =
                'Thanks for logging in, ' + response.name + '!';
        });
    }

</script>

</html>