<?php
require_once("../../../connect/connectDB.php");

$errorNum = $eventNum = 0;
$errors = [];
$errors["errorSize"] = '';

if (isset($_POST["name"]) && !empty($_POST["name"])) {
    $name = $_POST["name"];
    $eventNum = 1;
}

if (isset($_POST["size"]) && !empty($_POST["size"])) {
    $size_name = trim($_POST["size"]);
    $nameSize = checkRowTable("SELECT * FROM tb_size WHERE size_name = '$size_name'");
    if ($nameSize != 0) {
        $errors["errorSize"] = 'Size name already exists';
        $errorNum = 1;
    } 
} else {
    $errors["errorSize"] = 'Size cannot be empty';
    $errorNum = 1;
}


if ($errorNum == 0) {
    if ($eventNum == 0) {
        execute("INSERT INTO tb_size (size_name) VALUES ('$size_name')");
        echo 'success';
    } else {
        execute("UPDATE tb_size SET size_name = '$size_name' WHERE size_name = '$name'");
        execute("UPDATE tb_product_size SET size = '$size_name' WHERE size = '$name'");
        echo 'success';
    }
} else {
    echo json_encode($errors);
}
?>