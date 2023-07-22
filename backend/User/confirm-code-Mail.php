<?php
session_start();
require_once("../../connect/connectDB.php");

// Check if the token is submitted via GET
if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $email = $_SESSION[$token];
    
    // Check if the token exists in the session and the corresponding email is present in the database
    if (isset($_SESSION[$token]) && !empty($email)) {
        // Update the user's status_login to 'active' to confirm the email
        $sql = "UPDATE tb_user SET status_login = 'active' WHERE email = '$email'";
        $updateResult = execute($sql);

        if ($updateResult) {
            // Email confirmed successfully, you can redirect the user to a success page or login page

            // For demonstration purposes, let's redirect to a success page
            header('Location: login.php');
            exit;
        } else {
            echo "Failed to update status. Please try again.";
        }
    } else {
        echo "Invalid or expired token.";
    }
} else {
    echo "Token not provided.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="../css/login-register.css"/>
    <title>Code Comfirmation</title>
</head>
<body>
    <section>
        <div class="form-box">
            <div class="form-value">
                <form action="" method="post">
                    <h2 class="login-h2"> Code Comfirmation </h2>
                    <div class="inputbox">
                        <ion-icon name="lock-closed"></ion-icon>
                        <input type="password" name="repeatPassword" required>
                        <label for="">Repeat Your Password : </label>
                    </div>
                    <button type="submit" name="submit">Submit</button>
                </form>
            </div>
        </div>
    </section>
</body>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>