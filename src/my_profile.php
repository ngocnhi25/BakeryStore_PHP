<?php
if (isset($_POST["page"])) {
    require_once("connect/connectDB.php");
    session_start();

    if (isset($_SESSION["auth_user"])) {
        $user_name = $_SESSION["auth_user"]["username"];
        $user_id = $_SESSION["auth_user"]["user_id"];
    }
}

$user = executeSingleResult("SELECT * FROM tb_user WHERE user_id = $user_id");
?>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<div class="my-profile-page">
    <div class="profile-title">
        <h1>My Profile</h1>
        <p>Manage profile information for account security</p>
    </div>
    <div class="update-profile-box">
        <div class="profile-form">
            <form action="" method="post" id="myform" style="width: 100%;">
            <input type="hidden" id="userId" name="userId" value="<?= $user_id ?>" readonly>    
            <table style="width: 100%;">
                    <tr>
                        <td></td>
                        <td>
                            <div class="css-input">
                                <input type="hidden" id="email" name="email" value="<?php echo $user["email"] ?>" readonly>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Username:</td>
                        <td>
                            <div class="css-input">
                                <input type="text" id="username" name="username" value="<?php echo $user["username"] ?>">
                                <div class="errorUsername error" style="color: red;"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Phone Number:</td>
                        <td>
                            <div class="css-input">
                                <input type="text" id="phone" name="phone" value="<?php echo $user["phone"] ?>">
                                <div class="errorPhone error" style="color: red;"></div>
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
                        <td>
                            <input type="date" id="dob" name="dob" value="<?php echo $user["birthday"] ?>">
                            <div class="errorBirthday error" style="color: red;"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>Address:</td>
                        <td>
                            <div class="css-input">
                                <input type="text" id="address" name="address" value="<?php echo $user["address"] ?>">
                                <div class="errorAddress error" style="color: red;"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><button class="submit" type="button" id="submitData" name="save_infor">Submit</button></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#submitData").click(function(e) {
            e.preventDefault();

            var formData = new FormData();

            formData.append("userId", $('#userId').val());
            formData.append("username", $('#username').val());
            formData.append("phone", $('#phone').val());
            formData.append("sex", $('input[name="sex"]:checked').val());
            formData.append("dob", $('#dob').val());
            formData.append("address", $('#address').val());

            $.ajax({
                type: "POST",
                url: 'User/code-profile.php',
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) {
                    if (res === 'success') {
                        alert("Save your information successfully!");
                        location.reload();
                        // You might want to update the UI or redirect here
                    } else {
                        var errors = JSON.parse(res);
                        for (var key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                $('.' + key).html(errors[key]);
                            }
                        }
                    }
                }
            });
        });
    });
</script>