<?php
require_once("../connect/connectDB.php");
require_once("../User/vendor/autoload.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["order_id"]) && isset($_POST["new_status"])) {
        $order_id = $_POST["order_id"];
        $new_status = $_POST["new_status"];

        if ($new_status === "completed") {
            $message = updateStatusToCompleted($order_id);
        } elseif ($new_status === "cancelled" || $new_status === "return") {
            $message = updateStatusToCancelledOrReturned($order_id, $new_status);
        } elseif ($new_status === "pending") {
            $message = updateStatusToPending($order_id);
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
    $delete_sql = "UPDATE tb_order SET status = 'update' WHERE order_id = '$order_id'";

    // Lấy thông tin email của người dùng
    $getEmail = executeSingleResult("SELECT tb_user.email FROM tb_order JOIN tb_user ON tb_order.user_id = tb_user.user_id WHERE tb_order.order_id = $order_id");
    $user_email = $getEmail['email'];

    // Gọi hàm execute để thực hiện truy vấn
    if (execute($delete_sql)) {
        // Gửi email thông báo
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = 'smtp.gmail.com';
        $mail->Username = 'nhilnts2210037@fpt.edu.vn';
        $mail->Password = 'rzushtjlbjnppcft';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

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
            // Trả về thông báo kết quả
            echo "Status updated to completed. Order deleted successfully and email sent.";
        } else {
            // Nếu gửi email thất bại
            echo "Status updated to completed. Order deleted successfully, but email sending failed.";
        }
    } else {
        // Nếu có lỗi trong quá trình thực hiện truy vấn
        return "Error deleting order after status update.";
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
        $product_id = $_POST["product_id"];
        $reason = $_POST["reason"];
        $image = "public/images/returnImg/" . $_FILES["image"]["name"];

        // Kiểm tra xem product_id có hợp lệ không
        if ($new_status === "return" && isset($_POST["product_id"]) && isset($_POST["reason"]) && isset($_FILES["image"])) {
            $product_id = $_POST["product_id"];
            $reason = $_POST["reason"];
            $image = "public/images/returnImg/" . $_FILES["image"]["name"];

            // Kiểm tra xem product_id có hợp lệ không
            if ($product_id) {
                // Gọi hàm execute để thực hiện truy vấn
                $insert_return_sql = "INSERT INTO tb_return (order_id, reason, customer_image, product_id) VALUES ($order_id, '$reason', '$image', $product_id)";

                if (execute($insert_return_sql)) {
                    echo json_encode("success"); // Return success as JSON
                } else {
                    echo json_encode("error");
                }
            } else {
                echo json_encode("invalid_product_id");
            }
        }

    } else {
        // Thực hiện truy vấn để cập nhật trạng thái đơn hàng thành 'cancelled'
        $updateCancelled = execute("UPDATE tb_order SET status = 'cancelled' WHERE order_id = '$order_id'");
        $message = "Status updated to cancelled. Product quantities updated.";
    }

    // Trả về thông báo kết quả
    return $message;
}

function getUserEmailForOrder($order_id)
{
    $sql = "SELECT tb_user.email FROM tb_order JOIN tb_user ON tb_order.user_id = tb_user.user_id WHERE tb_order.order_id = $order_id";
    $result = executeSingleResult($sql);
    return $result['email'];
}

function sendReturnEmail($user_email, $order_id)
{
    $mail = new PHPMailer;
    $mail->isSMTP();
    // Cấu hình thông tin SMTP và email
    $mail->SMTPAuth = true;
    $mail->Host = 'smtp.gmail.com';
    $mail->Username = 'nhilnts2210037@fpt.edu.vn';
    $mail->Password = 'rzushtjlbjnppcft';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Cài đặt người gửi và người nhận email
    $mail->setFrom('nhilnts2210037@fpt.edu.vn', 'NgocNhiBakery');
    $mail->addAddress($user_email);

    // Thiết lập nội dung email
    $mail->isHTML(true);
    $mail->Subject = 'Order Return Confirmation';
    $mail_template = "
        <h2>Order Return Confirmation</h2>
        <p>Dear Customer,</p>
        <p>We have received your return request for order #$order_id.</p>
        <p>Your request is being processed and we will get back to you soon.</p>
        <p>Thank you for choosing NgocNhiBakery. If you have any questions or need further assistance, please feel free to contact us.</p>
        <p>Best regards,</p>
        <p>The NgocNhiBakery Team</p>
    ";
    $mail->Body = $mail_template;

    // Gửi email
    $mail->send();
}




function updateStatusToPending($order_id)
{
    // Thực hiện truy vấn để cập nhật trạng thái đơn hàng thành "pending"
    $sql = "UPDATE tb_order SET status = 'pending' WHERE order_id = $order_id";

    // Gọi hàm execute để thực hiện truy vấn
    if (execute($sql)) {
        // Nếu truy vấn thực thi thành công
        $message = "Order status updated to pending.";

        // Gửi email thông báo
        $user_email = getUserEmailForOrder($order_id);
        sendPendingEmail($user_email);

    } else {
        // Nếu có lỗi trong quá trình thực hiện truy vấn
        $message = "Error updating order status to pending.";
    }

    // Trả về thông báo kết quả
    return $message;
}

function sendPendingEmail($user_email)
{
    $mail = new PHPMailer;
    $mail->isSMTP();
    // Cấu hình thông tin SMTP và email
    $mail->SMTPAuth = true;
    $mail->Host = 'smtp.gmail.com';
    $mail->Username = 'nhilnts2210037@fpt.edu.vn';
    $mail->Password = 'rzushtjlbjnppcft';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Cài đặt người gửi và người nhận email
    $mail->setFrom('nhilnts2210037@fpt.edu.vn', 'NgocNhiBakery');
    $mail->addAddress($user_email);

    // Thiết lập nội dung email
    $mail->isHTML(true);
    $mail->Subject = 'Order Status Update';
    $mail_template = "
        <h2>Order Status Update</h2>
        <p>Dear Customer,</p>
        <p>We would like to inform you that the status of your order has been updated to 'Pending'.</p>
        <p>Your order is being processed, and we will notify you once it has been completed.</p>
        <p>Thank you for choosing NgocNhiBakery. If you have any questions or need further assistance, please feel free to contact us.</p>
        <p>Best regards,</p>
        <p>The NgocNhiBakery Team</p>
    ";
    $mail->Body = $mail_template;

    // Gửi email
    $mail->send();
}



function processReturnRequest($order_id)
{
    $reason = $_POST["reason"];
    $image = "public/images/returnImg/" . $_FILES["image"]["name"];

    $update_order_sql = "UPDATE tb_order SET status = 'return' WHERE order_id = $order_id";
    if (execute($update_order_sql)) {
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
    } else {
        $message = "Error updating order status.";
    }

    return $message;
}
?>