<?php
require_once('../connect/connectDB.php');
require_once('../handles_page/handle_calculate.php');

$countCustomer = executeSingleResult("SELECT count(*) as customer FROM tb_user where role = 1");
$countEmp = executeSingleResult("SELECT count(*) as emp FROM tb_user where role = 2");
$countOwner = executeSingleResult("SELECT count(*) as owner FROM tb_user where role = 3");
$countProduct = executeSingleResult("SELECT count(*) as product FROM tb_products");
$countCate = executeSingleResult("SELECT count(*) as cate FROM tb_category");
$fourEmperorsBuy = executeResult("SELECT *, SUM(total_pay) as total FROM tb_user u 
                                INNER JOIN tb_order o ON u.user_id = o.user_id
                                where o.status = 'completed' GROUP BY u.user_id ORDER BY total DESC limit 2");

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
            box-shadow: var(--box-shadow);
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

        .chart {
            width: 100%;
            position: relative;

        }

        .chart .chart-month-year {
            display: flex;
            position: relative;
            width: 100%;
            height: 500px;
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

        /* .box-right .recent-updates {
            margin-top: 1rem;
        } */

        .box-right .recent-updates h2 {
            margin-bottom: 0.8rem;
        }

        .box-right .recent-updates .top-best-order {
            background: #fff;
            padding: var(--card-padding);
            border-radius: var(--card-border-radius);
            box-shadow: var(--box-shadow);
            transition: all 300ms ease;
        }

        .box-right .recent-updates .top-best-order:hover {
            box-shadow: none;
        }

        .box-right .recent-updates .top-best-order .profile-dasboad {
            display: grid;
            grid-template-columns: 2.6rem auto;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .box-right .recent-updates .top-best-order .profile-photo img {
            width: 100%;
            height: 100%;
            vertical-align: middle;
            object-fit: contain;
        }

        .box-right .recent-updates .top-best-order .profile-photo img {
            width: 100%;
            height: 100%;
            vertical-align: middle;
            object-fit: contain;
        }

        .box-right .recent-updates .top-best-order .total-order-price {
            color: red;
            font-size: 13px;
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
                        <h1><?= $countProduct["product"] ?></h1>
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
        </div>
        <div class="box-right">
            <div class="recent-updates">
                <h2>Potential Customers</h2>
                <div class="top-best-order">
                    <?php foreach ($fourEmperorsBuy as $f) { ?>
                        <div class="profile-dasboad">
                            <div class="profile-photo">
                                <img src="../../public/images/icon/user.png" alt="admin 1">
                            </div>
                            <div class="account-top-order">
                                <p><b><?= $f["username"] ?></b></p>
                                <small class="text-muted">Total amount ordered: <span class="total-order-price"><?= displayPrice($f["total"]) ?> vnđ</span></small>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="chart">
        <div class="chart-month-year">
            <div class="revenue-box">
                <canvas class="month-chart" id="month-chart"></canvas>
            </div>
            <!-- <div class="revenue-box">
                <canvas class="year-chart" id="year-chart"></canvas>
            </div> -->
        </div>
    </div>
</div>
<script src="../../public/backend/js/revenues.js"></script>