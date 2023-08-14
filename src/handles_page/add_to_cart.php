<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require '../connect/connection.php';
if (isset($_POST['flavor'])) {
	$selectedFlavor = $_POST['flavor'];
	echo "Received flavor: " . $selectedFlavor;
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

		echo '<div class="alert alert-success alert-dismissible mt-2">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Item added to your cart!</strong>
        </div>';
	} elseif ($size_int == $existing_size) {
		// If product with the same product ID and size is already in cart, update the quantity and total price
		// var_dump($size_int,$sexisting_size);
		$new_qty = $existing_qty + $pqty;
		$new_total_price = (intval($existing_price) + intval($increaseSize)) * intval($new_qty);
		$query = $conn->prepare('UPDATE tb_cart SET quantity=?, total_price=? WHERE product_id=? AND size=?');
		$query->bind_param('iiss', $new_qty, $new_total_price, $pid, $size);
		$query->execute();

		echo '<div class="alert alert-success alert-dismissible mt-2">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Quantity updated in your cart!</strong>
        </div>';
	} else {
		// Check if the size exists for the given product ID in the cart
		var_dump($size_int, $existing_size);
		$size_exists_query = $conn->prepare('SELECT size FROM tb_cart WHERE product_id=? AND size=?');
		$size_exists_query->bind_param('is', $pid, $size_int);
		$size_exists_query->execute();
		$size_exists_query->store_result();

		if ($size_exists_query->num_rows == 0) {
			var_dump($size_int, $existing_size);
			// If product with the same product ID is in cart but different size, insert as a new item
			$new_qty = $existing_qty + $pqty;
			$new_total_price = (intval($existing_price) + intval($increaseSize)) * intval($new_qty);
			$insert_query = $conn->prepare('INSERT INTO tb_cart (product_id, quantity, total_price, product_name, price, flavor, size) VALUES (?, ?, ?, ?, ?, ?, ?)');
			$insert_query->bind_param('iiisiss', $pid, $new_qty, $new_total_price, $pname, $pprice, $flavor, $size);
			$insert_query->execute();

			echo '<div class="alert alert-success alert-dismissible mt-2">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Item added to your cart as a new item with a different size!</strong>
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
if (isset($_POST['action']) && $_POST['action'] == 'order') {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$grand_total = $_POST['grand_total'];
	$address = $_POST['address'];
	$pmode = $_POST['pmode'];

	$deposit = $grand_total * 0.3; // Calculate deposit as 30% of grand_total

	// Initialize discount related variables
	$coupon_name = $_POST['coupon_name'];
	$discount_percent = 0;
	$discount_amount = 0;

	if (!empty($coupon_name)) {
		// Get discount from tb_coupon based on the coupon name
		$stmt_coupon = $conn->prepare('SELECT discount FROM tb_coupon WHERE coupon_name = ?');
		$stmt_coupon->bind_param('s', $coupon_name);
		$stmt_coupon->execute();
		$stmt_coupon->bind_result($discount_percent);
		$stmt_coupon->fetch();
		$stmt_coupon->close();

		// Calculate discount amount
		$discount_amount = $grand_total * ($discount_percent / 100);
	}

	// Calculate total_pay
	$total_pay = $grand_total - $discount_amount;

	$order_id = mt_rand(100000, 999999);
	$order_date = date('Y-m-d');

	// Lấy thông tin vị của từng sản phẩm và lưu vào mảng flavors
	$flavors = [];
	$stmt_flavor = $conn->prepare('SELECT flavor FROM tb_cart WHERE product_id = ?');
	$stmt_flavor->bind_param('i', $product_id);

	// Loop through the items in the cart and fetch flavor information
	foreach ($items as $item) {
		$product_id = $item['product_id'];
		$stmt_flavor->execute();
		$stmt_flavor->bind_result($flavor);
		$stmt_flavor->fetch();
		$flavors[] = $flavor;
	}
	$stmt_flavor->close();
	$flavors_string = implode(', ', $flavors);

	$stmt = $conn->prepare('INSERT INTO tb_order (order_id, name, email, phone, address, order_date, deposit, products, flavors, total_pay, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, "pending")');
	$stmt->bind_param('isssssdsds', $order_id, $name, $email, $phone, $address, $order_date, $deposit, $products, $flavors_string, $total_pay);
	$stmt->execute();

	$stmt2 = $conn->prepare('DELETE FROM tb_cart');
	$stmt2->execute();

	$data = '
    <div class="order-success">
        <h1 class="order-title">Thank You!</h1>
        <h2 class="order-subtitle">Your Order Has Been Placed Successfully!</h2>
        <div class="order-details">
            <p><strong>Order ID:</strong> ' . $order_id . '</p>
            <p><strong>Items Purchased:</strong> ' . $products . '</p>
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

?>