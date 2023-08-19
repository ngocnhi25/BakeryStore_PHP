<?php
require_once("../connect/connectDB.php");

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Retrieve the order details from the database
    $orderDetails = executeSingleResult("SELECT * FROM tb_order WHERE order_id = $order_id");
    
    if ($orderDetails) {
        echo "<p><strong>Deposit:</strong> " . number_format($orderDetails['deposit'], 0, ',', '.') . " vnđ</p>";
        echo "<p><strong>Total Pay:</strong> " . number_format($orderDetails['total_pay'], 0, ',', '.') . " vnđ</p>";
        echo "<p><strong>Status:</strong> {$orderDetails['status']}</p>";

        // Retrieve the associated products for this order
        $products = $orderDetails['products'];
        echo $products;
        die();
        if ($products) {
            foreach ($products as $product) {
                echo "<p><strong>Product: </strong> " . $product['product'] . ", <strong>Quantity: </strong> " . $product['quantity'] . ", <strong>Flavor: </strong> " . $product['flavor'] . "</p>";
            }
        } else {
            echo "No products found for this order.";
        }
    } else {
        echo "Order not found.";
    }
} else {
    echo "Invalid request.";
}
?>
