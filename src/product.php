<?php
require_once("connect/connectDB.php");
require_once('handles_page/handle_calculate.php');
require_once('handles_page/pagination.php');
$arraySale = [];
$cates = executeResult("SELECT c.cate_id, c.cate_name, SUM(p.view) AS total_views 
                        FROM tb_category c
                        INNER JOIN tb_products p 
                        ON c.cate_id = p.cate_id 
                        GROUP BY c.cate_name
                        ORDER BY total_views DESC");
$sale = executeResult("SELECT * FROM tb_sale WHERE CURDATE() BETWEEN start_date AND end_date");

//xử lý phân trang
$limit = 2;
$page = 1;
$number = 0;
$cate_id = $countResult = '';
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$firstIndex = ($page - 1) * $limit;

if (isset($_GET['cate_id']) && !empty($_GET['cate_id'])) {
  $cate_id = $_GET['cate_id'];
  $sql = 'SELECT * from tb_products where deleted = 0 and cate_id = ' . $cate_id . ' ORDER BY product_id DESC limit ' . $firstIndex . ',' . $limit;
  $product = executeResult($sql);
  $cate = executeSingleResult("SELECT * FROM tb_category WHERE cate_id = $cate_id");
  $countResult = executeSingleResult("SELECT count(product_id) AS total from tb_products where deleted = 0 and cate_id = $cate_id");
} else {
  $countResult = executeSingleResult("SELECT count(product_id) AS total from tb_products where deleted = 0");
  $sql = 'SELECT * from tb_products where deleted = 0 ORDER BY product_id DESC limit ' . $firstIndex . ',' . $limit;
  $product = executeResult($sql);
}
// var_dump($product);
// die();


// đếm số trang
if ($countResult != null) {
  $count = $countResult['total'];
  $number = ceil($count / $limit); // làm tròn chặn trên
}


foreach ($sale as $key => $s) {
  $arraySale[$key] = $s["product_id"];
}

?>
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
          <a href="#" itemprop="item">
            <span itemprop="name"><?= ($cate_id != null ? $cate["cate_name"] : "All Product") ?></span>
            <meta itemprop="position" content="2" />
          </a>
        </li>
      </ol>
    </nav>
  </div>
</div>

<section class="section-paddingY product-collection has-loader">

  <div class="section-loader">
    <i class="fas fa-spinner fa-5x fa-pulse"></i>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-3">

        <ul class="menu-category">
          <li><span class="title-category">Danh mục sản phẩm</span></li>
          <hr>
          <?php foreach ($cates as $c) { ?>
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
                    <a href="details.php?id=<?= $p["product_id"] ?>">
                      <div class="product-image hover-animation">
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
                      <button><a href="details.php?id=<?= $p["product_id"] ?>"><span class="material-symbols-sharp">visibility</span></a></button>
                      <button onclick="addNewProduct(<?= $p['product_id'] ?>)" type="button"><span class="material-symbols-sharp">add_shopping_cart</span></button>
                    </div>
                  </div>
                  <div class="product-info">
                    <div class="product-name">
                      <a href="details.php?id=<?php $p["product_id"] ?>">
                        <?php echo $p["product_name"] ?>
                      </a>
                    </div>
                    <div class="product-price">
                      <?php if (in_array($p["product_id"], $arraySale)) { ?>
                        <span class="price">
                          <?php foreach ($sale as $s) {
                            if ($p["product_id"] == $s["product_id"]) {
                              echo calculatePercentPrice($p["price"], $s["percent_sale"]);
                              break;
                            }
                          } ?> vnđ</span>
                        <span class="price-del"><?php echo displayPrice($p["price"]) ?> vnđ</span>
                      <?php } else { ?>
                        <span class="price"><?php echo displayPrice($p["price"]) ?> vnđ</span>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>

          </div>
          <div class="pagination-prod">
            <?php Pagination($number, $page, '', $cate_id); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include("layout/footer.php") ?>