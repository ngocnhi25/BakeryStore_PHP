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

function deleteProduct(id) {
    $.post(
        "handles/deletes/product.php", {
        id: id
    },
        function (data) {
            ajaxPages(data);
        }
    )
}

function hideProduct(id) {
    $.post(
        "handles/hides/product.php", {
        id: id
    },
        function (data) {
            ajaxPages(data);
        }
    )
}
function recoverProduct(qtiProduct, id) {
    const html = `
        <div class="message-confirm-box">
            <div class="message-confirm">
                <div>Update product quantity in stock</div>
                <div class="coupon-input">
                    <div class="box-input">
                        <input id="qtyProductUpdate" type="text" name="qtyProduct" value="${qtiProduct}">
                    </div>
                    <p class="errorQtyProductUpdate" style="color: red;"></p>
                </div>
                <div>
                    <button class="cancel" type="button">Cancal</button>
                    <button id="update-qti-product" class="update" type="button">Update</button>
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
            "handles/updates/recover_product.php", {
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

function deleteProduct(productName, id) {
    const html = `
        <div class="message-confirm-box">
            <div class="message-confirm">
                <div>Are you sure to permanently remove the product ${productName}?</div>
                <div>
                    <button class="cancel" type="button">Cancal</button>
                    <button id="delete-product" class="delete" type="button">Delete</button>
                </div>
            </div>
        </div>
    `;
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
                $(".message-confirm-box").remove();
                ajaxPages(res);
            }
        )
    });
}

$(document).ready(function () {
    $("#filter-search-product").on("input", function () {
        var search = $(this).val();
        if (search !== "") {
            $.ajax({
                url: "handles/search/filter_search_product.php",
                method: "POST",
                data: {
                    filter_search: search
                },
                success: function (response) {
                    $("#search-result-product").empty().html(response);
                }
            });
        } else {
            $("#search-result-product").hide().empty();
        }
    });

    $("#cateSearch").on("change", function () {
        const cateID = $(this).val();
        alert(cateID);
    });

    sliderOne.on("input", function () {
        slideOne();
    });
    sliderTwo.on("input", function () {
        slideTwo();
    });

    const c = $('.pagination');
    const indexs = $('.index');
    let cur = -1;

    indexs.each(function (i) {
        $(this).on('click', function (e) {
            // clear
            c.removeClass().addClass('pagination');
            c[0].offsetWidth; // Reflow
            c.addClass('open').addClass(`i${i + 1}`);
            if (cur > i) {
                c.addClass('flip');
            }
            cur = i;
        });
    });

    slideOne();
    slideTwo();
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
}

function slideTwo() {
    if (parseInt(sliderTwo.val()) - parseInt(sliderOne.val()) <= minGap) {
        sliderTwo.val(parseInt(sliderOne.val()) + minGap);
    }
    displayValTwo.text(sliderTwo.val() + 'k');
    fillColor();
}

function fillColor() {
    const percent1 = (sliderOne.val() / sliderMaxValue) * 100;
    const percent2 = (sliderTwo.val() / sliderMaxValue) * 100;
    sliderTrack.css("background", `linear-gradient(to right, #dadae5 ${percent1}% , #3264fe ${percent1}% , #3264fe ${percent2}%, #dadae5 ${percent2}%)`);
}

function product_previous(id) {
    alert(id);
};
function next_previous(id) {
    alert(id);
};