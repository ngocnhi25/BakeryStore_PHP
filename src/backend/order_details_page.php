<?php
if (isset($_POST["ajaxSidebar"])) {
    require_once '../connect/connectDB.php';
}

// Retrieve orders from the database
$order_details = executeResult("SELECT o.*, p.*, u.username, odr.order_date
                                FROM tb_order_detail o
                                JOIN tb_products p ON o.product_id = p.product_id
                                JOIN tb_user u ON o.user_id = u.user_id
                                JOIN tb_order odr ON o.order_id = odr.order_id
                                ORDER BY o.order_detail_id DESC");

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
            <input id="filter-search-product" type="text" name="search" placeholder="Search product..."
                class="form-control">
        </div>
        <table class="table-product" id="table-product">
            <thead>
                <tr>
                    <th>Customer Name</th>
                    <th>Order Date</th>
                    <th>Image Product</th>
                    <th>Size</th>
                    <th>Product Name</th>
                    <th>Flavor</th>
                    <th>Quantity</th>
                    <th>Money is discounted</th>
                    <th>Total Pay</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($order_details as $od): ?>
                    <tr>
                        <td>
                            <?php echo $od['username']; ?>
                        </td>
                        <td>
                            <?php echo $od['order_date']; ?>
                        </td>
                        <td>
                            <img src="../../<?php echo $od['image']; ?>" alt="" width="100px" style="border-radius:10px;">
                        </td>
                        <td>
                            <?=$od['size'];?>
                        </td>
                        <td>
                            <?=$od['product_name'];?>
                        </td>
                        <td>
                            <?=$od['flavor'];?>
                        </td>
                        <td>
                            <?=$od['quantity'];?>
                        </td>
                        <td>
                            <?=$od['sale_product'] = number_format($od['sale_product'], 0)?> vnd
                        </td>
                        <td>
                            <?=$od['total_money'] = number_format($od['total_money'], 0)?> vnd
                        </td>
                    </tr>
                <?php endforeach;?>
            </tbody>
            <!-- <div id="order-details"></div> -->
        </table>
    </div>


    <!-- Add the confirmation modal -->

</div>
<div id="overlay" class="overlay"></div>
<div id="modal" class="modal">
    <!-- <div class="close-btn" id="close-btn">X</div> -->
    <div id="order-details"></div>
    <select id="status-editable">
        <option value="pending">Pending</option>
        <option value="processing">Processing</option>
        <option value="completed">Completed</option>
        <option value="cancelled">Cancelled</option>
    </select>
    <button id="update-status-btn">Update Status</button>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $(".view-btn").click(function () {
            var order_id = $(this).closest("tr").find(".order-id").val();
            $.ajax({
                url: "../handles_page/get_order_details.php",
                type: "GET",
                data: { order_id: order_id },
                success: function (response) {
                    $("#order-details").html(response);
                    $("#status-editable").val($("#status-display").text());
                    $("#overlay").css("display", "block");
                    $("#modal").css("display", "block");
                },
                error: function () {
                    $("#order-details").html("Error fetching order details.");
                }
            });
        });

        var selectedOrderId; // Variable to store the selected order ID

        $(".view-btn").click(function () {
            selectedOrderId = $(this).closest("tr").find(".order-id").val();
            alert(selectedOrderId);
        });

        $("#update-status-btn").click(function () {
            var newStatus = $("#status-editable").val();
            $.ajax({
                url: "../handles_page/update_order_status.php",
                type: "POST",
                data: { order_id: selectedOrderId, new_status: newStatus },
                success: function (response) {
                    // alert(response);
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
                error: function () {
                    // Handle error
                }
            });
        });

        // $(".view-btn").click(function () {
        //     selectedOrderId = $(this).closest("tr").find(".order-id").val();
        //     $("#confirmation-modal").addClass("show");
        // });

        $("#confirm-return-btn").click(function () {
            var order_id = $(this).data("order-id");
            alert(order_id);
            $.ajax({
                url: "../handles_page/update_order_status.php",
                type: "POST",
                data: { order_id: order_id, new_status: "return" },
                success: function (response) {
                    alert(response);
                    Swal.fire({
                        icon: 'success',
                        title: 'Order Returned',
                        text: response,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(function () {
                        window.location.reload();
                    });
                },
                error: function () {
                    // Handle error
                }
            });
        });

        $("#cancel-return-btn").click(function () {
            var order_id = $(this).data("order-id");
            $.ajax({
                url: "../handles_page/delete_return_request.php",
                type: "POST",
                data: { order_id: order_id },
                success: function (response) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Return Request Cancelled',
                        text: response,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(function () {
                        window.location.reload();
                    });
                },
                error: function () {
                    // Handle error
                }
            });
        });


        function updateTableContent(content) {
            $("#table-product").html(content);
        }

        $('#filter-search-product').keyup(function () {
            var input = $(this).val();

            if (input != "") {
                $.ajax({
                    url: "../handles_page/livesearch.php",
                    method: "POST",
                    data: { input: input },
                    success: function (data) {
                        $("#table-product").html(data);
                    }
                });
            } else {
                $.ajax({
                    url: "../handles_page/loadDefault.php",
                    success: function (data) {
                        updateTableContent(data);
                    }
                });
            }
        });

        $(window).click(function (event) {
            if (event.target === document.getElementById("overlay")) {
                $("#overlay").css("display", "none");
                $("#modal").css("display", "none");
            }
        });
    });

</script>