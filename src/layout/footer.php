<footer>
  <div class="container">
    <div class="row">
      <div class="col-12 col-xl-3">
        <div class="body-column">
          <div class="img-footer">
            <img src="../public/images/logo/logo.jpg" alt="Logo" class="img-fluid" />
          </div>
          <p class="text">
            <img src="../public/images/icon/location.png" alt="" class="img-fluid">
            242/20 Le Dinh Can, Tan Tao Ward, Binh Tan District , Ho Chi Minh City
          </p>
          <p class="text">
            <img src="../public/images/icon/phone.png" alt="" class="img-fluid">
            0707364628 | 0907733229
          </p>
          <p class="text">
            <i class="fa fa-link" aria-hidden="true" style="color: #F4C522;transform: rotateY(180deg); font-size: 17px;"></i>
            <a href="" style="font-size: 16px">www.facebook.com/NgocNhiBakery</a>
          </p>
          <a href="http://online.gov.vn/Home/WebDetails/631" target="blank">
            <img src="../public/images/icon/bocongthuong.png" alt="Bộ công thương">
          </a>
        </div>
      </div>
      <div class="col-6 col-xl-3">
        <div class="body-column">
          <p class="title text-yellow">Product Portfolio</p>
          <ul>
            <?php foreach ($cates as $c) { ?>
              <li>
                <a href="product.php?cate_id=<?= $c["cate_id"] ?>">
                  <?= $c["cate_name"] ?>
                </a>
              </li>
            <?php } ?>
          </ul>
        </div>
      </div>
      <div class="col-6 col-xl-2">
        <div class="body-column">
          <p class="title text-yellow">Cater</p>
          <ul>
            <li>
              <a href="shopping_guide.php">
                Shopping Guide
              </a>
            </li>
            <li>
              <a href="contact.php">
                Contact
              </a>
            </li>
            <li>
              <a href="news.php">
                News
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


<!-- <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v17.0" nonce="T1W405h4"></script>
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
</script> -->
<!-- Messenger Plugin chat Code -->
<!-- <div id="fb-root"></div> -->

<!-- Your Plugin chat code -->
<div id="fb-customer-chat" class="fb-customerchat">
</div>

<script>
  var chatbox = document.getElementById('fb-customer-chat');
  chatbox.setAttribute("page_id", "111597538192489");
  chatbox.setAttribute("attribution", "biz_inbox");
</script>

<!-- Your SDK code -->
<!-- <script>
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
</script> -->
<script>
  var header = document.getElementById("HeaderTop");

  var sticky = header.offsetTop;

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

<script src="../public/frontend/js/librarys_js/bootstrap4.min.js"></script>
<script src="../public/frontend/js/librarys_js/owl.carousel.min.js"></script>
<script src="../public/frontend/js/ajax/libs/lightslider/1.1.6/js/lightslider.min.js"></script>
<script src="../public/frontend/js/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="../public/frontend/js/config.js"></script>
<script src="../public/frontend/js/main.js"></script>

<script src="../public/frontend/js/product_page.js"></script>
<script src="../public/frontend/js/my_account.js"></script>

</body>

</html>