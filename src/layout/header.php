<?php
// session_start();
$cates = executeResult("SELECT * FROM tb_category c
                        INNER JOIN tb_products p 
                        ON c.cate_id = p.cate_id 
                        GROUP BY c.cate_id");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Bakery Store</title>
  <meta name="description" content="Thu Hương Bakery ra đời từ năm 1996, trong suốt hơn 25 năm hình thành và phát triển, với sự nỗ lực không ngừng nghỉ Thu Hương Bakery đã mang lại những dấu ấn khó phai trong lòng người dân Thủ Đô.">
  <meta name="keywords" content="Bánh Sinh Nhật, Bánh Trung Thu, Quà Trung Thu, Thu Hương Bakery Since 1996">

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

  <link href="../public/frontend/css/style.css?v=0.0.7" rel="stylesheet">
  <link href="../public/frontend/css/product.css" rel="stylesheet">
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

</head>

<body>
  <div class="page-wrapper">

    <!-- MESSAGE FROM SERVER -->
    <div class="msg-top ">
      <div class="msg-from-server msg-container">
        <span class="close-msg">&times;</span>
      </div>
    </div>

    <div class="fullscreen-overlay"></div>

    <div class="cart-sidebar-container">
      <div class="header">
        <p class="title">Carts</p><span class="toggle-cart-sidebar js-toggle-cart-sidebar"><i class="fas fa-times fa-2x"></i></span>
      </div>
      <div class="body">
        <ul class="cart-list">
          <li>
            <p class="product-name">bánh trái dứa</p>
            <p class="options">Bánh trẻ em</p>
            <p class="subtotal"><span class="multi">230.000 vnđ</span> <span class="equal">280.000 vnđ</span></p>
          </li>
        </ul>
      </div>
      <div class="footer">
        <div class="total">
          <span class="text">Tổng tiền</span>
          <span class="money">6.587.436 vnđ</span>
        </div>
        <div class="action-btns">
          <a class="action-btn goto-cart" href="carts.php">View cart</a>
          <a class="action-btn remove-cart js-remove-cart" href="gio-hang/xoa">Clear cart</a>
        </div>
      </div>
    </div>

    <div class="mobile-menu-container">
      <div class="header">
        <p class="title">
          <img src="../../public/images/logo/logo.jpg" alt="" srcset="">
        </p><span class="toggle-mobile-menu js-toggle-mobile-menu"><i class="fas fa-times fa-2x"></i></span>
      </div>
      <div class="body">

        <nav>
          <div class="nav nav-tabs tabs-menu-mobile" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">MENU</a>
            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-category" role="tab" aria-controls="nav-profile" aria-selected="false">DANH MỤC SẢN PHẨM</a>
          </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade pt-3 show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <ul class="mobile-menu-list">
              <li class="li-menu">
                <a href="#">
                  Danh Muc San Pham
                  <i class="fa fa-angle-down" aria-hidden="true"></i>
                </a>
                <ul class="submenu">
                  <?php foreach ($cates as $key => $c) { ?>
                    <li>
                      <a href="product.php?cate_id=<?= $c["cate_id"] ?>"><?= $c["cate_name"] ?></a>
                    </li>
                  <?php } ?>
                </ul>
              </li>
              <li class="li-menu">
                <a href="home.php">
                  Home
                </a>
              </li>
              <li class="li-menu">
                <a href="about.php">
                  About Us
                </a>
              </li>
              <li class="li-menu">
                <a href="product.php">
                  Products
                </a>
              </li>
              <li class="li-menu">
                <a href="#">
                  News and Events
                  <i class="fa fa-angle-down" aria-hidden="true"></i>
                </a>
                <ul class='submenu'>
                  <li> <a href='shopping_guide.php'> Shopping Guide</a></li>
                  <li> <a href='news.php'> News</a></li>
                </ul>
              </li>
              <li class="li-menu">
                <a href="contact.php">
                  Contact
                </a>
              </li>
            </ul>
          </div>
          <div class="tab-pane fade  pt-3" id="nav-category" role="tabpanel" aria-labelledby="nav-profile-tab">
            <ul class="mobile-menu-list">
              <?php foreach ($cates as $key => $c) { ?>
                <li>
                  <a href="product.php?cate_id=<?= $c["cate_id"] ?>"><?= $c["cate_name"] ?></a>
                </li>
              <?php } ?>
            </ul>
          </div>
        </div>
      </div>

      <div class="footer">
        <div class="auth-actions depth1">
          <a class="auth-action" href="dang-nhap#login">
            <i class="fas fa-user-circle"></i>
            <span>Đăng nhập</span>
          </a>
          <a class="auth-action" href="dang-ky#register">
            <i class="fas fa-user-plus"></i>
            <span>Đăng kí</span>
          </a>
        </div>
      </div>
    </div>

    <header class="header">
      <div class="header-top" id="HeaderTop">
        <div class="container">
          <span class="sologan float-left">Ch&agrave;o Mừng Qu&yacute; Kh&aacute;ch Đến Với Ngoc Nhi Bakery</span>
          <span class="sologan float-right">Hotline: 123123123123 | 123123123123</span>
        </div>
      </div>
      <div class="header-topbar">
        <div class="container">
          <div class="header-topbar-inner-container">
            <div class="left">
              <div class="logo">
                <a class="big-logo" href="">
                  <img src="../public/images/logo/logo.jpg" alt="">
                </a>
              </div>
            </div>

            <div class="right">

              <form action="tim-kiem" method="GET" class="form-search-header">
                <span class="icon">
                  <i class="fa fa-search"></i>
                </span>
                <input type="text" name="search" placeholder="Tìm kiếm" class="form-control">
              </form>

              <a class="shopping-bag js-toggle-cart-sidebar" href="#/">
                <img src="../public/images/icon/shopping-bag.svg" alt="">
                <span class="counter">0</span>
              </a>

              <div class="user-header d-none d-lg-block">
                <?php if (isset($_SESSION["auth_user"])) { ?>
                  <a href="User/information-User.php">
                    <ul class="user-header-button js-toggle-user-nav">
                      <li> <i class="fa fa-user" aria-hidden="true"></i> <?= $_SESSION['auth_user']['username'] ?> </li>
                      <li><a href="User/logout.php" >Log Out</a></li>
                    </ul>
                  </a>

                <?php } else { ?>
                  <a href="User/login.php" class="user-header-button js-toggle-user-nav">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    Log In
                  </a>
                  <a href="User/register.php" class="user-header-button js-toggle-user-nav">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    Sign In
                  </a>
                <?php } ?>
              </div>


            </div>
          </div>
        </div>
      </div>


      <div class="header-nav">
        <div class="container">
          <div class="header-nav-inner-container">
            <a class="toggle-mobile-menu js-toggle-mobile-menu d-lg-none" href="#/">
              <i class="fas fa-bars fa-2x"></i>
            </a>
            <!-- DESKTOP MENU HERE-->
            <div class="desktop-menu d-none d-lg-flex">
              <ul class="main-menu">
                <li class="li-menu">
                  <a href="#">
                    Danh Muc San Pham
                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                  </a>
                  <ul class="submenu">
                    <?php foreach ($cates as $key => $c) { ?>
                      <li>
                        <a href="product.php?cate_id=<?= $c["cate_id"] ?>"><?= $c["cate_name"] ?></a>
                      </li>
                    <?php } ?>
                  </ul>
                </li>
                <li class="li-menu">
                  <a href="home.php">
                    Home
                  </a>
                </li>
                <li class="li-menu">
                  <a href="about.php">
                    About Us
                  </a>
                </li>
                <li class="li-menu">
                  <a href="product.php">
                    Products
                  </a>
                </li>
                <li class="li-menu">
                  <a href="#">
                    News and Events
                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                  </a>
                  <ul class='submenu'>
                    <li> <a href='shopping_guide.php'> Shopping Guide</a></li>
                    <li> <a href='news.php'> News</a></li>
                  </ul>
                </li>
                <li class="li-menu">
                  <a href="contact.php">
                    Contact
                  </a>
                </li>
              </ul>

            </div>
            <!-- END DESKTOP MENU HERE-->

          </div>
        </div>
      </div>
    </header>
  </div>