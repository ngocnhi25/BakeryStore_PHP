function editNew(id) {
    var postData = {
        id: id,
        title: 'Update News'
    }
    ajaxPageData("news/news_add.php", postData);
}

// function deleteNew(id) {
//     $.post(
//         "handles/deletes/news.php", {
//             id: id
//         },
//         function(data) {
//             ajaxPages(data);
//         }
//     )
// }

function deleteNew(newTitle, id) {
    const html = `
        <div class="message-confirm-box">
            <div class="message-confirm">
                <div>Are you sure to permanently remove the news ${newTitle}?</div>
                <div>
                    <button class="cancel" type="button">Cancal</button>
                    <button id="delete-new" class="delete" type="button">Delete</button>
                </div>
            </div>
        </div>
    `;
    $("body").append(html);

    $(".cancel").click(function () {
        $(".message-confirm-box").remove();
    });

    $("#delete-new").click(function () {
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


