<?php
require_once("../connect/connectDB.php");
// Get orders
$orders = executeResult("SELECT * FROM tb_order");

// Build the HTML structure
$html = '
<table>
    <thead>
        <tr>
            <th>Customer Name</th>
            <th>Contact Information</th>
            <th>Order Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>';

if ($orders && count($orders) > 0) {
    foreach ($orders as $order) {
        $html .= '
        <tr>
            <td>' . $order['receiver_name'] . '</td>
            <td>
                <p><strong>Phone:</strong> ' . $order['receiver_phone'] . '</p>
                <p><strong>Address:</strong> ' . $order['receiver_address'] . '</p>
            </td>
            <td>' . $order['order_date'] . '</td>
            <td>' . $order['status'] . '</td>
            <td>
                <button class="view-btn" data-order-id="' . $order['order_id'] . '">View</button>
            </td>
        </tr>';
    }
} else {
    $html .= '<tr><td colspan="6">No record found</td></tr>';
}

$html .= '
    </tbody>
</table>';

echo $html;
?>
