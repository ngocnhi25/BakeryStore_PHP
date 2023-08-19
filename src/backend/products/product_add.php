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
    <link rel="stylesheet" href="../../public/backend/css/table.css">
    <style>
        .title-page {
            margin-top: 20px;
            margin-left: 20px;
        }

        .addPro-wapper {
            position: relative;
            width: 650px;
            margin: auto;
        }


        .product-input-box {
            display: flex;
            position: relative;
            justify-content: space-evenly;
        }

        .input-animation {
            margin-bottom: 25px;
        }

        .input-box {
            position: relative;
            width: 280px;
        }

        .input-box label {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            font-size: 16px;
            color: #504e4e;
            padding: 0 5px;
            pointer-events: none;
            transition: 0.5s;
        }

        .input-box input {
            width: 100%;
            padding: 10px;
            background: #41cb782e;
            border: 1.8px solid rgba(255, 255, 255, 0.3);
            outline: none;
            border-radius: 50px;
            font-size: 16px;
            color: #141212;
            transition: .5s;
            box-shadow: 1px 1px 3px black;
        }

        .input-box input:focus~label,
        .input-box input:valid~label {
            top: -5px;
            left: 18px;
            font-size: 13px;
            background: #1d2b3e;
            color: #0080ff;
            padding: 0 12px;
            border-radius: 5px;
        }

        .input-box input:focus,
        .input-box input:valid {
            border: 1.8px solid #0080ff;
        }

        .ckeditor-box {
            position: relative;
            width: 100%;
            overflow: hidden;
            border-radius: 10px;
            border: 1px solid #504e4e;
        }

        .select-container {
            width: 200px;
            position: relative;
            height: 30px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 1px 1px 3px black;
        }

        .select-box {
            border: none;
            width: 100%;
            padding: 6px 10px 6px 10px;
            color: #000;
            background-color: #96dcd57a;
            font-size: 14px;
        }

        .image-box {
            margin-bottom: 15px;
        }

        .image-box label {
            font-size: 16px;
        }

        .image-box input[type="file"] {
            font-size: 14px;
            border-radius: 50px;
            box-shadow: 1px 1px 3px black;
            width: 200px;
            outline: none;
            margin-left: 10px;
        }

        ::-webkit-file-upload-button {
            background-color: #96dcd57a;
            padding: 8px;
            border: none;
            border-radius: 50px;
            outline: none;
        }

        .error {
            margin-left: 20px;
        }
    </style>
</head>
<div class="page-box">
    <h1 class="title-page"><?php echo (($title != null ? $title : 'Add new product')) ?></h1>
    <div>
        <form method="post" enctype="multipart/form-data" action="">
            <div class="addPro-wapper">
                <div class="product-input-box">
                    <div class="product-input">
                        <div class="input-animation">
                            <div class="input-box">
                                <input id="input-name" type="text" name="name" value="<?php echo (($name != null ? $name : '')) ?>" required>
                                <label for="">Product name</label> <br>
                            </div>
                            <div class="errorName error" style="color: red;"></div>
                        </div>
                        <div class="input-animation">
                            <div class="input-box">
                                <input id="input-price" type="number" name="price" value="<?php echo (($price != null ? $price : '')) ?>" required>
                                <label for="">Price</label> <br>
                            </div>
                            <div class="errorPrice error" style="color: red;"></div>
                        </div>
                    </div>
                    <div class="input-animation">
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
                </div>
                <div class="image-box">
                    <label for="">Images: </label>
                    <input id="input-images" name="images[]" onchange="delete_oldThumbnail()" type="file" multiple="multiple" accept="image/*">
                    <div id="preview-images"></div>
                    <?php if ($images != null) { ?>
                        <div id="oldThumbnail">
                            <?php foreach ($images as $key => $image) { ?>
                                <img src="../../<?= $image ?>">
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <div class="errorImages error" style="color: red;"></div>
                </div>
            </div>
            <div class="ckeditor-box">
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

    $(document).ready(function() {
        $('#input-images').on("change", function() {
            previewFiles(this, "#preview-images", 200);
            $(".errorImages").empty().append('');
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