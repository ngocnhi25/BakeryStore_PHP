<?php
require_once("../../../connect/connectDB.php");

if(isset($_POST["id"])){
    $id = $_POST["id"];

    $product = executeSingleResult("SELECT product_name from tb_products where product_id = $id");

    $success = execute("UPDATE tb_products SET deleted = 1 WHERE product_id = $id");

    if ($success) {
        $content = 'has temporarily suspended the operation of product ' . $product["product_name"];
        historyOperation($user_id, $content);
    }
}

echo 'products/products.php';
?>