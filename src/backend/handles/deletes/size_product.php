<?php
require_once("../../../connect/connectDB.php");

if(isset($_POST["id"])){
    $id = $_POST["id"];

    execute("DELETE FROM tb_product_size WHERE size_product_id = $id");
}

if(isset($_POST["cateID"])){
    echo $_POST["cateID"];
}

?>