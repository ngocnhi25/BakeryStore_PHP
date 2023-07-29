$(document).ready(function() {

  // When load page, render price
  renderPriceWhenLoad();

  // Choosing option(s) (color , size)
  // => get colorID and sizeID
  // => check if valid colorID and sizeID
  // => render new price (price, original price, discount percent)
  $('.product-page').on('change', '.input-option', function(event) {
    changeInputOption($(this));

    let colorID = $('.color-option:checked').val();
    let sizeID  = $('.size-option:checked').val();

    if (!check_valid_color_and_size(colorID, sizeID)) {
      return;
    }

    renderPriceWithOptions(colorID, sizeID)
  });

  // Increase or Decrease quantity (before buying)
  $('.product-page .quantity-zone .quantity-control').click(function(event) {
    let step = 0;
    let quantityInput = $(this).parent().find('.quantity-input');
    let quantity = quantityInput.val();
    quantity = parseInt(quantity);

    if ($(this).is('.decrease-btn')) {
      step = -1;
    } else if ($(this).is('.increase-btn')) {
      step = 1;
    }

    quantity += step;
    quantityInput.val(quantity);
    quantityInput.trigger('change');
    // if (isGreaterThan(quantity, 0)) {
    //   quantityInput.val(quantity);
    // } else {
    //   quantityInput.val(1);
    // }
  });

  $('.product-page .quantity-zone .quantity-input').change(function(event) {
    let quantity = $(this).val();
    quantity = parseInt(quantity);

    if (isGreaterThan(quantity, 0)) {
      $(this).val(quantity);
    } else {
      $(this).val(1);
    }
  });

});

function renderPriceWhenLoad() {
  // if product has detail(s);
  if (productDetails.length > 0) {
    let colorID = $('.color-option:checked').val();
    let sizeID  = $('.size-option:checked').val();
    renderPriceWithOptions(colorID, sizeID);
  } else {
    // product has no detail
    renderPriceWithNoOption();
  }
}

// check if colorID in colors array AND sizeID in sizes array
function check_valid_color_and_size(colorID, sizeID) {
  let check   = false;

  $(colors).each(function(index, color) {
    if (color.id == colorID) {
      // console.log(color);
      check = true;
      return true;
    }
  });

  if (check) {
    check = false;
    $(sizes).each(function(index, size) {
      if (size.id == sizeID) {
        // console.log(size);
        check = true;
        return true;
      }
    });
  }

  if (!check) {
    return false;
  }
  return true;
}

function renderPriceWithOptions(colorID, sizeID) {
  let price           = 0;
  let originalPrice   = 0;
  let discountPercent = 0;

  $(productDetails).each(function(index, detail) {
    if (detail.color == colorID && detail.size == sizeID) {
      price         = detail.price;
      originalPrice = detail.original_price ? detail.original_price : 0;
      return true;
    }
  });
  // console.log(price);
  // return;

  if (price < originalPrice) {
    discountPercent = calculateDiscountPercent(price, originalPrice);
  }

  renderPriceHTML(price, originalPrice, discountPercent);
}

function renderPriceWithNoOption() {
  let discountPercent = 0;
  let price           = product.price;
  let originalPrice   = product.original_price;

  if (price < originalPrice) {
    discountPercent = calculateDiscountPercent(price, originalPrice);
  }

  renderPriceHTML(price, originalPrice, discountPercent);

}

function calculateDiscountPercent(price, originalPrice) {
  discountPercent = 100 - (price*100)/originalPrice;
  return discountPercent = Math.round(discountPercent);
}

function renderPriceHTML(price, originalPrice, discountPercent) {
  // format_curency(), VIETNAMDONG in config.js\
  price         = format_curency(price, VIETNAMDONG);
  originalPrice = format_curency(originalPrice, VIETNAMDONG);

  $('.product-page .product-detail-container .price').html(price);
  if (discountPercent > 0) {
    $('.product-page .product-detail-container .discount-percent').html("-"+discountPercent+"%");
    $('.product-page .product-detail-container .price-del').html(originalPrice);
  }
}


function changeInputOption(_this) {
  _this.parents('.option-zone').find('label.active').removeClass('active');
  _this.parent().addClass('active');
  let value = _this.data('value');
  _this.parents('.option-zone').find('.option-result').html(value);
}
