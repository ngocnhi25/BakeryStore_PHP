<?php
require_once("../../../connect/connectDB.php");

if(isset($_POST["id"])){
    $id = $_POST["id"];
    execute("DELETE FROM tb_size WHERE size_id = $id");
}

echo 'products/gallery.php';
?>