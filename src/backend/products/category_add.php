<?php
require_once("../../connect/connectDB.php");

$flavors = executeResult("SELECT * FROM tb_flavor");
$sizes = executeResult("SELECT * FROM tb_size");

$id = $title = '';
$fAdded = $sAdded = [];

if (isset($_POST["id"])) {
    $id = $_POST["id"];
    if ($_POST["title"]) {
        $title = $_POST["title"];
    }

    $cate = executeSingleResult("SELECT * FROM tb_category WHERE cate_id = $id");

    $flavorsAdded = executeResult("SELECT * FROM tb_product_flavor WHERE cate_id = $id");
    $sizesAdded = executeResult("SELECT * FROM tb_product_size WHERE cate_id = $id");
    foreach ($flavorsAdded as $key => $f) {
        $fAdded[$key] = $f["flavor"];
    }
    foreach ($sizesAdded as $key => $s) {
        $sAdded[$key] = $s["size"];
    }
}


?>

<head>
    <link rel="stylesheet" href="../../public/backend/css/table.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<div>
    <div>
        <h1><?php echo (($id != null) ? $title : 'Create new category') ?></h1>
        <?php if ($id != null) { ?>
            <div style="display: flex; gap: 1rem;">
                <div>
                    <table>
                        <thead>
                            <tr>
                                <th></th>
                                <th>Flavor</th>
                                <th>Increase</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($flavorsAdded as $key => $f) { ?>
                                <tr>
                                    <td><?= ($key + 1) ?></td>
                                    <td><?= $f["flavor"] ?></td>
                                    <td><?= $f["increase_flavor"] ?></td>
                                    <td><button class="delete" onclick="deleteProductFlavor(<?= $f['flavor_product_id'] ?>, <?= $cate['cate_id'] ?>)">Delete</button></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div>
                    <table>
                        <thead>
                            <tr>
                                <th></th>
                                <th>Size (cm)</th>
                                <th>Increase</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($sizesAdded as $key => $s) { ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?php echo $s["size"] ?></td>
                                    <td><?php echo $s["increase_size"] ?></td>
                                    <td><button class="delete" onclick="deleteProductSize(<?= $s['size_product_id'] ?>, <?= $cate['cate_id'] ?>)">Delete</button></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php } ?>
        <form id="cateForm" method="post" action="">
            <div>
                <?php if ($id != null) { ?>
                    <input id="idUpdate" type="text" name="id" value="<?= $id ?>" style="display: none;">
                <?php } ?>
                <label for="">Category name</label> <br>
                <input id="input-name" type="text" name="name" value="<?= $id != null ? $cate["cate_name"] : '' ?>">
                <p class="errorCateName" style="color: red;"></p>
            </div>
            <div style="display: flex; gap: 1rem;">
                <div>
                    <table>
                        <thead>
                            <tr>
                                <th>Check</th>
                                <th>Flavor</th>
                                <th>Increase</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($flavors as $f) {
                                if ($id == null) { ?>
                                    <tr>
                                        <td><input type="checkbox" name="flavors[]" value="<?= $f["flavor_name"] ?>"></td>
                                        <td><input type="hidden" name="flavorName[]" value="<?= $f["flavor_name"] ?>"><?= $f["flavor_name"] ?></td>
                                        <td><input type="number" name="flavor_increase[]"></td>
                                    </tr>
                                    <?php } else {
                                    if (!in_array($f["flavor_name"], $fAdded)) {
                                    ?>
                                        <tr>
                                            <td><input type="checkbox" name="flavors[]" value="<?= $f["flavor_name"] ?>"></td>
                                            <td><input type="hidden" name="flavorName[]" value="<?= $f["flavor_name"] ?>"><?= $f["flavor_name"] ?></td>
                                            <td><input type="number" name="flavor_increase[]"></td>
                                        </tr>
                            <?php }
                                }
                            } ?>
                        </tbody>
                    </table>
                    <p class="errorFlavors" style="color: red;"></p>
                </div>
                <div>
                    <table>
                        <thead>
                            <tr>
                                <th>Check</th>
                                <th>Size</th>
                                <th>Increase</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($sizes as $s) {
                                if ($id == null) { ?>
                                    <tr>
                                        <td><input type="checkbox" name="sizes[]" value="<?= $s["size_name"] ?>"></td>
                                        <td><input type="hidden" name="sizeName[]" value="<?= $s["size_name"] ?>"><?= $s["size_name"] ?></td>
                                        <td><input type="number" name="size_increase[]"></td>
                                    </tr>
                                    <?php } else {
                                    if (!in_array($s["size_name"], $sAdded)) {
                                    ?>
                                        <tr>
                                            <td><input type="checkbox" name="sizes[]" value="<?= $s["size_name"] ?>"></td>
                                            <td><input type="hidden" name="sizeName[]" value="<?= $s["size_name"] ?>"><?= $s["size_name"] ?></td>
                                            <td><input type="number" name="size_increase[]"></td>
                                        </tr>
                            <?php }
                                }
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
<script src="../../public/backend/js/category.js"></script>