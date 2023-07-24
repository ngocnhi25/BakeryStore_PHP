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
    <h1>Create New Category</h1>
    <form id="userForm" method="post" action="">
        <div>
            <label for="">Category name</label> <br>
            <input id="input-name" type="text" name="name" value="">
            <div class="errorName" style="color: red;"></div>
        </div>
        <div style="display: flex; gap: 1rem;">
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
                            <td><?= $f["flavor_name"] ?></td>
                            <td><input type="number" name="flavor_increase[]"></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
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
                            <td><?= $s["size_name"] ?></td>
                            <td><input type="number" name="size_increase[]"></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </form>
    <button id="submit" type="button">Save</button>
</div>
<script>
    $(document).ready(function() {
        $("#submit").click(function(e) {
            // alert("ok0");
            e.preventDefault();
            $(document).ready(function() {
                var formData = new FormData($("#userForm")[0]);

                $.ajax({
                    type: "POST",
                    url: 'handles/creates/create_category.php',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        alert(res);
                        // if (res == 'success') {
                        //     showSuccessMessage();
                        // } else {
                        //     var errors = JSON.parse(res);
                        //     for (var key in errors) {
                        //         if (errors.hasOwnProperty(key)) {
                        //             if (typeof errors[key] === 'object') {
                        //                 $('.' + key).empty();
                        //                 for (let subkey in errors[key]) {
                        //                     const subElement = $('<p style="color: red;"></p>').text(`${subkey}: ${errors[key][subkey]}`);
                        //                     $('.' + key).append(subElement);
                        //                 }
                        //             } else {
                        //                 var value = errors[key];
                        //                 $('.' + key).empty().append(value);
                        //             }
                        //         }
                        //     }
                        // }
                    }
                })
            })
        })
    })
</script>