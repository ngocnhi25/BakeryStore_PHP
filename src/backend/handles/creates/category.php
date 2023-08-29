<?php
session_start();
require_once("../../../connect/connectDB.php");
if (isset($_SESSION["auth_user"])) {
    $user_id = $_SESSION["auth_user"]["user_id"];
}
$errorNum = $eventNum = 0;
$errors = $sizesInsert = [];
$errors["errorCateName"] =
    $errors["errorSizes"] =
    '';
date_default_timezone_set('Asia/Bangkok');
$date = date('Y-m-d');
$dateAction = date('Y-m-d H:i:s');

if (isset($_POST["id"]) && !empty($_POST["id"])) {
    $id = $_POST["id"];
    $eventNum = 1;
}

if (isset($_POST["name"]) && !empty($_POST["name"])) {
    $name = trim($_POST["name"]);
    if ($eventNum == 0) {
        $cates = checkRowTable("SELECT * FROM tb_category WHERE cate_name = '$name'");
        if ($cates != 0) {
            $errors["errorCateName"] = 'Category name already exists';
            $errorNum = 1;
        } else {
            if (strlen($name) <= 3) {
                $errors["errorCateName"] = 'Category name must be more than 3 characters';
                $errorNum = 1;
            }
        }
    } else {
        $cateNameUpdate = executeSingleResult("SELECT * FROM tb_category WHERE cate_id = $id");
        if ($name != $cateNameUpdate["cate_name"]) {
            $cates = checkRowTable("SELECT * FROM tb_category WHERE cate_name = '$name'");
            if ($cates != 0) {
                $errors["errorCateName"] = 'Flavor name already exists';
                $errorNum = 1;
            }else {
                if (strlen($name) <= 3) {
                    $errors["errorCateName"] = 'Category name must be more than 3 characters';
                    $errorNum = 1;
                }
            }
        }
    }
} else {
    $errors["errorCateName"] = 'Product category cannot be empty';
    $errorNum = 1;
}

if (isset($_POST["sizeID"])) {
    $sizesID = $_POST["sizeID"];
    $size_increase = $_POST["size_increase"];
    foreach ($sizesID as $key => $size) {
        if ($size_increase[$key] == null) {
            $errors["errorSizes"] = "Do not leave the box you selected blank";
            $errorNum = 1;
        } elseif ($size_increase[$key] <= 0 && $key != 0) {
            $errors["errorSizes"] = "Price increase must be greater than or equal to 0";
            $errorNum = 1;
        } else {
            $sizesInsert[$key]["size"] = $sizesID[$key];
            $sizesInsert[$key]["increase"] = $size_increase[$key];
        }
    }
} else {
    $errors["errorSizes"] = "Add at least one cake size";
    $errorNum = 1;
}

if ($errorNum == 0) {
    if($eventNum == 0) {
        $success = execute("INSERT INTO tb_category (cate_name) VALUES ('$name')");
        $new_cateID = executeSingleResult("SELECT MAX(cate_id) as new_cateID FROM tb_category");
        $id = $new_cateID["new_cateID"];
        
        foreach ($sizesInsert as $key => $valSize) {
            $sizeID = $valSize["size"];
            $size_increase = $valSize["increase"];
            execute("INSERT INTO tb_cate_size (cate_id, size_id, increase_size) VALUES
                    ($id, $sizeID, $size_increase)");
        }

        if($success){
            $content = 'has added a new product category ' . $name;
            historyOperation($user_id, $content);
        }
        echo 'success';
    } else {
        $success = execute("UPDATE tb_category SET cate_name = '$name' WHERE cate_id = $id");
        foreach ($sizesInsert as $key => $valSize) {
            $sizeID = $valSize["size"];
            $size_increase = $valSize["increase"];
            execute("UPDATE tb_cate_size SET increase_size = $size_increase WHERE cate_size_id = $sizeID");
        }

        if($success){
            $content = 'has updated to product category ' . $name;
            historyOperation($user_id, $content);
        }
        echo 'success';
    }
} else {
    echo json_encode($errors);
}
