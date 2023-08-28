<?php
session_start();
require_once("../../../connect/connectDB.php");
if (isset($_SESSION["auth_user"])) {
    $user_id = $_SESSION["auth_user"]["user_id"];
}

$errors = [];
$uploads_imagesLink = $uploads_tmp_name = [];
$images = $imagesDelete =  [];
$errors["errorImages"] = [];

$errors["errorName"] =
    $errors["errorCateID"] =
    $errors["errorDescription"] = $image = '';
$errorNum = $eventNum = $noUpdateImage = 0;

date_default_timezone_set('Asia/Bangkok');
$date = date('Y-m-d H:i:s');

$target_dir = "public/new_images/";
$type_allow = ['image/png', 'image/jpeg', 'image/gif', 'image/jpg'];
$size_allow = 3;

// id
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    $id = $_POST["id"];
    $eventNum = 1;
}

// product name
if (isset($_POST["name"]) && !empty($_POST["name"])) {
    if ($eventNum == 1) {
        $name = trim($_POST["name"]);
    } else {
        $name = trim($_POST["name"]);
        $nameSearch = checkRowTable("select * from tb_news where new_title = '$name'");

        if ($nameSearch != 0) {
            $errors["errorName"] = 'News title already exists';
            $errorNum = 1;
        } else {
            if (strlen($name) <= 3) {
                $errors["errorName"] = 'News title must be more than 3 characters';
                $errorNum = 1;
            }
        }
    }
} else {
    $errors["errorName"] = 'News title cannot be blank';
    $errorNum = 1;
}

// // product category
if (isset($_POST["cateID"]) && !empty($_POST["cateID"])) {
    $cateID = $_POST["cateID"];
} else {
    $errors["errorCateID"] = 'News category cannot be blank';
    $errorNum = 1;
}
// description
if (isset($_POST["new_description"]) && !empty($_POST["new_description"])) {
    $description =  $_POST["new_description"];
} else {
    $errors["errorDescription"] = 'Description cannot be blank';
    $errorNum = 1;
}
// // images
if (isset($_FILES["images"]["name"])) {
    $files = $_FILES['images'];
    $file_names = $files['name'];

    if ($eventNum == 1) {
        $thumbnails = executeResult("SELECT * FROM tb_thumbnail WHERE product_id = $id");
        $imageDelete = executeSingleResult("SELECT * FROM tb_news WHERE new_id = $id");

        $imagesDelete[0] = $imageDelete["new_image"];
        foreach ($thumbnails as $key => $thumb) {
            $imagesDelete[$key + 1] = $thumb["thumbnail"];
        }
        foreach ($imagesDelete as $key => $imgDelete) {
            unlink('../../../../' . $imgDelete);
        }
        execute("DELETE FROM tb_thumbnail WHERE product_id = $id");
    }

    foreach ($file_names as $key => $value) {
        $images[$key] = $target_dir . basename($value);
        $imagesLink = "../../../../$target_dir" . basename($value);
        $imagesType = $files['type'][$key];
        $imagesSize = $files['size'][$key] / 1024 / 1024;

        // kiểm tra xem file có hợp lệ không
        if (!file_exists($imagesLink)) {
            if (in_array($imagesType, $type_allow)) {
                if ($imagesSize <= $size_allow) {
                    $uploads_tmp_name[$key] = $files["tmp_name"][$key];
                    $uploads_imagesLink[$key] = $imagesLink;
                } else {
                    $errors["errorImages"][$key] = 'file ' . $files["name"][$key] . ' capacity must be less than ' . $size_allow . 'MB ';
                    $errorNum = 1;
                }
            } else {
                $errors["errorImages"][$key] = 'file ' . $files["name"][$key] . ' format error';
                $errorNum = 1;
            }
        } else {
            $errors["errorImages"][$key] = 'file ' . $files["name"][$key] . ' already exists in the directory';
            $errorNum = 1;
        }
    }
} else {
    if ($eventNum == 0) {
        $errors["errorImages"] = "News images cannot be blank";
        $errorNum = 1;
    } else {
        $noUpdateImage = 1;
    }
}

if (
    $errorNum == 0
) {
    if ($eventNum == 0) {
        $imageInsert = $images[0];
        
        $sql = "INSERT INTO tb_news 
        (new_cate_id, new_title, new_description, new_image) VALUES
        ($cateID, '$name', '$description', '$imageInsert')";
        execute($sql);
        $new_id_product = executeSingleResult("SELECT MAX(new_id) as new_id_product FROM tb_news");
        $new_id = $new_id_product["new_id_product"];
        // tb_thumnail chỉ chứa ảnh của product thôi. Tạo bảng khác
        for ($i = 1; $i < count($images); $i++) {
            $insertThumb = $images[$i];
            execute("INSERT INTO tb_thumbnail 
                (product_id, thumbnail) VALUES
                ($new_id, '$insertThumb')");
        }
        for ($i = 0; $i < count($images); $i++) {
            move_uploaded_file($uploads_tmp_name[$i], $uploads_imagesLink[$i]);
        }
        
        
        $content = 'has added a news ' . $name;
        execute("INSERT INTO tb_shop_history (user_id, action, action_time) 
        VALUES ($user_id, '$content', '$date')");
        echo 'success';
    } else {
        if ($noUpdateImage == 0) {
            $imageUpdate = $images[0];
            execute("UPDATE tb_news SET 
                new_cate_id = '$cateID', new_title = '$name', 
                new_image = '$imageUpdate', 
                new_description = '$description'
            WHERE new_id = $id");
            for ($i = 1; $i < count($images); $i++) {
                $updateThumb = $images[$i];
                execute("INSERT INTO tb_thumbnail 
                (product_id, thumbnail) VALUES
                ($id, '$updateThumb')");
            }
            for ($i = 0; $i < count($images); $i++) {
                move_uploaded_file($uploads_tmp_name[$i], $uploads_imagesLink[$i]);
            }
        } else {
            execute("UPDATE tb_news SET 
                new_cate_id = '$cateID', new_title = '$name', 
                new_description = '$description'
            WHERE new_id = $id");
        }
        
        $content = 'has updated to flavor ' . $name;
        execute("INSERT INTO tb_shop_history (user_id, action, action_time) 
        VALUES ($user_id, '$content', '$date')");
        echo 'success';
    }
} else {
    echo json_encode($errors);
}
