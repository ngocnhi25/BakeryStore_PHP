<?php
require_once('../connect/connectDB.php');

$countCustomer = executeSingleResult("SELECT count(*) as customer FROM tb_user where role = 1");
$countEmp = executeSingleResult("SELECT count(*) as emp FROM tb_user where role = 2");
$countOwner = executeSingleResult("SELECT count(*) as owner FROM tb_user where role = 3");

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

        .dashboad-box .box-left .user-db {
            width: 100%;
            display: flex;
            gap: 1rem;
        }

        .dashboad-box .box-left .user-db .user-db-item {
            width: 180px;
            height: 100px;
            border: 1px solid black;
            border-radius: 5px;
            padding: 20px;
            background-color: #fff;
        }

        .dashboad-box .box-left .user-db .user-db-item .middle {
            display: flex;
            gap: 1rem;
            align-items: center;
            justify-content: space-between;
        }

        .dashboad-box .box-left .user-db .user-db-item .middle span {
            width: 38px;
            height: 38px;
            font-size: 38px;
        }

        .customer {
            color: blue;
        }

        .employee {
            color: orange;
        }

        .dashboad-box .box-left .user-db h3 {
            font-size: 13px;
            color: #000;
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
            /* gap: 2rem; */
        }
        .chart .chart-month-year .month-chart {
            position: relative;
            width: 70%;
            height: 500px;
        }
        .chart .chart-month-year .year-chart {
            position: relative;
            width: 30%;
            height: 300px;
        }
    </style>
</head>
<div style="width: 100%;">
    <div class="name-page-db">
        <h1>Dashboad</h1>
    </div>
    <div class="dashboad-box">
        <div class="box-left">
            <div class="user-db">
                <div class="user-db-item">
                    <div class="middle">
                        <h1><?= $countCustomer["customer"] ?></h1>
                        <span class="material-symbols-sharp customer">person</span>
                    </div>
                    <h3>Customers</h3>
                </div>
                <div class="user-db-item">
                    <div class="middle">
                        <h1><?= $countEmp["emp"] ?></h1>
                        <span class="material-symbols-sharp employee">person_apron</span>
                    </div>
                    <h3>Employees</h3>
                </div>
                <div class="user-db-item">
                    <div class="middle">
                        <h1><?= $countOwner["owner"] ?></h1>
                        <span class="material-symbols-sharp owner">manage_accounts</span>
                    </div>
                    <h3>Owner</h3>
                </div>
            </div>
        </div>
        <div class="box-right">
            <div>
                jkhdfkjs
            </div>
        </div>
    </div>
    <div class="chart">
        <div class="chart-month-year">
            <div class="revenue-box">
                <canvas class="month-chart" id="month-chart"></canvas>
            </div>
            <div class="revenue-box">
                <canvas class="year-chart" id="year-chart"></canvas>
            </div>
        </div>
    </div>
</div>
<script src="../../public/backend/js/revenues.js"></script>