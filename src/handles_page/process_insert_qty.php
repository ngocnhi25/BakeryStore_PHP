<?php
require_once('../connect/connectDB.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedProduct = $_POST['product_id'];
    $newQty = $_POST['new_qty'];

    $getID = executeResult("SELECT * FROM tb_warehouse");
if (!empty($getID)) {
    $firstRow = $getID[0]; // Get the first row
    $idResult = $firstRow['product_id'];
    // echo $idResult;
} else {
    echo "No results found.";
}
// die();

    if ($idResult == $selectedProduct) {
        echo "exists";
    } else { // Perform database insertion or update if product_id already exists
        $sql_insert_update = "INSERT INTO tb_warehouse (product_id, product_qty) 
                              VALUES ($selectedProduct, $newQty)
                              ON DUPLICATE KEY UPDATE product_qty = $newQty";

        $insert_update_result = execute($sql_insert_update);

        if ($insert_update_result) {
            echo "success";
        } else {
            echo "Failed to insert or update quantity.";
        }
    }

}
?>