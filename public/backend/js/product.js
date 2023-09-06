var sliderOne = $("#slider-1");
var sliderTwo = $("#slider-2");
var displayValOne = $("#range1");
var displayValTwo = $("#range2");
var minGap = 100;
var sliderTrack = $(".slider-track");
var sliderMaxValue = $("#slider-1").attr("max");


function editProduct(id) {
    var postData = {
        id: id,
        title: 'Update Product'
    }
    ajaxPageData("products/product_add.php", postData);
}

function deleteProduct(product_name, id) {
    const html = `
    <div class="message-confirm-box">
        <div class="message-confirm">
            <div>Are you sure to permanently delete product ${product_name}?</div>
            <div class="btn-message">
                <button class="cancel" type="button">Cancal</button>
                <button id="delete-product" class="delete" type="button">Delete</button>
            </div>
        </div>
    </div>`;
    $("body").append(html);

    $(".cancel").click(function () {
        $(".message-confirm-box").remove();
    });

    $("#delete-product").click(function () {
        $.post(
            "handles/deletes/product.php", {
            id: id
        },
            function (res) {
                if (res === "doNotDelete") {
                    const htmls = `
                        <div class="message-confirm-box">
                            <div class="message-confirm">
                                <div>The product is in the user's shopping cart or the product has been ordered! Do not delete ! Do you want to decommission product ${product_name}?</div>
                                <div>
                                    <button class="cancel" type="button">Cancal</button>
                                    <button id="hide-product" class="create" type="button">Ok</button>
                                </div>
                            </div>
                        </div>`;
                    $("body").append(htmls);

                    $(".cancel").click(function () {
                        $(".message-confirm-box").remove();
                    });
                    $("#hide-product").click(function () {
                        $.post(
                            "handles/hides/product.php", {
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
                    ajaxPages("products/products.php");
                }
            }
        )
    });
}

function hideProduct(product_name, id) {
    const html = `
    <div class="message-confirm-box">
        <div class="message-confirm">
            <div>Are you sure you want to decommission product ${product_name}?</div>
            <div class="btn-message">
                <button class="cancel" type="button">Cancal</button>
                <button id="hide-product" class="create" type="button">Ok</button>
            </div>
        </div>
    </div>`;
    $("body").append(html);

    $(".cancel").click(function () {
        $(".message-confirm-box").remove();
    });

    $("#hide-product").click(function () {
        $.post(
            "handles/hides/product.php", {
            id: id
        },
            function (res) {
                $(".message-confirm-box").remove();
                ajaxPages(res);
            }
        )
    });
}
function recoverProduct(product_name, id) {
    const html = `
    <div class="message-confirm-box">
        <div class="message-confirm">
            <div>Are you sure you want to show product ${product_name} to the user?</div>
            <div class="btn-message">
                <button class="cancel" type="button">Cancal</button>
                <button id="recover-product" class="create" type="button">Ok</button>
            </div>
        </div>
    </div>`;
    $("body").append(html);

    $(".cancel").click(function () {
        $(".message-confirm-box").remove();
    });

    $("#recover-product").click(function () {
        $.post(
            "handles/updates/recover_product.php", {
            id: id
        },
            function (res) {
                $(".message-confirm-box").remove();
                ajaxPages(res);
            }
        )
    });
}

function updateProduct(product_name, qtyProduct, id) {
    const html = `
        <div class="message-confirm-box">
            <div class="message-confirm">
                <div>Do you want to update the quantity of product ${product_name} in stock?</div>
                <div class="coupon-input">
                    <div class="box-input">
                        <input id="qtyProductUpdate" type="text" name="qtyProduct" value="${qtyProduct}">
                    </div>
                    <p class="errorQtyProductUpdate" style="color: red;"></p>
                </div>
                <div class="btn-message">
                    <button class="cancel" type="button">Cancal</button>
                    <button id="update-qti-product" class="updated" type="button">Update</button>
                </div>
            </div>
        </div>
    `;
    $("body").append(html);

    $(".cancel").click(function () {
        $(".message-confirm-box").remove();
    });

    $("#update-qti-product").click(function () {
        const qtyProduct = $("#qtyProductUpdate").val();
        $.post(
            "handles/updates/update_qty_product.php", {
            id: id,
            qtyProduct: qtyProduct
        },
            function (res) {
                if (res === "success") {
                    $(".message-confirm-box").remove();
                    ajaxPages("products/products.php");
                } else {
                    $('.errorQtyProductUpdate').empty().append(res);
                }
            }
        )
    });
}

function showProducts() {
    $.ajax({
        url: "handles/search/filter_search_product.php",
        method: "POST",
        data: {
            filter_cate: $("#cateSearch").val(),
            arrangeProduct: $("#arrangeProduct").val()
        },
        success: function (res) {
            $("#container_table_product").empty().html(res);
        }
    });
}

$(document).ready(function () {
    showProducts();
    slideOne();
    slideTwo();

    $("#filter-search-product").on("input", function () {
        const search = $(this).val();
        if (search !== "") {
            $.ajax({
                url: "handles/search/filter_search_product.php",
                method: "POST",
                data: {
                    filter_price: {
                        from: sliderOne.val(),
                        to: sliderTwo.val()
                    },
                    filter_search: search,
                    arrangeProduct: $("#arrangeProduct").val()
                },
                success: function (res) {
                    $("#container_table_product").empty().html(res);
                }
            });
        } else {
            showProducts();
        }
    });

    $("#cateSearch").on("change", function () {
        const cateID = $(this).val();
        $.ajax({
            url: "handles/search/filter_search_product.php",
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
            url: "handles/search/filter_search_product.php",
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
            url: "handles/search/filter_search_product.php",
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
            url: "handles/search/filter_search_product.php",
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

function formatVND(amount) {
    return amount.toLocaleString("vi-VN") + " VNĐ";
}


function slideOne() {
    if (parseInt(sliderTwo.val()) - parseInt(sliderOne.val()) <= minGap) {
        sliderOne.val(parseInt(sliderTwo.val()) - minGap);
    }
    displayValOne.text(sliderOne.val() + 'k');
    fillColor();
    return sliderOne.val();
}

function slideTwo() {
    if (parseInt(sliderTwo.val()) - parseInt(sliderOne.val()) <= minGap) {
        sliderTwo.val(parseInt(sliderOne.val()) + minGap);
    }
    displayValTwo.text(sliderTwo.val() + 'k');
    fillColor();
    return sliderTwo.val();
}

function fillColor() {
    const percent1 = (sliderOne.val() / sliderMaxValue) * 100;
    const percent2 = (sliderTwo.val() / sliderMaxValue) * 100;
    sliderTrack.css("background", `linear-gradient(to right, #dadae5 ${percent1}% , #3264fe ${percent1}% , #3264fe ${percent2}%, #dadae5 ${percent2}%)`);
}

function product_previous(id) {
    $.ajax({
        url: "handles/search/filter_search_product.php",
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

function product_next(id) {
    $.ajax({
        url: "handles/search/filter_search_product.php",
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