function showSuccessMessage(page) {
    $("#success").show();

    $("#okButton").on("click", function () {
        $("#success").hide();
        ajaxPages(page);
    });
}
function previewFiles(inputElement, previewElement, witdth) {
    $(previewElement).empty();
    if (inputElement.files) {
        $.each(inputElement.files, function (i, file) {
            var reader = new FileReader();
            $(reader).on("load", function () {
                $(previewElement).append($("<img/>", {
                    src: this.result,
                    width: witdth
                }));
            });
            reader.readAsDataURL(file);
        });
    }
}
function delete_oldThumbnail(text_id) {
    var oldThumbnail = document.getElementById(text_id);
    oldThumbnail.remove();
}
function ajaxPages(url) {
    if (url != null) {
        $.ajax({
            url: url,
            type: "POST",
            dataType: "html",
            data: { ajaxSidebar: "ok" },
            success: function (response) {
                $("#main-page").empty().html(response);
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    }
}
function ajaxPageData(url, postData) {
    $.ajax({
        type: "POST",
        url: url,
        data: postData,
        success: function (response) {
            $("#main-page").html(response);
        },
        error: function (xhr, status, error) {
            console.error("Lỗi: " + error);
        }
    });
}
function pageClickHistory(page) {
    const search = $("#filter-search-history").val();
    const arrangeHistory = $("#arrangeHistory").val();

    $.ajax({
        url: "handles/search/filter_search_history.php",
        method: "POST",
        data: {
            filter_search: search,
            arrangeHistory: arrangeHistory,
            page: page
        },
        success: function (res) {
            $(".history-table-show").empty().html(res);
        }
    });
}

$(document).ready(function () {
    $("#filter-search-history").on("input", function () {
        const search = $(this).val();
        if (search !== "") {
            $.ajax({
                url: "handles/search/filter_search_history.php",
                method: "POST",
                data: {
                    filter_search: search,
                    arrangeHistory: $("#arrangeHistory").val()
                },
                success: function (res) {
                    $(".history-table-show").empty().html(res);
                }
            });
        } else {
            showProducts();
        }
    });

    $(document).on("click", ".history-top", function () {
        $(".history-container").toggleClass("active");
        $.ajax({
            url: "handles/search/filter_search_history.php",
            method: "POST",
            data: {
                filter_search: $("#filter-search-history").val(),
                arrangeHistory: $("#arrangeHistory").val()
            },
            success: function (res) {
                $(".history-table-show").html(res);
            }
        });
    })

    $(document).on("change", "#arrangeHistory", function () {
        const arrangeHistory = $(this).val();
        $.ajax({
            url: "handles/search/filter_search_history.php",
            method: "POST",
            data: {
                filter_search: $("#filter-search-history").val(),
                arrangeHistory: arrangeHistory
            },
            success: function (res) {
                $(".history-table-show").empty().html(res);
            }
        });
    })
    $(document).on("click", ".close-history", function () {
        $(".history-container").toggleClass("active");
        $(".history-table-show").empty();
    })
    $(document).on("click", ".show-all-history-box", function () {
        $(".history-container").toggleClass("active");
        $.ajax({
            url: "handles/search/filter_search_history.php",
            method: "POST",
            data: {
                filter_search: $("#filter-search-history").val(),
                arrangeHistory: $("#arrangeHistory").val()
            },
            success: function (res) {
                $(".history-table-show").html(res);
            }
        });
    })

    $('.sidebar .nav-item .sub-btn').on('click', function () {
        $(this).next('.sub-menu').slideToggle();
        $(this).children('.more').toggle();
        $(this).children('.less').toggle();
    });

    $(".sidebar ul .nav-item").click(function (e) {
        e.preventDefault();
        const link = $(this).children('.nav-link').attr("href");

        $(this).siblings().removeClass("active");
        $(this).addClass("active");
        const hasSubBtn = $(this).children("div").hasClass("sub-btn");
        const hasMenuItem = $('.sidebar .menu-item').hasClass("active");
        if (!hasSubBtn && hasMenuItem) {
            $('.sidebar .menu-item').removeClass("active");
        }
        ajaxPages(link);
        // click menu-item
        $(".menu-item").on('click', function (e) {
            e.stopImmediatePropagation();
            const linkItem = $(this).children('a').attr("href");
            $(".menu-item").siblings().removeClass("active");
            $(".sidebar ul .nav-item").removeClass("active");
            $(this).addClass("active");
            $(this).parents('.nav-item').addClass('active');
            ajaxPages(linkItem);
            return false;
        });

        return false;
    });

});