<?php
require_once("../../../connect/connectDB.php");

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