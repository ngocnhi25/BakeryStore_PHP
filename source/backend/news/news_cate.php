<?php
require_once("../../connect/connectDB.php");


$id = $title = '';
$sAdded = [];



if (isset($_POST["id"])) {
    $id = $_POST["id"];
    if (isset($_POST["title"])) {
        $title = $_POST["title"];
    }

    $cate = executeSingleResult("SELECT * FROM tb_news_cate WHERE new_cate_id = $id");

    // $sizesUpdate = executeResult("SELECT * FROM tb_cate_size cs INNER JOIN tb_size s ON cs.size_id = s.size_id WHERE cate_id = $id");
}


?>

<head>
    <style>
        .box-input-cate input {
            width: 300px;
            padding: 10px;
            /* Increase padding for better visual appearance */
            border: 1px solid #ccc;
            /* Adjust border color */
            outline: none;
            border-radius: 5px;
            /* Increase border-radius for rounded corners */
            font-size: 16px;
            color: #333;
            /* Adjust text color */
            transition: 0.5s;
        }
    </style>

</head>
<div>
    <div>
        <h1>
            <?= ($title != null ? $title : 'Create new category') ?>
        </h1>
        <form id="cateForm" method="post" action="">
            <div>
                <?php if ($id != null) { ?>
                    <input id="idUpdate" type="text" name="id" value="<?= $id ?>" style="display: none;">
                <?php } ?>
                <label for="">Category name</label> <br>
                <div class="box-input-cate">
                    <input id="input-name" type="text" name="name"
                        value="<?= ($id != null ? $cate["new_cate_name"] : '') ?>">
                </div>
                <p class="errorCateName" style="color: red;"></p>
            </div>

        </form>
        <button id="submitAdd" class="submit" type="button">Save</button>
    </div>
    <div id="success">
        <div class="message">
            <p>Successfully added a category!</p>
            <div class="button-success">
                <button id="okButton">Ok</button>
            </div>
        </div>
    </div>
</div>
<script>
    $("#success").hide();
    $("#submitAdd").click(function (e) {
        e.preventDefault();
        $(document).ready(function () {
            var formData = new FormData($("#cateForm")[0]);

            $.ajax({
                type: "POST",
                url: 'handles/creates/news_category.php',
                data: formData,
                contentType: false,
                processData: false,
                success: function (res) {
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
        })
    })
</script>