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
    $couponUsed = checkRowTable("SELECT * FROM tb_coupon c 
                                INNER JOIN tb_depot_coupon dc ON c.coupon_id = dc.coupon_id
                                WHERE dc.coupon_id = $id");
    if($couponUsed == 0){
        $success = execute("DELETE FROM tb_coupon WHERE coupon_id = $id");
    
        if ($success) {
            $content = 'has deleted a voucher ' . $coupon["coupon_name"];
            historyOperation($user_id, $content);
            echo "success";
        }
    } else {
        echo "doNotDelete";
    }

}
?>