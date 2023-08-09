<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
 if (isset($_SESSION["auth_user"])) {
    $user = executeResult("SELECT * FROM tb_user limit 1 ");
    // var_dump($user);
 }
?>
<div class="my-profile-page">
    <div class="profile-title">
        <h1>Change Password </h1>
        <!-- <p>Manage profile information for account security</p> -->
    </div>
    <div class="update-profile-box">
        <div class="profile-form">
            <form action="User/code-User.php" method="post" style="width: 100%;">
            <input type="text" id="name" name="userId" value="<?php echo $U["user_id"]?>" >
            <!-- <input type="text" id="name" name="token" value="<?php echo $U["token"]?>" > -->
                <table style="width: 100%;">
                <tr>
                        <td>Your Email </td>
                        <td>
                            <div class="css-input">
                                <input type="email" id="name" name="email" value="<?php echo $U["email"]?>" readonly >
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Current Password:</td>
                        <td>
                            <div class="css-input">
                                <input type="password" id="name" name="current-password" >
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>New Password:</label></td>
                        <td>
                            <div class="css-input">
                                <input type="password" id="email" name="new-password"  >
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Confirm New Password:</td>
                        <td>
                            <div class="css-input">
                                <input type="text" id="phone" name="confirm-password" >
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