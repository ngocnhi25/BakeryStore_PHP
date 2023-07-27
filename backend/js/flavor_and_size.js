$("#success").hide();
function showSuccessMessage(page) {
    $("#success").show();

    $("#okButton").on("click", function() {
        $("#success").hide();
        ajaxPages(page);
    });
}

function deleteFlavor(id) {
    alert(id);
    // $.post(
    //     "handles/deletes/flavor.php", {
    //         id: id
    //     },
    //     function(data) {
    //         ajaxPages(data);
    //     }
    // )
}

function deleteSize(id) {
    alert(id);
    // $.post(
    //     "handles/deletes/size.php", {
    //         id: id
    //     },
    //     function(data) {
    //         ajaxPages(data);
    //     }
    // )
}

function updateFlavor(id) {
    var postData = {
        idFlavor: id
    }
    ajaxPageData("products/flavor_and_size.php", postData);
}

function updateSize(id) {
    var postData = {
        idSize: id
    }
    ajaxPageData("products/flavor_and_size.php", postData);
}