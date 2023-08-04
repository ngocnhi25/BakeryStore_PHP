<?php
require_once('../connect/connectDB.php');

?>

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../../public/backend/css/table.css">
</head>
<div style=" width: 100%;">
    <h1>Add Sale coupon</h1>
    <div>
        <form method="post" enctype="multipart/form-data" action="" id="saleForm">
            <input type="text" placeholder="enter name of coupon" name="coupon_name"> <br>
            <input type="text" placeholder="enter discount of coupon" name="discount"> <br>
            <p>start date</p>
            <input type="date" name="startDate"> <br>
            <p>end date</p>
            <input type="date" name="endDate"> <br>
            <button id="submitData" class="submit" type="button">Submit</button>
        </form>
    </div>
    <div id="messageBox" style="display: none;"></div>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#submitData").click(function (e) {
                e.preventDefault();
                var formData = new FormData($('#saleForm')[0]);
                $.ajax({
                    type: "POST",
                    url: 'handles/creates/sale.php',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (res) {
                        if (res === 'success') {
                            // Show success message
                            showMessage("Product successfully added to the data!", "success");
                        } else {
                            // Show error message
                            showMessage(res, "error");
                        }
                    }
                });
            });

            // Function to display messages
            function showMessage(message, type) {
                var messageBox = $("#messageBox");
                messageBox.text(message);
                if (type === "success") {
                    messageBox.removeClass("error").addClass("success");
                } else {
                    messageBox.removeClass("success").addClass("error");
                }
                messageBox.show();
                // Hide the message after 5 seconds
                setTimeout(function () {
                    messageBox.hide();
                }, 5000); // Hide after 5 seconds (adjust as needed)
            }
        });
    </script>