<?php
session_start();
require_once('../connect/connectDB.php');

$comment = executeResult("SELECT * from tb_comments c
                            inner join tb_products p
                            on p.product_id  = c.product_id 
                            ORDER BY comment_id  DESC");
?>

<div class="products">
    <h1>Comment Management</h1>
    <div class="filter-product">
        <div class="form-search-header">
            <span class="material-symbols-sharp icon">search</span>
            <input id="filter-search-comment" type="text" name="search" placeholder="Search ..." class="form-control">
        </div>
        </div>
</div>

        <div class="container-filter-table-sale">
            <div class="filter-action">
                <div class="select-container">
                    <select name="category" class="select-box" id="arrangeCom">
                        <option value="all">All Comment</option>
                        <option value="new_to_old">New to Old</option>
                        <option value="old_to_new">Old to New</option>
                    </select>
                </div>
            </div>
            <div class="table-sale-box"></div>
        </div>
    </div>
</div>

<script>

function DeleteCom(Com_Id) {
        if (confirm("Are you sure you want to delete this comment?")) {
            // User confirmed, perform the deactivation logic
            $.ajax({
                type: "GET",
                url: '../User/delete_comment.php',
                data: {
                    code: Com_Id
                },
                success: function(res) {
                    if (res === 'success') {
                        alert("This Comment have deleted successfully!");
                    } else {
                        alert("Failed to deleted this comment .");
                    }
                }
            });
        }
    }

    function showCommnet() {
        $.ajax({
            url: "handles/search/filter_search_comment.php",
            method: "POST",
            data: {
                arrangeComment: $("#arrangeCom").val()
            },
            success: function(res) {
                $(".table-sale-box").empty().html(res);
            }
        });
    }

    $(document).ready(function() {
        showCommnet();

        $("#filter-search-comment").on("input", function() {
            const search = $(this).val();
            if ( search !== "") {
                $.ajax({
                    url: "handles/search/filter_search_comment.php",
                    method: "POST",
                    data: {
                        filter_search: search,
                        arrangeComment: $("#arrangeCom").val()
                    },
                    success: function(res) {
                        $(".table-sale-box").empty().html(res);
                    }
                });
            } else {
                showCommnet();
            }
        });

        $("#arrangeCom").on("change", function() {
            const arrangeCom = $(this).val();
            $.ajax({
                url: "handles/search/filter_search_comment.php",
                method: "POST",
                data: {
                    filter_search: $("#filter-search-comment").val(),
                    arrangeComment: arrangeCom
                },
                success: function(res) {
                    $(".table-sale-box").empty().html(res);
                }
            });
        });
    })



    function product_previous(id) {
        $.ajax({
            url: "handles/search/filter_search_comment.php",
            method: "POST",
            data: {
                page: id - 1,
                filter_search: $("#filter-search-comment").val(),
                arrangeComment: $("#arrangeCom").val()
            },
            success: function(res) {
                $(".table-sale-box").empty().html(res);
            }
        });
    };

    function product_next(id) {
        $.ajax({
            url: "handles/search/filter_search_comment.php",
            method: "POST",
            data: {
                page: (id + 1),
                filter_search: $("#filter-search-comment").val(),
                arrangeComment: $("#arrangeCom").val()
            },
            success: function(res) {
                $(".table-sale-box").empty().html(res);
            }
        });
    };
</script>
