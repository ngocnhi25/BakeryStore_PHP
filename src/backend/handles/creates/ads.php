<?php
require_once("../../../connect/connectDB.php");

$errors["errorTypeAds"] =
    $errors["errorDate"] =
    $errors["errorImages"] =
    '';
$errorNum = 0;

date_default_timezone_set('Asia/Bangkok');
$date = date('Y-m-d');

$target_dir = "public/images/banners/";
$type_allow = ['image/png', 'image/jpeg', 'image/gif', 'image/jpg'];
$size_allow = 3;

if (isset($_POST["typeAds"]) && !empty($_POST["typeAds"])) {
    $typeAds = $_POST["typeAds"];
    if($typeAds == 'category'){
        if ($_POST["cateID"]) {
            $cateID = $_POST["cateID"];
            $ads = checkRowTable("SELECT * FROM tb_ads Where cate_id = $cateID");

            if ($ads != 0) {
                $errors["errorTypeAds"] = 'This category is advertising';
                $errorNum = 1;
            }
        } else {
            $errors["errorTypeAds"] = "Type advertising cannot be blank";
            $errorNum = 1;
        }
    } elseif ($typeAds == 'product'){
        if ($_POST["productID"]) {
            $productID = $_POST["productID"];
            $ads = checkRowTable("SELECT * FROM tb_ads Where product_id = $productID");

            if ($ads != 0) {
                $errors["errorTypeAds"] = 'This category is advertising';
                $errorNum = 1;
            }
        } else {
            $errors["errorTypeAds"] = "Type advertising cannot be blank";
            $errorNum = 1;
        }
    }
} else {
    $errors["errorTypeAds"] = "Type advertising cannot be blank";
    $errorNum = 1;
}

if (isset($_POST["startDate"]) && !empty($_POST["startDate"])) {
    $startDate = $_POST["startDate"];
    if($startDate < $date ){
        $errors["errorDate"] = "The ad start date must be greater than or equal to the current date";
        $errorNum = 1;
    }
    if (isset($_POST["endDate"]) && !empty($_POST["endDate"])) {
        $endDate = $_POST["endDate"];
        if($endDate <= $startDate ){
            $errors["errorDate"] = "The ad end date must be greater than or equal to the ad start date";
            $errorNum = 1;
        }
    } else {
        $errors["errorDate"] = "Advertisement end date cannot be blank";
        $errorNum = 1;
    }
} else {
    $errors["errorDate"] = "Advertisement start date cannot be blank";
    $errorNum = 1;
}

if (isset($_FILES["imageAds"]["name"])) {
    $files = $_FILES['imageAds'];
    $imagesType = $files['type'];
    $imagesSize = $files['size'] / 1024 / 1024;
    $image = $target_dir . basename($files['name']);
    $imagesLink = "../../../../$target_dir" . basename($files['name']);

    if (!file_exists($imagesLink)) {
        if (in_array($imagesType, $type_allow)) {
            if ($imagesSize <= $size_allow) {
                $uploads_tmp_name = $files["tmp_name"];
                $uploads_imagesLink = $imagesLink;
            } else {
                $errors["errorImages"] = 'file ' . $files["name"] . ' capacity must be less than ' . $size_allow . 'MB ';
                $errorNum = 1;
            }
        } else {
            $errors["errorImages"] = 'file ' . $files["name"] . ' format error';
            $errorNum = 1;
        }
    } else {
        $errors["errorImages"] = 'file ' . $files["name"] . ' already exists in the directory';
        $errorNum = 1;
    }
} else {
    $errors["errorImages"] = "Product images cannot be blank";
    $errorNum = 1;
}


if (
    $errorNum == 0
) {
    if($typeAds == 'category'){
        execute("INSERT INTO tb_ads (type_ads, image_ads, start_date, end_date, cate_id) 
        VALUES ('$typeAds', '$image', '$startDate', '$endDate', $cateID)");
    } elseif($typeAds == 'product'){
        execute("INSERT INTO tb_ads (type_ads, image_ads, start_date, end_date, product_id) 
        VALUES ('$typeAds', '$image', '$startDate', '$endDate', $productID)");
    } else {
        execute("INSERT INTO tb_ads (type_ads, image_ads, start_date, end_date) 
        VALUES ('$typeAds', '$image', '$startDate', '$endDate')");
    }
    move_uploaded_file($uploads_tmp_name, $uploads_imagesLink);
    echo 'success';
} else {
    echo json_encode($errors);
}
