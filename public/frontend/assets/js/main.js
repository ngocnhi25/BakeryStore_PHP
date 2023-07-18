$(document).ready(function() {
    // WOW JS
    // new WOW().init();
    // End WOW JS

    // SCROLL TO SECTION WHEN PAGE LOAD WITH HASH
    if (window.location.hash) {
        let hash = window.location.hash;
        hash = hash.replace('#', '');
        if (hash != "/" && $('[data-hash=' + hash + ']')[0]) {
            $('html, body').animate({
                scrollTop: $('[data-hash=' + hash + ']').offset().top
            }, 300);
        }
    }

    // Active user sidebar item
    if ($('.user-page .sidebar-container ul li').length > 0) {
        var sidebarItems = $('.user-page .sidebar-container ul li');
        $(sidebarItems).each(function(index, item) {
            var href = $(item).find('a').attr('href');
            // alert(href);
            if (href == window.location.href) {
                $(item).addClass('active');
            }
        });
    }

    // Toggle message from server
    // $('.msg-container .close-msg').click(function(event) {
    //     $('.msg-top').toggleClass('show');
    // });

    // Toggle User Nav
    $('.js-toggle-user-nav').click(function() {
        $('.user-nav-header').fadeToggle();
    });

    // TOGGLE CART SIDEBAR
    $('.js-toggle-cart-sidebar').click(function() {
        $('.cart-sidebar-container').toggleClass('active');
        toggleOverlayHidden();
    });
    // END TOGGLE CART SIDEBAR

    // TOGGLE MOBILE MENU
    $('.js-toggle-mobile-menu').click(function() {
        $('.mobile-menu-container').toggleClass('active');
        toggleOverlayHidden();
    });
    // END TOGGLE MOBILE MENU

    // TOGGLE SUBMENU
    $('.mobile-menu-list .js-dropdown-button').click(function(event) {
        event.preventDefault();
        $(this).toggleClass('active');
        $(this).parents('li').find('ul.submenu:first').slideToggle();
    });
    // END TOGGLE SUBMENU

    // SCROLL TO TOP
    // $('.gototop').click(function(event) {
    //     event.preventDefault();
    //     $('body, html').animate({
    //         scrollTop: 0
    //     }, 1000);
    // });
    // END SCROLL TO TOP

    // RESIZE WINDOW DETECT MOBILE <==> DESKTOP
    $(window).resize(function() {
        makeWebsiteResponsive();
    });
    // END RESIZE WINDOW DETECT MOBILE <==> DESKTOP


});

function makeWebsiteResponsive() {
    docWidth = $(document).width();
    if (docWidth <= 991) {
        turnProductGalleryToCarousel('on');
    } else {
        turnProductGalleryToCarousel('off');
    }
}

function turnProductGalleryToCarousel(status) {
    if ($('.product-page .product-gallery .product-image-wrapper')[0]) {
        var gallery = $('.product-page .product-gallery .product-image-wrapper');


        if (status == "on") {
            gallery.addClass('owl-carousel product-image-carousel');
            gallery.parents('.product-gallery').addClass('active-carousel');
            $(gallery).owlCarousel({
                items: 1,
                loop: true,
                autoplay: true,
                autoplaySpeed: 1000,
                dots: true,
                autoplayHoverPause: true,
                nav: false,
                navText: ["<i class='fas fa-long-arrow-alt-left'></i>", "<i class='fas fa-long-arrow-alt-right'></i>"],
            });
        } else if (status == "off") {
            gallery.parents('.product-gallery').removeClass('active-carousel');
            gallery.owlCarousel('destroy');
            gallery.removeClass('owl-carousel product-image-carousel');
        }
    }
}



var prevScrollPos = 0;

$(document).ready(function() {

    $(document).on('click', '.js-scroll-to', function() {
        var scrollTo = $(this).data('scrollto');
        var target = $('[data-scroll=' + scrollTo + ']');
        var targetOffsetTop = $(target).offset().top;
        $('html, body').animate({
            scrollTop: targetOffsetTop
        }, 1000);
    });

    // Active header animation
    $(window).scroll(function() {
        var scrollTop = $(this).scrollTop();
        // fixDesktopNav(scrollTop);
        // toggleSlideDownDesktopNav(scrollTop);
        toggleGototopButton(scrollTop);
    });
    //

    // Toggle searchbox (header)
    // $('.js-toggle-search-box').click(function() {
    //     $('.search-box').fadeToggle();
    // });
    // END Toggle searchbox
});

function fixDesktopNav(scrollTop) {
    if (scrollTop > 300 && scrollTop > prevScrollPos) {
        $('.header .header-nav').addClass('fixed');
        return;
    }
    if (scrollTop == 0) {
        $('.header .header-nav').removeClass('fixed');
        return;
    }
}

function toggleSlideDownDesktopNav(scrollTop) {
    if (scrollTop < prevScrollPos) {
        // scrolling up => show desktop nav
        $('.header .header-nav').addClass('slide-down');
    } else {
        // scrolling down => hide desktop nav
        $('.header .header-nav').removeClass('slide-down');
    }
}

function toggleGototopButton(scrollTop) {
    if (scrollTop > 450) {
        // scrolling down
        $('.gototop').addClass('active');
    } else {
        $('.gototop').removeClass('active');
    }

    prevScrollPos = scrollTop;
}


$(document).ready(function() {
    $(".owl-carousel.main-carousel").owlCarousel({
        items: 1,
        loop: true,
        autoplay: true,
        autoplaySpeed: 1000,
        dots: false,
        autoplayHoverPause: true,
        nav: true,
        // navText: ["<i class='fas fa-long-arrow-alt-left'></i>", "<i class='fas fa-long-arrow-alt-right'></i>"]
        navText: ['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>'],

        animateOut: 'slideOutDown',
        animateIn: 'slideInDown',
        autoplayTimeout: 1000,
        items:1,
         loop:true,
         autoplay:true,
         autoplayTimeout:1000,
    });

    $(".owl-carousel-news").owlCarousel({
        margin: 10,
        loop: true,
        autoplay: true,
        autoplaySpeed: 1000,
        autoplayHoverPause: true,
        nav: true,
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            600: {
                items: 3,
                nav: true,
            },
            1000: {
                items: 3,
                nav: true,
                loop: false
            }
        },
        navText: ['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
    });

    $(".owl-carousel-products").owlCarousel({
        margin: 10,
        loop: true,
        autoplay: true,
        autoplaySpeed: 1000,
        autoplayHoverPause: true,
        nav: true,
        responsive: {
            0: {
                items: 2,
                margin: 5,
                nav: true
            },
            600: {
                items: 4,
                nav: true,
            },
            1000: {
                items: 4,
                nav: true,
                loop: true
            }
        },
        navText: ['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
    });

    $(".owl-products-some").owlCarousel({
        margin: 10,
        loop: false,
        autoplay: true,
        autoplaySpeed: 1000,
        autoplayHoverPause: true,
        nav: false,
        responsive: {
            0: {
                items: 2,
                margin: 5,
                loop: false,
            },
            600: {
                items: 3,
                loop: false,
            },
            1000: {
                items: 3,
                nav: false,
                loop: false,
            }
        },
        navText: ['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
    });

    $(".owl-carousel-shops").owlCarousel({
        margin: 10,
        loop: true,
        autoplay: true,
        autoplaySpeed: 1000,
        autoplayHoverPause: true,
        nav: true,
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            600: {
                items: 3,
                nav: true,
            },
            1000: {
                items: 3,
                nav: true,
                loop: true
            }
        },
        navText: ['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
    });
});



$(document).ready(function() {
    // // Giúp menu dropdown hiển thị tốt hơn: Qua trái hoặc qua phải tùy vào chiều rộng màn hình
    $('.header-nav li').on('mouseenter mouseleave', function(event) {
        // alert('a');
        event.preventDefault();
        if ($(this).find('ul.submenu').length) {
            var submenu = $(this).find('ul:first');
            var offset = submenu.offset();
            var offsetLeft = offset.left;
            var submenuWidth = submenu.width();
            var docW = $('.header-nav').width();
            // alert(docW);
            // alert(submenuWidth);
            // alert(offsetLeft);
            // console.log(offsetLeft+submenuWidth);
            // console.log(docW);
            var isEntirelyVisible = (offsetLeft + submenuWidth < docW);
            if (!isEntirelyVisible) {
                $(this).addClass('change-direction');
            } else {
                $(this).removeClass('change-direction');
            }
        }
    });
});




// Mobile Menu
$(document).ready(function() {
    // Toggle Mobile Menu
    $('.menu-mobile-toggle-button').click(function(e) {
    	$('.mobile-menu-overlay').toggleClass('active');
    	$('.mobile-menu-list').toggleClass('active');
    });
});
// Mobile Menu


// ================================================== //
// ====================== CART ====================== //
$(document).ready(function() {

    // Click add to cart button
    $('.js-add-to-cart').click(function(event) {
        let productID = product.id;
        let productDetailID = 0;
        let quantity = $('.quantity-input').val();

        if (productDetails.length > 0) {
            let colorID = $('.color-option:checked').val();
            let sizeID = $('.size-option:checked').val();
            if (check_valid_color_and_size(colorID, sizeID)) {
                $(productDetails).each(function(index, detail) {
                    if (detail.color == colorID && detail.size == sizeID) {
                        productDetailID = detail.id;
                        return true;
                    }
                });
            }
        }

        ajaxAddToCart(productID, productDetailID, quantity);
    });

    // Xóa 1 cart item => update quantity = 0
    $('body').on('click', '.js-remove-cart-item', function(event) {
        if (!confirm('Bạn muốn xóa sản phẩm này khỏi giỏ hàng')) {
            return;
        }
        let quantity = 0;
        let rowid = $(this).data('rowid');
        updateCartItemQuantity(rowid, quantity);
    });

    // Xóa cart
    $('body').on('click', '.js-remove-cart', function(event) {
        event.preventDefault();
        if (!confirm('Bạn muốn xóa giỏ hàng ?')) {
            return;
        }
        let href = $(this).attr('href');
        window.location.href = href;
    });

});

function ajaxAddToCart(productID, productDetailID, quantity) {
    let params = {
        product_id: productID,
        product_detail_id: productDetailID,
        quantity: quantity
    };
    console.log(params);

    $.ajax({
            url: baseUrl + 'ajax/add-to-cart',
            type: 'GET',
            data: params
        })
        .done(function(response) {
            console.log("success");
            updateCartSidebarView();

            $('.js-toggle-cart-sidebar')[0].click();
        })
        .fail(function() {
            console.log("error");
        });
}

function updateCartItemQuantity(rowid, quantity) {
    let params = {
        rowid: rowid,
        quantity: quantity
    };
    $.ajax({
            url: baseUrl + 'ajax/update-cart-item-quantity',
            type: 'GET',
            data: params
        })
        .done(function(response) {
            console.log("success");
            console.log(JSON.parse(response));

            updateCartSidebarView();
            if ($('.cart-page')[0]) {
                updateCartContainerView();
            }
        })
        .fail(function() {
            console.log("error");
        });
}

function updateCartSidebarView() {
    $.ajax({
            url: baseUrl + 'ajax/update-cart-sidebar-view',
        })
        .done(function(response) {
            console.log("success");
            response = JSON.parse(response);
            let counter = response.counter;
            let cartSidebarItems = response.cartSidebarItems;
            $('.cart-sidebar-container .total .money').html(format_curency(response.total));
            $('.shopping-bag .counter').html(response.counter);
            $('.cart-sidebar-container .body .cart-list').html(cartSidebarItems);
        })
        .fail(function() {
            console.log("error");
        })
}

function updateCartContainerView() {
    $.ajax({
            url: baseUrl + 'ajax/update-cart-container-view',
        })
        .done(function(response) {
            console.log("success");
            response = JSON.parse(response);
            let cartContainerView = response.cartContainerView;
            $('.cart-page').html(cartContainerView);
        })
        .fail(function() {
            console.log("error");
        })
}

$(document).ready(function() {
    // Users can skip the loading process if they want.
    $('.skip').click(function() {
        $('.overlay, body').addClass('loaded');
    })

    // Will wait for everything on the page to load.
    $(window).on('load', function() {
        $('.overlay, body').addClass('loaded');
        setTimeout(function() {
            $('.overlay').css({ 'display': 'none' })
        }, 2000)
    });

    // Will remove overlay after 1min for users cannnot load properly.
    setTimeout(function() {
        $('.overlay, body').addClass('loaded');
    }, 60000);
})
$('.li-category').click(function() {
    if ($('.sub-hover').css('display') === 'none') {
        $('.sub-hover').css('display', 'block')
    } else {
        $('.sub-hover').css('display', 'none')
    }
})
$(document).ready(function() {

    $h_slider_options = {
        gallery: true,
        item: 1,
        loop: true,
        slideMargin: 0,
        thumbItem: 6,
        galleryMargin: 10,
        thumbMargin: 10,
    };

    h_slider = $('#lightSlider').lightSlider($h_slider_options);

    /* Fancybox & lightSlider Sync - Bug Fix */
    $selector = '#lightSlider li:not(".clone") a';
    $selector += ',#lightSliderVertical li:not(".clone") a';
    $().fancybox({
        selector: $selector,
        backFocus: false, //The most important options for sync bug fix
        buttons: [
            'slideShow',
            'share',
            'zoom',
            'download',
            'fullScreen',
            'thumbs',
            'close'
        ]
    });
});

// #RESIZE BUG FIXING
// # if slider have height in % or vh,
// # on resize rebuild
$(window).resize(function() {
    // slider.destroy();
    h_slider = $('#ocassions-slider').lightSlider(h_slider_options);
});