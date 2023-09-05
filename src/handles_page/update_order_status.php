<?php
require_once "../connect/connectDB.php";
require_once "../User/vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["order_id"]) && isset($_POST["new_status"])) {
        $order_id = $_POST["order_id"];
        $new_status = $_POST["new_status"];

        if ($new_status === "completed") {
            $message = updateStatusToCompleted($order_id);
        } elseif ($new_status === "cancelled" || $new_status === "return") {
            $message = updateStatusToCancelledOrReturned($order_id, $new_status);
        } elseif ($new_status === "shipping") {
            $message = updateStatusToShipping($order_id);
        } else {
            $message = "Invalid status update.";
        }

        echo $message;
    } else {
        echo "Invalid input data.";
    }
} else {
    echo "Invalid request method.";
}

function updateStatusToCompleted($order_id)
{
    // Thực hiện truy vấn để xóa đơn hàng với ID đã cho
    $delete_sql = "DELETE FROM tb_order WHERE order_id = $order_id";

    // Lấy thông tin email của người dùng
    $getEmail = executeSingleResult("SELECT tb_user.email FROM tb_order JOIN tb_user ON tb_order.user_id = tb_user.user_id WHERE tb_order.order_id = $order_id");
    $user_email = $getEmail['email'];

    // Gọi hàm execute để thực hiện truy vấn
    if (execute($delete_sql)) {
        // Gửi email thông báo
        sendOrderCompletedEmail($user_email);
        return "Status updated to completed. Order deleted successfully and email sent.";
    } else {
        return "Error deleting order after status update.";
    }
}

function sendOrderCompletedEmail($user_email)
{
    $mail = createMailer();

    // Cài đặt người gửi và người nhận email
    $mail->setFrom('nhilnts2210037@fpt.edu.vn', 'NgocNhiBakery');
    $mail->addAddress($user_email);

    // Thiết lập nội dung email
    $mail->isHTML(true);
    $mail->Subject = 'Order Status Update';
    $mail_template = "
        <h2>Order Status Update</h2>
        <p>Dear Customer, $user_email</p>
        <p>We would like to inform you that your order has been successfully completed.</p>
        <p>Thank you for choosing NgocNhiBakery. If you have any questions or need further assistance, please feel free to contact us.</p>
        <p>Best regards,</p>
        <p>The NgocNhiBakery Team</p>
    ";
    $mail->Body = $mail_template;

    // Gửi email
    if ($mail->send()) {
        return true;
    } else {
        return false;
    }
}

function updateStatusToCancelledOrReturned($order_id, $new_status)
{
    // Lấy thông tin chi tiết đơn hàng
    $order_detail_sql = "SELECT product_id, quantity FROM tb_order_detail WHERE order_id = $order_id";
    $order_details = executeResult($order_detail_sql);

    foreach ($order_details as $order_detail) {
        $product_id = $order_detail['product_id'];
        $quantity = $order_detail['quantity'];

        // Cập nhật số lượng sản phẩm trong kho
        $update_product_sql = "UPDATE tb_products SET qty_warehouse = qty_warehouse + $quantity WHERE product_id = $product_id";
        execute($update_product_sql);
    }

    if ($new_status === "return" && isset($_POST["product_id"]) && isset($_POST["reason"]) && isset($_FILES["image"])) {
        processReturnRequest($order_id);
    } else {
        processCancelledRequest($order_id);
    }
}

function processReturnRequest($order_id)
{
    $reason = $_POST["reason"];
    $image = "public/images/returnImg/" . $_FILES["image"]["name"];

    $order_detail_sql = "SELECT product_id FROM tb_order_detail WHERE order_id = $order_id";
    $order_details = executeResult($order_detail_sql);

    foreach ($order_details as $order_detail) {
        $product_id = $order_detail['product_id'];

        $insert_return_sql = "INSERT INTO tb_return (order_id, reason, customer_image, product_id) VALUES ($order_id, '$reason', '$image', $product_id)";
        if (!execute($insert_return_sql)) {
            $message = "Error inserting return data.";
            break;
        }
    }

    $message = "Order returned successfully.";

    return $message;
}

function processCancelledRequest($order_id)
{
    $reason = $_POST["reason"];

    $order_detail_sql = "SELECT product_id FROM tb_order_detail WHERE order_id = $order_id";
    $order_details = executeResult($order_detail_sql);

    foreach ($order_details as $order_detail) {
        $product_id = $order_detail['product_id'];

        // Insert cancellation record into tb_cancelled table
        $insert_return_sql = "INSERT INTO tb_cancelled (reason, order_id, product_id) VALUES ('$reason', $order_id, $product_id)";
        if (!execute($insert_return_sql)) {
            $message = "Error inserting return data.";
            break;
        }
    }

    $message = "Order cancelled successfully.";

    return $message;
}

function updateStatusToShipping($order_id)
{
    // Thực hiện truy vấn để cập nhật trạng thái đơn hàng thành "pending"
    $sql = "UPDATE tb_order SET status = 'shipping' WHERE order_id = $order_id";

    // Gọi hàm execute để thực hiện truy vấn
    if (execute($sql)) {
        // Gửi email thông báo
        $user_email = getUserEmailForOrder($order_id);
        sendShippingEmail($user_email);

        return "Order status updated to shipping.";
    } else {
        return "Error updating order status to shipping.";
    }
}

function sendShippingEmail($user_email)
{
    $mail = createMailer();

    // Cài đặt người gửi và người nhận email
    $mail->setFrom('nhilnts2210037@fpt.edu.vn', 'NgocNhiBakery');
    $mail->addAddress($user_email);

    // Thiết lập nội dung email
    $mail->isHTML(true);
    $mail->Subject = 'Order Status Update';
    $mail_template = "
        <h2>Order Status Update</h2>
        <p>Dear Customer,</p>
        <p>We would like to inform you that the status of your order has been updated to 'Shipping'.</p>
        <p>Your order is on its way to you, and we will provide you with tracking information soon.</p>
        <p>Thank you for choosing NgocNhiBakery. If you have any questions or need further assistance, please feel free to contact us.</p>
        <p>Best regards,</p>
        <p>The NgocNhiBakery Team</p>
    ";
    $mail->Body = $mail_template;

    // Gửi email
    if ($mail->send()) {
        return true;
    } else {
        return false;
    }
}

function createMailer()
{
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = 'smtp.gmail.com';
    $mail->Username = 'nhilnts2210037@fpt.edu.vn';
    $mail->Password = 'rzushtjlbjnppcft';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    return $mail;
}

function getUserEmailForOrder($order_id)
{
    $sql = "SELECT tb_user.email FROM tb_order JOIN tb_user ON tb_order.user_id = tb_user.user_id WHERE tb_order.order_id = $order_id";
    $result = executeSingleResult($sql);
    return $result['email'];
}
?>
