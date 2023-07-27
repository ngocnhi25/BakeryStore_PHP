<?php
require_once("../../../connect/connectDB.php");

$errorNum = $eventNum = 0;
$errors = [];
$errors["errorFlavor"] = '';

if (isset($_POST["name"]) && !empty($_POST["name"])) {
    $name = $_POST["name"];
    $eventNum = 1;
}

if (isset($_POST["flavor"]) && !empty($_POST["flavor"])) {
    $flavor_name = trim($_POST["flavor"]);
    $nameFlavor = checkRowTable("SELECT * FROM tb_flavor WHERE flavor_name = '$flavor_name'");
    if ($nameFlavor != 0) {
        $errors["errorFlavor"] = 'Flavor name already exists';
        $errorNum = 1;
    } 
} else {
    $errors["errorFlavor"] = 'Flavor cannot be empty';
    $errorNum = 1;
}


if ($errorNum == 0) {
    if ($eventNum == 0) {
        execute("INSERT INTO tb_flavor (flavor_name) VALUES ('$flavor_name')");
        echo 'success';
    } else {
        execute("UPDATE tb_flavor SET flavor_name = '$flavor_name' WHERE flavor_name = '$name'");
        execute("UPDATE tb_product_flavor SET flavor = '$flavor_name' WHERE flavor = '$name'");
        echo 'success';
    }
} else {
    echo json_encode($errors);
}
?>