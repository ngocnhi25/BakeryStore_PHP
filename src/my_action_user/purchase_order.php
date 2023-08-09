<div class="purchase-order">
    <div class="po-tab-ui">
        <div class="tabs">
            <div class="tab-item active" data-tab="all">All</div>
            <div class="tab-item" data-tab="wait-for-pay">Wait for pay</div>
            <div class="tab-item" data-tab="transport">Transport</div>
            <div class="tab-item" data-tab="delivering">Delivering</div>
            <div class="tab-item" data-tab="complete">Complete</div>
            <div class="tab-item" data-tab="cancelled">Cancelled</div>
            <div class="tab-item" data-tab="return-refund">Return/Refund</div>
        </div>
        <div class="po-search">
            <span class="material-symbols-sharp">search</span>
            <input type="text" placeholder="You can search by product name or product category">
        </div>
        <div class="po-content-box">
            <div class="content active" data-content="all">
                <div>
                    
                </div>
            </div>
            <div class="content" data-content="wait-for-pay">
                Wait for pay
            </div>
            <div class="content" data-content="transport">
                Transport
            </div>
            <div class="content" data-content="delivering">
                Delivering
            </div>
            <div class="content" data-content="complete">
                Complete
            </div>
            <div class="content" data-content="cancelled">
                Cancelled
            </div>
            <div class="content" data-content="return-refund">
                Return/Refund
            </div>
        </div>
    </div>
    <script>
        $(".po-tab-ui .tabs .tab-item").click(function(e) {
            e.preventDefault();
            $(this).siblings().removeClass("active");
            $(this).addClass("active");
            var selectedTab = $(this).data('tab');
            $('.content').removeClass('active');
            $('.content[data-content="' + selectedTab + '"]').addClass('active');
        })
    </script>