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

<div class="products">
    <h1>Product Management</h1>
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