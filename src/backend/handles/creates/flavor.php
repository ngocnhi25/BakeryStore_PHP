<?php
require_once("../../../connect/connectDB.php");

$errorNum = $eventNum = 0;
$errors = [];
$errors["errorFlavor"] = $errors["errorFlavorInStock"] = '';

if (isset($_POST["id"]) && !empty($_POST["id"])) {
    $id = $_POST["id"];
    $eventNum = 1;
}

if (isset($_POST["flavor"]) && !empty($_POST["flavor"])) {
    $flavor_name = trim($_POST["flavor"]);
    if ($eventNum == 0) {
        $nameFlavor = checkRowTable("SELECT * FROM tb_flavor WHERE flavor_name = '$flavor_name'");
        if ($nameFlavor != 0) {
            $errors["errorFlavor"] = 'Flavor name already exists';
            $errorNum = 1;
        } else {
            if ($flavor_name < 3 || $flavor_name > 30) {
                $errors["errorFlavor"] = 'character length greater than 2 is less than 30';
                $errorNum = 1;
            } 
        }
    } else {
        $nameUpdate = executeSingleResult("SELECT * FROM tb_flavor WHERE flavor_id = $id");
        if ($flavor_name != $nameUpdate["flavor_name"]) {
            $nameFlavor = checkRowTable("SELECT * FROM tb_flavor WHERE flavor_name = '$flavor_name'");
            if ($nameFlavor != 0) {
                $errors["errorFlavor"] = 'Flavor name already exists';
                $errorNum = 1;
            }else {
                if ($flavor_name < 3 || $flavor_name > 30) {
                    $errors["errorFlavor"] = 'character length greater than 2 is less than 30';
                    $errorNum = 1;
                } 
            }
        }
    }
} else {
    $errors["errorFlavor"] = 'Flavor cannot be empty';
    $errorNum = 1;
}

if (isset($_POST["flavorInStock"]) && !empty($_POST["flavorInStock"])) {
    $flavorInStock = $_POST["flavorInStock"];
    if ($flavorInStock <= 0 || $flavorInStock > 50) {
        $errors["errorFlavorInStock"] = 'The flavor in stock must be greater than 0 and less than 50';
        $errorNum = 1;
    }
} else {
    $errors["errorFlavorInStock"] = 'Flavor in stock cannot be empty';
    $errorNum = 1;
}

if ($errorNum == 0) {
    if ($eventNum == 0) {
        execute("INSERT INTO tb_flavor (flavor_name, qti_flavor, deleted_flavor) VALUES ('$flavor_name', $flavorInStock, 0)");
        echo 'success';
    } else {
        execute("UPDATE tb_flavor SET flavor_name = '$flavor_name', qti_flavor = $flavorInStock WHERE flavor_id = $id");
        echo 'success';
    }
} else {
    echo json_encode($errors);
}
