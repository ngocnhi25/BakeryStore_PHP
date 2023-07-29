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
        function(data) {
            ajaxPages(data);
        }
    )
}

function formatVND(amount) {
  return amount.toLocaleString("vi-VN") + " VNĐ";
}

$(document).ready(function() {
    $('#input-images').on("change", function() {
        previewFiles(this, "#preview-images");
        $(".errorImages").empty().append('');
    });

    $('#input-name').on("keyup", function() {
        $(".errorName").empty().append('');
    });

    $('#input-price').on("keyup", function() {
        $(".errorPrice").empty().append('');
    });

    $('#input-cateID').on("change", function() {
        $(".errorCateID").empty().append('');
    });
    $('#description').on("change", function() {
        $(".errorDescription").empty().append('');
    });
});
