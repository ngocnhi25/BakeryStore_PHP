<?php
require_once("../../../connect/connectDB.php");

if(isset($_POST["id"])){
    $id = $_POST["id"];
    execute("UPDATE tb_products SET deleted = 1 WHERE product_id = $id");
}

echo 'products/products.php';
?>