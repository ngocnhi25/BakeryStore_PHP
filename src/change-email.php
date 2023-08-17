<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password Page</title>
    <link rel="stylesheet" href="../public/backend/css/login-register.css">
</head>

<body>
    <section>
        <div class="form-box">
            <div class="form-value">
                <form action="User/code-User.php" method="post">
                    <h2 class="login-h2">Change Email </h2>
                    <div class="inputbox">
                        <ion-icon name="mail"></ion-icon>
                    <input type="hidden" name="id" value="<?php if(isset($_GET["id"])){echo $_GET["id"];} ?>" readonly >
                        <input type="email" name="new-email" required >
                        <label for="">New Email : </label>
                    </div>
                    <button type="submit" name="save-new-Email">Save New Email </button>
                </form>
            </div>
        </div>
    </section>
    <?php if(isset($_SESSION['status'])) { ?>
        <script>
            alert('<?php echo $_SESSION['status']; ?>');
        </script>
    <?php
        unset($_SESSION['status']);
    }
    ?>
</body>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</html>
