<?php 
require_once('connect/connect.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/customer.css">
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
                    <tr>
                        <td>
                            <input type="checkbox" name="" value="">
                        </td>
                        <td>1</td>
                        <td>Bánh trứng muối</td>
                        <td class="image-product">
                            <img src="./images/z4468923591853_8550ce75e46905c47a016890f1aba20d.jpg" alt="">
                        </td>
                        <td>200.000 vnđ</td>
                        <td>Bánh bông lan</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" name="" value="">
                        </td>
                        <td>2</td>
                        <td>Bánh trứng muối</td>
                        <td>
                            <img src="./images/z4468923591853_8550ce75e46905c47a016890f1aba20d.jpg" alt="">
                        </td>
                        <td>200.000 vnđ</td>
                        <td>Bánh bông lan</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" name="" value="">
                        </td>
                        <td>3</td>
                        <td>Bánh trứng muối</td>
                        <td>
                            <img src="./images/z4468923591853_8550ce75e46905c47a016890f1aba20d.jpg" alt="">
                        </td>
                        <td>200.000 vnđ</td>
                        <td>Bánh bông lan</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>