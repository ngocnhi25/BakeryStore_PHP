<?php
require_once("../connect/connectDB.php");

$cates = executeResult("SELECT * FROM tb_category");
$products = executeResult("SELECT * FROM tb_products WHERE deleted = 0");
$ads = executeResult("SELECT * FROM tb_ads ORDER BY ads_id DESC");
?>

<head>
    <link rel="stylesheet" href="../../public/backend/css/table.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.js" integrity="sha512-eSeh0V+8U3qoxFnK3KgBsM69hrMOGMBy3CNxq/T4BArsSQJfKVsKb5joMqIPrNMjRQSTl4xG8oJRpgU2o9I7HQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css" integrity="sha512-0nkKORjFgcyxv3HbE4rzFUlENUMNqic/EzDIeYCgsKa/nwqr2B91Vu/tNAu4Q0cBuG4Xe/D1f/freEci/7GDRA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .select-container {
            display: flex;
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

        .ads-page {
            min-width: 100%;
        }

        .ads-page .ads-add {
            border-radius: 10px;
            width: 500px;
            position: relative;
            margin: auto;
            padding: 20px;
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

        .image-box {
            margin-top: 15px;
            margin-bottom: 15px;
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

        .input-box input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid rgba(255, 255, 255, 0.25);
            background-color: blue;
            border-radius: 5px;
            outline: none;
            font-size: 14px;
        }

        .input-box input[type="text"]:valid~span,
        .input-box input[type="text"]:focus~span {
            color: #00dfc4;
            transform: translateX(10px) translateY(-7px);
            font-size: 12px;
            padding: 0 10px;
            background: #206a5d;
            border-left: 1px solid black;
            border-right: 1px solid black;
        }

        .image-banner {
            width: 300px;
        }

        .image-banner img {
            width: 100%;
            vertical-align: middle;
        }

        .table_ads {
            width: 800px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            overflow: auto;
            height: 600px;

        }
    </style>
</head>

<div class="ads-page">
    <h1>Advertising Management</h1>
    <div class="ads-add">
        <div class="ads-event">
            <h2>Create Advertising</h2>
        </div>
        <form id="adsForm" method="post" enctype="multipart/form-data" action="">
            <div class="type-ads-box">
                <label for="">Type advertisement</label> <br>
                <div class="type-ads">
                    <div class="select-container">
                        <select name="typeAds" id="typeAds" class="select-box" onchange="checkTypeAds()">
                            <option value="">______Option______</option>
                            <option value="sale">Sale</option>
                            <option value="category">Category</option>
                            <option value="product">Product</option>
                            <option value="news">News</option>
                        </select>
                    </div>
                    <div class="checkCate"></div>
                </div>
                <p style="color: red;" class="errorTypeAds"></p>
            </div>
            <div class="image-box">
                <label for="">Image advertisement</label> <br>
                <input id="imageAds" type="file" name="imageAds">
                <div id="preview-images"></div>
                <p style="color: red;" class="errorImages"></p>
            </div>
            <div class="ads-date">
                <div class="start-date-box">
                    <label for="">Start Date</label> <br>
                    <input id="startDate" type="date" name="startDate">
                </div>
                <div class="end-date-box">
                    <label for="">End Date</label> <br>
                    <input id="endDate" type="date" name="endDate">
                </div>
            </div>
            <p style="color: red;" class="errorDate"></p>
            <div class="ads-event">
                <button id="addAds" class="submit" type="button">Add</button>
            </div>
        </form>
    </div>
    <div class="table_ads scroll-table">
        <table>
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
                        <td><?= $a["type_ads"] ?></td>
                        <td class="image-banner">
                            <img src="../../<?= $a["image_ads"] ?>" alt="">
                        </td>
                        <td><?= $a["start_date"] ?></td>
                        <td><?= $a["end_date"] ?></td>
                        <td>
                            <button class="delete" type="button" onclick="deleteAds(<?= $a['ads_id'] ?>)">Delete</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
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
    $("#success").hide();

    function checkTypeAds() {
        $(document).ready(function() {
            var checkCate = $("#typeAds").val();

            if (checkCate == "category") {
                const html = `
                    <div class="select-container">
                        <select name="cateID" class="select-box">
                            <option value="">___Category Name___</option>
                            <?php foreach ($cates as $c) { ?>
                                <option value="<?= $c["cate_id"] ?>"><?= $c["cate_name"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                `;
                $(".checkCate").empty().append(html);
            } else if (checkCate == "product") {
                const html = `
                    <div class="select-container">
                        <select name="productID" class="select-box">
                            <option value="">___Product Name___</option>
                            <?php foreach ($products as $p) { ?>
                                <option value="<?= $p["product_id"] ?>"><?= $p["product_name"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                `;
                $(".checkCate").empty().append(html);
            } else {
                $(".checkCate").empty();
            }
        })
    }

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
        });
    });

    function deleteAds(id) {
        $.post(
            "handles/deletes/ads.php", {
                id: id
            },
            function(data) {
                ajaxPages(data);
            }
        )
    }
</script>