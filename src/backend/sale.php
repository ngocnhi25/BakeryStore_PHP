<?php
require_once('../connect/connectDB.php');
require_once('../handles_page/handle_calculate.php');

$idCoupon = $idSale = '';
$coupons = executeResult("SELECT * from tb_coupon ORDER BY coupon_id DESC");
$products = executeResult("SELECT * from tb_products");
$sale = executeResult("SELECT * from tb_sale s INNER JOIN tb_products p ON s.product_id = p.product_id ORDER BY sale_id DESC");

if (isset($_POST["idCoupon"]) && !empty($_POST["idCoupon"])) {
    $idCoupon = $_POST["idCoupon"];
    $couponUpdate = executeSingleResult("SELECT * from tb_coupon where coupon_id = $idCoupon");
}
if (isset($_POST["idSale"]) && !empty($_POST["idSale"])) {
    $idSale = $_POST["idSale"];
    $saleUpdate = executeSingleResult("SELECT * from tb_sale s INNER JOIN tb_products p ON s.product_id = p.product_id where s.sale_id = $idSale");
}


?>

<div style=" width: 100%; padding-bottom: 30px;">
    <div>
        <h1>Add new coupon</h1>
        <form action="">
            <div class="add-coupon">
                <div class="coupon-left">
                    <div class="coupon-input">
                        <p>Coupon code:</p>
                        <div class="box-input">
                            <input type="text" id="input-coupon-name" value="<?= ($idCoupon != null ? $couponUpdate["coupon_name"] : '') ?>">
                        </div>
                        <div class="error errorCouponName"></div>
                    </div>
                    <div class="coupon-input">
                        <p>Reduction amount:</p>
                        <div class="box-input">
                            <input type="text" id="input-discount" value="<?= ($idCoupon != null ? $couponUpdate["discount_coupon"] : '') ?>" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                        </div>
                        <div class="error errorDiscount"></div>
                    </div>
                    <div class="coupon-input">
                        <p>Start date:</p>
                        <div class="box-input">
                            <input type="date" id="input-start-date-coupon" value="<?= ($idCoupon != null ? $couponUpdate["start_date"] : '') ?>">
                        </div>
                        <div class="error errorStartDate"></div>
                    </div>
                    <div class="coupon-input">
                        <p>End date:</p>
                        <div class="box-input">
                            <input type="date" id="input-end-date-coupon" value="<?= ($idCoupon != null ? $couponUpdate["end_date"] : '') ?>">
                        </div>
                        <div class="error errorEndDate"></div>
                    </div>
                </div>
                <div class="coupon-right">
                    <div class="coupon-input">
                        <p>Conditions of using the code:</p>
                        <div class="box-input">
                            <input type="text" id="input-condition" value="<?= ($idCoupon != null ? $couponUpdate["condition_used_coupon"] : '') ?>" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                        </div>
                        <div class="error errorCondition"></div>
                    </div>
                    <div class="coupon-input">
                        <p>Number of times users use:</p>
                        <div class="box-input">
                            <input type="text" id="input-qti-used" value="<?= ($idCoupon != null ? $couponUpdate["qti_used_coupon"] : '') ?>" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                        </div>
                        <div class="error errorQtiUsed"></div>
                    </div>
                    <div class="coupon-input">
                        <p>Number of coupon:</p>
                        <div class="box-input">
                            <input type="text"  id="input-qti-coupon" value="<?= ($idCoupon != null ? $couponUpdate["qti_coupon"] : '') ?>" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                        </div>
                        <div class="error errorQtiCoupon"></div>
                    </div>
                </div>
            </div>
            <div>
                <button id="addCoupon" type="button" class="create"><?= ($idCoupon != null ? 'Save update' : 'Save') ?></button>
            </div>
        </form>
        <div>
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>Code</th>
                        <th>Reduction amount</th>
                        <th>Conditions of use</th>
                        <th>Users use</th>
                        <th>Quantity coupon</th>
                        <th>Start date</th>
                        <th>End date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($coupons as $key => $c) { ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= $c["coupon_name"] ?></td>
                            <td><?= displayPrice($c["discount_coupon"]) ?> vnđ</td>
                            <td><?= displayPrice($c["condition_used_coupon"]) ?> vnđ</td>
                            <td><?= $c["qti_used_coupon"] ?></td>
                            <td><?= $c["qti_coupon"] ?></td>
                            <td><?= $c["start_date"] ?></td>
                            <td><?= $c["end_date"] ?></td>
                            <td>
                                <button onclick="updateCoupon(<?= $c['coupon_id'] ?>)" class="update">Update</button>
                                <button onclick="deleteCoupon('<?= $c['coupon_name'] ?>', <?= $c['coupon_id'] ?>)" class="delete">Delete</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div>
        <h1>Sale product management</h1>
        <div>
            <form action="">
                <div class="add-coupon">
                    <div class="coupon-left">
                        <div class="coupon-input">
                            <p>Product name:</p>
                            <div class="search-product">
                                <div class="box-input">
                                    <input type="text" id="input-product-name" value="<?= ($idSale != null ? $saleUpdate["product_name"] : '') ?>" <?= ($idSale != null ? 'readonly' : '') ?>>
                                </div>
                                <div id="search-result-product"></div>
                            </div>
                            <div class="error errorProductName"></div>
                        </div>
                        <div class="coupon-input">
                            <p>Percent sale:</p>
                            <div class="box-input">
                                <input type="text" id="input-percent" value="<?= ($idSale != null ? $saleUpdate["percent_sale"] : '') ?>" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                            </div>
                            <div class="error errorPercent"></div>
                        </div>
                        <div class="coupon-input">
                            <p>Start date:</p>
                            <div class="box-input">
                                <input type="date" id="input-start-date-sale" value="<?= ($idSale != null ? $saleUpdate["start_date"] : '') ?>">
                            </div>
                            <div class="error errorStartDateSale"></div>
                        </div>
                        <div class="coupon-input">
                            <p>End date:</p>
                            <div class="box-input">
                                <input type="date" id="input-end-date-sale" value="<?= ($idSale != null ? $saleUpdate["end_date"] : '') ?>">
                            </div>
                            <div class="error errorEndDateSale"></div>
                        </div>
                    </div>
                </div>
                <div>
                    <button id="addSaleProduct" type="button" class="create"><?= ($idSale != null ? 'Save update' : 'Save') ?></button>
                </div>
            </form>
        </div>
        <div>
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>Product name</th>
                        <th>Percent sale</th>
                        <th>Start date</th>
                        <th>End date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sale as $key => $s) { ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= $s["product_name"] ?></td>
                            <td><?= $s["percent_sale"] ?>%</td>
                            <td><?= $s["start_date"] ?></td>
                            <td><?= $s["end_date"] ?></td>
                            <td>
                                <button onclick="updateSale(<?= $s['sale_id'] ?>)" type="button" class="update">Update</button>
                                <button onclick="deleteSale('<?= $s['product_name'] ?>', <?= $s['sale_id'] ?>)" type="button" class="delete">Delete</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div id="success">
        <div class="message">
            <p>
                <?php if($idCoupon != null) {
                    echo 'Coupon has been successfully updated!';
                } elseif ($idSale != null) {
                    echo 'Successfully updated promotional products!';
                } else {
                    echo "Added success!";
                } ?>
            </p>
            <div class="button-success">
                <button id="okButton">Ok</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    
    $("#success").hide();
    
    $("#addCoupon").click(function(e) {
        e.preventDefault();
        $(document).ready(function() {
            var formData = new FormData();

            <?php if ($idCoupon != null) { ?>
                formData.append("id", <?php echo $idCoupon ?>);
            <?php } ?>

            formData.append("codeCoupon", $('#input-coupon-name').val());
            formData.append("discount", $('#input-discount').val());
            formData.append("condition", $('#input-condition').val());
            formData.append("qtiUsed", $('#input-qti-used').val());
            formData.append("qtiCoupon", $('#input-qti-coupon').val());
            formData.append("startDate", $('#input-start-date-coupon').val());
            formData.append("endDate", $('#input-end-date-coupon').val());

            $.ajax({
                type: "POST",
                url: 'handles/creates/coupon.php',
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) {
                    if (res === 'success') {
                        showSuccessMessage("sale.php");
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
    });

    $("#addSaleProduct").click(function(e) {
        e.preventDefault();
        $(document).ready(function() {
            var formData = new FormData();

            <?php if ($idSale != null) { ?>
                formData.append("id", <?php echo $idSale ?>);
            <?php } ?>

            formData.append("product_name", $('#input-product-name').val());
            formData.append("percent", $('#input-percent').val());
            formData.append("startDate", $('#input-start-date-sale').val());
            formData.append("endDate", $('#input-end-date-sale').val());

            $.ajax({
                type: "POST",
                url: 'handles/creates/sale.php',
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) {
                    alert(res)
                    if (res === 'success') {
                        showSuccessMessage("sale.php");
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
    });

    function updateCoupon(id) {
        var postData = {
            idCoupon: id
        }
        ajaxPageData("sale.php", postData);
    }

    function deleteCoupon(couponName, id) {
        const html = `
            <div class="message-confirm-box">
                <div class="message-confirm">
                    <div>Are you sure to permanently delete coupon ${couponName}?</div>
                    <div>
                        <button class="cancel" type="button">Cancal</button>
                        <button id="delete-coupon" class="delete" type="button">Delete</button>
                    </div>
                </div>
            </div>
        `;
        $("body").append(html);

        $(".cancel").click(function() {
            $(".message-confirm-box").remove();
        });

        $("#delete-coupon").click(function() {
            $.post(
                "handles/deletes/coupon.php", {
                    id: id
                },
                function(res) {
                    $(".message-confirm-box").remove();
                    ajaxPages(res);
                }
            )
        });
    }

    $(document).ready(function() {
        $("#input-product-name").on("input", function() {
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
        });
    });

    function updateSale(id) {
        var postData = {
            idSale: id
        }
        ajaxPageData("sale.php", postData);
    }

    function deleteSale(productName, id) {
        const html = `
            <div class="message-confirm-box">
                <div class="message-confirm">
                    <div>Are you sure to permanently delete the promotional product ${productName}?</div>
                    <div>
                        <button class="cancel" type="button">Cancal</button>
                        <button id="delete-sale" class="delete" type="button">Delete</button>
                    </div>
                </div>
            </div>
        `;
        $("body").append(html);

        $(".cancel").click(function() {
            $(".message-confirm-box").remove();
        });

        $("#delete-sale").click(function() {
            $.post(
                "handles/deletes/sale.php", {
                    id: id
                },
                function(res) {
                    $(".message-confirm-box").remove();
                    ajaxPages(res);
                }
            )
        });
    }
</script>