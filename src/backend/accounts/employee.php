<?php
session_start();
$from = $to = $error = '';
require_once('../../connect/connectDB.php');


$users = executeResult("SELECT * FROM tb_user WHERE role = 2");

?>

<div class="customers">
    <h1>Employee Management</h1>
    <div class="products">
    <div class="filter-product">
        <div class="form-search-header">
            <span class="material-symbols-sharp icon">search</span>
            <input id="filter-search-product" type="text" name="search" placeholder="Search ..." class="form-control">
        </div>
    </div>
</div>
    <div class="table_customer">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Employee</th>
                    <th>Email</th>
                    <th>Telephone</th>
                    <th>Salary</th>
                    <th>Create Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $key => $user) {
                    if ($user["role"] == 2) { ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= $user["username"] ?></td>
                            <td><?= $user["email"] ?></td>
                            <td><?= $user["phone"] ?></td>
                            <td><?= $user["salary"] ?></td>
                            <td><?= $user["create_date"] ?></td>
                            <td>
                                <?php if ($user["role"] == 2 && $user["status"] == 1) { ?>
                                    <button id="deactivateButton<?= $user["user_id"] ?>" onclick="deactivateUser(<?= $user["user_id"] ?>)" style="background-color: greenyellow;">Activate</button>
                                <?php } else { ?>
                                    <button id="deactivateButton<?= $user["user_id"] ?>" onclick="ActivateUser(<?= $user["user_id"] ?>)" style="background-color: gray;">Deactivate</button>
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
                data: {
                    code: userId
                },
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
                data: {
                    id: userId
                },
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