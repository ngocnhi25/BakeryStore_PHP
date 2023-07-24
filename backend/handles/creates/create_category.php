<?php 
require_once("../../../connect/connectDB.php");

$errorNum = 0;
$errors = $flavorName = $flavorIncrease = $sizeName = $sizeIncrease = [];
$errors["cateName"] =
$errors["flavors"] =
$errors["sizes"] =
 '';

if(isset($_POST["name"]) && !empty($_POST["name"])){
    $name = trim($_POST["name"]);
    $cates = checkRowTable("SELECT * FROM tb_category WHERE cate_name = '$name'");
    if ($cates != 0) {
        $errors["cateName"] = 'Category name already exists';
        $errorNum = 1;
    } else {
        if (strlen($name) <= 3) {
            $errors["cateName"] = 'Product name must be more than 3 characters';
            $errorNum = 1;
        }
    }
} else {
    $errors["cateName"] = 'Product category cannot be empty';
    $errorNum = 1;
}

if(isset($_POST["flavors"]) && isset($_POST["flavor_increase"])){
    $flavors = $_POST["flavors"];
    $flavor_increase = $_POST["flavor_increase"];
    foreach($flavors as $key => $flavor){
        if($flavor_increase[$key] == null){
            $errors["flavors"] = "Do not leave the box you selected blank";
            $errorNum = 1;
        } elseif ($flavor_increase[$key] < 0){
            $errors["flavors"] = "Price increase must be greater than or equal to 0";
            $errorNum = 1;
        } else {
            $flavorName[$key] = $flavor;
            $flavorIncrease[$key] = $flavor_increase[$key];
            $errorNum = 0;
        }
    }
} else {
    $errors["flavors"] = "Add at least one cake flavor";
    $errorNum = 1;
}

if(isset($_POST["sizes"]) && isset($_POST["size_increase"])){
    $sizes = $_POST["sizes"];
    $size_increase = $_POST["size_increase"];
    foreach($sizes as $key => $size){
        if($size_increase[$key] == null){
            $errors["sizes"] = "Do not leave the box you selected blank";
            $errorNum = 1;
        } elseif ($size_increase[$key] < 0){
            $errors["sizes"] = "Price increase must be greater than or equal to 0";
            $errorNum = 1;
        } else {
            $sizeName[$key] = $size;
            $sizeIncrease[$key] = $size_increase[$key];
            $errorNum = 0;
        }
    }
} else {
    $errors["sizes"] = "Add at least one cake size";
    $errorNum = 1;
}

if($errorNum == 0){
    echo "success";
} else {
    echo json_encode($errors);
}

?>