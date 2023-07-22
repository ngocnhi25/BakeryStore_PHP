<?php
  require_once("connect/connectDB.php");
  $sanpham = executeResult("SELECT * from tb_products");
  $cate = executeResult("SELECT * FROM tb_category");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>
    Bánh Sinh Nhật - Bánh Sinh Nhật Thu Hương Bakery since 1996</title>
  <meta name="description" content="Bánh Sinh Nhật, Bánh Sinh Nhật Thu Hương Bakery since 1996">
  <meta name="keywords" content="Bánh Sinh Nhật, Bánh Sinh Nhật Thu Hương Bakery since 1996">
  <!-- Favicon -->
  <link rel="apple-touch-icon" href="source/icon/logo website2.png">
  <link rel="icon" type="image/png" href="source/icon/logo website2.png">
  <link rel="icon" type="image/png" href="source/icon/logo website2.png">

  <meta property="og:title" content="Bánh Sinh Nhật - Bánh Sinh Nhật Thu Hương Bakery since 1996" />
  <meta property="og:site_name" content="BÁNH SINH NHẬT | BÁNH TRUNG THU | BÁNH SỰ KIỆN | HỘP QUÀ TRUNG THU" />
  <meta property="og:description" content="Bánh Sinh Nhật, Bánh Sinh Nhật Thu Hương Bakery since 1996" />
  <meta property="og:url" content="" />
  <meta property="og:image" content="source/hinh-anh/logo/logo.png" />
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:site" content="Bánh Sinh Nhật - Bánh Sinh Nhật Thu Hương Bakery since 1996" />
  <meta name="twitter:title" content="Bánh Sinh Nhật - Bánh Sinh Nhật Thu Hương Bakery since 1996" />
  <meta name="twitter:description" content="Bánh Sinh Nhật, Bánh Sinh Nhật Thu Hương Bakery since 1996" />
  <meta name="twitter:image" content="source/hinh-anh/logo/logo.png" />

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
              <a href="#" itemprop="item">
                <span itemprop="name">B&aacute;nh Sinh Nhật</span>
                <meta itemprop="position" content="2" />
              </a>
            </li>
          </ol>
        </nav>
      </div>
    </div>

    <section class="section-paddingY product-collection has-loader">

      <div class="section-loader">
        <i class="fas fa-spinner fa-5x fa-pulse"></i>
      </div>
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
                  <?php foreach($cate as $c) { ?>
                  <li class="item-nav">
                    <a href="danh-muc/gato-kem-tuoi">
                      <?php echo $c["cate_name"] ?>
                    </a>
                  </li>
                  <?php } ?>
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
            <div class="section-header">
              <p class="section-title">B&aacute;nh Sinh Nhật</p>
              <input type="hidden" name="cate_id" value="1">
            </div>
            <div class="section-body">
              <div class="row">
                <?php foreach($sanpham as $sp) { ?>
                <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                  <div class="one-product-container">

                    <div class="product-images">
                      <a class="product-image hover-animation" href="san-pham/valentine-cake-006-74">
                        <img src=<?php echo $sp["image"] ?> alt="Valentine cake 006" />
                        <img src=<?php echo $sp["image"] ?> alt="Valentine cake 006" />
                      </a>
                    </div>
                    <div class="product-info">
                      <p class="product-name">
                        <a href="#/">
                          <?php echo $sp["product_name"] ?>
                        </a>
                      </p>
                      <div class="product-price">

                        <span class="price"><?php echo $sp["price"] ?></span>
                      </div>
                    </div>
                  </div>
                </div>
                <?php } ?>
              </div>
            </div>
            <div class="section-bottom has-pagination">
              <div class="website-pagination">

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <?php include("layout/footer.php") ?>

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



    <script src="public/frontend/assets/js/main.js?v=1.0.8"></script>
    <script src="public/myplugins/js/messagebox.js"></script>

  </div>
</body>

</html>