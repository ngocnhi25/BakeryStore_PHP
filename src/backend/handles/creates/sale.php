<?php
require_once('../../../connect/connectDB.php');

if (isset($_POST["coupon_name"]) && isset($_POST["discount"]) && isset($_POST["startDate"]) && isset($_POST["endDate"])) {
    $coupname = trim($_POST["coupon_name"]);
    $discount = floatval($_POST["discount"]); // Convert to a float number
    $startDate = DateTime::createFromFormat('Y-m-d', $_POST["startDate"]);
    $endDate = DateTime::createFromFormat('Y-m-d', $_POST["endDate"]);

    // Validate coupon name: Ensure it is not empty
    if (empty($coupname)) {
        echo "Error: Coupon name is required.";
        exit();
    }

    // Validate discount: Ensure it is a valid number
    if (!is_numeric($discount) || $discount <= 0 || $discount > 100) {
        echo "Error: Invalid discount. Please enter a number between 0 and 100.";
        exit();
    }

    // Validate dates: Ensure the start date is not later than the end date
    if ($startDate > $endDate) {
        echo "Error: Start date cannot be later than end date.";
        exit();
    }

    // Create a database connection (assuming you have a connection object named $conn)
    // Replace 'column_name_1', 'column_name_2', etc. with the actual column names in your 'tb_sale' table
    $stmt = $conn->prepare("INSERT INTO tb_sale (discount, start_date, end_date, coupon_name) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("dsss", $discount, $startDate->format('Y-m-d'), $endDate->format('Y-m-d'), $coupname);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "Error inserting coupon information: " . $stmt->error;
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
} else {
    echo "Error: All fields are required.";
}
?>
