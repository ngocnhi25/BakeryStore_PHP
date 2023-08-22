<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require '../connect/connection.php';
require '../connect/connectDB.php';
if (isset($_POST['flavor'])) {
	$selectedFlavor = $_POST['flavor'];
	// echo "Received flavor: " . $selectedFlavor;
	// ... your existing code ...
}

if (isset($_POST['pid'])) {
	$pid = $_POST['pid'];
	$pname = $_POST['pname'];
	$pprice = $_POST['price'];
	$pqty = $_POST['quantity'];
	$flavor = $_POST['flavor'];
	$increaseSize = isset($_POST['increaseSize']) ? $_POST['increaseSize'] : 0; // Default value is 0
	$size = $_POST['size'];

	$size_int = intval($size); // Convert $size to an integer

	// Check if the product with the same product ID and size is already in the cart
	$stmt = $conn->prepare('SELECT product_id, quantity, total_price, price, size FROM tb_cart WHERE product_id=?');
	$stmt->bind_param('s', $pid);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($existing_pid, $existing_qty, $existing_total_price, $existing_price, $existing_size);
	$stmt->fetch();

	if ($stmt->num_rows == 0) {
		// If product with the same product ID not in cart, insert it
		$total_price = (intval($pprice) + intval($increaseSize)) * intval($pqty); // Calculate total price without increaseSize
		$query = $conn->prepare('INSERT INTO tb_cart (product_id, quantity, total_price, product_name, price, flavor, size) VALUES (?, ?, ?, ?, ?, ?, ?)');
		$query->bind_param('iiisiss', $pid, $pqty, $total_price, $pname, $pprice, $flavor, $size);
		$query->execute();



	} elseif ($size_int == $existing_size) {
		// If product with the same product ID and size is already in cart, update the quantity and total price
		// var_dump($size_int,$sexisting_size);
		$new_qty = $existing_qty + $pqty;
		$new_total_price = (intval($existing_price) + intval($increaseSize)) * intval($new_qty);
		$query = $conn->prepare('UPDATE tb_cart SET quantity=?, total_price=? WHERE product_id=? AND size=?');
		$query->bind_param('iiss', $new_qty, $new_total_price, $pid, $size);
		$query->execute();

	} else {
		// Check if the size exists for the given product ID in the cart
		// var_dump($size_int, $existing_size);
		$size_exists_query = $conn->prepare('SELECT size FROM tb_cart WHERE product_id=? AND size=?');
		$size_exists_query->bind_param('is', $pid, $size_int);
		$size_exists_query->execute();
		$size_exists_query->store_result();

		if ($size_exists_query->num_rows == 0) {
			// Calculate the new total price for the new item
			$new_total_price = (intval($existing_price) + intval($increaseSize)) * intval($pqty);

			// Insert the new item with the different size into the cart
			$insert_query = $conn->prepare('INSERT INTO tb_cart (product_id, quantity, total_price, product_name, price, flavor, size) VALUES (?, ?, ?, ?, ?, ?, ?)');
			$insert_query->bind_param('iiisiss', $pid, $pqty, $new_total_price, $pname, $pprice, $flavor, $size);
			$insert_query->execute();
			var_dump($pid);
			// Optionally, you can provide feedback to the user that the item has been added with the new size
			echo '<div class="alert alert-success alert-dismissible mt-2">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Item added to your cart with a new size!</strong>
				  </div>';
		} else {
			echo '<div class="alert alert-warning alert-dismissible mt-2">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Item with the same product ID and size already exists in your cart.</strong>
            </div>';
		}
	}
}


// Get no.of items available in the cart table
if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {
	$stmt = $conn->prepare('SELECT * FROM tb_cart');
	$stmt->execute();
	$stmt->store_result();
	$rows = $stmt->num_rows;

	echo $rows;
}

// Remove single items from cart
if (isset($_GET['remove'])) {
	$id = $_GET['remove'];

	$stmt = $conn->prepare('DELETE FROM tb_cart WHERE product_id=?');
	$stmt->bind_param('i', $id);
	$stmt->execute();

	$_SESSION['showAlert'] = 'block';
	$_SESSION['message'] = 'Item removed from the cart!';
	header('location:cart.php');
}

// Remove all items at once from cart
if (isset($_GET['clear'])) {
	$stmt = $conn->prepare('DELETE FROM tb_cart');
	$stmt->execute();
	$_SESSION['showAlert'] = 'block';
	$_SESSION['message'] = 'All Item removed from the cart!';
	header('location:cart.php');
}

// Set total price of the product in the cart table
if (isset($_POST['qty'])) {
	$qty = $_POST['qty'];
	$pid = $_POST['pid'];
	$pprice = $_POST['price'];

	$tprice = $qty * $pprice;

	$stmt = $conn->prepare('UPDATE tb_cart SET quantity=?, total_price=? WHERE product_id=?');
	$stmt->bind_param('idi', $qty, $tprice, $pid);

	if ($stmt->execute()) {
		echo "success";
	} else {
		echo "Error updating quantity";
	}
	exit();
}



// Checkout and save customer info in the orders table
// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"]) && $_POST["action"] == "save_paypal_data") {
//     $transactionID = $_POST["transactionID"];
//     $payerName = $_POST["payerName"];
//     $payerEmail = $_POST["payerEmail"];
//     $address = $_POST["address"];



//     // Phản hồi về trạng thái lưu dữ liệu
//     echo "Dữ liệu đã được lưu vào cơ sở dữ liệu từ PayPal!";
// }
if (isset($_POST['action']) && $_POST['action'] == 'order') {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$grand_total = $_POST['grand_total'];
	$address = $_POST['address'];
	$pmode = $_POST['pmode'];
	$user_id = isset($_POST['user_id']) ? $_POST['user_id'] : null;
	$coupon_name = isset($_POST['coupon_name']) ? $_POST['coupon_name'] : null;
	$deposit = $grand_total * 0.3; // Calculate deposit as 30% of grand_total

	if (!empty($coupon_name)) {
		// Get discount and condition_used_coupon from tb_coupon based on the coupon name
		$sql_coupon = "SELECT discount_coupon, condition_used_coupon, qti_coupon, qti_used_coupon FROM tb_coupon WHERE coupon_name = '$coupon_name'";
		$coupon = executeSingleResult($sql_coupon);

		if ($coupon != null) {
			$discount_percent = $coupon['discount_coupon'];
			$condition_used_coupon = $coupon['condition_used_coupon'];
			$intcondition_used_coupon = intval($condition_used_coupon);

			// Calculate discount amount
			$discount_amount = 0;

			if ($grand_total < $intcondition_used_coupon) {
				$discount_amount = $discount_percent;
			}
			else {
				echo "Discount Amount Need To be < ". $intcondition_used_coupon;
				// exit();
			}

			// Check if there are available qti_coupon and qti_used_coupon
			$qti_coupon = $coupon['qti_coupon'];
			$qti_used_coupon = $coupon['qti_used_coupon'];

			if ($qti_coupon > 0 && $qti_used_coupon < $qti_coupon) {
				// Deduct one qti_coupon and increment qti_used_coupon
				$qti_used_coupon++;
				$qti_coupon--;

				// Update the qti_coupon and qti_used_coupon values in the database
				$update_qti_sql = "UPDATE tb_coupon SET qti_coupon = $qti_coupon, qti_used_coupon = $qti_used_coupon WHERE coupon_name = '$coupon_name'";
				execute($update_qti_sql);
			}
		}
	}
	// var_dump($intcondition_used_coupon);
	// die();
	// Calculate total_pay
	$total_pay = $grand_total - $discount_amount;


	$order_id = mt_rand(100000, 999999);
	$order_date = date('Y-m-d');

	// Fetch items from the tb_cart table
	$sql_items = "SELECT product_id, product_name, flavor, quantity FROM tb_cart";
	$items = executeResult($sql_items);

	$products_array = array();
	foreach ($items as $item) {
		$product_id = $item['product_id'];
		$product_name = $item['product_name'];
		$flavor = $item['flavor'];
		$quantity = $item['quantity'];

		$products_array[] = "Product: {$product_name}, Quantity: {$quantity}, Flavor: {$flavor}<br>";
	}

	$products_string = implode('', $products_array);
	// echo $products_string;
	// die();	
	// Display the product details
	// var_dump($user_id);
	// print_r($items);
	// die();

	// Fetch items from the tb_cart table
	$sql_items = "SELECT product_id, quantity FROM tb_cart";
	$items = executeResult($sql_items);

	foreach ($items as $item) {
		$product_id = $item['product_id'];
		$quantity = $item['quantity'];

		// Fetch the current product quantity from tb_warehouse
		$sql_current_qty = "SELECT product_qty FROM tb_warehouse WHERE product_id = '$product_id'";
		$current_qty_result = executeSingleResult($sql_current_qty);

		if ($current_qty_result) {
			$current_product_qty = $current_qty_result['product_qty'];
			$updated_product_qty = $current_product_qty - $quantity;

			// Update the product quantity in tb_warehouse
			$sql_update_qty = "UPDATE tb_warehouse SET product_qty = $updated_product_qty WHERE product_id = '$product_id'";
			execute($sql_update_qty);
		}
	}

	global $coupon_name;
	// var_dump($coupon_name);
	// die();
	// Insert order details into tb_order table
	$sql_insert = "INSERT INTO tb_order (order_id, user_id, name, email, phone, address, order_date, deposit, products,coupon_sale, total_pay, status) 
                    VALUES ('$order_id', '$user_id', '$name', '$email', '$phone', '$address', '$order_date', '$deposit', '$products_string','$coupon_name', '$total_pay', 'pending')";
	$insert_result = execute($sql_insert);
	// var_dump($insert_result);
	// die();
	if ($insert_result) {
		// Delete cart items after successful order
		$sql_delete_cart = "DELETE FROM tb_cart";
		execute($sql_delete_cart);

		// Display order success message
		$data = '
        <div class="order-success">
            <h1 class="order-title">Thank You!</h1>
            <h2 class="order-subtitle">Your Order Has Been Placed Successfully!</h2>
            <div class="order-details">
                <p><strong>Order ID:</strong> ' . $order_id . '</p>
                <p><strong>Items Purchased:</strong> ' . $products_string . '</p>
                <p><strong>Your Name:</strong> ' . $name . '</p>
                <p><strong>Your E-mail:</strong> ' . $email . '</p>
                <p><strong>Your Phone:</strong> ' . $phone . '</p>
                <p><strong>Total Amount Paid:</strong> ' . number_format($grand_total, 0) . '</p>
                <p><strong>Discount Amount:</strong> ' . number_format($discount_amount, 0) . '</p>
                <p><strong>Deposit Amount:</strong> ' . number_format($deposit, 0) . '</p>
                <p><strong>Total Pay:</strong> ' . number_format($total_pay, 0) . '</p>
                <p><strong>Payment Mode:</strong> ' . $pmode . '</p>
            </div>
        </div>';

		echo $data;
	}
}

?>