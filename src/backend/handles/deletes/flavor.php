<?php
require_once("../../../connect/connectDB.php");

if(isset($_POST["id"])){
    $id = $_POST["id"];
    $flavor = executeSingleResult("SELECT * FROM tb_flavor WHERE flavor_id = $id");
    $nameFlavor = $flavor["flavor_name"];
    execute("DELETE FROM tb_product_flavor WHERE flavor = '$nameFlavor'");
    
    execute("DELETE FROM tb_flavor WHERE flavor_id = $id");
}

echo 'products/flavor_and_size.php';
?>