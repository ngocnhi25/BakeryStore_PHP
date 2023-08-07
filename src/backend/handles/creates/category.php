<?php
require_once("../../../connect/connectDB.php");

$errorNum = $eventNum = 0;
$errors = [];
$errors["errorCateName"] = '';

if (isset($_POST["id"]) && !empty($_POST["id"])) {
    $id = $_POST["id"];
    $eventNum = 1;
}

if (isset($_POST["cateName"]) && !empty($_POST["cateName"])) {
    $cate_name = trim($_POST["cateName"]);
    $cates = checkRowTable("SELECT * FROM tb_category WHERE cate_name = '$cate_name'");
    if ($cates != 0) {
        $errors["errorCateName"] = 'Category name already exists';
        $errorNum = 1;
    } else {
        if (strlen($cate_name) <= 3) {
            $errors["errorCateName"] = 'Product name must be more than 3 characters';
            $errorNum = 1;
        }
    }
} else {
    $errors["errorCateName"] = 'Product category cannot be empty';
    $errorNum = 1;
}

if ($errorNum == 0) {
    if ($eventNum == 0) {
        execute("INSERT INTO tb_category (cate_name) VALUES ('$cate_name')");
        echo 'success';
    } else {
        execute("UPDATE tb_category SET cate_name = '$cate_name' WHERE cate_id = $id");
        echo 'success';
    }
} else {
    echo json_encode($errors);
}
