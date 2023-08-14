function previewPhoto(inputElement, previewElement) {
    $(previewElement).empty();
    if (inputElement.files) {
        $.each(inputElement.files, function (i, file) {
            var reader = new FileReader();
            $(reader).on("load", function () {
                $(previewElement).append($("<img/>", {
                    src: this.result
                }));
            });
            reader.readAsDataURL(file);
        });
    }
}
function ajaxPages(url) {
    if (url != null) {
        $.ajax({
            url: url,
            method: "POST",
            dataType: "html",
            success: function (response) {
                $("#action-page-user").empty().html(response);
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    }
}
$(document).ready(function () {
    $(".sidebar-user .sidebar ul .nav-item").click(function (e) {
        e.preventDefault();
        const link = $(this).children('.nav-link').attr("href");
        
        $(this).siblings().removeClass("active");
        $(this).addClass("active");
        ajaxPages(link);
        
        return false;
    });
})

$(document).ready(function () {
    $('#photo-profile').on("change", function () {
        previewPhoto(this, "#preview-photo");
        $(".errorImages").empty().append('');
    });
});
