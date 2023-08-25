<?php
require_once("../connect/connectDB.php");

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Retrieve the order details from the database
    $orderDetails = executeSingleResult("SELECT * FROM tb_order_detail WHERE order_id = $order_id");
    $statusResult = executeSingleResult("SELECT status FROM tb_order WHERE order_id = $order_id");

    echo "<table class='table-product'>";
    echo "<tr>
            <th>User ID</th>
            <th>Order ID</th>
            <th>Product ID</th>
            <th>Details</th>
            <th>Quantity</th>
            <th>Sale Product</th>
            <th>Total</th>
            <th>Status</th>
        </tr>";

    echo "<tr>
            <td>#{$orderDetails['user_id']}</td>
            <td>#{$orderDetails['order_id']}</td>
            <td>{$orderDetails['product_id']}</td>
            <td>
                Size: {$orderDetails['size']}<br>
                Flavor: {$orderDetails['flavor']}
            </td>
            <td>{$orderDetails['quantity']}</td>
            <td>{$orderDetails['sale_product']}</td>
            <td>{$orderDetails['total_money']}</td>
            <td>{$statusResult['status']}</td>
        </tr>";

    echo "</table>";
} else {
    echo "Invalid request.";
}
?>