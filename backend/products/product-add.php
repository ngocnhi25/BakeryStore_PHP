<?php
require_once('../../connect/connectDB.php');

$category = executeResult("SELECT * FROM tb_category");



?>
<!-- <!DOCTYPE html>
<html lang="en"> -->

<!-- <head> -->
<!-- <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title> -->

<!-- <script src="https://cdn.tiny.cloud/1/408p82mzgtitwtkc01bmbjchrnbzm4tc67jdfy6ouuzd59uu/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<!-- <script src="https://cdn.tiny.cloud/1/408p82mzgtitwtkc01bmbjchrnbzm4tc67jdfy6ouuzd59uu/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-jquery@1/dist/tinymce-jquery.min.js"></script> -->

<!-- </head> -->

<!-- <body> -->
<style>
    .ck-editor__editable[role="textbox"] {
        /* editing area */
        min-height: 200px;
    }

    .ck-content .image {
        /* block images */
        max-width: 80%;
        margin: 20px auto;
    }
</style>
<div>
    <h1>Add new product</h1>
    <div>
        <form id="userForm" method="post" enctype="multipart/form-data" action="">
            <div>
                <label for="">Product name</label> <br>
                <input id="input-name" type="text" name="name">
                <div class="errorName" style="color: red;"></div>
            </div>
            <div>
                <label for="">Price</label> <br>
                <input id="input-price" type="number" name="price">
                <div class="errorPrice" style="color: red;"></div>
            </div>
            <div>
                <select id="input-cateID" name="cateID" id="">
                    <option value="">___Category___</option>
                    <?php foreach ($category as $cate) { ?>
                        <option value="<?= $cate["cate_id"] ?>"><?= $cate["cate_name"] ?></option>
                    <?php } ?>
                </select>
                <div class="errorCateID" style="color: red;"></div>
            </div>
            <div>
                <label for="">Image</label> <br>
                <input id="input-image" name="image" type="file">
                <div id="preview-image" style="display: flex; gap: 2rem;"></div>
                <div class="errorImage" style="color: red;"></div>
            </div>
            <div>
                <label for="">Thumbnail</label> <br>
                <input id="input-images" name="images[]" type="file" multiple="multiple">
                <div id="preview-images" style="display: flex; gap: 2rem;"></div>
                <div class="errorThubnail" style="color: red;"></div>
            </div>
            <div>
                <textarea name="description" id="editor"></textarea>
                <script src="js/ckeditor.js"></script>
                <div class="errorDescription" style="color: red;"></div>
            </div>
            <button id="submitData" type="button">Submit</button>
        </form>
    </div>
</div>

<script type="text/javascript">
    // function previewFiles(inputElement, previewElement, errorCheck) {
    //     const maxSizeMB = 3;
    //     const maxSizeBytes = maxSizeMB * 1024 * 1024;
    //     $(previewElement).empty();
    //     if (inputElement.files) {
    //         $.each(inputElement.files, function(i, file) {
    //             $.ajax({
    //                 type: "POST",
    //                 url: "checks/file-existence.php", // Replace with the PHP file that handles the server-side check
    //                 data: {
    //                     fileName: file.name
    //                 },
    //                 success: function(response) {
    //                     if (response === "exists") {
    //                         $(errorCheck).html(`<p style="color: red;">${file.name} exists on the server.</p>`);
    //                     } else {
    //                         if (file.type.startsWith("image/")) {
    //                             if (file.size <= maxSizeBytes) {
    //                                 var reader = new FileReader();
    //                                 $(reader).on("load", function() {
    //                                     $(previewElement).append($("<img/>", {
    //                                         src: this.result,
    //                                         width: 200
    //                                     }));
    //                                 });
    //                                 reader.readAsDataURL(file);
    //                             } else {
    //                                 $(errorCheck).empty().append("File " + file.name + " exceeds the maximum size of " + maxSizeMB + "MB.");
    //                             }
    //                         } else {
    //                             $(errorCheck).empty().append("File " + file.name + " is not an image.");
    //                         }
    //                     }
    //                 },
    //                 error: function(xhr, status, error) {
    //                     console.error("AJAX request failed:", error);
    //                 }
    //             });
    //         });
    //     }
    // }



    $("#submitData").click(function(e) {
        e.preventDefault();
        $(document).ready(function() {
            var formData = new FormData();

            formData.append("name", $('#input-name').val());
            formData.append("price", $('#input-price').val());
            formData.append("cateID", $('#input-cateID').val());
            formData.append("description", $('#editor').val().trim());
            formData.append("image", $('#input-image').get(0).files[0]);

            var totalFiles = $('#input-images').get(0).files.length;
            for (let i = 0; i < totalFiles; i++) {
                formData.append("images[]", $('#input-images').get(0).files[i]);
            }

            $.ajax({
                type: "POST",
                url: 'products/function.php',
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) {
                    alert(res)
                    if (res == 'success') {
                        alert('thêm thành công');
                    } else {
                        var errors = $.parseJSON(res);
                        for (var key in errors) {
                            if (typeof errors[$key] === 'object') {
                                for (let errorThumnail in errors[$key]) {
                                    const subElement = $('<p></p>').text(`${errorThumnail}: ${jsonData[key][errorThumnail]}`);
                                    $('.' + key).append(subElement);
                                }
                            } else {
                                var value = errors[key];
                                $('.' + key).empty().append(value);
                            }
                        }
                    }
                }
            })
        })
    })

    $(document).ready(function() {
        $('#input-images').on("change", function() {
            $(".errorThubnail").empty().append('');
        });

        $('#input-image').on("change", function() {
            $(".errorImage").empty().append('');
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
        $('#tiny').on("change", function() {
            $(".errorDescription").empty().append('');
        });
    });

    // function validate(count) {
    //     return count;
    // }

    // console.log(validate());
</script>
<!-- </body> -->

<!-- </html> -->