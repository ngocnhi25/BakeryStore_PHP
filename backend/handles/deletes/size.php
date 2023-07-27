<?php
require_once("../../../connect/connectDB.php");

if(isset($_POST["id"])){
    $id = $_POST["id"];
    execute("DELETE FROM tb_size WHERE size_id = $id");
    $size = executeSingleResult("SELECT * FROM tb_size WHERE size_id = $id");
    $sizeName = $size["size_name"];
    
    execute("DELETE FROM tb_product_size WHERE size = '$sizeName'");
}

echo 'products/flavor_and_size.php';
?>