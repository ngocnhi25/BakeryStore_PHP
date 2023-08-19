<?php 
require_once('../../../connect/connectDB.php');

if(isset($_POST['id'])){
    $id = $_POST['id'];

    execute("update tb_news set deleted = 0 where new_id = $id");
}

echo 'news/news.php';
?>