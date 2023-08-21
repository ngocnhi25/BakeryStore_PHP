<?php
require_once('../connect/connectDB.php');
require_once('../handles_page/handle_calculate.php');

// Fetch product details and total number of products
$products = executeResult("SELECT p.product_id, p.product_name, c.product_qty
                            FROM tb_products p
                            INNER JOIN tb_warehouse c ON p.product_id = c.product_id");
$dropdownProducts = executeResult("SELECT product_id, product_name FROM tb_products");

?>

<div class="products">
    <h1>Product Quantity</h1>
    <div class="table_box">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Product Quantity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $key => $product) { ?>
                    <tr>
                        <td>
                            <?= $product["product_id"] ?>
                        </td>
                        <td>
                            <?= $product["product_name"] ?>
                        </td>
                        <td>
                            <input type="number" id="product_qty_<?= $product["product_id"] ?>"
                                value="<?= $product["product_qty"] ?>">
                        </td>
                        <td class="button">
                            <button onclick="updateProductQty(<?= $product['product_id'] ?>)">Update</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="update-form">
        <form id="updateForm">
            <select name="selectedProduct">
                <?php foreach ($dropdownProducts as $product) { ?>
                    <option value="<?= $product["product_id"] ?>"><?= $product["product_id"] ?> . <?= $product["product_name"] ?></option>
                <?php } ?>
            </select>
            <input type="number" name="new_qty" placeholder="New Quantity">
            <button type="button" onclick="insertProductQty()">Insert Quantity</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Trong hàm updateProductQty
    function updateProductQty(productId) {
        var newQty = $('#product_qty_' + productId).val();

        $.ajax({
            type: "POST",
            url: "../handles_page/process_update_qty.php",
            data: {
                product_id: productId,
                new_qty: newQty
            },
            success: function (response) {
                if (response === "success") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Updated!',
                        text: 'Product quantity has been updated successfully.',
                    });
                } else if (response === "exists") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Product does not exist.',
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Failed to update product quantity.',
                    });
                }
            }
        });
    }

    // Hàm xử lý thêm số lượng sản phẩm mới
    function insertProductQty() {
        var selectedProduct = $('#updateForm select[name=selectedProduct]').val();
        var newQty = $('#updateForm input[name=new_qty]').val();

        $.ajax({
            type: "POST",
            url: "../handles_page/process_insert_qty.php",
            data: {
                product_id: selectedProduct,
                new_qty: newQty
            },
            success: function (response) {
                // alert(response);
                if (response === "success") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Inserted!',
                        text: 'Product quantity has been inserted successfully.',
                    });
                } else if (response === "exists") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Already exists.',
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Failed to insert product quantity.',
                    });
                }
            }
        });
    }
</script>
<script src="../../public/backend/js/product.js"></script>