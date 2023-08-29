<?php
require_once("../connect/connectDB.php");
require APPPATH . "User/vendor/phpmailer/src/PHPMailer.php";
require APPPATH . "User/vendor/phpmailer/src/Exception.php";
require APPPATH . "User/vendor/phpmailer/src/OAuth.php";
require APPPATH . "User/vendor/phpmailer/src/POP3.php";
require APPPATH . "User/vendor/phpmailer/src/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

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

function sendEmail($to, $subject, $message)
{
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPDebug = SMTP::DEBUG_OFF;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->SMTPAuth = true;
    $mail->Username = 'nhilnts2210037@fpt.edu.vn';
    $mail->Password = 'rzushtjlbjnppcft';
    $mail->FromName = "truong";

    $mail->setFrom('nhilnts2210037@fpt.edu.vn');
    $mail->addAddress($to);
    $mail->Subject = $subject;
    $mail->msgHTML($message);

    if ($mail->send()) {
        return true;
    } else {
        return false;
    }
}

function updateStatusToCompleted($order_id)
{
    // Thực hiện truy vấn để xóa đơn hàng với ID đã cho
    $sql = "DELETE FROM tb_order WHERE order_id = $order_id";
    $getEmail = executeSingleResult("SELECT tb_user.email FROM tb_order JOIN tb_user ON tb_order.user_id = tb_user.user_id WHERE tb_order.user_id = '$user_id'");
    $sendEmail = $getEmail['email'];

    // Gọi hàm execute để thực hiện truy vấn
    if (execute($sql)) {
        // Nếu truy vấn thực thi thành công
        $message = "Status updated to completed. Order deleted successfully.";

        // Lấy thông tin của khách hàng từ đơn hàng (địa chỉ email)
        $customer_email = $sendEmail; // Thay bằng địa chỉ email thực tế
        $subject = "Order Completion - Order ID: $order_id";
        $email_message = "Your order with ID $order_id has been completed successfully.";

        // Gửi email thông báo hoàn thành đơn hàng
        $email_sent = sendEmail($customer_email, $subject, $email_message);

        if ($email_sent) {
            $message .= " Email notification sent.";
        } else {
            $message .= " Error sending email notification.";
        }
    } else {
        // Nếu có lỗi trong quá trình thực hiện truy vấn
        $message = "Error deleting order after status update.";
    }

    // Trả về thông báo kết quả
    return $message;
}


function updateStatusToCancelledOrReturned($order_id, $new_status)
{
    // Lấy địa chỉ email của khách hàng từ cơ sở dữ liệu
    $getEmail = executeSingleResult("SELECT tb_user.email FROM tb_order JOIN tb_user ON tb_order.user_id = tb_user.user_id WHERE tb_order.order_id = '$order_id'");
    $customer_email = $getEmail['email'];

    $order_detail_sql = "SELECT product_id, quantity FROM tb_order_detail WHERE order_id = $order_id";
    $order_details = executeResult($order_detail_sql);

    foreach ($order_details as $order_detail) {
        $product_id = $order_detail['product_id'];
        $quantity = $order_detail['quantity'];

        $update_product_sql = "UPDATE tb_products SET qty_warehouse = qty_warehouse + $quantity WHERE product_id = $product_id";
        execute($update_product_sql);
    }

    if ($new_status === "return" && isset($_POST["reason"]) && isset($_FILES["image"])) {
        $message = processReturnRequest($order_id);

        // Gửi email thông báo yêu cầu trả hàng
        $subject = "Return Request - Order ID: $order_id";
        $email_message = "We have received your return request for order ID $order_id. Please provide the reason and attach an image for the return.";
        $email_sent = sendEmail($customer_email, $subject, $email_message);

        if ($email_sent) {
            $message .= " Return request email sent.";
        } else {
            $message .= " Error sending return request email.";
        }
    } else {
        $message = "Status updated to cancelled. Product quantities updated.";
    }

    return $message;
}



function updateStatusToPending($order_id)
{
    // Thực hiện truy vấn để cập nhật trạng thái đơn hàng thành "pending"
    $sql = "UPDATE tb_order SET status = 'pending' WHERE order_id = $order_id";

    // Gọi hàm execute để thực hiện truy vấn
    if (execute($sql)) {
        // Nếu truy vấn thực thi thành công
        $message = "Status updated to pending.";

        // Lấy địa chỉ email của khách hàng từ cơ sở dữ liệu
        $getEmail = executeSingleResult("SELECT tb_user.email FROM tb_order JOIN tb_user ON tb_order.user_id = tb_user.user_id WHERE tb_order.order_id = '$order_id'");
        $customer_email = $getEmail['email'];

        // Gửi email thông báo cập nhật trạng thái đơn hàng
        $subject = "Order Update - Order ID: $order_id";
        $email_message = "Your order with ID $order_id is now pending confirmation.";
        $email_sent = sendEmail($customer_email, $subject, $email_message);

        if ($email_sent) {
            $message .= " Email notification sent.";
        } else {
            $message .= " Error sending email notification.";
        }
    } else {
        // Nếu có lỗi trong quá trình thực hiện truy vấn
        $message = "Error updating order status to pending.";
    }

    // Trả về thông báo kết quả
    return $message;
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