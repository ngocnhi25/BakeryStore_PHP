<?php
// Kết nối đến cơ sở dữ liệu
$servername = "localhost"; // Thay đổi nếu cần
$username = "root"; // Thay đổi thành tên người dùng cơ sở dữ liệu của bạn
$password = ""; // Thay đổi thành mật khẩu của bạn
$dbname = "projecthk2"; // Thay đổi thành tên cơ sở dữ liệu của bạn

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// Xử lý dữ liệu từ mẫu trả hàng
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $order_id = $_POST["order_id"];
    $product_id = $_POST["product_id"];
    $reason = $_POST["reason"];

    // Xử lý tệp ảnh khách hàng
    $target_dir = "../../"; // Đường dẫn tới thư mục lưu trữ ảnh của bạn
    $target_file = $target_dir . basename($_FILES["customer_image"]["name"]);
    
    if (move_uploaded_file($_FILES["customer_image"]["tmp_name"], $target_file)) {
        // Tệp ảnh đã được tải lên thành công
        // Tiếp theo, chèn dữ liệu vào cơ sở dữ liệu

        // Chuẩn bị câu lệnh SQL để chèn dữ liệu
        $sql = "INSERT INTO tb_return (order_id, product_id, reason, customer_image) VALUES (?, ?, ?, ?)";
        
        // Sử dụng Prepared Statements để tránh SQL injection
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiss", $order_id, $product_id, $reason, $target_file);
        
        if ($stmt->execute()) {
            echo "Đã gửi đơn trả hàng thành công.";
            // Chuyển hướng người dùng về trang "purchase_order.php"
            header("Location: ../purchase_order.php");
            exit; 
        } else {
            echo "Có lỗi xảy ra khi gửi đơn trả hàng: " . $stmt->error;
        }

        // Đóng Prepared Statement
        $stmt->close();
    } else {
        echo "Có lỗi xảy ra khi tải lên tệp ảnh.";
    }
}

// Đóng kết nối đến cơ sở dữ liệu
$conn->close();
?>
