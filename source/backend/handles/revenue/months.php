<?php 
require_once('../../../connect/connectDB.php');

$allMonthsData = executeResult("SELECT DATE_FORMAT(date_pay, '%M') AS month , SUM(income) AS income, SUM(expense) AS expense FROM tb_revenues GROUP BY MONTH(date_pay)");

// Trả về dữ liệu dưới dạng JSON
header("Content-type: application/json");
echo json_encode($allMonthsData);
?>