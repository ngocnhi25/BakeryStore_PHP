<?php
require_once('../../connect/connectDB.php');

$users = executeResult("SELECT * FROM tb_user WHERE role = 1")
?>

<div class="customers">
    <h1>Customer Management</h1>
    <div class="disposition">
        <select name="" id="">
            <option value="">____Sắp xếp____</option>
            <option value="">New</option>
            <option value="">Old</option>
        </select>
    </div>
    <div class="table_customer">
        <table>
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Email</th>
                    <th>Telephone</th>
                    <th>Create Date</th>
                    <th> Action </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) {
                    if ($user["role"] == 1) { ?>
                        <tr>
                            <td><?= $user["username"] ?></td>
                            <td><?= $user["email"] ?></td>
                            <td><?= $user["phone"] ?></td>
                            <td><?= $user["create_date"] ?></td>
                            <td>
                            <?php if ($user["role"] == 1 && $user["status"] == 1 ) { ?>
                            <button id="deactivateButton<?= $user["user_id"] ?>" onclick="deactivateUser(<?= $user["user_id"] ?>)" style="background-color: greenyellow;" >Activate</button>
                            <?php } else { ?>
                            <button id="deactivateButton<?= $user["user_id"] ?>" onclick="ActivateUser(<?= $user["user_id"] ?>)" style="background-color: gray;" >Deactivate</button>
                             <?php } ?>   
                        </td>

                        </tr>
                <?php }
                } ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    function deactivateUser(userId) {
        if (confirm("Are you sure you want to deactivate this user?")) {
            // User confirmed, perform the deactivation logic
            $.ajax({
                type: "GET",
                url: '../User/deactive.php',
                data: { code: userId },
                success: function(res) {
                    if (res === 'success') {
                        alert("User deactivated successfully!");
                    } else {
                        alert("Failed to deactivate user.");
                    }
                }
            });
        }
    }

    function ActivateUser(userId) {
        if (confirm("Are you sure you want to Activate this user?")) {
            // User confirmed, perform the deactivation logic
            $.ajax({
                type: "GET",
                url: '../User/deactive.php',
                data: { id: userId },
                success: function(res) {
                    if (res === 'success') {
                        alert("User Activated successfully!");
                    } else {
                        alert("Failed to Activate user.");
                    }
                }
            });
        }
    }




</script>