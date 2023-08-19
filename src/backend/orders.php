<?php
require_once("../connect/connectDB.php");

// Retrieve orders from the database
$orders = executeResult("SELECT * FROM tb_order");

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
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                    <th>Customer Name</th>
                    <th>Contact Information</th>
                    <th>Order Date</th>
                    <th>Products</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td>#
                            <?php echo $order['order_id']; ?>
                            <input type="hidden" class="order-id" value="<?php echo $order['order_id']; ?>">
                        </td>
                        <td>
                            <?php echo $order['name']; ?>
                        </td>
                        <td>
                            <p><strong>Phone:</strong>
                                <?php echo $order['phone']; ?>
                            </p>
                            <p><strong>Address:</strong>
                                <?php echo $order['address']; ?>
                            </p>
                        </td>
                        <td>
                            <?php echo $order['order_date']; ?>
                        </td>
                        <td>
                            <?php echo $order['products']; ?>
                        </td>
                        <td>
                            <button class="view-btn" data-order-id="<?php echo $order['order_id']; ?>">View</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <!-- <div id="order-details"></div> -->
        </table>
    </div>
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
            // alert(order_id);
            $.ajax({
                url: "../handles_page/get_order_details.php",
                type: "GET",
                data: { order_id: order_id },
                success: function (response) {
                    $("#order-details").html(response);
                    $("#status-editable").val($("#status-display").text()); // Set select value to current status
                    $("#overlay").css("display", "block");
                    $("#modal").css("display", "block");
                },
                error: function () {
                    $("#order-details").html("Error fetching order details.");
                }
            });
        });

        $(document).ready(function () {
            var selectedOrderId; // Variable to store the selected order ID

            $(".view-btn").click(function () {
                selectedOrderId = $(this).closest("tr").find(".order-id").val(); // Store the order ID
                // ... your existing AJAX code
            });

            // Update the status using AJAX
            $("#update-status-btn").click(function () {
                var newStatus = $("#status-editable").val();
                $.ajax({
                    url: "../handles_page/update_order_status.php",
                    type: "POST",
                    data: { order_id: selectedOrderId, new_status: newStatus },
                    success: function (response) {
                        $("#status-display").text(newStatus);
                        $("#overlay").css("display", "none");
                        $("#modal").css("display", "none");
                        // alert(response);

                        // Display a pop-up notification using SweetAlert2
                        Swal.fire({
                            icon: 'success',
                            title: 'Status Updated',
                            text: response,
                            timer: 2000, // Automatically close after 2 seconds
                            showConfirmButton: false
                        });
                    },
                    error: function () {
                        // Handle error
                    }
                });
            });
        });

        // Close the modal when clicking outside the modal content
        $(window).click(function (event) {
            if (event.target === document.getElementById("overlay")) {
                $("#overlay").css("display", "none");
                $("#modal").css("display", "none");
            }
        });
    });
</script>