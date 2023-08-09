
<div class="my-profile-page">
    <div class="profile-title">
        <h1>My Profile</h1>
        <p>Manage profile information for account security</p>
    </div>
    <div class="update-profile-box">
        <div class="profile-form">
            <form action="User/code-User.php" method="post" style="width: 100%;">
            <?php foreach($user as $U ){?>
                <table style="width: 100%;">
                <tr>
                        <td></td>
                        <td>
                            <div class="css-input">
                                <input type="hidden" id="name" name="userId" value="<?php echo $U["user_id"]?>" >
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
                    <?php } ?>
                </table>
                
            </form>
        </div>
    </div>
</div>