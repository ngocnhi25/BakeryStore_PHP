<?php
require_once('../connect/connectDB.php');

$products = executeResult("select * from tb_products p
                            inner join tb_category c 
                            on p.cate_id = c.cate_id");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/customer.css">
</head>

<body>
    <div class="products">
        <h1>Product Page</h1>
        <div>
            <div class="total-items">
                <p>Products All: <span>125</span></p>
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
                        <tr>
                            <td>
                                <input type="checkbox" name="" value="">
                            </td>
                            <td><?= $key ?></td>
                            <td><?= $product["product_name"] ?></td>
                            <td class="image-product">
                                <img src="../../<?= $product["image"] ?>" alt="" width="200px">
                            </td>
                            <td><?= $product["price"] ?> vnđ</td>
                            <td><?= $product["cate_name"] ?></td>
                            <td>
                                <button type="">Edit</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>