<?php
require_once('../../connect/connectDB.php');
require_once('../../handles_page/handle_display.php');

$products = executeResult("select * from tb_products p
                            inner join tb_category c 
                            on p.cate_id = c.cate_id
                            ORDER BY product_id DESC");
$allProduct = executeSingleResult("select count(*) as total from tb_products");

?>

<div class="products">
    <h1>Product Page</h1>
    <div>
        <div class="total-items">
            <p>Products All: <span><?= $allProduct["total"] ?></span></p>
            <p>Products Delete: <span>25</span></p>
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
                        <td><?php displayPrice($product["price"]) ?> VNĐ</td>
                        <td><?= $product["cate_name"] ?></td>
                        <td class="button">
                            <button id="editProduct" onclick='editProduct(<?= $product["product_id"] ?>)' type="button" class="update">Update</button>
                            <?php if ($product["deleted"] == 0) { ?>
                                <button type="button" onclick='deleteProduct(<?= $product["product_id"] ?>)' class="delete">Delete</button>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script src="../../public/backend/js/product.js"></script>