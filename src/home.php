<?php
require_once('connect/connectDB.php');
require_once('handles_page/handle_display.php');
require_once('handles_page/handle_calculate.php');

$arraySale = [];

$product = executeResult("SELECT * FROM tb_products where deleted = 0 ORDER BY product_id DESC ");
$sale = executeResult("SELECT * FROM tb_sale");
$cate = executeResult("SELECT c.cate_id, c.cate_name, SUM(p.view) AS total_views 
                        FROM tb_category c
                        INNER JOIN tb_products p 
                        ON c.cate_id = p.cate_id 
                        GROUP BY c.cate_name
                        ORDER BY total_views DESC,
                        RAND() LIMIT 4
                        ");
$countCate = count($cate);

foreach ($sale as $key => $s) {
  $arraySale[$key] = $s["product_id"];
}

// var_dump($cate);
// die();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>
    Bánh Sinh Nhật | Bánh Trung Thu | Thu Hương Bakery Since 1996</title>
  <meta name="description" content="Thu Hương Bakery ra đời từ năm 1996, trong suốt hơn 25 năm hình thành và phát triển, với sự nỗ lực không ngừng nghỉ Thu Hương Bakery đã mang lại những dấu ấn khó phai trong lòng người dân Thủ Đô.">
  <meta name="keywords" content="Bánh Sinh Nhật, Bánh Trung Thu, Quà Trung Thu, Thu Hương Bakery Since 1996">
  <!-- Favicon -->
  <link rel="apple-touch-icon" href="source/icon/logo website2.png">
  <link rel="icon" type="image/png" href="source/icon/logo website2.png">
  <link rel="icon" type="image/png" href="source/icon/logo website2.png">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />

  <!-- Favicon -->

  <!-- FONT -->
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Cabin" />
  <!-- FONT -->

  <!-- PLUGIN CSS -->
  <link rel="stylesheet" href="../public/frontend/css/librarys_css/css/bootstrap4.min.css">
  <link rel="stylesheet" href="../public/frontend/css/librarys_css/css/owl.carousel.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css">
  <link rel="stylesheet" href="../public/frontend/css/lightslider.css">
  <!-- <link rel="stylesheet" href="ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css"> -->


  <!-- PLUGIN CSS -->

  <link href="../public/frontend/css/style.css" rel="stylesheet">
  <!-- Meta Pixel Code -->
  <script>
    ! function(f, b, e, v, n, t, s) {
      if (f.fbq) return;
      n = f.fbq = function() {
        n.callMethod ?
          n.callMethod.apply(n, arguments) : n.queue.push(arguments)
      };
      if (!f._fbq) f._fbq = n;
      n.push = n;
      n.loaded = !0;
      n.version = '2.0';
      n.queue = [];
      t = b.createElement(e);
      t.async = !0;
      t.src = v;
      s = b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t, s)
    }(window, document, 'script',
      'en_US/fbevents.js');
    fbq('init', '1913464958707044');
    fbq('track', 'PageView');
  </script>
  <noscript><img height="1" width="1" style="display:none" src="tr?id=1913464958707044&ev=PageView&noscript=1" /></noscript>
  <!-- End Meta Pixel Code -->

  <!-- Google tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-232235704-1">
  </script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-232235704-1');
  </script><!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-QERL8JJ8K1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-QERL8JJ8K1');
  </script>

  <style>
    .secction-banner {
      max-width: 1110px;
      max-height: 380px;
      margin: auto;
      padding: 20px;
      display: flex;
      gap: 0.8rem;
    }

    .secction-banner .main-carousel {
      width: 68%;
    }

    .product-images img,
    .banner-item img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      vertical-align: middle;
      object-position: center;
    }

    .secction-banner .banner-right {
      width: 32%;
      max-height: 380px;
    }

    .secction-banner .banner-wapper {
      width: 100%;
      height: 100%;
    }

    .secction-banner .banner-item {
      width: 100%;
      height: 48.5%;
      margin-top: 1%;
      border-radius: 5px;
      border: 1px solid #e5e5e5;
      overflow: hidden;
    }
  </style>
</head>

<body>
  <?php include("layout/header.php"); ?>
  <section class="secction-banner">
    <div class="owl-carousel-banner owl-carousel main-carousel">
      <div class="image_banner">
        <a href="product.php?get=1">
          <img src="../public/images/banners/z4458312751966_a4d358f764972b5361362862171e3f08.jpg" alt="" style="object-fit: cover;">
        </a>
      </div>
      <div class="image_banner">
        <a href="">
          <img src="../public/images/banners/z4458312754662_72b2be1941aad2d112c26116336a6582.jpg" alt="" style="object-fit: cover;">
        </a>
      </div>
    </div>
    <div class="banner-right">
      <div class="banner-wapper">
        <div class="banner-item">
          <img src="../public/images/banners/z4458312751966_a4d358f764972b5361362862171e3f08.jpg" alt="" style="object-fit: cover;">
        </div>
        <div class="banner-item">
          <img src="../public/images/banners/z4458312751966_a4d358f764972b5361362862171e3f08.jpg" alt="" style="object-fit: cover;">
        </div>
      </div>
    </div>
  </section>
  <section class="section-paddingY middle-section home-latest-products mt-5">
    <div class="container">
      <div class="section-header">
        <p class="section-title" id="currentMonth"></p>
      </div>
      <div class="section-body">
        <div class="owl-carousel-products owl-carousel owl-theme">
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
        </div>
      </div>
    </div>
  </section>

  <section class="section-paddingY middlw-section home-latest-products mt-5">
    <div class="container">
      <div class="section-header">
        <a class="hover-yellow" href="danh-muc/banh-sinh-nhat">
          <span class="section-title">
            <img src="source/icon/nhandien.png" alt="B&aacute;nh Sinh Nhật">
            B&aacute;nh Sinh Nhật
          </span>
        </a>
      </div>
      <div class="section-body">
        <div class="tab-content row" id="pills-tabContent">
          <div class="tab-pane fade show active col-md-9" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <!-- <div class="row">
              <div class="col-md-12"> -->
            <div class="row">

              <?php foreach ($product as $p) { ?>
                <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                  <div class="one-product-container">
                    <div class="product-images">
                      <div class="product-image hover-animation" href="san-pham/opera-cake-27">
                        <img src=<?php echo $p["image"] ?> alt="Opera Cake " />
                        <img src=<?php echo $p["image"] ?> alt="Opera Cake " />
                      </div>
                      <?php if (in_array($p["product_id"], $arraySale)) { ?>
                        <div class="product-discount">
                          <span class="text">-
                            <?php foreach ($sale as $s) {
                              if ($p["product_id"] == $s["product_id"]) {
                                echo ($s["percent_sale"]);
                                break;
                              }
                            } ?> %</span>
                        </div>
                      <?php } ?>
                      <div class="box-actions-hover">
                        <button><a href="product.php?id=<?= $p["product_id"] ?>"><span class="material-symbols-sharp">visibility</span></a></button>
                        <button><span class="material-symbols-sharp">add_shopping_cart</span></button>
                      </div>
                    </div>
                    <div class="product-info">
                      <p class="product-name">
                        <a href="#/">
                          <?php echo $p["product_name"] ?>
                        </a>
                      </p>
                      <div class="product-price">
                        <?php if (in_array($p["product_id"], $arraySale)) { ?>
                          <span class="price">
                            <?php foreach ($sale as $s) {
                              if ($p["product_id"] == $s["product_id"]) {
                                displayPrice(calculatePercentPrice($p["price"], $s["percent_sale"]));
                                break;
                              }
                            } ?> vnđ</span>
                          <span class="price-del"><?php displayPrice($p["price"]) ?> vnđ</span>
                        <?php } else { ?>
                          <span class="price"><?php displayPrice($p["price"]) ?> vnđ</span>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
              <?php } ?>

            </div>
            <div class="see-more">
              <a href="danh-muc/banh-sinh-nhat">Xem thêm</a>
            </div>
          </div>
          <!-- </div>
          </div> -->
          <div class="col-md-3 pl-1 pr-1">
            <div class="banner-product">
              <img src="public/images/banners/z4458312751966_a4d358f764972b5361362862171e3f08.jpg" alt="banner sản phẩm" class="img-fluid">
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="section-paddingY middlw-section home-latest-products mt-5">
    <div class="container">
      <div class="section-header">
        <a class="hover-yellow" href="danh-muc/banh-sinh-nhat-cho-be">
          <span class="section-title">
            <img src="source/icon/nhandien.png" alt="B&aacute;nh Sinh Nhật Cho B&eacute;">
            <?= mb_strtoupper($cate[$countCate - 4]["cate_name"], 'UTF-8') ?>
          </span>
        </a>
      </div>
      <div class="section-body">
        <div class="tab-content row" id="pills-tabContent">
          <div class="col-md-3 pl-1 pr-1">
            <div class="banner-product">
              <a href="danh-muc/banh-sinh-nhat-cho-be">
                <img src="source/Banner danh muc san pham/Banh cho be yeu .png" alt="banner sản phẩm" class="img-fluid">
              </a>
            </div>
          </div>
          <div class="tab-pane fade show active col-md-9" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="row">
              <div class="col-md-12">
                <div class="row">
                  <!--  -->
                </div>
                <div class="see-more">
                  <a href="danh-muc/banh-sinh-nhat-cho-be">Xem
                    thêm</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="section-paddingY middlw-section home-latest-products mt-5">
    <div class="container">
      <div class="section-header">
        <a class="hover-yellow" href="danh-muc/cookies-va-mini-cake">
          <span class="section-title">
            <img src="source/icon/nhandien.png" alt="Cookies v&agrave; Mini Cake">
            <?= mb_strtoupper($cate[$countCate - 3]["cate_name"], 'UTF-8') ?>
          </span>
        </a>
      </div>
      <div class="section-body">
        <div class="tab-content row" id="pills-tabContent">
          <div class="tab-pane fade show active col-md-9" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="row">
              <div class="col-md-12">
                <div class="row">
                  <!--  -->
                </div>
                <div class="see-more">
                  <a href="danh-muc/cookies-va-mini-cake">Xem
                    thêm</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 pl-1 pr-1">
            <div class="banner-product">
              <a href="danh-muc/cookies-va-mini-cake">
                <img src="source/Banner danh muc san pham/croissant.png" alt="banner sản phẩm" class="img-fluid">
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="section-paddingY middlw-section home-latest-products mt-5">
    <div class="container">
      <div class="section-header">
        <a class="hover-yellow" href="danh-muc/banh-trung-thu">
          <span class="section-title">
            <img src="source/icon/nhandien.png" alt="B&aacute;nh trung thu">
            <?= mb_strtoupper($cate[$countCate - 2]["cate_name"], 'UTF-8') ?>
          </span>
        </a>
      </div>
      <div class="section-body">
        <div class="tab-content row" id="pills-tabContent">
          <div class="col-md-3 pl-1 pr-1">
            <div class="banner-product">
              <a href="danh-muc/banh-trung-thu">
                <img src="source/Banner danh muc san pham/banhtrungthuthuhuongbn.png" alt="banner sản phẩm" class="img-fluid">
              </a>
            </div>
          </div>
          <div class="tab-pane fade show active col-md-9" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="row">
              <div class="col-md-12">
                <div class="row">
                  <!--  -->
                </div>
                <div class="see-more">
                  <a href="danh-muc/banh-trung-thu">Xem
                    thêm</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="section-paddingY middlw-section home-latest-products mt-5">
    <div class="container">
      <div class="section-header">
        <a class="hover-yellow" href="danh-muc/cookies-va-mini-cake">
          <span class="section-title">
            <img src="source/icon/nhandien.png" alt="Cookies v&agrave; Mini Cake">
            <?= mb_strtoupper($cate[$countCate - 1]["cate_name"], 'UTF-8') ?>
          </span>
        </a>
      </div>
      <div class="section-body">
        <div class="tab-content row" id="pills-tabContent">
          <div class="tab-pane fade show active col-md-9" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="row">
              <div class="col-md-12">
                <div class="row">
                  <!--  -->
                </div>
                <div class="see-more">
                  <a href="danh-muc/cookies-va-mini-cake">Xem
                    thêm</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 pl-1 pr-1">
            <div class="banner-product">
              <a href="danh-muc/cookies-va-mini-cake">
                <img src="source/Banner danh muc san pham/croissant.png" alt="banner sản phẩm" class="img-fluid">
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section-paddingY middle-section home-latest-products mt-5">
    <div class="container">
      <div class="section-header">
        <p class="section-title">Tin tức sự kiện</p>
      </div>
      <div class="section-body">
        <div class="owl-carousel-news owl-carousel owl-theme">
          <div class="article-column-container">
            <div class="article-image">
              <a class="product-image hover-animation" href="tin-tuc/banh-giang-sinh-banh-noel-2022-giang-sinh-ngot-ngao-9">
                <img src="source/banh noel 2022/tin 1a.jpg" alt="">
              </a>
              <span class="name-category">Tin tức</span>
            </div>
            <div class="article-info">
              <p class="article-title">
                <a href="tin-tuc/banh-giang-sinh-banh-noel-2022-giang-sinh-ngot-ngao-9">B&aacute;nh Gi&aacute;ng Sinh
                  (B&aacute;nh Noel) 2022, Gi&aacute;ng Sinh Ngọt Ng&agrave;o</a>
              </p>
              <p class="article-description">Gi&aacute;ng Sinh đang về&hellip; Merry Christmas ❤️❤️
                Gi&aacute;ng sinh l&agrave; thời gian để d&agrave;nh cho gia đ&igrave;nh, bạn b&egrave; v&agrave;
                những Người y&ecirc;u thương... </p>
            </div>
          </div>
          <div class="article-column-container">
            <div class="article-image">
              <a class="product-image hover-animation" href="tin-tuc/banh-kem-2010-top-nhung-mau-banh-duoc-ua-thich-nhat-2022-8">
                <img src="source/TinTuc/1ahoa.png" alt="">
              </a>
              <span class="name-category">Tin tức</span>
            </div>
            <div class="article-info">
              <p class="article-title">
                <a href="tin-tuc/banh-kem-2010-top-nhung-mau-banh-duoc-ua-thich-nhat-2022-8">B&aacute;nh Kem 20/10 top
                  những mẫu b&aacute;nh được ưa th&iacute;ch nhất 2022</a>
              </p>
              <p class="article-description">Những mẫu b&aacute;nh kem 20/10 với những điểm nhấn ấn tượng sẽ l&agrave;
                m&oacute;n qu&agrave; v&ocirc; c&ugrave;ng &yacute; nghĩa để d&agrave;nh tặng cho những người phụ nữ
                Việt Nam nh&acirc;n ng&agrave;y lễ đặc biệt&#8230;</p>
            </div>
          </div>
          <div class="article-column-container">
            <div class="article-image">
              <a class="product-image hover-animation" href="tin-tuc/banh-trung-thu-thu-huong-bakery-since-1996-7">
                <img src="source/TinTuc/B&aacute;nh Trung Thu tin.jpg" alt="">
              </a>
              <span class="name-category">Tin tức</span>
            </div>
            <div class="article-info">
              <p class="article-title">
                <a href="tin-tuc/banh-trung-thu-thu-huong-bakery-since-1996-7">B&aacute;nh Trung Thu Thu Hương Bakery
                  Since 1996</a>
              </p>
              <p class="article-description">Gia đ&igrave;nh ch&iacute;nh l&agrave; nguồn cảm hứng s&aacute;ng tạo
                v&agrave; phục vụ lớn nhất m&agrave; to&agrave;n thể c&aacute;c thợ b&aacute;nh, phụ bếp, hậu cần
                c&ugrave;ng l&atilde;nh đạo của thương hiệu được hữu duy&ecirc;n&#8230;</p>
            </div>
          </div>
          <div class="article-column-container">
            <div class="article-image">
              <a class="product-image hover-animation" href="tin-tuc/bo-suu-tap-banh-trung-thu-2022-6">
                <img src="source/TinTuc/puppets-1.jpg" alt="">
              </a>
              <span class="name-category">Tin tức</span>
            </div>
            <div class="article-info">
              <p class="article-title">
                <a href="tin-tuc/bo-suu-tap-banh-trung-thu-2022-6">bộ sưu tập b&aacute;nh trung thu 2022</a>
              </p>
              <p class="article-description">K&Yacute; ỨC TRĂNG TR&Ograve;N &ndash; MONG ƯỚC ĐO&Agrave;N VI&Ecirc;N
                Tết Trung Thu l&agrave; một trong những ng&agrave;y tết trọng đại của d&acirc;n tộc Việt Nam v&agrave;
                l&agrave; dịp gia đ&igrave;nh qu&acirc;y quần đo&agrave;n tụ c&ugrave;ng&#8230;</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="section-paddingY middle-section mt-5">
    <div class="container">
      <div class="section-body">
        <div class="dangky-form row">
          <div class="col-left col-md-6">
            <span class="title">Liên hệ</span> <br>
            Tự hào là 1 trong những Brand uy tín gần 30 năm tại Hà Nội. Thu Hương Bakery đã và luôn đồng hành cung cấp
            sản phẩm cho các Brand lớn trong ngành dịch vụ ( Chuỗi Coffee, Nhà hàng, Khách sạn, Sự kiện...) Với đầy đủ
            các sản phẩm phong phú và đa dạng từ Bánh Mì, Bánh Tươi, Cookies, Bánh Gato , Bánh Mousse...
            Thu Hương Bakery hân hạnh được hợp tác !
            <p>
              <img src="public/frontend/assets/img/icons/phone-dangky.png" alt="phone">
              090 754 6668 | 096 938 6611
            </p>
            <p>
              <img src="public/frontend/assets/img/icons/mail-dangky.png" alt="email">
              sales@thuhuongbakery.com.vn
            </p>
            <p>
              <img src="public/frontend/assets/img/icons/thoigian.png" alt="working">
              Từ Thứ 2 đến Chủ Nhật | 07:30 - 21:00
            </p>
            <p class="icon-social">
              <img src="public/frontend/assets/img/icons/Facebook.png" alt="">
              <img src="public/frontend/assets/img/icons/Twitter.png" alt="">
              <img src="public/frontend/assets/img/icons/Instagram.png" alt="">
              <img src="public/frontend/assets/img/icons/youtube.png" alt="">
            </p>
          </div>
          <div class="col-right col-md-6">
            <form action="dang-ky-kinh-doanh" class="form-horizontal create-product-form jquery-form-submit" method="post" accept-charset="utf-8">
              <input type="hidden" name="csrf_test_name" value="5aebea1cd557f3d54d81422aee55ee0b" />
              <div class="form-group">
                <input type="hidden" name="link" value="">
                <label for="">Họ và tên</label>
                <input type="text" class="form-control" name="fullname" placeholder="Nhập họ và tên">
              </div>
              <div class="form-group">
                <label for="">Số điện thoại</label>
                <input type="text" class="form-control" name="phone" placeholder="Nhập số điện thoại">
              </div>
              <div class="form-group">
                <label for="">Mô hình kinh doanh</label>
                <input type="text" class="form-control" name="type_bussines" placeholder="Khách sạn, nhà hàng, chuỗi cafe…">
              </div>
              <div class="form-group">
                <label for="">Địa chỉ email</label>
                <input type="text" class="form-control" name="email" placeholder="Nhập đỉa chỉ email">
              </div>
              <div class="form-group button-save">
                <button type="submit" class="btn btn-save-kinhdoanh">
                  Gửi đăng ký nhận báo giá
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php include("layout/footer.php"); ?>


  <div id="fb-root"></div>
  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v17.0" nonce="T1W405h4"></script>
  <div class='zalome'>
    <a href='#' target='_blank'>
      <img alt='icon zalo' src='public/frontend/assets/img/icons/icon-zalo.png' />
    </a>
  </div>
  <script>
    (function(d, s, id) {
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
    window.fbAsyncInit = function() {
      FB.init({
        xfbml: true,
        version: 'v16.0'
      });
    };

    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s);
      js.id = id;
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