<?php
session_start();
require_once("../../../connect/connectDB.php");

$errorNum = 0;
$errors = $product_name = $qty_warehouse = $user_id = $qtyProduct = $content = '';

if (isset($_SESSION["auth_user"])) {
    $user_id = $_SESSION["auth_user"]["user_id"];
}

if(isset($_POST["id"])){
    $id = $_POST["id"];
    $product = executeSingleResult("SELECT product_name, qty_warehouse FROM tb_products where product_id = $id");
    $product_name = $product["product_name"];
    $qty_warehouse = $product["qty_warehouse"];
}

if(isset($_POST["qtyProduct"]) && !empty($_POST["qtyProduct"])){
    $qtyProduct = $_POST["qtyProduct"];
    if($qtyProduct <= 0 || $qtyProduct > 100){
        $errors = 'Product quantity must be greater than 0 and less than 100';
        $errorNum = 1;
    }
} else {
    $errors = "Product quantity cannot be blank";
    $errorNum = 1;
}

if($errorNum == 0){
    $success = execute("UPDATE tb_products SET deleted = 0, qty_warehouse = $qtyProduct WHERE product_id = $id");
    if($qty_warehouse == $qtyProduct) {
        $content = 'has updated the status for product ' . $product_name . ' to display';
    } else {
        $content = 'has updated the quantity to ' . $qtyProduct .' for product ' . $product_name;
    }
    if($success){
        historyOperation($user_id, $content);
    }
    echo 'success';
} else {
    echo $errors;
}

?>