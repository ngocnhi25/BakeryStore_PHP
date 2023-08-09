<?php
session_start();
require_once('connect/connectDB.php');

$id = 18;
$product = executeResult("select * from tb_products where product_id = $id");
$flaror = executeResult("select * from tb_flavor");
$size = executeResult("select * from tb_size");
$thumb = executeResult("select * from tb_thumbnail where product_id = $id");
$priceResult = executeSingleResult("SELECT price FROM tb_products WHERE product_id = $id");
$productResult = executeSingleResult("SELECT product_name FROM tb_products WHERE product_id = $id");
$idproductResult = executeSingleResult("SELECT product_id FROM tb_products WHERE product_id = $id");
if ($priceResult) {
  $price = $priceResult['price'];
} else {
  echo "Price not available.";
}
//get name value
if ($productResult) {
  $name = $productResult['product_name'];
} else {
  echo "Name not available.";
}
//get product_id
if ($idproductResult) {
  $id = $idproductResult['product_id'];
} else {
  echo "Name not available.";
}
//Breadcrumbs setup
$productDetails = executeSingleResult("SELECT p.product_name, c.cate_name FROM tb_products p
                                      JOIN tb_category c ON p.cate_id = c.cate_id
                                      WHERE p.product_id = $id");

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Bánh Mousse Chanh Leo | Bánh Sinh Nhật | Mousse Passion Fruit</title>

  <!-- FONT -->
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Cabin" />
  <!-- FONT -->

  <!-- PLUGIN CSS -->
  <link rel="stylesheet" href="../public/frontend/css/librarys_css/css/bootstrap4.min.css">
  <link rel="stylesheet" href="../public/frontend/css/librarys_css/css/owl.carousel.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css">
  <link rel="stylesheet" href="../public/frontend/css/lightslider.css">
  <link rel="stylesheet" href="../public/frontend/js/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- PLUGIN CSS -->

  <link href="../public/frontend/css/style.css" rel="stylesheet">

</head>

<body>

  <?php include("layout/header.php"); ?>

  <div class="breadcrumb">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            <a href="/" itemprop="item">
              <span itemprop="name">Trang chủ</span>
              <meta itemprop="position" content="1" />
            </a>
          </li>
          <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            <a href="#" itemprop="item">
              <span itemprop="name">
                <?php echo $productDetails['cate_name']; ?>
              </span>
              <meta itemprop="position" content="2" />
            </a>
          </li>
          <li class="breadcrumb-item active" aria-current="page" itemprop="itemListElement" itemscope
            itemtype="https://schema.org/ListItem">
            <a href="#" itemprop="item">
              <span itemprop="name">
                <?php echo $productDetails['product_name']; ?>
              </span>
              <meta itemprop="position" content="3" />
            </a>
          </li>
        </ol>
      </nav>
    </div>
  </div>
  <section class="section-paddingY middle-section product-page">
    <div class="container">
      <div class="row">

        <div class="col-md-9">
          <div class="row">
            <div class="col-12 col-lg-7">
              <div class="detail-header show-mobile">

                <h5 class="product-name">
                  <?php echo $product["product_name"] ?>
                </h5>

                <span>(Cake Mousse Passion Fruit)</span>

              </div>
              <div class="product-imgs">
                <ul id="lightSlider">
                  <li data-thumb="source/Bánh Sinh Nhật THB/Banh Sinh Nhat 003.jpg">
                    <a href="source/Bánh Sinh Nhật THB/Banh Sinh Nhat 003.jpg" data-fancybox="gallery">
                      <div class="big-img">
                        <img src="../public/images/products/z4341665527978_fc1db1d413a2d7d2146b13ffffc50d0a.jpg">
                      </div>
                    </a>
                  </li>
                </ul>
                <div class="images">
                  <?php foreach($thumb as $t) { ?>
                  <div class="small-img">
                    <img src="../<?php echo $t['thumbnail'] ?>" data-src="<?php echo $t['larger_image'] ?>" class="thumbnail-img">
                  </div>
                  <?php } ?>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-5">

              <div class="left">

              </div>
              
              <div class="right">
                <div class="pname"><?php echo $name ?></div>
              <div class="size">
                  <p>increaseSize:</p>
                  <div id="displayedIncreaseSize">N/A</div>
              </div>
              <div class="size">
                  <p>Size:</p>
                  <?php foreach ($size as $s) { ?>
                    
                      <button class="sizeBtn" data-size="<?= $s['size_name'] ?>" value="<?= $s['size_name'] ?>"><?php echo $s["size_name"] ?></button>
                    
                  <?php } ?>
                </div>
                <div class="size">
                  <p>Flavor:</p>
                  <?php foreach ($flaror as $f) { ?>
                    
                      <button class="flavorBtn" data-size="<?= $f['flavor_name'] ?>"><?php echo $f["flavor_name"] ?></button>
                    
                  <?php } ?>
                </div>
              <form action="" class="form-submit">
                <div class="ratings">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                </div>
                <div class="price">
                  <p id="price"><?php echo number_format($price) ?>$</p>
                </div>
                
                
                <div class="quantity">
                  <p>Quantity:</p>
                  <input type="number" min="1" max="5" value="1">
                </div>

                <input type="hidden" class="pid" value="<?php echo $id ?>">
                <input type="hidden" class="name" value="<?php echo $name ?>">
                <input type="hidden" class="IncreaseSize" value="" id="hiddenIncreaseSize">

                <div class="btn-box">
                  <button class="cart-btn add" id="add">Add to Cart</button>
                  <button class="buy-btn">Buy Now</button>
                </div>
              </form>
              </div>
            </div>
            <div class="col-12 mt-5">
              <div class="card-content-pro">
                <ul class="nav nav-pills tabs-categories" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab-left" data-toggle="pill" href="#pills-home" role="tab"
                      aria-controls="pills-home" aria-selected="true">Mô
                      tả sản phẩm</a>
                  </li>
                </ul>

                <div class="tab-content" id="pills-tabContent">
                  <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                    aria-labelledby="pills-home-tab">

                    <p><span style="font-size: 12px;">
                        <?php foreach ($product as $p) { ?>
                          <?php echo $p["description"] ?>
                        <?php } ?>
                      </span></p>

                  </div>
                  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                  </div>
                </div>
              </div>
              <div class="tags">
                <i class="fa fa-tags" aria-hidden="true"></i>
                <p><a href="danh-muc/banh-sinh-nhat">B&aacute;nh Sinh Nhật</a>, <a
                    href="danh-muc/banh-sinh-nhat">B&aacute;nh Sinh Nhật Tại H&agrave; Nội</a>, <a
                    href="danh-muc/banh-sinh-nhat">B&aacute;nh Sinh Nhật H&igrave;nh Logo C&ocirc;ng Ty</a>, <a
                    href="danh-muc/banh-cho-be">B&aacute;nh Sinh Nhật Cho B&eacute; Trai</a>, <a
                    href="danh-muc/banh-cho-be">B&aacute;nh Sinh Nhật Cho B&eacute; G&aacute;i</a></p>
                <p><a href="san-pham/banh-mousse-chanh-leo-5">B&aacute;nh Mousse Chanh Leo</a></p>
                <p>&nbsp;</p>
              </div>
            </div>

            <div class="col-12 mt-3">
              <section class="testimonial">
                <div class="container">
                  <div class="row">
                    <div class="section-header">
                      <p class="section-title">Feeback</p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="clients-carousel owl-carousel">
                      <div class="single-box">
                        <div class="content">
                          <p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam, doloribus minima
                            praesentium
                            laborum ea earum."</p>
                          <h4>Jason Doe</h4>
                        </div>
                      </div>
                      <div class="single-box">
                        <div class="content">
                          <p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam, doloribus minima
                            praesentium
                            laborum ea earum."</p>
                          <h4>Dave Wood</h4>
                        </div>
                      </div>
                      <div class="single-box">
                        <div class="content">
                          <p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam, doloribus minima
                            praesentium
                            laborum ea earum."</p>
                          <h4>Matt Demon</h4>
                        </div>
                      </div>
                      <div class="single-box">
                        <div class="content">
                          <span class="rating-star"><i class="icofont-star"></i><i class="icofont-star"></i><i
                              class="icofont-star"></i><i class="icofont-star"></i><i class="icofont-star"></i></span>
                          <p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam, doloribus minima
                            praesentium
                            laborum ea earum."</p>
                          <h4>jimmy kimmel</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
            </div>


            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js">
            </script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.min.js">
            </script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js">
            </script>
            <script>
              $('.clients-carousel').owlCarousel({
                loop: true,
                nav: false,
                autoplay: true,
                autoplayTimeout: 5000,
                animateOut: 'fadeOut',
                animateIn: 'fadeIn',
                smartSpeed: 450,
                margin: 30,
                responsive: {
                  0: {
                    items: 1
                  },
                  768: {
                    items: 2
                  },
                  991: {
                    items: 2
                  },
                  1200: {
                    items: 2
                  },
                  1920: {
                    items: 2
                  }
                }
              });
            </script>

            <div class="col-12 mt-3">
              <div class="section-header">
                <p class="section-title">Sản phẩm gợi ý</p>
              </div>
              <div class="section-body">
                <div class="owl-products-some owl-carousel owl-theme">
                  <div class="one-product-container">

                    <div class="product-images">
                      <a class="product-image hover-animation" href="san-pham/opera-cake-27">
                        <img src="source/B&aacute;nh Sinh Nhật THB/Banh opera 001.jpg" alt="Opera Cake " />
                        <img src="source/B&aacute;nh Sinh Nhật THB/Banh opera 001.jpg" alt="Opera Cake " />
                      </a>
                    </div>
                    <div class="product-info">
                      <p class="product-name">
                        <a href="#/">
                          Opera Cake
                        </a>
                      </p>
                      <div class="product-price">

                        <span class="price">400,000&#8363;</span>
                      </div>
                    </div>
                  </div>
                  <div class="one-product-container">

                    <div class="product-images">
                      <a class="product-image hover-animation" href="san-pham/cream-cheese-layer-cake-36">
                        <img src="source/B&aacute;nh Sinh Nhật/kembo 005a.jpg" alt="Cream Cheese Layer Cake" />
                        <img src="source/B&aacute;nh Sinh Nhật/kembo 005a.jpg" alt="Cream Cheese Layer Cake" />
                      </a>
                    </div>
                    <div class="product-info">
                      <p class="product-name">
                        <a href="#/">
                          Cream Cheese Layer Cake
                        </a>
                      </p>
                      <div class="product-price">

                        <span class="price">350,000&#8363;</span>
                      </div>
                    </div>
                  </div>
                  <div class="one-product-container">

                    <div class="product-images">
                      <a class="product-image hover-animation" href="san-pham/red-velvet-cake-heart-71">
                        <img src="source/B&aacute;nh Sinh Nhật/Red Velvet Cake 1.jpg" alt="Red Velvet Cake Heart" />
                        <img src="source/B&aacute;nh Sinh Nhật/Red Velvet Cake 1.jpg" alt="Red Velvet Cake Heart" />
                      </a>
                    </div>
                    <div class="product-info">
                      <p class="product-name">
                        <a href="#/">
                          Red Velvet Cake Heart
                        </a>
                      </p>
                      <div class="product-price">

                        <span class="price">Liên hệ</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php include("layout/footer.php"); ?>

  <script src="public/plugins/js/jquery3.3.1.min.js"></script>
  <script>
    var baseUrl = "";
  </script>
  <script src="public/frontend/assets/js/config.js"></script>
  <script src="public/plugins/js/bootstrap4.min.js"></script>
  <script src="public/plugins/js/owl.carousel.min.js"></script>
  <script src="ajax/libs/lightslider/1.1.6/js/lightslider.min.js"></script>
  <script src="ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
  <script src="public/frontend/js/main.js"></script>
  <script src="public/frontend/assets/js/product_page.js"></script>
  <script src="public/myplugins/js/messagebox.js"></script>

  <script>
  document.addEventListener("DOMContentLoaded", function () {
  let selectedSize = ""; // Khai báo biến để lưu giá trị size đã chọn

  const sizeButtons = document.querySelectorAll(".sizeBtn");

  sizeButtons.forEach(function (button) {
    button.addEventListener("click", function () {
      selectedSize = button.getAttribute("data-size"); // Lưu giá trị size đã chọn
      // console.log("Selected Size:", selectedSize); // Debug
    });
  });

  $(document).on("click", "#add", function (e) {
    e.preventDefault();

    var $form = $(this).closest(".form-submit");
    var pid = $form.find(".pid").val();
    var pname = $form.find(".name").val();
    var increaseSizeText = $("#hiddenIncreaseSize").val();
    var increaseSizeWithoutCommas = increaseSizeText.replace(/,/g, ''); // Loại bỏ dấu phẩy
    var increaseSize = parseFloat(increaseSizeWithoutCommas);
    var quantity = $form.find(".quantity input").val();
    var priceText = $form.find("#price").text(); // Lấy chuỗi văn bản
    var priceWithoutCommas = priceText.replace(/,/g, ''); // Loại bỏ dấu phẩy
    var price = parseFloat(priceWithoutCommas); // Chuyển đổi chuỗi thành số // Chuyển đổi chuỗi thành số

    // console.log("Product ID:", pid);
    // console.log("Product Name:", pname);
    // console.log("Selected Size:", selectedSize); 
    // console.log("Increase Size:", increaseSize);
    // console.log("Quantity:", quantity);
    // console.log("Price:", price);

    // Thực hiện AJAX để thêm sản phẩm vào giỏ hàng
    $.ajax({
      url: "../src/handles_page/add_to_cart.php", // Thay thế bằng URL thực sự để thêm sản phẩm vào giỏ hàng
      method: "POST",
      data: {
        pid: pid,
        pname: pname,
        size: selectedSize,
        increaseSize: increaseSize,
        quantity: quantity,
        price: price
      },
      success: function (response) {
        // Xử lý phản hồi từ máy chủ (ví dụ: hiển thị thông báo thành công)
        alert("Product added to cart: " + response);
      },
      error: function () {
        alert("Error adding product to cart");
      }
    });
  });
});


  </script>
  <script>
    $(document).ready(function () {
  // Add click event listener to the size buttons
  $(".sizeBtn").on("click", function () {
    var selectedSize = $(this).data("size");

    // Make an Ajax request to get the increaseSize based on the selected size
    $.ajax({
      url: "../src/handles_page/get_increase_size.php", // Replace with the actual URL to fetch the increaseSize
      method: "POST",
      data: { size: selectedSize },
      success: function (response) {
        if (response !== "") {
          var formattedIncreaseSize = parseFloat(response).toFixed(0);
          formattedIncreaseSize = formattedIncreaseSize.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
          formattedIncreaseSize = "+" + formattedIncreaseSize;
          
          // Update the displayed increaseSize
          $("#displayedIncreaseSize").text(formattedIncreaseSize);
          
          // Update the hidden input field
          $(".IncreaseSize").val(formattedIncreaseSize);
        } else {
          $("#displayedIncreaseSize").text("N/A");
          $(".IncreaseSize").val(""); // Reset the hidden input field if needed
        }
      },
      error: function () {
        $("#displayedIncreaseSize").text("Error fetching increaseSize");
        $(".IncreaseSize").val(""); // Reset the hidden input field in case of error
      }
    });
  });
});


    $(document).ready(function () {
    $(".thumbnail-img").click(function () {
      var largerImageSrc = $(this).data("src");
      $("#bigImage").attr("src", largerImageSrc);
    });
  });
  </script>
  <script src="../public/frontend/js/product_page.js"></script>
  </div>
</body>

</html>