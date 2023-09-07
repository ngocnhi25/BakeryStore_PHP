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

try {
    // Kiểm tra xem 'order_id' đã được gửi trong yêu cầu POST
    if (isset($_POST['order_id'])) {
        $order_id = $_POST['order_id'];

        // Truy vấn danh sách sản phẩm từ bảng tb_order_detail và nối với tb_product
        $sql = "SELECT od.*, p.product_name FROM tb_order_detail AS od
                INNER JOIN tb_products AS p ON od.product_id = p.product_id
                WHERE od.order_id = $order_id";

        $result = mysqli_query($conn, $sql);

        if (!$result) {
            throw new Exception("Lỗi truy vấn: " . mysqli_error($conn));
        }

        $products = array();

        // Lặp qua kết quả truy vấn và thêm sản phẩm vào mảng $products
        while ($row = mysqli_fetch_assoc($result)) {
            $product = array(
                'id' => $row['product_id'],
                'name' => $row['product_name'],
                'size' => $row['size'],
                'flavor' => $row['flavor'],
                'quantity' => $row['quantity'],
                // Thêm các trường khác của sản phẩm nếu cần
            );
            $products[] = $product;
        }

        // Trả về danh sách sản phẩm dưới dạng JSON
        echo json_encode($products);
    } else {
        // Nếu 'order_id' không tồn tại trong yêu cầu POST, bạn có thể trả về thông báo lỗi hoặc xử lý theo cách khác.
        echo json_encode(array('error' => 'Missing order_id in POST request'));
    }
} catch (Exception $e) {
    // Xử lý lỗi
    echo json_encode(array('error' => $e->getMessage()));
}

// Đóng kết nối cơ sở dữ liệu
mysqli_close($conn);
?>
