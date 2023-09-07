<?php
session_start();
require_once("../../../connect/connectDB.php");

$user_id = '';

if (isset($_SESSION["auth_user"])) {
    $user_id = $_SESSION["auth_user"]["user_id"];
}

if(isset($_POST["id"])){
    $id = $_POST["id"];

    $size = executeSingleResult("SELECT size_name from tb_size where size_id = $id");

    $success = execute("UPDATE tb_size SET deleted_size = 1 WHERE size_id = $id");

    if ($success) {
        $content = 'has temporarily suspended the operation of size ' . $size["size_name"];
        historyOperation($user_id, $content);
    }
}

echo 'products/gallery.php';
?>