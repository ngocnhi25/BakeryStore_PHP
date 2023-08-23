<?php
require_once("../../../connect/connectDB.php");

$errors["errorTypeAds"] =
    $errors["errorDate"] =
    $errors["errorImages"] =
    '';
$errorNum = $eventNum = 0;

date_default_timezone_set('Asia/Bangkok');
$date = date('Y-m-d');

$target_dir = "public/images/banners/";
$type_allow = ['image/png', 'image/jpeg', 'image/gif', 'image/jpg'];
$size_allow = 3;

if (isset($_POST["ads_id"]) && !empty($_POST["ads_id"])) {
    $id = $_POST["ads_id"];
    echo $id;
    $eventNum = 1;
}

if (isset($_POST["typeAds"]) && !empty($_POST["typeAds"])) {
    $typeAds = $_POST["typeAds"];
    if ($typeAds == 'category') {
        if (isset($_POST["cateID"]) && !empty($_POST["cateID"])) {
            $cateID = $_POST["cateID"];
            if ($eventNum == 0) {
                $checkAdsCate = checkRowTable("SELECT * FROM tb_ads Where cate_id = $cateID and CURDATE() BETWEEN start_date AND end_date");
                if ($checkAdsCate != 0) {
                    $errors["errorTypeAds"] = 'This category is being advertised';
                    $errorNum = 1;
                }
            } else {
                $adsCateUpdate = executeSingleResult("SELECT * FROM tb_ads Where ads_id = $id");
                if ($cateID != $adsCateUpdate["cate_id"]) {
                    $checkAdsCate = checkRowTable("SELECT * FROM tb_ads Where cate_id = $cateID and CURDATE() BETWEEN start_date AND end_date");
                    if ($checkAdsCate != 0) {
                        $errors["errorTypeAds"] = 'This category is being advertised';
                        $errorNum = 1;
                    }
                }
            }
        } else {
            $errors["errorTypeAds"] = "Type advertising cannot be blank";
            $errorNum = 1;
        }
    } elseif ($typeAds == 'product') {
        if (isset($_POST["productID"]) && !empty($_POST["productID"])) {
            $productID = $_POST["productID"];
            if ($eventNum == 0) {
                $checkAdsProduct = checkRowTable("SELECT * FROM tb_ads Where cate_id = $productID and CURDATE() BETWEEN start_date AND end_date");
                if ($checkAdsProduct != 0) {
                    $errors["errorTypeAds"] = 'This product is being advertised';
                    $errorNum = 1;
                }
            } else {
                $adsCateUpdate = executeSingleResult("SELECT * FROM tb_ads Where ads_id = $id");
                if ($productID != $adsCateUpdate["product_id"]) {
                    $checkAdsProduct = checkRowTable("SELECT * FROM tb_ads Where product_id = $productID and CURDATE() BETWEEN start_date AND end_date");
                    if ($checkAdsProduct != 0) {
                        $errors["errorTypeAds"] = 'This product is being advertised';
                        $errorNum = 1;
                    }
                }
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
    if ($eventNum == 0) {
        if ($startDate < $date) {
            $errors["errorDate"] = "The ad start date must be greater than or equal to the current date";
            $errorNum = 1;
        }
    }
    if (isset($_POST["endDate"]) && !empty($_POST["endDate"])) {
        $endDate = $_POST["endDate"];
        if ($endDate <= $startDate) {
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
    if ($eventNum == 1) {
        $ads = executeSingleResult("SELECT * FROM tb_ads WHERE ads_id = $id");
        $imagesDelete = $ads["image_ads"];
        unlink('../../../../' . $imagesDelete);
    }

    $files = $_FILES['imageAds'];
    $imagesType = $files['type'];
    $imagesSize = $files['size'] / 1024 / 1024;
    $original_image_link = $target_dir . basename($files['name']);
    $image = $target_dir . basename($files['name']);
    $imagesLink = "../../../../$target_dir" . basename($files['name']);

    if (file_exists($imagesLink)) {
        $file_extension = pathinfo($original_image_link, PATHINFO_EXTENSION);
        $counter = 1;

        while (file_exists($imagesLink)) {
            $new_file_name = pathinfo($original_image_link, PATHINFO_FILENAME) . '_(' . $counter . ').' . $file_extension;
            $imagesLink = "../../../../$target_dir" . $new_file_name;
            $image = $target_dir . $new_file_name;
            $counter++;
        }
    }
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
    if ($eventNum == 0) {
        $errors["errorImages"] = "Ads images cannot be blank";
        $errorNum = 1;
    } else {
        $noUpdateImage = 1;
    }
}


if (
    $errorNum == 0
) {
    if ($eventNum == 0) {
        if ($typeAds == 'category') {
            execute("INSERT INTO tb_ads (type_ads, image_ads, start_date, end_date, cate_id) 
            VALUES ('$typeAds', '$image', '$startDate', '$endDate', $cateID)");
        } elseif ($typeAds == 'product') {
            execute("INSERT INTO tb_ads (type_ads, image_ads, start_date, end_date, product_id) 
            VALUES ('$typeAds', '$image', '$startDate', '$endDate', $productID)");
        } else {
            execute("INSERT INTO tb_ads (type_ads, image_ads, start_date, end_date) 
            VALUES ('$typeAds', '$image', '$startDate', '$endDate')");
        }
        move_uploaded_file($uploads_tmp_name, $uploads_imagesLink);
        echo 'success';
    } else {
        if ($typeAds == 'category') {
            execute("UPDATE tb_ads SET 
            type_ads = '$typeAds', image_ads = '$image', start_date = '$endDate', end_date = '$startDate', cate_id = $cateID
            where ads_id = $id");
        } elseif ($typeAds == 'product') {
            execute("UPDATE tb_ads SET 
            type_ads = '$typeAds', image_ads = '$image', start_date = '$startDate', end_date = '$endDate', product_id = $productID
            where ads_id = $id");
        } else {
            execute("UPDATE tb_ads SET 
            type_ads = '$typeAds', image_ads = '$image', start_date = '$startDate', end_date = '$endDate'
            where ads_id = $id");
        }
        move_uploaded_file($uploads_tmp_name, $uploads_imagesLink);
        echo 'success';
    }
} else {
    echo json_encode($errors);
}
