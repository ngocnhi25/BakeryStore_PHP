<?php
require_once('../../connect/connectDB.php');

$idFlavor = $idSize = $idCate = '';

$cates = executeResult("SELECT * FROM tb_category");
$flavors = executeResult("SELECT * FROM tb_flavor");
$sizes = executeResult("SELECT * FROM tb_size");

if (isset($_POST["idCate"])) {
    $idCate = $_POST["idCate"];

    $nameCate = executeSingleResult("SELECT * FROM tb_category WHERE cate_id = $idCate");
}

if (isset($_POST["idFlavor"])) {
    $idFlavor = $_POST["idFlavor"];

    $nameFlavor = executeSingleResult("SELECT * FROM tb_flavor WHERE flavor_id = $idFlavor");
}

if (isset($_POST["idSize"])) {
    $idSize = $_POST["idSize"];

    $nameSize = executeSingleResult("SELECT * FROM tb_size WHERE size_id = $idSize");
}
?>

<div class="table_category">
    <div>
        <h1>Category</h1>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Category Name</th>
                        <th>Total Products</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <form id="cateForm" method="post" action="">
                        <tr>
                            <td>
                                <?php if ($idCate != null) { ?>
                                    <input id="cateUpdate" type="hidden" name="id" value="<?= $nameCate["cate_id"] ?>" readonly>
                                <?php } ?>
                            </td>
                            <td>
                                <input id="cateInsert" type="text" name="cateName" value="<?php echo (($idCate != null) ? $nameCate["cate_name"] : '') ?>">
                                <p class="errorCateName" style="color: red;"></p>
                            </td>
                            <td></td>
                            <td><button id="submitCate" class="create" type="button">Create</button></td>
                        </tr>
                    </form>
                    <?php foreach ($cates as $key => $cate) {
                        $cate_id = $cate["cate_id"];
                        $row = executeSingleResult("SELECT count(*) AS total FROM tb_products WHERE cate_id = $cate_id");
                    ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= $cate["cate_name"] ?></td>
                            <td><?php echo $row["total"] ?></td>
                            <td class="button">
                                <button class="update" onclick='updateCate(<?= $cate["cate_id"] ?>)' type="button">Update</button>
                                <?php if ($row["total"] > 0) { ?>
                                    <button class="notDelete delete">Delete</button>
                                <?php  } else { ?>
                                    <button class="delete" onclick='deleteCate(<?= $cate["cate_id"] ?>)' type="button">Delete</button>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div>
        <h1>Flavor</h1>
        <div>
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>Flavor name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <form id="flavorForm" method="post" action="">
                        <tr>
                            <td>
                                <?php if ($idFlavor != null) { ?>
                                    <input id="flavorUpdate" type="hidden" name="id" value="<?= $nameFlavor["flavor_id"] ?>" readonly>
                                <?php } ?>
                            </td>
                            <td>
                                <input id="flavorInsert" type="text" name="flavor" value="<?php echo (($idFlavor != null) ? $nameFlavor["flavor_name"] : '') ?>">
                                <p class="errorFlavor" style="color: red;"></p>
                            </td>
                            <td><button id="submitFlavor" class="create" type="button">Create</button></td>
                        </tr>
                    </form>
                    <?php foreach ($flavors as $key => $f) { ?>
                        <?php if ($f["deleted_flavor"] == 0) { ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td><?= $f["flavor_name"] ?></td>
                                <td class="button">
                                    <button class="update" onclick="updateFlavor(<?= $f['flavor_id'] ?>)">Update</button>
                                    <button class="delete" onclick="deleteFlavor(<?= $f['flavor_id'] ?>)">Delete</button>
                                </td>
                            </tr>
                        <?php } else { ?>
                            <tr style="opacity: 0.5;">
                                <td><?= $key + 1 ?></td>
                                <td><?= $f["flavor_name"] ?></td>
                                <td class="button">
                                    <button class="update" onclick="updateFlavor(<?= $f['flavor_id'] ?>)">Update</button>
                                    <button class="recover" onclick="recoverFlavor(<?= $f['flavor_id'] ?>)">Recover</button>
                                </td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div>
        <h1>Size</h1>
        <div>
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>Size (cm)</th>
                        <th>Plus Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <form id="sizeForm" method="post" action="">
                        <tr>
                            <td>
                                <?php if ($idSize != null) { ?>
                                    <input id="sizeUpdate" type="hidden" name="id" value="<?= $nameSize["size_id"] ?>" readonly>
                                <?php } ?>
                            </td>
                            <td>
                                <input id="sizeInsert" type="text" name="size" value="<?php echo (($idSize != null) ? $nameSize["size_name"] : '') ?>">
                                <p class="errorSize" style="color: red;"></p>
                            </td>
                            <td>
                                <input id="increaseSizeInsert" type="number" name="increaseSize" value="<?php echo (($idSize != null) ? $nameSize["increase_size"] : '') ?>">
                                <p class="errorIncreaseSize" style="color: red;"></p>
                            </td>
                            <td><button id="submitSize" class="create" type="button">Create</button></td>
                        </tr>
                    </form>
                    <?php foreach ($sizes as $key => $s) { ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= $s["size_name"] ?></td>
                            <td><?= $s["increase_size"] ?></td>
                            <td class="button">
                                <button class="update" onclick="updateSize(<?= $s['size_id'] ?>)">Update</button>
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
                <?php if($idCate == null && $idFlavor == null && $idSize == null) { 
                    echo "Added Successful!";
                } else {
                    echo "Update Successful!";
                }?>
            </p>
            <div class="button-success">
                <button id="okButton">Ok</button>
            </div>
        </div>
    </div>
</div>
<script src="../../public/backend/js/galery.js"></script>
<script type="text/javascript">
    $("#success").hide();
    $("#submitCate").click(function(e) {
        e.preventDefault();
        $(document).ready(function() {
            var formCateData = new FormData();

            <?php if ($idCate != null) { ?>
                formCateData.append("id", $("#cateUpdate").val());
            <?php } ?>

            formCateData.append("cateName", $("#cateInsert").val());

            ajaxForm('handles/creates/category.php', formCateData);
        })
    })

    $("#submitFlavor").click(function(e) {
        e.preventDefault();
        $(document).ready(function() {
            var formFlavorData = new FormData();

            <?php if ($idFlavor != null) { ?>
                formFlavorData.append("name", $("#flavorUpdate").val());
            <?php } ?>

            formFlavorData.append("flavor", $("#flavorInsert").val());

            ajaxForm('handles/creates/flavor.php', formFlavorData);

        })
    })

    $("#submitSize").click(function(e) {
        e.preventDefault();
        $(document).ready(function() {
            var formSizeData = new FormData();

            <?php if ($idSize != null) { ?>
                formSizeData.append("id", $("#sizeUpdate").val());
            <?php } ?>

            formSizeData.append("size", $("#sizeInsert").val());
            formSizeData.append("increase_size", $("#increaseSizeInsert").val());

            ajaxForm('handles/creates/size.php', formSizeData);

        })
    })

    function ajaxForm(url, formData) {
        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            contentType: false,
            processData: false,
            success: function(res) {
                // alert(res);
                if (res === 'success') {
                    showSuccessMessage("products/galery.php");
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