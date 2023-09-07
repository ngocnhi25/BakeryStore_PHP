<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/backend/css/login-register.css">
    <title>Login Page</title>
</head>
<body>
    <section>
        <div class="form-box">
            <div class="form-value">
                <form action="code-User.php" method="post">
                    <h2 class="login-h2">LogIn </h2>
                    <div class="inputbox">
                        <ion-icon name="mail"></ion-icon>
                        <input type="email" name="email" required >
                        <label for="email" >Email:</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed"></ion-icon>
                        <input type="password" name="password" required >
                        <label for="password">Password:</label>
                    </div>
                    <div class="forget">
                        <a href="forgot-inputEmail.php">Forgot Password ? </a>
                    </div>
                    <button type="submit" name="submit-login-btn">Log In</button>
                    <div class="register">
                        <p>Don't have an account yet? <a href="register.php">Register Now </a></p> 
                    </div>
                </form>
            </div>
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
