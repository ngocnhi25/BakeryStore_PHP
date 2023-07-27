function ajaxPages(url) {
    if (url != null) {
        $.ajax({
            url: url,
            method: "POST",
            dataType: "html",
            success: function(response) {
                $("#main-page").html(response);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }
}
function ajaxPageData(url, postData){
    $.ajax({
        type: "POST",
        url: url,
        data: postData,
        success: function(response) {
            $("#main-page").html(response);
        },
        error: function(xhr, status, error) {
            console.error("Lỗi: " + error);
        }
    });
}

$(document).ready(function() {

    $('.sidebar .nav-item .sub-btn').on('click', function() {
        $(this).next('.sub-menu').slideToggle();
        $(this).children('.more').toggle();
        $(this).children('.less').toggle();
    });

    $(".sidebar ul .nav-item").click(function(e) {
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
        $(".menu-item").on('click', function(e) {
            e.stopImmediatePropagation();
            const linkItem = $(this).children('a').attr("href");
            $(".menu-item").siblings().removeClass("active");
            $(this).addClass("active");
            ajaxPages(linkItem);
            return false;
        });

        return false;
    });

});