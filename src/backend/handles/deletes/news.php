<?php
require_once('../../../connect/connectDB.php');

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
    execute("DELETE FROM tb_news WHERE new_id = $id");
}

echo 'news/news.php';