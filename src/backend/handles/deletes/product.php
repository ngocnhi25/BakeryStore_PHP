<?php
require_once('../../../connect/connectDB.php');

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $thumbnails = executeResult("SELECT * FROM tb_thumbnail WHERE product_id = $id");
    $product = executeSingleResult("SELECT * FROM tb_products WHERE product_id = $id");

    $imagesDelete[0] = $product["image"];
    foreach ($thumbnails as $key => $thumb) {
        $imagesDelete[$key + 1] = $thumb["thumbnail"];
    }
    foreach ($imagesDelete as $key => $imgDelete) {
        unlink('../../../../' . $imgDelete);
    }
    execute("DELETE FROM tb_thumbnail WHERE product_id = $id");
    $success = execute("DELETE FROM tb_products WHERE product_id = $id");

    if ($success) {
        $content = 'has deleted a product ' . $product["product_name"];
        historyOperation($user_id, $content);
    }
}

echo 'products/products.php';
