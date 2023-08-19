<?php
require_once('../connect/connectDB.php');

$id = '';

if(isset($_POST["id"]) && !empty($_POST["id"])){
    $id = $_POST["id"];
}

?>

<head>
    <style>
        .add-coupon {
            display: flex;
            gap: 2rem;
        }

        .coupon-input .box-input input {
            width: 300px;
            padding: 10px;
            border: 1px solid;
            outline: none;
            border-radius: 3px;
            font-size: 16px;
            color: #141212;
            transition: .5s;
        }

        .coupon-input p {
            font-size: 16px;
            font-weight: 500;
            color: #020202;
        }

        .coupon-input .error {
            color: #f13e02;
            font-size: 12px;
        }
    </style>
</head>
<div style=" width: 100%;">
    <div>
        <h1>Add new coupon</h1>
        <form action="">
            <div class="add-coupon">
                <div class="coupon-left">
                    <div class="coupon-input">
                        <p>Coupon code:</p>
                        <div class="box-input">
                            <input type="text" name="coupon_name" id="input-coupon-name">
                        </div>
                        <div class="error errorCouponName"></div>
                    </div>
                    <div class="coupon-input">
                        <p>Reduction amount:</p>
                        <div class="box-input">
                            <input type="text" name="discount" id="input-discount">
                        </div>
                        <div class="error errorDiscount"></div>
                    </div>
                    <div class="coupon-input">
                        <p>Start date:</p>
                        <div class="box-input">
                            <input type="text" name="start_date" id="input-start-date">
                        </div>
                        <div class="error errorStartDate"></div>
                    </div>
                    <div class="coupon-input">
                        <p>End date:</p>
                        <div class="box-input">
                            <input type="text" name="end_date" id="input-end-date">
                        </div>
                        <div class="error errorEndDate"></div>
                    </div>
                </div>
                <div class="coupon-right">
                    <div class="coupon-input">
                        <p>Conditions of using the code:</p>
                        <div class="box-input">
                            <input type="text" name="condition" id="input-condition">
                        </div>
                        <div class="error errorCondition"></div>
                    </div>
                    <div class="coupon-input">
                        <p>Number of times users use:</p>
                        <div class="box-input">
                            <input type="text" name="qti_used" id="input-qti-used">
                        </div>
                        <div class="error errorQtiUsed"></div>
                    </div>
                    <div class="coupon-input">
                        <p>Number of coupon:</p>
                        <div class="box-input">
                            <input type="text" name="qti_coupon" id="input-qti-coupon">
                        </div>
                        <div class="error errorQtiCoupon"></div>
                    </div>
                </div>
            </div>
            <div>
                <button id="addCoupon" type="button" class="create">Save</button>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $("#addCoupon").click(function(e) {
        e.preventDefault();
        $(document).ready(function() {
            var formData = new FormData();

            <?php if ($id != null) { ?>
                formData.append("id", <?php echo $id ?>);
            <?php } ?>

            formData.append("codeCoupon", $('#input-coupon-name').val());
            formData.append("discount", $('#input-discount').val());
            formData.append("condition", $('#input-condition').val());
            formData.append("qtiUsed", $('#input-qti-used').val());
            formData.append("qtiCoupon", $('#input-qti-coupon').val());
            formData.append("startDate", $('#input-start-date').val());
            formData.append("endDate", $('#input-end-date').val());

            $.ajax({
                type: "POST",
                url: 'handles/creates/sale.php',
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) {
                    alert(res);
                    if (res === 'success') {
                        // showSuccessMessage("ads.php");
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
</script>