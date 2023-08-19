<?php
require_once("../../../connect/connectDB.php");

if(isset($_POST["id"])){
    $id = $_POST["id"];
    execute("UPDATE tb_size SET deleted_size = 1 WHERE size_id = $id");
}

echo 'products/gallery.php';
?>