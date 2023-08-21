<div class="wh-voucher">
    <div class="wh-top">
        <div class="wh-title">
            Warehouse Voucher
        </div>
        <div class="wh-history-used">
            view voucher history
        </div>
    </div>
    <div class="wh-user-add-vch">
        <div class="wh-vch-code">
            Voucher Code
        </div>
        <div class="input-code-vch">
            <input class="text-code-vch" type="text">
        </div>
        <div class="save-vch">
            <button class="save-vch-btn">Save</button>
        </div>
    </div>
    <div class="wh-tab-ui">
        <div class="wh-tabs">
            <div class="wh-tab-item active" data-tab="all">All</div>
            <div class="wh-tab-item" data-tab="popular">Popular</div>
            <div class="wh-tab-item" data-tab="about-to-exprire">About to expire</div>
        </div>
    </div>
    <div class="wh-content-box">
        <div class="wh-content active" data-content="all">
            <div class="wh-item-box"></div>
        </div>
        <div class="wh-content" data-content="popular">
            <div class="wh-item-box"></div>
        </div>
        <div class="wh-content" data-content="about-to-exprire">
            <div class="wh-item-box"></div>
        </div>
    </div>
</div>
<script>
    showVoucher('all', '.wh-content[data-content="all"] .wh-item-box')

    function showVoucher(selectedTab, selected) {
        $.ajax({
            type: "POST",
            url: 'handles_page/show_voucher.php',
            data: {
                selectedTab: selectedTab
            },
            success: function(res) {
                $(selected).empty().html(res);
                $(".wh-btn-buy-now").click(function() {
                    window.location.href = "product.php";
                })
            },
            error: function(xhr, status, error) {
                console.error("Lỗi: " + error);
            }
        });
    };
    $(document).ready(function() {
        $(".wh-voucher .wh-history-used").click(function() {
            ajaxPages("history_used_voucher.php");
        })

        $(".wh-tab-ui .wh-tabs .wh-tab-item").click(function(e) {
            e.preventDefault();
            $(this).siblings().removeClass("active");
            $(this).addClass("active");
            var selectedTab = $(this).data('tab');
            $('.wh-content').removeClass('active');
            $('.wh-content[data-content="' + selectedTab + '"]').addClass('active');
            const selected = $('.wh-content[data-content="' + selectedTab + '"] .wh-item-box');
            
            showVoucher(selectedTab, selected);

        });
        // $(".save-vch-btn").click(function() {
        //     const codeVouvher = $(".text-code-vch").val();
        //     $.ajax({
        //         url: 'handles_page/action.php',
        //         method: 'GET',
        //         data: {
        //             codeVouvher: codeVouvher
        //         },
        //         success: function(response) {

        //         }
        //     });
        // })
    })
</script>