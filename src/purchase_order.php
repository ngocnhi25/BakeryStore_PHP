<div class="purchase-order">
    <div class="po-tab-ui">
        <div class="tabs">
            <div class="tab-item active" data-tab="all">All</div>
            <div class="tab-item" data-tab="pending">Pending</div>
            <div class="tab-item" data-tab="transport">Ready for Pickup/Delivery</div>
            <div class="tab-item" data-tab="delivering">Delivered</div>
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
                <div class="item-product-box">
                    <div class="detail-order">
                        <div class="inf-prd">
                            <div>
                                <img src="../public/images/products/z4345108010003_ba6d4066e3d620bce1a65f97a5a55657.jpg" alt="">
                            </div>
                            <div class="inf-text">
                                <div class="prd-name">Bánh sinh nhật bé gái công chúa</div>
                                <div class="galary"><span>Size: 12cm</span> <span>Flavor: Việt quất</span></div>
                                <div>x1</div>
                            </div>
                        </div>
                        <div class="prd-price">
                            <span class="price-del">350000 vnđ</span> <span class="price-hight-light">300000 vnđ</span>
                        </div>
                    </div>
                    <div>
                        <div>
                            <span>Hoàn Thành</span>
                        </div>
                        <div>
                            Total Pay: <span>300000</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content" data-content="pending">
                Pending
            </div>
            <div class="content" data-content="transport">
                Ready for Pickup/Delivery
            </div>
            <div class="content" data-content="delivering">
                Delivered
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