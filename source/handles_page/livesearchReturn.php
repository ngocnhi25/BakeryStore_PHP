<?php
require_once("../connect/connectDB.php");

$input = $_POST['input'];
$query = "SELECT
    r.*,
    od.*,
    p.*,
    o.order_date
FROM
    tb_return r
INNER JOIN
    tb_order_detail od ON r.order_id = od.order_id
INNER JOIN
    tb_products p ON od.product_id = p.product_id
INNER JOIN
    tb_order o ON o.order_id = r.order_id
WHERE
    r.receiver_name LIKE :input
ORDER BY
    o.order_date DESC";

// Prepare and execute the query with a named parameter
$orders = executeResult($query, [':input' => '%' . $input . '%']);

// Initialize the output
$output = '';
$output .= '
<table>
    <thead>
        <tr>
            <th>Customer Name</th>
            <th>Reason for Return</th>
            <th>Customer Image</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>';
if ($orders && count($orders) > 0) {
    foreach ($orders as $order) {
        $output .= '
        <tr>
            <td>' . $order['receiver_name'] . '</td>
            <td>' . $order['reason'] . '</td>
            <td>
                <img src="../../public/images/' . $order['image_name'] . '" alt="" width="100px" style="border-radius: 10px;">
            </td>
            <td>
                <div id="confirmation-modal" class="">
                    <button class="confirm-return-btn"
                        data-order-id="' . $order['order_id'] . '">Confirm</button>
                    <button class="cancel-return-btn"
                        data-order-id="' . $order['order_id'] . '">Cancel</button>
                </div>
            </td>
        </tr>';
    }
} else {
    $output .= '<tr><td colspan="4">No record found</td></tr>';
}

$output .= '</tbody></table>';

echo $output;
?>
