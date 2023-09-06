<?php
require_once("../../connect/connectDB.php");


$id = $title = '';
$sAdded = [];

$sizes = executeResult("SELECT * FROM tb_size");

if (isset($_POST["id"])) {
    $id = $_POST["id"];
    if (isset($_POST["title"])) {
        $title = $_POST["title"];
    }

    $cate = executeSingleResult("SELECT * FROM tb_category WHERE cate_id = $id");

    $sizesUpdate = executeResult("SELECT * FROM tb_cate_size cs INNER JOIN tb_size s ON cs.size_id = s.size_id WHERE cate_id = $id");
}


?>
<div>
    <div class="add-category">
        <h1><?= ($title != null ? $title : 'Create new category') ?></h1>
        <form id="cateForm" method="post" action="">
            <div>
                <?php if ($id != null) { ?>
                    <input id="idUpdate" type="text" name="id" value="<?= $id ?>" style="display: none;">
                <?php } ?>
                <p>Category name:</p>
                <div class="box-input">
                    <input id="input-name" type="text" name="name" value="<?= ($id != null ? $cate["cate_name"] : '') ?>">
                </div>
                <p class="errorCateName" style="color: red;"></p>
            </div>
            <div style="display: flex; gap: 1rem; margin-top: 20px;">
                <div>
                    <table>
                        <thead>
                            <tr>
                                <th>Size</th>
                                <th>Increase</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($id != null) { ?>
                                <?php foreach ($sizesUpdate as $s) {
                                    if ($s["size_name"] == 12) { ?>
                                        <tr>
                                            <td><input type="hidden" name="sizeID[]" value="<?= $s["cate_size_id"] ?>"><?= $s["size_name"] ?></td>
                                            <td class="box-input"><input type="number" name="size_increase[]" value="<?= $s["increase_size"] ?>" readonly></td>
                                        </tr>
                                    <?php } else { ?>
                                        <tr>
                                            <td><input type="hidden" name="sizeID[]" value="<?= $s["cate_size_id"] ?>"><?= $s["size_name"] ?></td>
                                            <td class="box-input"><input type="number" name="size_increase[]" value="<?= $s["increase_size"] ?>"></td>
                                        </tr>
                                    <?php }
                                }
                            } else {
                                foreach ($sizes as $s) { ?>
                                    <tr>
                                        <td><input type="hidden" name="sizeID[]" value="<?= $s["size_id"] ?>"><?= $s["size_name"] ?></td>
                                        <td class="box-input"><input type="number" name="size_increase[]" <?= ($s["size_name"] == 12 ? 'value="0" readonly' : '') ?>></td>
                                    </tr>
                            <?php }
                            } ?>
                        </tbody>
                    </table>
                    <p class="errorSizes" style="color: red;"></p>
                </div>
            </div>
        </form>
        <button id="submitAdd" class="submit" type="button">Save</button>
    </div>
    <div id="success">
        <div class="message">
            <p>successfully added a category!</p>
            <div class="button-success">
                <button id="okButton">Ok</button>
            </div>
        </div>
    </div>
</div>
<script>
    $("#success").hide();
    $("#submitAdd").click(function(e) {
        e.preventDefault();
        $(document).ready(function() {
            var formData = new FormData($("#cateForm")[0]);

            $.ajax({
                type: "POST",
                url: 'handles/creates/category.php',
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) {
                    if (res === 'success') {
                        showSuccessMessage("products/gallery.php");
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