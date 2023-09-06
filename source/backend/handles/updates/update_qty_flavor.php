<?php
session_start();
require_once("../../../connect/connectDB.php");

$errorNum = 0;
$errors = $flavor_name = $qti_flavor = $user_id = $qtyFlavor = $content = '';

if (isset($_SESSION["auth_user"])) {
    $user_id = $_SESSION["auth_user"]["user_id"];
}

if(isset($_POST["id"])){
    $id = $_POST["id"];
    $flavor = executeSingleResult("SELECT flavor_name, qti_flavor FROM tb_flavor where flavor_id = $id");
    $flavor_name = $flavor["flavor_name"];
    $qti_flavor = $flavor["qti_flavor"];
}

if(isset($_POST["qtyFlavor"]) && !empty($_POST["qtyFlavor"])){
    $qtyFlavor = $_POST["qtyFlavor"];
    if($qtyFlavor <= 0 || $qtyFlavor > 50){
        $errors = 'Product quantity must be greater than 0 and less than 50';
        $errorNum = 1;
    }
} else {
    $errors = "Flavor quantity cannot be blank";
    $errorNum = 1;
}

if($errorNum == 0){
    $success = execute("UPDATE tb_flavor SET qti_flavor = $qtyFlavor WHERE flavor_id = $id");
    if($qti_flavor == $qtyFlavor) {
        $content = 'has updated the status for flavor ' . $flavor_name . ' to display';
    } else {
        $content = 'has updated the quantity to ' . $qtyFlavor .' for flavor ' . $flavor_name;
    }
    if($success){
        historyOperation($user_id, $content);
        echo 'success';
    }
} else {
    echo $errors;
}

?>