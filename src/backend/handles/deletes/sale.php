<?php
session_start();
require_once("../../../connect/connectDB.php");

$user_id = '';

if (isset($_SESSION["auth_user"])) {
    $user_id = $_SESSION["auth_user"]["user_id"];
}

if(isset($_POST["id"])){
    $id = $_POST["id"];

    $sale = executeSingleResult("SELECT * from tb_sale where sale_id = $id");
    $product_id = $sale["product_id"];
    $product = executeSingleResult("SELECT product_name from tb_products where product_id = $product_id");

    $success = execute("DELETE FROM tb_sale WHERE sale_id = $id");

    if ($success) {
        $content = 'has deleted sale to product ' . $product["product_name"];
        historyOperation($user_id, $content);
    }
}

echo 'sale.php';
?>