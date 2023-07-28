<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Code </title>
    <link rel="stylesheet" href="../../backend/css/login-register.css">
</head>

<body>
    <section>
        <div class="form-box">
            <div class="form-value">
                <form action="" method="post">
                    <h2 class="login-h2"> Input new password </h2>
                    <div class="inputbox">
                        <ion-icon name="mail"></ion-icon>
                        <input type="text" name="newPassword" required >
                        <label for="">New Password  : </label>
                    </div>
                    <button type="submit" name="submit-buton">Submit</button>
                    <div class="register">
                        <a href="login.php"> Log in </a></p>
                    </div>
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
