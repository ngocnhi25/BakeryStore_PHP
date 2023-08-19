<?php
require_once('../../connect/connectDB.php');
require_once('../../handles_page/handle_calculate.php');

$products = executeResult("SELECT * from tb_products p
                            inner join tb_category c 
                            on p.cate_id = c.cate_id
                            ORDER BY product_id DESC");
$allProduct = executeSingleResult("select count(*) as total from tb_products");
$cates = executeResult("SELECT * FROM tb_category c INNER JOIN tb_products p ON c.cate_id = p.cate_id GROUP BY c.cate_id");

function maxPrice() {
    global $products;
    $max = 0;
    foreach ($products as $p) {
        if ($max === null || $p["price"] > $max) {
            $max = $p["price"];
        }
    }

    return $max;
}
?>

<head>
    <style>
        .filter-product {
            display: flex;
            gap: 2rem;
        }
    </style>
</head>
<div class="products">
    <h1>Product Page</h1>
    <div>
        <div class="total-items">
            <p>Products All: <span><?= $allProduct["total"] ?></span></p>
            <p>Products Delete: <span>25</span></p>
        </div>
    </div>
    <div class="filter-product">
        <div>
            <select name="category" id="cateSearch">
                <option value="">__All__</option>
                <?php foreach ($cates as $key => $c) { ?>
                    <option value="<?= $c["cate_id"] ?>"><?= $c["cate_name"] ?></option>
                <?php } ?>
            </select>
        </div>
        <div>
            <input type="text" id="filterPrice" value="0,10000000">
        </div>
    </div>
    <div class="table_box">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>View</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $key => $product) { ?>
                    <tr <?php echo (($product["deleted"] == 1) ? 'style="opacity: 0.5;"' : '') ?>>
                        <td><?= $key + 1 ?></td>
                        <td><?= $product["product_name"] ?></td>
                        <td>
                            <img src="../../<?= $product["image"] ?>" alt="" style="width: 130px; border-radius: 8px;">
                        </td>
                        <td><?php echo displayPrice($product["price"]) ?> VNĐ</td>
                        <td><?= $product["cate_name"] ?></td>
                        <td><?= $product["view"] ?></td>
                        <td class="button">
                            <button onclick='editProduct(<?= $product["product_id"] ?>)' type="button" class="update">Update</button>
                            <?php if ($product["deleted"] == 0) { ?>
                                <button onclick='hideProduct(<?= $product["product_id"] ?>)' type="button" class="hide">Hide</button>
                            <?php } else { ?>
                                <button onclick='recoverProduct(<?= $product["product_id"] ?>)' type="button" class="recover">Recover</button>
                            <?php } ?>
                            <button type="button" onclick='deleteProduct("<?= $product["product_name"] ?>", <?= $product["product_id"] ?>)' class="delete">Delete</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script src="../../public/backend/js/product.js"></script>