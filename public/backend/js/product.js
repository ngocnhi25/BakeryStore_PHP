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
function recoverProduct(id) {
    $.post(
        "handles/updates/recover_product.php", {
        id: id
    },
        function (data) {
            ajaxPages(data);
        }
    )
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
    $("#cateSearch").on("change", function () {
        const cateID = $(this).val();
        alert(cateID);
    });
    $("#filterPrice").jRange({
        from: 0,
        to: 10000000,
        step: 50000,
        format: '$%s USD',
        width: 300,
        showLabels: true,
        isRange: true,
    });
    $("#filterPrice").on("change", function () {
        alert($(this).val());
    })
});

function formatVND(amount) {
    return amount.toLocaleString("vi-VN") + " VNĐ";
}

