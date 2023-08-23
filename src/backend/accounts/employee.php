<?php
session_start();
$from = $to = $error = '';
if (isset($_POST["ajaxSidebar"])) {
    require_once('../../connect/connectDB.php');
}

$users = executeResult("SELECT * FROM tb_user WHERE role = 2");

?>

</head>

<body>
    <div class="customers">
        <h1>Employee Management</h1>
        <form id="salaryFilterForm" method="post">
    <p>
        Salary <span style="color: green;"> From $</span>
        <input type="text" name="from" id="form">
        <span style="color: green;"> To $</span>
        <input type="text" name="to" id="to">
        <button class="submit" type="button" id="sb-Search">Search</button>
    </p>
</form>

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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) {
                        if ($user["role"] == 2) { ?>
                            <tr>
                                <td><?= $user["user_id"] ?></td>
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
                                <td> <button> Update </button></td>
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

    $(document).ready(function() {
    $("#sb-Search").click(function(e) {
        e.preventDefault();

        var formData = new FormData();
        formData.append("from", $('#form').val());
        formData.append("to", $('#to').val());

        $.ajax({
            type: "POST",
            url: '../handles/filter-emp.php', 
            data: formData,
            contentType: false,
            processData: false,
            success: function(res) {
                if (res === 'success') {
                    alert("Filter applied successfully!");
                    // Do something after successful filtering
                } else {
                    alert("Error: " + res);
                }
            },
            error: function() {
                alert("An error occurred during filtering.");
            }
        });
    });
});

    </script>