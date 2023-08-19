<?php
require_once("../../../connect/connectDB.php");

$errorNum = 0;
$errors = '';

if(isset($_POST["id"])){
    $id = $_POST["id"];
}

if(isset($_POST["qtiBoxSize"]) && !empty($_POST["qtiBoxSize"])){
    $qtiBoxSize = $_POST["qtiBoxSize"];
    if($qtiBoxSize <= 0 || $qtiBoxSize >= 100){
        $errors = 'The number of boxes must be greater than 0 and less than 100';
        $errorNum = 1;
    }
} else {
    $errors = "The number of boxes cannot be blank";
    $errorNum = 1;
}

if($errorNum == 0){
    execute("UPDATE tb_size SET deleted_size = 0, qti_boxes_size = $qtiBoxSize WHERE size_id = $id");
    echo 'success';
} else {
    echo $errors;
}

?>