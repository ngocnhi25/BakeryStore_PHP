<?php
require_once("../connect/connectDB.php");

$id = '';
$adsUpdate = [];
$adsUpdate["type_ads"] =
    $adsUpdate["product_id"] =
    $adsUpdate["cate_id"] = '';

$cates = executeResult("SELECT * FROM tb_category");
$products = executeResult("SELECT * FROM tb_products WHERE deleted = 0");
$ads = executeResult("SELECT * FROM tb_ads ORDER BY ads_id DESC");

if (isset($_POST["id"]) && !empty($_POST["id"])) {
    $id = $_POST["id"];

    $adsUpdate = executeSingleResult("SELECT * FROM tb_ads where ads_id = $id");
}

function checkTypeAdsUpdate($value)
{
    global $adsUpdate;
    echo $adsUpdate["type_ads"] == $value ? "selected" : "";
}

function checkTypeProductUpdate($value)
{
    global $adsUpdate;
    echo $adsUpdate["product_id"] == $value ? "selected" : "";
}
function checkTypeCateUpdate($value)
{
    global $adsUpdate;
    echo $adsUpdate["cate_id"] == $value ? "selected" : "";
}
?>

<head>
    <style>
        .ads-page {
            width: 100%;
        }
        .ads-page .ads-boxxxx {
            width: 100%;
            display: flex;
            gap: 0.5rem;
        }

        .ads-page .ads-add {
            border-radius: 10px;
            width: 40%;
            position: relative;
            margin: auto;
            padding: 20px;
            background-color: #fff;
        }

        .ads-page .ads-add .ads-event {
            width: 100%;
            text-align: center;
            color: blue;
            margin-bottom: 20px;
        }

        .ads-page .ads-add .ads-event button {
            margin-top: 15px;
        }

        .ads-page .ads-date {
            display: flex;
            gap: 2rem;
        }

        .ads-page .ads-date input {
            border-radius: 10px;
            padding: 5px;
            gap: 2rem;
            margin-left: 10px;
            box-shadow: 1px 1px 3px black;
        }

        .ads-page .type-ads-box .type-ads {
            display: flex;
            gap: 1rem;
            margin-left: 10px;
        }

        label {
            font-size: 1.2rem;
            font-weight: 600;
        }

        .ads-page .image-box {
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .ads-page .image-box input[type="file"] {
            font-size: 14px;
            border-radius: 50px;
            box-shadow: 1px 1px 3px black;
            width: 200px;
            outline: none;
            margin-left: 10px;
        }

        .ads-page .image-box input[type="file"]::-webkit-file-upload-button {
            background-color: #96dcd57a;
            padding: 8px;
            border: none;
            border-radius: 50px;
            outline: none;
        }

        .ads-page .image-banner {
            width: 200px;
        }

        .ads-page .image-banner img {
            width: 100%;
            vertical-align: middle;
        }

        .table_ads {
            width: 1005;
            border-radius: 5px;
            overflow: auto;
        }
    </style>
</head>

<div class="ads-page">
    <h1>Advertising Management</h1>
    <div class="ads-boxxxx">
        <div class="ads-add">
            <div class="ads-event">
                <h2>Create Advertising</h2>
            </div>
            <form id="adsForm" method="post" enctype="multipart/form-data" action="">
                <div>
                    <input style="display: none;" type="text" name="ads_id" value="<?= ($id != null ? $adsUpdate["ads_id"] : '') ?>">
                </div>
                <div class="type-ads-box">
                    <label for="">Type advertisement</label> <br>
                    <div class="type-ads">
                        <div class="select-container">
                            <select name="typeAds" id="typeAds" class="select-box" onchange="checkTypeAds()">
                                <option value="">______Option______</option>
                                <option value="category" <?php checkTypeAdsUpdate('category') ?>>Category</option>
                                <option value="product" <?php checkTypeAdsUpdate('product') ?>>Product</option>
                                <option value="news" <?php checkTypeAdsUpdate('news') ?>>News</option>
                            </select>
                        </div>
                        <div class="typeAdsOption"></div>
                    </div>
                    <p style="color: red;" class="errorTypeAds"></p>
                </div>
                <div class="image-box">
                    <label for="">Image advertisement</label> <br>
                    <input id="imageAds" type="file" name="imageAds">
                    <div id="preview-images"></div>
                    <?php if ($id != null) { ?>
                        <div id="image-ads">
                            <img src="../../<?= $adsUpdate["image_ads"] ?>">
                        </div>
                    <?php } ?>
                    <p style="color: red;" class="errorImages"></p>
                </div>
                <div class="ads-date">
                    <div class="start-date-box">
                        <label for="">Start Date</label> <br>
                        <input id="startDate" type="date" name="startDate" value="<?= ($id != null ? $adsUpdate["start_date"] : '') ?>">
                    </div>
                    <div class="end-date-box">
                        <label for="">End Date</label> <br>
                        <input id="endDate" type="date" name="endDate" value="<?= ($id != null ? $adsUpdate["end_date"] : '') ?>">
                    </div>
                </div>
                <p style="color: red;" class="errorDate"></p>
                <div class="ads-event">
                    <button id="addAds" class="submit" type="button">Add</button>
                </div>
            </form>
        </div>
        <div class="table_ads">
            <table class="table-admin">
                <thead>
                    <tr>
                        <th></th>
                        <th>Type</th>
                        <th>Image</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ads as $key => $a) { ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td>
                                <?php if ($a["type_ads"] == "product") {
                                    $showProductID = $a["product_id"];
                                    $productShow = executeSingleResult("SELECT product_name FROM tb_products Where product_id = $showProductID");
                                    echo $a["type_ads"] . ": " . $productShow["product_name"];
                                } elseif ($a["type_ads"] == "category") {
                                    $showCateID = $a["cate_id"];
                                    $cateShow = executeSingleResult("SELECT cate_name FROM tb_category Where cate_id = $showCateID");
                                    echo $a["type_ads"] . ": " . $cateShow["cate_name"];
                                } else {
                                    echo $a["type_ads"];
                                } ?>
                            </td>
                            <td class="image-banner">
                                <img src="../../<?= $a["image_ads"] ?>" alt="">
                            </td>
                            <td><?= $a["start_date"] ?></td>
                            <td><?= $a["end_date"] ?></td>
                            <td>
                                <button class="update" type="button" onclick="updateAds(<?= $a['ads_id'] ?>)">Update</button>
                                <button class="delete" type="button" onclick="deleteAds(<?= $a['ads_id'] ?>)">Delete</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div id="success">
        <div class="message">
            <p>successfully added an ad !</p>
            <div class="button-success">
                <button id="okButton">Ok</button>
            </div>
        </div>
    </div>
</div>
<script>
    function checkTypeAds() {
        $(document).ready(function() {
            var typeAds = $("#typeAds").val();

            typeAdsOption(typeAds)
        })
    }

    $(function() {
        <?php if ($id != null) { ?>
            typeAdsOption('<?= $adsUpdate["type_ads"] ?>');
        <?php } ?>
    });

    function typeAdsOption(typeAds) {
        if (typeAds == "category") {
            const html = `
                    <div class="select-container">
                        <select name="cateID" class="select-box">
                            <option value="">___Category Name___</option>
                            <?php foreach ($cates as $c) { ?>
                                <option value="<?= $c["cate_id"] ?>" <?= checkTypeCateUpdate($c["cate_id"]) ?>><?= $c["cate_name"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                `;
            $(".typeAdsOption").empty().append(html);
        } else if (typeAds == "product") {
            const html = `
                    <div class="select-container">
                        <select name="productID" class="select-box">
                            <option value="">___Product Name___</option>
                            <?php foreach ($products as $p) { ?>
                                <option value="<?= $p["product_id"] ?>" <?= checkTypeProductUpdate($p["product_id"]) ?>><?= $p["product_name"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                `;
            $(".typeAdsOption").empty().append(html);
        } else {
            $(".typeAdsOption").empty();
        }
    }

    $("#success").hide();
    $("#addAds").click(function(e) {
        e.preventDefault();
        $(document).ready(function() {
            var formData = new FormData($("#adsForm")[0]);

            $.ajax({
                type: "POST",
                url: 'handles/creates/ads.php',
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) { 
                    if (res === 'success') {
                        showSuccessMessage("ads.php");
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

    $(document).ready(function() {
        $('#imageAds').on("change", function() {
            previewFiles(this, "#preview-images", 400);
            $(".errorImages").empty().append('');
            delete_oldThumbnail("image-ads");
        });
    });

    function deleteAds(id) {
        const html = `
        <div class="message-confirm-box">
            <div class="message-confirm">
                <div>Are you sure to permanently delete ads?</div>
                <div>
                    <button class="cancel" type="button">Cancal</button>
                    <button id="delete-ads" class="delete" type="button">Delete</button>
                </div>
            </div>
        </div>
    `;
        $("body").append(html);

        $(".cancel").click(function() {
            $(".message-confirm-box").remove();
        });

        $("#delete-ads").click(function() {
            $.post(
                "handles/deletes/ads.php", {
                    id: id
                },
                function(res) {
                    $(".message-confirm-box").remove();
                    ajaxPages(res);
                }
            )
        });
    }

    function updateAds(id) {
        var postData = {
            id: id
        }
        ajaxPageData("ads.php", postData);
    }
</script>