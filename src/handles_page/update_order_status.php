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
