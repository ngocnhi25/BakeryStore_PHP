<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require '../connect/connection.php';
require '../connect/connectDB.php';
require_once "../User/vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

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
    $increaseSize = isset($_POST['increaseSize']) ? $_POST['increaseSize'] : 0;
    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : null;
    $size = $_POST['size'];

    $checkExistingItemQuery = "SELECT product_id, size, quantity, total_price, flavor FROM tb_cart WHERE user_id = $user_id AND product_id = $pid AND flavor = '$flavor'";
    $existingItem = executeSingleResult($checkExistingItemQuery);

    if ($existingItem && $existingItem['size'] == $size) {
        // Đã tồn tại sản phẩm cùng flavor và size, thực hiện logic cập nhật
        $updateQty = $existingItem['quantity'] + $pqty;
        $totalUpdate = ($pprice + $increaseSize) * $updateQty;
        $updateQuery = "UPDATE tb_cart SET quantity = $updateQty, total_price = $totalUpdate WHERE user_id = $user_id AND product_id = $pid AND flavor = '$flavor'";
        $updateQtyResult = execute($updateQuery);

        if ($updateQtyResult) {
            echo "Quantity updated successfully.";
        } else {
            echo "Failed to update quantity.";
        }
    } else {
        // Không có sản phẩm tương tự trong giỏ hàng hoặc có flavor khác hoặc size khác, thực hiện logic thêm mới
        $total = ($pprice + $increaseSize) * $pqty;
        $insertQuery = "INSERT INTO tb_cart (user_id, product_id, quantity, total_price, product_name, flavor, size) VALUES ($user_id, $pid, $pqty, $total, '$pname', '$flavor', $size)";
        $insertItems = execute($insertQuery);

        if ($insertItems) {
            echo "Item added to the cart.";
        } else {
            echo "Failed to add item to the cart.";
        }
    }
}

// Remove single items from cart
if (isset($_GET['remove'])) {
    $id = $_GET['remove'];

    $stmt = $conn->prepare('DELETE FROM tb_cart WHERE product_id=?');
    $stmt->bind_param('i', $id);
    $stmt->execute();

    $_SESSION['showAlert'] = 'block';
    $_SESSION['message'] = 'Item removed from the cart!';
    header('location: ../cart.php');
}

// Remove all items at once from cart
if (isset($_GET['clear'])) {
    $stmt = $conn->prepare('DELETE FROM tb_cart');
    $stmt->execute();
    $_SESSION['showAlert'] = 'block';
    $_SESSION['message'] = 'All Item removed from the cart!';
    // header('location:cart.php');
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
    $pmode = $_POST['pmode'];
    // var_dump($pmode);
    // die();
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
            } else {
                $discount_amount = 0;
                echo "Discount Amount Need To be < " . $intcondition_used_coupon;
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
    global $discount_amount;
    // Calculate total_pay
    $total_pay = $grand_total - $discount_amount;
    // var_dump($total_pay);
    // die();

    $order_id = mt_rand(100000, 999999);
    $order_date = date('Y-m-d H:i:s');

    // Fetch items from the tb_cart table
    $sql_items = "SELECT * FROM tb_cart";
    $items = executeResult($sql_items);

    $products_array = array();
    foreach ($items as $item) {
		$user_id = $item['user_id'];
        $product_id = $item['product_id'];
        $product_name = $item['product_name'];
        $flavor = $item['flavor'];
        $quantity = $item['quantity'];
        $size = $item['size'];
		$total_price = $item['total_price'];

        $products_array[] = "Product: {$product_name}, Quantity: {$quantity}, Flavor: {$flavor}, Size: {$size}<br>";

        // Fetch the current product quantity from tb_warehouse
        $sql_current_qty = "SELECT qty_warehouse FROM tb_products WHERE product_id = '$product_id'";
        $current_qty_result = executeSingleResult($sql_current_qty);

        if ($current_qty_result) {
            $current_product_qty = $current_qty_result['qty_warehouse'];
            $updated_product_qty = $current_product_qty - $quantity;

            // Update the product quantity in tb_warehouse
            $sql_update_qty = "UPDATE tb_products SET qty_warehouse = $updated_product_qty WHERE product_id = '$product_id'";
            execute($sql_update_qty);
        }

        $insertDetails = execute("INSERT INTO tb_order_detail (user_id, order_id, product_id, size, flavor, quantity, sale_product, total_money)
    	VALUES ('$user_id', $order_id, '$product_id', '$size', '$flavor', '$quantity', $total_pay, '$total_price')");

    }

    $products_string = implode('', $products_array);
    // var_dump($insertDetails);
    // die();

    // Insert order details into tb_order table
    global $coupon_name;
    $sql_insert = "INSERT INTO tb_order (order_id, user_id, receiver_name, receiver_email, receiver_phone, receiver_address, order_date, deposit, coupon_used, status, total_pay, payment)
                    VALUES ('$order_id', '$user_id', '$name', '$email', '$phone', '$address', '$order_date', '$deposit', '$coupon_name', 'prepare', $grand_total, '$pmode')";
    $insert_result = execute($sql_insert);
    // var_dump($insert_result);
    // die();

    if ($insert_result) {
        global $user_id;
        // Delete cart items after successful order
        execute("DELETE FROM tb_cart WHERE user_id = '$user_id'");

		// Display order success message
		$data = '
    <h1 class="order-title">Thank You!</h1>
    <h2 class="order-subtitle">Your Order Has Been Placed Successfully!</h2>
    <div class="order-success" style="background-color: green;">
        <div class="order-details">
            <table class="order-table" style="width: 100%;">
                <tr>
                    <td style="text-align: center;"><strong>Your Name:</strong></td>
                    <td style="text-align: center;">' . $name . '</td>
                </tr>
                <tr>
                    <td style="text-align: center;"><strong>' . $products_string . '</strong></td>
                </tr>
                <tr>
                    <td style="text-align: center;"><strong>Your E-mail:</strong></td>
                    <td style="text-align: center;">' . $email . '</td>
                </tr>
                <tr>
                    <td style="text-align: center;"><strong>Your Phone:</strong></td>
                    <td style="text-align: center;">' . $phone . '</td>
                </tr>
                <tr>
                    <td style="text-align: center;"><strong>Total Amount Paid:</strong></td>
                    <td style="text-align: center;">' . number_format($grand_total, 0) . '</td>
                </tr>
                <tr>
                    <td style="text-align: center;"><strong>Discount Amount:</strong></td>
                    <td style="text-align: center;">' . number_format($discount_amount, 0) . '</td>
                </tr>
                <tr>
                    <td style="text-align: center;"><strong>Deposit Amount:</strong></td>
                    <td style="text-align: center;">' . number_format($deposit, 0) . '</td>
                </tr>
                <tr>
                    <td style="text-align: center;"><strong>Total Pay:</strong></td>
                    <td style="text-align: center;">' . number_format($total_pay, 0) . '</td>
                </tr>
                <tr>
                    <td style="text-align: center;"><strong>Payment Mode:</strong></td>
                    <td style="text-align: center;">' . $pmode . '</td>
                </tr>
            </table>
        </div>
    </div>';


        $getEmail = executeSingleResult("SELECT tb_user.email FROM tb_order JOIN tb_user ON tb_order.user_id = tb_user.user_id WHERE tb_order.user_id = '$user_id'");
        $sendEmail = $getEmail['email'];

        // var_dump($sendEmail);
        // die();

        // Assuming you've already required the necessary PHPMailer files

		$to = $sendEmail;
		$subject = "Order Confirmation - Order ID: $order_id";
		$message = "Thank you for your order!\n\n";
		$message .= "Order ID: $order_id\n";
		$message .= "Items Purchased:\n$products_string\n";
		$message .= "Your Name: $name\n";
		$message .= "Your E-mail: $email\n";
		$message .= "Your Phone: $phone\n";
		$message .= "Total Amount Paid: " . number_format($grand_total, 0) . "\n";
		$message .= "Discount Amount: " . number_format($discount_amount, 0) . "\n";
		$message .= "Deposit Amount: " . number_format($deposit, 0) . "\n";
		$message .= "Total Pay: " . number_format($total_pay, 0) . "\n";
		$message .= "Payment Mode: $pmode\n";
		$message .= "Your order has been prepared";

        $mail = new PHPMailer(true);

        // SMTP configuration
        $mail->isSMTP();
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->SMTPAuth = true;
        $mail->Username = 'nhilnts2210037@fpt.edu.vn';
        $mail->Password = 'rzushtjlbjnppcft';
        $mail->FromName = "truong";

        // Sender and recipient
        $mail->setFrom('nhilnts2210037@fpt.edu.vn');
        $mail->addAddress($to);

        // Email content
        $mail->Subject = $subject;
        $mail->Body = nl2br($message); // Convert newlines to <br> tags for HTML output
        $mail->AltBody = strip_tags($message); // Plain text version of the message

        // Send email
        $mail->send();

        echo $data;
    }

}
