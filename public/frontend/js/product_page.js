function addNewCart(id) {
  $(document).ready(function () {
    const postData = {
      product_id: id
    }

    $.ajax({
      type: "POST",
      url: 'handles_page/add_new_cart.php',
      data: postData,
      success: function (res) {
        if (res === "not logged in") {
          window.location.href = "User/login.php";
        } else {
          setTimeout(function () {
            $("#success-box").fadeIn();
          }, 100);

          setTimeout(function () {
            $("#success-box").fadeOut();
          }, 1000);
          $('.shopping-bag .counter').empty().append(res);
        }
      },
      error: function (xhr, status, error) {
        console.error("error: " + error);
      }
    });
  })
}

function getProductAjax() {
  const cate_id = $(".product_check:checked").val();
  $.ajax({
    url: "handles_page/get_products.php",
    method: "POST",
    data: { 
      action: 'data',
      cate_id: cate_id
    },
    success: function (res) {
      $(".get-product-box").empty().html(res);
    }
  });
}

function pageClickPagination(page) {
  const action = 'data';
  const cate = getFilterText('filter_cate');
  const onSale = getFilterText('on_sale');
  const view = getFilterText('filter_view');
  const fromPrice = $(".input-from-price").val();
  const toPrice = $(".input-to-price").val();

  $.ajax({
    url: "handles_page/get_products.php",
    method: "POST",
    data: {
      action: action,
      cate: cate,
      onSale: onSale,
      view: view,
      price: {
        from: fromPrice,
        to: toPrice
      },
      page: page
    },
    success: function (res) {
      $(".get-product-box").empty().html(res);
    }
  });
}

function getFilterText(text_id) {
  var filterData = [];
  $('#' + text_id + ':checked').each(function () {
    filterData.push($(this).val());
  })
  return filterData;
}

function calculateIncreaseSize(increase, price, quantity) {
  return ((price + parseFloat(increase)) * quantity);
}

function calculateIncreaseSizeSale(increase, price, quantity, percent) {
  return (((price + parseFloat(increase)) * (100 - percent) / 100) * quantity);
}

function formatPriceVND(price) {
  const numericPrice = parseFloat(price);
  const formattedIncreaseSize = numericPrice.toLocaleString('vi-VN', {
    minimumFractionDigits: 0
  });
  return formattedIncreaseSize + " vnđ";
}

$(document).ready(function () {
  getProductAjax();

  $("#search-product").on("input", function () {
    var query = $(this).val();
    if (query !== "") {
      $.ajax({
        url: "handles_page/search.php",
        method: "POST",
        data: { query: query },
        success: function (response) {
          $("#search-results").show().html(response);
        }
      });
    } else {
      $("#search-results").hide().empty();
    }
  });

  $(".product_check").click(function () {
    const action = 'data';
    const cate = getFilterText('filter_cate');
    const onSale = getFilterText('on_sale');
    const view = getFilterText('filter_view');
    const fromPrice = $(".input-from-price").val();
    const toPrice = $(".input-to-price").val();

    $.ajax({
      url: "handles_page/get_products.php",
      method: "POST",
      data: {
        action: action,
        cate: cate,
        onSale: onSale,
        view: view,
        price: {
          from: fromPrice,
          to: toPrice
        }
      },
      success: function (res) {
        $(".get-product-box").empty().html(res);
      }
    });
  })

  $(".apply-price").click(function () {
    const action = 'data';
    const cate = getFilterText('filter_cate');
    const onSale = getFilterText('on_sale');
    const view = getFilterText('filter_view');
    const $errorBox = $(".error-input-filter-price-box");

    $errorBox.empty();
    const fromPrice = parseFloat($(".input-from-price").val());
    const toPrice = parseFloat($(".input-to-price").val());

    if (isNaN(fromPrice) || isNaN(toPrice)) {
      const errorMessage = `
            <div class="error-input-filter-price">
              Please enter valid numeric prices
            </div>`;
      $errorBox.empty().html(errorMessage);
    } else if (fromPrice > toPrice) {
      const errorMessage = `
            <div class="error-input-filter-price">
              Please enter a valid price range
            </div>`;
      $errorBox.empty().html(errorMessage);
    } else {
      $.ajax({
        url: "handles_page/get_products.php",
        method: "POST",
        data: {
          action: action,
          cate: cate,
          onSale: onSale,
          view: view,
          price: {
            from: fromPrice,
            to: toPrice
          }
        },
        success: function (res) {
          $(".get-product-box").empty().html(res);
        }
      });
    }
  });

  // product details
  $(".qty-btn-reduce").click(function () {
    let total = '';
    let totalOld = '';
    const increase_size = $(".sizeBtn.active").data("increase");
    const salePrice = $(".discounted-price").data("price");
    const percent = $(".discounted-price").data("percent");
    const qtyProduct = parseInt($(".qty-product-detail").val());
    if (qtyProduct > 1) {
      $(".qty-product-detail").val(qtyProduct - 1);
      const qtyNew = qtyProduct - 1;

      if (percent === undefined) {
        total = calculateIncreaseSize(increase_size, salePrice, qtyNew);
      } else {
        total = calculateIncreaseSizeSale(increase_size, salePrice, qtyNew, percent);
        totalOld = calculateIncreaseSize(increase_size, salePrice, qtyNew);
        $(".original-price").empty().text(formatPriceVND(totalOld));
      }

      $(".discounted-price").data("addCart", total);
      $(".discounted-price").empty().text(formatPriceVND(total));

    }
  })

  $(".qty-btn-increase").click(function () {
    let total = '';
    let totalOld = '';
    const increase_size = $(".sizeBtn.active").data("increase");
    const salePrice = $(".discounted-price").data("price");
    const percent = $(".discounted-price").data("percent");
    const qtyProduct = parseInt($(".qty-product-detail").val());
    if (qtyProduct < 5) {
      $(".qty-product-detail").val(qtyProduct + 1);
      const qtyNew = qtyProduct + 1;

      if (percent === undefined) {
        total = calculateIncreaseSize(increase_size, salePrice, qtyNew);
      } else {
        total = calculateIncreaseSizeSale(increase_size, salePrice, qtyNew, percent);
        totalOld = calculateIncreaseSize(increase_size, salePrice, qtyNew);
        $(".original-price").empty().text(formatPriceVND(totalOld));
      }

      $(".discounted-price").data("addCart", total);
      $(".discounted-price").empty().text(formatPriceVND(total));

    }
  })

  // Flavor buttons event listener
  $(".flavorBtn").on("click", function () {
    $(this).siblings().removeClass("active");
    $(this).addClass("active");
    selectedFlavor = $(this).val();
  });

  $(".sizeBtn").on("click", function () {
    selectedSize = $(this).val();
    $(this).siblings().removeClass("active");
    $(this).addClass("active");
    const size_id = $(this).data("size");
    const increase = $(this).data("increase");
    const salePrice = $(".discounted-price").data("price");
    const percent = $(".discounted-price").data("percent");
    const quantity = $(".qty-product-detail").val();

    $.ajax({
      url: "handles_page/get_increase_size.php", // Replace with the actual URL to fetch the increaseSize
      method: "POST",
      data: {
        size_id: size_id
      },
      success: function (res) {
        let total = '';
        let totalOld = '';
        if (percent === undefined) {
          total = calculateIncreaseSize(res, salePrice, quantity);
        } else {
          total = calculateIncreaseSizeSale(res, salePrice, quantity, percent);
          totalOld = calculateIncreaseSize(res, salePrice, quantity);
          $(".original-price").empty().text(formatPriceVND(totalOld));
        }

        $(".discounted-price").data("addCart", total);
        $(".discounted-price").empty().text(formatPriceVND(total));

      },
      error: function () {
        $(".IncreaseSize").val(""); // Reset the hidden input field in case of error
      }
    });
  });

});

$(document).ready(function () {
  const mainBigImage = $("#mainBigImage");
  const originalImage = $("#originalImage");
  const thumbnailImages = $(".thumbnail-img");

  thumbnailImages.each(function () {
    $(this).on("click", function () {
      const index = $(this).attr("data-index");
      const newImageSrc = $(this).attr("src");
      updateBigImage(newImageSrc);
    });
  });

  originalImage.on("click", function () {
    const originalSrc = originalImage.attr("src");
    updateBigImage(originalSrc);
  });

  function updateBigImage(newImageSrc) {
    mainBigImage.attr("src", newImageSrc);
  }

  $('.clients-carousel').owlCarousel({
    loop: true,
    nav: false,
    autoplay: true,
    autoplayTimeout: 3000,
    animateOut: 'fadeOut',
    animateIn: 'fadeIn',
    smartSpeed: 450,
    autoplaySpeed: 1000,
    responsive: {
      0: {
        items: 2,
      },
      600: {
        items: 3,
      },
      1000: {
        items: 4,
      },
    },
    navText: [
      '<i class="fa fa-chevron-left" aria-hidden="true"></i>',
      '<i class="fa fa-chevron-right" aria-hidden="true"></i>',
    ],
  });
});
$(document).ready(function () {
  showComment();
  $(".submit-comment").click(function () {
    const product_id = $("#proDetail-proID").data("id");
    const content = $("#comment").val();
    $.ajax({
      url: "handles_page/add_comment.php", 
      method: "POST",
      data: {
        content: content,
        product_id: product_id
      },
      success: function (res) {
        console.log(res);
      },
      error: function (xhr, status, error) {
        console.error("error: " + error);
      }
    });
  })
  $("#comment").on("click", function () {
    $.ajax({
      url: "handles_page/check_login_status.php", 
      method: "POST",
      success: function(res) {
        if(res === "notloggedin"){
          Swal.fire({
            icon: 'info',
            title: 'Not Logged In',
            text: 'You are not logged in.',
            didClose: () => {
              window.location.href = "User/login.php";
            }
          });
        }
      },
      error: function (xhr, status, error) {
        console.error("error: " + error);
      }
    });
  })
});

function showComment() {
  let product_id = '';
  product_id = $("#proDetail-proID").data("id");
  $.ajax({
    url: "handles_page/show_comments.php", // Replace with the actual URL to fetch the increaseSize
    method: "POST",
    data: {
      product_id: product_id
    },
    success: function (res) {
      $(".comments").empty().html(res);
    },
    error: function (xhr, status, error) {
      console.error("error: " + error);
    }
  });
}