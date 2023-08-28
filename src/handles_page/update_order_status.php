<?php
require_once("../connect/connectDB.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["order_id"]) && isset($_POST["new_status"])) {
        $order_id = $_POST["order_id"];
        $new_status = $_POST["new_status"];

       
        if ($new_status === "completed") {
            $message = updateStatusToCompleted($order_id);
        } elseif ($new_status === "cancelled" || $new_status === "return") {
            $message = updateStatusToCancelledOrReturned($order_id, $new_status);
        } elseif ($new_status === "pending") {
            $message = updateStatusToPending($order_id);
        } else {
            $message = "Invalid status update.";
        }

        echo $message;
    } else {
        echo "Invalid input data.";
    }
} else {
    echo "Invalid request method.";
}

function updateStatusToCompleted($order_id)
{
    $sql = "DELETE FROM tb_order WHERE order_id = $order_id";
    if (execute($sql)) {
        $message = "Status updated to completed. Order deleted successfully.";
    } else {
        $message = "Error deleting order after status update.";
    }
    return $message;
}

function updateStatusToCancelledOrReturned($order_id, $new_status)
{
    $order_detail_sql = "SELECT product_id, quantity FROM tb_order_detail WHERE order_id = $order_id";
    $order_details = executeResult($order_detail_sql);

    foreach ($order_details as $order_detail) {
        $product_id = $order_detail['product_id'];
        $quantity = $order_detail['quantity'];

        $update_product_sql = "UPDATE tb_products SET qty_warehouse = qty_warehouse + $quantity WHERE product_id = $product_id";
        execute($update_product_sql);
    }

    if ($new_status === "return" && isset($_POST["reason"]) && isset($_FILES["image"])) {
        $message = processReturnRequest($order_id);
    } else {
        $message = "Status updated to cancelled. Product quantities updated.";
    }

    return $message;
}

function updateStatusToPending($order_id)
{
    $sql = "UPDATE tb_order SET status = 'pending' WHERE order_id = $order_id";
    if (execute($sql)) {
        $message = "Status updated to pending.";
    } else {
        $message = "Error updating order status to pending.";
    }
    return $message;
}

function processReturnRequest($order_id)
{
    $reason = $_POST["reason"];
    $image = "public/images/returnImg/" . $_FILES["image"]["name"];

    $update_order_sql = "UPDATE tb_order SET status = 'return' WHERE order_id = $order_id";
    if (execute($update_order_sql)) {
        $order_detail_sql = "SELECT product_id FROM tb_order_detail WHERE order_id = $order_id";
        $order_details = executeResult($order_detail_sql);

        foreach ($order_details as $order_detail) {
            $product_id = $order_detail['product_id'];

            $insert_return_sql = "INSERT INTO tb_return (order_id, reason, customer_image, product_id) VALUES ($order_id, '$reason', '$image', $product_id)";
            if (!execute($insert_return_sql)) {
                $message = "Error inserting return data.";
                break;
            }
        }

        $message = "Order returned successfully.";
    } else {
        $message = "Error updating order status.";
    }

    return $message;
}
?>