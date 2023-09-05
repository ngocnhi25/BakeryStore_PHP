<?php
require_once "connect/connectDB.php";
require_once "handles_page/handle_calculate.php";
session_start();
if (isset($_SESSION["auth_user"])) {
    $user_name = $_SESSION["auth_user"]["username"];
    $user_id = $_SESSION["auth_user"]["user_id"];
}

$arrayPrepare = $arrayPending = [];

$orders = executeResult("SELECT * FROM tb_order where user_id = $user_id");
$orders_details = executeResult("SELECT * FROM tb_order_detail o
                                    INNER JOIN tb_products p
                                    ON o.product_id = p.product_id where user_id = $user_id");
$orders_details_prepare = executeResult("
SELECT od.*, p.product_name, p.image, p.price, o.status as order_status
FROM tb_order_detail od
INNER JOIN tb_products p ON od.product_id = p.product_id
INNER JOIN tb_order o ON od.order_id = o.order_id
WHERE od.user_id = $user_id
AND o.status = 'preapre'
");
function noOrderYet()
{
    echo '
    <div class="no-order-yet">
        <div>
            <img src="../public/images/icon/checklist.png" alt="">
            <p class="no-data">No orders yet</p>
        </div>
    </div>
    ';
}

?>
<div class="purchase-order">
    <div class="po-tab-ui">
        <div class="tabs">
            <div class="tab-item active" data-tab="all">All</div>
            <div class="tab-item" data-tab="prepare">Prepare</div>
            <div class="tab-item" data-tab="shipping">Shipping</div>
            <div class="tab-item" data-tab="completed">Completed</div>
            <div class="tab-item" data-tab="cancelled">Cancelled</div>
            <div class="tab-item" data-tab="return">Return</div>
        </div>
    </div>
    <div class="po-search">
        <span class="material-symbols-sharp">search</span>
        <input type="text" placeholder="You can search by product name or product category">
    </div>
    <div class="po-content-box">
        <div class="content active" data-content="all">
            <?php if ($orders != null) {
    foreach ($orders as $key => $o) {
        ?>
                                                                                                                    <div class="item-product-box">
                                                                                                                        <?php foreach ($orders_details as $key => $od) {
            if ($od["order_id"] == $o["order_id"]) {?>
                                                                                                                                                                                                                                <div class="detail-order">
                                                                                                                                                                                                                                    <div class="inf-prd">
                                                                                                                                                                                                                                        <div>
                                                                                                                                                                                                                                            <img src="../<?=$od["image"]?>" alt="">
                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                        <div class="inf-text">
                                                                                                                                                                                                                                            <div class="prd-name"><?=$od["product_name"]?></div>
                                                                                                                                                                                                                                            <div class="galary"><span>Size: <?=$od["size"]?>cm</span> <span>Flavor: <?=$od["flavor"]?></span></div>
                                                                                                                                                                                                                                            <div>x<?=$od["quantity"]?></div>
                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                    <div class="prd-price">
                                                                                                                                                                                                                                        <?php if ($od["sale_product"] != 0) {?>
                                                                                                                                                                                                                                                                                            <span class="price-del"><?php echo $od["total_money"] ?> vnđ</span>
                                                                                                                                                                                                                                                                                            <span class="price-hight-light"><?php echo $od["sale_product"] ?> vnđ</span>
                                                                                                                                                                                                                                        <?php } else {?>
                                                                                                                                                                                                                                                                                            <span class="price-hight-light"><?php echo displayPrice($od["price"]) ?> vnđ</span>
                                                                                                                                                                                                                                        <?php }?>
                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                </div>
                                                                                                                                                                        <?php }
        }?>
                                                                                                                        <div class="status-cal">
                                                                                                                            <div class="status-ord">
                                                                                                                                <span class="<?=$o["status"]?>"><?=$o["status"]?></span>
                                                                                                                            </div>
                                                                                                                            <div class="cal-total">
                                                                                                                            <button class="btn btn-danger cancel-btn" data-order-id="<?=$o["order_id"]?>">Cancel</button>
                                                                                                                            <button class="btn btn-success success-btn" data-order-id="<?=$od["order_id"]?>">Success</button>

                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                            <?php }
} else {
}?>


        </div>
        <div class="content" data-content="prepare">
        <?php
$orders_details_completed = executeResult("
    SELECT od.*, p.product_name, p.image, p.price, o.status as order_status
    FROM tb_order_detail od
    INNER JOIN tb_products p ON od.product_id = p.product_id
    INNER JOIN tb_order o ON od.order_id = o.order_id
    WHERE od.user_id = $user_id
    AND o.status = 'prepare'
");

if (!empty($orders_details_completed)) {
    foreach ($orders_details_completed as $od) {
        ?>
                                                                                            <div class="item-product-box">
                                                                                                <div class="detail-order">
                                                                                                    <div class="inf-prd">
                                                                                                        <div>
                                                                                                            <img src="../<?=$od["image"]?>" alt="">
                                                                                                        </div>
                                                                                                        <div class="inf-text">
                                                                                                            <div class="prd-name"><?=$od["product_name"]?></div>
                                                                                                            <div class="galary"><span>Size: <?=$od["size"]?>cm</span> <span>Flavor: <?=$od["flavor"]?></span></div>
                                                                                                            <div>x<?=$od["quantity"]?></div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="prd-price">
                                                                                                        <?php if ($od["sale_product"] != 0) {?>
                                                                                                                                                        <span class="price-del"><?=$od["total_money"]?> vnđ</span>
                                                                                                                                                        <span class="price-hight-light"><?=$od["sale_product"]?> vnđ</span>
                                                                                                        <?php } else {?>
                                                                                                                                                        <span class="price-hight-light"><?=displayPrice($od["price"])?> vnđ</span>
                                                                                                        <?php }?>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="status-cal">
                                                                                                    <div class="status-ord">
                                                                                                        <span class="<?=$od["order_status"]?>"><?=$od["order_status"]?></span>
                                                                                                    </div>

                                                                                                </div>
                                                                                            </div>
                                                                                        <?php
}
} else {
    noOrderYet();
}
?>

        </div>

        <div class="content" data-content="shipping">
        <?php
$orders_details_completed = executeResult("
    SELECT od.*, p.product_name, p.image, p.price, o.status as order_status
    FROM tb_order_detail od
    INNER JOIN tb_products p ON od.product_id = p.product_id
    INNER JOIN tb_order o ON od.order_id = o.order_id
    WHERE od.user_id = $user_id
    AND o.status = 'shipping'
");

if (!empty($orders_details_completed)) {
    foreach ($orders_details_completed as $od) {
        ?>
                                                                                            <div class="item-product-box">
                                                                                                <div class="detail-order">
                                                                                                    <div class="inf-prd">
                                                                                                        <div>
                                                                                                            <img src="../<?=$od["image"]?>" alt="">
                                                                                                        </div>
                                                                                                        <div class="inf-text">
                                                                                                            <div class="prd-name"><?=$od["product_name"]?></div>
                                                                                                            <div class="galary"><span>Size: <?=$od["size"]?>cm</span> <span>Flavor: <?=$od["flavor"]?></span></div>
                                                                                                            <div>x<?=$od["quantity"]?></div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="prd-price">
                                                                                                        <?php if ($od["sale_product"] != 0) {?>
                                                                                                                                                        <span class="price-del"><?=$od["total_money"]?> vnđ</span>
                                                                                                                                                        <span class="price-hight-light"><?=$od["sale_product"]?> vnđ</span>
                                                                                                        <?php } else {?>
                                                                                                                                                        <span class="price-hight-light"><?=displayPrice($od["price"])?> vnđ</span>
                                                                                                        <?php }?>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="status-cal">
                                                                                                    <div class="status-ord">
                                                                                                        <span class="<?=$od["order_status"]?>"><?=$od["order_status"]?></span>
                                                                                                    </div>


                                                                                                </div>
                                                                                            </div>
                                                                                        <?php
}
} else {
    noOrderYet();
}
?>
        </div>

        <div class="content" data-content="completed">
        <?php
$orders_details_completed = executeResult("
    SELECT od.*, p.product_name, p.image, p.price, o.status as order_status
    FROM tb_order_detail od
    INNER JOIN tb_products p ON od.product_id = p.product_id
    INNER JOIN tb_order o ON od.order_id = o.order_id
    WHERE od.user_id = $user_id
    AND o.status = 'completed'
");

if (!empty($orders_details_completed)) {
    foreach ($orders_details_completed as $od) {
        ?>
                                                                                            <div class="item-product-box">
                                                                                                <div class="detail-order">
                                                                                                    <div class="inf-prd">
                                                                                                        <div>
                                                                                                            <img src="../<?=$od["image"]?>" alt="">
                                                                                                        </div>
                                                                                                        <div class="inf-text">
                                                                                                            <div class="prd-name"><?=$od["product_name"]?></div>
                                                                                                            <div class="galary"><span>Size: <?=$od["size"]?>cm</span> <span>Flavor: <?=$od["flavor"]?></span></div>
                                                                                                            <div>x<?=$od["quantity"]?></div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="prd-price">
                                                                                                        <?php if ($od["sale_product"] != 0) {?>
                                                                                                                                                        <span class="price-del"><?=$od["total_money"]?> vnđ</span>
                                                                                                                                                        <span class="price-hight-light"><?=$od["sale_product"]?> vnđ</span>
                                                                                                        <?php } else {?>
                                                                                                                                                        <span class="price-hight-light"><?=displayPrice($od["price"])?> vnđ</span>
                                                                                                        <?php }?>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="status-cal">
                                                                                                    <div class="status-ord">
                                                                                                        <span class="<?=$od["order_status"]?>"><?=$od["order_status"]?></span>
                                                                                                    </div>
                                                                                                    <div class="cal-total">
                                                                            <button class="btn btn-warning return-btn" data-order-id="<?=$od["order_id"]?>" data-product-id="<?=$od["product_id"]?>">Return</button>
                                                                        </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        <?php
}
} else {
    noOrderYet();
}
?>

        </div>
        <div class="content" data-content="cancelled">
        <?php
$cancelled_orders = executeResult("
    SELECT od.*, p.product_name, p.image, p.price, o.status as order_status
    FROM tb_order_detail od
    INNER JOIN tb_products p ON od.product_id = p.product_id
    INNER JOIN tb_order o ON od.order_id = o.order_id
    WHERE o.status = 'cancelled' AND od.user_id = $user_id
");

if (!empty($cancelled_orders)) {
    foreach ($cancelled_orders as $order) {
        ?>
        <div class="item-product-box">
            <div class="detail-order">
                <div class="inf-prd">
                    <div>
                        <img src="../<?=$order["image"]?>" alt="">
                    </div>
                    <div class="inf-text">
                        <div class="prd-name"><?=$order["product_name"]?></div>
                        <div class="galary"><span>Size: <?=$order["size"]?>cm</span> <span>Flavor: <?=$order["flavor"]?></span></div>
                        <div>x<?=$order["quantity"]?></div>
                    </div>
                </div>
                <div class="prd-price">
                    <?php if ($order["sale_product"] != 0) {?>
                        <span class="price-del">item price: <?=displayPrice($order["price"])?> vnđ</span>
                        <span class="price-hight-light"><?=calculateOldPrice($order["price"], $order["sale_product"])?> vnđ</span>
                    <?php } else {?>
                        <span class="price-hight-light"><?=displayPrice($order["price"])?> vnđ</span>
                    <?php }?>
                </div>
            </div>
            <div class="status-cal">
                <div class="status-ord">
                    <span class="<?=$order["order_status"]?>"><?=$order["order_status"]?></span>
                </div>
                <div class="cal-total">
                    <!-- Your action buttons here -->
                </div>
            </div>
        </div>
        <?php
}
} else {
    noOrderYet();
}
?>


        </div>
        <div class="content" data-content="return">

        </div>
    </div>
    
</div>

</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</div>
<script>
    $(".po-tab-ui .tabs .tab-item").click(function(e) {
        e.preventDefault();
        $(this).siblings().removeClass("active");
        $(this).addClass("active");
        var selectedTab = $(this).data('tab');
        $('.content').removeClass('active');
        $('.content[data-content="' + selectedTab + '"]').addClass('active');
    });

    

    $(document).ready(function () {
        $(".cancel-btn").click(function () {
            const order_id = $(this).data("order-id");
            handleCancellation(order_id);
        });

        $(".return-btn").click(function () {
            const order_id = $(this).data("order-id");
            const product_id = $(this).data("product-id");
            handleReturn(order_id, product_id);
        });

        $(".success-btn").click(function () {
    // Get the order_id from the data attribute
    var order_id = $(this).data("order-id");
    
    // Define the data object to send
    var data = {
        order_id: order_id,
        new_status: "completed"
    };

    // Send an AJAX request to the PHP script
    $.ajax({
        url: "handles_page/update_order_status.php", // Replace with the actual URL of your PHP script
        type: "POST",
        data: data,
        success: function (response) {
            // Handle the response from the server (e.g., display a success message)
            alert(response);
        },
        error: function () {
            // Handle errors (e.g., show an error message)
            alert("An error occurred.");
        }
    });
});

    });

function handleCancellation(order_id) {
    // Define an array of cancellation reasons
    const cancellationReasons = ["Out of stock", "Change of mind", "Other"];

    Swal.fire({
        title: 'Cancel Order',
        input: 'select',
        inputLabel: 'Reason for cancellation',
        inputOptions: {
            '': '', // Empty option
            ...cancellationReasons.reduce((options, reason) => ({ ...options, [reason]: reason }), {})
        },
        showCancelButton: true,
        confirmButtonText: 'Cancel Order',
        cancelButtonText: 'Close',
        showLoaderOnConfirm: true,
        preConfirm: (selectedReason) => {
            if (!selectedReason) {
                Swal.showValidationMessage('Please select a reason for cancellation.');
            } else {
                return $.ajax({
                    url: "handles_page/update_order_status.php",
                    type: "POST",
                    data: { order_id: order_id, new_status: "cancelled", reason: selectedReason },
                    error: function () {
                        Swal.showValidationMessage('Failed to cancel the order.');
                    }
                });
            }
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        if (result.isConfirmed) {
            handleSuccessPopup('Order Cancelled', result.value);
        }
    });
}



function handleReturn(order_id, product_id) {
    Swal.fire({
        title: 'Return Order',
        html: `
            <label for="return-reason">Reason for return:</label>
            <textarea id="return-reason" class="swal2-input" style="height: 100px;"></textarea>
            <label for="return-image">Upload an image of the issue:</label>
            <input id="return-image" type="file" accept="image/*" class="swal2-file">
        `,
        icon: 'info',
        showCancelButton: true,
        confirmButtonText: 'Return Order',
        cancelButtonText: 'Cancel',
        focusConfirm: false,
        preConfirm: () => {
            const reason = document.getElementById('return-reason').value;
            const imageFile = document.getElementById('return-image').files[0];

            const formData = new FormData();
            formData.append('order_id', order_id);
            formData.append('product_id', product_id);
            formData.append('new_status', 'return');
            formData.append('reason', reason);
            formData.append('image', imageFile);

            return fetch('handles_page/update_order_status.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to return the order.');
                }
                return response.json();
            });
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        if (result.isConfirmed) {
            handleSuccessPopup('Order Returned', 'Your return request has been submitted.');
        }
    });
}


function handleSuccessPopup(title, text) {
    Swal.fire({
        icon: 'success',
        title: title,
        text: text,
        timer: 2000,
        showConfirmButton: false
    });
}





</script>