<?php
require_once('../../connect/connectDB.php');

$category = executeResult("SELECT * FROM tb_category");

$name = $thumbnails = $cateID = $price = $description = $id = $title = '';
$images = [];
$id = '';

if (isset($_POST["id"])) {
    $id = $_POST["id"];
    $title = $_POST["title"];

    $product = executeSingleResult("select * from tb_products where product_id = $id");

    $thumbnails = executeResult("select * from tb_thumbnail where product_id = $id");

    $name = $product["product_name"];
    $cateID = $product["cate_id"];
    $price = $product["price"];
    $quantity = $product["qty_warehouse"];
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

<div class="add-product-page-box">
    <h1 class="title-page"><?php echo (($id != null ? $title : 'Add new product')) ?></h1>
    <div>
        <form method="post" enctype="multipart/form-data" action="">
            <div class="addPro-wapper">
                <div class="product-left">
                    <div class="input-container">
                        <p>Product name:</p>
                        <div class="box-input">
                            <input class="product-name-input" id="input-name" type="text" name="name" value="<?php echo (($id != null ? $name : '')) ?>" required>
                        </div>
                        <div class="errorName error" style="color: red;"></div>
                    </div>
                    <div class="input-container">
                        <p>Description:</p>
                        <div class="ckeditor-box">
                            <textarea id="description" name="description">
                                <?php echo (($id != null ? $description : '')) ?>
                            </textarea>
                        </div>
                        <div class="errorDescription" style="color: red;"></div>
                    </div>
                </div>
                <div class="product-right">
                    <div class="cate-select-box">
                        <p>Product Category: </p>
                        <div class="select-container">
                            <select id="input-cateID" name="cateID" class="select-box">
                                <option value="">___Category___</option>
                                <?php foreach ($category as $cate) { ?>
                                    <option value="<?= $cate["cate_id"] ?>" <?php checkCate($cate["cate_id"]); ?>><?= $cate["cate_name"] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="errorCateID error" style="color: red;"></div>
                    </div>
                    <div class="input-container">
                        <p>Product price:</p>
                        <div class="box-input">
                            <input id="input-price" type="text" name="price" value="<?php echo (($id != null ? $price : '')) ?>" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
                        </div>
                        <div class="errorPrice error" style="color: red;"></div>
                    </div>
                    <div class="input-container">
                        <p>Product quantity:</p>
                        <div class="box-input">
                            <input id="input-qty" type="text" name="qtyProduct" value="<?php echo (($id != null ? $quantity : '')) ?>" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
                        </div>
                        <div class="errorQty error" style="color: red;"></div>
                    </div>
                </div>
            </div>
            <div class="image-box">
                <label for="">Images: </label>
                <input id="input-images" name="images[]" type="file" multiple="multiple" accept="image/*">
                <div id="preview-images"></div>
                <?php if ($id != null) { ?>
                    <div id="oldThumbnail">
                        <?php foreach ($images as $key => $image) { ?>
                            <img src="../../<?= $image ?>">
                        <?php } ?>
                    </div>
                <?php } ?>
                <div class="errorImages error" style="color: red;"></div>
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
            formData.append("qtyProduct", $('#input-qty').val());
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

    $(document).ready(function() {
        $('#input-images').on("change", function() {
            previewFiles(this, "#preview-images", 200);
            $(".errorImages").empty().append('');
            delete_oldThumbnail("oldThumbnail");
        });

        $('#input-name').on("keyup", function() {
            $(".errorName").empty().append('');
        });

        $('#input-price').on("keyup", function() {
            $(".errorPrice").empty().append('');
        });

        $('#input-cateID').on("change", function() {
            $(".errorCateID").empty().append('');
        });
        $('#description').on("change", function() {
            $(".errorDescription").empty().append('');
        });
    });
</script>