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
                                <button>Deactive</button>
                                <button>Send Mail </button>
                            </td>

                        </tr>
                <?php }
                } ?>
            </tbody>
        </table>
    </div>
</div>