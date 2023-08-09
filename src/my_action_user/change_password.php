<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
require_once("../connect/connectDB.php");

$user = array(); // Initialize the $user array

if (isset($_SESSION["auth_user"])) {
    $userID = $_SESSION['auth_user']['user_id'];
    $user = executeResult("SELECT * FROM tb_user WHERE user_id = $userID");
}
?>

<div class="my-profile-page">
    <div class="profile-title">
        <h1>Change Password</h1>
    </div>
    <div class="update-profile-box">
        <div class="profile-form">
            <form action="User/code-User.php" method="post" style="width: 100%;">
                <?php foreach($user as $U) { ?>
                <input type="hidden" id="name" name="userId" value="<?php echo $U["user_id"]?>" >
                <table style="width: 100%;">
                    <tr>
                        <td>Your Email:</td>
                        <td>
                            <div class="css-input">
                                <input type="email" id="email" name="email" value="<?php echo $U["email"]?>" readonly>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Current Password:</td>
                        <td>
                            <div class="css-input">
                                <input type="password" id="current-password" name="current-password">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>New Password:</td>
                        <td>
                            <div class="css-input">
                                <input type="password" id="new-password" name="new-password">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Confirm New Password:</td>
                        <td>
                            <div class="css-input">
                                <input type="password" id="confirm-password" name="confirm-password">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><button class="submit" type="submit" name="sb-changePassword-User">Submit</button></td>
                    </tr>
                </table>
                <?php } ?>
            </form>
        </div>
    </div>
</div>
