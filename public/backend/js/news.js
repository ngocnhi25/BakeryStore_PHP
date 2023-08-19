function editNew(id) {
    var postData = {
        id: id,
        title: 'Update News'
    }
    ajaxPageData("news/news_add.php", postData);
}

function deleteNew(id) {
    $.post(
        "handles/deletes/news.php", {
            id: id
        },
        function(data) {
            ajaxPages(data);
        }
    )
}


