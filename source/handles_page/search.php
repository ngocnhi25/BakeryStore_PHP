<?php
// Include your database connection or any necessary files here
require_once("../connect/connection.php");
require_once("handle_calculate.php");

if (isset($_POST['query'])) {
    $searchTerm = $_POST['query'];

    // Perform a database query to retrieve search results based on $searchTerm
    // Modify the query according to your database structure and table names
    $query = "SELECT * FROM tb_products WHERE product_name LIKE '%$searchTerm%'";
    $result = mysqli_query($conn, $query); // Use your database connection variable here

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='product-wrapper'>";
                echo "<div class='product-container'>";
                echo "<img src='../" . $row['image'] . "' class='product-image' alt='Product Image'>";
                echo "<div class='product-details'>";
                echo "<p class='product-name'><a href='details.php?product_id=" . $row['product_id'] . "'>" . $row['product_name'] . "</a></p>";
                echo "<p class='product-price'>Price: " . displayPrice($row['price']) . " ₫</p>";
                echo "</div>";
                echo "</div>";
                echo "</div>";

            }
        } else {
            echo "No results found.";
        }
    } else {
        echo "Error executing the search query.";
    }

    // Close the database connection
    mysqli_close($conn);
}
?>