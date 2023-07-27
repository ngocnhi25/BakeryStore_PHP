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
