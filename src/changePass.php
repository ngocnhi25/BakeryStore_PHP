<?php
if (isset($_POST["page"])) {
    require_once("connect/connectDB.php");
    session_start();

    if (isset($_SESSION["auth_user"])) {
        $user_name = $_SESSION["auth_user"]["username"];
        $user_id = $_SESSION["auth_user"]["user_id"];
    }
}
$user = executeSingleResult("SELECT * FROM tb_user where user_id = $user_id");
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

<div class="my-profile-page">
    <div class="profile-title">
        <h1>Change Password</h1>
    </div>
    <div class="update-profile-box">
        <div class="profile-form">
            <form action="" method="post" id="changeEmail" style="width: 100%;">
                <input type="hidden" id="name" name="userId" value="<?php echo $user["user_id"] ?>">
                <table style="width: 100%;">
                    <tr>
                        <td>Your Email:</td>
                        <td>
                            <div class="css-input">
                                <input type="email" id="email" name="email" value="<?= $user["email"] ?>" readonly>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#editEmail"> Edit</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Current Password:</td>
                        <td>
                            <div class="css-input">
                                <input type="password" id="current-password" name="current-password" required>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#editPass"> Edit</button>
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editEmail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel" >Request to change email </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" id="saveNewEmail"> 
      <div class="modal-body">
        <div class="mb-3"></div>
        <p> Are you sure you want to update your new email? </p>
        <p> If sure, please enter your new email here, we will send a confirmation link to the new email you entered. </p>
        <div class="errornewemail error" style="color: red;"></div>
        <label for="">New Email : </label>
        <input type="hidden" id="name" name="username" value="<?php echo $user["username"] ?>">
        <input type="email" name="newemail" class="form-control"> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save </button>
      </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('submit', '#saveNewEmail', function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_email", true);

            $.ajax({
                type: "POST",
                url: 'User/code-Email-Pass.php',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response === 'success') {
                        alert("Save your email successfully!");
                        // You might want to update the UI or redirect here
                    } else {
                        var errors = JSON.parse(response);
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
