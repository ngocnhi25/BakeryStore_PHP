<?php
require_once("../../../connect/connectDB.php");

if(isset($_POST["id"])){
    $id = $_POST["id"];

    execute("delete from tb_category where cate_id = $id");
}
echo 'products/category.php';
?>