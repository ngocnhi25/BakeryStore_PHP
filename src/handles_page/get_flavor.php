<?php
// Include your database connection or any necessary configuration
require '../connect/connectDB.php';

if (isset($_POST['flavor'])) {
    $selectedFlavor = $_POST['flavor'];

    // Fetch the flavor color from the database based on the selected flavor
    $query = $conn->prepare('SELECT flavor_color FROM tb_flavor WHERE flavor_name = ?');
    $query->bind_param('s', $selectedFlavor);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $flavorColor = $row['flavor_color'];
        echo $flavorColor;
    } else {
        echo ""; // Return an empty string if the flavor is not found
    }
} else {
    echo "Invalid request";
}
?>
