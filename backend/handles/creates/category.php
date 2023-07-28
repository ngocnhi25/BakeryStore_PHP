<?php
require_once("../../../connect/connectDB.php");

$errorNum = $eventNum = 0;
$errors = $flavorsInsert = $sizesInsert = [];
$errors["errorCateName"] =
    $errors["errorFlavors"] =
    $errors["errorSizes"] =
    '';

if (isset($_POST["id"]) && !empty($_POST["id"])) {
    $id = $_POST["id"];
    $eventNum = 1;
}

if (isset($_POST["name"]) && !empty($_POST["name"])) {

    $name = trim($_POST["name"]);
    $cates = checkRowTable("SELECT * FROM tb_category WHERE cate_name = '$name'");
    if ($cates != 0) {
        $errors["errorCateName"] = 'Category name already exists';
        $errorNum = 1;
    } else {
        if (strlen($name) <= 3) {
            $errors["errorCateName"] = 'Product name must be more than 3 characters';
            $errorNum = 1;
        }
    }
} else {
    $errors["errorCateName"] = 'Product category cannot be empty';
    $errorNum = 1;
}

if (isset($_POST["flavors"]) && !empty($_POST["flavors"][0])) {
    $checked_array_flavor = $_POST["flavors"];
    $flavorsData = $_POST["flavorName"];
    $flavor_increase = $_POST["flavor_increase"];
    foreach ($flavorsData as $key => $flavor) {
        if (in_array($flavorsData[$key], $checked_array_flavor)) {
            if ($flavorsData[$key] == null) {
                $errors["errorFlavors"] = "Do not leave the box you selected blank";
                $errorNum = 1;
            } elseif ($flavor_increase[$key] < 0) {
                $errors["errorFlavors"] = "Price increase must be greater than or equal to 0";
                $errorNum = 1;
            } else {
                $flavorsInsert[$key]["flavor"] = $flavorsData[$key];
                $flavorsInsert[$key]["increase"] = $flavor_increase[$key];
                $errorNum = 0;
            }
        }
    }
} else {
    if($eventNum == 0){
        $errors["errorFlavors"] = "Add at least one cake flavor";
        $errorNum = 1;
    }
}

if (isset($_POST["sizes"]) && !empty($_POST["sizes"][0])) {
    $checked_array_flavor = $_POST["sizes"];
    $sizesData = $_POST["sizeName"];
    $size_increase = $_POST["size_increase"];
    foreach ($sizesData as $key => $size) {
        if (in_array($sizesData[$key], $checked_array_flavor)) {
            if ($size_increase[$key] == null) {
                $errors["errorSizes"] = "Do not leave the box you selected blank";
                $errorNum = 1;
            } elseif ($size_increase[$key] < 0) {
                $errors["errorSizes"] = "Price increase must be greater than or equal to 0";
                $errorNum = 1;
            } else {
                $sizesInsert[$key]["size"] = $sizesData[$key];
                $sizesInsert[$key]["increase"] = $size_increase[$key];
                $errorNum = 0;
            }
        }
    }
} else {
    if($eventNum == 0){
        $errors["errorSizes"] = "Add at least one cake size";
        $errorNum = 1;
    }
}



if ($errorNum == 0) {
    if ($eventNum == 0) {
        execute("INSERT INTO tb_category (cate_name) VALUES ('$name')");
        $new_cateID = executeSingleResult("SELECT MAX(cate_id) as new_cateID FROM tb_category");
        $id = $new_cateID["new_cateID"];

        foreach ($flavorsInsert as $key => $valFlavor) {
            $flavor = $valFlavor["flavor"];
            $flavor_increase = $valFlavor["increase"];
            execute("INSERT INTO tb_product_flavor (cate_id, flavor, increase_flavor) VALUES
                ($id, '$flavor', $flavor_increase)");
        }
        foreach ($sizesInsert as $key => $valSize) {
            $size = $valSize["size"];
            $size_increase = $valSize["increase"];
            execute("INSERT INTO tb_product_size (cate_id, size, increase_size) VALUES
                ($id, '$size', $size_increase)");
        }
        echo 'success';
    } else {
        execute("UPDATE tb_category SET cate_name = '$name' WHERE cate_id = $id");

        foreach ($flavorsInsert as $key => $valFlavor) {
            $flavor = $valFlavor["flavor"];
            $flavor_increase = $valFlavor["increase"];
            execute("INSERT INTO tb_product_flavor (cate_id, flavor, increase_flavor) VALUES
                ($id, '$flavor', $flavor_increase)");
        }
        foreach ($sizesInsert as $key => $valSize) {
            $size = $valSize["size"];
            $size_increase = $valSize["increase"];
            execute("INSERT INTO tb_product_size (cate_id, size, increase_size) VALUES
                ($id, '$size', $size_increase)");
        }
        echo 'success';
    }
} else {
    echo json_encode($errors);
}
