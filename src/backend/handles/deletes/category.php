<?php
require_once("../../../connect/connectDB.php");

if(isset($_POST["id"])){
    $id = $_POST["id"];

    execute("DELETE from tb_category where cate_id = $id");
    execute("DELETE from tb_cate_size where cate_id = $id");
}
echo 'products/gallery.php';
?>