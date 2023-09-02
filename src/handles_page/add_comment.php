<?php
session_start();
require_once("../connect/connectDB.php");
date_default_timezone_set('Asia/Bangkok');
$date = date('Y-m-d H:i:s');

if (isset($_SESSION["auth_user"])) {
    $user_id = $_SESSION["auth_user"]["user_id"];
    if (isset($_POST["content"])) {
        $content = $_POST["content"];
        $parent_id = $_POST["parent_id"];
        $product_id = $_POST["product_id"];
        $reply_id = $_POST["reply_id"];

        $filteredText = replaceProfanity($content);

        $success = execute("INSERT INTO tb_comments 
        (product_id, user_id, content, parent_id, reply_id, inbox_date) VALUES 
        ($product_id, $user_id, '$filteredText', $parent_id, $reply_id,'$date')");

        if($success){
            echo "success";
        }
    }
} else {
    echo "notLoggedIn";
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
