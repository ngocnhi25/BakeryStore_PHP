<?php
session_start();
require_once("../../connect/connectDB.php");

?>
<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../backend/css/login-register.css">
    <title>Login Page</title>
</head>
<body>
    <section>
        <div class="form-box">
            <div class="form-value">
                <form action="logincode.php" method="post">
                    <h2 class="login-h2">Đăng Nhập</h2>
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
                        <label for="remember"><input type="checkbox" id="remember">Remember me</label>
                        <a href="">Forget Password</a>
                    </div>
                    <button type="submit" name="login-btn">Log In</button>
                    <div class="register">
                        <p>Don't have an account? <a href="register.php">Sign In</a></p>
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
