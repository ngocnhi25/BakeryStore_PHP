<?php
require_once("connect/connectDB.php");
?>

<head>
    <style>
        .my-account {
            width: 100%;
            background-color: #dedede2e;
            padding: 20px 0px 50px;
        }

        .my-account .my-account-box {
            width: 80%;
            margin: auto;
            display: flex;
            align-items: stretch;
        }

        .my-account .my-account-box .sidebar-user {
            flex: 0 0 190px;
            font-size: 14px;
        }

        .my-account .my-account-box .sidebar-user .name-user {
            width: 100%;
            height: 5rem;
            display: flex;
            padding: 15px 0;
            align-items: center;
        }

        .my-account .sidebar-user .name-user img {
            width: 3.025rem;
            height: 3.025rem;
            vertical-align: middle;
            border-radius: 50%;
        }

        .my-account .my-account-box .sidebar-user .name-user span {
            width: 100%;
            height: 3.025rem;
            padding: 0px 0px 0px 15px;

        }

        .my-account .my-account-box .sidebar-user .sidebar {
            width: 100%;
            height: auto;
            position: relative;
        }

        .my-account .my-account-box .sidebar-user .sidebar .nav-item {
            width: 100%;
            height: 40px;
            margin-bottom: 10px;
        }

        .my-account .my-account-box .sidebar-user .sidebar .nav-item .nav-link {
            width: 100%;
            height: 100%;
            display: flex;
            gap: 0.7rem;
        }

        .my-account .my-account-box .sidebar-user .sidebar .nav-item:hover .nav-link p,
        .my-account .my-account-box .sidebar-user .sidebar .nav-item.active .nav-link p {
            color: red;
        }

        .my-account .my-account-box .action-page-box {
            flex: 1;
            padding-left: 30px;
        }

        .my-account .my-account-box .action-page-box .action-page {
            width: 100%;
            height: 100%;
            display: block;
            background-color: #fff;
            padding: 0 1.875rem 0.625rem;
            border-radius: 5px;
        }
    </style>
</head>

<?php include("layout/header.php"); ?>
<section class="my-account">
    <div class="my-account-box">
        <div class="sidebar-user">
            <div class="name-user">
                <img src="../public/images/admin1.jpg" alt="">
                <span>fsgsdgfgdfkkfgdfgdfd</span>
            </div>
            <hr>
            <div class="sidebar">
                <ul>
                    <li class="nav-item">
                        <a href="my_action_user/my_account.php" class="nav-link">
                            <span class="material-symbols-sharp">person</span>
                            <p>My Account</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="my_action_user/purchase_order.php" class="nav-link">
                            <span class="material-symbols-sharp">shopping_bag</span>
                            <p>Purchase Order</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="my_action_user/warehouse_voucher.php" class="nav-link">
                            <span class="material-symbols-sharp">barcode_scanner</span>
                            <p>Warehouse Voucher</p>
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                        <div class="sub-btn nav-link">
                            <div class="title">
                                <span class="material-symbols-sharp">notifications</span>
                                <p>Notification</p>
                            </div>
                            <span class="material-symbols-sharp more">expand_more</span>
                            <span class="mater  ial-symbols-sharp less">expand_less</span>
                        </div>
                        <ul class="sub-menu">
                            <li class="menu-item">
                                <a href="./logIn.php">
                                    <p>dsfsdfs</p>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="./dashboad.html">
                                    <p>detail</p>
                                </a>
                            </li>
                        </ul>
                    </li> -->
                </ul>
            </div>
        </div>
        <div class="action-page-box" id="action-page-user">

        </div>
    </div>
</section>

<?php include("layout/footer.php"); ?>