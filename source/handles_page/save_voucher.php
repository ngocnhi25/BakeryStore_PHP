<?php
session_start();
require_once("../connect/connectDB.php");

if (isset($_SESSION["auth_user"])) {
    $user_name = $_SESSION["auth_user"]["username"];
    $user_id = $_SESSION["auth_user"]["user_id"];
}

if(isset($_POST["codeVouvher"]) && !empty($_POST["codeVouvher"])){
    $codeVoucher = trim($_POST["codeVouvher"]);
    $voucher = executeSingleResult("SELECT * FROM tb_coupon where coupon_name = '$codeVoucher'");
    $coupon_id = $voucher["coupon_id"];

    execute("INSERT INTO tb_depot_coupon 
    (user_id, coupon_id, count_used) Values 
    ($user_id, $coupon_id, 0)");
}

?>