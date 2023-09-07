<?php
require_once("../connect/connectDB.php");

// Get orders
$orders = executeResult("SELECT
    *
FROM
    tb_return r
INNER JOIN
    tb_order_detail od ON r.order_id = od.order_id
INNER JOIN
    tb_products p ON od.product_id = p.product_id
INNER JOIN
    tb_order o ON o.order_id = r.order_id
ORDER BY
    o.order_date DESC");

// Build the HTML structure
$html = '
<table class="table-product">
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
        $html .= '
        <tr>
            <td>' . htmlspecialchars($order['receiver_name']) . '</td>
            <td>' . htmlspecialchars($order['reason']) . '</td>
            <td>
                <img src="../../public/images/' . htmlspecialchars($order['image_name']) . '" alt="" width="100px" style="border-radius: 10px;">
            </td>
            <td>
                <div id="confirmation-modal" class="">
                    <button id="confirm-return-btn"
                        data-order-id="' . htmlspecialchars($order['order_id']) . '">Confirm</button>
                    <button id="cancel-return-btn"
                        data-order-id="' . htmlspecialchars($order['order_id']) . '">Cancel</button>
                </div>
            </td>
        </tr>';
    }
} else {
    $html .= '<tr><td colspan="4">No record found</td></tr>';
}

$html .= '
    </tbody>
</table>';

echo $html;
?>
