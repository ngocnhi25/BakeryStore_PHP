<?php
session_start();
require_once('connect/connectDB.php');
require_once('handles_page/handle_calculate.php');

$arraySale = [];
$maxAdsSmall = 2;
$maxProductsToShow = 6;
$maxProductsToShowCarosel = 10;


$product = executeResult("SELECT * FROM tb_products where deleted = 0 ORDER BY product_id DESC ");
$sale = executeResult("SELECT * FROM tb_sale WHERE CURDATE() BETWEEN start_date AND end_date ORDER BY sale_id DESC");
$productSales = executeResult("SELECT * FROM tb_sale s INNER JOIN tb_products p
                              ON s.product_id = p.product_id 
                              WHERE CURDATE() BETWEEN s.start_date AND s.end_date 
                              ORDER BY s.sale_id DESC");
$productBestSeller = executeResult("SELECT * FROM tb_products p 
                                    INNER JOIN tb_order_detail od ON p.product_id = od.product_id 
                                    INNER JOIN tb_order o ON od.order_id = o.order_id 
                                    WHERE p.deleted = 0 and o.status = 'completed' and 
                                    DATE_FORMAT(o.order_date, '%Y-%m') = DATE_FORMAT(CURRENT_DATE - INTERVAL 1 MONTH, '%Y-%m')
                                    GROUP BY p.product_id 
                                    ORDER BY SUM(od.quantity) DESC");
$ads = executeResult("SELECT * FROM tb_ads WHERE CURDATE() BETWEEN start_date AND end_date ORDER BY ads_id DESC");
$cate = executeResult("SELECT c.cate_id, c.cate_name, SUM(p.view) AS total_views 
                        FROM tb_category c
                        INNER JOIN tb_products p 
                        ON c.cate_id = p.cate_id 
                        GROUP BY c.cate_name
                        ORDER BY total_views DESC,
                        RAND() LIMIT 4
                        ");
$news = executeResult("SELECT * FROM tb_news ");
$countCate = count($cate);

foreach ($sale as $key => $s) {
  $arraySale[$key] = $s["product_id"];
}

function showPecentSale($p)
{
  global $arraySale;
  if (in_array($p['product_id'], $arraySale)) {
    return "
    <div class='product-discount'>
      <span class='text'>-
        " . checkProductPecentSale($p) . " %</span>
    </div>
    ";
  }
}

function checkProductPecentSale($p)
{
  global $sale;
  foreach ($sale as $s) {
    if ($p['product_id'] == $s['product_id']) {
      return ($s['percent_sale']);
      break;
    }
  }
}
function checkProductSalePriceFor($p)
{
  global $sale;
  foreach ($sale as $s) {
    if ($p['product_id'] == $s['product_id']) {
      return calculatePercentPrice($p['price'], $s['percent_sale']);
      break;
    }
  }
}

function showProductSalePrice($p)
{
  global $arraySale;
  if (in_array($p['product_id'], $arraySale)) {
    return "
    <span class='price'> " . checkProductSalePriceFor($p) . " vnđ</span>
    <span class='price-del'> " . displayPrice($p['price']) . " vnđ</span>
    ";
  } else {
    return "<span class='price'>" . displayPrice($p['price']) . " vnđ</span>";
  }
}

function productItemDisplay($p)
{
  return "
  <div class='product-images'>
      <a href='details.php?product_id=" . $p['product_id'] . "'>
        <div class='product-image hover-animation'>
          <img src='../" . $p['image'] . "' alt='Opera Cake ' />
          <img src='../" . $p['image'] . "' alt='Opera Cake ' />
        </div>
      </a>
      " . showPecentSale($p) . "
      <div class='box-actions-hover'>
        <button><a href='details.php?product_id=" . $p['product_id'] . "'><span class='material-symbols-sharp'>visibility</span></a></button>
        <button onclick='addNewCart(" . $p['product_id'] . ")' type='button'><span class='material-symbols-sharp'>add_shopping_cart</span></button>
      </div>
    </div>
    <div class='product-info'>
      <p class='product-name'>
        <a href='details.php?product_id=" . $p['product_id'] . "'>
          " . $p['product_name'] . "
        </a>
      </p>
      <div class='product-price'>
        " . showProductSalePrice($p) . "
      </div>
    </div>
  ";
}

function showProduct($p)
{
  echo "
<div class='col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1 my-2'>
  <div class='one-product-container'>
    " . productItemDisplay($p) . "
  </div>
</div>
  ";
}
function showProductCarosel($p)
{
  echo "
  <div class='one-product-container product-carousel'>
    " . productItemDisplay($p) . "
  </div>
  ";
}

?>

<?php include "layout/header.php" ?>

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
          echo 'details.php?id=' . $a["product_id"];
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
      <?php foreach ($ads as $key => $a) {
        if ($key < $maxAdsSmall) {
          ?>
          <div class="banner-item">
            <a href="<?php if ($a["type_ads"] == 'category') {
              echo 'product.php?cate_id=' . $a["cate_id"];
            } elseif ($a["type_ads"] == 'product') {
              echo 'details.php?id=' . $a["product_id"];
            } elseif ($a["type_ads"] == 'sale') {
              echo 'sale.php';
            } else {
              echo 'news.php';
            } ?>">
              <img src="../<?= $a["image_ads"] ?>" alt="">
            </a>
          </div>
        <?php }
      } ?>
    </div>
  </div>
</section>
<section class="section-paddingY middle-section home-latest-products mt-5">
  <div class="container">
    <div class="section-header">
      <div class="hover-yellow">
        <span class="section-title">
          <img src="../public/images/icon/nhandien.png" alt="B&aacute;nh Sinh Nhật">
          Best Seller in
          <?php echo getMonthNow() ?>
        </span>
      </div>
    </div>
    <div class="section-body">
      <div class="owl-carousel-products owl-carousel owl-theme">
        <?php foreach ($productBestSeller as $key => $p) {
          if ($key < $maxProductsToShowCarosel) {
            showProductCarosel($p);
          }
        } ?>
      </div>
    </div>
  </div>
</section>

<section class="section-paddingY middlw-section home-latest-products mt-5">
  <div class="container">
    <div class="section-header">
      <div class="hover-yellow">
        <span class="section-title">
          <img src="../public/images/icon/nhandien.png" alt="B&aacute;nh Sinh Nhật">
          Product going on sale
        </span>
      </div>
    </div>
    <div class="section-body">
      <div class="owl-carousel-products owl-carousel owl-theme">
        <?php foreach ($productSales as $key => $p) {
          if ($key < $maxProductsToShowCarosel) {
            showProductCarosel($p);
          }
        } ?>
      </div>
    </div>
  </div>
</section>
<section class="section-paddingY middlw-section home-latest-products mt-5">
  <div class="container">
    <div class="section-header">
      <div class="hover-yellow">
        <span class="section-title">
          <img src="../public/images/icon/nhandien.png" alt="B&aacute;nh Sinh Nhật">
          New product
        </span>
      </div>
    </div>
    <div class="section-body">
      <div class="owl-carousel-products owl-carousel owl-theme">
        <?php $count = 0;
        foreach ($product as $key => $p) {
          if ($count < $maxProductsToShowCarosel) {
            $count++;
            showProductCarosel($p);
          } else {
            break;
          }
        } ?>
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
            <img src="../public/images/banners/z4458312751966_a4d358f764972b5361362862171e3f08.jpg"
              alt="banner sản phẩm" class="img-fluid">
          </div>
        </div>
        <div class="tab-pane fade show active col-md-9" id="pills-home" role="tabpanel"
          aria-labelledby="pills-home-tab">
          <div class="row">

            <?php $count = 0;
            foreach ($product as $key => $p) {
              if ($p["cate_id"] == $cate[$countCate - 4]["cate_id"]) {
                if ($count < $maxProductsToShow) {
                  $count++;
                  showProduct($p);
                }
              }
            } ?>

          </div>
          <div class="see-more">
            <a href="product.php?cate_id=<?= $cate[$countCate - 4]["cate_id"] ?>">Xem thêm</a>
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
        <div class="tab-pane fade show active col-md-9" id="pills-home" role="tabpanel"
          aria-labelledby="pills-home-tab">
          <div class="row">

            <?php $count = 0;
            foreach ($product as $key => $p) {
              if ($p["cate_id"] == $cate[$countCate - 3]["cate_id"]) {
                if ($count < $maxProductsToShow) {
                  $count++;
                  showProduct($p);
                }
              }
            } ?>

          </div>
          <div class="see-more">
            <a href="product.php?cate_id=<?= $cate[$countCate - 3]["cate_id"] ?>">Xem thêm</a>
          </div>
        </div>
        <div class="col-md-3 pl-1 pr-1">
          <div class="banner-product">
            <img src="../public/images/banners/z4458312751966_a4d358f764972b5361362862171e3f08.jpg"
              alt="banner sản phẩm" class="img-fluid">
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
            <img src="../public/images/banners/z4458312751966_a4d358f764972b5361362862171e3f08.jpg"
              alt="banner sản phẩm" class="img-fluid">
          </div>
        </div>
        <div class="tab-pane fade show active col-md-9" id="pills-home" role="tabpanel"
          aria-labelledby="pills-home-tab">
          <div class="row">

            <?php $count = 0;
            foreach ($product as $key => $p) {
              if ($p["cate_id"] == $cate[$countCate - 2]["cate_id"]) {
                if ($count < $maxProductsToShow) {
                  $count++;
                  showProduct($p);
                }
              }
            } ?>

          </div>
          <div class="see-more">
            <a href="product.php?cate_id=<?= $cate[$countCate - 2]["cate_id"] ?>">Xem thêm</a>
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
        <div class="tab-pane fade show active col-md-9" id="pills-home" role="tabpanel"
          aria-labelledby="pills-home-tab">
          <div class="row">

            <?php $count = 0;
            foreach ($product as $key => $p) {
              if ($p["cate_id"] == $cate[$countCate - 1]["cate_id"]) {
                if ($count < $maxProductsToShow) {
                  $count++;
                  showProduct($p);
                }
              }
            } ?>

          </div>
          <div class="see-more">
            <a href="product.php?cate_id=<?= $cate[$countCate - 1]["cate_id"] ?>">Xem thêm</a>
          </div>
        </div>
        <div class="col-md-3 pl-1 pr-1">
          <div class="banner-product">
            <img src="../public/images/banners/z4458312751966_a4d358f764972b5361362862171e3f08.jpg"
              alt="banner sản phẩm" class="img-fluid">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<section class="section-paddingY middle-section home-latest-products mt-5">
  <div class="container">
    <div class="section-header">
      <p class="section-title">Birthday Cake News</p>
    </div>
    <div class="section-body">
      <div class="owl-carousel-news owl-carousel owl-theme">
        <?php
        foreach ($news as $key => $n) {
          if ($key > 5) {
            break;
          } else {
            ?>
            <div class="article-column-container">
              <div class="article-image">
                <a class="product-image hover-animation" href="new_details.php?new_id=<?= $n["new_id"]?>">
                  <img src="../<?= $n["new_image"] ?>" alt="">
                </a>
                <span class="name-category">Tin tức</span>
              </div>
              <div class="article-info">
                <p class="article-title">
                  <a href="new_details.php?new_id=<?= $n["new_id"]?>">
                    <?= $n["new_title"] ?>
                  </a>
                </p>
                <p class="article-description">
                  <?= $n["new_summary	"] ?>
                </p>
              </div>
            </div>
          <?php }
        }
        ?>
      </div>
    </div>
  </div>
</section>

<?php require "layout/footer.php" ?>