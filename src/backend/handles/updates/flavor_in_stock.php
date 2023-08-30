<?php
session_start();
require_once("../../../connect/connectDB.php");

$errorNum = 0;
$errors = $flavorInStock = $content = $user_id = $flavor_name = $flavor_qty = '';

if (isset($_SESSION["auth_user"])) {
    $user_id = $_SESSION["auth_user"]["user_id"];
}

if(isset($_POST["id"])){
    $id = $_POST["id"];
    $flavor = executeSingleResult("SELECT * FROM tb_flavor where flavor_id = $id");
    $flavor_name = $flavor["flavor_name"];
    $flavor_qty = $flavor["qti_flavor"];
}

if(isset($_POST["flavorInStock"]) && !empty($_POST["flavorInStock"])){
    $flavorInStock = $_POST["flavorInStock"];
    if($flavorInStock <= 0 || $flavorInStock >= 50){
        $errors = 'The flavor in stock must be greater than 0 and less than 50';
        $errorNum = 1;
    }
} else {
    $errors = "Flavor in stock cannot e blank";
    $errorNum = 1;
}

if($errorNum == 0){
    $success = execute("UPDATE tb_flavor SET deleted_flavor = 0, qti_flavor = $flavorInStock WHERE flavor_id = $id");
    if($flavor_qty == $flavorInStock) {
        $content = 'has updated the status for flavor ' . $flavor_name . ' to display';
    } else {
        $content = 'has updated the quantity of flavors in the warehouse to be ' . $flavorInStock .' for' . $flavor_name;
    }
    if($success){
        historyOperation($user_id, $content);
    }
    echo 'success';
} else {
    echo $errors;
}

?>