<?php
session_start();
require_once("../connect/connectDB.php");

if(isset($_POST["product_id"])){
    $product_id = $_POST["product_id"];
    
    $product = executeSingleResult("SELECT * FROM tb_products WHERE product_id = $product_id");

    execute("INSERT INTO tb_cart () VALUES ()");
}


?>