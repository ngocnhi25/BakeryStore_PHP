<?php
session_start();
require_once("connect/connectDB.php");
if (isset($_POST["page"])) {
    if (isset($_SESSION["auth_user"])) {
        $user_name = $_SESSION["auth_user"]["username"];
        $user_id = $_SESSION["auth_user"]["user_id"];
        $user = executeSingleResult("SELECT * FROM tb_user where user_id = $user_id");
    }
}


?>

<div class="my-profile-page">
    <div class="profile-title">
        <h1>Change Password</h1>
        <p>You need to authenticate your account by entering your existing password</p>
    </div>
    <div class="update-profile-box">
        <div class="profile-form">
            <form id="changePasswordForm" style="width: 100%;">
                <table style="width: 100%;">
                    <input type="hidden" id="id" name="id" value="<?= $user["user_id"] ?>" readonly>
                    <tr>
                        <td>Your Email:</td>
                        <td>
                            <div class="css-input">
                                <input type="email" id="email" name="email" value="<?= $user["email"] ?>" readonly>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Current Password:</td>
                        <td>
                            <div class="css-input">
                                <input type="password" id="current-password" name="current-password">
                                <div class="pass error" style="color: red;"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><button class="submit" type="button" id="sb-changePass" name="sb-changePassword-User">Submit</button></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#sb-changePass").click(function(e) {
            e.preventDefault();

            var formData = new FormData();

            formData.append("email", $('#email').val());
            formData.append("current-password", $('#current-password').val());

            $.ajax({
                type: "POST",
                url: 'User/code-change-Pass.php',
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) {
                    if (res === 'success') {
                        alert("Verify your account successfully !");
                        window.location.href = "changPass-inputNew.php"; 
                    } else if (res === 'fail') {
                        alert("Incorrect Password . Please input again !");
                    }else {
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