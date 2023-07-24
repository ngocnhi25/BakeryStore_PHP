<?php
require_once('../../connect/connectDB.php');

$products = executeResult("select * from tb_products p
                            inner join tb_category c 
                            on p.cate_id = c.cate_id
                            ORDER BY product_id DESC");
$allProduct = executeSingleResult("select count(*) as total from tb_products");

// echo '<pre>';
// var_dump($products);
// die();

?>

<head>
    <link rel="stylesheet" href="css/table.css">
    <style>
        table,
        td {
            text-align: center;
        }
    </style>
</head>

<div class="products" id="products">
    <h1>Product Page</h1>
    <div>
        <div class="total-items">
            <p>Products All: <span><?= $allProduct["total"] ?></span></p>
            <p>Products Delete: <span>25</span></p>
        </div>
    </div>
    <div class="table_customer">
        <table>
            <thead>
                <tr>
                    <th>
                        <input type="checkbox" name=""> All
                    </th>
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
                        <td>
                            <input type="checkbox" name="" value="">
                        </td>
                        <td><?= $key + 1 ?></td>
                        <td><?= $product["product_name"] ?></td>
                        <td class="image-product">
                            <img src="../<?= $product["image"] ?>" alt="" width="200px">
                        </td>
                        <td><?php echo (number_format((float) str_replace([' VNĐ', ','], '', $product["price"]), 0, ',', '.')) ?> VNĐ</td>
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

<script>
    function editProduct(id) {
        var postData = {
            id: id,
            title: 'Update Product'
        }
        $.ajax({
            type: "GET",
            url: "products/product_add.php",
            data: postData,
            success: function(response) {
                $("#main-page").html(response);
            },
            error: function(xhr, status, error) {
                console.error("Lỗi: " + error);
            }
        });
    }

    function deleteProduct(id) {
        $.ajax({
            type: "POST",
            url: "handles/deletes/product_delete.php",
            data: {
                id: id
            },
            success: function(response) {
                $("#main-page").load(response);
            },
            error: function(xhr, status, error) {
                console.error("Lỗi: " + error);
            }
        });
    }

    function formatVND(amount) {
      return amount.toLocaleString("vi-VN") + " VNĐ";
    }
</script>