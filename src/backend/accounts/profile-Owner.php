<?php
session_start();
if(isset($_POST["ajaxSidebar"])) {
    require_once('../../connect/connectDB.php');
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
        <p>You need to authenticate your account by entering your existing password</p>
    </div>
    <div class="update-profile-box">
        <div class="profile-form">
            <form id="changePasswordForm" style="width: 100%;">
            <div class="pass error" style="color: red;"></div>
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



<script type="text/javascript">
    $(document).ready(function() {
        $("#sb-changePass").click(function(e) {
            e.preventDefault();

            var formData = new FormData();

            formData.append("email", $('#email').val());
            formData.append("current-password", $('#current-password').val());

            $.ajax({
                type: "POST",
                url: '../User/code-change-Pass-Owner.php',
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) {
                    if (res === 'success') {
                        alert("We sent email to update new password . Please verify !");
                    } else if (res === 'fail') {
                        alert("Incorrect Password . Please input again !");
                    }else if (res === 'error') {
                        alert("Send email Fail !");
                    }
                    else {
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