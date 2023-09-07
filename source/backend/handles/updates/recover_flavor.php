<?php
session_start();
require_once("../../../connect/connectDB.php");

$content = $user_id = $flavor_name = '';

if (isset($_SESSION["auth_user"])) {
    $user_id = $_SESSION["auth_user"]["user_id"];
}

if(isset($_POST["id"])){
    $id = $_POST["id"];
    $flavor = executeSingleResult("SELECT * FROM tb_flavor where flavor_id = $id");
    $flavor_name = $flavor["flavor_name"];

    $success = execute("UPDATE tb_flavor SET deleted_flavor = 0 WHERE flavor_id = $id");

    if($success){
        $content = 'has updated the status for flavor ' . $flavor_name . ' to display';
        historyOperation($user_id, $content);
    }
}

echo 'products/gallery.php';
?>