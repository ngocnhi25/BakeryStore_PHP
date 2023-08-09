<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
// require_once("../connect/connectDB.php");

$user = array(); // Initialize the $user array to avoid undefined variable warnings

if (isset($_SESSION["auth_user"])) {
    $userID = $_SESSION['auth_user']['user_id'];
    $user = executeResult("SELECT * FROM tb_user where user_id = $userID");
}
var_dump($user) ;
?>


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
                                <input type="hidden" id="name" name="userId" value="<?=$_SESSION['auth_user']['user_id'] ?>" readonly >
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Username:</td>
                        <td>
                            <div class="css-input">
                                <input type="text" id="name" name="username" value="<?php echo $U["username"]?>">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td>
                            <div class="css-input">
                                <input type="email" id="email" name="email" value="<?php echo $U["email"]?>" readonly >
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Phone Number:</td>
                        <td>
                            <div class="css-input">
                                <input type="text" id="phone" name="phone" value="<?php echo $U["phone"]?>" >
                            </div>
                        </td>
                    </tr>

                    <tr>
                         <td>Gender:</td>
                         <td>
                                <input type="radio" id="male" name="sex" value="Male" <?php if ($U["sex"] === 'Male') echo 'checked'; ?> > Male
                                <input type="radio" id="female" name="sex" value="Female" <?php if ($U["sex"] === 'Female') echo 'checked'; ?> > Female
                                <input type="radio" id="other" name="sex" value="Other" <?php if ($U["sex"] === 'Other') echo 'checked'; ?> > Other
                        </td>
                    </tr>
                    <tr>
                        <td>Date of Birth:</td>
                        <td><input type="date" id="dob" name="dob" value="<?php echo $U["birthday"]?>" required></td>
                    </tr>
                    <tr>
                        <td>Address:</td>
                        <td>
                            <div class="css-input">
                                <input type="text" name="address" required value="<?php echo $U["address"]?>" >
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