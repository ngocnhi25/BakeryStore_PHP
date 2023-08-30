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

<head>
    <style>
        .container-filter-table-coupon {
            position: relative;
            width: 100%;
            margin-top: 30px;
        }

        .table-coupon {
            width: 100%;
            border-collapse: collapse;
            position: relative;
        }

        .table-coupon thead th {
            font-size: 13px;
            color: #000;
            padding: 0.5rem;
            text-align: center;
            position: sticky;
            top: 0;
            left: 0;
            background-color: #e2ebee;
            text-transform: capitalize;
            font-weight: 600;
        }

        .table-coupon thead th:last-child {
            border: none;
        }

        .table-coupon thead th:first-child,
        .table-coupon tbody td:first-child {
            text-align: center;
            width: 3.7rem;
        }

        .table-coupon tbody tr:nth-child(even) {
            background-color: #0000000b;
        }

        .table-coupon tbody tr:hover {
            background-color: #d7f4f7e3 !important;
        }

        .table-coupon td {
            border-collapse: collapse;
            padding: 0.6rem;
            text-align: center;
            color: #717171;
        }

        .table-coupon-box,
        .table-sale-box {
            margin-top: 1rem;
            width: 100%;
            overflow: hidden;
            border-radius: 0.6rem;
            box-shadow: 0 0 3px #d2d2d2;
            overflow: auto;
        }

        .container-filter-table-sale {
            position: relative;
            width: 100%;
        }

        .sale-box-temp {
            margin-top: 30px;
        }

        .sale-box-temp .sale-box {
            display: flex;
            gap: 2rem;
            margin-top: 20px;
        }

        .sale-box-temp .sale-box .pagination-sale,
        .container-filter-table-coupon .pagination-coupon {
            position: absolute;
            display: flex;
            gap: 0.5rem;
            font-size: 16px;
            top: 0;
            right: 20px;
        }

        .sale-box-temp .sale-box .pagination-sale button,
        .container-filter-table-coupon .pagination-coupon button {
            box-shadow: none;
            padding: 0.2rem 0.5rem;
        }

        .sale-box-temp .sale-box .pagination-sale button:hover,
        .container-filter-table-coupon .pagination-coupon button:hover {
            background-color: #57b3ff;
        }

        .sale-box-temp .sale-box .pagination-sale button span,
        .container-filter-table-coupon .pagination-coupon button span {
            font-size: 12px;
        }

        .sale-page .filter-action {
            display: flex;
            gap: 1rem;
            align-items: center;
        }
    </style>
</head>

<div class="sale-page">
    <div>
        <h1>Voucher management</h1>
        <div class="add-coupon">
            <div class="coupon-left">
                <div class="input-container">
                    <p>Voucher code:</p>
                    <div class="box-input">
                        <input type="text" id="input-coupon-name" value="<?= ($idCoupon != null ? $couponUpdate["coupon_name"] : '') ?>">
                    </div>
                    <div class="error errorCouponName"></div>
                </div>
                <div class="input-container">
                    <p>Start date:</p>
                    <div class="box-input">
                        <input type="date" id="input-start-date-coupon" value="<?= ($idCoupon != null ? $couponUpdate["start_date"] : '') ?>">
                    </div>
                    <div class="error errorStartDate"></div>
                </div>
                <div class="input-container">
                    <p>End date:</p>
                    <div class="box-input">
                        <input type="date" id="input-end-date-coupon" value="<?= ($idCoupon != null ? $couponUpdate["end_date"] : '') ?>">
                    </div>
                    <div class="error errorEndDate"></div>
                </div>
            </div>
            <div class="coupon-right">
                <div class="input-container">
                    <p>Reduction amount:</p>
                    <div class="box-input">
                        <input type="text" id="input-discount" value="<?= ($idCoupon != null ? $couponUpdate["discount_coupon"] : '') ?>" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                    </div>
                    <div class="error errorDiscount"></div>
                </div>
                <div class="input-container">
                    <p>Conditions of using the code:</p>
                    <div class="box-input">
                        <input type="text" id="input-condition" value="<?= ($idCoupon != null ? $couponUpdate["condition_used_coupon"] : '') ?>" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                    </div>
                    <div class="error errorCondition"></div>
                </div>
                <div class="input-container">
                    <p>Number of times users use:</p>
                    <div class="box-input">
                        <input type="text" id="input-qti-used" value="<?= ($idCoupon != null ? $couponUpdate["qti_used_coupon"] : '') ?>" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                    </div>
                    <div class="error errorQtiUsed"></div>
                </div>
                <div class="input-container">
                    <p>Number of voucher:</p>
                    <div class="box-input">
                        <input type="text" id="input-qti-coupon" value="<?= ($idCoupon != null ? $couponUpdate["qti_coupon"] : '') ?>" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                    </div>
                    <div class="error errorQtiCoupon"></div>
                </div>
            </div>
            <button id="addCoupon" type="button" class="submit addCoupon"><?= ($idCoupon != null ? 'Save update' : 'Save') ?></button>
        </div>
        <div class="container-filter-table-coupon">
            <div class="filter-action">
                <div class="select-container">
                    <select name="category" class="select-box" id="arrangeCoupon">
                        <option value="new_to_old">new - old</option>
                        <option value="old_to_new">old - new</option>
                        <option value="a_z">a - z</option>
                        <option value="z_a">z - a</option>
                    </select>
                </div>
                <div class="form-search-header">
                    <span class="material-symbols-sharp icon">search</span>
                    <input id="filter-search-coupon" type="text" name="search" placeholder="Search product..." class="form-control">
                </div>
            </div>
            <div class="table-coupon-box"></div>
        </div>
    </div>
    <div class="sale-box-temp">
        <h1>Sale product management</h1>
        <div class="sale-box">
            <div class="add-sale">
                <div class="sale-left">
                    <div class="input-container">
                        <p>Product name:</p>
                        <div class="search-product">
                            <div class="box-input">
                                <input type="text" id="input-product-name" value="<?= ($idSale != null ? $saleUpdate["product_name"] : '') ?>" <?= ($idSale != null ? 'readonly' : '') ?>>
                            </div>
                            <div id="search-result-product"></div>
                        </div>
                        <div class="error errorProductName"></div>
                    </div>
                    <div class="input-container">
                        <p>Percent sale:</p>
                        <div class="box-input">
                            <input type="text" id="input-percent" value="<?= ($idSale != null ? $saleUpdate["percent_sale"] : '') ?>" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                        </div>
                        <div class="error errorPercent"></div>
                    </div>
                    <div class="input-container">
                        <p>Start date:</p>
                        <div class="box-input">
                            <input type="date" id="input-start-date-sale" value="<?= ($idSale != null ? $saleUpdate["start_date"] : '') ?>">
                        </div>
                        <div class="error errorStartDateSale"></div>
                    </div>
                    <div class="input-container">
                        <p>End date:</p>
                        <div class="box-input">
                            <input type="date" id="input-end-date-sale" value="<?= ($idSale != null ? $saleUpdate["end_date"] : '') ?>">
                        </div>
                        <div class="error errorEndDateSale"></div>
                    </div>
                    <button id="addSaleProduct" type="button" class="submit"><?= ($idSale != null ? 'Save update' : 'Save') ?></button>
                </div>
            </div>
            <div class="container-filter-table-sale">
                <div class="filter-action">
                    <div class="select-container">
                        <select name="category" class="select-box" id="arrangeSale">
                            <option value="new_to_old">new - old</option>
                            <option value="old_to_new">old - new</option>
                            <option value="a_z">a - z</option>
                            <option value="z_a">z - a</option>
                            <option value="ascending_percent">ascending percentage</option>
                            <option value="decreasing_percent">decreasing percentage</option>
                        </select>
                    </div>
                    <div class="form-search-header">
                        <span class="material-symbols-sharp icon">search</span>
                        <input id="filter-search-sale" type="text" name="search" placeholder="Search product..." class="form-control">
                    </div>
                </div>
                <div class="table-sale-box"></div>
            </div>
        </div>
    </div>
    <div id="success">
        <div class="message">
            <p>
                <?php if ($idCoupon != null) {
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
</script>
<script src="../../public/backend/js/sale.js"></script>