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
        <button onclick="createCate()" class="create" type="button">Add new category</button>
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
                        <th>Flavors in stock(kg)</th>
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
                            <td>
                                <input id="flavorInStockInsert" type="text" name="flavorInStock" value="<?php echo (($idFlavor != null) ? $nameFlavor["qti_flavor"] : '') ?>">
                                <p class="errorFlavorInStock" style="color: red;"></p>
                            </td>
                            <td><button id="submitFlavor" class="create" type="button"><?php echo ($idFlavor != null ? "Save" : "Create") ?></button></td>
                        </tr>
                    </form>
                    <?php foreach ($flavors as $key => $f) { ?>
                        <?php if ($f["qti_flavor"] > 0 && $f["deleted_flavor"] == 0) { ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td><?= $f["flavor_name"] ?></td>
                                <td><?= $f["qti_flavor"] ?> kg</td>
                                <td class="button">
                                    <button class="update" onclick="updateFlavor(<?= $f['flavor_id'] ?>)">Update</button>
                                    <button class="hide" onclick="hideFlavor(<?= $f['flavor_id'] ?>)">Hide</button>
                                    <button class="delete" onclick='deleteFlavor("<?= $f["flavor_name"] ?>", <?= $f["flavor_id"] ?>)'>Delete</button>
                                </td>
                            </tr>
                        <?php } else { ?>
                            <tr style="opacity: 0.5;">
                                <td><?= $key + 1 ?></td>
                                <td><?= $f["flavor_name"] ?></td>
                                <td><?= $f["qti_flavor"] ?> kg</td>
                                <td class="button">
                                    <button class="update" onclick="updateFlavor(<?= $f['flavor_id'] ?>)">Update</button>
                                    <button class="recover" onclick="recoverFlavor(<?= $f['qti_flavor'] ?>, <?= $f['flavor_id'] ?>)">Recover</button>
                                    <button class="delete" onclick='deleteFlavor("<?= $f["flavor_name"] ?>", <?= $f["flavor_id"] ?>)'>Delete</button>
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
                        <th>Number of boxes</th>
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
                                <input id="qtiBoxSizeInsert" type="text" name="qtiBoxSize" value="<?php echo (($idSize != null) ? $nameSize["qti_boxes_size"] : '') ?>">
                                <p class="errorqtiBoxSize" style="color: red;"></p>
                            </td>
                            <td><button id="submitSize" class="create" type="button">Create</button></td>
                        </tr>
                    </form>
                    <?php foreach ($sizes as $key => $s) { ?>
                        <?php if ($s["qti_boxes_size"] > 0 && $s["deleted_size"] == 0) { ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td><?= $s["size_name"] ?></td>
                                <td><?= $s["qti_boxes_size"] ?> boxes</td>
                                <td class="button">
                                    <button class="update" onclick="updateSize(<?= $s['size_id'] ?>)">Update</button>
                                    <button class="hide" onclick="hideSize(<?= $s['size_id'] ?>)">Hide</button>
                                    <button class="delete" onclick="deleteSize(<?= $s['size_name'] ?>, <?= $s['size_id'] ?>)">Delete</button>
                                </td>
                            </tr>
                        <?php } else { ?>
                            <tr style="opacity: 0.5;">
                                <td><?= $key + 1 ?></td>
                                <td><?= $s["size_name"] ?></td>
                                <td><?= $s["qti_boxes_size"] ?> boxes</td>
                                <td class="button">
                                    <button class="update" onclick="updateSize(<?= $s['size_id'] ?>)">Update</button>
                                    <button class="recover" onclick="recoverSize(<?= $s['qti_boxes_size'] ?>, <?= $s['size_id'] ?>)">Recover</button>
                                    <button class="delete" onclick="deleteSize(<?= $s['size_name'] ?>, <?= $s['size_id'] ?>)">Delete</button>
                                </td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div id="success">
        <div class="message">
            <p>
                <?php if ($idCate == null && $idFlavor == null && $idSize == null) {
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
<script src="../../public/backend/js/gallery.js"></script>
<script type="text/javascript">
    $("#success").hide();

    $("#submitFlavor").click(function(e) {
        e.preventDefault();
        $(document).ready(function() {
            var formFlavorData = new FormData();

            <?php if ($idFlavor != null) { ?>
                formFlavorData.append("id", $("#flavorUpdate").val());
            <?php } ?>

            formFlavorData.append("flavor", $("#flavorInsert").val());
            formFlavorData.append("flavorInStock", $("#flavorInStockInsert").val());

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
            formSizeData.append("qtiBoxSize", $("#qtiBoxSizeInsert").val());

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
    }
</script>