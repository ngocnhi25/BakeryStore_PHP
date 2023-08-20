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

function deleteNew(new_title, id) {
    const html = `
        <div class="message-confirm-box">
            <div class="message-confirm">
                <div>Are you sure to permanently remove the news ${new_title}?</div>
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
            "handles/deletes/news.php", {
            id: id
        },
            function (res) {
                $(".message-confirm-box").remove();
                ajaxPages(res);
            }
        )
    });
}


