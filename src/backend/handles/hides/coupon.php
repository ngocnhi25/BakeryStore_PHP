<?php
session_start();
require_once("../../../connect/connectDB.php");

$user_id = '';

if (isset($_SESSION["auth_user"])) {
    $user_id = $_SESSION["auth_user"]["user_id"];
}

if(isset($_POST["id"])){
    $id = $_POST["id"];

    $coupon = executeSingleResult("SELECT coupon_name from tb_coupon where coupon_id = $id");

    $success = execute("UPDATE tb_coupon SET status = 1 WHERE coupon_id = $id");

    if ($success) {
        $content = 'has temporarily suspended the operation of voucher code ' . $coupon["coupon_name"];
        historyOperation($user_id, $content);
    }
}

echo 'sale.php';
?>