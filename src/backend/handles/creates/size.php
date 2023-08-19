<?php
require_once("../../../connect/connectDB.php");

$errorNum = $eventNum = 0;
$errors = [];
$errors["errorSize"] = '';

if (isset($_POST["id"]) && !empty($_POST["id"])) {
    $id = $_POST["id"];
    $eventNum = 1;
}

if (isset($_POST["size"]) && !empty($_POST["size"])) {
    $size_name = trim($_POST["size"]);
    if($size_name < 12 || $size_name > 40){
        $errors["errorSize"] = 'The size must be greater than 12 and less than 40';
        $errorNum = 1;
    } else {
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
    }
} else {
    $errors["errorSize"] = 'Size cannot be empty';
    $errorNum = 1;
}

if(isset($_POST["qtiBoxSize"]) && !empty($_POST["qtiBoxSize"])){
    $qtiBoxSize = $_POST["qtiBoxSize"];
    if($qtiBoxSize <= 0 || $qtiBoxSize >= 100){
        $errors["errorqtiBoxSize"] = 'The number of boxes must be greater than 0 and less than 100';
        $errorNum = 1;
    }
} else {
    $errors["errorqtiBoxSize"] = 'The number of boxes cannot be blank';
    $errorNum = 1;
}

if ($errorNum == 0) {
    if ($eventNum == 0) {
        execute("INSERT INTO tb_size (size_name, qti_boxes_size, deleted_size) VALUES ($size_name, $qtiBoxSize, 0)");
        echo 'success';
    } else {
        execute("UPDATE tb_size SET size_name = $size_name, qti_boxes_size = $qtiBoxSize WHERE size_id = $id");
        echo 'success';
    }
} else {
    echo json_encode($errors);
}
?>