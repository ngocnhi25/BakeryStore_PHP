<?php
// Include your database connection or any necessary configuration
require '../connect/connectDB.php';

if (isset($_POST['size'])) {
    $selectedSize = $_POST['size'];

    // Fetch the increaseSize from the database based on the selected size
    $query = $conn->prepare('SELECT increase_size FROM tb_size WHERE size_name = ?');
    $query->bind_param('s', $selectedSize);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $increaseSize = $row['increase_size'];
        echo $increaseSize;
    } else {
        echo ""; // Return an empty string if the size is not found
    }
} else {
    echo "Invalid request";
}
?>
