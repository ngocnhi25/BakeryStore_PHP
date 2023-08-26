<?php
session_start();
require_once("../../connect/connectDB.php");
$name = $_POST["query"]; // Assuming your AJAX sends "query" as POST data

$sql = "SELECT * FROM tb_user WHERE  username LIKE '%$name%'";
$sql_run = mysqli_query($conn, $sql);
$data = ""; // Initialize the variable to store data
while ($row = mysqli_fetch_assoc($sql_run)){
    $data .= "<tr>
    <td>" . $row["user_id"] . "</td>
    <td>" . $row["username"] . "</td>
    <td>" . $row["email"] . "</td>
    <td>" . $row["phone"] . "</td>
    <td>" . $row["sex"] . "</td>
    <td>" . $row["birthday"] . "</td>
    <td>" . $row["create_date"] . "</td>
    <td>";
    if ($row["role"] == 1 && $row["status"] == 1) {
        $data .= '<button id="deactivateButton' . $row["user_id"] . '" onclick="deactivateUser(' . $row["user_id"] . ')" style="background-color: greenyellow;">Activate</button>';
    } else {
        $data .= '<button id="deactivateButton' . $row["user_id"] . '" onclick="activateUser(' . $row["user_id"] . ')" style="background-color: gray;">Deactivate</button>';
    }
    $data .= '</td>
    <td> <button>Update</button></td>
</tr>';
}
echo $data; // Output the accumulated data
?>


