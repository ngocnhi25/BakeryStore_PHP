<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
require_once("connect/connectDB.php");
 if (isset($_SESSION["auth_user"])) {
    
 }
?>
<div class="my-profile-page">
    <div class="profile-title">
        <h1>My Profile</h1>
        <p>Manage profile information for account security</p>
    </div>
    <div class="update-profile-box">
        <div class="profile-form">
            <form action="User/code-User.php" method="post" style="width: 100%;">
            <?php if (isset($_SESSION["auth_user"])) { ?>
                <table style="width: 100%;">
                    <tr>
                        <td>Username:</td>
                        <td>
                            <div class="css-input">
                                <input type="text" id="name" name="username" value="<?=$_SESSION['auth_user']['username'] ?>">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td>
                            <div class="css-input">
                                <input type="email" id="email" name="email" value="<?=$_SESSION['auth_user']['email'] ?>" readonly >
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Phone Number:</td>
                        <td>
                            <div class="css-input">
                                <input type="text" id="phone" name="phone" value="<?=$_SESSION['auth_user']['phone'] ?>">
                            </div>
                        </td>
                    </tr>

                 <tr>
                        <td>Gender:</td>
                        <td>
                                <input type="radio" id="male" name="sex" value="Male" <?php if ($_SESSION['auth_user']['sex'] == 'Male') echo 'checked'; ?>> Male
                                <input type="radio" id="female" name="sex" value="Female" <?php if ($_SESSION['auth_user']['sex'] == 'Female') echo 'checked'; ?>> Female
                                <input type="radio" id="other" name="sex" value="Other" <?php if ($_SESSION['auth_user']['sex'] == 'Other') echo 'checked'; ?>> Other
                          </td>
</tr>
                    <?php if (isset($_SESSION["auth_user"]['dob'])) { ?>
                    <tr>
                        <td>Date of Birth:</td>
                        <td><input type="date" id="dob" name="dob" value="<?=$_SESSION['auth_user']['dob'] ?>" readonly required></td>
                    </tr>
                    <?php } else { ?>
                    <tr>
                        <td>Date of Birth:</td>
                        <td><input type="date" id="dob" name="dob" value="" required></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td>Address:</td>
                        <td>
                            <div class="css-input">
                                <input type="text" name="address" required value="<?=$_SESSION['auth_user']['address'] ?>">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><button class="submit" type="submit" name="submit-update-inforUser">Submit</button></td>
                    </tr>
                    <?php } ?>
                </table>
                
            </form>
        </div>
        <div class="profile-update-image">
            <div class="profile-image-box">
                <div class="profile-image">
                    <div id="preview-photo" class="preview-photo">
                        <img src="../public/images/admin2.jpg" alt="">
                    </div>
                    <div class="btn-photo">
                        <input id="photo-profile" type="file" name="profile-image" accept="image/*">
                    </div>
                    <div class="text">
                        <span>Maximum file size 1 MB</span>
                        <span>Format: .JPEG, .PNG, .JPG</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>