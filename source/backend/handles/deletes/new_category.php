<?php
session_start();
require_once("../../../connect/connectDB.php");

$user_id = '';

if (isset($_SESSION["auth_user"])) {
    $user_id = $_SESSION["auth_user"]["user_id"];
}

if(isset($_POST["id"])){
    $id = $_POST["id"];

    $news_cate = executeSingleResult("SELECT new_cate_name from tb_news_cate where new_cate_id = $id");

    $success = execute("DELETE from tb_news_cate where new_cate_id = $id");

    if ($success) {
        $content = 'has deleted a news category ' . $news_cate["new_cate_name"];
        historyOperation($user_id, $content);
    }
    
}
echo 'news/news_gallery.php';
?>