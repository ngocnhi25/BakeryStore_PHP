<?php
session_start();
require_once('connect/connectDB.php');
require_once('handles_page/handle_display.php');
require_once('handles_page/handle_calculate.php');

$arraySale = [];
$maxProductsToShow = 6;


$product = executeResult("SELECT * FROM tb_products where deleted = 0 ORDER BY product_id DESC ");
$sale = executeResult("SELECT * FROM tb_sale WHERE CURDATE() BETWEEN start_date AND end_date");
$ads = executeResult("SELECT * FROM tb_ads WHERE CURDATE() BETWEEN start_date AND end_date ORDER BY ads_id DESC");
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

<?php require "layout/header.php" ?>
<?php if (isset($_SESSION['status'])) { ?>
  <script>
    alert('<?php echo $_SESSION['status']; ?>');
  </script>
<?php
  unset($_SESSION['status']); // Clear the session status after displaying
}
?>

<section class="secction-banner">
  <div class="owl-carousel-banner owl-carousel main-carousel">
    <?php foreach ($ads as $key => $a) { ?>
      <div class="image_banner">
        <a href="<?php if ($a["type_ads"] == 'category') {
                    echo 'product.php?cate_id=' . $a["cate_id"];
                  } elseif ($a["type_ads"] == 'product') {
                    echo 'details.php?product_id=' . $a["product_id"];
                  } elseif ($a["type_ads"] == 'sale') {
                    echo 'sale.php';
                  } else {
                    echo 'news.php';
                  } ?>">
          <img src="../<?= $a["image_ads"] ?>" alt="" style="object-fit: cover;">
        </a>
      </div>
    <?php } ?>
  </div>
  <div class="banner-right">
    <div class="banner-wapper">
      <?php for ($i = 0; $i < 2; $i++) { ?>
        <div class="banner-item">
          <a href="<?php if ($ads[$i]["type_ads"] == 'category') {
                      echo 'product.php?cate_id=' . $ads[$i]["cate_id"];
                    } elseif ($ads[$i]["type_ads"] == 'product') {
                      echo 'details.php?product_id=' . $ads[$i]["product_id"];
                    } elseif ($ads[$i]["type_ads"] == 'sale') {
                      echo 'sale.php';
                    } else {
                      echo 'news.php';
                    } ?>">
            <img src="../<?= $ads[$i]["image_ads"] ?>" alt="">
          </a>
        </div>
      <?php } ?>
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
          <img src="../public/images/icon/nhandien.png" alt="B&aacute;nh Sinh Nhật">
          Sản phẩm mới
        </span>
      </a>
    </div>
    <div class="section-body">
      <div class="tab-content row" id="pills-tabContent">
        <div class="tab-pane fade show active col-md-9" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
          <div class="row">

            <?php foreach ($product as $key => $p) {
              if ($key < $maxProductsToShow) { ?>
                <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1 my-2">
                  <div class="one-product-container">
                    <div class="product-images">
                      <a href="details.php?product_id=<?= $p["product_id"] ?>">
                        <div class="product-image hover-animation" href="san-pham/opera-cake-27">
                          <img src="../<?php echo $p["image"] ?>" alt="Opera Cake " />
                          <img src="../<?php echo $p["image"] ?>" alt="Opera Cake " />
                        </div>
                      </a>
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
                        <button><a href="details.php?product_id=<?= $p["product_id"] ?>"><span class="material-symbols-sharp">visibility</span></a></button>
                        <button><span class="material-symbols-sharp">add_shopping_cart</span></button>
                      </div>
                    </div>
                    <div class="product-info">
                      <p class="product-name">
                        <a href="details.php?product_id=<?php $p["product_id"] ?>">
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
            <?php } else {
                break;
              }
            } ?>

          </div>
          <div class="see-more">
            <a href="danh-muc/banh-sinh-nhat">Xem thêm</a>
          </div>
        </div>
        <div class="col-md-3 pl-1 pr-1">
          <div class="banner-product">
            <img src="../public/images/banners/z4458312751966_a4d358f764972b5361362862171e3f08.jpg" alt="banner sản phẩm" class="img-fluid">
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
          <img src="../public/images/icon/nhandien.png" alt="B&aacute;nh Sinh Nhật Cho B&eacute;">
          <?= mb_strtoupper($cate[$countCate - 4]["cate_name"], 'UTF-8') ?>
        </span>
      </a>
    </div>
    <div class="section-body">
      <div class="tab-content row" id="pills-tabContent">
        <div class="col-md-3 pl-1 pr-1">
          <div class="banner-product">
            <a href="danh-muc/banh-sinh-nhat-cho-be">
              <img src="../public/images/banners/z4458312751966_a4d358f764972b5361362862171e3f08.jpg" alt="banner sản phẩm" class="img-fluid">
            </a>
          </div>
        </div>
        <div class="tab-pane fade show active col-md-9" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
          <div class="row">

            <?php foreach ($product as $p) { ?>
              <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1 my-2">
                <div class="one-product-container">
                  <div class="product-images">
                    <a href="details.php?product_id=<?= $p["product_id"] ?>">
                      <div class="product-image hover-animation" href="san-pham/opera-cake-27">
                        <img src="../<?php echo $p["image"] ?>" alt="Opera Cake " />
                        <img src="../<?php echo $p["image"] ?>" alt="Opera Cake " />
                      </div>
                    </a>
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
                      <a href="details.php?product_id=<?php $p["product_id"] ?>">
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
      </div>
    </div>
  </div>
</section>
<section class="section-paddingY middlw-section home-latest-products mt-5">
  <div class="container">
    <div class="section-header">
      <a class="hover-yellow" href="danh-muc/cookies-va-mini-cake">
        <span class="section-title">
          <img src="../public/images/icon/nhandien.png" alt="Cookies v&agrave; Mini Cake">
          <?= mb_strtoupper($cate[$countCate - 3]["cate_name"], 'UTF-8') ?>
        </span>
      </a>
    </div>
    <div class="section-body">
      <div class="tab-content row" id="pills-tabContent">
        <div class="tab-pane fade show active col-md-9" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
          <div class="row">

            <?php foreach ($product as $p) { ?>
              <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1 my-2">
                <div class="one-product-container">
                  <div class="product-images">
                    <a href="details.php?product_id=<?= $p["product_id"] ?>">
                      <div class="product-image hover-animation" href="san-pham/opera-cake-27">
                        <img src="../<?php echo $p["image"] ?>" alt="Opera Cake " />
                        <img src="../<?php echo $p["image"] ?>" alt="Opera Cake " />
                      </div>
                    </a>
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
                      <a href="details.php?product_id=<?php $p["product_id"] ?>">
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
        <div class="col-md-3 pl-1 pr-1">
          <div class="banner-product">
            <a href="danh-muc/cookies-va-mini-cake">
              <img src="../public/images/banners/z4458312751966_a4d358f764972b5361362862171e3f08.jpg" alt="banner sản phẩm" class="img-fluid">
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
          <img src="../public/images/icon/nhandien.png" alt="B&aacute;nh trung thu">
          <?= mb_strtoupper($cate[$countCate - 2]["cate_name"], 'UTF-8') ?>
        </span>
      </a>
    </div>
    <div class="section-body">
      <div class="tab-content row" id="pills-tabContent">
        <div class="col-md-3 pl-1 pr-1">
          <div class="banner-product">
            <a href="danh-muc/banh-trung-thu">
              <img src="../public/images/banners/z4458312751966_a4d358f764972b5361362862171e3f08.jpg" alt="banner sản phẩm" class="img-fluid">
            </a>
          </div>
        </div>
        <div class="tab-pane fade show active col-md-9" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
          <div class="row">

            <?php foreach ($product as $p) { ?>
              <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1 my-2">
                <div class="one-product-container">
                  <div class="product-images">
                    <a href="details.php?product_id=<?= $p["product_id"] ?>">
                      <div class="product-image hover-animation" href="san-pham/opera-cake-27">
                        <img src="../<?php echo $p["image"] ?>" alt="Opera Cake " />
                        <img src="../<?php echo $p["image"] ?>" alt="Opera Cake " />
                      </div>
                    </a>
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
                      <a href="details.php?product_id=<?php $p["product_id"] ?>">
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
      </div>
    </div>
  </div>
</section>
<section class="section-paddingY middlw-section home-latest-products mt-5">
  <div class="container">
    <div class="section-header">
      <a class="hover-yellow" href="danh-muc/cookies-va-mini-cake">
        <span class="section-title">
          <img src="../public/images/icon/nhandien.png" alt="Cookies v&agrave; Mini Cake">
          <?= mb_strtoupper($cate[$countCate - 1]["cate_name"], 'UTF-8') ?>
        </span>
      </a>
    </div>
    <div class="section-body">
      <div class="tab-content row" id="pills-tabContent">
        <div class="tab-pane fade show active col-md-9" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
          <div class="row">

            <?php foreach ($product as $p) { ?>
              <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1 my-2">
                <div class="one-product-container">
                  <div class="product-images">
                    <a href="details.php?product_id=<?= $p["product_id"] ?>">
                      <div class="product-image hover-animation" href="san-pham/opera-cake-27">
                        <img src="../<?php echo $p["image"] ?>" alt="Opera Cake " />
                        <img src="../<?php echo $p["image"] ?>" alt="Opera Cake " />
                      </div>
                    </a>
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
                      <a href="details.php?product_id=<?php $p["product_id"] ?>">
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
        <div class="col-md-3 pl-1 pr-1">
          <div class="banner-product">
            <a href="danh-muc/cookies-va-mini-cake">
              <img src="../public/images/banners/z4458312751966_a4d358f764972b5361362862171e3f08.jpg" alt="banner sản phẩm" class="img-fluid">
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
              <img src="../public/images/icon/puppets-1.jpg" alt="">
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

<?php require "layout/footer.php" ?>