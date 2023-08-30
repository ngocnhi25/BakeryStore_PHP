<?php
session_start();
require_once("../../../connect/connectDB.php");

$user_id = '';

if (isset($_SESSION["auth_user"])) {
    $user_id = $_SESSION["auth_user"]["user_id"];
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $imageDelete = executeSingleResult("SELECT * FROM tb_news WHERE new_id = $id");

    $imagesDelete[0] = $imageDelete["new_image"];
    // foreach ($thumbnails as $key => $thumb) {
    //     $imagesDelete[$key + 1] = $thumb["thumbnail"];
    // }
    foreach ($imagesDelete as $key => $imgDelete) {
        unlink('../../../../' . $imgDelete);
    }
    $success = execute("DELETE FROM tb_news WHERE new_id = $id");

    if ($success) {
        $content = 'has deleted a news ';
        historyOperation($user_id, $content);
    }
}

echo 'news/news.php';