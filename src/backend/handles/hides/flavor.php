<?php
require_once("../../../connect/connectDB.php");

if(isset($_POST["id"])){
    $id = $_POST["id"];
    execute("UPDATE tb_flavor SET deleted_flavor = 1 WHERE flavor_id = $id");
}

echo 'products/gallery.php';
?>