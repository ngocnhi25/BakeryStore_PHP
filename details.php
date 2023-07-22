<?php 
session_start();
require_once('./connect/connectDB.php');

<<<<<<< HEAD
$id = 4;
$product = executeSingleResult("select * from tb_products where product_id = $id");
=======
$id = 2;
$product = executeResult("select * from tb_products where product_id = $id");
$flaror = executeResult("select * from tb_flaror");
$size = executeResult("select * from tb_product_size");
if(isset($_POST["add_to_cart"])){
  
}

>>>>>>> d406f3448d47e9392ea068de0a0d6e8fbb39ad2a

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>
    Bánh Mousse Chanh Leo | Bánh Sinh Nhật | Mousse Passion Fruit</title>
  <meta name="description" content="Bánh Mousse Chanh Leo, Mousse Passion Fruit">
  <meta name="keywords" content="Bánh Mousse Chanh Leo, Mousse Passion Fruit">
  <!-- Favicon -->
  <link rel="apple-touch-icon" href="source/icon/logo website2.png">
  <link rel="icon" type="image/png" href="source/icon/logo website2.png">
  <link rel="icon" type="image/png" href="source/icon/logo website2.png">

  <meta property="og:title" content="Bánh Mousse Chanh Leo | Bánh Sinh Nhật | Mousse Passion Fruit" />
  <meta property="og:site_name" content="BÁNH SINH NHẬT | BÁNH TRUNG THU | BÁNH SỰ KIỆN | HỘP QUÀ TRUNG THU" />
  <meta property="og:description" content="Bánh Mousse Chanh Leo, Mousse Passion Fruit" />
  <meta property="og:url" content="san-pham/mousse-chanh-leo-5" />
  <meta property="og:image" content="source/Bánh%20Sinh%20Nhật%20THB/Banh%20Sinh%20Nhat%20003.jpg" />
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:site" content="Bánh Mousse Chanh Leo | Bánh Sinh Nhật | Mousse Passion Fruit" />
  <meta name="twitter:title" content="Bánh Mousse Chanh Leo | Bánh Sinh Nhật | Mousse Passion Fruit" />
  <meta name="twitter:description" content="Bánh Mousse Chanh Leo, Mousse Passion Fruit" />
  <meta name="twitter:image" content="source/Bánh%20Sinh%20Nhật%20THB/Banh%20Sinh%20Nhat%20003.jpg" />

  <!-- Favicon -->

  <!-- FONT -->
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Cabin" />
  <!-- FONT -->

  <!-- PLUGIN CSS -->
  <link rel="stylesheet" href="public/plugins/css/bootstrap4.min.css">
  <link rel="stylesheet" href="public/plugins/css/owl.carousel.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css">
  <link rel="stylesheet" href="lightslider/dist/css/lightslider.css">
  <link rel="stylesheet" href="ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- PLUGIN CSS -->

  <link href="public/frontend/css/style.css?v=0.0.7" rel="stylesheet">
  <!-- Meta Pixel Code -->
  <script>
    !function (f, b, e, v, n, t, s) {
      if (f.fbq) return; n = f.fbq = function () {
        n.callMethod ?
          n.callMethod.apply(n, arguments) : n.queue.push(arguments)
      };
      if (!f._fbq) f._fbq = n; n.push = n; n.loaded = !0; n.version = '2.0';
      n.queue = []; t = b.createElement(e); t.async = !0;
      t.src = v; s = b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t, s)
    }(window, document, 'script',
      'en_US/fbevents.js');
    fbq('init', '1913464958707044');
    fbq('track', 'PageView');
  </script>
  <noscript><img height="1" width="1" style="display:none"
      src="tr?id=1913464958707044&ev=PageView&noscript=1" /></noscript>
  <!-- End Meta Pixel Code -->

  <!-- Google tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-232235704-1">
  </script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag() { dataLayer.push(arguments); }
    gtag('js', new Date());

    gtag('config', 'UA-232235704-1');
  </script><!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-QERL8JJ8K1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag() { dataLayer.push(arguments); }
    gtag('js', new Date());

    gtag('config', 'G-QERL8JJ8K1');
  </script>
  <style>
    
  </style>
</head>

<body>

<?php include("layout/header.php"); ?>

  <div class="breadcrumb">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            <a href="" itemprop="item">
              <span itemprop="name">Trang chủ</span>
              <meta itemprop="position" content="1" />
            </a>
          </li>
          <li class="breadcrumb-item active" aria-current="page" itemprop="itemListElement" itemscope
            itemtype="https://schema.org/ListItem">
            <a href="danh-muc/banh-sinh-nhat" itemprop="item">
              <span itemprop="name">B&aacute;nh Sinh Nhật</span>
              <meta itemprop="position" content="2" />
            </a>
          </li>
          <li class="breadcrumb-item active" aria-current="page" itemprop="itemListElement" itemscope
            itemtype="https://schema.org/ListItem">
            <a href="#" itemprop="item">
              <span itemprop="name">Mousse Chanh Leo</span>
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
        <div class="col-md-3">

          <ul class="menu-category">
            <li><span class="title-category">Danh mục sản phẩm</span></li>
            <hr>
            <li class="item-nav">
              <a href="#" class="open-submenu active">
                B&aacute;nh Sinh Nhật
                <i class="fa fa-angle-down" aria-hidden="true"></i>
              </a>
              <ul class="submenu-category show">
                <li class="item-nav">
                  <a href="danh-muc/gato-kem-tuoi">
                    Gato kem tươi
                  </a>
                </li>
                <li class="item-nav">
                  <a href="danh-muc/gato-kem-bo">
                    Gato kem bơ
                  </a>
                </li>
                <li class="item-nav">
                  <a href="danh-muc/banh-mousse">
                    B&aacute;nh mousse
                  </a>
                </li>
                <li class="item-nav">
                  <a href="danh-muc/banh-cuoi">
                    B&aacute;nh cưới
                  </a>
                </li>
                <li class="item-nav">
                  <a href="danh-muc/banh-valentine">
                    B&aacute;nh valentine
                  </a>
                </li>
                <li class="item-nav">
                  <a href="danh-muc/banh-su-kien">
                    B&aacute;nh sự kiện
                  </a>
                </li>
                <li class="item-nav">
                  <a href="danh-muc/banh-entremet">
                    B&aacute;nh Entremet
                  </a>
                </li>
              </ul>
            </li>
            <li class="item-nav">
              <a href="#" class="open-submenu ">
                B&aacute;nh Sinh Nhật Cho B&eacute;
                <i class="fa fa-angle-down" aria-hidden="true"></i>
              </a>
              <ul class="submenu-category ">
                <li class="item-nav">
                  <a href="danh-muc/banh-hinh-so">
                    B&aacute;nh h&igrave;nh số
                  </a>
                </li>
                <li class="item-nav">
                  <a href="danh-muc/banh-12-con-giap">
                    B&aacute;nh 12 con gi&aacute;p
                  </a>
                </li>
                <li class="item-nav">
                  <a href="danh-muc/banh-sang-tao">
                    B&aacute;nh s&aacute;ng tạo
                  </a>
                </li>
              </ul>
            </li>
            <li class="item-nav">
              <a href="#" class="open-submenu ">
                Cookies v&agrave; Mini Cake
                <i class="fa fa-angle-down" aria-hidden="true"></i>
              </a>
              <ul class="submenu-category ">
                <li class="item-nav">
                  <a href="danh-muc/choux-pastries">
                    Choux Pastries
                  </a>
                </li>
                <li class="item-nav">
                  <a href="danh-muc/banh-mi">
                    B&aacute;nh M&igrave;
                  </a>
                </li>
                <li class="item-nav">
                  <a href="danh-muc/cookies">
                    Cookies
                  </a>
                </li>
                <li class="item-nav">
                  <a href="danh-muc/macaron">
                    Macaron
                  </a>
                </li>
              </ul>
            </li>
            <li class="item-nav">
              <a href="#" class="open-submenu ">
                B&aacute;nh trung thu
                <i class="fa fa-angle-down" aria-hidden="true"></i>
              </a>
              <ul class="submenu-category ">
                <li class="item-nav">
                  <a href="danh-muc/hop-qua-trung-thu">
                    Hộp Qu&agrave; Trung Thu
                  </a>
                </li>
                <li class="item-nav">
                  <a href="danh-muc/banh-trung-thu-cac-vi">
                    B&aacute;nh trung thu c&aacute;c vị
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>



        <div class="col-md-9">
          <div class="row">
            <div class="col-12 col-lg-7">
              <div class="detail-header show-mobile">
<<<<<<< HEAD
                <h5 class="product-name">helllo</h5>
                <span>(Cake Mousse Passion Fruit)</span>  
=======

                  <h5 class="product-name">
                    <?php echo $product["product_name"] ?>
                  </h5>

                <span>(Cake Mousse Passion Fruit)</span>

>>>>>>> d406f3448d47e9392ea068de0a0d6e8fbb39ad2a
              </div>
              <div class="product-imgs">
                <ul id="lightSlider">
                  <li data-thumb="source/B&aacute;nh Sinh Nhật THB/Banh Sinh Nhat 003.jpg">
                    <a href="source/B&aacute;nh Sinh Nhật THB/Banh Sinh Nhat 003.jpg" data-fancybox="gallery">
                      <img src="source/B&aacute;nh Sinh Nhật THB/Banh Sinh Nhat 003.jpg" class="img-fluid" />
                    </a>
                  </li>
                </ul>
                <div class="share mt-3">
                  <ul>
                    <li>Chia sẻ: </li>
                    <li>
                      <a target="_blank" href="sharer/sharer.php?u=san-pham/mousse-chanh-leo-5"
                        class="fb-xfbml-parse-ignore">
                        <img src="public/frontend/assets/img/icons/Facebook.png" alt="">
                      </a>
                    </li>
                    <li>
                      <a class="twitter-share-button" target="_blank"
                        href="https://twitter.com/share?text=&amp;url=san-pham/mousse-chanh-leo-5" data-size="large">
                        <img src="public/frontend/assets/img/icons/Twitter.png" alt=""></a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-5">
              <div class="product-detail-container">
                <div class="detail-header show-desktop">
<<<<<<< HEAD
                  <h5 class="product-name"><?= $product["product_name"] ?></h5>
=======
                  <h5 class="product-name"><?php foreach ($product as $p) { ?>
                      <?php echo $p["product_name"] ?>
                    <?php } ?></h5>
>>>>>>> d406f3448d47e9392ea068de0a0d6e8fbb39ad2a
                  <span>(Cake Mousse Passion Fruit)</span>
                </div>
                <div class="detail-body">
                  <span class="option-result">Mousse 20cm</span>
                  <div class="button-zone">
                    <div class="row">
                      <b class="col-5">Tình trạng:</b>
                      <span class="col-7">Hết h&agrave;ng</span>
                    </div>
                    <div class="row">
                      <b class="col-5">Mã sản phẩm:</b>
                      <span class="col-7"><?php foreach ($product as $p) { ?>
                      <?php echo $p["product_id"] ?>
                    <?php } ?></span>
                    </div>
                    <div class="size-zone option-zone row">
                    <b class="col-5">nhan banh:</b>
                    
                        <select>
                            <option value="0">Select Cake:</option>
                            <?php foreach ($flaror as $f) { ?>
                                <option value="0"><?php echo $f["flaror_name"] ?></option>
                            <?php } ?>
                        </select>
                    
                    <?php
                    if (!empty($errors["cateID"])) {
                        echo '<p style="color: red;">' . $errors["cateID"] . '</p>';
                    }
                    ?>
                    </div>
                    <div class="row">
<<<<<<< HEAD
                      <b class="col-md-4">
                        Giá bán:
                      </b>
                      <div class="col-md-7">
                        <span class="product-price">
                          <span class="price text-price"></span>
                        </span>
=======
                      <b class="col-5">Số Lượng:</b>
                      <span class="col-7">
                      <div class="col-lg-2" style="display: flex;">
                      <button class="minus">-</button>
                      <input type="text" name="quantity" id="quantity" value="0" style="width: 50px;">
                      <button class="plus">+</button>
>>>>>>> d406f3448d47e9392ea068de0a0d6e8fbb39ad2a
                      </div>
                    </div>
                    <script>
                        document.querySelector('.minus').addEventListener('click', function() {
                          updateQuantity(-1); // Call the updateQuantity function with -1 to decrease the quantity
                        });

                        document.querySelector('.plus').addEventListener('click', function() {
                          updateQuantity(1); // Call the updateQuantity function with 1 to increase the quantity
                        });

                        // Function to update the quantity based on the change parameter (1 or -1)
                        function updateQuantity(change) {
                          var quantityInput = document.getElementById('quantity');
                          var currentQuantity = parseInt(quantityInput.value);
                          
                          if (!isNaN(currentQuantity)) { // Check if the current value is a valid number
                            var newQuantity = currentQuantity + change; // Calculate the new quantity
                            if (newQuantity >= 0) {
                              quantityInput.value = newQuantity; // Update the input field with the new quantity
                            }
                          }
                        }
                    </script>
                    <div class="size-zone option-zone row">
                      <b class="col-5">size banh:</b>
                      <select>
                          <option value="0">Select size:</option>
                          <?php foreach ($size as $s) { ?>
                              <option value="0"><?php echo $s["size"] ?></option>
                          <?php } ?>
                      </select>
                    </div>
                    <?php
                    if (!empty($errors["cateID"])) {
                        echo '<p style="color: red;">' . $errors["cateID"] . '</p>';
                    }
                    ?>
                    <div class="row">
                      <b class="col-5">Price:</b>
                      <span class="col-7"><?php foreach ($product as $p) { ?>
                      <?php echo $p["product_id"] ?>
                    <?php } ?></span>
                    </div>
                    <!-- <form action=""> -->
                    <!-- <a href="gio-hang.php"> -->
                    <button class="add-to-cart js-add-to-cart" name="add_to_cart">
                      <img src="public/frontend/assets/img/icons/shopping-bag.svg" alt="" />
                      Thêm vào giỏ
                    </button>
                    <!-- </a> -->
                    <!-- </form> -->
                    
                    <button class="add-to-cart mt-3 contact-card">
                      Đặt hàng nhanh nhất <br> 090 754 6668 | 096 938 6611
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 mt-3">
              <div class="card-content-pro">
                <ul class="nav nav-pills tabs-categories" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab-left" data-toggle="pill" href="#pills-home" role="tab"
                      aria-controls="pills-home" aria-selected="true">Mô
                      tả sản phẩm</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
                      aria-controls="pills-profile" aria-selected="false">
                      Giao hàng
                    </a>
                  </li>
                </ul>

                <div class="tab-content mt-3" id="pills-tabContent">
                  <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                    aria-labelledby="pills-home-tab">
                    <p><span style="font-size: 12pt;">Mousse Chanh Leo l&agrave; một trong những c&aacute;ch tốt nhất
                        để thưởng thức hương vị nhiệt đới đặc biệt của tr&aacute;i c&acirc;y.</span></p>
                    <p><span style="font-size: 12pt;">Những miếng <a href="san-pham/banh-mousse-chanh-leo-5">mousse
                          chanh leo</a> chua chua m&aacute;t m&aacute;t l&agrave; m&oacute;n b&aacute;nh hấp dẫn cho
                        m&ugrave;a h&egrave;.</span></p>
                    <p><span style="font-size: 12pt;">C&ocirc;ng thức của Thu Hương Bakery đứng đầu về d&ograve;ng
                        mousse</span></p>
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

  <div id="fb-root"></div>
  <div class='zalome'>
    <a href='#' target='_blank'>
      <img alt='icon zalo' src='public/frontend/assets/img/icons/icon-zalo.png' />
    </a>
  </div>
  <script>
    (function (d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s);
      js.id = id;
      js.src =
        'vi_VN/sdk.js#xfbml=1&version=v3.2&appId=1378687992242263&autoLogAppEvents=1';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
  </script>
  <!-- Messenger Plugin chat Code -->
  <div id="fb-root"></div>

  <!-- Your Plugin chat code -->
  <div id="fb-customer-chat" class="fb-customerchat">
  </div>

  <script>
    var chatbox = document.getElementById('fb-customer-chat');
    chatbox.setAttribute("page_id", "111597538192489");
    chatbox.setAttribute("attribution", "biz_inbox");
  </script>

  <!-- Your SDK code -->
  <script>
    window.fbAsyncInit = function () {
      FB.init({
        xfbml: true,
        version: 'v16.0'
      });
    };

    (function (d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'vi_VN/sdk/xfbml.customerchat.js';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
  </script>
  <script>
    // When the user scrolls the page, execute myFunction
    // window.onscroll = function () { myFunction() };

    // Get the header
    var header = document.getElementById("HeaderTop");

    // Get the offset position of the navbar
    var sticky = header.offsetTop;

    // Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
    function myFunction() {
      if (window.pageYOffset > sticky) {
        header.classList.add("fixed");
      } else {
        header.classList.remove("fixed");
      }
    }
  </script>
  <button class="gototop text-yellow">
    <img src="public/frontend/assets/img/icons/goto.png" alt="ve dau trang" style="margin-right: 10px"> Về đầu trang
  </button>

  <script src="public/plugins/js/jquery3.3.1.min.js"></script>
  <script>
    var baseUrl = "";
  </script>
  <script src="public/frontend/assets/js/config.js"></script>


  <script src="public/plugins/js/bootstrap4.min.js"></script>
  <script src="public/plugins/js/owl.carousel.min.js"></script>
  <script src="ajax/libs/lightslider/1.1.6/js/lightslider.min.js"></script>
  <script src="ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>



  <script src="public/frontend/assets/js/main.js"></script>
  <script src="public/frontend/assets/js/product_page.js"></script>
  <script src="public/myplugins/js/messagebox.js"></script>

  <!-- Load Facebook SDK for JavaScript -->
  <div id="fb-root"></div>
  <script>
    (function (d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s);
      js.id = id;
      js.src = "en_US/sdk.js#xfbml=1&version=v3.0";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
  </script>

  <script>
<<<<<<< HEAD
    var colors = [{ "id": null, "name": "Mousse 20cm" }, { "id": null, "name": "Mousse 22cm" }, { "id": null, "name": "Mousse 30cm" }];
    var sizes = [{ "id": "9", "name": "Mousse 20cm" }, { "id": "10", "name": "Mousse 22cm" }, { "id": "11", "name": "Mousse 30cm" }];
    var product = { "id": "5", "created_by": null, "code": "", "name": "Mousse Chanh Leo", "name_sub": "Cake Mousse Passion Fruit", "compositions": null, "alias": "mousse-chanh-leo", "image1": "\/source\/B\u00e1nh Sinh Nh\u1eadt THB\/Banh Sinh Nhat 003.jpg", "image2": "\/source\/B\u00e1nh Sinh Nh\u1eadt THB\/Banh Sinh Nhat 003.jpg", "video": null, "original_price": "320000", "price": "380000", "caption": "chanh leo, \u0111\u01b0\u1eddng tr\u1eafng, gelatin, whipping cream tatua, Cream cheese...", "preserve": "B\u1ea3o qu\u1ea3n m\u00e1t t\u1eeb 2\u00b0C - 6\u00b0C", "content": "<p><span style=\"font-size: 12pt;\">Mousse Chanh Leo l&agrave; m\u1ed9t trong nh\u1eefng c&aacute;ch t\u1ed1t nh\u1ea5t \u0111\u1ec3 th\u01b0\u1edfng th\u1ee9c h\u01b0\u01a1ng v\u1ecb nhi\u1ec7t \u0111\u1edbi \u0111\u1eb7c bi\u1ec7t c\u1ee7a tr&aacute;i c&acirc;y.<\/span><\/p>\r\n<p><span style=\"font-size: 12pt;\">Nh\u1eefng mi\u1ebfng <a href=\"\/san-pham\/banh-mousse-chanh-leo-5\">mousse chanh leo<\/a> chua chua m&aacute;t m&aacute;t l&agrave; m&oacute;n b&aacute;nh h\u1ea5p d\u1eabn cho m&ugrave;a h&egrave;.<\/span><\/p>\r\n<p><span style=\"font-size: 12pt;\">C&ocirc;ng th\u1ee9c c\u1ee7a Thu H\u01b0\u01a1ng Bakery \u0111\u1ee9ng \u0111\u1ea7u v\u1ec1 d&ograve;ng mousse<\/span><\/p>", "tags": "<p><a href=\"\/danh-muc\/banh-sinh-nhat\">B&aacute;nh Sinh Nh\u1eadt<\/a>, <a href=\"\/danh-muc\/banh-sinh-nhat\">B&aacute;nh Sinh Nh\u1eadt T\u1ea1i H&agrave; N\u1ed9i<\/a>, <a href=\"\/danh-muc\/banh-sinh-nhat\">B&aacute;nh Sinh Nh\u1eadt H&igrave;nh Logo C&ocirc;ng Ty<\/a>, <a href=\"\/danh-muc\/banh-cho-be\">B&aacute;nh Sinh Nh\u1eadt Cho B&eacute; Trai<\/a>, <a href=\"\/danh-muc\/banh-cho-be\">B&aacute;nh Sinh Nh\u1eadt Cho B&eacute; G&aacute;i<\/a><\/p>\r\n<p><a href=\"\/san-pham\/banh-mousse-chanh-leo-5\">B&aacute;nh Mousse Chanh Leo<\/a><\/p>\r\n<p>&nbsp;<\/p>", "hot": "1", "best_seller": "1", "qty_status": "0", "view": 3710, "order_number": "1", "created_at": "2022-05-18 23:26:06", "updated_at": "2023-04-10 13:21:29", "status": "1", "title": "B\u00e1nh Mousse Chanh Leo | B\u00e1nh Sinh Nh\u1eadt | Mousse Passion Fruit", "keyword": "B\u00e1nh Mousse Chanh Leo, Mousse Passion Fruit", "description": "B\u00e1nh Mousse Chanh Leo, Mousse Passion Fruit" };
=======
    var colors = [{ "id": null, "name": "Mousse 20cm" }, 
    { "id": null, "name": "Mousse 22cm" }, 
    { "id": null, "name": "Mousse 30cm" }];
    var sizes = [{ "id": "9", "name": "Mousse 20cm" },
     { "id": "10", "name": "Mousse 22cm" }, 
     { "id": "11", "name": "Mousse 30cm" }];
    var product = [{ "id": "5", "created_by": null, "code": "", "name": "Mousse Chanh Leo", "name_sub": "Cake Mousse Passion Fruit", "compositions": null, "alias": "mousse-chanh-leo", "image1": "\/source\/B\u00e1nh Sinh Nh\u1eadt THB\/Banh Sinh Nhat 003.jpg", "image2": "\/source\/B\u00e1nh Sinh Nh\u1eadt THB\/Banh Sinh Nhat 003.jpg", "video": null, "original_price": "320000", "price": "380000", "caption": "chanh leo, \u0111\u01b0\u1eddng tr\u1eafng, gelatin, whipping cream tatua, Cream cheese...", "preserve": "B\u1ea3o qu\u1ea3n m\u00e1t t\u1eeb 2\u00b0C - 6\u00b0C", "content": "<p><span style=\"font-size: 12pt;\">Mousse Chanh Leo l&agrave; m\u1ed9t trong nh\u1eefng c&aacute;ch t\u1ed1t nh\u1ea5t \u0111\u1ec3 th\u01b0\u1edfng th\u1ee9c h\u01b0\u01a1ng v\u1ecb nhi\u1ec7t \u0111\u1edbi \u0111\u1eb7c bi\u1ec7t c\u1ee7a tr&aacute;i c&acirc;y.<\/span><\/p>\r\n<p><span style=\"font-size: 12pt;\">Nh\u1eefng mi\u1ebfng <a href=\"\/san-pham\/banh-mousse-chanh-leo-5\">mousse chanh leo<\/a> chua chua m&aacute;t m&aacute;t l&agrave; m&oacute;n b&aacute;nh h\u1ea5p d\u1eabn cho m&ugrave;a h&egrave;.<\/span><\/p>\r\n<p><span style=\"font-size: 12pt;\">C&ocirc;ng th\u1ee9c c\u1ee7a Thu H\u01b0\u01a1ng Bakery \u0111\u1ee9ng \u0111\u1ea7u v\u1ec1 d&ograve;ng mousse<\/span><\/p>", "tags": "<p><a href=\"\/danh-muc\/banh-sinh-nhat\">B&aacute;nh Sinh Nh\u1eadt<\/a>, <a href=\"\/danh-muc\/banh-sinh-nhat\">B&aacute;nh Sinh Nh\u1eadt T\u1ea1i H&agrave; N\u1ed9i<\/a>, <a href=\"\/danh-muc\/banh-sinh-nhat\">B&aacute;nh Sinh Nh\u1eadt H&igrave;nh Logo C&ocirc;ng Ty<\/a>, <a href=\"\/danh-muc\/banh-cho-be\">B&aacute;nh Sinh Nh\u1eadt Cho B&eacute; Trai<\/a>, <a href=\"\/danh-muc\/banh-cho-be\">B&aacute;nh Sinh Nh\u1eadt Cho B&eacute; G&aacute;i<\/a><\/p>\r\n<p><a href=\"\/san-pham\/banh-mousse-chanh-leo-5\">B&aacute;nh Mousse Chanh Leo<\/a><\/p>\r\n<p>&nbsp;<\/p>", "hot": "1", "best_seller": "1", "qty_status": "0", "view": 3710, "order_number": "1", "created_at": "2022-05-18 23:26:06", "updated_at": "2023-04-10 13:21:29", "status": "1", "title": "B\u00e1nh Mousse Chanh Leo | B\u00e1nh Sinh Nh\u1eadt | Mousse Passion Fruit", "keyword": "B\u00e1nh Mousse Chanh Leo, Mousse Passion Fruit", "description": "B\u00e1nh Mousse Chanh Leo, Mousse Passion Fruit" }];
>>>>>>> d406f3448d47e9392ea068de0a0d6e8fbb39ad2a
    var productDetails = [{ "id": "363", "product_id": "5", "size": "9", "color": null, "options": null, "quantity": "0", "original_price": "320000", "price": "380000", "status": "1", "image": null, "created_at": "2023-04-10 13:21:29", "option_name": "Mousse 20cm", "size_id": "9" }, { "id": "364", "product_id": "5", "size": "10", "color": null, "options": null, "quantity": "0", "original_price": "320000", "price": "420000", "status": "1", "image": null, "created_at": "2023-04-10 13:21:29", "option_name": "Mousse 22cm", "size_id": "10" }, { "id": "365", "product_id": "5", "size": "11", "color": null, "options": null, "quantity": "0", "original_price": "320000", "price": "500000", "status": "1", "image": null, "created_at": "2023-04-10 13:21:29", "option_name": "Mousse 30cm", "size_id": "11" }];
//  console.log(productDetails);
  </script>
  <script src="public/frontend/assets/js/product_page.js"></script>
  </div>
</body>

</html>