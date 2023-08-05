<?php
session_start();
require_once('connect/connectDB.php');

$id = $_GET['product_id'];
$product = executeResult("select * from tb_products where product_id = $id");
$flaror = executeResult("select * from tb_flavor");
$size = executeResult("select * from tb_product_size");
//Breadcrumbs setup
$productDetails = executeSingleResult("SELECT p.product_name, c.cate_name FROM tb_products p
                                      JOIN tb_category c ON p.cate_id = c.cate_id
                                      WHERE p.product_id = $id");
$output = ''; // Initialize the $output variable before using it

if (!empty($product)) {
  foreach ($product as $sp) {
    $output .= '
    <div class="product-detail-container">
      <div class="detail-header show-desktop">
        <h5 class="product-name">
          ' . $sp["product_name"] . '
        </h5>
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
            <span class="col-7">' . $sp["product_id"] . '</span>
          </div>
          <div class="size-zone option-zone row">
            <b class="col-5">nhan banh:</b>
            <div class="col-7">
                    <select class="select_custom" id="nhanSelect">
                      <option value="0">Select Cake:</option>';
    foreach ($flaror as $f) {
      $output .= '<option value="0" >' . $f["flavor_name"] . '</option>';
    }
    $output .= '</select>
            </div>
    </div>
    <div class="row">
      <b class="col-5">Số Lượng:</b>
      <span class="col-7">
        
          <input type="number" style="width:68px; margin-bottom: 7px;
          height: 23px;" id="quantity" value="1" class="select_custom">
        
      </span>
    </div>
    <div class="row">
      <b class="col-5">Size:</b>
      <div class="col-7">
      <select id="sizeSelect" class="select_custom">';
    foreach ($size as $s) {
      $output .= '<option value="' . $s["size"] . '" id="size">' . $s["size"] . '</option>';
    }
    $output .= '</select>
      </div>
    </div>
    <div class="row">
      <b class="col-5">Price:</b>
      <span class="col-7" id="displayedPrice">';
    // Initially display the price of the first size (you may adjust it according to your needs)
    foreach ($size as $s) {
      $output .= $s["increase_size"];
      break;
    }
    $output .= '$</span>
    </div>';

    foreach ($product as $sp) {
      $output .= '<input type="hidden" name="price" id="price' . $sp["product_id"] . '" value="' . $sp["price"] . '">
      <input type="hidden" name="name" id="name' . $sp["product_id"] . '" value="' . $sp["product_name"] . '">';
    }

    $output .= '<button class="add-to-cart js-add-to-cart add" id="' . $sp["product_id"] . '">Add to Cart</button>
    <button class="add-to-cart mt-3 contact-card">
      Đặt hàng nhanh nhất <br> 090 754 6668 | 096 938 6611
    </button>
    </div>
    </div>
    </div>';
  }
}
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
  <link rel="stylesheet" href="../public/frontend/css/librarys_css/css/bootstrap4.min.css">
  <link rel="stylesheet" href="../public/frontend/css/librarys_css/css/owl.carousel.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css">
  <link rel="stylesheet" href="../public/frontend/css/lightslider.css">
  <link rel="stylesheet" href="../public/frontend/js/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- PLUGIN CSS -->

  <link href="../public/frontend/css/style.css" rel="stylesheet">
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
        <!-- <div class="col-md-3">

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
        </div> -->



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
                  <li data-thumb="source/B&aacute;nh Sinh Nhật THB/Banh Sinh Nhat 003.jpg">
                    <a href="source/B&aacute;nh Sinh Nhật THB/Banh Sinh Nhat 003.jpg" data-fancybox="gallery">

                      <?php foreach ($product as $p) { ?>
                        <img src="../<?php echo $p["image"] ?>" class="img-fluid">
                      <?php } ?>


                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-12 col-lg-5">
              <?php print($output) ?>
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

                    <p><span style="font-size: 12pt;">
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
  <script src="public/frontend/js/main.js"></script>
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
    $(document).ready(function () {
      $(document).on("click", ".add", function () {
        var id = $(this).attr("id");
        var name = $("#name" + id).val();
        var price = $("#price" + id).val();
        var quantity = $("#quantity").val();
        var size = $("#sizeSelect").val();
        var nhan = $("#nhanSelect").val();

        // Validate the quantity to be a positive integer
        if (quantity === "" || isNaN(quantity) || parseInt(quantity) <= 0) {
          alert("Please enter a valid quantity.");
          return;
        }

        // Check if the size has any increase in price
        var increaseSize = 0;
        if (size == 18) {
          increaseSize = 500000; // You may adjust this value based on your logic
        } else if (size == 20) {
          increaseSize = 1000000; // You may adjust this value based on your logic
        } // Add more conditions for other sizes if needed

        // Calculate the updated price based on the quantity and size increase
        var totalPrice = (parseFloat(price) + parseInt(increaseSize)) * parseInt(quantity);

        $.ajax({
          method: "POST",
          url: "add_to_cart.php",
          data: { id: id, name: name, price: totalPrice, quantity: quantity, size: size, increase_size: increaseSize, nhan: nhan },
          success: function (data) {
            alert("You have added a new item to the cart.");
            // Optional: You may update the cart count or display a message to the user.
          },
          error: function (xhr, textStatus, errorThrown) {
            alert("An error occurred while adding the item to the cart. Please try again.");
          }
        });
      });
    });

    function getresult(url) {
      $.ajax({
        url: url,
        type: "GET",
        data: { rowcount: $("#rowcount").val(), pagination_setting: $("#pagination-setting").val() }, // Fix: Remove the quotes around pagination_setting
        success: function (data) {
          $("#pagination-result").html(data);
        },
        error: function () { }
      });
    }

  </script>
  <script>
    $(document).ready(function () {
      // Add event listener to the size select element
      $("#sizeSelect").on("change", function () {
        // Get the selected size value
        var selectedSize = parseInt($(this).val());

        // You can define an object containing the size and their corresponding price
        // This can be obtained from the PHP code or any other source of data
        var sizePriceMap = {
          <?php foreach ($size as $s) { ?>
                            <?php echo $s["size"]; ?>: <?php echo $s["increase_size"]; ?>,
          <?php } ?>
        };

        // Update the displayed price based on the selected size
        if (!isNaN(selectedSize) && sizePriceMap.hasOwnProperty(selectedSize)) {
          var newPrice = sizePriceMap[selectedSize];
          $("#displayedPrice").text(newPrice);
        } else {
          // If the selected size is not found in the sizePriceMap, you can handle it accordingly
          $("#displayedPrice").text("N/A");
        }
      });
    });
  </script>
  <script src="../public/frontend/js/product_page.js"></script>
  </div>
</body>

</html>