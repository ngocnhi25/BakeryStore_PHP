<?php session_start();



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>
    Giỏ hàng</title>
  <meta name="description"
    content="Thu Hương Bakery ra đời từ năm 1996, trong suốt hơn 25 năm hình thành và phát triển, với sự nỗ lực không ngừng nghỉ Thu Hương Bakery đã mang lại những dấu ấn khó phai trong lòng người dân Thủ Đô.">
  <meta name="keywords" content="Bánh Sinh Nhật, Bánh Trung Thu, Quà Trung Thu, Thu Hương Bakery Since 1996">
  <!-- Favicon -->
  <link rel="apple-touch-icon" href="source/icon/logo website2.png">
  <link rel="icon" type="image/png" href="source/icon/logo website2.png">
  <link rel="icon" type="image/png" href="source/icon/logo website2.png">

  <meta property="og:title" content="Giỏ hàng" />
  <meta property="og:site_name" content="BÁNH SINH NHẬT | BÁNH TRUNG THU | BÁNH SỰ KIỆN | HỘP QUÀ TRUNG THU" />
  <meta property="og:description"
    content="Thu Hương Bakery ra đời từ năm 1996, trong suốt hơn 25 năm hình thành và phát triển, với sự nỗ lực không ngừng nghỉ Thu Hương Bakery đã mang lại những dấu ấn khó phai trong lòng người dân Thủ Đô." />
  <meta property="og:url" content="" />
  <meta property="og:image" content="source/hinh-anh/logo/logo.png" />
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:site" content="Giỏ hàng" />
  <meta name="twitter:title" content="Giỏ hàng" />
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

  <link href="public/frontend/css/style.css" rel="stylesheet">
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

  <section class="section-paddingY cart-page">
    <div class="container">
      <div class="section-header">
        <p class="section-title">Giỏ hàng của bạn</p>
        <p class="section-subtitle">Có 0 sản phẩm trong giỏ hàng</p>
      </div>
      <div class="section-body">
        <div class="row">
          <div class="col-12">
            <div class="cart-container">
              <ul class="cart-list">
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="section-footer">
        <table class="table table-bordered my-5">
          <tr>
            <th>product_id</th>
            <th>cate_id</th>
            <th>price</th>
            <th>quantity</th>
            <th>action</th>
          </tr>

          <?php

          $total_price = 0;

          if (!empty($_SESSION['cart'])) {

            foreach ($_SESSION['cart'] as $key => $value) { ?>
              <tr>
                <td>
                  <?php echo $value['id']; ?>
                </td>
                <td>
                  <?php echo $value['name']; ?>
                </td>
                <td>
                  <?php echo $value['price']; ?>
                </td>
                <td>
                  <?php echo $value['quantity']; ?>
                </td>
                <td>
                  <button class="btn btn-danger remove" id="<?php echo $value['id']; ?>">Remove</button>
                </td>
              </tr>

              <?php $total_price = $total_price + $value['quantity'] * $value['price']; ?>



            <?php }
          } else { ?>
          <tr>
            <td class="text-center" colspan="5">NO ITEM SELECTED</td>
          </tr>
          <?php }




          ?>

          <tr>
            <td colspan="2"></td>
            <td>Total Price</td>
            <td>
              <?php echo number_format($total_price, 2); ?>
            </td>
            <td>
              <button class="btn btn-warning clearall">Clear All</button>
            </td>
          </tr>
        </table>
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
  </script>
  <script src="public/frontend/assets/js/config.js"></script>
  <script src="public/plugins/js/bootstrap4.min.js"></script>
  <script src="public/plugins/js/owl.carousel.min.js"></script>
  <script src="ajax/libs/lightslider/1.1.6/js/lightslider.min.js"></script>
  <script src="ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
  <script src="public/frontend/assets/js/main.js?v=1.0.8"></script>
  <script src="public/myplugins/js/messagebox.js"></script>

  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>



  <script type="text/javascript">
    $(document).ready(function () {


      $(".remove").click(function () {
        var id = $(this).attr("id");

        var action = "remove";

        $.ajax({
          method: "POST",
          url: "action.php",
          data: { action: action, id: id },
          success: function (data) {
            alert("you have Remove item with ID " + id + "");
          }
        });
      });


      $(".clearall").click(function () {

        var action = "clear";

        $.ajax({
          method: "POST",
          url: "action.php",
          data: { action: action },
          success: function (data) {
            alert("you have cleared all item");
            window.location.href = "product.php";
          }
        });
      });
    });
  </script>
</body>

</html>