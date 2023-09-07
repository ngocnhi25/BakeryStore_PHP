<?php
session_start();
require_once("../../../connect/connectDB.php");

$content = $user_id = $size_name = '';

if (isset($_SESSION["auth_user"])) {
    $user_id = $_SESSION["auth_user"]["user_id"];
}

if(isset($_POST["id"])){
    $id = $_POST["id"];
    $size = executeSingleResult("SELECT * FROM tb_size where size_id = $id");
    $size_name = $size["size_name"];

    $success = execute("UPDATE tb_size SET deleted_size = 0 WHERE size_id = $id");

    if($success){
        $content = 'has updated the status for size ' . $size_name . ' to display';
        historyOperation($user_id, $content);
    }
}

echo 'products/gallery.php';
?>