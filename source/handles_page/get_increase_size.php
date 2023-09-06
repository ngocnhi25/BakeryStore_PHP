<?php
require '../connect/connectDB.php';

if (isset($_POST['size_id'])) {
    $size_id = $_POST['size_id'];

    $sale = executeSingleResult("SELECT * FROM tb_cate_size WHERE cate_size_id = $size_id");

    if($sale){
        echo $sale["increase_size"];
    } else {
        echo 'error';
    }
} else {
    echo "Invalid request";
}
?>