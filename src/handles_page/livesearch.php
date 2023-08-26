<?php
require_once("../connect/connectDB.php");

$input = $_POST['input'];
$orders = executeResult("SELECT *
                  FROM tb_order
                  WHERE order_id LIKE '%$input%' OR receiver_name LIKE '%$input%'");

// Initialize the output
$output = '';
$output = '
<table>
    <thead>
        <tr>
            <th>Order ID</th>
            <th>User ID</th>
            <th>Customer Name</th>
            <th>Contact Information</th>
            <th>Order Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>';
if ($orders && count($orders) > 0) {
    foreach ($orders as $order) {
        $output .= '
        <tr>
            <td>#' . $order['order_id'] . '
                <input type="hidden" class="order-id" value="' . $order['order_id'] . '">
            </td>
            <td>#' . $order['user_id'] . '
                <input type="hidden" class="user_id" value="' . $order['user_id'] . '">
            </td>
            <td>' . $order['receiver_name'] . '</td>
            <td>
                <p><strong>Phone:</strong> ' . $order['receiver_phone'] . '</p>
                <p><strong>Address:</strong> ' . $order['receiver_address'] . '</p>
            </td>
            <td>' . $order['order_date'] . '</td>
            <td>
                <button class="view-btn" data-order-id="' . $order['order_id'] . '">View</button>
            </td>
        </tr>';
    }
} else {
    $output .= '<tr><td colspan="6">No record found</td></tr>';
}


echo $output;