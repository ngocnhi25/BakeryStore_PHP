<?php
require_once('../connect/connectDB.php');
require_once('../handles_page/handle_calculate.php');

$countCustomer = executeSingleResult("SELECT count(*) as customer FROM tb_user where role = 1");
$countEmp = executeSingleResult("SELECT count(*) as emp FROM tb_user where role = 2");
$countOwner = executeSingleResult("SELECT count(*) as owner FROM tb_user where role = 3");
$countProduct = executeSingleResult("SELECT COUNT(*) as total_product, 
                                        SUM(CASE WHEN deleted = 0 AND qty_warehouse > 0 THEN 1 ELSE 0 END) as product_currently,
                                        SUM(CASE WHEN deleted = 1 or qty_warehouse <= 0 THEN 1 ELSE 0 END) as product_suspend
                                        FROM tb_products");
$countFlavor = executeSingleResult("SELECT COUNT(*) as total_flavor, 
                                        SUM(CASE WHEN deleted_flavor = 0 AND qti_flavor > 0 THEN 1 ELSE 0 END) as flavor_currently,
                                        SUM(CASE WHEN deleted_flavor = 1 or qti_flavor <= 0 THEN 1 ELSE 0 END) as flavor_suspend
                                        FROM tb_flavor");
$countSize = executeSingleResult("SELECT COUNT(*) as total_size, 
                                        SUM(CASE WHEN deleted_size = 0 AND 	qti_boxes_size > 0 THEN 1 ELSE 0 END) as size_currently,
                                        SUM(CASE WHEN deleted_size = 1 or 	qti_boxes_size <= 0 THEN 1 ELSE 0 END) as size_suspend
                                        FROM tb_size");
$countVoucher = executeSingleResult("SELECT COUNT(*) as total_coupon, 
                                        SUM(CASE WHEN CURDATE() BETWEEN start_date AND end_date and qti_coupon > 0 THEN 1 ELSE 0 END) as coupon_currently,
                                        SUM(CASE WHEN CURDATE() < start_date and CURDATE() > end_date or qti_coupon <= 0 THEN 1 ELSE 0 END) as coupon_Cease
                                        FROM tb_coupon");
$countSale = executeSingleResult("SELECT COUNT(*) as total_sale, 
                                        SUM(CASE WHEN CURDATE() BETWEEN start_date AND end_date THEN 1 ELSE 0 END) as sale_currently,
                                        SUM(CASE WHEN CURDATE() < start_date and CURDATE() > end_date THEN 1 ELSE 0 END) as sale_Cease
                                        FROM tb_sale");
$countAds = executeSingleResult("SELECT COUNT(*) as total_ads, 
                                        SUM(CASE WHEN CURDATE() BETWEEN start_date AND end_date THEN 1 ELSE 0 END) as ads_currently,
                                        SUM(CASE WHEN CURDATE() < start_date and CURDATE() > end_date THEN 1 ELSE 0 END) as ads_Cease
                                        FROM tb_ads");
$countCate = executeSingleResult("SELECT count(*) as cate FROM tb_category");
$fourEmperorsBuy = executeResult("SELECT *, SUM(od.total_money) as total FROM tb_user u 
                                INNER JOIN tb_order o ON u.user_id = o.user_id
                                INNER JOIN tb_order_detail od ON o.order_id = od.order_id
                                where o.status = 'completed' GROUP BY u.user_id ORDER BY total DESC limit 4");
$historyOperationStore = executeResult("SELECT * FROM tb_shop_history sh
                                        INNER JOIN tb_user u ON sh.user_id = u.user_id
                                        where (role = 2 or role = 3) 
                                        ORDER BY sh.shop_history_id DESC limit 10");
$recentOrder = executeResult("SELECT o.order_id, u.username, p.product_name, o.order_date, o.status, SUM(od.total_money) as total 
                                FROM tb_order o
                                INNER JOIN tb_user u ON o.user_id = u.user_id
                                INNER JOIN tb_order_detail od ON o.order_id = od.order_id
                                LEFT JOIN tb_products p ON od.product_id = p.product_id
                                GROUP BY o.user_id 
                                ORDER BY o.order_id DESC limit 10");

?>

<head>
    
</head>
<div style="width: 100%;">
    <div class="dashboad-box">
        <div class="box-left">
            <div class="name-page-db">
                <h1>Dashboad</h1>
            </div>
            <div class="statistical-db">
                <div class="item-statistical">
                    <div class="middle">
                        <h1><?= $countCustomer["customer"] ?></h1>
                        <span class="material-symbols-sharp customer">person</span>
                    </div>
                    <h3>Customers</h3>
                </div>
                <div class="item-statistical">
                    <div class="middle">
                        <h1><?= $countEmp["emp"] ?></h1>
                        <span class="material-symbols-sharp employee">person_apron</span>
                    </div>
                    <h3>Employees</h3>
                </div>
                <div class="item-statistical">
                    <div class="middle">
                        <h1><?= $countProduct["total_product"] ?></h1>
                        <span class="material-symbols-sharp product">store</span>
                    </div>
                    <h3>Product</h3>
                </div>
                <div class="item-statistical">
                    <div class="middle">
                        <h1><?= $countCate["cate"] ?></h1>
                        <span class="material-symbols-sharp cate">list_alt</span>
                    </div>
                    <h3>Category</h3>
                </div>
            </div>
            <div class="chart">
                <div></div>
                <div class="chart-month-year">
                    <div class="revenue-box">
                        <canvas class="month-chart" id="month-chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-right">
            <div class="recent-updates">
                <h2>Potential Customers</h2>
                <div class="top-best-order">
                    <?php foreach ($fourEmperorsBuy as $f) { ?>
                        <div class="profile-dasboad">
                            <div class="profile-photo">
                                <img src="../../public/images/icon/badge.png" alt="admin 1">
                                <div class="ratings-top-num">1</div>
                            </div>
                            <div class="account-top-order">
                                <p><b><?= $f["username"] ?></b></p>
                                <small class="text-muted">Total amount ordered: <span class="total-order-price"><?= displayPrice($f["total"]) ?> vnđ</span></small>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="recent-updates history">
                <h2>History of store operations</h2>
                <div class="history-shop-dashboad">
                    <?php foreach ($historyOperationStore as $h) { ?>
                        <div class="profile-dasboad">
                            <div class="account-top-order">
                                <p>
                                    <b><?= $h["username"] ?></b>
                                    <small class="text-muted"><?= $h["action"] ?></small>
                                </p>
                                <div class="time-history-dashboad">
                                    <span class="material-symbols-sharp">history</span>
                                    <small class="date-ago"><?= formatElapsedTime($h["action_time"]) ?></small>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="show-all-history-box">
                    <button class="show-all-history">Show all</button>
                </div>
            </div>
        </div>
    </div>
    <div class="dashboad-box">
        <div class="gallery-left">
            <div class="top-gallery-left">
                <p>Event statistics</p>
                <div class="cal-gallery">
                    <table class="table-dashboad">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Total</th>
                                <th>Currently active</th>
                                <th>Cease activity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-left">Voucher</td>
                                <td><?= $countVoucher["total_coupon"] ?></td>
                                <td><?= $countVoucher["coupon_currently"] ?></td>
                                <td><?= $countVoucher["coupon_Cease"] ?></td>
                            </tr>
                            <tr>
                                <td class="text-left">Sale product</td>
                                <td><?= $countSale["total_sale"] ?></td>
                                <td><?= $countSale["sale_currently"] ?></td>
                                <td><?= $countSale["sale_Cease"] ?></td>
                            </tr>
                            <tr>
                                <td class="text-left">Advertisement</td>
                                <td><?= $countAds["total_ads"] ?></td>
                                <td><?= $countAds["ads_currently"] ?></td>
                                <td><?= $countAds["ads_Cease"] ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="bottom-gallery-left">
                <div class="cal-gallery">
                    <table class="table-dashboad">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Total</th>
                                <th>Currently active</th>
                                <th>Suspend operations</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-left">Products</td>
                                <td><?= $countProduct["total_product"] ?></td>
                                <td><?= $countProduct["product_currently"] ?></td>
                                <td><?= $countProduct["product_suspend"] ?></td>
                            </tr>
                            <tr>
                                <td class="text-left">Flavors</td>
                                <td><?= $countFlavor["total_flavor"] ?></td>
                                <td><?= $countFlavor["flavor_currently"] ?></td>
                                <td><?= $countFlavor["flavor_suspend"] ?></td>
                            </tr>
                            <tr>
                                <td class="text-left">Sizes</td>
                                <td><?= $countSize["total_size"] ?></td>
                                <td><?= $countSize["size_currently"] ?></td>
                                <td><?= $countSize["size_suspend"] ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="order-list-box">
            <p>Recent order</p>
            <div class="order-list">
                <table class="table-dashboad">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>User</th>
                            <th>Product name</th>
                            <th>Total money</th>
                            <th>Order date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recentOrder as $ro) { ?>
                            <tr>
                                <td>#<?= $ro["order_id"] ?></td>
                                <td class="text-left"><?= $ro["username"] ?></td>
                                <td class="text-left"><?= $ro["product_name"] ?></td>
                                <td><?= displayPrice($ro["total"]) ?>vnd</td>
                                <td><?= $ro["order_date"] ?></td>
                                <td><?= $ro["status"] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="../../public/backend/js/revenues.js"></script>