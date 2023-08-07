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
        idCate: id
    }
    ajaxPageData("products/galery.php", postData);
}

function createCate() {
    ajaxPages('products/category_add.php')
}

function deleteFlavor(id) {
    $.post(
        "handles/deletes/flavor.php", {
            id: id
        },
        function(data) {
            ajaxPages(data);
        }
    )
}

function deleteSize(id) {
    $.post(
        "handles/deletes/size.php", {
            id: id
        },
        function(data) {
            ajaxPages(data);
        }
    )
}
function recoverFlavor(id) {
    $.post(
        "handles/updates/flavor.php", {
            id: id
        },
        function(data) {
            ajaxPages(data);
        }
    )
}

function updateFlavor(id) {
    var postData = {
        idFlavor: id
    }
    ajaxPageData("products/galery.php", postData);
}

function updateSize(id) {
    var postData = {
        idSize: id
    }
    ajaxPageData("products/galery.php", postData);
}
