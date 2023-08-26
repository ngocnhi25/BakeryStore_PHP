<?php
require_once("../connect/connectDB.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["order_id"]) && isset($_POST["new_status"])) {
        $order_id = $_POST["order_id"];
        $new_status = $_POST["new_status"];

        // Update the status in the database
        $sql = "UPDATE tb_order SET status = ? WHERE order_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $new_status, $order_id);

        if ($stmt->execute()) {
            if ($new_status === "completed") {
                // Delete the order from the database
                $delete_sql = "DELETE FROM tb_order WHERE order_id = ?";
                $delete_stmt = $conn->prepare($delete_sql);
                $delete_stmt->bind_param("i", $order_id);
                if ($delete_stmt->execute()) {
                    echo "Status updated to completed. Order deleted successfully.";
                } else {
                    echo "Error deleting order after status update.";
                }
                $delete_stmt->close();
            } elseif ($new_status === "cancelled") {
                // Get order details from tb_order_detail
                $order_detail_sql = "SELECT product_id, quantity FROM tb_order_detail WHERE order_id = ?";
                $order_detail_stmt = $conn->prepare($order_detail_sql);
                $order_detail_stmt->bind_param("i", $order_id);
                $order_detail_stmt->execute();
                $order_detail_result = $order_detail_stmt->get_result();

                // Update product quantities in tb_products
                while ($row = $order_detail_result->fetch_assoc()) {
                    $product_id = $row['product_id'];
                    $quantity = $row['quantity'];

                    // Update the quantity in tb_products
                    $update_product_sql = "UPDATE tb_products SET qty_warehouse = qty_warehouse + ? WHERE product_id = ?";
                    $update_product_stmt = $conn->prepare($update_product_sql);
                    $update_product_stmt->bind_param("ii", $quantity, $product_id);
                    $update_product_stmt->execute();
                }

                $update_product_stmt->close();
                $order_detail_stmt->close();

                echo "Status updated to cancelled. Product quantities updated.";
            } elseif ($new_status === "return") {
                // Get order details from tb_order_detail
                $order_detail_sql = "SELECT product_id, quantity FROM tb_order_detail WHERE order_id = ?";
                $order_detail_stmt = $conn->prepare($order_detail_sql);
                $order_detail_stmt->bind_param("i", $order_id);
                $order_detail_stmt->execute();
                $order_detail_result = $order_detail_stmt->get_result();

                // Update product quantities in tb_products
                while ($row = $order_detail_result->fetch_assoc()) {
                    $product_id = $row['product_id'];
                    $quantity = $row['quantity'];

                    // Update the quantity in tb_products
                    $update_product_sql = "UPDATE tb_products SET qty_warehouse = qty_warehouse + ? WHERE product_id = ?";
                    $update_product_stmt = $conn->prepare($update_product_sql);
                    $update_product_stmt->bind_param("ii", $quantity, $product_id);
                    $update_product_stmt->execute();
                }

                $update_product_stmt->close();
                $order_detail_stmt->close();

                echo "Status updated to cancelled. Product quantities updated.";
            } else {
                echo "Status updated successfully.";
            }
        } else {
            echo "Error updating status.";
        }

        $stmt->close();
    } else {
        echo "Invalid input data.";
    }
} else {
    echo "Invalid request method.";
}

?>