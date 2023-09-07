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
$(document).ready(function() {
    $(".menu-btn-box").hide();

    $(document).on("click", ".menu-btn", function (e) {
        e.stopPropagation();
        $(".menu-btn-box").hide();
        $(this).find(".menu-btn-box").toggle();

    })
    $(document).on("click", function (e) {
        if (!$(".menu-btn-box").is(e.target) && $(".menu-btn-box").has(e.target).length === 0) {
            $(".menu-btn-box").hide();
        }
    });
})

function hideFlavor(flavor_name, id) {
    const html = `
    <div class="message-confirm-box">
        <div class="message-confirm">
            <div>Are you sure you want to decommission flavor ${flavor_name}?</div>
            <div class="btn-message">
                <button class="cancel" type="button">Cancal</button>
                <button id="hide-flavor" class="create" type="button">Ok</button>
            </div>
        </div>
    </div>`;
    $("body").append(html);

    $(".cancel").click(function () {
        $(".message-confirm-box").remove();
    });

    $("#hide-flavor").click(function () {
        $.post(
            "handles/hides/flavor.php", {
            id: id
        },
            function (res) {
                $(".message-confirm-box").remove();
                ajaxPages(res);
            }
        )
    });
}
function recoverFlavor(flavor_name, id) {
    const html = `
    <div class="message-confirm-box">
        <div class="message-confirm">
            <div>Are you sure you want to show flavor ${flavor_name} to the user?</div>
            <div class="btn-message">
                <button class="cancel" type="button">Cancal</button>
                <button id="recover-flavor" class="create" type="button">Ok</button>
            </div>
        </div>
    </div>`;
    $("body").append(html);

    $(".cancel").click(function () {
        $(".message-confirm-box").remove();
    });

    $("#recover-flavor").click(function () {
        $.post(
            "handles/updates/recover_flavor.php", {
            id: id
        },
            function (res) {
                $(".message-confirm-box").remove();
                ajaxPages(res);
            }
        )
    });
}
function updateFlavor(flavor_name, qtyFlavor, id) {
    const html = `
        <div class="message-confirm-box">
            <div class="message-confirm">
                <div>Do you want to update the quantity of flavor ${flavor_name} in stock?</div>
                <div class="coupon-input">
                    <div class="box-input">
                        <input id="qtyFlavorUpdate" type="text" name="qtyFlavor" value="${qtyFlavor}">
                    </div>
                    <p class="errorQtyFlavorUpdate" style="color: red;"></p>
                </div>
                <div class="btn-message">
                    <button class="cancel" type="button">Cancal</button>
                    <button id="update-qti-flavor" class="updated" type="button">Update</button>
                </div>
            </div>
        </div>
    `;
    $("body").append(html);

    $(".cancel").click(function () {
        $(".message-confirm-box").remove();
    });

    $("#update-qti-flavor").click(function () {
        const qtyFlavor = $("#qtyFlavorUpdate").val();
        $.post(
            "handles/updates/update_qty_flavor.php", {
            id: id,
            qtyFlavor: qtyFlavor
        },
            function (res) {
                if (res === "success") {
                    $(".message-confirm-box").remove();
                    ajaxPages("products/gallery.php");
                } else {
                    $('.errorQtyFlavorUpdate').empty().append(res);
                }
            }
        )
    });
}
function editFlavor(id) {
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
                <div class="btn-message">
                    <button class="cancel" type="button">Cancal</button>
                    <button id="delete-flavor" class="deleted" type="button">Delete</button>
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
function editSize(id) {
    var postData = {
        idSize: id
    }
    ajaxPageData("products/gallery.php", postData);
}
function hideSize(sizeName, id) {
    const html = `
    <div class="message-confirm-box">
        <div class="message-confirm">
            <div>Are you sure you want to decommission size ${sizeName}?</div>
            <div class="btn-message">
                <button class="cancel" type="button">Cancal</button>
                <button id="hide-size" class="create" type="button">Ok</button>
            </div>
        </div>
    </div>`;
    $("body").append(html);

    $(".cancel").click(function () {
        $(".message-confirm-box").remove();
    });

    $("#hide-size").click(function () {
        $.post(
            "handles/hides/size.php", {
            id: id
        },
            function (res) {
                $(".message-confirm-box").remove();
                ajaxPages(res);
            }
        )
    });
}
function recoverSize(sizeName, id) {
    const html = `
    <div class="message-confirm-box">
        <div class="message-confirm">
            <div>Are you sure you want to show size ${sizeName} to the user?</div>
            <div class="btn-message">
                <button class="cancel" type="button">Cancal</button>
                <button id="recover-size" class="create" type="button">Ok</button>
            </div>
        </div>
    </div>`;
    $("body").append(html);

    $(".cancel").click(function () {
        $(".message-confirm-box").remove();
    });

    $("#recover-size").click(function () {
        $.post(
            "handles/updates/recover_size.php", {
            id: id
        },
            function (res) {
                $(".message-confirm-box").remove();
                ajaxPages(res);
            }
        )
    });
}
function updateSize(sizeName, qtiBoxSize, id) {
    const html = `
        <div class="message-confirm-box">
            <div class="message-confirm">
                <div>Do you want to update the number of size ${sizeName} boxes in stock?</div>
                <div class="coupon-input">
                    <div class="box-input">
                        <input id="qtySizeUpdate" type="text" name="qtiBoxSize" value="${qtiBoxSize}">
                    </div>
                    <p class="errorQtyBoxesSizeUpdate" style="color: red;"></p>
                </div>
                <div class="btn-message">
                    <button class="cancel" type="button">Cancal</button>
                    <button id="update-qti-size" class="updated" type="button">Update</button>
                </div>
            </div>
        </div>
    `;
    $("body").append(html);

    $(".cancel").click(function () {
        $(".message-confirm-box").remove();
    });

    $("#update-qti-size").click(function () {
        const qtiBoxSize = $("#qtySizeUpdate").val();
        $.post(
            "handles/updates/update_qty_boxes_size.php", {
            id: id,
            qtiBoxSize: qtiBoxSize
        },
            function (res) {
                if (res === "success") {
                    $(".message-confirm-box").remove();
                    ajaxPages("products/gallery.php");
                } else {
                    $('.errorQtyBoxesSizeUpdate').empty().append(res);
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
                <div class="btn-message">
                    <button class="cancel" type="button">Cancal</button>
                    <button id="delete-size" class="deleted" type="button">Delete</button>
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