<?php
require_once("../connect/connectDB.php");
?>

<head>
    <style>
        .img-box-order {
            width: 100%;
            display: flex;
            align-items: center;
            margin-top: 10px;
            gap: 1rem;
        }
        .img-box-order .inf-order {
            text-align: left;
        }
    </style>
</head>
<div style="width: 100%;">
    <div>
        <h1>Order details</h1>
    </div>
    <div style="width: 100%;">
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Product Name</th>
                    <th>Information</th>
                    <th>Delivery Date</th>
                    <th>Total Pay</th>
                    <th>Content</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>#12224</td>
                    <td style="width: 300px;">
                        <div class="img-box-order">
                            <div>
                                <img src="../../public/images/products/z4345090955163_e17c096a2e6e72c53bd66cea020e074d.jpg" alt="" width="80">
                            </div>
                            <div class="inf-order">
                                <p>bánh trứng muối</p>
                                <p>x1</p>
                            </div>
                        </div>
                        <div class="img-box-order">
                        <div>
                            <img src="../../public/images/products/z4345090955163_e17c096a2e6e72c53bd66cea020e074d.jpg" alt="" width="80">
                        </div>
                        <div class="inf-order">
                            <p>bánh trứng muối</p>
                            <p>x3</p>
                        </div>
                        </div>
                    </td>
                    <td>
                        <div>
                            <p>Võ Tòng</p>
                            <p>0988747898</p>
                            <p>q12, hcm</p>
                        </div>
                    </td>
                    <td>15/05/2023 07:30:00</td>
                    <td>500000 vnđ</td>
                    <td style="width: 200px;">Nguyen Tan Tai, 20/17/2023, thêm một tuổi làm ơn...bớt ngu lại ok !!!</td>
                    <td>
                        <button>Pendding</button>
                    </td>
                    <td>
                        <button class="create">View</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>