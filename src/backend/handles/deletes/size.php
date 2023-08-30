<?php
require_once("../../../connect/connectDB.php");

if(isset($_POST["id"])){
    $id = $_POST["id"];

    $size = executeSingleResult("SELECT size_name from tb_size where size_id = $id");

    $success = execute("DELETE FROM tb_size WHERE size_id = $id");

    if ($success) {
        $content = 'has deleted a size ' . $size["size_name"];
        historyOperation($user_id, $content);
    }
}

echo 'products/gallery.php';
?>