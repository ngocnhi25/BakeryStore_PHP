function deleteCate(id) {
    $.post(
        "handles/deletes/new_category.php", {
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
    ajaxPageData("news/news_cate.php", postData);
}

function createCate() { 
    ajaxPages('news/news_cate.php')
}

