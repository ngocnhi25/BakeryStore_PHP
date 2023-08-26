<?php
session_start();
require_once('../../connect/connectDB.php');

$users = executeResult("SELECT * FROM tb_user WHERE role = 1");
?>

<div class="customers">
    <h1>Customer Management</h1>
    <div class="disposition">
        <form id="salaryFilterForm" method="post">
            <p>
                <input type="text" id="getName" placeholder="Enter.." />Search
            </p>
        </form>
    </div>
    <div class="table_customer">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Employee</th>
                        <th>Email</th>
                        <th>Telephone</th>
                        <th>Create Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) {
                        if ($user["role"] == 1) { ?>
                            <tr>
                                <td><?= $user["user_id"] ?></td>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include other scripts -->
<script src="../../public/backend/js/admin.js"></script>
<script src="../../public/backend/js/adminJquery.js"></script>
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

    // $(document).ready(function() {
    //     $("#getName").on("keyup",function(e) {
    //         var getName = $(this).val();
    //         $.ajax({
    //             type: "POST",
    //             url: 'filter-emp.php', // Make sure this URL is correct
    //             data: {
    //                 name: getName
    //             },
    //             success: function(res) {
    //                 $("#showdata").html(res);
    //             }
    //         });
    //     });
    // });
</script>
