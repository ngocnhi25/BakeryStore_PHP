<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once('../../connect/connectDB.php');

$idFlavor = $idSize = '';


$flavors = executeResult("SELECT * FROM tb_flavor");
$sizes = executeResult("SELECT * FROM tb_size");

if (isset($_POST["idFlavor"])) {
    $idFlavor = $_POST["idFlavor"];

    $nameFlavor = executeSingleResult("SELECT * FROM tb_flavor WHERE flavor_id = $idFlavor");
}

if (isset($_POST["idSize"])) {
    $idSize = $_POST["idSize"];

    $nameSize = executeSingleResult("SELECT * FROM tb_size WHERE size_id = $idSize");
}

?>

<head>
    <link rel="stylesheet" href="css/table.css">
</head>

<div class="table_category">
    <h1>Flavor and Size</h1>
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
                                <input id="flavorUpdate" type="hidden" name="name" value="<?= $nameFlavor["flavor_name"] ?>" readonly>
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
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= $f["flavor_name"] ?></td>
                        <td class="button">
                            <button class="update" onclick="updateFlavor(<?= $f['flavor_id'] ?>)">Update</button>
                            <button class="delete" onclick="deleteFlavor(<?= $f['flavor_id'] ?>)">Delete</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>Size (cm)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <form id="sizeForm" method="post" action="">
                    <tr>
                        <td>
                            <?php if ($idSize != null) { ?>
                                <input id="sizeUpdate" type="hidden" name="name" value="<?= $nameSize["size_name"] ?>" readonly>
                            <?php } ?>
                        </td>
                        <td>
                            <input id="sizeInsert" type="text" name="size" value="<?php echo (($idSize != null) ? $nameSize["size_name"] : '') ?>">
                            <p class="errorSize" style="color: red;"></p>
                        </td>
                        <td><button id="submitSize" class="create" type="button">Create</button></td>
                    </tr>
                </form>
                <?php foreach ($sizes as $key => $s) { ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= $s["size_name"] ?></td>
                        <td class="button">
                            <button class="update" onclick="updateSize(<?= $s['size_id'] ?>)">Update</button>
                            <button class="delete" onclick="deleteSize(<?= $s['size_id'] ?>)">Delete</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div id="success">
        <div class="message">
            <p>successfully added!</p>
            <div class="button-success">
                <button id="okButton">Ok</button>
            </div>
        </div>
    </div>
</div>
<script src="js/flavor_and_size.js"></script>
<script type="text/javascript">
    $("#success").hide();
    $("#submitFlavor").click(function(e) {
        e.preventDefault();
        $(document).ready(function() {
            var formData = new FormData();

            <?php if ($idFlavor != null) { ?>
                formData.append("name", $("#flavorUpdate").val());
            <?php } ?>

            formData.append("flavor", $("#flavorInsert").val());

            $.ajax({
                type: "POST",
                url: 'handles/creates/flavor.php',
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) {
                    if (res == 'success') {
                        showSuccessMessage("products/flavor_and_size.php");
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
    $("#submitSize").click(function(e) {
        e.preventDefault();
        $(document).ready(function() {
            var formData = new FormData();

            <?php if ($idSize != null) { ?>
                formData.append("name", $("#sizeUpdate").val());
            <?php } ?>

            formData.append("size", $("#sizeInsert").val());

            $.ajax({
                type: "POST",
                url: 'handles/creates/size.php',
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) {
                    if (res == 'success') {
                        showSuccessMessage("products/flavor_and_size.php");
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