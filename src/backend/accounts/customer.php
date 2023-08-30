<?php
session_start();
require_once('../../connect/connectDB.php');

$users = executeResult("SELECT * FROM tb_user WHERE role = 1");
?>
<style>
     .filter-product .form-search-header {
            top: 30%;
            position: relative;
            width: 300px;
        }

        .filter-product .form-search-header .icon {
            color: #777e90;
            position: absolute;
            top: 9px;
            left: 10px;
            font-size: 16px;
        }

        .filter-product .form-search-header input {
            border-radius: 20px;
            padding-left: 30px;
            margin-bottom: 20px;
        }

        .filter-product .form-control:focus {
            color: #495057;
            background-color: #fff;
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25);
        }

        .filter-product .form-control {
            display: block;
            width: 100%;
            height: calc(2.25rem + 2px);
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

</style>

<div class="products">
    <h1>Customer Management</h1>
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
                        <th>Customer</th>
                        <th>Email</th>
                        <th>Telephone</th>
                        <th>Create Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $key => $user) {
                    if ($user["role"] == 1) { ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                                <td><?= $user["username"] ?></td>
                                <td><?= $user["email"] ?></td>
                                <td><?= $user["phone"] ?></td>
                                <td><?= $user["create_date"] ?></td>
                                <td>
                                    <?php if ($user["role"] == 1 && $user["status"] == 1) { ?>
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
