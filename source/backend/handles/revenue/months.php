<?php 
require_once('../../../connect/connectDB.php');

$allMonthsData = executeResult("SELECT DATE_FORMAT(order_date, '%M') AS month , SUM(total_pay) AS income FROM tb_order Where status = 'completed' GROUP BY MONTH(order_date)");

// Trả về dữ liệu dưới dạng JSON
header("Content-type: application/json");
echo json_encode($allMonthsData);
?>