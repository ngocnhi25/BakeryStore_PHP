<?php
session_start();
require_once("../../connect/connectDB.php");

if (isset($_SESSION["auth_user"])) {
    $user = $_SESSION["auth_user"];
    $token_ses_login = $user["token_login"];

    if ($user["role"] == 2 || $user["role"] == 3  || $user["role"] == 1 ) {
        $user_id = $user["user_id"];
        $sql = "SELECT status, token_login FROM tb_user WHERE user_id = $user_id";

        $sql_run = mysqli_query($conn, $sql);

        if (mysqli_num_rows($sql_run) > 0) {
            $row = mysqli_fetch_array($sql_run);
            $user_status = $row["status"];
            $token_data_login = $row["token_login"];

            if ($user_status != 1) {
                echo "failstatus";
            } elseif ($token_data_login !== $token_ses_login) {
                echo "failtoken";
            } else {
                echo "success"; // User status is 1 and tokens match
            }
        } else {
            echo "inactive"; // Return "inactive" if user not found in database
        }
    } else {
        echo "inactive"; // Return "inactive" if user role is not 2
    }
} else {
    echo "inactive"; // Return "inactive" if user is not authenticated
}

?>
