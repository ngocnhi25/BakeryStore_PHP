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
                                        ORDER BY sh.shop_history_id DESC limit 6");
$recentOrder = executeResult("SELECT o.order_id, u.username, p.product_name, o.order_date, o.status, SUM(od.total_money) as total 
                                FROM tb_order o
                                INNER JOIN tb_user u ON o.user_id = u.user_id
                                INNER JOIN tb_order_detail od ON o.order_id = od.order_id
                                LEFT JOIN tb_products p ON od.product_id = p.product_id
                                GROUP BY o.user_id 
                                ORDER BY o.order_id DESC limit 10");

?>

<head>
    <style>
        .name-page-db {
            left: 20px;
            top: 20px;
        }

        .dashboad-box {
            display: flex;
            position: relative;
            gap: 0.5rem;
        }

        .dashboad-box .box-left {
            width: 70%;
        }

        .dashboad-box .box-left .statistical-db {
            width: 100%;
            display: flex;
            gap: 1rem;
        }

        .dashboad-box .box-left .statistical-db .item-statistical {
            width: 180px;
            height: 100px;
            border-radius: 5px;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 1rem var(--color-light);
            transition: all 300ms ease
        }

        .dashboad-box .box-left .statistical-db .item-statistical:hover {
            box-shadow: none;
        }

        .dashboad-box .box-left .statistical-db .item-statistical .middle {
            display: flex;
            gap: 1rem;
            align-items: center;
            justify-content: space-between;
        }

        .dashboad-box .box-left .statistical-db .item-statistical .middle span {
            width: 38px;
            height: 38px;
            font-size: 38px;
        }

        .dashboad-box .customer {
            color: blue;
        }

        .dashboad-box .employee {
            color: orange;
        }

        .dashboad-box .product {
            color: #2ed5d8;
        }

        .dashboad-box .cate {
            color: #9b00ff;
        }

        .dashboad-box .box-left .statistical-db h3 {
            font-size: 13px;
            color: #8a8989;
        }

        .dashboad-box .box-right {
            width: 30%;
        }

        .dashboad-box .gallery-left {
            width: 40%;
        }

        .dashboad-box .gallery-left p {
            font-size: 16px;
            font-weight: 600;
            color: #363949;
        }

        .dashboad-box .gallery-left .bottom-gallery-left {
            margin-top: 20px;
        }

        .dashboad-box .gallery-left,
        .dashboad-box .order-list-box {
            border-radius: 10px;
            box-shadow: 0 0 1rem var(--color-light);
            padding: 10px;
            background-color: #fff;
        }
        .dashboad-box .order-list-box {
            height: 450px;
            overflow: auto;
        }
        .dashboad-box .order-list-box::-webkit-scrollbar {
            width: 6px;
        }

        .dashboad-box .order-list-box::-webkit-scrollbar-thumb {
            background-color: #999;
            border-radius: 5px;
        }

        .dashboad-box .order-list-box::-webkit-scrollbar-thumb:hover {
            background-color: #555;
        }

        .dashboad-box .order-list-box::-webkit-scrollbar-track {
            background-color: #eee;
        }

        .dashboad-box .gallery-left .cal-gallery,
        .dashboad-box .order-list-box .order-list {
            margin-top: 1rem;
            width: 100%;
            border-radius: 0.6rem;
            overflow: auto;
        }

        .dashboad-box td.text-left,
        .dashboad-box .gallery-left td.text-left {
            text-align: left;
        }

        .dashboad-box .order-list-box {
            width: 60%;
        }

        .dashboad-box .order-list-box p {
            font-size: 16px;
            font-weight: 600;
            color: #363949;
        }

        .table-dashboad thead th {
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

        .table-dashboad thead th:last-child {
            border: none;
        }

        .table-dashboad thead th:first-child,
        .table-dashboad tbody td:first-child {
            text-align: center;
            width: 3.7rem;
        }

        .table-dashboad tbody tr:nth-child(even) {
            background-color: #0000000b;
        }

        .table-dashboad tbody tr:hover {
            background-color: #d7f4f7e3 !important;
        }

        .table-dashboad td {
            border-collapse: collapse;
            padding: 0.6rem;
            text-align: center;
            color: #717171;
        }

        .chart {
            width: 100%;
            position: relative;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            margin-top: 20px;
        }

        .chart .chart-month-year {
            display: flex;
            position: relative;
            width: 100%;
            /* height: 500px; */
            justify-content: space-between;
            background-color: #fff;
            /* gap: 2rem; */
        }

        .chart .chart-month-year .revenue-box {
            display: block;
            width: 100%;
            height: 100%;
        }

        .chart .chart-month-year .month-chart {
            position: relative;
            width: 100%;
            height: 100%;
        }

        .chart .chart-month-year .year-chart {
            position: relative;
            width: 30%;
            height: 300px;
        }

        .box-right .recent-updates {
            margin-bottom: 1rem;
        }

        .box-right .recent-updates h2 {
            margin-bottom: 0.8rem;
        }

        .box-right .recent-updates .top-best-order {
            background: #fff;
            padding: var(--card-padding);
            border-radius: var(--card-border-radius);
            box-shadow: 0 0 1rem var(--color-light);
            transition: all 300ms ease;
        }

        .box-right .recent-updates .top-best-order:hover,
        .box-right .recent-updates .history-shop-dashboad:hover {
            box-shadow: none;
        }

        .box-right .recent-updates .top-best-order .profile-dasboad {
            display: flex;
            gap: 0.5rem;
        }

        .box-right .recent-updates .top-best-order .profile-dasboad,
        .box-right .recent-updates .history-shop-dashboad .profile-dasboad {
            margin-bottom: 1rem;
        }

        .box-right .recent-updates .top-best-order .profile-photo {
            width: 2.8rem;
            height: 2.8rem;
            border-radius: 50%;
            position: relative;
            overflow: hidden;
            background-color: #ffe900;
        }

        .box-right .recent-updates .top-best-order .profile-photo img {
            width: 100%;
            height: 100%;
            vertical-align: middle;
            object-fit: contain;
        }

        .box-right .recent-updates .top-best-order .profile-photo .ratings-top-num {
            position: absolute;
            top: 22%;
            left: 43%;
            font-weight: 600;
        }

        .box-right .recent-updates .top-best-order .total-order-price {
            color: red;
            font-size: 13px;
        }

        small.date-ago {
            color: red;
        }

        .box-right .recent-updates .history-shop-dashboad {
            background: #fff;
            padding: var(--card-padding);
            border-radius: var(--card-border-radius);
            box-shadow: 0 0 1rem var(--color-light);
            transition: all 300ms ease;
            margin-top: 10px;
            width: 100%;
            max-height: 250px;
            overflow-y: auto;
        }

        .box-right .recent-updates .history-shop-dashboad .time-history-dashboad {
            display: flex;
            align-items: center;
            gap: 0.3rem;
            font-size: 12px;
            color: red;
        }

        .box-right .recent-updates .history-shop-dashboad .time-history-dashboad span {
            font-size: 12px;
        }

        .box-right .recent-updates .history-shop-dashboad::-webkit-scrollbar {
            width: 10px;
        }

        .box-right .recent-updates .history-shop-dashboad::-webkit-scrollbar-thumb {
            background-color: #999;
            border-radius: 5px;
        }

        .box-right .recent-updates .history-shop-dashboad::-webkit-scrollbar-thumb:hover {
            background-color: #555;
        }

        .box-right .recent-updates .history-shop-dashboad::-webkit-scrollbar-track {
            background-color: #eee;
        }
    </style>
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
            <div class="recent-updates">
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
                <p>Event statistics</p>
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