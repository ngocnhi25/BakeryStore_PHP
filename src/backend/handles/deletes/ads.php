<?php 
require_once('../../../connect/connectDB.php');

if(isset($_POST['id'])){
    $id = $_POST['id'];

    $ads = executeSingleResult("SELECT * FROM tb_ads WHERE ads_id = $id");
    $typeAds = $ads["type_ads"];
    unlink('../../../../'.$ads["image_ads"]);
    $success = execute("DELETE FROM tb_ads WHERE ads_id = $id");

    if ($success) {
        $content = 'has deleted a advertisements ' . $typeAds;
        historyOperation($user_id, $content);
    }

}

echo 'ads.php';
?>