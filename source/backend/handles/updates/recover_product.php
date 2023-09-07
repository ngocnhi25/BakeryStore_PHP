<?php
session_start();
require_once("../../../connect/connectDB.php");

$user_id = '';

if (isset($_SESSION["auth_user"])) {
    $user_id = $_SESSION["auth_user"]["user_id"];
}

if(isset($_POST["id"])){
    $id = $_POST["id"];

    $product = executeSingleResult("SELECT product_name from tb_products where product_id = $id");

    $success = execute("UPDATE tb_products SET deleted = 0 WHERE product_id = $id");

    if ($success) {
        $content = 'has updated product ' . $product["product_name"] . ' to working status';
        historyOperation($user_id, $content);
    }
}

echo 'products/products.php';
?>