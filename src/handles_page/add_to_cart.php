<?php
session_start();

if (isset($_POST['id'], $_POST['name'], $_POST['price'], $_POST['quantity'], $_POST['size'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $base_price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $size = $_POST['size'];

    // Optional: If you have the increase_size value from the client-side, you can retrieve it here.
    // The increase_size value should be passed as "increase_size" in the AJAX data.
    $increase_size = isset($_POST['increase_size']) ? $_POST['increase_size'] : 0;

    if (isset($_SESSION['cart'])) {
        $cart_id = array_column($_SESSION['cart'], "id");

        if (!in_array($id, $cart_id)) {
            $item_array = array(
                "id" => $id,
                "name" => $name,
                "price" => $base_price + $increase_size, // Add the increase_size to the base price
                "quantity" => $quantity,
                "size" => $size
            );

            $_SESSION['cart'][] = $item_array;
        } else {
            // If the product already exists in the cart, update the quantity
            $index = array_search($id, $cart_id);
            $_SESSION['cart'][$index]['quantity'] += $quantity;
        }
    } else {
        $item_array = array(
            "id" => $id,
            "name" => $name,
            "price" => $base_price + $increase_size, // Add the increase_size to the base price
            "quantity" => $quantity,
            "size" => $size
        );

        $_SESSION['cart'][] = $item_array;
    }

    // Optional: You may send some response back to the client to indicate success or any other relevant information.
    echo "Item added to cart successfully.";
} else {
    // If any of the required fields are missing, handle the error accordingly.
    echo "Error: Missing required fields.";
}
?>
