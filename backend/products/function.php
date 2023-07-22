<?php
require_once('../../connect/connectDB.php');

// echo json_encode($_POST);
$errors = [];
$uploads_file = [];
$thumbnail = [];
$errors["errorThubnail"] = [];

$errors["errorName"] =
    $errors["errorPrice"] =
    $errors["errorCateID"] =
    $errors["errorDescription"] =
    $errors["errorImage"] = '';

$target_dir = "public/images/products/";
$type_allow = ['image/png', 'image/jpeg', 'image/gif', 'image/jpg'];
$size_allow = 3;

// product name
if (isset($_POST["name"]) && !empty($_POST["name"])) {
    $name = trim($_POST["name"]);
    $nameSearch = checkRowTable("select * from tb_products where product_name = '$name'");

    if ($nameSearch != 0) {
        $errors["errorName"] = 'product name already exists';
    } else {
        if (strlen($name) <= 3) {
            $errors["errorName"] = 'Product name must be more than 3 characters';
        }
    }
} else {
    $errors["errorName"] = 'Product name cannot be blank';
}
// product name
if (isset($_POST["price"]) && !empty($_POST["price"])) {
    $price = $_POST["price"];
    if ($price <= 0) {
        $errors["errorPrice"] = 'Product price must be greater than 0';
    }
} else {
    $errors["errorPrice"] = 'Product price cannot be blank';
}
// // product name
if (isset($_POST["cateID"]) && !empty($_POST["cateID"])) {
    $cateID = $_POST["cateID"];
} else {
    $errors["errorCateID"] = 'Product category cannot be blank';
}
// description
if (isset($_POST["description"]) && !empty($_POST["description"])) {
    echo $_POST["description"];
} else {
    $errors["errorDescription"] = 'Description cannot be blank';
}
// // image
if (isset($_FILES["image"]["name"])) {
    $file = $_FILES["image"];
    $image = $target_dir . basename($file["name"]);
    $imageLink = "../../$target_dir" . basename($file["name"]);
    $imageType = $file['type'];
    $imageSize = $file['size'] / 1024 / 1024;
    if (!file_exists($imageLink)) {
        if (in_array($imageType, $type_allow)) {
            if ($imageSize <= $size_allow) {
                $uploads_file[0] = $file["tmp_name"] . ',' . $imageLink;
                // move_uploaded_file($file["tmp_name"], $thumbnailLink);
            } else {
                $errors["errorImage"] = 'file ' . $file["name"] . ' capacity must be less than ' . $size_allow . 'MB ';
            }
        } else {
            $errors["errorImage"] = 'file ' . $file["name"] . ' format error';
        }
    } else {
        $errors["errorImage"] = 'file ' . $file["name"] . ' already exists in the directory';
    }
} else {
    $errors["errorImage"] = "Product image cannot be blank";
}
// // thumbnail
if (isset($_FILES["images"]["name"])) {
    $files = $_FILES['images'];
    $file_names = $files['name'];

    foreach ($file_names as $key => $value) {
        $thumbnail = $target_dir . basename($value);
        $thumbnailLink = "../../$target_dir" . basename($value);
        $thumbnailType = $files['type'][$key];
        $thumbnailSize = $files['size'][$key] / 1024 / 1024;

        // kiểm tra xem file có hợp lệ không
        if (!file_exists($thumbnailLink)) {
            if (in_array($thumbnailType, $type_allow)) {
                if ($thumbnailSize <= $size_allow) {
                    $uploads_file[$key + 1] = $files["tmp_name"][$key] . ',' . $thumbnailLink;
                    // move_uploaded_file($files["tmp_name"][$key], $thumbnailLink);
                } else {
                    $errors["errorThubnail"][$key] = 'file ' . $files["name"][$key] . ' capacity must be less than ' . $size_allow . 'MB ';
                }
            } else {
                $errors["errorThubnail"][$key] = 'file ' . $files["name"][$key] . ' format error';
            }
        } else {
            $errors["errorThubnail"][$key] = 'file ' . $files["name"][$key] . ' already exists in the directory';
        }
    }
} else {
    $errors["errorThubnail"] = "Product thumbnail cannot be blank";
}


// if (
// empty($errors["errorImage"])
// && !empty($errors["errorThubnail"])
// && !empty($errors["errorCateID"])
// && !empty($errors["errorDescription"])
// && !empty($errors["errorPrice"])
//   &&  !empty($errors["errorName"])
// ) {
    
// } else {
//     echo json_encode($errors);
// }
