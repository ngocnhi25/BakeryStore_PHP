<?php
require_once("../connect/connectDB.php");

$id = $product_name = '';
$adsUpdate = [];
$adsUpdate["type_ads"] =
    $adsUpdate["product_id"] =
    $adsUpdate["cate_id"] = '';

$cates = executeResult("SELECT * FROM tb_category");
$ads = executeResult("SELECT * FROM tb_ads ORDER BY ads_id DESC");

if (isset($_POST["id"]) && !empty($_POST["id"])) {
    $id = $_POST["id"];

    $adsUpdate = executeSingleResult("SELECT * FROM tb_ads where ads_id = $id");
    $product_id = $adsUpdate["product_id"];
    $product = executeSingleResult("SELECT product_name FROM tb_products Where product_id = $product_id");
    $product_name = $product["product_name"];
}

function checkTypeAdsUpdate($value)
{
    global $adsUpdate;
    echo $adsUpdate["type_ads"] == $value ? "selected" : "";
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

        .ads-page .ads-box {
            width: 100%;
            display: flex;
            gap: 0.5rem;
        }

        .ads-page .ads-add {
            border-radius: 10px;
            width: 40%;
            position: relative;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 3px #d2d2d2;
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
            margin-left: 10px;
        }
        .ads-page .type-ads-box .typeAdsOption {
            margin-top: 10px;
        }

        .ads-page label {
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
            width: 150px;
        }

        .ads-page .image-banner img {
            width: 100%;
            vertical-align: middle;
        }
    </style>
</head>

<div class="ads-page">
    <h1>Advertising Management</h1>
    <div class="ads-box">
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
                    <button id="addAds" class="submit" type="button">Save</button>
                </div>
            </form>
        </div>
        <div class="container-filter-table-ads">
            <div class="filter-action">
                <div class="select-container">
                    <select name="category" class="select-box" id="arrangeAds">
                        <option value="new_to_old">new - old</option>
                        <option value="old_to_new">old - new</option>
                        <option value="ongoing">ongoing</option>
                        <option value="ceased">ceased</option>
                        <option value="pending">pending</option>
                    </select>
                </div>
                <div class="form-search-header">
                    <span class="material-symbols-sharp icon">search</span>
                    <input id="filter-search-ads" type="text" name="search" placeholder="Search product or category..." class="form-control">
                </div>
            </div>
            <div class="table-ads-box"></div>
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
                    <div class="search-product">
                        <div class="box-input">
                            <input type="text"  id="input-product-name" value="<?= ($id != null ? $product_name : '') ?>" name="product_name">
                        </div>
                        <div id="search-result-product"></div>
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
                    alert(res);
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

    function deleteAds(id) {
        const html = `
        <div class="message-confirm-box">
            <div class="message-confirm">
                <div>Are you sure to permanently delete ads?</div>
                <div>
                    <button class="cancel" type="button">Cancal</button>
                    <button id="delete-ads" class="deleted" type="button">Delete</button>
                </div>
            </div>
        </div>`;
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

    function showAds() {
        $.ajax({
            url: "handles/search/filter_search_ads.php",
            method: "POST",
            data: {
                arrangeProduct: $("#arrangeAds").val()
            },
            success: function(res) {
                $(".table-ads-box").empty().html(res);
            }
        });
    }

    function ads_previous(id) {
        $.ajax({
            url: "handles/search/filter_search_ads.php",
            method: "POST",
            data: {
                page: id - 1,
                filter_search: $("#filter-search-ads").val(),
                arrangeProduct: $("#arrangeCoupon").val()
            },
            success: function(res) {
                $(".table-ads-box").empty().html(res);
            }
        });
    };

    function ads_next(id) {
        $.ajax({
            url: "handles/search/filter_search_ads.php",
            method: "POST",
            data: {
                page: (id + 1),
                filter_search: $("#filter-search-ads").val(),
                arrangeProduct: $("#arrangeCoupon").val()
            },
            success: function(res) {
                $(".table-ads-box").empty().html(res);
            }
        });
    };

    $(document).ready(function() {
        showAds();

        $('#imageAds').on("change", function() {
            previewFiles(this, "#preview-images", 400);
            $(".errorImages").empty().append('');
            delete_oldThumbnail("image-ads");
        });

        $("#filter-search-ads").on("input", function() {
            const search = $(this).val();
            if (search !== "") {
                $.ajax({
                    url: "handles/search/filter_search_ads.php",
                    method: "POST",
                    data: {
                        filter_search: search,
                        arrangeAds: $("#arrangeAds").val()
                    },
                    success: function(res) {
                        $(".table-ads-box").empty().html(res);
                    }
                });
            } else {
                showAds();
            }
        });

        $("#arrangeAds").on("change", function() {
            const arrangeAds = $(this).val();
            $.ajax({
                url: "handles/search/filter_search_ads.php",
                method: "POST",
                data: {
                    filter_search: $("#filter-search-ads").val(),
                    arrangeAds: arrangeAds
                },
                success: function(res) {
                    $(".table-ads-box").empty().html(res);
                }
            });
        });

        $(document).on('input', "#input-product-name", function() {
            var search = $(this).val();
            if (search !== "") {
                $.ajax({
                    url: "handles/search/search_product.php",
                    method: "POST",
                    data: {
                        product_name: search
                    },
                    success: function(response) {
                        $("#search-result-product").show().html(response);
                        $(".product-name").click(function() {
                            var productName = $(this).text();
                            $("#input-product-name").val(productName);
                            $("#search-result-product").hide().empty();
                        })
                    }
                });
            } else {
                $("#search-result-product").hide().empty();
            }
        })
    });
</script>