<?php
session_start();
require_once("../../connect/connectDB.php");
$from = $to = $error = '';

$users = executeResult("SELECT * FROM tb_user WHERE role = 2");

if (isset($_POST['from']) && isset($_POST['to'])) {
    $from = $_POST['from'];
    $to = $_POST['to'];

    // Perform any processing you need based on the salary range
    // For example, you could filter a database query

    // Simulating a response for demonstration purposes
    $response = "success"; // or some relevant data
    
    // Return the response back to the JavaScript
    echo $response;
} else {
    echo "Invalid data received.";
}
?>