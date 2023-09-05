<?php
session_start();
require_once("../../../connect/connectDB.php");
if (isset($_SESSION["auth_user"])) {
    $user_id = $_SESSION["auth_user"]["user_id"];
}

$errorNum = $eventNum = 0;
$errors = [];
$errors["errorProductName"] =
    $errors["errorPercent"] =
    $errors["errorStartDateSale"] =
    $errors["errorEndDateSale"] = $product_id = $product_name = '';

date_default_timezone_set('Asia/Bangkok');
$date = date('Y-m-d');

if (isset($_POST["id"]) && !empty($_POST["id"])) {
    $id = $_POST["id"];
    $eventNum = 1;
}

if (isset($_POST["product_name"]) && !empty($_POST["product_name"])) {
    $product_name = trim($_POST["product_name"]);
    $product = executeSingleResult("SELECT * from tb_products where product_name = '$product_name'");
    $product_id = $product["product_id"];
    if ($product == null) {
        $errors["errorProductName"] = 'Please enter the product name';
        $errorNum = 1;
    }
} else {
    $errors["errorProductName"] = "Product name still on promotion can't be blank";
    $errorNum = 1;
}

if (isset($_POST["percent"]) && !empty($_POST["percent"])) {
    $percent = $_POST["percent"];
    if ($percent <= 0 || $percent > 100) {
        $errors["errorPercent"] = "Promotion percentage must be greater than 0 and less than 100";
        $errorNum = 1;
    }
} else {
    $errors["errorPercent"] = "Promotion percentage cannot be empty";
    $errorNum = 1;
}

// start date
if (isset($_POST["startDate"]) && !empty($_POST["startDate"])) {
    $startDate = $_POST["startDate"];
    if ($eventNum == 0) {
        if ($startDate < $date) {
            $errors["errorStartDateSale"] = "Sale start date must be greater than or equal to current date";
            $errorNum = 1;
        }
    }
} else {
    $errors["errorStartDateSale"] = "Start date cannot be left blank";
    $errorNum = 1;
}

// end date
if (isset($_POST["endDate"]) && !empty($_POST["endDate"])) {
    if ($startDate != null) {
        $endDate = $_POST["endDate"];

        if ($endDate <= $startDate) {
            $errors["errorEndDateSale"] = "Sale end date must be greater than or equal to sale start date";
            $errorNum = 1;
        } else {
            if ($eventNum == 0) {
                $sqlNotContain = "SELECT * FROM tb_sale 
                                    WHERE product_id = $product_id
                                    AND ((end_date BETWEEN '$startDate' AND '$endDate')
                                    OR (start_date BETWEEN '$startDate' AND '$endDate'))";
            } else {
                $sqlNotContain = "SELECT * FROM tb_sale 
                                    WHERE product_id = $product_id AND sale_id != $id
                                    AND ((end_date BETWEEN '$startDate' AND '$endDate')
                                    OR (start_date BETWEEN '$startDate' AND '$endDate'))";
            }
            $checkSaleProductNotContain = checkRowTable($sqlNotContain);

            if ($checkSaleProductNotContain != 0) {
                $errors["errorEndDateSale"] = 'Duplicate product discount end date';
                $errorNum = 1;
            }
            if ($checkSaleProductNotContain != 0) {
                $errors["errorStartDateSale"] = 'Duplicate product discount start date';
                $errorNum = 1;
            }
        }
    }
} else {
    $errors["errorEndDateSale"] = "End date cannot be left blank";
    $errorNum = 1;
}

if ($errorNum == 0) {
    if ($eventNum == 0) {
        $success = execute("INSERT INTO tb_sale (product_id, percent_sale, start_date, end_date) 
        VALUES ($product_id, $percent, '$startDate', '$endDate')");

        if($success){
            $content = 'has applied a discount to product' . $product_name;
            historyOperation($user_id, $content);
        }
        echo 'success';
    } else {
        $success = execute("UPDATE tb_sale SET 
        product_id = '$product_id', 
        percent_sale = $percent, 
        start_date = '$startDate', 
        end_date = '$endDate' 
        WHERE sale_id = $id");

        if($success){
            $content = 'has updated t he discount for product ' . $product_name;
            historyOperation($user_id, $content);
        }
        echo 'success';
    }
} else {
    echo json_encode($errors);
}
