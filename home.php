<?php

require_once('backend/connect/connectDB.php');
$product = executeResult("SELECT * FROM tb_products");

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>
    Bánh Sinh Nhật | Bánh Trung Thu | Thu Hương Bakery Since 1996</title>
  <meta name="description"
    content="Thu Hương Bakery ra đời từ năm 1996, trong suốt hơn 25 năm hình thành và phát triển, với sự nỗ lực không ngừng nghỉ Thu Hương Bakery đã mang lại những dấu ấn khó phai trong lòng người dân Thủ Đô.">
  <meta name="keywords" content="Bánh Sinh Nhật, Bánh Trung Thu, Quà Trung Thu, Thu Hương Bakery Since 1996">
  <!-- Favicon -->
  <link rel="apple-touch-icon" href="source/icon/logo website2.png">
  <link rel="icon" type="image/png" href="source/icon/logo website2.png">
  <link rel="icon" type="image/png" href="source/icon/logo website2.png">

  <meta property="og:title" content="Bánh Sinh Nhật | Bánh Trung Thu | Thu Hương Bakery Since 1996" />
  <meta property="og:site_name" content="BÁNH SINH NHẬT | BÁNH TRUNG THU | BÁNH SỰ KIỆN | HỘP QUÀ TRUNG THU" />
  <meta property="og:description"
    content="Thu Hương Bakery ra đời từ năm 1996, trong suốt hơn 25 năm hình thành và phát triển, với sự nỗ lực không ngừng nghỉ Thu Hương Bakery đã mang lại những dấu ấn khó phai trong lòng người dân Thủ Đô." />
  <meta property="og:url" content="" />
  <meta property="og:image" content="source/hinh-anh/logo/logo.png" />
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:site" content="Bánh Sinh Nhật | Bánh Trung Thu | Thu Hương Bakery Since 1996" />
  <meta name="twitter:title" content="Bánh Sinh Nhật | Bánh Trung Thu | Thu Hương Bakery Since 1996" />
  <meta name="twitter:description"
    content="Thu Hương Bakery ra đời từ năm 1996, trong suốt hơn 25 năm hình thành và phát triển, với sự nỗ lực không ngừng nghỉ Thu Hương Bakery đã mang lại những dấu ấn khó phai trong lòng người dân Thủ Đô." />
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
    <div class="owl-carousel main-carousel">
    <div>
      <a href="">
        <img src="public/frontend/assets/img/banner/banner1.jpg" alt="">
      </a>
    </div>
    <div>
      <a href="">
        <img src="public/frontend/assets/img/banner/banner1.jpg" alt="">
      </a>
    </div>
  </div>


    <section class="section-paddingY middle-section home-latest-products mt-5">
      <div class="container">
        <div class="section-header">
          <p class="section-title">Sản phẩm nổi bật</p>
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
            <div class="one-product-container">

              <div class="product-images">
                <a class="product-image hover-animation" href="san-pham/mousse-chanh-leo-5.html">
                  <img src="source/B&aacute;nh Sinh Nhật THB/Banh Sinh Nhat 003.jpg" alt="Mousse Chanh Leo" />
                  <img src="source/B&aacute;nh Sinh Nhật THB/Banh Sinh Nhat 003.jpg" alt="Mousse Chanh Leo" />
                </a>
              </div>
              <div class="product-info">
                <p class="product-name">
                  <a href="#/">
                    Mousse Chanh Leo
                  </a>
                </p>
                <div class="product-price">

                  <span class="price">380,000&#8363;</span>
                </div>
              </div>
            </div>
            <div class="one-product-container">

              <div class="product-images">
                <a class="product-image hover-animation" href="san-pham/valentine-cake-002-72">
                  <img src="source/Banh sự kiện/banhvalentine002.jpg" alt="Valentine cake 002" />
                  <img src="source/Banh sự kiện/banhvalentine002.jpg" alt="Valentine cake 002" />
                </a>
              </div>
              <div class="product-info">
                <p class="product-name">
                  <a href="#/">
                    Valentine cake 002
                  </a>
                </p>
                <div class="product-price">

                  <span class="price">Liên hệ</span>
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
            <div class="one-product-container">

              <div class="product-images">
                <a class="product-image hover-animation" href="san-pham/valentine-cake-003-73">
                  <img src="source/Banh sự kiện/valentine 003.jpg" alt="Valentine cake 003" />
                  <img src="source/Banh sự kiện/valentine 003.jpg" alt="Valentine cake 003" />
                </a>
              </div>
              <div class="product-info">
                <p class="product-name">
                  <a href="#/">
                    Valentine cake 003
                  </a>
                </p>
                <div class="product-price">

                  <span class="price">Liên hệ</span>
                </div>
              </div>
            </div>
            <div class="one-product-container">

              <div class="product-images">
                <a class="product-image hover-animation" href="san-pham/banh-tiramisu-7">
                  <img src="source/B&aacute;nh Sinh Nhật THB/Banh Sinh Nhat 011.jpg" alt="B&aacute;nh Tiramisu " />
                  <img src="source/B&aacute;nh Sinh Nhật THB/Banh Sinh Nhat 011.jpg" alt="B&aacute;nh Tiramisu " />
                </a>
              </div>
              <div class="product-info">
                <p class="product-name">
                  <a href="#/">
                    B&aacute;nh Tiramisu
                  </a>
                </p>
                <div class="product-price">

                  <span class="price">320,000&#8363;</span>
                </div>
              </div>
            </div>
            <div class="one-product-container">

              <div class="product-images">
                <a class="product-image hover-animation" href="san-pham/fresh-cream-cake-001-43">
                  <img src="source/B&aacute;nh Sinh Nhật THB/kembo 007.jpg" alt="Fresh Cream Cake 001" />
                  <img src="source/B&aacute;nh Sinh Nhật THB/kembo 007.jpg" alt="Fresh Cream Cake 001" />
                </a>
              </div>
              <div class="product-info">
                <p class="product-name">
                  <a href="#/">
                    Fresh Cream Cake 001
                  </a>
                </p>
                <div class="product-price">

                  <span class="price">320,000&#8363;</span>
                </div>
              </div>
            </div>
            <div class="one-product-container">

              <div class="product-images">
                <a class="product-image hover-animation" href="san-pham/tiger-cake-baby-01a-12">
                  <img src="source/b&aacute;nh cho b&eacute;/banh cham con ho.jpg" alt="Tiger Cake Baby 01A" />
                  <img src="source/b&aacute;nh cho b&eacute;/banh cham con ho.jpg" alt="Tiger Cake Baby 01A" />
                </a>
              </div>
              <div class="product-info">
                <p class="product-name">
                  <a href="#/">
                    Tiger Cake Baby 01A
                  </a>
                </p>
                <div class="product-price">

                  <span class="price">380,000&#8363;</span>
                </div>
              </div>
            </div>
            <div class="one-product-container">

              <div class="product-images">
                <a class="product-image hover-animation" href="san-pham/banh-sinh-nhat-so-2-18">
                  <img src="source/b&aacute;nh cho b&eacute;/banh sinh nhat hinh so2.jpg"
                    alt="B&aacute;nh Sinh Nhật Số 2" />
                  <img src="source/b&aacute;nh cho b&eacute;/banh sinh nhat hinh so2.jpg"
                    alt="B&aacute;nh Sinh Nhật Số 2" />
                </a>
              </div>
              <div class="product-info">
                <p class="product-name">
                  <a href="#/">
                    B&aacute;nh Sinh Nhật Số 2
                  </a>
                </p>
                <div class="product-price">

                  <span class="price">520,000&#8363;</span>
                </div>
              </div>
            </div>
            <div class="one-product-container">

              <div class="product-images">
                <a class="product-image hover-animation" href="san-pham/banh-sinh-nhat-chu-khi-19">
                  <img src="source/b&aacute;nh cho b&eacute;/banh con khi.jpg"
                    alt="B&aacute;nh sinh nhật ch&uacute; Khỉ" />
                  <img src="source/b&aacute;nh cho b&eacute;/banh con khi.jpg"
                    alt="B&aacute;nh sinh nhật ch&uacute; Khỉ" />
                </a>
              </div>
              <div class="product-info">
                <p class="product-name">
                  <a href="#/">
                    B&aacute;nh sinh nhật ch&uacute; Khỉ
                  </a>
                </p>
                <div class="product-price">

                  <span class="price">380,000&#8363;</span>
                </div>
              </div>
            </div>
            <div class="one-product-container">

              <div class="product-images">
                <a class="product-image hover-animation" href="san-pham/baby-cake-st01-25">
                  <img src="source/b&aacute;nh cho b&eacute;/banchobeA002.jpg" alt="Baby Cake ST01" />
                  <img src="source/b&aacute;nh cho b&eacute;/banchobeA002.jpg" alt="Baby Cake ST01" />
                </a>
              </div>
              <div class="product-info">
                <p class="product-name">
                  <a href="#/">
                    Baby Cake ST01
                  </a>
                </p>
                <div class="product-price">

                  <span class="price">520,000&#8363;</span>
                </div>
              </div>
            </div>
            <div class="one-product-container">

              <div class="product-images">
                <a class="product-image hover-animation" href="san-pham/fresh-spring-cake-44">
                  <img src="source/B&aacute;nh Sinh Nhật THB/kembo 008.jpg" alt="Fresh Spring Cake" />
                  <img src="source/B&aacute;nh Sinh Nhật THB/kembo 008.jpg" alt="Fresh Spring Cake" />
                </a>
              </div>
              <div class="product-info">
                <p class="product-name">
                  <a href="#/">
                    Fresh Spring Cake
                  </a>
                </p>
                <div class="product-price">

                  <span class="price">320,000&#8363;</span>
                </div>
              </div>
            </div>
            <div class="one-product-container">

              <div class="product-images">
                <a class="product-image hover-animation" href="san-pham/mousse-tra-xanh-63">
                  <img src="source/Banh entremet/Banh Sinh Nhat 016.jpg" alt="Mousse Tr&agrave; Xanh" />
                  <img src="source/Banh entremet/Banh Sinh Nhat 016.jpg" alt="Mousse Tr&agrave; Xanh" />
                </a>
              </div>
              <div class="product-info">
                <p class="product-name">
                  <a href="#/">
                    Mousse Tr&agrave; Xanh
                  </a>
                </p>
                <div class="product-price">

                  <span class="price">190,000&#8363;</span>
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
          <ul class="nav nav-pills mb-3 tabs-categories" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="pills-home-tab-left" data-toggle="pill" href="#pills-home" role="tab"
                aria-controls="pills-home" aria-selected="true">Tất cả</a>
            </li>
            <li class="nav-item" title="Gato kem tươi">
              <a class="nav-link" title="Gato kem tươi" href="danh-muc/gato-kem-tuoi">
                Gato kem tươi
              </a>
            </li>
            <li class="nav-item" title="Gato kem bơ">
              <a class="nav-link" title="Gato kem bơ" href="danh-muc/gato-kem-bo">
                Gato kem bơ
              </a>
            </li>
            <li class="nav-item" title="B&aacute;nh mousse">
              <a class="nav-link" title="B&aacute;nh mousse" href="danh-muc/banh-mousse">
                B&aacute;nh mousse
              </a>
            </li>
            <li class="nav-item" title="B&aacute;nh cưới">
              <a class="nav-link" title="B&aacute;nh cưới" href="danh-muc/banh-cuoi">
                B&aacute;nh cưới
              </a>
            </li>
            <li class="nav-item" title="B&aacute;nh valentine">
              <a class="nav-link" title="B&aacute;nh valentine" href="danh-muc/banh-valentine">
                B&aacute;nh valentine
              </a>
            </li>
            <li class="nav-item" title="B&aacute;nh sự kiện">
              <a class="nav-link" title="B&aacute;nh sự kiện" href="danh-muc/banh-su-kien">
                B&aacute;nh sự kiện
              </a>
            </li>
            <li class="nav-item" title="B&aacute;nh Entremet">
              <a class="nav-link" title="B&aacute;nh Entremet" href="danh-muc/banh-entremet">
                B&aacute;nh Entremet
              </a>
            </li>
          </ul>
          <div class="tab-content row" id="pills-tabContent">
            <div class="tab-pane fade show active col-md-9" id="pills-home" role="tabpanel"
              aria-labelledby="pills-home-tab">
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    
                  <?php foreach ($product as $p) { ?>
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/opera-cake-27">
                            <img src=<?php echo $p["image"] ?> alt="Opera Cake " />
                            <img src=<?php echo $p["image"] ?> alt="Opera Cake " />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              <?php echo $p["product_name"] ?>
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price"><?php echo $p["price"]?></span>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                    
                    
                    
                    
                    
                    
                  </div>
                  <div class="see-more">
                    <a href="danh-muc/banh-sinh-nhat">Xem
                      thêm</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade col-md-9" id="gato-kem-tuoi" role="tabpanel" aria-labelledby="gato-kem-tuoi-tab">
              <div class="row">
                <div class="col-md-12">
                  <div class="row">

                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
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
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/banh-tiramisu-7">
                            <img src="source/B&aacute;nh Sinh Nhật THB/Banh Sinh Nhat 011.jpg"
                              alt="B&aacute;nh Tiramisu " />
                            <img src="source/B&aacute;nh Sinh Nhật THB/Banh Sinh Nhat 011.jpg"
                              alt="B&aacute;nh Tiramisu " />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              B&aacute;nh Tiramisu
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">320,000&#8363;</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/fresh-cream-cake-001-43">
                            <img src="source/B&aacute;nh Sinh Nhật THB/kembo 007.jpg" alt="Fresh Cream Cake 001" />
                            <img src="source/B&aacute;nh Sinh Nhật THB/kembo 007.jpg" alt="Fresh Cream Cake 001" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              Fresh Cream Cake 001
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">320,000&#8363;</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/fresh-flower-cake-8">
                            <img src="source/B&aacute;nh Sinh Nhật THB/Banh Sinh Nhat 006.jpg"
                              alt="Fresh Flower Cake" />
                            <img src="source/B&aacute;nh Sinh Nhật THB/Banh Sinh Nhat 006.jpg"
                              alt="Fresh Flower Cake" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              Fresh Flower Cake
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">320,000&#8363;</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/cream-cake-with-spring-9">
                            <img src="source/B&aacute;nh Sinh Nhật THB/kembo 002.jpg" alt="Cream cake with Spring" />
                            <img src="source/B&aacute;nh Sinh Nhật THB/kembo 002.jpg" alt="Cream cake with Spring" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              Cream cake with Spring
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">320,000&#8363;</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/birthday-cake-cream-fruit-11">
                            <img src="source/B&aacute;nh Sinh Nhật/Banh Sinh Nhat 012.jpg"
                              alt="Birthday Cake Cream Fruit" />
                            <img src="source/B&aacute;nh Sinh Nhật/Banh Sinh Nhat 012.jpg"
                              alt="Birthday Cake Cream Fruit" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              Birthday Cake Cream Fruit
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">320,000&#8363;</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="see-more">
                    <a href="danh-muc/gato-kem-tuoi">Xem
                      thêm</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade col-md-9" id="gato-kem-bo" role="tabpanel" aria-labelledby="gato-kem-bo-tab">
              <div class="row">
                <div class="col-md-12">
                  <div class="row">

                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
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
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
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
                    </div>
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/banana-cream-cake-10">
                            <img src="source/B&aacute;nh Sinh Nhật/kembo 001.jpg" alt="Banana Cream Cake" />
                            <img src="source/B&aacute;nh Sinh Nhật/kembo 001.jpg" alt="Banana Cream Cake" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              Banana Cream Cake
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">340,000&#8363;</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/red-velvet-cake-40">
                            <img src="source/B&aacute;nh Sinh Nhật/kembo 006a.jpg" alt="Red Velvet Cake " />
                            <img src="source/B&aacute;nh Sinh Nhật/kembo 006a.jpg" alt="Red Velvet Cake " />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              Red Velvet Cake
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">380,000&#8363;</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade col-md-9" id="banh-mousse" role="tabpanel" aria-labelledby="banh-mousse-tab">
              <div class="row">
                <div class="col-md-12">
                  <div class="row">

                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/mousse-chanh-leo-5">
                            <img src="source/B&aacute;nh Sinh Nhật THB/Banh Sinh Nhat 003.jpg" alt="Mousse Chanh Leo" />
                            <img src="source/B&aacute;nh Sinh Nhật THB/Banh Sinh Nhat 003.jpg" alt="Mousse Chanh Leo" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              Mousse Chanh Leo
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">380,000&#8363;</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/mousse-hawaii-23">
                            <img src="source/Mousse/Banh Sinh Nhat 013.jpg" alt="Mousse Hawaii" />
                            <img src="source/Mousse/Banh Sinh Nhat 013.jpg" alt="Mousse Hawaii" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              Mousse Hawaii
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">320,000&#8363;</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/mousse-chocolate-62">
                            <img src="source/Banh entremet/Banh Sinh Nhat 015.jpg" alt="Mousse Chocolate" />
                            <img src="source/Banh entremet/Banh Sinh Nhat 015.jpg" alt="Mousse Chocolate" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              Mousse Chocolate
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">240,000&#8363;</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/mousse-tra-xanh-63">
                            <img src="source/Banh entremet/Banh Sinh Nhat 016.jpg" alt="Mousse Tr&agrave; Xanh" />
                            <img src="source/Banh entremet/Banh Sinh Nhat 016.jpg" alt="Mousse Tr&agrave; Xanh" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              Mousse Tr&agrave; Xanh
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">190,000&#8363;</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade col-md-9" id="banh-cuoi" role="tabpanel" aria-labelledby="banh-cuoi-tab">
              <div class="row">
                <div class="col-md-12">
                  <div class="row">

                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade col-md-9" id="banh-valentine" role="tabpanel"
              aria-labelledby="banh-valentine-tab">
              <div class="row">
                <div class="col-md-12">
                  <div class="row">

                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
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
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/valentine-cake-002-72">
                            <img src="source/Banh sự kiện/banhvalentine002.jpg" alt="Valentine cake 002" />
                            <img src="source/Banh sự kiện/banhvalentine002.jpg" alt="Valentine cake 002" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              Valentine cake 002
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">Liên hệ</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/valentine-cake-003-73">
                            <img src="source/Banh sự kiện/valentine 003.jpg" alt="Valentine cake 003" />
                            <img src="source/Banh sự kiện/valentine 003.jpg" alt="Valentine cake 003" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              Valentine cake 003
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">Liên hệ</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/valentine-cake-006-74">
                            <img src="source/Banh sự kiện/valentine 006.jpg" alt="Valentine cake 006" />
                            <img src="source/Banh sự kiện/valentine 006.jpg" alt="Valentine cake 006" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              Valentine cake 006
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">Liên hệ</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/valentine-cake-001-38">
                            <img src="source/Banh sự kiện/banh valentine 001.jpg" alt="Valentine cake 001" />
                            <img src="source/Banh sự kiện/banh valentine 001.jpg" alt="Valentine cake 001" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              Valentine cake 001
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
            <div class="tab-pane fade col-md-9" id="banh-su-kien" role="tabpanel" aria-labelledby="banh-su-kien-tab">
              <div class="row">
                <div class="col-md-12">
                  <div class="row">

                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/white-forest-cake-22">
                            <img src="source/Banh sự kiện/banh sk2.jpg" alt="White Forest Cake" />
                            <img src="source/Banh sự kiện/banh sk2.jpg" alt="White Forest Cake" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              White Forest Cake
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">520,000&#8363;</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/white-flower-cake-sk-31">
                            <img src="source/Banh sự kiện/banhsukien.jpg" alt="White Flower Cake SK" />
                            <img src="source/Banh sự kiện/banhsukien.jpg" alt="White Flower Cake SK" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              White Flower Cake SK
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">520,000&#8363;</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade col-md-9" id="banh-entremet" role="tabpanel" aria-labelledby="banh-entremet-tab">
              <div class="row">
                <div class="col-md-12">
                  <div class="row">

                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/brownie-caramel-almond-cheese-49">
                            <img src="source/Banh entremet/Entremet 005.jpg" alt="Brownie Caramel Almond Cheese" />
                            <img src="source/Banh entremet/Entremet 005.jpg" alt="Brownie Caramel Almond Cheese" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              Brownie Caramel Almond Cheese
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">290,000&#8363;</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3 pl-1 pr-1">
              <div class="banner-product">
                <a href="danh-muc/banh-sinh-nhat">
                  <img src="source/Banner danh muc san pham/b&aacute;nh sinh nhật3.png" alt="banner sản phẩm"
                    class="img-fluid">
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
          <a class="hover-yellow" href="danh-muc/banh-sinh-nhat-cho-be">
            <span class="section-title">
              <img src="source/icon/nhandien.png" alt="B&aacute;nh Sinh Nhật Cho B&eacute;">
              B&aacute;nh Sinh Nhật Cho B&eacute;
            </span>
          </a>
        </div>
        <div class="section-body">
          <ul class="nav nav-pills mb-3 tabs-categories" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="pills-home-tab-left" data-toggle="pill" href="#pills-home" role="tab"
                aria-controls="pills-home" aria-selected="true">Tất cả</a>
            </li>
            <li class="nav-item" title="B&aacute;nh h&igrave;nh số">
              <a class="nav-link" title="B&aacute;nh h&igrave;nh số" href="danh-muc/banh-hinh-so">
                B&aacute;nh h&igrave;nh số
              </a>
            </li>
            <li class="nav-item" title="B&aacute;nh 12 con gi&aacute;p">
              <a class="nav-link" title="B&aacute;nh 12 con gi&aacute;p" href="danh-muc/banh-12-con-giap">
                B&aacute;nh 12 con gi&aacute;p
              </a>
            </li>
            <li class="nav-item" title="B&aacute;nh s&aacute;ng tạo">
              <a class="nav-link" title="B&aacute;nh s&aacute;ng tạo" href="danh-muc/banh-sang-tao">
                B&aacute;nh s&aacute;ng tạo
              </a>
            </li>
          </ul>
          <div class="tab-content row" id="pills-tabContent">
            <div class="col-md-3 pl-1 pr-1">
              <div class="banner-product">
                <a href="danh-muc/banh-sinh-nhat-cho-be">
                  <img src="source/Banner danh muc san pham/Banh cho be yeu .png" alt="banner sản phẩm"
                    class="img-fluid">
                </a>
              </div>
            </div>
            <div class="tab-pane fade show active col-md-9" id="pills-home" role="tabpanel"
              aria-labelledby="pills-home-tab">
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/tiger-cake-baby-01a-12">
                            <img src="source/b&aacute;nh cho b&eacute;/banh cham con ho.jpg"
                              alt="Tiger Cake Baby 01A" />
                            <img src="source/b&aacute;nh cho b&eacute;/banh cham con ho.jpg"
                              alt="Tiger Cake Baby 01A" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              Tiger Cake Baby 01A
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">380,000&#8363;</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/banh-sinh-nhat-so-2-18">
                            <img src="source/b&aacute;nh cho b&eacute;/banh sinh nhat hinh so2.jpg"
                              alt="B&aacute;nh Sinh Nhật Số 2" />
                            <img src="source/b&aacute;nh cho b&eacute;/banh sinh nhat hinh so2.jpg"
                              alt="B&aacute;nh Sinh Nhật Số 2" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              B&aacute;nh Sinh Nhật Số 2
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">520,000&#8363;</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/banh-sinh-nhat-chu-khi-19">
                            <img src="source/b&aacute;nh cho b&eacute;/banh con khi.jpg"
                              alt="B&aacute;nh sinh nhật ch&uacute; Khỉ" />
                            <img src="source/b&aacute;nh cho b&eacute;/banh con khi.jpg"
                              alt="B&aacute;nh sinh nhật ch&uacute; Khỉ" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              B&aacute;nh sinh nhật ch&uacute; Khỉ
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">380,000&#8363;</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/car-cake-red-24">
                            <img src="source/b&aacute;nh cho b&eacute;/1aa1.jpg" alt="Car Cake Red" />
                            <img src="source/b&aacute;nh cho b&eacute;/1aa1.jpg" alt="Car Cake Red" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              Car Cake Red
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">350,000&#8363;</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/baby-cake-st01-25">
                            <img src="source/b&aacute;nh cho b&eacute;/banchobeA002.jpg" alt="Baby Cake ST01" />
                            <img src="source/b&aacute;nh cho b&eacute;/banchobeA002.jpg" alt="Baby Cake ST01" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              Baby Cake ST01
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">520,000&#8363;</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/baby-doraemon-cake-002-26">
                            <img src="source/b&aacute;nh cho b&eacute;/banchobeA003.jpg" alt="Baby Doraemon Cake 002" />
                            <img src="source/b&aacute;nh cho b&eacute;/banchobeA003.jpg" alt="Baby Doraemon Cake 002" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              Baby Doraemon Cake 002
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">350,000&#8363;</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="see-more">
                    <a href="danh-muc/banh-sinh-nhat-cho-be">Xem
                      thêm</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade col-md-9" id="banh-hinh-so" role="tabpanel" aria-labelledby="banh-hinh-so-tab">
              <div class="row">
                <div class="col-md-12">
                  <div class="row">

                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/banh-sinh-nhat-so-2-18">
                            <img src="source/b&aacute;nh cho b&eacute;/banh sinh nhat hinh so2.jpg"
                              alt="B&aacute;nh Sinh Nhật Số 2" />
                            <img src="source/b&aacute;nh cho b&eacute;/banh sinh nhat hinh so2.jpg"
                              alt="B&aacute;nh Sinh Nhật Số 2" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              B&aacute;nh Sinh Nhật Số 2
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">520,000&#8363;</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade col-md-9" id="banh-12-con-giap" role="tabpanel"
              aria-labelledby="banh-12-con-giap-tab">
              <div class="row">
                <div class="col-md-12">
                  <div class="row">

                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/tiger-cake-baby-01a-12">
                            <img src="source/b&aacute;nh cho b&eacute;/banh cham con ho.jpg"
                              alt="Tiger Cake Baby 01A" />
                            <img src="source/b&aacute;nh cho b&eacute;/banh cham con ho.jpg"
                              alt="Tiger Cake Baby 01A" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              Tiger Cake Baby 01A
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">380,000&#8363;</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/banh-sinh-nhat-chu-khi-19">
                            <img src="source/b&aacute;nh cho b&eacute;/banh con khi.jpg"
                              alt="B&aacute;nh sinh nhật ch&uacute; Khỉ" />
                            <img src="source/b&aacute;nh cho b&eacute;/banh con khi.jpg"
                              alt="B&aacute;nh sinh nhật ch&uacute; Khỉ" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              B&aacute;nh sinh nhật ch&uacute; Khỉ
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">380,000&#8363;</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/pig-cake-baby-002-42">
                            <img src="source/b&aacute;nh cho b&eacute;/banhchobe011.jpg" alt="Pig cake baby 002" />
                            <img src="source/b&aacute;nh cho b&eacute;/banhchobe011.jpg" alt="Pig cake baby 002" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              Pig cake baby 002
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">350,000&#8363;</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade col-md-9" id="banh-sang-tao" role="tabpanel" aria-labelledby="banh-sang-tao-tab">
              <div class="row">
                <div class="col-md-12">
                  <div class="row">

                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/car-cake-red-24">
                            <img src="source/b&aacute;nh cho b&eacute;/1aa1.jpg" alt="Car Cake Red" />
                            <img src="source/b&aacute;nh cho b&eacute;/1aa1.jpg" alt="Car Cake Red" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              Car Cake Red
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">350,000&#8363;</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/baby-cake-st01-25">
                            <img src="source/b&aacute;nh cho b&eacute;/banchobeA002.jpg" alt="Baby Cake ST01" />
                            <img src="source/b&aacute;nh cho b&eacute;/banchobeA002.jpg" alt="Baby Cake ST01" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              Baby Cake ST01
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">520,000&#8363;</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/baby-doraemon-cake-002-26">
                            <img src="source/b&aacute;nh cho b&eacute;/banchobeA003.jpg" alt="Baby Doraemon Cake 002" />
                            <img src="source/b&aacute;nh cho b&eacute;/banchobeA003.jpg" alt="Baby Doraemon Cake 002" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              Baby Doraemon Cake 002
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">350,000&#8363;</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/baby-cake-003-41">
                            <img src="source/b&aacute;nh cho b&eacute;/banhchobe016.jpg" alt="Baby cake 003" />
                            <img src="source/b&aacute;nh cho b&eacute;/banhchobe016.jpg" alt="Baby cake 003" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              Baby cake 003
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">350,000&#8363;</span>
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
      </div>
    </section>
    <section class="section-paddingY middlw-section home-latest-products mt-5">
      <div class="container">
        <div class="section-header">
          <a class="hover-yellow" href="danh-muc/cookies-va-mini-cake">
            <span class="section-title">
              <img src="source/icon/nhandien.png" alt="Cookies v&agrave; Mini Cake">
              Cookies v&agrave; Mini Cake
            </span>
          </a>
        </div>
        <div class="section-body">
          <ul class="nav nav-pills mb-3 tabs-categories" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="pills-home-tab-left" data-toggle="pill" href="#pills-home" role="tab"
                aria-controls="pills-home" aria-selected="true">Tất cả</a>
            </li>
            <li class="nav-item" title="Choux Pastries">
              <a class="nav-link" title="Choux Pastries" href="danh-muc/choux-pastries">
                Choux Pastries
              </a>
            </li>
            <li class="nav-item" title="B&aacute;nh M&igrave;">
              <a class="nav-link" title="B&aacute;nh M&igrave;" href="danh-muc/banh-mi">
                B&aacute;nh M&igrave;
              </a>
            </li>
            <li class="nav-item" title="Cookies">
              <a class="nav-link" title="Cookies" href="danh-muc/cookies">
                Cookies
              </a>
            </li>
            <li class="nav-item" title="Macaron">
              <a class="nav-link" title="Macaron" href="danh-muc/macaron">
                Macaron
              </a>
            </li>
          </ul>
          <div class="tab-content row" id="pills-tabContent">
            <div class="tab-pane fade show active col-md-9" id="pills-home" role="tabpanel"
              aria-labelledby="pills-home-tab">
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/banh-sung-bo-15">
                            <img src="source/Mini Cake/banhsungbo.jpg" alt="B&aacute;nh sừng B&ograve;" />
                            <img src="source/Mini Cake/banhsungbo.jpg" alt="B&aacute;nh sừng B&ograve;" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              B&aacute;nh sừng B&ograve;
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">Liên hệ</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/banh-donut-socola-den-21">
                            <img src="source/Mini Cake/bn011-donut_phu_socola_den-1024x1024.jpg"
                              alt="B&aacute;nh Donut socola đen" />
                            <img src="source/Mini Cake/bn011-donut_phu_socola_den-1024x1024.jpg"
                              alt="B&aacute;nh Donut socola đen" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              B&aacute;nh Donut socola đen
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">18,000&#8363;</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/banh-nho-cuon-32">
                            <img src="source/Mini Cake/nhocuon.jpg" alt="B&aacute;nh Nho Cuộn " />
                            <img src="source/Mini Cake/nhocuon.jpg" alt="B&aacute;nh Nho Cuộn " />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              B&aacute;nh Nho Cuộn
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">Liên hệ</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/banh-su-kem-33">
                            <img src="source/Mini Cake/sukem.jpg" alt="B&aacute;nh su kem" />
                            <img src="source/Mini Cake/sukem.jpg" alt="B&aacute;nh su kem" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              B&aacute;nh su kem
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">Liên hệ</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/gato-cat-mix-vi-34">
                            <img src="source/Mini Cake/mini cake 001.jpg" alt="Gato cắt mix vị" />
                            <img src="source/Mini Cake/mini cake 001.jpg" alt="Gato cắt mix vị" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              Gato cắt mix vị
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">Liên hệ</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/cookie-dua-cuon-35">
                            <img src="source/Cookies/duacuon.jpg" alt="Cookie dừa cuộn" />
                            <img src="source/Cookies/duacuon.jpg" alt="Cookie dừa cuộn" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              Cookie dừa cuộn
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">Liên hệ</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="see-more">
                    <a href="danh-muc/cookies-va-mini-cake">Xem
                      thêm</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade col-md-9" id="choux-pastries" role="tabpanel"
              aria-labelledby="choux-pastries-tab">
              <div class="row">
                <div class="col-md-12">
                  <div class="row">

                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/banh-sung-bo-15">
                            <img src="source/Mini Cake/banhsungbo.jpg" alt="B&aacute;nh sừng B&ograve;" />
                            <img src="source/Mini Cake/banhsungbo.jpg" alt="B&aacute;nh sừng B&ograve;" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              B&aacute;nh sừng B&ograve;
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">Liên hệ</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/banh-donut-socola-den-21">
                            <img src="source/Mini Cake/bn011-donut_phu_socola_den-1024x1024.jpg"
                              alt="B&aacute;nh Donut socola đen" />
                            <img src="source/Mini Cake/bn011-donut_phu_socola_den-1024x1024.jpg"
                              alt="B&aacute;nh Donut socola đen" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              B&aacute;nh Donut socola đen
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">18,000&#8363;</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/banh-nho-cuon-32">
                            <img src="source/Mini Cake/nhocuon.jpg" alt="B&aacute;nh Nho Cuộn " />
                            <img src="source/Mini Cake/nhocuon.jpg" alt="B&aacute;nh Nho Cuộn " />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              B&aacute;nh Nho Cuộn
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">Liên hệ</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/banh-su-kem-33">
                            <img src="source/Mini Cake/sukem.jpg" alt="B&aacute;nh su kem" />
                            <img src="source/Mini Cake/sukem.jpg" alt="B&aacute;nh su kem" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              B&aacute;nh su kem
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">Liên hệ</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/gato-cat-mix-vi-34">
                            <img src="source/Mini Cake/mini cake 001.jpg" alt="Gato cắt mix vị" />
                            <img src="source/Mini Cake/mini cake 001.jpg" alt="Gato cắt mix vị" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              Gato cắt mix vị
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
            <div class="tab-pane fade col-md-9" id="banh-mi" role="tabpanel" aria-labelledby="banh-mi-tab">
              <div class="row">
                <div class="col-md-12">
                  <div class="row">

                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/pate-phap-tuoi-300g-70">
                            <img src="source/Cookies/pate gan.jpg" alt="Pate Ph&aacute;p Tươi 300g" />
                            <img src="source/Cookies/pate gan.jpg" alt="Pate Ph&aacute;p Tươi 300g" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              Pate Ph&aacute;p Tươi 300g
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">58,000&#8363;</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/banh-mi-chuot-20">
                            <img src="source/Mini Cake/B&aacute;nh M&igrave;/Banhmichuot.jpg"
                              alt="B&aacute;nh M&igrave; Chuột" />
                            <img src="source/Mini Cake/B&aacute;nh M&igrave;/Banhmichuot.jpg"
                              alt="B&aacute;nh M&igrave; Chuột" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              B&aacute;nh M&igrave; Chuột
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
            <div class="tab-pane fade col-md-9" id="cookies" role="tabpanel" aria-labelledby="cookies-tab">
              <div class="row">
                <div class="col-md-12">
                  <div class="row">

                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/cookie-dua-cuon-35">
                            <img src="source/Cookies/duacuon.jpg" alt="Cookie dừa cuộn" />
                            <img src="source/Cookies/duacuon.jpg" alt="Cookie dừa cuộn" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              Cookie dừa cuộn
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
            <div class="tab-pane fade col-md-9" id="macaron" role="tabpanel" aria-labelledby="macaron-tab">
              <div class="row">
                <div class="col-md-12">
                  <div class="row">

                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/macaron-cake-37">
                            <img src="source/Cookies/macaron Thuhuong.jpg" alt="Macaron Cake" />
                            <img src="source/Cookies/macaron Thuhuong.jpg" alt="Macaron Cake" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              Macaron Cake
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
              B&aacute;nh trung thu
            </span>
          </a>
        </div>
        <div class="section-body">
          <ul class="nav nav-pills mb-3 tabs-categories" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="pills-home-tab-left" data-toggle="pill" href="#pills-home" role="tab"
                aria-controls="pills-home" aria-selected="true">Tất cả</a>
            </li>
            <li class="nav-item" title="Hộp Qu&agrave; Trung Thu">
              <a class="nav-link" title="Hộp Qu&agrave; Trung Thu" href="danh-muc/hop-qua-trung-thu">
                Hộp Qu&agrave; Trung Thu
              </a>
            </li>
            <li class="nav-item" title="B&aacute;nh trung thu c&aacute;c vị">
              <a class="nav-link" title="B&aacute;nh trung thu c&aacute;c vị" href="danh-muc/banh-trung-thu-cac-vi">
                B&aacute;nh trung thu c&aacute;c vị
              </a>
            </li>
          </ul>
          <div class="tab-content row" id="pills-tabContent">
            <div class="col-md-3 pl-1 pr-1">
              <div class="banner-product">
                <a href="danh-muc/banh-trung-thu">
                  <img src="source/Banner danh muc san pham/banhtrungthuthuhuongbn.png" alt="banner sản phẩm"
                    class="img-fluid">
                </a>
              </div>
            </div>
            <div class="tab-pane fade show active col-md-9" id="pills-home" role="tabpanel"
              aria-labelledby="pills-home-tab">
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/banh-trung-thu-nhat-nguyet-58">
                            <img src="source/Banh Trung Thu 2022/banh trung thu NN.jpg"
                              alt="B&aacute;nh Trung Thu Nhật Nguyệt" />
                            <img src="source/Banh Trung Thu 2022/banh trung thu NN.jpg"
                              alt="B&aacute;nh Trung Thu Nhật Nguyệt" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              B&aacute;nh Trung Thu Nhật Nguyệt
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">750,000&#8363;</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/banh-trung-thu-nam-long-69">
                            <img src="source/Banh Trung Thu 2022/nam long 1.jpg" alt="B&aacute;nh Trung Thu Nam Long" />
                            <img src="source/Banh Trung Thu 2022/nam long 1.jpg" alt="B&aacute;nh Trung Thu Nam Long" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              B&aacute;nh Trung Thu Nam Long
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">390,000&#8363;</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/banh-trung-thu-dan-gian-57">
                            <img src="source/Banh Trung Thu 2022/banh trung thu DG.jpg"
                              alt="B&aacute;nh Trung Thu D&acirc;n Gian" />
                            <img src="source/Banh Trung Thu 2022/banh trung thu DG.jpg"
                              alt="B&aacute;nh Trung Thu D&acirc;n Gian" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              B&aacute;nh Trung Thu D&acirc;n Gian
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">680,000&#8363;</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/banh-trung-thu-thinh-vuong-55">
                            <img src="source/Banh Trung Thu 2022/banh trung thu TV.jpg"
                              alt="B&aacute;nh Trung Thu Thịnh Vượng" />
                            <img src="source/Banh Trung Thu 2022/banh trung thu TV.jpg"
                              alt="B&aacute;nh Trung Thu Thịnh Vượng" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              B&aacute;nh Trung Thu Thịnh Vượng
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">560,000&#8363;</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/banh-trung-thu-minh-nguyet-52">
                            <img src="source/Banh Trung Thu 2022/banh trung thu MN.jpg"
                              alt="B&aacute;nh Trung Thu Minh Nguyệt" />
                            <img src="source/Banh Trung Thu 2022/banh trung thu MN.jpg"
                              alt="B&aacute;nh Trung Thu Minh Nguyệt" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              B&aacute;nh Trung Thu Minh Nguyệt
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">450,000&#8363;</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/banh-trung-thu-hoang-kim-54">
                            <img src="source/Banh Trung Thu 2022/banh trung thu HK.jpg"
                              alt="B&aacute;nh Trung Thu Ho&agrave;ng Kim" />
                            <img src="source/Banh Trung Thu 2022/banh trung thu HK.jpg"
                              alt="B&aacute;nh Trung Thu Ho&agrave;ng Kim" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              B&aacute;nh Trung Thu Ho&agrave;ng Kim
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">510,000&#8363;</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="see-more">
                    <a href="danh-muc/banh-trung-thu">Xem
                      thêm</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade col-md-9" id="hop-qua-trung-thu" role="tabpanel"
              aria-labelledby="hop-qua-trung-thu-tab">
              <div class="row">
                <div class="col-md-12">
                  <div class="row">

                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/banh-trung-thu-nhat-nguyet-58">
                            <img src="source/Banh Trung Thu 2022/banh trung thu NN.jpg"
                              alt="B&aacute;nh Trung Thu Nhật Nguyệt" />
                            <img src="source/Banh Trung Thu 2022/banh trung thu NN.jpg"
                              alt="B&aacute;nh Trung Thu Nhật Nguyệt" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              B&aacute;nh Trung Thu Nhật Nguyệt
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">750,000&#8363;</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/banh-trung-thu-nam-long-69">
                            <img src="source/Banh Trung Thu 2022/nam long 1.jpg" alt="B&aacute;nh Trung Thu Nam Long" />
                            <img src="source/Banh Trung Thu 2022/nam long 1.jpg" alt="B&aacute;nh Trung Thu Nam Long" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              B&aacute;nh Trung Thu Nam Long
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">390,000&#8363;</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/banh-trung-thu-dan-gian-57">
                            <img src="source/Banh Trung Thu 2022/banh trung thu DG.jpg"
                              alt="B&aacute;nh Trung Thu D&acirc;n Gian" />
                            <img src="source/Banh Trung Thu 2022/banh trung thu DG.jpg"
                              alt="B&aacute;nh Trung Thu D&acirc;n Gian" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              B&aacute;nh Trung Thu D&acirc;n Gian
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">680,000&#8363;</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/banh-trung-thu-thinh-vuong-55">
                            <img src="source/Banh Trung Thu 2022/banh trung thu TV.jpg"
                              alt="B&aacute;nh Trung Thu Thịnh Vượng" />
                            <img src="source/Banh Trung Thu 2022/banh trung thu TV.jpg"
                              alt="B&aacute;nh Trung Thu Thịnh Vượng" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              B&aacute;nh Trung Thu Thịnh Vượng
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">560,000&#8363;</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/banh-trung-thu-minh-nguyet-52">
                            <img src="source/Banh Trung Thu 2022/banh trung thu MN.jpg"
                              alt="B&aacute;nh Trung Thu Minh Nguyệt" />
                            <img src="source/Banh Trung Thu 2022/banh trung thu MN.jpg"
                              alt="B&aacute;nh Trung Thu Minh Nguyệt" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              B&aacute;nh Trung Thu Minh Nguyệt
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">450,000&#8363;</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/banh-trung-thu-hoang-kim-54">
                            <img src="source/Banh Trung Thu 2022/banh trung thu HK.jpg"
                              alt="B&aacute;nh Trung Thu Ho&agrave;ng Kim" />
                            <img src="source/Banh Trung Thu 2022/banh trung thu HK.jpg"
                              alt="B&aacute;nh Trung Thu Ho&agrave;ng Kim" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              B&aacute;nh Trung Thu Ho&agrave;ng Kim
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">510,000&#8363;</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="see-more">
                    <a href="danh-muc/hop-qua-trung-thu">Xem
                      thêm</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade col-md-9" id="banh-trung-thu-cac-vi" role="tabpanel"
              aria-labelledby="banh-trung-thu-cac-vi-tab">
              <div class="row">
                <div class="col-md-12">
                  <div class="row">

                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/banh-nuong-cac-vi-150g-60">
                            <img src="source/BNCV150.jpg" alt="B&aacute;nh Nướng c&aacute;c vị 150g" />
                            <img src="source/BNCV150.jpg" alt="B&aacute;nh Nướng c&aacute;c vị 150g" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              B&aacute;nh Nướng c&aacute;c vị 150g
                            </a>
                          </p>
                          <div class="product-price">

                            <span class="price">Liên hệ</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
                      <div class="one-product-container">

                        <div class="product-images">
                          <a class="product-image hover-animation" href="san-pham/banh-deo-cac-vi-150g-61">
                            <img src="source/BDCV150.jpg" alt="B&aacute;nh Dẻo C&aacute;c Vị 150g" />
                            <img src="source/BDCV150.jpg" alt="B&aacute;nh Dẻo C&aacute;c Vị 150g" />
                          </a>
                        </div>
                        <div class="product-info">
                          <p class="product-name">
                            <a href="#/">
                              B&aacute;nh Dẻo C&aacute;c Vị 150g
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
                <a class="product-image hover-animation"
                  href="tin-tuc/banh-giang-sinh-banh-noel-2022-giang-sinh-ngot-ngao-9">
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
                <a class="product-image hover-animation"
                  href="tin-tuc/banh-kem-2010-top-nhung-mau-banh-duoc-ua-thich-nhat-2022-8">
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
              <form action="dang-ky-kinh-doanh" class="form-horizontal create-product-form jquery-form-submit"
                method="post" accept-charset="utf-8">
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
                  <input type="text" class="form-control" name="type_bussines"
                    placeholder="Khách sạn, nhà hàng, chuỗi cafe…">
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