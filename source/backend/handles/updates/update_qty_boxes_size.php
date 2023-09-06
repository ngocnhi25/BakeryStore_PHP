<?php
session_start();
require_once("../../../connect/connectDB.php");

$errorNum = 0;
$errors = $user_id = $size_name = $size_qty = $qtiBoxSize = $content = '';

if (isset($_SESSION["auth_user"])) {
    $user_id = $_SESSION["auth_user"]["user_id"];
}

if(isset($_POST["id"])){
    $id = $_POST["id"];
    $size = executeSingleResult("SELECT * FROM tb_size where size_id = $id");
    $size_name = $size["size_name"];
    $size_qty = $size["qti_boxes_size"];
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
    $success = execute("UPDATE tb_size SET deleted_size = 0, qti_boxes_size = $qtiBoxSize WHERE size_id = $id");
    if($size_qty == $qtiBoxSize) {
        $content = 'has updated the status for size ' . $size_name . ' to display';
    } else {
        $content = 'has updated the quantity of cake boxes in the warehouse to be ' . $qtiBoxSize .' for size ' . $size_name;
    }
    if($success){
        historyOperation($user_id, $content);
        echo 'success';
    }
} else {
    echo $errors;
}

?>