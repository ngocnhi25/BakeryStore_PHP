<?php
// Include your database connection or any necessary configuration
require '../connect/connectDB.php';

if (isset($_POST['size'])) {
    $selectedSize = $_POST['size'];

    // Fetch the increaseSize from the database based on the selected size
    $query = $conn->prepare('SELECT cs.increase_size
                             FROM tb_size s
                             JOIN tb_cate_size cs ON s.size_id = cs.size_id
                             WHERE s.size_name = ?');
    $query->bind_param('s', $selectedSize);
    $query->execute();
    $query->bind_result($increaseSize);
    $query->fetch();

    if ($increaseSize !== null) {
        echo $increaseSize;
    } else {
        echo ""; // Return an empty string if the size is not found
    }
} else {
    echo "Invalid request";
}
?>