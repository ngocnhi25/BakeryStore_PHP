<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
require_once("../connect/connectDB.php");

if (isset($_GET['code'])) {
    $code = $_GET['code'];
    $sql = "UPDATE tb_user SET status = 0 WHERE user_id = '$code'";
    
    // Assuming that execute() is a function you've defined to execute SQL queries
    $sql_run = execute($sql);

    if ($sql_run) {
        echo 'success';
    } else {
        echo 'fail';
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "UPDATE tb_user SET status = 1 WHERE user_id = '$id'";
    
    // Assuming that execute() is a function you've defined to execute SQL queries
    $sql_run = execute($sql);

    if ($sql_run) {
        echo 'success';
    } else {
        echo 'fail';
    }
}
?>
