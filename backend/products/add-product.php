<?php
require_once('../../connect/connectDB.php');

$errors = array();
$errors["images"] = $thumbnails = [];
$errors["name"] =
    $errors["price"] =
    $errors["cateID"] =
    $errors["description"] =
    $errors["image"] =
    $errors["thumbnail"] =
    $errors["description"] =
    $name = $image = $cateID = $price = $description = $id = $title = '';

$category = executeResult("SELECT * FROM tb_category");

date_default_timezone_set('Asia/Bangkok');
$date = date('Y-m-d H:i:s');

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $title = $_GET["title"];

    $product = executeSingleResult("select * from tb_products where product_id = $id");

    $thumbnails = executeResult("select * from tb_thumbnail where product_id = $id");

    $name = $product["product_name"];
    $cateID = $product["cate_id"];
    $price = $product["price"];
    $image = $product["image"];
    $description = $product['description'];
}

if (isset($_POST) && !empty($_POST)) {
    if ($_POST["name"]) {
        $name = $_POST["name"];
    }
    if ($_POST["cateID"]) {
        $cateID = $_POST["cateID"];
    }
    if ($_POST["price"]) {
        $price = $_POST["price"];
    }
    if ($_POST["description"]) {
        $description = $_POST["description"];
    }

    $target_dir = "public/images/products/";
    $type_allow = ['image/png', 'image/jpeg', 'image/gif', 'image/jpg'];
    $size_allow = 5;

    $uploadPath = '../../' . $target_dir;
    // kiểm tra rồi tạo folder product
    if (!is_dir($uploadPath)) {
        mkdir($uploadPath);
    }

    if (isset($_FILES["image"]) && !empty($_FILES["image"]["name"])) {
        $file = $_FILES["image"];
        $image = $target_dir . basename($file["name"]);
        $result = checkAndUploadFile($_FILES["image"], $target_dir, $size_allow, $type_allow);
        if (isset($result['error'])) {
            $errors["image"] = $result['error'];
        }
    } else {
        $errors["image"] = "Image cannot be left blank";
    }

    if (isset($_FILES["images"]) && !empty($_FILES["images"]["name"][0])) {
        $files = $_FILES['images'];
        $file_names = $files['name'];

        foreach ($file_names as $key => $value) {
            $thumbnails[$key] = $target_dir . basename($value);
            $result = checkAndUploadFile(
                [
                    'name' => $files['name'][$key],
                    'type' => $files['type'][$key],
                    'size' => $files['size'][$key],
                    'tmp_name' => $files['tmp_name'][$key]
                ],
                $target_dir,
                $size_allow,
                $type_allow
            );

            if (isset($result['error'])) {
                $errors["images"][$key] = $result['error'];
            }
        }
    } else {
        $errors["thumbnail"] = "Thumbnail cannot be left blank";
    }

    if (!empty($errors["image"])) {
        $messImg = '';
        if ($errors["image"] == "oldFile_err") {
            $messImg = 'file ' . $file["name"] . ' already exists in the directory' . '<br>';
        } elseif ($errors["image"] == 'type_err') {
            $messImg = 'file ' . $file["name"] . ' format error' . '<br>';
        } else {
            $messImg = 'file ' . $file["name"] . ' capacity must be less than ' . $size_allow . 'MB ' . '<br>';
        }
    }

    if (!empty($errors["images"])) {
        $messThumb = '';
        foreach ($errors["images"] as $key => $error) {
            if ($error == 'oldFile_err') {
                $messThumb .= 'file ' . $files["name"][$key] . ' already exists in the directory' . '<br>';
            } elseif ($error == 'type_err') {
                $messThumb .= 'file ' . $files["name"][$key] . ' format error' . '<br>';
            } else {
                $messThumb .= 'file ' . $files["name"][$key] . ' capacity must be less than ' . $size_allow . 'MB ' . '<br>';
            }
        }
    }

    if (empty($name)) {
        $errors["name"] = "Product name cannot be left blank";
    }
    if (empty($cateID)) {
        $errors["cateID"] = "Category cannot be left blank";
    }
    if (empty($price)) {
        $errors["price"] = "Price cannot be left blank";
    }
    if (empty($description)) {
        $errors["description"] = "Description cannot be left blank";
    }

    // if ($id == '') {
    if (
        empty($error["name"])
        && empty($error["cateID"])
        && empty($error["price"])
        && empty($error["image"])
        && empty($error["thumbnail"])
        && empty($error["description"])
        && empty($messImg)
        && empty($messThumb)
    ) {
        execute("insert into tb_products 
            (cate_id, product_name, image, price, description, create_date, deleted) values
            ($cateID, '$name', '$image', $price, '$description', '$date', 0)");
        $new_id = executeSingleResult("select max(product_id) as new_product_id from tb_products");
        $new_product_id = $new_id["new_product_id"];
        foreach ($thumbnails as $key => $thumb) {
            execute("insert into tb_thumbnail (product_id, thumbnail) values ($new_product_id, '$thumb')");
        }
    }
    // } else {

    // }
}

function checkAndUploadFile($file, $target_dir, $size_allow, $type_allow)
{
    $result = [];
    $thumbnailLink = "../../$target_dir" . basename($file["name"]);
    $type = $file['type'];
    $size = $file['size'] / 1024 / 1024;

    if (!file_exists($thumbnailLink)) {
        if (in_array($type, $type_allow)) {
            if ($size <= $size_allow) {
                move_uploaded_file($file["tmp_name"], $thumbnailLink);
            } else {
                $result['error'] = 'size_err';
            }
        } else {
            $result['error'] = 'type_err';
        }
    } else {
        $result['error'] = 'oldFile_err';
    }

    return $result;
}

function checkCate($value)
{
    global $cateID;
    echo $cateID == $value ? "selected" : "";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/add-product.css">
</head>

<body>
    <div>
        <h1>
            <?php echo (($title != null ? $title : 'Add Product')) ?>
        </h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div>
                <div class="mt">
                    <label for="">Product name</label> <br>
                    <input type="text" name="name" value="<?= $name ?>" class="input-group">
                    <?php
                    if (!empty($errors["name"])) {
                        echo '<p style="color: red;">' . $errors["name"] . '</p>';
                    }
                    ?>
                </div>
                <div class="mt">
                    <label for="">Price</label> <br>
                    <input type="number" name="price" value="<?= $price ?>" class="input-group">
                    <?php
                    if (!empty($errors["price"])) {
                        echo '<p style="color: red;">' . $errors["price"] . '</p>';
                    }
                    ?>
                </div>
                <div class="mt">
                    <label for="">Category</label> <br>
                    <div class="custom-select" style="width:200px;">
                        <select>
                            <option value="0">Select Cake:</option>
                            <?php foreach ($category as $c) { ?>
                                <option value="0"><?php echo $c["cate_id"] ?> . <?php echo $c["cate_name"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <script>
                        var x, i, j, l, ll, selElmnt, a, b, c;
                        /*look for any elements with the class "custom-select":*/
                        x = document.getElementsByClassName("custom-select");
                        l = x.length;
                        for (i = 0; i < l; i++) {
                            selElmnt = x[i].getElementsByTagName("select")[0];
                            ll = selElmnt.length;
                            /*for each element, create a new DIV that will act as the selected item:*/
                            a = document.createElement("DIV");
                            a.setAttribute("class", "select-selected");
                            a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
                            x[i].appendChild(a);
                            /*for each element, create a new DIV that will contain the option list:*/
                            b = document.createElement("DIV");
                            b.setAttribute("class", "select-items select-hide");
                            for (j = 1; j < ll; j++) {
                                /*for each option in the original select element,
                                create a new DIV that will act as an option item:*/
                                c = document.createElement("DIV");
                                c.innerHTML = selElmnt.options[j].innerHTML;
                                c.addEventListener("click", function (e) {
                                    /*when an item is clicked, update the original select box,
                                    and the selected item:*/
                                    var y, i, k, s, h, sl, yl;
                                    s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                                    sl = s.length;
                                    h = this.parentNode.previousSibling;
                                    for (i = 0; i < sl; i++) {
                                        if (s.options[i].innerHTML == this.innerHTML) {
                                            s.selectedIndex = i;
                                            h.innerHTML = this.innerHTML;
                                            y = this.parentNode.getElementsByClassName("same-as-selected");
                                            yl = y.length;
                                            for (k = 0; k < yl; k++) {
                                                y[k].removeAttribute("class");
                                            }
                                            this.setAttribute("class", "same-as-selected");
                                            break;
                                        }
                                    }
                                    h.click();
                                });
                                b.appendChild(c);
                            }
                            x[i].appendChild(b);
                            a.addEventListener("click", function (e) {
                                /*when the select box is clicked, close any other select boxes,
                                and open/close the current select box:*/
                                e.stopPropagation();
                                closeAllSelect(this);
                                this.nextSibling.classList.toggle("select-hide");
                                this.classList.toggle("select-arrow-active");
                            });
                        }
                        function closeAllSelect(elmnt) {
                            /*a function that will close all select boxes in the document,
                            except the current select box:*/
                            var x, y, i, xl, yl, arrNo = [];
                            x = document.getElementsByClassName("select-items");
                            y = document.getElementsByClassName("select-selected");
                            xl = x.length;
                            yl = y.length;
                            for (i = 0; i < yl; i++) {
                                if (elmnt == y[i]) {
                                    arrNo.push(i)
                                } else {
                                    y[i].classList.remove("select-arrow-active");
                                }
                            }
                            for (i = 0; i < xl; i++) {
                                if (arrNo.indexOf(i)) {
                                    x[i].classList.add("select-hide");
                                }
                            }
                        }
                        /*if the user clicks anywhere outside the select box,
                        then close all select boxes:*/
                        document.addEventListener("click", closeAllSelect);
                    </script>
                    <?php
                    if (!empty($errors["cateID"])) {
                        echo '<p style="color: red;">' . $errors["cateID"] . '</p>';
                    }
                    ?>
                </div>
            </div>
            <div class="mt">
                <label for="">Product image</label> <br>
                <input id="input-image" type="file" name="image" accept="image/*" onchange="delete_oldImage()"> <br>
                <?php
                if ($image != '') {
                    echo "<img src='../$image' width='200px' id='oldImage'>";
                }
                ?>
                <div id="preview-image" style="display: flex; gap: 2rem;"></div>
                <div>
                    <?php
                    if (!empty($errors["image"])) {
                        echo '<p style="color: red;">' . $messImg . '</p>';
                    }
                    ?>
                </div>
            </div>
            <div class="mt">
                <label for="">Thumbnail</label> <br>
                <input id="input-images" type="file" name="images[]" multiple="multiple" accept="image/*"
                    onchange="delete_oldThumbnail()"> <br>
                <?php if ($thumbnails != null) { ?>
                    <div id="oldThumbnail">
                        <?php
                        foreach ($thumbnails as $th) {
                            echo '<img src="../' . $th["thumbnail"] . '" width="200px" >';
                        }
                        ?>
                    </div>
                <?php } ?>
                <!-- show thumbnail -->
                <div id="preview-images" style="display: flex; gap: 2rem;"></div>
                <div>
                    <!-- error thumbnail -->
                    <?php
                    if (!empty($errors["thumbnail"])) {
                        echo '<p style="color: red;">' . $errors["thumbnail"] . '</p>';
                    } elseif (!empty($mess)) {
                        echo "<p style='color: red;'>$mess</p>";
                    }
                    ?>
                </div>
            </div>
            <div class="mt">
                <label for="">Description</label> <br>
                <textarea id="tiny" name="description" class="description" cols="20"
                    rows="5"><?= $description ?></textarea>
            </div>
            <script>
                $('textarea#tiny').tinymce({
                    height: 250,
                    menubar: false,
                    plugins: [
                        'a11ychecker', 'advlist', 'advcode', 'advtable', 'autolink', 'checklist', 'export',
                        'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks',
                        'powerpaste', 'fullscreen', 'formatpainter', 'insertdatetime', 'media', 'table', 'help', 'wordcount'
                    ],
                    toolbar: 'undo redo | a11ycheck casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist checklist outdent indent | removeformat | code table help'
                });
            </script>

            <div class="mt" style="text-align: center;">
                <input type="submit" value="Save" class="btn-save">
            </div>
        </form>
    </div>
    <script>
        function delete_oldImage() {
            var oldImage = document.getElementById('oldImage');
            oldImage.remove();
        }

        function delete_oldThumbnail() {
            var oldThumbnail = document.getElementById('oldThumbnail');
            oldThumbnail.remove();
        }

        function previewImage() {
            var $preview = $("#preview-image").empty();
            if (this.files) $.each(this.files, readAndPreview);

            function readAndPreview(i, file) {
                var reader = new FileReader();
                $(reader).on("load", function () {
                    $preview.append($("<img/>", {
                        src: this.result,
                        width: 200
                    }));
                });
                reader.readAsDataURL(file);
            }
        }

        function previewImages() {
            var $preview = $("#preview-images").empty();
            if (this.files) $.each(this.files, readAndPreview);

            function readAndPreview(i, file) {
                var reader = new FileReader();
                $(reader).on("load", function () {
                    $preview.append($("<img/>", {
                        src: this.result,
                        width: 200
                    }));
                });
                reader.readAsDataURL(file);
            }
        }
        $('#input-images').on("change", previewImages);
        $('#input-image').on("change", previewImage);
    </script>
</body>

</html>