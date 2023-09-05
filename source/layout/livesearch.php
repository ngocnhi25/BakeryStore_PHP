<?php
    require_once("../connect/connectDB.php");
    if(isset($_POST['input'])){
        $input = $_POST['input'];
        
        $result = executeResult("SELECT * FROM tb_products WHERE product_name LIKE '{$input}%'");
        
        // Check if any rows were returned from the query
        if (count($result) > 0) {
            echo "<ul>";
            foreach ($result as $row) {
                echo "<li>" . $row['product_name'] . "</li>";
                echo "<li>" . $row['product_id'] . "</li>";
                echo "<li>" . $row['price'] . "</li>";
            }
            echo "</ul>";
        } else {
            echo "No matches found";
        }
    }
?>
