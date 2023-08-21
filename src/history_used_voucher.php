<div class="wh-voucher">
    <div class="wh-top-hitory">
        <div class="wh-title-hidtory">
            Voucher History
        </div>
    </div>
    <div class="wh-history-tab-ui">
        <div class="wh-history-tabs">
            <div class="wh-history-tab-item" data-tab="expired">Expired</div>
            <div class="wh-history-tab-item active" data-tab="used">Used</div>
        </div>
    </div>
    <div class="wh-history-content-box">
        <div class="wh-history-content" data-content="expired">
            <div class="wh-item-box"></div>
        </div>
        <div class="wh-history-content active" data-content="used">
            <div class="wh-item-box"></div>
        </div>
    </div>
</div>
<script>
    showVoucher('used', '.wh-history-content[data-content="used"] .wh-item-box')

    function showVoucher(selectedTab, selected) {
        $.ajax({
            type: "POST",
            url: 'handles_page/show_voucher.php',
            data: {
                selectedTab: selectedTab
            },
            success: function(res) {
                $(selected).empty().html(res);
            },
            error: function(xhr, status, error) {
                console.error("Lỗi: " + error);
            }
        });
    };

    $(document).ready(function() {
        $(".wh-history-tab-ui .wh-history-tabs .wh-history-tab-item").click(function() {
            $(this).siblings().removeClass("active");
            $(this).addClass("active");
            var selectedTab = $(this).data('tab');
            $('.wh-history-content').removeClass('active');
            $('.wh-history-content[data-content="' + selectedTab + '"]').addClass('active');
            const selected = $('.wh-history-content[data-content="' + selectedTab + '"] .wh-item-box');
            showVoucher(selectedTab, selected)
        });
    })
</script>