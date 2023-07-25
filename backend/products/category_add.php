<?php
require_once("../../connect/connectDB.php");

$flavors = executeResult("SELECT * FROM tb_flavor");
$sizes = executeResult("SELECT * FROM tb_size");
?>

<head>
    <link rel="stylesheet" href="css/table.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<div>
    <div>
        <h1>Create New Category</h1>
        <form id="userForm" method="post" action="">
            <div>
                <label for="">Category name</label> <br>
                <input id="input-name" type="text" name="name" value="">
                <p class="errorCateName" style="color: red;"></p>
            </div>
            <div style="display: flex; gap: 1rem;">
                <div>
                    <table>
                        <thead>
                            <tr>
                                <th style="display: flex; justify-content: space-between;"><input type="checkbox" name=""> All</th>
                                <th>flavor</th>
                                <th>Increase</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($flavors as $f) { ?>
                                <tr>
                                    <td><input type="checkbox" name="flavors[]" value="<?= $f["flavor_name"] ?>"></td>
                                    <td><input type="hidden" name="flavorName[]" value="<?= $f["flavor_name"] ?>"><?= $f["flavor_name"] ?></td>
                                    <td><input type="number" name="flavor_increase[]"></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <p class="errorFlavors" style="color: red;"></p>
                </div>
                <div>
                    <table>
                        <thead>
                            <tr>
                                <th><input type="checkbox" name=""> All</th>
                                <th>Size</th>
                                <th>Increase</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($sizes as $s) { ?>
                                <tr>
                                    <td><input type="checkbox" name="sizes[]" value="<?= $s["size_name"] ?>"></td>
                                    <td><input type="hidden" name="sizeName[]" value="<?= $s["size_name"] ?>"><?= $s["size_name"] ?></td>
                                    <td><input type="number" name="size_increase[]"></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <p class="errorSizes" style="color: red;"></p>
                </div>
            </div>
        </form>
        <button id="submit" type="button">Save</button>
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
<script type="text/javascript">
    $("#success").hide();
    $("#submit").click(function(e) {
        // e.preventDefault();
        $(document).ready(function() {
            var formData = new FormData($("#userForm")[0]);

            $.ajax({
                type: "POST",
                url: 'handles/creates/create_category.php',
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) {
                    if (typeof res === 'string') {
                        showSuccessMessage();
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

    function showSuccessMessage() {
        $("#success").show();

        $("#okButton").on("click", function() {
            $("#success").hide();
            $.ajax({
                url: "products/category.php",
                method: "GET",
                dataType: "html",
                success: function(response) {
                    $("#main-page").html(response);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    }
</script>