<?php
session_start();
require_once("../../../connect/connectDB.php");

$user_id = '';

if (isset($_SESSION["auth_user"])) {
    $user_id = $_SESSION["auth_user"]["user_id"];
}

if(isset($_POST["id"])){
    $id = $_POST["id"];

    $flavor = executeSingleResult("SELECT flavor_name from tb_flavor where flavor_id = $id");

    $success = execute("DELETE FROM tb_flavor WHERE flavor_id = $id");

    if ($success) {
        $content = 'has deleted a flavor ' . $flavor["flavor_name"];
        historyOperation($user_id, $content);
    }
}

echo 'products/gallery.php';
?>