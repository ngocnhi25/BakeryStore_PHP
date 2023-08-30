<?php
require_once("../../../connect/connectDB.php");

if (isset($_POST['new_title'])) {
    $searchName = $_POST['new_title'];

    $result = executeResult("SELECT * FROM tb_news WHERE new_title LIKE '%$searchName%'");

    if ($result != null) {
        foreach ($result as $row) {
            echo "<p class='product-name'>".$row['new_title']."</p>";
        }
    } else {
        echo "<p class='notfound'>No results found.</p>";
    }
}
