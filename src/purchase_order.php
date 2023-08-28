<?php
require_once("connect/connectDB.php");
require_once("handles_page/handle_calculate.php");
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


function checkStatus($status)
{
    global $orders, $arrayPrepare, $arrayPending, $arrayCancelled, $arrayCompleted;

    foreach ($orders as $key => $o) {
        if ($o["status"] == $status) {
            if ($status == "prepare") {
                $arrayPrepare[$key] = $o["status"];
                return $arrayPrepare;
            }
            if ($status == "pending") {
                $arrayPending[$key] = $o["status"];
                return $arrayPending;
            }
            if ($status == "cancelled") {
                $arrayCancelled[$key] = $o["status"];
                return $arrayCancelled;
            }
            if ($status == "completed") {
                $arrayCompleted[$key] = $o["status"];
                return $arrayCompleted;
            }
        }
    }
}



?>
<div class="purchase-order">
    <div class="po-tab-ui">
        <div class="tabs">
            <div class="tab-item active" data-tab="all">All</div>
            <div class="tab-item" data-tab="pending">Prepare</div>
            <div class="tab-item" data-tab="pending">Pending</div>
            <div class="tab-item" data-tab="completed">Completed</div>
            <div class="tab-item" data-tab="cancelled">Cancelled</div>
            <div class="tab-item" data-tab="return-refund">Return</div>
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
                            if ($od["order_id"] == $o["order_id"]) { ?>
                                <div class="detail-order">
                                    <div class="inf-prd">
                                        <div>
                                            <img src="../<?= $od["image"] ?>" alt="">
                                        </div>
                                        <div class="inf-text">
                                            <div class="prd-name"><?= $od["product_name"] ?></div>
                                            <div class="galary"><span>Size: <?= $od["size"] ?>cm</span> <span>Flavor: <?= $od["flavor"] ?></span></div>
                                            <div>x<?= $od["quantity"] ?></div>
                                        </div>
                                    </div>
                                    <div class="prd-price">
                                        <?php if ($od["sale_product"] != 0) { ?>
                                            <span class="price-del"><?php echo $od["total_money"] ?> vnđ</span>
                                            <span class="price-hight-light"><?php echo $od["sale_product"] ?> vnđ</span>
                                        <?php } else { ?>
                                            <span class="price-hight-light"><?php echo displayPrice($od["price"]) ?> vnđ</span>
                                        <?php } ?>
                                    </div>
                                </div>
                        <?php }
                        } ?>
                        <div class="status-cal">
                            <div class="status-ord">
                                <span class="<?= $o["status"] ?>"><?= $o["status"] ?></span>
                            </div>
                            <div class="cal-total">
                            <button class="btn btn-danger cancel-btn" data-order-id="<?= $o["order_id"] ?>">Cancel</button>
                            
                            </div>
                        </div>
                    </div>
            <?php }
            } else {
            } ?>


        </div>
        <div class="content" data-content="prepare">
            <?php if (checkStatus("prepare") != null) {
                foreach ($orders as $key => $o) {
                    if ($o["status"] == "prepare") {
            ?>
                        <div class="item-product-box">
                            <?php foreach ($orders_details as $key => $od) { ?>
                                <div class="detail-order">
                                    <div class="inf-prd">
                                        <div>
                                            <img src="../<?= $od["image"] ?>" alt="">
                                        </div>
                                        <div class="inf-text">
                                            <div class="prd-name"><?= $od["product_name"] ?></div>
                                            <div class="galary"><span>Size: <?= $od["size"] ?>cm</span> <span>Flavor: <?= $od["flavor"] ?></span></div>
                                            <div>x<?= $od["quantity"] ?></div>
                                        </div>
                                    </div>
                                    <div class="prd-price">
                                        <?php if ($od["sale_product"] != 0) { ?>
                                            <span class="price-del"><?php echo $od["total_money"] ?> vnđ</span>
                                            <span class="price-hight-light"><?php echo $od["sale_product"] ?> vnđ</span>
                                        <?php } else { ?>
                                            <span class="price-hight-light"><?php echo displayPrice($od["price"]) ?> vnđ</span>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="status-cal">
                                <div class="status-ord">
                                    <span class="<?= $o["status"] ?>"><?= $o["status"] ?></span>
                                </div>
                                <div class="cal-total">
                                    <?php if ($o["coupon_sale"] != 0) { ?>
                                        <span>Total Pay:
                                        </span><span class="price-del"><?php echo displayPrice($o["total_pay"]) ?> vnđ</span>
                                        <span class="price-total-pay"><?php echo displayPrice($o["total_pay"] - $o["coupon_sale"]) ?> vnđ</span>
                                    <?php } else { ?>
                                        <span class="price-total-pay"><?php echo displayPrice($o["total_pay"]) ?> vnđ</span>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
            <?php }
                }
            } else {
                noOrderYet();
            } ?>
        </div>

        <div class="content" data-content="pending">
            <?php if (checkStatus("pending") != null) {
                foreach ($orders as $key => $o) {
                    if ($o["status"] == "pending") {
            ?>
                        <div class="item-product-box">
                            <?php foreach ($orders_details as $key => $od) { ?>
                                <div class="detail-order">
                                    <div class="inf-prd">
                                        <div>
                                            <img src="../<?= $od["image"] ?>" alt="">
                                        </div>
                                        <div class="inf-text">
                                            <div class="prd-name"><?= $od["product_name"] ?></div>
                                            <div class="galary"><span>Size: <?= $od["size"] ?>cm</span> <span>Flavor: <?= $od["flavor"] ?></span></div>
                                            <div>x<?= $od["quantity"] ?></div>
                                        </div>
                                    </div>
                                    <div class="prd-price">
                                        <?php if ($od["sale_product"] != 0) { ?>
                                            <span class="price-del"><?php echo $od["total_money"] ?> vnđ</span>
                                            <span class="price-hight-light"><?php echo $od["sale_product"] ?> vnđ</span>
                                        <?php } else { ?>
                                            <span class="price-hight-light"><?php echo displayPrice($od["price"]) ?> vnđ</span>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="status-cal">
                                <div class="status-ord">
                                    <span class="<?= $o["status"] ?>"><?= $o["status"] ?></span>
                                </div>
                                <div class="cal-total">
                                    
                                </div>
                            </div>
                        </div>
            <?php }
                }
            } else {
                noOrderYet();
            } ?>
        </div>
        
        <div class="content" data-content="completed">
        <?php if (checkStatus("completed") != null) {
                foreach ($orders as $key => $o) {
                    if ($o["status"] == "completed") {
            ?>
                        <div class="item-product-box">
                            <?php foreach ($orders_details as $key => $od) { ?>
                                <div class="detail-order">
                                    <div class="inf-prd">
                                        <div>
                                            <img src="../<?= $od["image"] ?>" alt="">
                                        </div>
                                        <div class="inf-text">
                                            <div class="prd-name"><?= $od["product_name"] ?></div>
                                            <div class="galary"><span>Size: <?= $od["size"] ?>cm</span> <span>Flavor: <?= $od["flavor"] ?></span></div>
                                            <div>x<?= $od["quantity"] ?></div>
                                        </div>
                                    </div>
                                    <div class="prd-price">
                                        <?php if ($od["sale_product"] != 0) { ?>
                                            <span class="price-del"><?php echo $od["total_money"] ?> vnđ</span>
                                            <span class="price-hight-light"><?php echo $od["sale_product"] ?> vnđ</span>
                                        <?php } else { ?>
                                            <span class="price-hight-light"><?php echo displayPrice($od["price"]) ?> vnđ</span>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="status-cal">
                                <div class="status-ord">
                                    <span class="<?= $o["status"] ?>"><?= $o["status"] ?></span>
                                </div>
                                <div class="cal-total">
                                    <?php if ($o["coupon_sale"] != 0) { ?>
                                        <span>Total Pay:
                                        </span><span class="price-del"><?php echo displayPrice($o["total_pay"]) ?> vnđ</span>
                                        <span class="price-total-pay"><?php echo displayPrice($o["total_pay"] - $o["coupon_sale"]) ?> vnđ</span>
                                    <?php } else { ?>
                                        <span class="price-total-pay"><?php echo displayPrice($o["total_pay"]) ?> vnđ</span>
                                    <?php } ?>
                                    <button class="btn btn-warning return-btn" data-order-id="<?= $o["order_id"] ?>">Return</button>
                                </div>
                            </div>
                        </div>
            <?php }
                }
            } else {
                noOrderYet();
            } ?>
        </div>
        <div class="content" data-content="cancelled">
        <?php if (checkStatus("cancelled") != null) {
                foreach ($orders as $key => $o) {
                    if ($o["status"] == "cancelled") {
            ?>
                        <div class="item-product-box">
                            <?php foreach ($orders_details as $key => $od) { ?>
                                <div class="detail-order">
                                    <div class="inf-prd">
                                        <div>
                                            <img src="../<?= $od["image"] ?>" alt="">
                                        </div>
                                        <div class="inf-text">
                                            <div class="prd-name"><?= $od["product_name"] ?></div>
                                            <div class="galary"><span>Size: <?= $od["size"] ?>cm</span> <span>Flavor: <?= $od["flavor"] ?></span></div>
                                            <div>x<?= $od["quantity"] ?></div>
                                        </div>
                                    </div>
                                    <div class="prd-price">
                                        <?php if ($od["sale_product"] != 0) { ?>
                                            <span class="price-del">item price: <?php echo displayPrice($od["price"]) ?> vnđ</span>
                                            <span class="price-hight-light"><?php echo calculateOldPrice($od["price"], $od["sale_product"]) ?> vnđ</span>
                                        <?php } else { ?>
                                            <span class="price-hight-light"><?php echo displayPrice($od["price"]) ?> vnđ</span>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="status-cal">
                                <div class="status-ord">
                                    <span class="<?= $o["status"] ?>"><?= $o["status"] ?></span>
                                </div>
                                <div class="cal-total">
                                   
                                </div>
                            </div>
                        </div>
            <?php }
                }
            } else {
                noOrderYet();
            } ?>
        </div>
        <div class="content" data-content="return">
        <?php if (checkStatus("return") != null) {
                foreach ($orders as $key => $o) {
                    if ($o["status"] == "return") {
            ?>
                        <div class="item-product-box">
                            <?php foreach ($orders_details as $key => $od) { ?>
                                <div class="detail-order">
                                    <div class="inf-prd">
                                        <div>
                                            <img src="../<?= $od["image"] ?>" alt="">
                                        </div>
                                        <div class="inf-text">
                                            <div class="prd-name"><?= $od["product_name"] ?></div>
                                            <div class="galary"><span>Size: <?= $od["size"] ?>cm</span> <span>Flavor: <?= $od["flavor"] ?></span></div>
                                            <div>x<?= $od["quantity"] ?></div>
                                        </div>
                                    </div>
                                    <div class="prd-price">
                                        <?php if ($od["sale_product"] != 0) { ?>
                                            <span class="price-del">item price: <?php echo displayPrice($od["price"]) ?> vnđ</span>
                                            <span class="price-hight-light"><?php echo calculateOldPrice($od["price"], $od["sale_product"]) ?> vnđ</span>
                                        <?php } else { ?>
                                            <span class="price-hight-light"><?php echo displayPrice($od["price"]) ?> vnđ</span>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="status-cal">
                                <div class="status-ord">
                                    <span class="<?= $o["status"] ?>"><?= $o["status"] ?></span>
                                </div>
                                <div class="cal-total">
                                   
                                </div>
                            </div>
                        </div>
            <?php }
                }
            } else {
                noOrderYet();
            } ?>
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
            var order_id = $(this).data("order-id");
            
            // Prompt the user for the cancellation reason using SweetAlert
            Swal.fire({
                title: 'Cancel Order',
                input: 'text',
                inputLabel: 'Reason for cancellation',
                inputPlaceholder: 'Enter reason...',
                showCancelButton: true,
                confirmButtonText: 'Cancel Order',
                cancelButtonText: 'Close',
                showLoaderOnConfirm: true,
                preConfirm: (reason) => {
                    // Send an AJAX request to update the order status to "cancelled" with the reason
                    return $.ajax({
                        url: "handles_page/update_order_status.php",
                        type: "POST",
                        data: { order_id: order_id, new_status: "cancelled", reason: reason },
                        error: function () {
                            // Handle error
                            Swal.showValidationMessage('Failed to cancel the order.');
                        }
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Order Cancelled',
                        text: result.value, // Display the response from the server
                        timer: 2000, // Automatically close after 2 seconds
                        showConfirmButton: false
                    });
                }
            });
        });
        $(".return-btn").click(function () {
    var order_id = $(this).data("order-id");
    // alert(order_id);
    
    // Create a file input element
    const fileInput = document.createElement('input');
    fileInput.type = 'file';
    fileInput.accept = 'image/*';
    
    // Prompt the user for the return reason and image using SweetAlert
    Swal.fire({
        title: 'Return Order',
        html: `
            <div>
                <label for="return-reason">Reason for return:</label>
                <textarea id="return-reason" placeholder="Enter reason..." class="swal2-input" style="height: 100px;"></textarea>
            </div>
            <div>
                <label for="return-image">Upload an image of the issue:</label>
                <input id="return-image" type="file" accept="image/*" class="swal2-file">
            </div>
        `,
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: 'Return Order',
        cancelButtonText: 'Close',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            const reason = document.getElementById('return-reason').value;
            const imageFile = document.getElementById('return-image').files[0];
            
            // Prepare form data
            const formData = new FormData();
            formData.append('order_id', order_id);
            formData.append('new_status', 'return');
            formData.append('reason', reason);
            formData.append('image', imageFile);
            
            // Send an AJAX request to update the order status to "return" with the reason and image
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
            Swal.fire({
                icon: 'success',
                title: 'Order return',
                text: result.message, // Display the response from the server
                timer: 2000, // Automatically close after 2 seconds
                showConfirmButton: false
            });
        }
    });
});

    });


</script>