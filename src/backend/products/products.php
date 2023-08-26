<?php
require_once('../../connect/connectDB.php');
require_once('../../handles_page/handle_calculate.php');

$products = executeResult("SELECT * from tb_products p
                            inner join tb_category c 
                            on p.cate_id = c.cate_id
                            ORDER BY product_id DESC");
$cates = executeResult("SELECT * FROM tb_category c INNER JOIN tb_products p ON c.cate_id = p.cate_id GROUP BY c.cate_id");

function maxPrice()
{
    global $products;
    $max = 0;
    foreach ($products as $p) {
        if ($max == null || $p["price"] > $max) {
            $max = $p["price"];
        }
    }

    return $max / 1000;
}
function minPrice()
{
    global $products;
    $min = 0;
    foreach ($products as $p) {
        if ($min == null || $p["price"] < $min) {
            $min = $p["price"];
        }
    }

    return $min / 1000;
}
?>

<head>
    <style>
        .filter-product {
            position: relative;
            justify-content: space-between;
            display: flex;
            width: 100%;
            height: 50px;
        }

        .filter-product .filter-product-box {
            display: flex;
            gap: 2rem;
            height: 100%;
        }

        .products {
            padding-bottom: 30px;
            min-width: 1000px;
        }

        .table-product {
            width: 100%;
            border-collapse: collapse;
            position: relative;
        }

        .table-product thead th {
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

        .table-product thead th:last-child {
            border: none;
        }

        .table-product thead th:first-child,
        .table-product tbody td:first-child {
            text-align: center;
            width: 3.7rem;
        }

        .table-product tbody tr:nth-child(even) {
            background-color: #0000000b;
        }

        .table-product tbody tr:hover {
            background-color: #d7f4f7e3 !important;
        }

        .table-product td {
            border-collapse: collapse;
            padding: 0.6rem;
            text-align: center;
            color: #717171;
        }

        .table_box_product {
            margin-top: 1rem;
            width: 100%;
            max-height: 700px;
            /* border: 0.15rem solid #657b7f; */
            border-radius: 0.6rem;
            /* background-color: var(--color-background-table); */
            overflow: auto;
        }

        .table_box_product::-webkit-scrollbar {
            width: 0.5rem;
            height: 0.5rem;
        }

        .table_box_product::-webkit-scrollbar-thumb {
            border-radius: 0.5rem;
            background-color: #0004;
            visibility: hidden;
        }

        .table_box_product:hover::-webkit-scrollbar-thumb {
            visibility: visible;
        }

        .filter-option {
            bottom: 0;
        }

        .filter-range {
            position: relative;
            width: 300px;
            border-radius: 10px;
        }

        .filter-range .input-range {
            position: relative;
            width: 100%;
            margin-top: 10px;
        }

        .filter-range input[type="range"] {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            width: 100%;
            outline: none;
            position: absolute;
            margin: auto;
            top: 0;
            bottom: 0;
            background-color: transparent;
            pointer-events: none;
        }

        .filter-range .slider-track {
            width: 100%;
            height: 4px;
            position: absolute;
            margin: auto;
            top: 0;
            bottom: 0;
            border-radius: 4px;
        }

        .filter-range input[type="range"]::-webkit-slider-runnable-track {
            -webkit-appearance: none;
            height: 4px;
        }

        .filter-range input[type="range"]::-moz-range-track {
            -moz-appearance: none;
            height: 4px;
        }

        .filter-range input[type="range"]::-ms-track {
            appearance: none;
            height: 4px;
        }

        .filter-range input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none;
            height: 1.2em;
            width: 1.2em;
            background-color: #3264fe;
            cursor: pointer;
            margin-top: -5px;
            pointer-events: auto;
            border-radius: 50%;
        }

        .filter-range input[type="range"]::-moz-range-thumb {
            --webkit-appearance: none;
            height: 1.2em;
            width: 1.2em;
            cursor: pointer;
            border-radius: 50%;
            background-color: #3264fe;
            pointer-events: auto;
        }

        .filter-range input[type="range"]::-ms-thumb {
            appearance: none;
            height: 1.2em;
            width: 1.2em;
            cursor: pointer;
            border-radius: 50%;
            background-color: #3264fe;
            pointer-events: auto;
        }

        .filter-range input[type="range"]:active::-webkit-slider-thumb {
            background-color: #ffffff;
            border: 2px solid #3264fe;
        }

        .filter-range .values-range {
            background-color: #3264fe;
            width: 90px;
            position: relative;
            margin: auto;
            padding: 4px 0;
            border-radius: 3px;
            text-align: center;
            font-weight: 500;
            font-size: 10px;
            color: #ffffff;
        }

        .filter-range .values-range:before {
            content: "";
            position: absolute;
            height: 0;
            width: 0;
            border-top: 8px solid #3264fe;
            border-left: 8px solid transparent;
            border-right: 8px solid transparent;
            margin: auto;
            bottom: -8px;
            left: 0;
            right: 0;
        }

        .select-container {
            top: 30%;
            display: flex;
            width: 200px;
            position: relative;
            height: 30px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 1px 1px 3px black;
        }

        .select-box {
            border: none;
            width: 100%;
            padding: 6px 10px 6px 10px;
            color: #000;
            background-color: #fff;
            font-size: 14px;
        }

        .filter-product .form-search-header {
            top: 30%;
            position: relative;
            width: 300px;
        }

        .filter-product .form-search-header .icon {
            color: #777e90;
            position: absolute;
            top: 9px;
            left: 10px;
            font-size: 16px;
        }

        .filter-product .form-search-header input {
            border-radius: 20px;
            padding-left: 30px;
        }

        .filter-product .form-control:focus {
            color: #495057;
            background-color: #fff;
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25);
        }

        .filter-product .form-control {
            display: block;
            width: 100%;
            height: calc(2.25rem + 2px);
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        .example {
            margin: 3rem auto;
            text-align: center;
        }

        .example>.text {
            display: inline-block;
            position: relative;
            padding: 1rem 3rem;
            transform: translateY(-.5rem);
            text-transform: uppercase;
            perspective: 10rem;
            cursor: pointer;
        }

        .example>.text:first-of-type {
            padding-left: 4rem;
        }

        .example>.text:first-of-type::before {
            content: '';
            height: 100%;
            width: 100%;
            position: absolute;
            top: 0;
            left: 0;
            transform: rotateY(10deg) translateX(calc(2rem - 3px));
            z-index: -1;
            background: #ffffff;
        }

        .example>.text:last-of-type {
            padding-right: 4rem;
        }

        .example>.text:last-of-type::after {
            content: '';
            height: 100%;
            width: 100%;
            position: absolute;
            top: 0;
            left: 0;
            transform: rotateY(-10deg) translateX(calc(-1rem - 6px));
            z-index: -1;
            background: #ffffff;
        }

        .example>.counter {
            display: inline-block;
            position: relative;
            padding: .5rem 2rem;
        }

        .example>.counter>.background {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background: #6a558e;
            border-radius: .7rem;
        }

        .example>.counter>.background::before {
            content: '';
            height: 100%;
            width: 100%;
            position: absolute;
            top: -4px;
            left: -4px;
            z-index: -1;
            border-radius: 1rem;
            border: solid #ffffff 4px;
            background: #6a558e;
        }

        .example>.counter>.background::after {
            content: '';
            width: 80%;
            padding-top: 80%;
            position: absolute;
            top: 50%;
            left: 50%;
            z-index: -1;
            border-radius: 50%;
            transform: translateX(-50%) translateY(-50%);
            border: solid #fff 4px;
            background: #6a558e;
        }

        .example>.counter>.number {
            position: relative;
            display: inline-block;
            z-index: 1;
            transform: translateY(-2px);
            color: #ffffff;
        }

        .example>.counter>.number:first-of-type {
            font-size: 2rem;
        }

        .example>.counter>.number:first-of-type::after {
            content: '/';
            display: inline-block;
            padding: 0 .2rem;
            font-size: 2.5rem;
        }

        .example>.counter>.number:last-of-type {
            font-size: 1rem;
            transform: translateY(-0.8rem) translateX(-.2rem);
        }

        @media screen and (max-width: 600px) {
            .example>.text {
                display: block;
            }

            .example>.text:first-of-type {
                margin-bottom: 3rem;
            }

            .example>.text:last-of-type {
                margin-top: 4rem;
            }
        }
    </style>
</head>
<div class="products">
    <h1>Product Page</h1>
    <div class="filter-product">
        <div class="form-search-header">
            <span class="material-symbols-sharp icon">search</span>
            <input id="filter-search-product" type="text" name="search" placeholder="Search product..." class="form-control">
        </div>
        <div class="filter-product-box">
            <div class="filter-range">
                <div class="values-range">
                    <span id="range1">
                        <?= minPrice() ?>
                    </span>
                    <span> &dash; </span>
                    <span id="range2">
                        <?= maxPrice() ?>
                    </span>
                </div>
                <div class="input-range">
                    <div class="slider-track"></div>
                    <input type="range" min="0" max="<?= maxPrice() ?>" value="<?= minPrice() ?>" id="slider-1">
                    <input type="range" min="0" max="<?= maxPrice() ?>" value="<?= maxPrice() ?>" id="slider-2">
                </div>
            </div>
            <div class="select-container">
                <select name="category" class="select-box" id="cateSearch">
                    <option value="">__All Category__</option>
                    <?php foreach ($cates as $key => $c) { ?>
                        <option value="<?= $c["cate_id"] ?>"><?= $c["cate_name"] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="select-container">
                <select name="category" class="select-box" id="arrangeProduct">
                    <option value="new_to_old">New to old</option>
                    <option value="old_to_new">Old to new</option>
                    <option value="view">View</option>
                    <option value="product_qty">Product quantity</option>
                </select>
            </div>
        </div>
    </div>
    <div id="container_table_product"></div>
</div>

<script src="../../public/backend/js/product.js"></script>