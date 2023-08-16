<?php
require_once("../connect/connectDB.php");

if (isset($_POST["product_id"])) {
    session_start();
    if (isset($_SESSION["auth_user"])) {
        $user_id = $_SESSION["auth_user"]["user_id"]; 
        $product_id = $_POST["product_id"];

        $product = executeSingleResult("SELECT * FROM tb_products WHERE product_id = $product_id");
        $flavors = executeResult("SELECT * FROM tb_flavor WHERE deleted_flavor = 0");
        $sizes = executeResult("SELECT * FROM tb_size WHERE deleted_size = 0 ORDER BY size_name ASC");
        $price = $product["price"];
        $total_price = ($product["price"] + $sizes[0]["increase_size"]);
        $product_name = $product["product_name"];
        $flavor = $flavors[0]["flavor_name"];
        $size = $sizes[0]["size_name"];

        $cart = checkRowTable("SELECT * FROM tb_cart WHERE product_id = $product_id");
        if($cart == 0){
          execute("INSERT INTO tb_cart (user_id, product_id, quantity, total_price, product_name, price, flavor, size) 
                    VALUES ($user_id, $product_id, 1, $total_price, '$product_name', $price, '$flavor', $size)");
        } else {
          execute("UPDATE tb_cart SET quantity = quantity + 1 WHERE product_id = $product_id");
        }

        
        $count = executeSingleResult("SELECT COUNT(*) as total FROM tb_cart Where user_id = $user_id");
        $itemCount = $count["total"];
        echo $itemCount;
    } else {
      echo "not logged in";
    }
}
