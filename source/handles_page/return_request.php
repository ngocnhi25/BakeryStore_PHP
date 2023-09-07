<?php
// Kết nối đến cơ sở dữ liệu
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'projecthk2';

$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

if (!$conn) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Lấy dữ liệu từ biểu mẫu
        $order_id = $_POST['order_id'];
        $product_ids = $_POST['product_ids'];
        $reason = $_POST['reason'];
        $image = $_FILES['image'];

        // Xử lý tải ảnh lên
        $targetDirectory = 'C:/xampp/htdocs/Group3-BakeryStore/src/public/images/returnImg/'; // Đường dẫn lưu trữ ảnh
        $targetFile = $targetDirectory . basename($image['name']);
        
        // Kiểm tra loại tệp
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');

        if (!in_array($imageFileType, $allowedExtensions)) {
            throw new Exception('Chỉ cho phép tải lên các tệp hình ảnh (jpg, jpeg, png, gif).');
        }

        if (!move_uploaded_file($image['tmp_name'], $targetFile)) {
            throw new Exception('Lỗi khi tải lên hình ảnh.');
        }

        // Thêm dữ liệu vào bảng tb_return
        $sql = "INSERT INTO tb_return (order_id, product_ids, reason, customer_image) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('issb', $order_id, $product_ids, $reason, $targetFile);

        if ($stmt->execute()) {
            echo json_encode(array('success' => 'Dữ liệu đã được chèn thành công.'));
        } else {
            echo json_encode(array('error' => 'Lỗi khi chèn dữ liệu.'));
        }
    } catch (Exception $e) {
        echo json_encode(array('error' => $e->getMessage()));
    }
}

// Đóng kết nối cơ sở dữ liệu
mysqli_close($conn);
?>
