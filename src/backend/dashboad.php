<?php
require_once('../connect/connectDB.php');

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

        .dashboad-box .box-left .revenue-box {
            display: flex;
        }

        .dashboad-box .box-right {
            width: 30%;
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
                        <h1>1234</h1>
                        <span class="material-symbols-sharp customer">person</span>
                    </div>
                    <h3>Customers</h3>
                    <small>
                </div>
                <div class="user-db-item">
                    <div class="middle">
                        <h1>3</h1>
                        <span class="material-symbols-sharp employee">person_apron</span>
                    </div>
                    <h3>Employees</h3>
                </div>
            </div>
            <div class="revenue-box">
                <canvas id="myChart" width="400" height="200"></canvas>
            </div>
        </div>
        <div class="box-right">
            <div>
                jkhdfkjs
            </div>
        </div>
    </div>
</div>
<script src="../../public/backend/js/revenues.js"></script>