<?php
require_once("../../../connect/connectDB.php");

$errorNum = $eventNum = 0;
$errors = [];
$errors["errorSize"] = $errors["errorIncreaseSize"] = '';

if (isset($_POST["id"]) && !empty($_POST["id"])) {
    $id = $_POST["id"];
    $eventNum = 1;
}

if (isset($_POST["size"]) && !empty($_POST["size"])) {
    $size_name = trim($_POST["size"]);
    if($eventNum == 0) {
        $nameSize = checkRowTable("SELECT * FROM tb_size WHERE size_name = '$size_name'");
        if ($nameSize != 0) {
            $errors["errorSize"] = 'Size name already exists';
            $errorNum = 1;
        }
    } else {
        $nameUpdate = executeSingleResult("SELECT * FROM tb_size WHERE size_id = $id");
        if($size_name != $nameUpdate["size_name"]){
            $nameSize = checkRowTable("SELECT * FROM tb_size WHERE size_name = '$size_name'");
            if ($nameSize != 0) {
                $errors["errorSize"] = 'Size name already exists';
                $errorNum = 1;
            }
        }
    }
} else {
    $errors["errorSize"] = 'Size cannot be empty';
    $errorNum = 1;
}
if (isset($_POST["increase_size"]) && !empty($_POST["increase_size"])) {
    $increase_size = $_POST["increase_size"];
    if ($increase_size < 0 && $increase_size > 1000000) {
        $errors["errorIncreaseSize"] = 'The plus amount must be between 0 and 1000000';
        $errorNum = 1;
    }
} else {
    if($_POST["increase_size"] == 0){
        $increase_size = $_POST["increase_size"];
    } else {
        $errors["errorIncreaseSize"] = 'The plus amount cannot be left blank';
        $errorNum = 1;
    }
}

if ($errorNum == 0) {
    if ($eventNum == 0) {
        execute("INSERT INTO tb_size (size_name, increase_size) VALUES ('$size_name', $increase_size)");
        echo 'success';
    } else {
        execute("UPDATE tb_size SET size_name = '$size_name', increase_size = $increase_size WHERE size_id = $id");
        echo 'success';
    }
} else {
    echo json_encode($errors);
}
?>