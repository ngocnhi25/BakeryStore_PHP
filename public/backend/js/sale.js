function updateCoupon(id) {
    var postData = {
        idCoupon: id
    }
    ajaxPageData("sale.php", postData);
}

function hideCoupon(coupon_name, id) {
    const html = `
    <div class="message-confirm-box">
        <div class="message-confirm">
            <div>Are you sure you want to decommission voucher code ${coupon_name}?</div>
            <div>
                <button class="cancel" type="button">Cancal</button>
                <button id="hide-coupon" class="create" type="button">Ok</button>
            </div>
        </div>
    </div>`;
    $("body").append(html);

    $(".cancel").click(function () {
        $(".message-confirm-box").remove();
    });

    $("#hide-coupon").click(function () {
        $.post(
            "handles/hides/coupon.php", {
            id: id
        },
            function (res) {
                $(".message-confirm-box").remove();
                ajaxPages(res);
            }
        )
    });
}
function recoverCoupon(coupon_name, id) {
    const html = `
    <div class="message-confirm-box">
        <div class="message-confirm">
            <div>Are you sure you want to show coupon ${coupon_name} to the user?</div>
            <div>
                <button class="cancel" type="button">Cancal</button>
                <button id="recover-coupon" class="create" type="button">Ok</button>
            </div>
        </div>
    </div>`;
    $("body").append(html);

    $(".cancel").click(function () {
        $(".message-confirm-box").remove();
    });

    $("#recover-coupon").click(function () {
        $.post(
            "handles/updates/recover_coupon.php", {
            id: id
        },
            function (res) {
                $(".message-confirm-box").remove();
                ajaxPages(res);
            }
        )
    });
}

function deleteCoupon(couponName, id) {
    const html = `
    <div class="message-confirm-box">
        <div class="message-confirm">
            <div>Are you sure to permanently delete voucher code ${couponName}?</div>
            <div>
                <button class="cancel" type="button">Cancal</button>
                <button id="delete-coupon" class="deleted" type="button">Delete</button>
            </div>
        </div>
    </div>`;

    $("body").append(html);

    $(".cancel").click(function () {
        $(".message-confirm-box").remove();
    });

    $("#delete-coupon").click(function () {
        $.post(
            "handles/deletes/coupon.php", {
            id: id
        },
            function (res) {
                if (res === "doNotDelete") {
                    const htmls = `
                        <div class="message-confirm-box">
                            <div class="message-confirm">
                                <div>There are already customers using this voucher! do not delete ! Do you want to deactivate voucher code ${couponName} or not?</div>
                                <div>
                                    <button class="cancel" type="button">Cancal</button>
                                    <button id="hide-coupon" class="create" type="button">Ok</button>
                                </div>
                            </div>
                        </div>`;
                    $("body").append(htmls);

                    $(".cancel").click(function () {
                        $(".message-confirm-box").remove();
                    });
                    $("#hide-coupon").click(function () {
                        $.post(
                            "handles/hides/coupon.php", {
                            id: id
                        },
                            function (resData) {
                                $(".message-confirm-box").remove();
                                ajaxPages(resData);
                            }
                        )
                    });
                } else if(res === "success") {
                    $(".message-confirm-box").remove();
                    ajaxPages("sale.php");
                }
            }
        )
    });
}

$(document).ready(function () {
    $("#input-product-name").on("input", function () {
        var search = $(this).val();
        if (search !== "") {
            $.ajax({
                url: "handles/search/search_product.php",
                method: "POST",
                data: {
                    product_name: search
                },
                success: function (response) {
                    $("#search-result-product").show().html(response);
                    $(".product-name").click(function () {
                        var productName = $(this).text();
                        $("#input-product-name").val(productName);
                        $("#search-result-product").hide().empty();
                    })
                }
            });
        } else {
            $("#search-result-product").hide().empty();
        }
    });
});

function updateSale(id) {
    var postData = {
        idSale: id
    }
    ajaxPageData("sale.php", postData);
}
 
function deleteSale(productName, id) {
    const html = `
            <div class="message-confirm-box">
                <div class="message-confirm">
                    <div>Are you sure to permanently delete the promotional product ${productName}?</div>
                    <div>
                        <button class="cancel" type="button">Cancal</button>
                        <button id="delete-sale" class="delete" type="button">Delete</button>
                    </div>
                </div>
            </div>
        `;
    $("body").append(html);

    $(".cancel").click(function () {
        $(".message-confirm-box").remove();
    });

    $("#delete-sale").click(function () {
        $.post(
            "handles/deletes/sale.php", {
            id: id
        },
            function (res) {
                $(".message-confirm-box").remove();
                ajaxPages(res);
            }
        )
    });
}

function showCoupon() {
    $.ajax({
        url: "handles/search/filter_search_coupon.php",
        method: "POST",
        data: { 
            arrangeCoupon: $("#arrangeCoupon").val() 
        },
        success: function (res) {
            $(".table-coupon-box").empty().html(res);
        }
    });
}
function showSale() {
    $.ajax({
        url: "handles/search/filter_search_sale.php",
        method: "POST",
        data: { 
            arrangeSale: $("#arrangeSale").val() 
        },
        success: function (res) {
            $(".table-sale-box").empty().html(res);
        }
    });
}

$(document).ready(function () {
    showCoupon();

    $("#filter-search-coupon").on("input", function () {
        const search = $(this).val();
        if (search !== "") {
            $.ajax({
                url: "handles/search/filter_search_coupon.php",
                method: "POST",
                data: {
                    filter_search: search,
                    arrangeCoupon: $("#arrangeCoupon").val()
                },
                success: function (res) {
                    $(".table-coupon-box").empty().html(res);
                }
            });
        } else {
            showCoupon();
        }
    });

    $("#arrangeCoupon").on("change", function () {
        const arrangeCoupon = $(this).val();
        $.ajax({
            url: "handles/search/filter_search_coupon.php",
            method: "POST",
            data: {
                filter_search: $("#filter-search-coupon").val(),
                arrangeCoupon: arrangeCoupon
            },
            success: function (res) {
                $(".table-coupon-box").empty().html(res);
            }
        });
    });

    $(".menu-btn-box").hide();

    $(document).on("click", ".menu-btn", function (e) {
        e.stopPropagation();
        $(".menu-btn-box").hide();
        $(this).find(".menu-btn-box").toggle();

    })
    $(document).on("click", function (e) {
        if (!$(".menu-btn-box").is(e.target) && $(".menu-btn-box").has(e.target).length === 0) {
            $(".menu-btn-box").hide();
        }
    });
});

function coupon_previous(id) {
    $.ajax({
        url: "handles/search/filter_search_coupon.php",
        method: "POST",
        data: {
            page: id - 1,
            filter_search: $("#filter-search-coupon").val(),
            arrangeCoupon: $("#arrangeCoupon").val()
        },
        success: function (res) {
            $(".table-coupon-box").empty().html(res);
        }
    });
};
function coupon_next(id) {
    $.ajax({
        url: "handles/search/filter_search_coupon.php",
        method: "POST",
        data: {
            page: (id + 1),
            filter_search: $("#filter-search-coupon").val(),
            arrangeCoupon: $("#arrangeCoupon").val()
        },
        success: function (res) {
            $(".table-coupon-box").empty().html(res);
        }
    });
};

$(document).ready(function() {
    showSale();

    $("#filter-search-sale").on("input", function () {
        const search = $(this).val();
        if (search !== "") {
            $.ajax({
                url: "handles/search/filter_search_sale.php",
                method: "POST",
                data: {
                    filter_search: search,
                    arrangeCoupon: $("#arrangeSale").val()
                },
                success: function (res) {
                    $(".table-sale-box").empty().html(res);
                }
            });
        } else {
            showSale();
        }
    });

    $("#arrangeSale").on("change", function () {
        const arrangeSale = $(this).val();
        $.ajax({
            url: "handles/search/filter_search_sale.php",
            method: "POST",
            data: {
                filter_search: $("#filter-search-sale").val(),
                arrangeSale: arrangeSale
            },
            success: function (res) {
                $(".table-sale-box").empty().html(res);
            }
        });
    });
})

function sale_previous(id) {
    $.ajax({
        url: "handles/search/filter_search_sale.php",
        method: "POST",
        data: {
            page: id - 1,
            filter_search: $("#filter-search-sale").val(),
            arrangeSale: $("#arrangeSale").val()
        },
        success: function (res) {
            $(".table-sale-box").empty().html(res);
        }
    });
};
function sale_next(id) {
    $.ajax({
        url: "handles/search/filter_search_sale.php",
        method: "POST",
        data: {
            page: (id + 1),
            filter_search: $("#filter-search-sale").val(),
            arrangeSale: $("#arrangeSale").val()
        },
        success: function (res) {
            $(".table-sale-box").empty().html(res);
        }
    });
};