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
        title: "Update category"
    }
    ajaxPageData("products/category_add.php", postData);
}

function createCate() { 
    ajaxPages('products/category_add.php')
}

// flavor event
function hideFlavor(id) {
    $.post(
        "handles/hides/flavor.php", {
        id: id
    },
        function (data) {
            ajaxPages(data);
        }
    )
}

function recoverFlavor(qtiFlavor, id) {
    const html = `
        <div class="message-confirm-box">
            <div class="message-confirm">
                <div>Update the number of flavors in stock</div>
                <div>
                    <input id="flavorInStockUpdate" type="text" name="flavorInStock" value="${qtiFlavor}">
                    <p class="errorFlavorInStockUpdate" style="color: red;"></p>
                </div>
                <div>
                    <button class="cancel" type="button">Cancal</button>
                    <button id="update-qti-flavor" class="update" type="button">Update</button>
                </div>
            </div>
        </div>
    `;
    $("body").append(html);

    $(".cancel").click(function () {
        $(".message-confirm-box").remove();
    });

    $("#update-qti-flavor").click(function () {
        const flavorInStock = $("#flavorInStockUpdate").val();
        $.post(
            "handles/updates/flavor_in_stock.php", {
            id: id,
            flavorInStock: flavorInStock
        },
            function (res) {
                if (res === "success") {
                    $(".message-confirm-box").remove();
                    ajaxPages("products/gallery.php");
                } else {
                    $('.errorFlavorInStockUpdate').empty().append(res);
                }
            }
        )
    });
}

function updateFlavor(id) {
    var postData = {
        idFlavor: id
    }
    ajaxPageData("products/gallery.php", postData);
}
function deleteFlavor(flavorName, id) {
    const html = `
        <div class="message-confirm-box">
            <div class="message-confirm">
                <div>Are you sure to permanently delete flavor ${flavorName}?</div>
                <div>
                    <button class="cancel" type="button">Cancal</button>
                    <button id="delete-flavor" class="delete" type="button">Delete</button>
                </div>
            </div>
        </div>
    `;
    $("body").append(html);

    $(".cancel").click(function () {
        $(".message-confirm-box").remove();
    });

    $("#delete-flavor").click(function () {
        $.post(
            "handles/deletes/flavor.php", {
            id: id
        },
            function (res) {
                $(".message-confirm-box").remove();
                ajaxPages(res);
            }
        )
    });
}

// size event
function updateSize(id) {
    var postData = {
        idSize: id
    }
    ajaxPageData("products/gallery.php", postData);
}

function hideSize(id) {
    $.post(
        "handles/hides/size.php", {
        id: id
    },
        function (data) {
            ajaxPages(data);
        }
    )
}

function recoverSize(qtiBoxSize, id) {
    const html = `
        <div class="message-confirm-box">
            <div class="message-confirm">
                <div>Update the number of boxes in stock</div>
                <div>
                    <input id="qtiBoxSizeUpdate" type="text" name="qtiBoxSize" value="${qtiBoxSize}">
                    <p class="errorqtiBoxSize" style="color: red;"></p>
                </div>
                <div>
                    <button class="cancel" type="button">Cancal</button>
                    <button id="update-qti-size" class="update" type="button">Update</button>
                </div>
            </div>
        </div>
    `;
    $("body").append(html);

    $(".cancel").click(function () {
        $(".message-confirm-box").remove();
    });

    $("#update-qti-size").click(function () {
        const qtiBoxSize = $("#qtiBoxSizeUpdate").val();
        $.post(
            "handles/updates/qty_boxes_size.php", {
            id: id,
            qtiBoxSize: qtiBoxSize
        },
            function (res) {
                if (res === "success") {
                    $(".message-confirm-box").remove();
                    ajaxPages("products/gallery.php");
                } else {
                    $('.errorqtiBoxSize').empty().append(res);
                }
            }
        )
    });
}

function deleteSize(sizeName, id) {
    const html = `
        <div class="message-confirm-box">
            <div class="message-confirm">
                <div>Are you sure to permanently delete size ${sizeName}?</div>
                <div>
                    <button class="cancel" type="button">Cancal</button>
                    <button id="delete-size" class="delete" type="button">Delete</button>
                </div>
            </div>
        </div>
    `;
    $("body").append(html);

    $(".cancel").click(function () {
        $(".message-confirm-box").remove();
    });

    $("#delete-size").click(function () {
        $.post(
            "handles/deletes/size.php", {
            id: id
        },
            function (res) {
                $(".message-confirm-box").remove();
                ajaxPages(res);
            }
        )
    });
}