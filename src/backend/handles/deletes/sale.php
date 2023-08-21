<?php
require_once("../../../connect/connectDB.php");

if(isset($_POST["id"])){
    $id = $_POST["id"];
    execute("DELETE FROM tb_sale WHERE sale_id = $id");
}

echo 'sale.php';
?>