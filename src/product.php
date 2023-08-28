<?php
session_start();
require_once("connect/connectDB.php");
$cates = executeResult("SELECT c.cate_id, c.cate_name, SUM(p.view) AS total_views 
                        FROM tb_category c
                        INNER JOIN tb_products p 
                        ON c.cate_id = p.cate_id 
                        GROUP BY c.cate_name
                        ORDER BY total_views DESC");
        
if(isset($_GET["cate_id"])){
  $cate_id_filter = $_GET["cate_id"];
}

function checkedFilter($value)
{
    global $cate_id_filter;
    echo $cate_id_filter == $value ? "checked" : "";
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
        <!-- <li class="breadcrumb-item active" aria-current="page" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
          <a href="#" itemprop="item">
            <span itemprop="name"><?= ($cate_id != null ? $cate["cate_name"] : "All Product") ?></span>
            <meta itemprop="position" content="2" />
          </a>
        </li> -->
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
        <div class="menu-category">
          <div class="title-filter">
            <div class="title-category">
              <span class="material-symbols-sharp">tune</span>
              <span>Product portfolio</span>
            </div>
          </div>
          <hr>
          <?php foreach ($cates as $c) { ?>
            <div class="item-nav">
              <div>
                <input type="checkbox" value="<?= $c["cate_id"] ?>" class="product_check" id="filter_cate" <?php checkedFilter($c["cate_id"]) ?>>
              </div>
              <div>
                <?= $c["cate_name"] ?>
              </div>
            </div>
          <?php } ?>
          <div class="title-filter">
            <div class="title-category">
              <span class="material-symbols-sharp">filter_alt</span>
              <span>Search filter</span>
            </div>
          </div>
          <hr>
          <div class="item-cate">
            Promotion & Services
          </div>
          <div>
            <div class="item-nav">
              <div>
                <input type="checkbox" value="on_sale" class="product_check" id="on_sale">
              </div>
              <div>
                On sale
              </div>
            </div>
            <div class="item-nav">
              <div>
                <input type="checkbox" value="view" class="product_check" id="filter_view">
              </div>
              <div>
                Many viewers
              </div>
            </div>
          </div>
          <div class="item-cate">
            Price range
          </div>
          <div class="item-range">
            <div class="search-filter-price-box">
              <div class="search-filter-price">
                <input class="input-from-price" type="text" placeholder="from" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
              </div>
              <div>
                -
              </div>
              <div class="search-filter-price">
                <input class="input-to-price" type="text" placeholder="to" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
              </div>
            </div>
            <div class="error-input-filter-price-box"></div>
            <div>
              <button type="button" class="apply-price">Apply</button>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-9">
        <div class="section-header">
          <p class="section-title"></p>
          <input type="hidden" name="cate_id" value="1">
        </div>
        <!-- products -->
        <div class="section-body get-product-box"></div>
      </div>
    </div>
  </div>
</section>

<?php include("layout/footer.php") ?>