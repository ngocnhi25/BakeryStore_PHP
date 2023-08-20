<?php

session_start();

$response = array();

if (isset($_SESSION["auth_user"])) {
    $user_id = $_SESSION["auth_user"]["user_id"];
    $response["status"] = "success";
    $response["user_id"] = $user_id;
} else {
    $response["status"] = "error";
}
?>