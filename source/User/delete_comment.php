<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
require_once("../connect/connectDB.php");

if (isset($_GET['code'])) {
    $code = $_GET['code'];
    $sql = "DELETE  FROM tb_comments WHERE comment_id = '$code'";
    
    // Assuming that execute() is a function you've defined to execute SQL queries
    $sql_run = execute($sql);

    if ($sql_run) {
        echo 'success';
    } else {
        echo 'fail';
    }
}


?>
