<?php
require_once("../connect/connectDB.php");
require_once("handle_calculate.php");
session_start();
if (isset($_SESSION["auth_user"])) {
    $user_id = $_SESSION["auth_user"]["user_id"];
}

if (isset($_POST['selectedTab'])) {
    $selectedTab = $_POST['selectedTab'];
    $currentDate = date("Y-m-d");
    $twoDaysLater = date("Y-m-d", strtotime("+2 days"));

    $all = executeResult("SELECT * FROM tb_coupon where CURDATE() BETWEEN start_date AND end_date and qti_coupon > 0");
    $aboutToExprire = executeResult("SELECT * FROM tb_coupon 
                                    WHERE end_date >= '$currentDate' AND end_date <= '$twoDaysLater' and qti_coupon > 0
                                    ORDER BY coupon_id DESC");
    $topUsedCoupon = executeResult("SELECT *, SUM(dc.count_used) as total FROM tb_depot_coupon dc 
                                    INNER JOIN tb_coupon c ON dc.coupon_id = c.coupon_id 
                                    WHERE CURDATE() BETWEEN start_date AND end_date and qti_coupon > 0 
                                    GROUP BY dc.coupon_id 
                                    ORDER BY total DESC");

    $couponUserUsed = executeResult("SELECT * FROM tb_depot_coupon dc INNER JOIN tb_coupon c ON dc.coupon_id = c.coupon_id WHERE user_id = $user_id ORDER BY depot_coupon_id DESC");
    $couponExpired = executeResult("SELECT * FROM tb_coupon WHERE CURDATE() > end_date ORDER BY coupon_id DESC");

    if ($selectedTab == 'all') {
        if ($all != null) {
            foreach ($all as $row) {
                echo "<div class='wh-item'>";
                echo "<div class='wh-left-item'>";
                echo "<div class='wh-code-show'>";
                echo "" . $row["coupon_name"] . "";
                echo "</div>";
                echo "</div>";
                echo "<div class='wh-center-item'>";
                echo "<div class='wh-redution'>Sale " . displayPrice($row["discount_coupon"]) . "đ</div>";
                echo "<div class='wh-condition'>Minimum order <br> " . displayPrice($row["condition_used_coupon"]) . "đ</div>";
                echo "<div class='wh-end-date'>";
                echo "<span class='material-symbols-sharp'>schedule</span>";
                echo "expiration date " . formatDate($row["end_date"]) . "";
                echo "</div>";
                echo "</div>";
                echo "<div class='wh-right-item'>";
                echo "<div class='wh-btn-order'>";
                echo "<button class='wh-btn-buy-now'>Buy now</button>";
                echo "</div>";
                echo "</div>";
                echo "<div class='wh-limited'>limited quantity</div>";
                echo "</div>";
            }
        } else {
            noOrderYet();
        }
    } elseif ($selectedTab == 'about-to-exprire') {
        if ($aboutToExprire != null) {
            foreach ($aboutToExprire as $row) {
                echo "<div class='wh-item'>";
                echo "<div class='wh-left-item'>";
                echo "<div class='wh-code-show'>";
                echo "" . $row["coupon_name"] . "";
                echo "</div>";
                echo "</div>";
                echo "<div class='wh-center-item'>";
                echo "<div class='wh-redution'>Sale " . displayPrice($row["discount_coupon"]) . "đ</div>";
                echo "<div class='wh-condition'>Minimum order <br> " . displayPrice($row["condition_used_coupon"]) . "đ</div>";
                echo "<div class='wh-end-date'>";
                echo "<span class='material-symbols-sharp'>schedule</span>";
                echo "expiration date " . formatDate($row["end_date"]) . "";
                echo "</div>";
                echo "</div>";
                echo "<div class='wh-right-item'>";
                echo "<div class='wh-btn-order'>";
                echo "<button class='wh-btn-buy-now'>Buy now</button>";
                echo "</div>";
                echo "</div>";
                echo "<div class='wh-limited'>limited quantity</div>";
                echo "</div>";
            }
        } else {
            noOrderYet();
        }
    } elseif ($selectedTab == 'popular') {
        if ($topUsedCoupon != null) {
            foreach ($topUsedCoupon as $row) {
                echo "<div class='wh-item'>";
                echo "<div class='wh-left-item'>";
                echo "<div class='wh-code-show'>";
                echo "" . $row["coupon_name"] . "";
                echo "</div>";
                echo "</div>";
                echo "<div class='wh-center-item'>";
                echo "<div class='wh-redution'>Sale " . displayPrice($row["discount_coupon"]) . "đ</div>";
                echo "<div class='wh-condition'>Minimum order <br> " . displayPrice($row["condition_used_coupon"]) . "đ</div>";
                echo "<div class='wh-end-date'>";
                echo "<span class='material-symbols-sharp'>schedule</span>";
                echo "expiration date " . formatDate($row["end_date"]) . "";
                echo "</div>";
                echo "</div>";
                echo "<div class='wh-right-item'>";
                echo "<div class='wh-btn-order'>";
                echo "<button class='wh-btn-buy-now'>Buy now</button>";
                echo "</div>";
                echo "</div>";
                echo "<div class='wh-limited'>Limited quantity</div>";
                echo "</div>";
            }
        } else {
            noOrderYet();
        }
    } elseif ($selectedTab == 'expired') {
        if ($couponExpired != null) {
            foreach ($couponExpired as $row) {
                echo "<div class='wh-item expired'>";
                echo "<div class='wh-left-item wh-blur'>";
                echo "<div class='wh-code-show'>";
                echo "" . $row["coupon_name"] . "";
                echo "</div>";
                echo "</div>";
                echo "<div class='wh-center-item'>";
                echo "<div class='wh-redution'>Sale " . displayPrice($row["discount_coupon"]) . "đ</div>";
                echo "<div class='wh-condition'>Minimum order <br> " . displayPrice($row["condition_used_coupon"]) . "đ</div>";
                echo "<div class='wh-end-date'>";
                echo "<span class='material-symbols-sharp'>schedule</span>";
                echo "expiration date " . formatDate($row["end_date"]) . "";
                echo "</div>";
                echo "</div>";
                echo "<div class='wh-limited wh-no-more'>No more usage left</div>";
                echo "</div>";
            }
        } else {
            noOrderYet();
        }
    } elseif ($selectedTab == 'used') {
        if ($couponUserUsed != null) {
            foreach ($couponUserUsed as $row) {
                echo "<div class='wh-item expired'>";
                echo "<div class='wh-left-item wh-blur'>";
                echo "<div class='wh-code-show'>";
                echo "" . $row["coupon_name"] . "";
                echo "</div>";
                echo "</div>";
                echo "<div class='wh-center-item'>";
                echo "<div class='wh-redution'>Sale " . displayPrice($row["discount_coupon"]) . "đ</div>";
                echo "<div class='wh-condition'>Minimum order <br> " . displayPrice($row["condition_used_coupon"]) . "đ</div>";
                echo "<div class='wh-end-date'>";
                echo "<span class='material-symbols-sharp'>schedule</span>";
                echo "expiration date " . formatDate($row["end_date"]) . "";
                echo "</div>";
                echo "</div>";
                echo "<div class='wh-limited wh-no-more'>Used</div>";
                echo "</div>";
            }
        } else {
            noOrderYet();
        }
    }
}

function noOrderYet()
{
    echo '
    <div class="no-vouchers">
        <div>
            <img src="../public/images/icon/checklist.png" alt="">
            <p class="no-data">There are no vouchers in this page</p>
        </div>
    </div>
    ';
}
