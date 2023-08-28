<?php
session_start();
require_once("../../../connect/connectDB.php");
if (isset($_SESSION["auth_user"])) {
    $user_id = $_SESSION["auth_user"]["user_id"];
}

$errors["errorTypeAds"] =
    $errors["errorDate"] =
    $errors["errorImages"] =
    $startDate =
    $endDate =
    $cateID =
    $typeAds =
    $productID =
    $image =
    $uploads_tmp_name =
    $uploads_imagesLink =
    $content =
    $id =
    '';
$errorNum = $eventNum = $noUpdateImage = 0;

date_default_timezone_set('Asia/Bangkok');
$date = date('Y-m-d');
$dateAction = date('Y-m-d H:i:s'); 

$target_dir = "public/images/banners/";
$type_allow = ['image/png', 'image/jpeg', 'image/gif', 'image/jpg'];
$size_allow = 3;

if (isset($_POST["ads_id"]) && !empty($_POST["ads_id"])) {
    $id = $_POST["ads_id"];
    $eventNum = 1;
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

if (isset($_POST["typeAds"]) && !empty($_POST["typeAds"])) {
    $typeAds = $_POST["typeAds"];
    if ($typeAds == 'category') {
        if (isset($_POST["cateID"]) && !empty($_POST["cateID"])) {
            $cateID = $_POST["cateID"];
            if ($startDate != null && $endDate != null) {
                if ($eventNum == 0) {
                    $sqlNotContain = "SELECT * FROM tb_ads 
                                        WHERE cate_id = $cateID
                                        AND ((end_date BETWEEN '$startDate' AND '$endDate')
                                        OR (start_date BETWEEN '$startDate' AND '$endDate'))";
                } else {
                    $sqlNotContain = "SELECT * FROM tb_ads 
                                        WHERE cate_id = $cateID AND ads_id != $id
                                        AND ((end_date BETWEEN '$startDate' AND '$endDate')
                                        OR (start_date BETWEEN '$startDate' AND '$endDate'))";
                }
                $checkSaleProductNotContain = checkRowTable($sqlNotContain);

                if ($checkSaleProductNotContain != 0) {
                    $errors["errorDate"] = 'The overlapping advertising periods.';
                    $errorNum = 1;
                }
            }
        } else {
            $errors["errorTypeAds"] = "Type advertising cannot be blank";
            $errorNum = 1;
        }
    } elseif ($typeAds == 'product') {
        if (isset($_POST["productID"]) && !empty($_POST["productID"])) {
            $productID = $_POST["productID"];
            if ($startDate != null && $endDate != null) {
                if ($eventNum == 0) {
                    $sqlNotContain = "SELECT * FROM tb_ads 
                                        WHERE product_id = $productID
                                        AND ((end_date BETWEEN '$startDate' AND '$endDate')
                                        OR (start_date BETWEEN '$startDate' AND '$endDate'))";
                } else {
                    $sqlNotContain = "SELECT * FROM tb_ads 
                                        WHERE product_id = $productID AND ads_id != $id
                                        AND ((end_date BETWEEN '$startDate' AND '$endDate')
                                        OR (start_date BETWEEN '$startDate' AND '$endDate'))";
                }
                $checkSaleProductNotContain = checkRowTable($sqlNotContain);

                if ($checkSaleProductNotContain != 0) {
                    $errors["errorDate"] = 'The overlapping advertising periods.';
                    $errorNum = 1;
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


if (isset($_FILES["imageAds"]["name"]) && !empty($_FILES["imageAds"]["name"])) {
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
            $cate_name = executeSingleResult("SELECT cate_name FROM tb_category WHERE cate_id = $cateID");
            $content = 'has added advertisements to category ' . $cate_name["cate_name"];
        } elseif ($typeAds == 'product') {
            execute("INSERT INTO tb_ads (type_ads, image_ads, start_date, end_date, product_id) 
            VALUES ('$typeAds', '$image', '$startDate', '$endDate', $productID)");
            $product_name = executeSingleResult("SELECT product_name FROM tb_products WHERE product_id = $productID");
            $content = 'has added advertisements to product ' . $product_name["product_name"];
        } else {
            execute("INSERT INTO tb_ads (type_ads, image_ads, start_date, end_date) 
            VALUES ('$typeAds', '$image', '$startDate', '$endDate')");
            $content = 'has added advertisements to ' . $typeAds;
        }
        execute("INSERT INTO tb_shop_history (user_id, action, action_time) 
        VALUES ($user_id, '$content', '$dateAction')");
        move_uploaded_file($uploads_tmp_name, $uploads_imagesLink);
        echo 'success';
    } else {
        if ($noUpdateImage == 0) {
            if ($typeAds == 'category') {
                execute("UPDATE tb_ads SET 
                type_ads = '$typeAds', image_ads = '$image', start_date = '$startDate', end_date = '$endDate', cate_id = $cateID
                where ads_id = $id");
                $cate_name = executeSingleResult("SELECT cate_name FROM tb_category WHERE cate_id = $cateID");
                $content = 'has updated advertisements to category ' . $cate_name["cate_name"];
            } elseif ($typeAds == 'product') {
                execute("UPDATE tb_ads SET 
                type_ads = '$typeAds', image_ads = '$image', start_date = '$startDate', end_date = '$endDate', product_id = $productID
                where ads_id = $id");
                $product_name = executeSingleResult("SELECT product_name FROM tb_products WHERE product_id = $productID");
                $content = 'has updated advertisements to product ' . $product_name["product_name"];
            } else {
                execute("UPDATE tb_ads SET 
                type_ads = '$typeAds', image_ads = '$image', start_date = '$startDate', end_date = '$endDate'
                where ads_id = $id");
                $content = 'has updated advertisements to ' . $typeAds;
            }
            execute("INSERT INTO tb_shop_history (user_id, action, action_time) 
            VALUES ($user_id, '$content', '$dateAction')");
            move_uploaded_file($uploads_tmp_name, $uploads_imagesLink);
            echo 'success';
        } else {
            if ($typeAds == 'category') {
                execute("UPDATE tb_ads SET 
                type_ads = '$typeAds', start_date = '$startDate', end_date = '$endDate', cate_id = $cateID
                where ads_id = $id");
                $cate_name = executeSingleResult("SELECT cate_name FROM tb_category WHERE cate_id = $cateID");
                $content = 'has updated advertisements to category ' . $cate_name["cate_name"];
            } elseif ($typeAds == 'product') {
                execute("UPDATE tb_ads SET 
                type_ads = '$typeAds', start_date = '$startDate', end_date = '$endDate', product_id = $productID
                where ads_id = $id");
                $product_name = executeSingleResult("SELECT product_name FROM tb_products WHERE product_id = $productID");
                $content = 'has updated advertisements to product ' . $product_name["product_name"];
            } else {
                execute("UPDATE tb_ads SET 
                type_ads = '$typeAds', start_date = '$startDate', end_date = '$endDate'
                where ads_id = $id");
                $content = 'has updated advertisements to ' . $typeAds;
            }
            execute("INSERT INTO tb_shop_history (user_id, action, action_time) 
            VALUES ($user_id, '$content', '$dateAction')");
            echo 'success';
        }
    }
} else {
    echo json_encode($errors);
}
