<?php
require_once("../../../connect/connectDB.php");

$errorNum = 0;
$errors = '';

if(isset($_POST["id"])){
    $id = $_POST["id"];
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
    execute("UPDATE tb_flavor SET deleted_flavor = 0, qti_flavor = $flavorInStock WHERE flavor_id = $id");
    echo 'success';
} else {
    echo $errors;
}

?>