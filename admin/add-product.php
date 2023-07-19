<?php
require_once('connect/connectDB.php');

$category = executeResult("SELECT * FROM category");

$errors = array();
$errors["images"] = [];
$errors["image"] = '';

if (isset($_POST) && !empty($_POST)) {
    $name = $_POST["name"] ?? "";
    $cateID = $_POST["cateID"] ?? "";
    $price = $_POST["price"] ?? "";
    $description = $_POST["description"] ?? "";
    $target_dir = "image/products/";

    if (isset($_FILES["image"]) && !empty($_FILES["image"]["name"])) {
        $file = $_FILES["image"];
        $image = $target_dir . basename($file["name"]);
        $imageLink = "../$target_dir" . basename($file["name"]);


        if (!file_exists($imageLink)) {
            if (in_array($file["type"], $type_allow)) {
                if ($file["size"] <= $size_allow) {
                    move_uploaded_file($file["tmp_name"], $imageLink);
                } else {
                    $errors["image"] .= 'dung lượng file <= ' . $size_allow;
                }
            } else {
                $errors["image"] .= 'lỗi định dạng';
            }
        } else {
            $errors["image"] .= 'file đã tồn tại';
        }
    }

    if (isset($_FILES["images"]) && !empty($_FILES["images"]["name"])) {
        $files = $_FILES['images'];
        $file_names = $files['name'];
        $type_allow = ['image/png', 'image/jpeg', 'image/gif', 'image/jpg'];
        $size_allow = 5;

        foreach ($file_names as $key => $value) {
            $thumbnail = $target_dir . basename($value);
            $thumbnailLink = "../$target_dir" . basename($value);
            $type = $files['type'][$key];
            $size = $files['size'][$key] / 1024 / 1024;

            // kiểm tra xem file có hợp lệ không
            if (!file_exists($thumbnailLink)) {
                if (in_array($type, $type_allow)) {
                    if ($size <= $size_allow) {
                        move_uploaded_file($files["tmp_name"][$key], $thumbnailLink);
                    } else {
                        $errors["images"][$key] = 'size_err';
                    }
                } else {
                    $errors["images"][$key] = 'type_err';
                }
            } else {
                $errors["images"][$key] = 'oldFile_err';
            }
        }
    }

    if (!empty($errors["images"])) {
        $mess = '';
        foreach ($errors["images"] as $key => $error) {
            if ($error == 'oldFile_err') {
                $mess .= 'file ' . $files["name"][$key] . ' đã tồn tại trong thư mục' . '<br>';
            } elseif ($error == 'type_err') {
                $mess .= 'file ' . $files["name"][$key] . ' lỗi định dạng' . '<br>';
            } else {
                $mess .= 'file ' . $files["name"][$key] . ' dung lượng phải <= ' . $size_allow . 'MB ' . '<br>';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tiny.cloud/1/408p82mzgtitwtkc01bmbjchrnbzm4tc67jdfy6ouuzd59uu/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <h1>Add Product</h1>
    <div>
        <form action="">
            <div>
                <div>
                    <label for="">Product name</label> <br>
                    <input type="text" name="productName">
                </div>
                <div>
                    <select name="cateID" id="">
                        <option value="">___Category___</option>
                        <?php foreach ($category as $cate) { ?>
                            <option value="<?php echo $cate["id"] ?>"><?php echo $cate["nameCate"] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div>
                <label for="">Product image</label> <br>
                <input type="file" name="image">
                <div id="preview-image" style="display: flex; gap: 2rem;"></div>
                <div>
                    <?php if (!empty($errors["image"])) { ?>
                        <p style='color: red;'><?php echo $errors['image']; ?></p>
                    <?php } ?>
                </div>
            </div>
            <div>
                <label for="">Thumbnail</label> <br>
                <input type="file" multiple="multiple">
                <!-- show thumbnail -->
                <div id="preview-images" style="display: flex; gap: 2rem;"></div>
                <div>
                    <!-- error thumbnail -->
                    <?php
                    if (!empty($mess)) {
                        echo "<p style='color: red;'>$mess</p>";
                    }
                    ?>
                </div>
            </div>
            <div>
                <textarea name="description" class="description" cols="30" rows="10"></textarea>
            </div>
            <div>
                <input type="submit" value="Save">
            </div>
        </form>
    </div>
    <script>
        tinymce.init({
            selector: '.description',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name'
        });
    </script>
    <script>
        function previewImage() {
            var $preview = $("#preview-image").empty();
            if (this.files) $.each(this.files, readAndPreview);

            function readAndPreview(i, file) {
                var reader = new FileReader();
                $(reader).on("load", function() {
                    $preview.append($("<img/>", {
                        src: this.result,
                        height: 100,
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
                $(reader).on("load", function() {
                    $preview.append($("<img/>", {
                        src: this.result,
                        height: 100,
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