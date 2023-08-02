<?php 
require_once('../../../connect/connectDB.php');

if(isset($_POST['id'])){
    $id = $_POST['id'];

    $ads = executeSingleResult("SELECT * FROM tb_ads WHERE ads_id = $id");
    execute("DELETE FROM tb_ads WHERE ads_id = $id");

    unlink('../../../../'.$ads["image_ads"]);
}

echo 'ads.php';
?>