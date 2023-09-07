var sliderOne = $("#slider-1");
var sliderTwo = $("#slider-2");
function showOrders() {
    $.ajax({
        url: "handles/search/filter_search_order.php",
        method: "POST",
        data: { 
            filter_cate: $("#cateSearch").val(),
            arrangeProduct: $("#arrangeProduct").val() 
        },
        success: function (res) {
            $("#container_table_order").empty().html(res);
        }
    });
}

$(document).ready(function () {
    showOrders();

    $("#cateSearch").on("change", function () {
        const cateID = $(this).val();
        $.ajax({
            url: "handles/search/filter_search_order.php",
            method: "POST",
            data: {
                filter_search: $("#filter-search-product").val(),
                filter_cate: cateID,
                filter_price: { 
                    from: sliderOne.val(), 
                    to: sliderTwo.val() 
                },
                arrangeProduct: $("#arrangeProduct").val()
            },
            success: function (res) {
                $("#container_table_product").empty().html(res);
            }
        });
    });

    $("#arrangeProduct").on("change", function () {
        const arrangeProduct = $(this).val();
        $.ajax({
            url: "handles/search/filter_search_order.php",
            method: "POST",
            data: {
                filter_search: $("#filter-search-product").val(),
                filter_cate: $("#cateSearch").val(),
                filter_price: { 
                    from: sliderOne.val(), 
                    to: sliderTwo.val() 
                },
                arrangeProduct: arrangeProduct
            },
            success: function (res) {
                $("#container_table_product").empty().html(res);
            }
        });
    });

    sliderOne.on("change", function () {
        $.ajax({
            url: "handles/search/filter_search_order.php",
            method: "POST",
            data: {
                filter_search: $("#filter-search-product").val(),
                filter_price: { 
                    from: slideOne(), 
                    to: sliderTwo.val() 
                },
                filter_cate: $("#cateSearch").val(),
                arrangeProduct: $("#arrangeProduct").val()
            },
            success: function (res) {
                $("#container_table_product").empty().html(res);
            }
        });
    });
    sliderTwo.on("change", function () {
        $.ajax({
            url: "handles/search/filter_search_order.php",
            method: "POST",
            data: {
                filter_search: $("#filter-search-product").val(),
                filter_price: { 
                    from: sliderOne.val(), 
                    to: slideTwo()
                },
                filter_cate: $("#cateSearch").val(),
                arrangeProduct: $("#arrangeProduct").val()
            },
            success: function (res) {
                $("#container_table_product").empty().html(res);
            }
        });
    });

    slideOne();
    slideTwo();
});
function order_previous(id) {
    $.ajax({
        url: "handles/search/filter_search_order.php",
        method: "POST",
        data: {
            page: id - 1,
            filter_search: $("#filter-search-product").val(),
            filter_price: { 
                from: sliderOne.val(), 
                to: sliderTwo.val() 
            },
            filter_cate: $("#cateSearch").val(),
            arrangeProduct: $("#arrangeProduct").val()
        },
        success: function (res) {
            $("#container_table_product").empty().html(res);
        }
    });
};

function order_next(id) {
    $.ajax({
        url: "handles/search/filter_search_order.php",
        method: "POST",
        data: {
            page: (id + 1),
            filter_search: $("#filter-search-product").val(),
            filter_price: { 
                from: sliderOne.val(), 
                to: sliderTwo.val() 
            },
            filter_cate: $("#cateSearch").val(),
            arrangeProduct: $("#arrangeProduct").val()
        },
        success: function (res) {
            $("#container_table_product").empty().html(res);
        }
    });
};