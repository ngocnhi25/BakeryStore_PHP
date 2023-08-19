<?php
require_once('../../../connect/connectDB.php');

$errorNum = $eventNum = 0;
$errors = [];
$errors["errorCouponName"] =
    $errors["errorDiscount"] =
    $errors["errorStartDate"] =
    $errors["errorEndDate"] =
    $errors["errorCondition"] =
    $errors["errorQtiUsed"] =
    $errors["errorQtiCoupon"] = '';

date_default_timezone_set('Asia/Bangkok');
$date = date('Y-m-d');

if (isset($_POST["id"]) && !empty($_POST["id"])) {
    $id = $_POST["id"];
    $eventNum = 1;
}

// // coupon name
if (isset($_POST["codeCoupon"]) && !empty($_POST["codeCoupon"])) {
    $coupon_name = trim($_POST["codeCoupon"]);
    if ($eventNum == 0) {
        $couponName = checkRowTable("SELECT * FROM tb_coupon WHERE coupon_name = '$coupon_name'");
        if ($couponName != 0) {
            $errors["errorCouponName"] = 'Coupon code already exists';
            $errorNum = 1;
        } else {
            if (strpos($coupon_name, ' ')) {
                $errors["errorCouponName"] = 'Coupon code must be written without spaces';
                $errorNum = 1;
            } else {
                if (strlen($coupon_name) < 5 || strlen($coupon_name) > 100) {
                    $errors["errorCouponName"] = 'character length greater than 5 is less than 100';
                    $errorNum = 1;
                }
            }
        }
    } else {
        $nameUpdate = executeSingleResult("SELECT * FROM tb_coupon WHERE coupon_id = $id");
        if ($coupon_name != $nameUpdate["coupon_name"]) {
            $couponName = checkRowTable("SELECT * FROM tb_coupon WHERE coupon_name = '$coupon_name'");
            if ($couponName != 0) {
                $errors["errorCouponName"] = 'Coupon code already exists';
                $errorNum = 1;
            } else {
                if (strpos($coupon_name, ' ')) {
                    $errors["errorCouponName"] = 'Coupon code must be written without spaces';
                    $errorNum = 1;
                } else {
                    if (strlen($coupon_name) < 5 || strlen($coupon_name) > 100) {
                        $errors["errorCouponName"] = 'character length greater than 5 is less than 100';
                        $errorNum = 1;
                    }
                }
            }
        }
    }
} else {
    $errors["errorCouponName"] = "Coupon code cannot be blank";
    $errorNum = 1;
}

// discount
if (isset($_POST["discount"]) && !empty($_POST["discount"])) {
    $discount = $_POST["discount"];
    if ($discount < 1000 || $discount > 100000) {
        $errors["errorDiscount"] = 'Reduction amount must be greater than 1000 and less than 100000';
        $errorNum = 1;
    }
} else {
    $errors["errorDiscount"] = "Reduction amount cannot be left blank";
    $errorNum = 1;
}

// condition
if (isset($_POST["condition"]) && !empty($_POST["condition"])) {
    $condition = $_POST["condition"];
    if (isset($_POST["discount"]) && !empty($_POST["discount"])) {
        $discount = $_POST["discount"];
        if ($condition < ($discount * 5)) {
            $errors["errorCondition"] = 'Conditions for using the code must be 5 times the amount of the discount';
            $errorNum = 1;
        }
    }
} else {
    $errors["errorCondition"] = "Condition of using the code cannot be left blank";
    $errorNum = 1;
}

// quantity received
if (isset($_POST["qtiUsed"]) && !empty($_POST["qtiUsed"])) {
    $qtiUsed = $_POST["qtiUsed"];
    if ($qtiUsed <= 0) {
        $errors["errorQtiUsed"] = "The number of times the user uses it must be greater than 0";
        $errorNum = 1;
    }
} else {
    $errors["errorQtiUsed"] = "Number of times users use cannot be left blank";
    $errorNum = 1;
}

// quantity coupon
if (isset($_POST["qtiCoupon"]) && !empty($_POST["qtiCoupon"])) {
    $qtiCoupon = $_POST["qtiCoupon"];
    if ($qtiCoupon <= 0) {
        $errors["errorQtiCoupon"] = "Coupon number must be greater than 0";
        $errorNum = 1;
    }
} else {
    $errors["errorQtiCoupon"] = "Coupon number cannot be left blank";
    $errorNum = 1;
}

// start date
if (isset($_POST["startDate"]) && !empty($_POST["startDate"])) {
    $startDate = $_POST["startDate"];
    if ($eventNum == 0) {
        if ($startDate < $date) {
            $errors["errorStartDate"] = "The ad start date must be greater than or equal to the current date";
            $errorNum = 1;
        }
    }
} else {
    $errors["errorStartDate"] = "Start date cannot be left blank";
    $errorNum = 1;
}

// end date
if (isset($_POST["endDate"]) && !empty($_POST["endDate"])) {
    if ($startDate != null) {
        $endDate = $_POST["endDate"];
        if ($endDate <= $startDate) {
            $errors["errorEndDate"] = "Coupon end date must be greater than or equal to coupon start date";
            $errorNum = 1;
        }
    }
} else {
    $errors["errorEndDate"] = "End date cannot be left blank";
    $errorNum = 1;
}


if($errorNum == 0){
    if($eventNum == 0){
        echo "success insert";
    } else {
        echo "success update";
    }
} else {
    echo json_encode($errors);
}