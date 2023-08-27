<?php
require_once("../../../connect/connectDB.php");

$errorNum = $eventNum = 0;
$errors = [];
$errors["errorProductName"] = 
$errors["errorPercent"] = 
$errors["errorStartDateSale"] = 
$errors["errorEndDateSale"] = $product_id = '';

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
    if ($eventNum == 0) {
        $checkSaleProduct = checkRowTable("SELECT * FROM tb_sale WHERE product_id = $product_id and CURDATE() BETWEEN start_date AND end_date");
        if ($checkSaleProduct != 0) {
            $errors["errorProductName"] = 'The product is still on promotion';
            $errorNum = 1;
        }
    } else {
        $saleUpdate = executeSingleResult("SELECT * from tb_sale s INNER JOIN tb_products p ON s.product_id = p.product_id where s.sale_id = $id");
        if ($product_name != $saleUpdate["product_name"]) {
            $checkSaleProduct = checkRowTable("SELECT * FROM tb_sale WHERE product_id = $product_id and CURDATE() BETWEEN start_date AND end_date");
            if ($checkSaleProduct != 0) {
                $errors["errorProductName"] = 'The product is still on promotion';
                $errorNum = 1;
            }
        }
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
        } else {
            $checkSaleProduct = checkRowTable("SELECT * FROM tb_sale WHERE product_id = $product_id and '$startDate' BETWEEN start_date AND end_date");
            if ($checkSaleProduct != 0) {
                $errors["errorStartDateSale"] = date("m/d/Y", strtotime($startDate)) . ' products are on promotion';
                $errorNum = 1;
            }
        }
    } else {
        $checkSaleProduct = checkRowTable("SELECT * FROM tb_sale WHERE sale_id = $id and '$startDate' BETWEEN start_date AND end_date");

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
            $checkSaleProduct = checkRowTable("SELECT * FROM tb_sale WHERE product_id = $product_id and '$endDate' BETWEEN start_date AND end_date");
            if ($checkSaleProduct != 0) {
                $errors["errorEndDateSale"] = date("m/d/Y", strtotime($endDate)) . ' products are on promotion';
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
        execute("INSERT INTO tb_sale (product_id, percent_sale, start_date, end_date) 
        VALUES ($product_id, $percent, '$startDate', '$endDate')");
        echo 'success';
    } else {
        execute("UPDATE tb_sale SET 
        product_id = '$product_id', 
        percent_sale = $percent, 
        start_date = '$startDate', 
        end_date = '$endDate' 
        WHERE sale_id = $id");
        echo 'success';
    }
} else {
    echo json_encode($errors);
}
