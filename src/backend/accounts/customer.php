<?php
session_start();
require_once('../../connect/connectDB.php');
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
                    <th>Customer</th>
                    <th>Email</th>
                    <th>Telephone</th>
                    <th>Gender</th>
                    <th>Date of Birth</th>
                    <th>Create Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="showdata">
                <?php
                $sql = "SELECT * FROM tb_user WHERE role = 1";
                $sql_run = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($sql_run)) {
                    echo "<tr>
                    <td>" . $row["user_id"] . "</td>
                    <td>" . $row["username"] . "</td>
                    <td>" . $row["email"] . "</td>
                    <td>" . $row["phone"] . "</td>
                    <td>" . $row["sex"] . "</td>
                    <td>" . $row["birthday"] . "</td>
                    <td>" . $row["create_date"] . "</td>
                    <td>";
                    if ($row["role"] == 1 && $row["status"] == 1) {
                        echo '<button id="deactivateButton' . $row["user_id"] . '" onclick="deactivateUser(' . $row["user_id"] . ')" style="background-color: greenyellow;">Activate</button>';
                    } else {
                        echo '<button id="deactivateButton' . $row["user_id"] . '" onclick="activateUser(' . $row["user_id"] . ')" style="background-color: gray;">Deactivate</button>';
                    }
                    echo '</td>
                </tr>';
                }
                ?>
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
            $.ajax({
                type: "GET",
                url: '../User/deactivate.php', // Assuming the correct URL
                data: {
                    id: userId
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

    function activateUser(userId) {
        if (confirm("Are you sure you want to activate this user?")) {
            $.ajax({
                type: "GET",
                url: '../User/activate.php', // Assuming the correct URL
                data: {
                    id: userId
                },
                success: function(res) {
                    if (res === 'success') {
                        alert("User activated successfully!");
                    } else {
                        alert("Failed to activate user.");
                    }
                }
            });
        }
    }

    $(document).ready(function() {
        $("#getName").on("keyup",function(e) {
            var getName = $(this).val();
            $.ajax({
                type: "POST",
                url: 'filter-emp.php', // Make sure this URL is correct
                data: {
                    name: getName
                },
                success: function(res) {
                    $("#showdata").html(res);
                }
            });
        });
    });
</script>
