<?php
require_once("../../../connect/connectDB.php");

if(isset($_POST["id"])){
    $id = $_POST["id"];

    execute("DELETE from tb_news_cate where new_cate_id = $id");
    
}
echo 'news/news_gallery.php';
?>