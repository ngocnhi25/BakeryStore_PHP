<?php
session_start();
require_once("../../../connect/connectDB.php");

$user_id = '';

if (isset($_SESSION["auth_user"])) {
    $user_id = $_SESSION["auth_user"]["user_id"];
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $thumbnails = executeResult("SELECT * FROM tb_thumbnail WHERE product_id = $id");
    $product = executeSingleResult("SELECT * FROM tb_products WHERE product_id = $id");
    $productOrder = checkRowTable("SELECT * FROM tb_products p
                                    INNER JOIN tb_order_detail od ON p.product_id = od.product_id
                                    WHERE od.product_id = $id");
    $productCart = checkRowTable("SELECT * FROM tb_products p
                                    INNER JOIN tb_cart c ON p.product_id = c.product_id
                                    WHERE c.product_id = $id");

    if($productCart == 0 && $productOrder == 0){
        $imagesDelete[0] = $product["image"];
        foreach ($thumbnails as $key => $thumb) {
            $imagesDelete[$key + 1] = $thumb["thumbnail"];
        }
        foreach ($imagesDelete as $key => $imgDelete) {
            unlink('../../../../' . $imgDelete);
        }
        execute("DELETE FROM tb_thumbnail WHERE product_id = $id");
        $success = execute("DELETE FROM tb_products WHERE product_id = $id");
    
        if ($success) {
            $content = 'has deleted a product ' . $product["product_name"];
            historyOperation($user_id, $content);
            echo "success";
        }
    } else {
        echo "doNotDelete";
    }
}
