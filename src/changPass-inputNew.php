<?php
require_once("connect/connectDB.php");
session_start();

if (isset($_SESSION["auth_user"])) {
    $user_name = $_SESSION["auth_user"]["username"];
    $user_id = $_SESSION["auth_user"]["user_id"];
    $user = executeSingleResult("SELECT * FROM tb_user WHERE user_id = $user_id");
    $email = $user["email"];
    if (isset($_POST["sb-Update-Pass"])) {
        $confirm_newPassword = ($_POST["con-password"]);
        $newPassword = $_POST["new-password"];
        if (empty($newPassword)) {
            $_SESSION['status'] = "New Password must not be blank.";
        } elseif (strpos($newPassword, ' ') !== false) {
            $_SESSION['status'] = "New Password must not contain spaces.";
        } elseif (!preg_match("/^[a-zA-Z0-9!@#$%^&*()_+{}:;<>?~]{6,20}$/", $newPassword)) {
            $_SESSION['status'] = "New Password must be between 6 and 20 characters.";
        } elseif ($newPassword !== $confirm_newPassword) {
            $_SESSION['status'] = "Password and Confirm Password do not match!";
        } else {
            // Use more secure hashing method like password_hash
            $hashpass = md5($newPassword); 
            
            $sql_update2 = "UPDATE tb_user SET password = '$hashpass' WHERE email = '$email' ";
            $sql_update2_run = mysqli_query($conn, $sql_update2);
            if ($sql_update2_run) {
                $_SESSION['status'] = "Save new password successfully!";
            } else {
                $_SESSION['status'] = "Failed to update password.";
            }
        }

        header("Location: home.php");
        exit();
    }
}
?>

<?php require "layout/header.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* profile */
        .my-profile-page {
            width: 100%;
            height: 100%;
            display: block;
            background-color: #fff;
            padding: 0 1.875rem 0.625rem;
            border-radius: 3px;
        }

        .my-profile-page .profile-title {
            border-bottom: 0.0625rem solid #efefef;
            padding: 1.125rem 0;
        }

        .my-profile-page .profile-title h1 {
            margin: 0;
            font-size: 1.5em;
            font-weight: 500;
            line-height: 1.5rem;
            text-transform: capitalize;
            color: #333;
            margin-left: 450px;
            margin-bottom: 10px;
        }

        .my-profile-page .profile-title p {
            margin-top: 0.1875rem;
            font-size: .875rem;
            line-height: 1.0625rem;
            color: #555;
            margin-left: 450px;
            margin-bottom: 0;
        }

        .my-profile-page .update-profile-box {
            padding-top: 1.875rem;
            display: flex;
            align-items: stretch;
            justify-content: space-between;
        }

        .my-profile-page .update-profile-box .profile-form {
            width: 100%;
            padding-right: 3.125rem;
        }

        .my-profile-page .update-profile-box .profile-form table tr td {
            padding-bottom: 30px;
        }
        .my-profile-page .update-profile-box .profile-form p {
           color: red ;
           margin-left: 450px;
        }

        .my-profile-page .update-profile-box .profile-form table tr td:first-child {
            text-align: right;
            width: 25%;
        }

        .my-profile-page .update-profile-box .profile-form table tr td:last-child {
            box-sizing: border-box;
            padding-left: 20px;
            width: 75%;
        }

        .my-profile-page .update-profile-box .profile-form .css-input input {
            width: 60%;
            padding: 10px;
            border: 1px solid;
            outline: none;
            border-radius: 3px;
            font-size: 16px;
            color: #141212;
            transition: .5s;
        }

        .my-profile-page .update-profile-box .profile-update-image {
            width: 17.8rem;
        }

        .my-profile-page .update-profile-box .profile-update-image .profile-image-box {
            border-left: 0.0625rem solid #efefef;
        }

        .my-profile-page .update-profile-box .profile-update-image .profile-image {
            flex-direction: column;
            width: 10.6931rem;
            margin: 0 auto;
            text-align: center;
        }

        .my-profile-page .update-profile-box .profile-update-image .profile-image .btn-photo input[type="file"] {
            visibility: hidden;
        }

        .my-profile-page .update-profile-box .profile-update-image .profile-image .btn-photo input[type="file"]::before {
            content: 'Choosen a photo';
            display: inline-block;
            border: 1px solid #efefef;
            border-radius: 3px;
            padding: 5px 8px;
            outline: none;
            white-space: nowrap;
            cursor: pointer;
            font-size: 16px;
            visibility: visible;
            margin-left: 20px;
        }

        .my-profile-page .update-profile-box .profile-update-image .profile-image .preview-photo {
            height: 6.25rem;
            width: 6.25rem;
            margin: 1.25rem 0;
            position: relative;
            margin: 10px auto;
            padding: 2px;
        }

        .my-profile-page .update-profile-box .profile-update-image .profile-image img {
            height: 100%;
            width: 100%;
            border-radius: 50%;
            object-fit: contain;
            vertical-align: middle;
        }

        .my-profile-page .update-profile-box .profile-update-image .profile-image .text {
            text-align: left;
            display: flex;
            flex-direction: column;
            padding-top: 10px;
        }

        .submit {
            background-color: red;
            padding: 0.4rem 0.9rem 0.4rem 0.9rem;
            font-weight: 500;
            font-size: 1rem;
            border-radius: 5px;
            border: none;
            transition: box-shadow 0.3s ease;
            box-shadow: 1px 1px 3px black;
        }

        .submit:hover {
            box-shadow: none;
        }
    </style>
</head>

<body>
    <div class="my-profile-page">
        <div class="profile-title">
            <h1>Update New Password</h1>
            <p>Please enter a new password to update your password.</p>
        </div>
        <div class="update-profile-box">
            <div class="profile-form">
                <p><?php echo $errors; ?></p>
                <form action="" method="post" style="width: 100%;">
                    <table style="width: 100%;">
                        <input type="hidden" id="id" name="id" value="<?= $user["user_id"] ?>" readonly>
                        <tr>
                            <td>Your Email:</td>
                            <td>
                                <div class="css-input">
                                    <input type="text" id="email" name="email" value="<?= $email ?>" readonly>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>New Password :</td>
                            <td>
                                <div class="css-input">
                                    <input type="password" id="new-password" name="new-password">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Confirm Password :</td>
                            <td>
                                <div class="css-input">
                                    <input type="password" id="con-password" name="con-password">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><button class="submit" type="submit" name="sb-Update-Pass">Submit</button></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<?php if(isset($_SESSION['status'])) { ?>
        <script>
            alert('<?php echo $_SESSION['status']; ?>');
        </script>
    <?php
        unset($_SESSION['status']); // Clear the session status after displaying
    }
    ?>

<?php include("layout/footer.php"); ?>