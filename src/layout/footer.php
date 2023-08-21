<footer>
  <div class="container">
    <div class="row">
      <div class="col-12 col-xl-3">
        <div class="body-column">
          <div class="img-footer">
            <img src="source/hinh-anh/logo/logo.png" alt="Logo" class="img-fluid" />
          </div>
          <p class="text">
            <img src="public/frontend/assets/img/icons/location.png" alt="" class="img-fluid">
            Số 32A, ng&otilde; chợ Nguyễn C&ocirc;ng Trứ &ndash; Phường Phố Huế &ndash; Quận Hai B&agrave;
            Trưng
            &ndash; H&agrave; Nội
          </p>
          <p class="text">
            <img src="public/frontend/assets/img/icons/phone.png" alt="" class="img-fluid">
            090 754 6668 | 096 938 6611
          </p>
          <p class="text">
            <i class="fa fa-link" aria-hidden="true" style="color: #F4C522;transform: rotateY(180deg); font-size: 17px;"></i>
            <a href="" style="font-size: 16px">https://thuhuongbakery.com.vn/</a>
          </p>
          <a href="http://online.gov.vn/Home/WebDetails/631" target="blank">
            <img src="public/frontend/assets/img/icons/bocongthuong.png" alt="Bộ công thương">
          </a>
        </div>
      </div>
      <div class="col-6 col-xl-3">
        <div class="body-column">
          <p class="title text-yellow">Danh mục sản phẩm</p>
          <ul>
            <li>
              <a href="danh-muc/banh-sinh-nhat">
                B&aacute;nh sinh nhật
              </a>
            </li>
            <li>
              <a href="danh-muc/banh-sinh-nhat-cho-be">
                B&aacute;nh Sinh Nhật Cho B&eacute;
              </a>
            </li>
            <li>
              <a href="">
                Chocolate
              </a>
            </li>
            <li>
              <a href="danh-muc/cookies-va-mini-cake">
                Cookies v&agrave; Mini Cake
              </a>
            </li>
            <li>
              <a href="danh-muc/banh-trung-thu">
                B&aacute;nh trung thu
              </a>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-6 col-xl-2">
        <div class="body-column">
          <p class="title text-yellow">Trợ giúp</p>
          <ul>
            <li>
              <a href="">
                C&acirc;u hỏi thường gặp
              </a>
            </li>
            <li>
              <a href="huong-dan-mua-hang">
                Hướng dẫn đặt h&agrave;ng
              </a>
            </li>
            <li>
              <a href="">
                Ch&iacute;nh s&aacute;ch vận chuyển
              </a>
            </li>
            <li>
              <a href="">
                Phương thức thanh to&aacute;n
              </a>
            </li>
            <li>
              <a href="">
                Quy tr&igrave;nh đổi trả h&agrave;ng
              </a>
            </li>
            <li>
              <a href="">
                Điều khoản bảo mật
              </a>
            </li>
            <li>
              <a href="">
                Quy định chung
              </a>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-12 col-xl-4">
        <div class="body-column last">
          <iframe src="https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2Fphoto%2F%3Ffbid%3D1483543865381263%26set%3Da.120434811692182&show_text=true&width=500" width="486" height="293" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
        </div><br>
      </div>
    </div>
  </div>
</footer>


<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v17.0" nonce="T1W405h4"></script>
<div class='zalome'>
  <a href='#' target='_blank'>
    <img alt='icon zalo' src='../public/images/icon/icon-zalo.png' />
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
  <img src="../public/images/icon/goto.png" alt="ve dau trang" style="margin-right: 10px"> Về đầu trang
</button>

<script src="../public/frontend/js/librarys_js/jquery3.3.1.min.js"></script>
<script async defer crossorigin="anonymous" src="vi_VN/sdk.js#xfbml=1&version=v3.3&appId=799750433706362&autoLogAppEvents=1"></script>

<script src="../public/frontend/js/librarys_js/bootstrap4.min.js"></script>
<script src="../public/frontend/js/librarys_js/owl.carousel.min.js"></script>
<script src="../public/frontend/js/ajax/libs/lightslider/1.1.6/js/lightslider.min.js"></script>
<script src="../public/frontend/js/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>



<script src="../public/frontend/js/config.js"></script>
<script src="../public/frontend/js/main.js"></script>
<script src="public/myplugins/js/messagebox.js"></script>

<script src="../public/frontend/js/product_page.js"></script>
<script src="../public/frontend/js/my_account.js"></script>

</body>

</html>