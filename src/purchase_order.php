<?php
require_once("connect/connectDB.php");
session_start();

if (isset($_SESSION["auth_user"])) {
    $user_id = $_SESSION["auth_user"]["user_id"];
}

?>

<div class="purchase-order">
    <div class="po-tab-ui">
        <div class="tabs">
            <div class="tab-item active" data-tab="all">All</div>
            <!-- ... (other tab items) ... -->
        </div>
        <!-- ... (search input) ... -->
    </div>
    <div class="po-content-box">
        <div class="content active" data-content="all">
            <?php
            if (isset($user_id)) {
                // Retrieve and display orders with all statuses for the specific user
                $orders = executeResult("SELECT * FROM tb_order WHERE user_id = $user_id");

                foreach ($orders as $order) {
                    // Display order information based on your layout
                    echo '<div class="order-item">';
                    echo '<p>Order ID: ' . $order['order_id'] . '</p>';
                    echo '<p>Customer Name: ' . $order['name'] . '</p>';
                    echo '<p>Contact Information: Phone: ' . $order['phone'] . ', Address: ' . $order['address'] . '</p>';
                    echo '<p>Order Date: ' . $order['order_date'] . '</p>';
                    echo '<p>Status: ' . $order['status'] . '</p>';
                    echo '</div>';
                }
            } else {
                echo '<p>No user logged in.</p>';
            }
            ?>
        </div>
        <!-- ... (other content sections) ... -->
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(".po-tab-ui .tabs .tab-item").click(function (e) {
        e.preventDefault();
        $(this).siblings().removeClass("active");
        $(this).addClass("active");
        var selectedTab = $(this).data('tab');
        $('.content').removeClass('active');
        $('.content[data-content="' + selectedTab + '"]').addClass('active');
    });
</script>