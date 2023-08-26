<?php
require_once('../../connect/connectDB.php'); // Adjust the path to your connection file

if (isset($_POST['from']) && isset($_POST['to'])) {
    $from = $_POST['from'];
    $to = $_POST['to'];

    if ($from === "" && $to === "") {
        // Show all data if both from and to are empty
        $sql = "SELECT * FROM tb_user WHERE role = 2";
    } else {
        // Filter based on salary range
        $sql = "SELECT * FROM tb_user WHERE role = 2 AND salary >= $from AND salary <= $to";
    }

    $users = executeResult($sql);

    foreach ($users as $user) {
        echo "<tr>
            <td>{$user['user_id']}</td>
            <td>{$user['username']}</td>
            <td>{$user['email']}</td>
            <td>{$user['phone']}</td>
            <td>{$user['salary']}</td>
            <td>{$user['create_date']}</td>
            <td>";
        if ($user['role'] == 2 && $user['status'] == 1) {
            echo "<button id='deactivateButton{$user['user_id']}' onclick='deactivateUser({$user['user_id']})' style='background-color: greenyellow;'>Activate</button>";
        } else {
            echo "<button id='deactivateButton{$user['user_id']}' onclick='ActivateUser({$user['user_id']})' style='background-color: gray;'>Deactivate</button>";
        }
        echo "</td>
            </tr>";
    }
}
?>
