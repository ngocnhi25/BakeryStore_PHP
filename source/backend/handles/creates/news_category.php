<?php
require_once("../../../connect/connectDB.php");

$errorNum = $eventNum = 0;
$errors = $sizesInsert = [];
$errors["errorCateName"] =
    '';

if (isset($_POST["id"]) && !empty($_POST["id"])) {
    $id = $_POST["id"];
    $eventNum = 1;
}

if (isset($_POST["name"]) && !empty($_POST["name"])) {
    $name = trim($_POST["name"]);
    if ($eventNum == 0) {
        $cates = checkRowTable("SELECT * FROM tb_news_cate WHERE new_cate_name = '$name'");
        if ($cates != 0) {
            $errors["errorCateName"] = 'News Category name already exists';
            $errorNum = 1;
        } else {
            if (strlen($name) <= 3) {
                $errors["errorCateName"] = 'News Category name must be more than 3 characters';
                $errorNum = 1;
            }
        }
    } else {
        $cateNameUpdate = executeSingleResult("SELECT * FROM tb_news_cate WHERE new_cate_id = $id");
        if ($name != $cateNameUpdate["new_cate_name"]) {
            $cates = checkRowTable("SELECT * FROM tb_news_cate WHERE new_cate_name = '$name'");
            if ($cates != 0) {
                $errors["errorCateName"] = 'News Category  name already exists';
                $errorNum = 1;
            }else {
                if (strlen($name) <= 3) {
                    $errors["errorCateName"] = 'News Category name must be more than 3 characters';
                    $errorNum = 1;
                }
            }
        }
    }
} else {
    $errors["errorCateName"] = 'News category cannot be empty';
    $errorNum = 1;
}



if ($errorNum == 0) {
    if($eventNum == 0) {
        execute("INSERT INTO tb_news_cate (new_cate_name) VALUES ('$name')");
        $new_cateID = executeSingleResult("SELECT MAX(new_cate_id) as new_cateID FROM tb_news_cate");
        $id = $new_cateID["new_cateID"];
    
        
        echo 'success';
    } else {
        execute("UPDATE tb_news_cate SET new_cate_name = '$name' WHERE new_cate_id = $id");
        
        echo 'success';
    }
} else {
    echo json_encode($errors);
}
