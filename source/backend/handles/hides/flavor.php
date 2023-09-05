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

    $success = execute("UPDATE tb_flavor SET deleted_flavor = 1 WHERE flavor_id = $id");

    if ($success) {
        $content = 'has temporarily suspended the operation of flavor ' . $flavor["flavor_name"];
        historyOperation($user_id, $content);
    }
}

echo 'products/gallery.php';
?>