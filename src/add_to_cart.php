<?php

session_start();

if (isset($_SESSION['cart'])) {
    $cart_id = array_column($_SESSION['cart'], "id");

    if (!in_array($_POST['id'], $cart_id)) {
        $item_array = array(
            "id" => $_POST['id'],
            "name" => $_POST['name'],
            "price" => $_POST['price'],
            "quantity" => $_POST['quantity']
        );

        
        $_SESSION['cart'][] = $item_array;
        var_dump($item_array);
die();
    } else {
        // If the product already exists in the cart, update the quantity
        $index = array_search($_POST['id'], $cart_id);
        $_SESSION['cart'][$index]['quantity'] += $_POST['quantity'];
    }
} else {
    $item_array = array(
        "id" => $_POST['id'],
        "name" => $_POST['name'],
        "price" => $_POST['price'],
        "quantity" => $_POST['quantity']
    );

    $_SESSION['cart'][] = $item_array;
}
?>
