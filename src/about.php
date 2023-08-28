<?php 
session_start();
require_once("connect/connectDB.php") ?>
<?php include("layout/header.php"); ?>

<div class="breadcrumb">
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
          <a href="home.php" itemprop="item">
            <span itemprop="name">Trang chủ</span>
            <meta itemprop="position" content="1" />
          </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
          <a href="ve-chung-toi.php" itemprop="item">
            <span itemprop="name">Về ch&uacute;ng t&ocirc;i</span>
            <meta itemprop="position" content="2" />
          </a>
        </li>
      </ol>
    </nav>
  </div>
</div>
<section class="section-paddingY contact-section">
  <div class="container bg-white mb-0">
    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="name-ladding">
            <h3>Về ch&uacute;ng t&ocirc;i</h3>
          </div>
          <div class="card-ladding">
            <div>
              <div class="kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x c1et5uql">
                <div dir="auto">Thu Hương Bakery ra đời từ năm 1996, trong suốt hơn 25 năm h&igrave;nh th&agrave;nh
                  v&agrave; ph&aacute;t triển, với sự nỗ lực kh&ocirc;ng ngừng nghỉ Thu Hương Bakery đ&atilde; mang
                  lại những dấu ấn kh&oacute; phai trong l&ograve;ng người d&acirc;n Thủ Đ&ocirc;.</div>
              </div>
              <div class="cxmmr5t8 oygrvhab hcukyx3x c1et5uql o9v6fnle">
                <div dir="auto">Với sự đa dạng cả về hương vị v&agrave; sản phẩm Thu Hương Bakery đ&atilde; trở
                  th&agrave;nh một phần kh&ocirc;ng thể thiếu trong đời sống tinh thần của người d&acirc;n v&agrave;
                  th&agrave;nh c&ocirc;ng mang hồn cốt tinh hoa ẩm thực Ph&aacute;p đến gần hơn với những người
                  d&acirc;n s&agrave;nh ăn.</div>
                <div dir="auto">&nbsp;</div>
                <div dir="auto">Sử dụng nguy&ecirc;n liệu tươi ngon nhất từ thi&ecirc;n nhi&ecirc;n, tạo ra những
                  chiếc b&aacute;nh an to&agrave;n cho sức khỏe, chuẩn hương vị Ph&aacute;p.</div>
                <div dir="auto">G&igrave;n giữ v&agrave; tiếp nối gi&aacute; trị truyền thống trong một x&atilde;
                  hội hiện đại biến đổi kh&ocirc;ng ngừng.</div>
                <div dir="auto">Kh&ocirc;ng ngừng nỗ lực cải thiện dịch vụ, s&aacute;ng tạo ra những d&ograve;ng sản
                  phẩm mới, đ&aacute;p ứng nhu cầu của kh&aacute;ch h&agrave;ng.</div>
              </div>
              <p><img src="source/hinh-anh/logo/logo.png" width="200" height="48" /></p>
            </div>
            <div>&nbsp;</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>

<?php include("layout/footer.php"); ?>