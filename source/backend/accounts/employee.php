<?php
session_start();
$from = $to = $error = '';
require_once('../../connect/connectDB.php');
$users = executeResult("SELECT * FROM tb_user WHERE role = 2");

?>

<div class="products">
    <h1>Employee Management</h1>
    <div class="filter-product">
        <div class="form-search-header">
            <span class="material-symbols-sharp icon">search</span>
            <input id="filter-search-Cus" type="text" name="search" placeholder="Search ..." class="form-control">
        </div>
    </div>
</div>

<div class="container-filter-table-sale">
    <div class="filter-action">
        <div class="select-container">
            <select name="category" class="select-box" id="arrangeCus">
                <option value="all">__All Employee__ </option>
                <option value="new_to_old">New to Old </option>
                <option value="old_to_new">Old to New</option>
                <option value="Active">Active</option>
                <option value="Deactive">Deactive</option>
            </select>
        </div>
    </div>
    <div class="table-sale-box"></div>
</div>
</div>
</div>


<script type="text/javascript">
    function deactivateUser(userId) {
        if (confirm("Are you sure you want to deactivate this user?")) {
            // User confirmed, perform the deactivation logic
            $.ajax({
                type: "GET",
                url: '../User/deactive.php',
                data: {
                    code: userId
                },
                success: function(res) {
                    if (res === 'success') {
                        alert("User deactivated successfully!");
                    } else {
                        alert("Failed to deactivate user.");
                    }
                }
            });
        }
    }

    function ActivateUser(userId) {
        if (confirm("Are you sure you want to Activate this user?")) {
            // User confirmed, perform the deactivation logic
            $.ajax({
                type: "GET",
                url: '../User/deactive.php',
                data: {
                    id: userId
                },
                success: function(res) {
                    if (res === 'success') {
                        alert("User Activated successfully!");
                    } else {
                        alert("Failed to Activate user.");
                    }
                }
            });
        }
    }


    function showCus() {
        $.ajax({
            url: "handles/search/filter_search_employee.php",
            method: "POST",
            data: {
                arrangeCustomer: $("#arrangeCus").val()
            },
            success: function(res) {
                $(".table-sale-box").empty().html(res);
            }
        });
    }

    $(document).ready(function() {
        showCus();

        $("#filter-search-Cus").on("input", function() {
            const search = $(this).val();
            if (search !== "") {
                $.ajax({
                    url: "handles/search/filter_search_employee.php",
                    method: "POST",
                    data: {
                        filter_search: search,
                        arrangeCustomer: $("#arrangeCus").val()
                    },
                    success: function(res) {
                        $(".table-sale-box").empty().html(res);
                    }
                });
            } else {
                showCus();
            }
        });

        $("#arrangeCus").on("change", function() {
            const arrangeCus = $(this).val();
            $.ajax({
                url: "handles/search/filter_search_employee.php",
                method: "POST",
                data: {
                    filter_search: $("#filter-search-Cus").val(),
                    arrangeCustomer: arrangeCus
                },
                success: function(res) {
                    $(".table-sale-box").empty().html(res);
                }
            });
        });
    })



    function product_previous(id) {
        $.ajax({
            url: "handles/search/filter_search_employee.php",
            method: "POST",
            data: {
                page: id - 1,
                filter_search: $("#filter-search-Cus").val(),
                arrangeCustomer: $("#arrangeCus").val()
            },
            success: function(res) {
                $(".table-sale-box").empty().html(res);
            }
        });
    };

    function product_next(id) {
        $.ajax({
            url: "handles/search/filter_search_employee.php",
            method: "POST",
            data: {
                page: (id + 1),
                filter_search: $("#filter-search-Cus").val(),
                arrangeCustomer: $("#arrangeCus").val()
            },
            success: function(res) {
                $(".table-sale-box").empty().html(res);
            }
        });
    };
    
</script>