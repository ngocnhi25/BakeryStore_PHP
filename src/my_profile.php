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
        <h1>My Profile</h1>
        <p>Manage profile information for account security</p>
    </div>
    <div class="update-profile-box">
        <div class="profile-form">
            <form action="User/code-User.php" method="post" style="width: 100%;">
                <table style="width: 100%;">
                    <tr>
                        <td></td>
                        <td>
                            <div class="css-input">
                                <input type="hidden" id="name" name="userId" value="<?= $user_id ?>" readonly>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Username:</td>
                        <td>
                            <div class="css-input">
                                <input type="text" id="name" name="username" value="<?php echo $user["username"] ?>" readonly >
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td>
                            <div class="css-input">
                                <input type="email" id="email" name="email" value="<?php echo $user["email"] ?>" >
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Phone Number:</td>
                        <td>
                            <div class="css-input">
                                <input type="text" id="phone" name="phone" value="<?php echo $user["phone"] ?>">
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>Gender:</td>
                        <td>
                            <input type="radio" id="male" name="sex" value="Male" <?php if ($user["sex"] === 'Male') echo 'checked'; ?>> Male
                            <input type="radio" id="female" name="sex" value="Female" <?php if ($user["sex"] === 'Female') echo 'checked'; ?>> Female
                            <input type="radio" id="other" name="sex" value="Other" <?php if ($user["sex"] === 'Other') echo 'checked'; ?>> Other
                        </td>
                    </tr>
                    <tr>
                        <td>Date of Birth:</td>
                        <td><input type="date" id="dob" name="dob" value="<?php echo $user["birthday"] ?>"></td>
                    </tr>
                    <tr>
                        <td>Address:</td>
                        <td>
                            <div class="css-input">
                                <input type="text" name="address" value="<?php echo $user["address"] ?>">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><button class="submit" type="submit" name="submit-update-inforUser">Submit</button></td>
                    </tr>
                </table>

            </form>
        </div>
        <div class="profile-update-image">
            <div class="profile-image-box">
                <div class="profile-image">
                    <div id="preview-photo" class="preview-photo">
                        <img src="../public/images/icon/user.png" alt="">
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

