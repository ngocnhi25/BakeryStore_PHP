<?php

if(isset($_POST["page"])){
    require_once("connect/connectDB.php");
    session_start();

    if (isset($_SESSION["auth_user"])) {
        $user_name = $_SESSION["auth_user"]["username"];
        $user_id = $_SESSION["auth_user"]["user_id"];
    }
}
$user = executeSingleResult("SELECT * FROM tb_user where user_id = $user_id");


?>
<div class="my-profile-page">
    <div class="profile-title">
        <h1>Change Password</h1>
    </div>
    <div class="update-profile-box">
        <div class="profile-form">
            <form action="User/code-User.php" method="post" style="width: 100%;">
                <input type="hidden" id="name" name="userId" value="<?php echo $user["user_id"]?>" >
                <table style="width: 100%;">
                    <tr>
                        <td>Your Email:</td>
                        <td>
                            <div class="css-input">
                                <input type="email" id="email" name="email"  value="<?= $user["email"]?>" readonly>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Current Password:</td>
                        <td>
                            <div class="css-input">
                                <input type="password" id="current-password" name="current-password" required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>New Password:</td>
                        <td>
                            <div class="css-input">
                                <input type="password" id="new-password" name="new-password" required >
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Confirm New Password:</td>
                        <td>
                            <div class="css-input">
                                <input type="password" id="confirm-password" name="confirm-password" required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><button class="submit" type="submit" name="sb-changePassword-User">Submit</button></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
