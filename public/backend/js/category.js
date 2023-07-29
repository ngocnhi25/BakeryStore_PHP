$("#success").hide();
$("#submitAdd").click(function(e) {
    e.preventDefault();
    $(document).ready(function() {

        var formData = new FormData($("#cateForm")[0]);

        $.ajax({
            type: "POST",
            url: 'handles/creates/category.php',
            data: formData,
            contentType: false,
            processData: false,
            success: function(res) {
                if (res == 'success') {
                    showSuccessMessage("products/category.php");
                } else {
                    var errors = JSON.parse(res);
                    for (var key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            var value = errors[key];
                            $('.' + key).empty().append(value);
                        }
                    }
                }
            }
        })
    })
})

function deleteCate(id) {
    $.post(
        "handles/deletes/category.php", {
        id: id
    },
        function (data) {
            ajaxPages(data);
        }
    )
}

function updateCate(id) {
    var postData = {
        id: id,
        title: 'Update category'
    }
    ajaxPageData("products/category_add.php", postData);

}

function createCategory() {
    ajaxPages('products/category_add.php')
}

function deleteProductFlavor(id, cateID) {
    $.post(
        "handles/deletes/flavor_product.php", {
            id: id,
            cateID: cateID
        },
        function(data) {
            ajaxPageData("products/category_add.php", { id: data, title: "Update category" });
        }
    )
}

function deleteProductSize(id, cateID){
    $.post(
        "handles/deletes/size_product.php", {
            id: id,
            cateID: cateID
        },
        function(data) {
            ajaxPageData("products/category_add.php", { id: data, title: "Update category" });
        }
    )
}
