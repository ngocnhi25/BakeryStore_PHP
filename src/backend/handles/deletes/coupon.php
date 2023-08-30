<?php
require_once("../../../connect/connectDB.php");

if(isset($_POST["id"])){
    $id = $_POST["id"];

    $coupon = executeSingleResult("SELECT coupon_name from tb_coupon where coupon_id = $id");

    $success = execute("DELETE FROM tb_coupon WHERE coupon_id = $id");

    if ($success) {
        $content = 'has deleted a voucher ' . $coupon["coupon_name"];
        historyOperation($user_id, $content);
    }
}

echo 'sale.php';
?>