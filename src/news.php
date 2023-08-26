<?php
require_once("connect/connectDB.php");


$cate = executeResult("SELECT c.cate_id, c.cate_name 
                        FROM tb_category c
                        INNER JOIN tb_news p 
                        ON c.cate_id = p.new_cate_id 
                        GROUP BY c.cate_name DESC");

$limit = 1;
$page = 1;
$number = 0;
$cate_id = $countResult = '';
if (isset($_GET['page'])) {
  $page = $_GET['page'];
  
}
$firstIndex = ($page - 1) * $limit;

if (isset($_GET['cate_id']) && !empty($_GET['cate_id'])) {
  $cate_id = $_GET['cate_id'];
  $sql = 'SELECT * from tb_news where deleted = 0 and new_cate_id = ' . $cate_id . ' ORDER BY new_id DESC limit ' . $firstIndex . ',' . $limit;
  $product = executeResult($sql);
  $countResult = executeSingleResult("SELECT count(new_id) AS total from tb_news where deleted = 0 and new_cate_id = $cate_id");
} else {
  $countResult = executeSingleResult("SELECT count(new_id) AS total from tb_news where deleted = 0");
  $sql = 'SELECT * from tb_news where deleted = 0 ORDER BY new_id DESC limit ' . $firstIndex . ',' . $limit;
  $product = executeResult($sql);
}

if ($countResult != null) {
  $count = $countResult['total'];
  $number = ceil($count / $limit); 
}
?>

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
        <li class="breadcrumb-item active" aria-current="page" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
          <a href="tin-tuc" itemprop="item">
            <span itemprop="name">Tin tức - Sự kiện</span>
            <meta itemprop="position" content="2" />
          </a>
        </li>
      </ol>
    </nav>
  </div>
</div>
<section class="section-paddingY blog-section">
  <!-- <div class="section-loader">
    <i class="fas fa-spinner fa-5x fa-pulse"></i>
  </div> -->
  <div class="container">
    <!-- <div class="section-header">
      <p class="section-title">Tin tức - Sự kiện</p>
    </div> -->
    <div class="row">
      <div class="col-md-3">
        <ul class="menu-category">
          <li><span class="title-category">Danh mục Tin Tức</span></li>
          <hr>
          <?php foreach ($cate as $c) { ?>
            <li class="item-nav">
              <a href="?cate_id=<?= $c["cate_id"] ?>">
                <?php echo $c["cate_name"] ?>
              </a>
            </li>
          <?php } ?>
        </ul>
      </div>
      <div class="col-md-9">
        <div class="section-header">
          <p class="section-title"></p>
          <input type="hidden" name="cate_id" value="1">
        </div>
        <div class="section-body">
          <div class="row">
            <?php foreach ($product as $p) { ?>
              <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1 my-2">
                <div class="one-product-container">
                  <div class="product-images">
                    <a href="new_details.php?new_id=<?= $p["new_id"] ?>">
                      <div class="product-image hover-animation" href="san-pham/opera-cake-27">
                        <img src="../<?php echo $p["new_image"] ?>" alt="Opera Cake " />
                        <img src="../<?php echo $p["new_image"] ?>" alt="Opera Cake " />
                      </div>
                    </a>                    
                    
                  </div>
                  <div class="product-info">
                    <p class="product-name">
                      <a href="details.php?new_id=<?php $p["new_id"] ?>">
                        <?php echo $p["new_title"] ?>
                      </a>
                    </p>
                    
                  </div>
                </div>
              </div>
            <?php } ?>
        <!-- <div class="col-12 col-sm-6 col-lg-4 col-xl-4 mt-4">
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
                Tết Trung Thu l&agrave; một trong những ng&agrave;y tết trọng đại của d&acirc;n tộc Việt Nam
                v&agrave; l&agrave; dịp gia đ&igrave;nh qu&acirc;y quần đo&agrave;n tụ c&ugrave;ng&#8230;</p>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-4 mt-4">
          <div class="article-column-container">
            <div class="article-image">
              <a class="product-image hover-animation" href="tin-tuc/banh-trung-thu-thu-huong-bakery-since-1996-7">
                <img src="source/TinTuc/B&aacute;nh Trung Thu tin.jpg" alt="">
              </a>
              <span class="name-category">Tin tức</span>
            </div>
            <div class="article-info">
              <p class="article-title">
                <a href="tin-tuc/banh-trung-thu-thu-huong-bakery-since-1996-7">B&aacute;nh Trung Thu Thu Hương
                  Bakery Since 1996</a>
              </p>
              <p class="article-description">Gia đ&igrave;nh ch&iacute;nh l&agrave; nguồn cảm hứng s&aacute;ng tạo
                v&agrave; phục vụ lớn nhất m&agrave; to&agrave;n thể c&aacute;c thợ b&aacute;nh, phụ bếp, hậu cần
                c&ugrave;ng l&atilde;nh đạo của thương hiệu được hữu duy&ecirc;n&#8230;</p>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-4 mt-4">
          <div class="article-column-container">
            <div class="article-image">
              <a class="product-image hover-animation" href="tin-tuc/banh-kem-2010-top-nhung-mau-banh-duoc-ua-thich-nhat-2022-8">
                <img src="source/TinTuc/1ahoa.png" alt="">
              </a>
              <span class="name-category">Tin tức</span>
            </div>
            <div class="article-info">
              <p class="article-title">
                <a href="tin-tuc/banh-kem-2010-top-nhung-mau-banh-duoc-ua-thich-nhat-2022-8">B&aacute;nh Kem 20/10
                  top những mẫu b&aacute;nh được ưa th&iacute;ch nhất 2022</a>
              </p>
              <p class="article-description">Những mẫu b&aacute;nh kem 20/10 với những điểm nhấn ấn tượng sẽ
                l&agrave; m&oacute;n qu&agrave; v&ocirc; c&ugrave;ng &yacute; nghĩa để d&agrave;nh tặng cho những
                người phụ nữ Việt Nam nh&acirc;n ng&agrave;y lễ đặc biệt&#8230;</p>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 col-xl-4 mt-4">
          <div class="article-column-container">
            <div class="article-image">
              <a class="product-image hover-animation" href="tin-tuc/banh-giang-sinh-banh-noel-2022-giang-sinh-ngot-ngao-9">
                <img src="source/banh noel 2022/tin 1a.jpg" alt="">
              </a>
              <span class="name-category">Tin tức</span>
            </div>
            <div class="article-info">
              <p class="article-title">
                <a href="tin-tuc/banh-giang-sinh-banh-noel-2022-giang-sinh-ngot-ngao-9">B&aacute;nh Gi&aacute;ng
                  Sinh (B&aacute;nh Noel) 2022, Gi&aacute;ng Sinh Ngọt Ng&agrave;o</a>
              </p>
              <p class="article-description">Gi&aacute;ng Sinh đang về&hellip; Merry Christmas ❤️❤️
                Gi&aacute;ng sinh l&agrave; thời gian để d&agrave;nh cho gia đ&igrave;nh, bạn b&egrave; v&agrave;
                những Người y&ecirc;u thương... </p>
            </div>
          </div>
        </div> -->
          </div>
          <div class="section-bottom has-pagination">
            <div class="website-pagination">

            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- <div class="section-bottom has-pagination">
      <div class="website-pagination">

      </div>
    </div> -->
  </div>
</section>

<?php include("layout/footer.php"); ?>