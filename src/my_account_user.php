<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once("connect/connectDB.php");
session_start();
if (isset($_SESSION["auth_user"])) {
    $user_name = $_SESSION["auth_user"]["username"];
    $user_id = $_SESSION["auth_user"]["user_id"];
}

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
            border-bottom: 1px solid #ccc;
        }

        .my-account .my-account-box .sidebar-user .name-user img {
            width: 3.025rem;
            height: 3.025rem;
            vertical-align: middle;
            border-radius: 50%;
        }

        .my-account .my-account-box .sidebar-user .name-user h4 {
            width: 100%;
            height: 3.025rem;
            padding: 0px 0px 0px 15px;

        }

        .my-account .my-account-box .sidebar-user .sidebar {
            width: 100%;
            height: auto;
            position: relative;
            padding-top: 20px;
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
            color: #ff5922;
        }

        .my-account .my-account-box .action-page-box {
            flex: 1;
            padding-left: 30px;
        }

        /* profile */
        .my-profile-page {
            width: 100%;
            height: 100%;
            display: block;
            background-color: #fff;
            padding: 0 1.875rem 0.625rem;
            border-radius: 3px;
        }

        .my-profile-page .profile-title {
            border-bottom: 0.0625rem solid #efefef;
            padding: 1.125rem 0;
        }

        .my-profile-page .profile-title h1 {
            margin: 0;
            font-size: 1.125rem;
            font-weight: 500;
            line-height: 1.5rem;
            text-transform: capitalize;
            color: #333;
        }

        .my-profile-page .profile-title p {
            margin-top: 0.1875rem;
            font-size: .875rem;
            line-height: 1.0625rem;
            color: #555;
        }

        .my-profile-page .update-profile-box {
            padding-top: 1.875rem;
            display: flex;
            align-items: stretch;
            justify-content: space-between;
        }

        .my-profile-page .update-profile-box .profile-form {
            width: 100%;
            padding-right: 3.125rem;
        }

        .my-profile-page .update-profile-box .profile-form table tr td {
            padding-bottom: 30px;
        }

        .my-profile-page .update-profile-box .profile-form table tr td:first-child {
            text-align: right;
            width: 25%;
        }

        .my-profile-page .update-profile-box .profile-form table tr td:last-child {
            box-sizing: border-box;
            padding-left: 20px;
            width: 75%;
        }

        .my-profile-page .update-profile-box .profile-form .css-input input {
            width: 60%;
            padding: 10px;
            border: 1px solid;
            outline: none;
            border-radius: 3px;
            font-size: 16px;
            color: #141212;
            transition: .5s;
        }

        .my-profile-page .update-profile-box .profile-update-image {
            width: 17.8rem;
        }

        .my-profile-page .update-profile-box .profile-update-image .profile-image-box {
            border-left: 0.0625rem solid #efefef;
        }

        .my-profile-page .update-profile-box .profile-update-image .profile-image {
            flex-direction: column;
            width: 10.6931rem;
            margin: 0 auto;
            text-align: center;
        }

        .my-profile-page .update-profile-box .profile-update-image .profile-image .btn-photo input[type="file"] {
            visibility: hidden;
        }

        .my-profile-page .update-profile-box .profile-update-image .profile-image .btn-photo input[type="file"]::before {
            content: 'Choosen a photo';
            display: inline-block;
            border: 1px solid #efefef;
            border-radius: 3px;
            padding: 5px 8px;
            outline: none;
            white-space: nowrap;
            cursor: pointer;
            font-size: 16px;
            visibility: visible;
            margin-left: 20px;
        }

        .my-profile-page .update-profile-box .profile-update-image .profile-image .preview-photo {
            height: 6.25rem;
            width: 6.25rem;
            margin: 1.25rem 0;
            position: relative;
            margin: 10px auto;
            padding: 2px;
        }

        .my-profile-page .update-profile-box .profile-update-image .profile-image img {
            height: 100%;
            width: 100%;
            border-radius: 50%;
            object-fit: contain;
            vertical-align: middle;
        }

        .my-profile-page .update-profile-box .profile-update-image .profile-image .text {
            text-align: left;
            display: flex;
            flex-direction: column;
            padding-top: 10px;
        }

        .submit {
            background-color: red;
            padding: 0.4rem 0.9rem 0.4rem 0.9rem;
            font-weight: 500;
            font-size: 1rem;
            border-radius: 5px;
            border: none;
            transition: box-shadow 0.3s ease;
            box-shadow: 1px 1px 3px black;
        }

        .submit:hover {
            box-shadow: none;
        }

        /* purchase order */
        .purchase-order {
            width: 100%;
            height: 100%;
            display: block;
        }

        .po-tab-ui,
        .wh-tab-ui {
            width: 100%;
            display: block;
        }

        .po-tab-ui .tabs,
        .wh-tab-ui .wh-tabs,
        .wh-history-tab-ui .wh-history-tabs {
            display: flex;
            position: relative;
            justify-content: space-between;
            border-bottom: 2px solid #efefef;
        }

        .po-tab-ui .tabs .tab-item,
        .wh-tab-ui .wh-tabs .wh-tab-item,
        .wh-history-tab-ui .wh-history-tabs .wh-history-tab-item {
            flex: 1;
            padding: 16px 0;
            font-size: 16px;
            text-align: center;
            color: #000000cc;
            background-color: #fff;
            border-bottom: 5px solid transparent;
            cursor: pointer;
            transition: all 0.5s ease;
        }

        .po-tab-ui .tab-item:hover,
        .wh-tab-ui .wh-tab-item:hover,
        .wh-history-tab-ui .wh-history-tab-item:hover {
            color: #ee4d2d;
            background-color: rgba(194, 53, 100, 0.05);
        }

        .po-tab-ui .tabs .tab-item.active,
        .wh-tab-ui .wh-tabs .wh-tab-item.active,
        .wh-history-tab-ui .wh-history-tabs .wh-history-tab-item.active {
            border-bottom: 2px solid #ee4d2d;
            color: #ee4d2d;
        }

        .purchase-order .po-search {
            width: 100%;
            position: relative;
            padding: 12px 0;
            margin: 12px 0;
            display: flex;
            align-items: center;
            box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .05);
            color: #212121;
            background: #eaeaea;
            border-radius: 2px;
        }

        .purchase-order .po-search>input {
            width: 100%;
            flex: 1;
            font-size: 14px;
            line-height: 16px;
            border: 0;
            outline: none;
            background-color: inherit;
        }

        .purchase-order .po-search>span {
            width: 19px;
            height: 19px;
            margin: 0 15px;
            color: #555;
        }

        .po-content-box,
        .wh-content-box,
        .wh-history-content-box {
            position: relative;
            width: 100%;
        }

        .po-content-box .content,
        .wh-content-box .wh-content,
        .wh-history-content-box .wh-history-content {
            display: none;
            position: relative;
        }

        .po-content-box .content.active,
        .wh-content-box .wh-content.active,
        .wh-history-content-box .wh-history-content.active {
            display: block;
        }

        .purchase-order .po-content-box .content .item-product-box {
            background-color: #fff;
            padding: 24px;
            margin-bottom: 12px;
        }

        .purchase-order .po-content-box .content .item-product-box .detail-order {
            width: 100%;
            display: flex;
            padding: 12px;
            border-bottom: 1px solid #ccc;
        }

        .purchase-order .po-content-box .content .item-product-box .inf-prd {
            width: 75%;
            display: flex;
            gap: 1rem;
        }

        .purchase-order .po-content-box .content .item-product-box .inf-prd img {
            width: 100px;
            object-fit: contain;
            vertical-align: middle;
            border-radius: 4px;
        }

        .purchase-order .po-content-box .content .item-product-box .prd-name {
            font-size: 18px;
            color: #000;
        }

        .purchase-order .po-content-box .content .item-product-box .galary {
            display: flex;
            font-size: 15px;
            color: #0000008a;
            gap: 2rem;
        }

        .purchase-order .po-content-box .content .item-product-box .prd-price {
            width: 25%;
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .purchase-order .po-content-box .content .item-product-box .price-hight-light {
            color: #ff3f0b;
            font-size: 16px;
        }

        .purchase-order .po-content-box .content .item-product-box .price-del {
            color: #939393;
            text-decoration: line-through;
            font-size: 13px;
            margin-left: 5px;
        }

        .purchase-order .po-content-box .content .item-product-box .status-cal {
            display: flex;
            justify-content: space-between;
            padding: 25px 25px 10px 25px;
        }

        .purchase-order .po-content-box .content .item-product-box .status-ord {
            color: #ff3f0b;
            font-size: 16px;
            text-transform: capitalize;
        }

        .purchase-order .po-content-box .content .item-product-box .price-total-pay {
            color: #ff3f0b;
            font-size: 20px;
        }

        .purchase-order .po-content-box .content .item-product-box .cal-total {
            display: flex;
            gap: 1rem;
            font-size: 18px;
        }

        .no-order-yet {
            box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .05);
            border-radius: 0.125rem;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 600px;
            background: #fff;
        }
        .no-vouchers {
            grid-template-columns: none;
            box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .05);
            border-radius: 0.125rem;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 600px;
            background: #fff;
        }

        .no-vouchers .no-data {
            margin: 20px 0 0;
            font-size: 20px;
            line-height: 1.4;
            color: #000c;
        }

        /* warehouse voucher */
        .wh-voucher {
            box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .05);
            border-radius: 0.125rem;
            overflow: hidden;
            flex-grow: 1;
            padding: 1.5625rem 2rem;
            background: #fff;
        }

        .wh-voucher .wh-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .wh-voucher .wh-top .wh-title {
            font-size: 1.25rem;
            font-weight: 500;
            text-transform: capitalize;
            color: rgba(0, 0, 0, .8);
        }

        .wh-voucher .wh-history-used {
            color: #ee4d2d;
            text-decoration: none;
            font-size: 0.875rem;
            line-height: 1rem;
            cursor: pointer;
        }

        .wh-voucher .wh-user-add-vch {
            background: rgba(0, 0, 0, .03);
            padding: 1.75rem 2.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 1.25rem;
            gap: 1rem;
        }

        .wh-voucher .wh-user-add-vch .wh-vch-code {
            color: rgba(0, 0, 0, .87);
            font-size: 1rem;
            text-transform: capitalize;
            font-weight: 500;
        }

        .wh-voucher .text-code-vch {
            position: relative;
            width: 25.875rem;
            height: 2.75rem;
            padding: 0.8125rem;
            border: 1px solid rgba(0, 0, 0, .14);
            box-shadow: inset 0 2px 0 0 rgba(0, 0, 0, .02);
        }

        .wh-voucher .save-vch {
            width: 6.25rem;
            height: 2.75rem;
            text-align: center;
            border-radius: 0.125rem;
            outline: none;
            border: 0;
            box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .09);
            background: #ef6145;
            justify-content: center;
            align-items: center;
            display: flex;
        }

        .wh-voucher .save-vch .save-vch-btn {
            background-color: transparent;
            color: #efefef;
            width: 100%;
            height: 100%;
        }

        .wh-voucher .wh-content {
            margin-top: 20px;
        }

        .wh-voucher .wh-item-box {
            position: relative;
            margin-top: 20px;
            width: 100%;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .wh-voucher .wh-limited {
            position: absolute;
            display: flex;
            left: -0.25rem;
            top: 0.3125rem;
            color: #fff;
            text-align: center;
            background-color: #eda500;
            border-radius: 0.125rem 0.125rem 0.125rem 0;
            font-size: .625rem;
            line-height: .75rem;
            padding: .125rem .25rem;
        }

        .wh-voucher .wh-item {
            position: relative;
            width: 100%;
            height: 118px;
            box-sizing: border-box;
            border-radius: 3px;
            display: flex;
            gap: 10px;
            box-shadow: 0.125rem 0.125rem 0.3125rem rgba(0, 0, 0, .07);
            border-left: none;
            border: 0.0625rem solid #ccc;
        }

        .wh-voucher .wh-left-item {
            height: 100%;
            width: 30%;
            background-color: #E487AF;
            word-wrap: break-word;
            padding: 10px;
            text-align: center;
            align-items: center;
            position: relative;
            display: flex;
        }

        .wh-voucher .wh-left-item .wh-code-show {
            width: 100%;
            font-size: 18px;
            word-wrap: break-word;
            text-align: center;
            color: #fff;
        }

        .wh-voucher .wh-center-item {
            height: 100%;
            width: 50%;
            padding: 12px 0px;
        }

        .wh-voucher .wh-center-item .wh-redution {
            font-size: 18px;
            color: rgba(0, 0, 0, .87);
        }

        .wh-voucher .wh-center-item .wh-condition {
            font-size: 16px;
            color: rgba(0, 0, 0, .87);
            margin-left: 10px;
        }

        .wh-voucher .wh-center-item .wh-end-date {
            font-size: 13px;
            color: #ee4d2d;
            display: flex;
            gap: 0.4rem;
            align-items: center;
        }

        .wh-voucher .wh-center-item .wh-end-date span {
            font-size: 13px;
        }

        .wh-voucher .wh-right-item {
            width: 20%;
            align-items: flex-end;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 0.75rem;
            position: relative;
        }

        .wh-voucher .wh-btn-order {
            width: 100%;
            height: 30px;
            display: flex;
            align-items: center;
            text-align: center;
            background-color: #ee4d2d;
            border-radius: 3px;
            font-size: 13px;
        }

        .wh-voucher .wh-btn-buy-now {
            background-color: transparent;
            color: #efefef;
            width: 100%;
            height: 100%;
        }

        .wh-voucher .wh-history-tab-ui {
            width: 400px;
        }

        .wh-voucher .expired {
            opacity: 0.4;
        }

        .wh-voucher .wh-no-more {
            background-color: #999;
        }

        .wh-voucher .wh-blur {
            background-color: #c5c5c5;
        }

        .wh-voucher .wh-top-history {
            display: flex;
            align-items: center;
            text-align: left;
            padding: 24px 0;
            border-bottom: 1px solid #eaeaea;
        }

        .wh-voucher .wh-title-history {
            font-size: 1.25rem;
            font-weight: 500;
            text-transform: capitalize;
            color: rgba(0, 0, 0, .8);
        }
    </style>
</head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="script.js"></script>
<?php include("layout/header.php"); ?>
<section class="my-account">
    <div class="my-account-box">
        <div class="sidebar-user">
            <div class="name-user">
                <img src="../public/images/icon/user.png" alt="">
                <h4> <?php echo $user["username"] ?> </h4>
            </div>
            <div class="sidebar">
                <ul>
                    <li class="nav-item active">
                        <a href="my_profile.php" class="nav-link">
                            <span class="material-symbols-sharp" style="color: #356af1;">person</span>
                            <p>My Account</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="changePass.php" class="nav-link">
                            <span class="material-symbols-sharp" style="color: #356af1;">redo</span>
                            <p>Change Password </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="purchase_order.php" class="nav-link">
                            <span class="material-symbols-sharp" style="color: #fc8000;">shopping_bag</span>
                            <p>Purchase Order</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="warehouse_voucher.php" class="nav-link">
                            <span class="material-symbols-sharp" style="color: #42995d;">barcode_scanner</span>
                            <p>Warehouse Voucher</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="action-page-box" id="action-page-user">
            <?php include("my_profile.php"); ?>
        </div>
    </div>
    <?php if (isset($_SESSION['status'])) { ?>
        <script>
            alert('<?php echo $_SESSION['status']; ?>');
        </script>
    <?php
        unset($_SESSION['status']); // Clear the session status after displaying
    }
    ?>
</section>

<?php include("layout/footer.php"); ?>