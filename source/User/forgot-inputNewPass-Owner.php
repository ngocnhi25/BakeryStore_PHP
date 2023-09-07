<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Owner </title>
    <link rel="stylesheet" href="../../public/backend/css/login-register.css">
</head>

<body>
    <section>
        <div class="form-box">
            <div class="form-value">
                <form action="code-User-Owner.php" method="post">
                    <h2 class="login-h2"> Reset Password Form for Owner </h2>
                    <input type="hidden" name="token" value="<?php if(isset($_GET["token"])){echo $_GET["token"];} ?>" readonly >
                    <input type="hidden" name="email" value="<?php if(isset($_GET["email"])){echo $_GET["email"];} ?>" readonly >
                    <div class="inputbox">
                        <ion-icon name="mail"></ion-icon>
                        <input type="password" name="newPassword" required >
                        <label for="">New Password  : </label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="mail"></ion-icon>
                        <input type="password" name="confirm_newPassword" required >
                        <label for=""> Confirm New Password  : </label>
                    </div>
                    <button type="submit" name="update-password-btn">Update Password </button>
                </form>
        </div>
    </section>
    <?php if(isset($_SESSION['status'])) { ?>
        <script>
            alert('<?php echo $_SESSION['status']; ?>');
        </script>
    <?php
        unset($_SESSION['status']); // Clear the session status after displaying
    }
    ?>
</body>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</html>
