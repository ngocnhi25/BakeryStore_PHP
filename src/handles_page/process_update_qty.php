<?php
require_once('../connect/connectDB.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $new_qty = $_POST['new_qty'];

    // Validate input (you might want to perform additional validation here)
    if (!is_numeric($product_id) || !is_numeric($new_qty)) {
        echo "error";
        exit();
    }

    // Update product quantity in tb_warehouse using prepared statement
    $updateQty = execute("UPDATE tb_warehouse SET product_qty = $new_qty WHERE product_id = $product_id");

    if ($updateQty) {
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "error";
}
?>