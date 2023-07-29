<?php
require_once('../../connect/connectDB.php');

$category = executeResult("SELECT * FROM tb_category");

$name = $thumbnails = $cateID = $price = $description = $id = $title = '';
$images = [];

if (isset($_POST["id"])) {
    $id = $_POST["id"];
    $title = $_POST["title"];

    $product = executeSingleResult("select * from tb_products where product_id = $id");

    $thumbnails = executeResult("select * from tb_thumbnail where product_id = $id");

    $name = $product["product_name"];
    $cateID = $product["cate_id"];
    $price = $product["price"];
    $description = $product['description'];
    $images[0] = $product['image'];

    foreach ($thumbnails as $key => $th) {
        $images[$key + 1] = $th["thumbnail"];
    }
}

function checkCate($value)
{
    global $cateID;
    echo $cateID == $value ? "selected" : "";
}

?>

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script> -->
    <link rel="stylesheet" href="css/table.css">
</head>
<div style=" width: 100%;">
    <h1><?php echo (($title != null ? $title : 'Add new product')) ?></h1>
    <div>
        <form method="post" enctype="multipart/form-data" action="">
            <?php if ($id != null) { ?>
                <div>
                    <p>ID: <span><?php echo $id ?></span></p>
                </div>
            <?php } ?>
            <div>
                <label for="">Product name</label> <br>
                <input id="input-name" type="text" name="name" value="<?php echo (($name != null ? $name : '')) ?>">
                <div class="errorName" style="color: red;"></div>
            </div>
            <div>
                <label for="">Price</label> <br>
                <input id="input-price" type="number" name="price" value="<?php echo (($price != null ? $price : '')) ?>">
                <div class="errorPrice" style="color: red;"></div>
            </div>
            <div>
                <select id="input-cateID" name="cateID" id="">
                    <option value="">___Category___</option>
                    <?php foreach ($category as $cate) { ?>
                        <option value="<?= $cate["cate_id"] ?>" <?php checkCate($cate["cate_id"]); ?>><?= $cate["cate_name"] ?></option>
                    <?php } ?>
                </select>
                <div class="errorCateID" style="color: red;"></div>
            </div>
            <div>
                <label for="">Images</label> <br>
                <input id="input-images" name="images[]" onchange="delete_oldThumbnail()" type="file" multiple="multiple" accept="image/*">
                <div id="preview-images"></div>
                <?php if ($images != null) { ?>
                    <div id="oldThumbnail">
                        <?php foreach ($images as $key => $image) { ?>
                            <img src="../<?= $image ?>">
                        <?php } ?>
                    </div>
                <?php } ?>
                <div class="errorImages" style="color: red;"></div>
            </div>
            <div>
                <textarea id="description" name="description">
                    <?php echo (($description != null ? $description : '')) ?>
                </textarea>
                <div class="errorDescription" style="color: red;"></div>
            </div>
            <button id="submitData" class="submit" type="button">Submit</button>
        </form>
    </div>
    <div id="success">
        <div class="message">
            <p><?php echo (($id == null ? 'Product successfully added to the data!' : 'Successfully fixed the product in the data!')) ?></p>
            <div class="button-success">
                <button id="okButton">Ok</button>
            </div>
        </div>
    </div>
</div>

<script>
    CKEDITOR.replace('description');
</script>
<script type="text/javascript">
    $("#success").hide();
    $("#submitData").click(function(e) {
        e.preventDefault();
        $(document).ready(function() {
            var formData = new FormData();

            <?php if ($id != null) { ?>
                formData.append("id", <?php echo $id ?>);
            <?php } ?>

            formData.append("name", $('#input-name').val());
            formData.append("price", $('#input-price').val());
            formData.append("cateID", $('#input-cateID').val());
            formData.append("description", CKEDITOR.instances.description.getData());

            var totalFiles = $('#input-images').get(0).files.length;
            for (let i = 0; i < totalFiles; i++) {
                formData.append("images[]", $('#input-images').get(0).files[i]);
            }

            $.ajax({
                type: "POST",
                url: 'handles/creates/product.php',
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) {
                    if (res === 'success') {
                        showSuccessMessage("products/<?php echo (($id == null ? 'product_add.php' : 'products.php')) ?>");
                    } else {
                        var errors = JSON.parse(res);
                        for (var key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                if (typeof errors[key] === 'object') {
                                    $('.' + key).empty();
                                    for (let subkey in errors[key]) {
                                        const subElement = $('<p style="color: red;"></p>').text(`${subkey}: ${errors[key][subkey]}`);
                                        $('.' + key).append(subElement);
                                    }
                                } else {
                                    var value = errors[key];
                                    $('.' + key).empty().append(value);
                                }
                            }
                        }
                    }
                }
            })
        })
    })
</script>