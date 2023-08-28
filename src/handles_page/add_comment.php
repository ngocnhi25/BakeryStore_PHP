<?php
session_start();
require_once("../connect/connectDB.php");
date_default_timezone_set('Asia/Bangkok');
$date = date('Y-m-d H:i:s');

if (isset($_POST["content"])) {
    if (isset($_SESSION["auth_user"])) {
        $user_id = $_SESSION["auth_user"]["user_id"];
        $content = $_POST["content"];
        $product_id = $_POST["product_id"];

        $filteredText = replaceProfanity($content);

        execute("INSERT INTO tb_comments 
        (user_id, product_id, content, inbox_date) VALUES 
        ($user_id, $product_id, '$filteredText', $date)");

        echo "success";
    } else {
        echo "not logged in";
    }
}

function replaceProfanity($text)
{
    $profanityList = array("fuck", "sex", "cc", "concac", "dm");

    $words = explode(" ", $text);
    foreach ($words as &$word) {
        if (in_array(strtolower($word), $profanityList)) {
            $word = str_repeat("*", strlen($word));
        }
    }

    return implode(" ", $words);
}
