function editNew(id) {
    var postData = {
        id: id,
        title: 'Update News'
    }
    ajaxPageData("news/news_add.php", postData);
}

// function deleteNew(id) {
//     $.post(
//         "handles/deletes/news.php", {
//             id: id
//         },
//         function(data) {
//             ajaxPages(data);
//         }
//     )
// }

function deleteNew(newTitle, id) {
    const html = `
        <div class="message-confirm-box">
            <div class="message-confirm">
                <div>Are you sure to permanently remove the news ${newTitle}?</div>
                <div>
                    <button class="cancel" type="button">Cancal</button>
                    <button id="delete-new" class="delete" type="button">Delete</button>
                </div>
            </div>
        </div>
    `;
    $("body").append(html);

    $(".cancel").click(function () {
        $(".message-confirm-box").remove();
    });

    $("#delete-new").click(function () {
        $.post(
            "handles/deletes/news.php", {
            id: id
        },
            function (res) { 
                // alert(res)               
                $(".message-confirm-box").remove();
                ajaxPages(res);
            }
        )
    });
}
function showNews() {
    $.ajax({
        url: "handles/search/filter_search_news.php",
        method: "POST",
        data: { 
            arrangeProduct: $("#arrangeProduct").val() 
        },
        success: function (res) {
            $("#container_table_product").empty().html(res);
        }
    });
}

$(document).ready(function () {
    showNews();

    $("#filter-search-product").on("input", function () {
        const search = $(this).val();
        if (search !== "") {
            $.ajax({
                url: "handles/search/filter_search_news.php",
                method: "POST",
                data: {
                    filter_search: search,
                    arrangeProduct: $("#arrangeProduct").val()
                },
                success: function (res) {
                    $("#container_table_product").empty().html(res);
                }
            });
        } else {
            $("#search-result-product").hide().empty();
        }
    });

    $("#cateSearch").on("change", function () {
        const cateID = $(this).val();
        $("#filter-search-product").val("");
        $.ajax({
            url: "handles/search/filter_search_news.php",
            method: "POST",
            data: {
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
        $("#filter-search-product").val("");
        $.ajax({
            url: "handles/search/filter_search_news.php",
            method: "POST",
            data: {
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
        $("#filter-search-product").val("");
        $.ajax({
            url: "handles/search/filter_search_news.php",
            method: "POST",
            data: {
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
        $("#filter-search-product").val("");
        $.ajax({
            url: "handles/search/filter_search_news.php",
            method: "POST",
            data: {
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
    const search = $("#filter-search-product").val();
    $.ajax({
        url: "handles/search/filter_search_news.php",
        method: "POST",
        data: {
            page: id - 1,
            filter_search: search,
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
    const search = $("#filter-search-product").val();
    $.ajax({
        url: "handles/search/filter_search_news.php",
        method: "POST",
        data: {
            page: (id + 1),
            filter_search: search,
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

