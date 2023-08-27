<?php
require_once("../connect/connectDB.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["order_id"])) {
        $order_id = $_POST["order_id"];
        echo $order_id;
        die();
        // Delete the return request from the database
        $delete_sql = "DELETE FROM tb_return WHERE order_id = ?";
        $delete_stmt = $conn->prepare($delete_sql);
        $delete_stmt->bind_param("i", $order_id);

        if ($delete_stmt->execute()) {
            echo "Return request has been cancelled.";
        } else {
            echo "Error cancelling return request.";
        }

        $delete_stmt->close();
    } else {
        echo "Invalid input data.";
    }
} else {
    echo "Invalid request method.";
}
?>