<?php
require_once('../../connect/connectDB.php');

$products = executeResult("select * from tb_products p
                            inner join tb_category c 
                            on p.cate_id = c.cate_id");
$allProduct = executeSingleResult("select count(*) as total from tb_products");

// echo '<pre>';
// print_r($allProduct);
// die();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/customer.css">
    <style>
        table,
        td {
            text-align: center;
        }

        button {
            padding: 0.4rem 0.9rem 0.4rem 0.9rem;
            font-weight: 500;
            font-size: 1rem;
            border-radius: 10px;
            border: none;
        }

        .button {
            gap: 0.9rem;
            justify-content: space-between;
        }

        .edit {
            background-color: #2c86d1fe;
        }

        .delete {
            background-color: #e10a29fe;
        }
    </style>
</head>

<body>
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
                        <tr>
                            <td>
                                <input type="checkbox" name="" value="">
                            </td>
                            <td><?= $key + 1 ?></td>
                            <td><?= $product["product_name"] ?></td>
                            <td class="image-product">
                                <img src="../<?= $product["image"] ?>" alt="" width="200px">
                            </td>
                            <td><?= $product["price"] ?> vnđ</td>
                            <td><?= $product["cate_name"] ?></td>
                            <td class="button">
                                <button id="editProduct" onclick='editProduct(<?= $product["product_id"] ?>)' type="button" class="edit">Edit</button>
                                <button type="button" class="delete" onclick='deleteProduct(<?= $product["product_id"] ?>)'>Delete</button>
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
                    url: "products/product-add.php", // Điền URL của trang mới ở đây
                    data: postData,
                    success: function(response) {
                        // Xử lý kết quả trả về sau khi chuyển trang thành công
                        $("#main-page").html(response);
                    },
                    error: function(xhr, status, error) {
                        // Xử lý lỗi nếu có
                        console.error("Lỗi: " + error);
                    }
                });
            }
            function deleteProduct(id) {
                $.post(
                    "delete/product_delete.php",
                    { id: id },
                    function(data){
                        alert(data);
                    }
                )
            }
    </script>
</body>

</html>