<?php
require_once("../../../connect/connectDB.php");

$errorNum = 0;
$errors = '';

if(isset($_POST["id"])){
    $id = $_POST["id"];
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
    execute("UPDATE tb_products SET deleted = 0, qty_warehouse = $qtyProduct WHERE product_id = $id");
    echo 'success';
} else {
    echo $errors;
}

?>