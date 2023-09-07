<?php
require_once('../../connect/connectDB.php');

$idCate = '';

$cates = executeResult("SELECT * FROM tb_news_cate");


if (isset($_POST["idCate"])) {
    $idCate = $_POST["idCate"];

    $nameCate = executeSingleResult("SELECT * FROM tb_news_cate WHERE new_cate_id = $idCate");
}


?>

<div class="table_category">
    <div>
        <h1>News Category</h1>
        <button onclick="createCate()" class="create" type="button">Add new category</button>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Category Name</th>
                        <th>Total News</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cates as $key => $cate) {
                        $cate_id = $cate["new_cate_id"];
                        $row = executeSingleResult("SELECT count(*) AS total FROM tb_news WHERE new_cate_id = $cate_id");
                    ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= $cate["new_cate_name"] ?></td>
                            <td><?php echo $row["total"] ?></td>
                            <td class="button">
                                <button class="update" onclick='updateCate(<?= $cate["new_cate_id"] ?>)' type="button">Update</button>
                                <?php if ($row["total"] > 0) { ?>
                                    <button class="notDelete delete">Delete</button>
                                <?php  } else { ?>
                                    <button class="delete" onclick='deleteCate(<?= $cate["new_cate_id"] ?>)' type="button">Delete</button>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    
    
    <div id="success">
        <div class="message">
            <p>
                <?php if ($idCate == null) {
                    echo "Added Successful!";
                } else {
                    echo "Update Successful!";
                } ?>
            </p>
            <div class="button-success">
                <button id="okButton">Ok</button>
            </div>
        </div>
    </div>
</div>
<script src="../../public/backend/js/news_gallery.js"></script>
<script type="text/javascript">
    $("#success").hide();

    

    function ajaxForm(url, formData) {
        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            contentType: false,
            processData: false,
            success: function(res) {
                if (res === 'success') {
                    showSuccessMessage("news/news_gallery.php");
                } else {
                    var errors = JSON.parse(res);
                    for (var key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            var value = errors[key];
                            $('.' + key).empty().append(value);
                        }
                    }
                }
            }
        })
    }
</script>