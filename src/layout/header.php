

<div id="fb-root"></div>
<script async defer crossorigin="anonymous"
  src="vi_VN/sdk.js#xfbml=1&version=v3.3&appId=799750433706362&autoLogAppEvents=1">
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

<<<<<<< HEAD
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
          <a class="action-btn goto-cart" href="gio-hang">View cart</a>
          <a class="action-btn remove-cart js-remove-cart" href="gio-hang/xoa">Clear cart</a>
        </div>
=======
  <div class="cart-sidebar-container">
    <div class="header">
      <p class="title">Giỏ hàng</p><span class="toggle-cart-sidebar js-toggle-cart-sidebar"><i
          class="fas fa-times fa-2x"></i></span>
    </div>
    <div class="body">
      <ul class="cart-list">
      </ul>
    </div>
    <div class="footer">
      <div class="total">
        <span class="text">Tổng tiền</span>
        <span class="cart-total">Liên hệ</span>
        <span class="money">
        </span>
      </div>
      <div class="action-btns">
        <a class="action-btn goto-cart" href="gio-hang">Xem giỏ hàng</a>
        <a class="action-btn remove-cart js-remove-cart" href="gio-hang/xoa">Xóa giỏ hàng</a>
>>>>>>> 3097f71a9c88495cd7b3f13500f77e35984dff9c
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
              <img src="public/frontend/assets/img/icons/shopping-bag.svg" alt="">
              <span class="counter">0</span>
            </a>
            <div class="user-header d-none d-lg-block">
              <a href="#/" class="user-header-button js-toggle-user-nav">
                <i class="fa fa-user" aria-hidden="true"></i>
                Đăng nhập
              </a>
              <ul class="user-nav-header">
                <li>
                  <a href="dang-nhap#login">Đăng nhập</a>
                </li>
                <li>
                  <a href="dang-ky#register">Đăng ký</a>
                </li>
              </ul>
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

  