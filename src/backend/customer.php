<?php
require_once('../connect/connectDB.php');

$users = executeResult("SELECT * FROM tb_user")
?>

<head>
    <link rel="stylesheet" href="css/table.css">
</head>
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
                    <th><input type="checkbox" name="" id=""> All</th>
                    <th>Customer</th>
                    <th>Email</th>
                    <th>Telephone</th>
                    <th>Create Date</th>
                    <th>Last login</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) {
                    if ($user["role"] == 1) { ?>
                        <tr>
                            <td><input type="checkbox" name="" id=""></td>
                            <td><?= $user["username"] ?></td>
                            <td><?= $user["email"] ?></td>
                            <td><?= $user["phone"] ?></td>
                            <td><?= $user["create_date"] ?></td>
                            <td><?= $user["login_date"] ?></td>
                        </tr>
                <?php }
                } ?>
            </tbody>
        </table>
    </div>
</div>