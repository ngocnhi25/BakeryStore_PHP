<?php
require_once "../connect/connectDB.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["order_id"]) && isset($_POST["new_status"])) {
        $order_id = $_POST["order_id"];
        $new_status = $_POST["new_status"];

        if ($new_status === "cancelled") {
            $message = updateStatusToCancelled($order_id);
        } elseif ($new_status === "return") {
            $message = updateStatusToReturn($order_id);
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

function updateStatusToCancelled($order_id)
{
    // Thực hiện truy vấn để cập nhật trạng thái đơn hàng thành "cancelled"
    $sql = "UPDATE tb_order SET status = 'cancelled' WHERE order_id = $order_id";

    // Gọi hàm execute để thực hiện truy vấn
    if (execute($sql)) {
        $deletedSQL = "DELETE FROM tb_cancelled WHERE order_id = $order_id";
        if (execute($deletedSQL)) {
            return "Order status updated to cancelled.";
        }

    } else {
        return "Error updating order status to cancelled.";
    }
}

function updateStatusToReturn($order_id)
{
    // Thực hiện truy vấn để cập nhật trạng thái đơn hàng thành "return"
    $sql = "UPDATE tb_order SET status = 'return' WHERE order_id = $order_id";

    if (execute($sql)) {
        $deletedSQL = "DELETE FROM tb_return WHERE order_id = $order_id";
        if (execute($deletedSQL)) {
            return "Order status updated to return.";
        }

    } else {
        return "Error updating order status to return.";
    }
}
