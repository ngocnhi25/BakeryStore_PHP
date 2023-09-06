<?php
require_once '../connect/connectDB.php';

// Retrieve orders from the database
$orders = executeResult("SELECT * FROM tb_order ORDER BY order_date DESC");
$returnOrder = executeResult("SELECT
*
FROM
tb_return r
INNER JOIN
tb_order_detail od ON r.order_id = od.order_id;
");
$cancelledOrder = executeResult("SELECT *
FROM tb_cancelled c
INNER JOIN tb_order_detail od ON c.order_id = od.order_id
INNER JOIN tb_products p ON c.product_id = p.product_id
INNER JOIN tb_order o ON o.order_id = c.order_id
ORDER BY o.order_date DESC");

?>

<head>
    <style>
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

        /* Overlay styles */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 999;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 70%;
            /* Adjust the width as needed */
            max-width: 800px;
            /* Optional: Set a maximum width */
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            z-index: 1000;
            font-size: 21px;
        }

        /* Close button styles */
        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }

        .form-search-header {
            top: 30%;
            position: relative;
            width: 300px;
            margin-bottom: 10px;
        }

        .form-search-header .icon {
            color: #777e90;
            position: absolute;
            top: 9px;
            left: 10px;
            font-size: 16px;
        }

        .form-search-header input {
            border-radius: 20px;
            padding-left: 30px;
            height: 35px;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<div style="width: 100%;">
    <div>
        <h1>Order details</h1>
    </div>
    <div style="width: 100%;">
        <div class="form-search-header">
            <span class="material-symbols-sharp icon">search</span>
            <input id="filter-search-product" type="text" name="search" placeholder="Search product..." class="form-control">
        </div>
        <table class="table-product" id="table-product">
            <thead>
                <tr>
                    <th>Customer Name</th>
                    <th>Contact Information</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order) : ?>
                    <tr>
                        <td>
                            <?php echo $order['receiver_name']; ?>
                        </td>
                        <td>
                            <p><strong>Phone:</strong>
                                <?php echo $order['receiver_phone']; ?>
                            </p>
                            <p><strong>Address:</strong>
                                <?php echo $order['receiver_address']; ?>
                            </p>
                        </td>
                        <td>
                            <?php echo $order['order_date']; ?>
                        </td>
                        <td>
                            <?php echo $order['status']; ?>
                        </td>
                        <td>
                            <button class="view-btn" data-order_id="<?php echo $order['order_id']; ?>">View</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <!-- <div id="order-details"></div> -->
        </table>

    </div>

    <div>
        <h1>return request</h1>
    </div>
    <div style="width: 100%;">
        <table class="table-product">
            <thead>
                <tr>
                    <th>Reason for Return</th>
                    <th>Customer Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($returnOrder as $r) : ?>
                    <tr>
                        <td>
                            <?php echo $r['reason']; ?>
                        </td>
                        <td>
                            <img src="../../public/images/return_img/<?= $r['customer_image']; ?>" alt="" width="100px" style="border-radius: 10px;">
                            <?= $r['customer_image']; ?>
                        </td>
                        <td>
                            <div id="confirmation-modal" class="">
                                <button id="confirm-return-btn" data-order-id="<?php echo $order['order_id']; ?>">Confirm</button>
                                <button id="cancel-return-btn" data-order-id="<?php echo $order['order_id']; ?>">Cancel</button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <!-- <div id="order-details"></div> -->
        </table>
    </div>

    <div>
        <h1>cancelled request</h1>
    </div>
    <div style="width: 100%;">
        <table class="table-product">
            <thead>
                <tr>
                    <th>Customer Name</th>
                    <th>Reason for Cancelled</th>
                    <th>Product Name</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cancelledOrder as $c) : ?>
                    <tr>
                        <td>
                            <?php echo $c['receiver_name']; ?>
                        </td>
                        <td>
                            <?php echo $c['reason']; ?>
                        </td>
                        <td>
                            <?php echo $c['product_name']; ?>
                        </td>
                        <td>
                            <img src="../../<?= $c['image'] ?>" alt="" width="100px" style="border-radius:10px;">
                        </td>
                        <td>
                            <div id="confirmation-modal" class="">
                                <button id="confirm-success-btn" data-order-id="<?php echo $order['order_id']; ?>">Confirm</button>
                                <button id="cancel-success-btn" data-order-id="<?php echo $order['order_id']; ?>">Cancel</button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <!-- <div id="order-details"></div> -->
        </table>
    </div>

    <!-- Add the confirmation modal -->

</div>
<div id="overlay" class="overlay"></div>
<div id="modal" class="modal">
    <!-- <div class="close-btn" id="close-btn">X</div> -->
    <select id="status-editable">
        <option value="shipping">Shipping</option>
    </select>
    <button id="update-status-btn">Update Status</button>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $(".view-btn").click(function() {
            var order_id = $(this).closest("tr").find(".order-id").val();
            $.ajax({
                url: "../handles_page/get_order_details.php",
                type: "GET",
                data: {
                    order_id: order_id
                },
                success: function(response) {
                    $("#order-details").html(response);
                    $("#status-editable").val($("#status-display").text());
                    $("#overlay").css("display", "block");
                    $("#modal").css("display", "block");
                },
                error: function() {
                    $("#order-details").html("Error fetching order details.");
                }
            });
        });

        var selectedOrderId; // Variable to store the selected order ID

        $(".view-btn").click(function() {
            selectedOrderId = $(this).data("order_id");
            // alert(selectedOrderId);
        });

        $("#update-status-btn").click(function() {
            var newStatus = $("#status-editable").val();
            $.ajax({
                url: "../handles_page/update_order_status.php",
                type: "POST",
                data: {
                    order_id: selectedOrderId,
                    new_status: newStatus
                },
                success: function(response) {
                    // alert(response);
                    // alert(newStatus);
                    $("#status-display").text(newStatus);
                    $("#overlay").css("display", "none");
                    $("#modal").css("display", "none");

                    Swal.fire({
                        icon: 'success',
                        title: 'Status Updated',
                        text: response,
                        timer: 2000,
                        showConfirmButton: false
                    });
                },
                error: function() {
                    // Handle error
                }
            });
        });

        // $(".view-btn").click(function () {
        //     selectedOrderId = $(this).closest("tr").find(".order-id").val();
        //     $("#confirmation-modal").addClass("show");
        // });

        $("#confirm-return-btn").click(function() {
            var order_id = $(this).data("order-id");
            // alert(order_id);
            $.ajax({
                url: "../handles_page/confirm_Return.php",
                type: "POST",
                data: {
                    order_id: order_id,
                    new_status: "return"
                },
                success: function(response) {
                    alert(response);
                    Swal.fire({
                        icon: 'success',
                        title: 'Order Returned',
                        text: response,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(function() {
                        window.location.reload();
                    });
                },
                error: function() {
                    // Handle error
                }
            });
        });

        $("#cancel-return-btn").click(function() {
            var order_id = $(this).data("order-id");
            $.ajax({
                url: "../handles_page/delete_return_request.php",
                type: "POST",
                data: {
                    order_id: order_id
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Return Request Cancelled',
                        text: response,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(function() {
                        window.location.reload();
                    });
                },
                error: function() {
                    // Handle error
                }
            });
        });

        $("#confirm-success-btn").click(function() {
            var order_id = $(this).data("order-id");
            alert(order_id);
            $.ajax({
                url: "../handles_page/confirm_Return.php",
                type: "POST",
                data: {
                    order_id: order_id,
                    new_status: "cancelled"
                },
                success: function(response) {
                    alert(response);
                    Swal.fire({
                        icon: 'success',
                        title: 'Order Returned',
                        text: response,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(function() {
                        window.location.reload();
                    });
                },
                error: function() {
                    // Handle error
                }
            });
        });

        $("#cancel-success-btn").click(function() {
            var order_id = $(this).data("order-id");
            $.ajax({
                url: "../handles_page/delete_cancelled_request.php",
                type: "POST",
                data: {
                    order_id: order_id
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Return Request Cancelled',
                        text: response,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(function() {
                        window.location.reload();
                    });
                },
                error: function() {
                    // Handle error
                }
            });
        });


        function updateTableContent(content) {
            $("#table-product").html(content);
        }

        $('#filter-search-product').keyup(function() {
            var input = $(this).val();

            if (input != "") {
                $.ajax({
                    url: "../handles_page/livesearch.php",
                    method: "POST",
                    data: {
                        input: input
                    },
                    success: function(data) {
                        $("#table-product").html(data);
                    }
                });
            } else {
                $.ajax({
                    url: "../handles_page/loadDefault.php",
                    success: function(data) {
                        updateTableContent(data);
                    }
                });
            }
        });

        $(window).click(function(event) {
            if (event.target === document.getElementById("overlay")) {
                $("#overlay").css("display", "none");
                $("#modal").css("display", "none");
            }
        });
    });
</script>