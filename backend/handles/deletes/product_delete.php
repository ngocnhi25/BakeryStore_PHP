<?php 
require_once('../../../connect/connectDB.php');

if(isset($_POST['id'])){
    $id = $_POST['id'];

    execute("update tb_products set deleted = 1 where product_id = $id");
}

echo 'products/products.php';
?>