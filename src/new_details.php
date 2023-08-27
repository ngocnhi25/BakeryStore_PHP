<?php
session_start();
require_once('connect/connectDB.php');

if (isset($_GET["new_id"])) {
  $id = $_GET['new_id'];
  $product = executeSingleResult("SELECT * FROM tb_news WHERE new_id = $id");
  $cate = executeSingleResult("SELECT * FROM tb_category ");
}

// Lấy dữ liệu sản phẩm và danh mục tương ứng từ cơ sở dữ liệu
// $cateProduct = $product["cate_id"];
// $products = executeResult("SELECT * FROM tb_news p
//                           INNER JOIN tb_category c ON p.cate_id = c.cate_id 
//                           where c.cate_id = $cate and p.deleted = 0");
//Breadcrumbs setup

?>



<head>
  <style>
    .product_detail_carosel {
      width: 250px;
    }
  </style>
</head>
<?php include("layout/header.php") ?>
<?php if (isset($_SESSION['status'])) { ?>
  <script>
    alert('<?php echo $_SESSION['status']; ?>');
  </script>
  <?php
  unset($_SESSION['status']); // Clear the session status after displaying
}
?>

<div class="breadcrumb">
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
          <a href="/" itemprop="item">
            <span itemprop="name">Trang chủ</span>
            <meta itemprop="position" content="1" />
          </a>
        </li>
        <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
          <a href="#" itemprop="item">
            <span itemprop="name">
              <?php echo $cate['cate_name']; ?>
            </span>
            <meta itemprop="position" content="2" />
          </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page" itemprop="itemListElement" itemscope
          itemtype="https://schema.org/ListItem">
          <a href="#" itemprop="item">
            <span itemprop="name">
              <?php echo $product['new_title']; ?>
            </span>
            <meta itemprop="position" content="3" />
          </a>
        </li>
      </ol>
    </nav>
  </div>
</div>
<section class="section-paddingY middle-section product-page">
  <div class="container">
    <div class="row">
      <!-- <div class="col-md-3">
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
      </div> -->
      <div class="col-md-9">
        <div class="row">
          <div class="col-12 col-lg-7">
            <div class="detail-header show-mobile">

              <h5 class="product-name">
                <?php echo $product["new_title"] ?>
              </h5>

            </div>
            <div class="product-imgs">
              <div class="big-img">
                <img id="mainBigImage" src="../<?php echo $image ?>">
              </div>
              
            </div>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                  <p><span style="font-size: 12px;">
                      <?php echo $product["new_description"] ?>
                    </span></p>

                </div>
              </div>
          </div>


          <!-- <div class="col-12 mt-5">
            <div class="card-content-pro">

              <div class="clients-carousel owl-carousel">
                <?php foreach ($products as $carou) { ?>
                  <div class="single-box">
                    <div class="content">
                      <img src="<?php echo $carou['image']; ?>" alt="<?php echo $carou['new_title']; ?>">
                      <h4>
                        <?php echo $carou['new_title']; ?>
                      </h4>

                    </div>
                  </div>
                <?php } ?>
              </div>

            </div>
          </div> -->
          <div class="col-12 mt-5">
            <div class="card-content-pro">

              <div class="clients-carousel owl-carousel owl-theme">
                <?php foreach ($product as $p) { ?>
                  <div class='col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1 my-2'>
                    <div class='one-product-container product-carousel product_detail_carosel'>
                      <div class="product-images">
                        <a href="new_details.php?new_id=<?= $p["new_id"] ?>">
                          <div class="product-image hover-animation">
                            <img src="../<?php echo $p["image"] ?>" alt="Opera Cake " />
                            <img src="../<?php echo $p["image"] ?>" alt="Opera Cake " />
                          </div>
                        </a>
                        
                      </div>
                      <div class="product-info">
                        <div class="product-name">
                          <a href="new_details.php?new_id=<?php $p["new_id"] ?>">
                            <?php echo $p["new_title"] ?>
                          </a>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </div>

            </div>
          </div>


          <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js">
          </script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.min.js">
          </script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js">
          </script>
          <script>
            $('.clients-carousel').owlCarousel({
              loop: true,
              nav: false,
              autoplay: true,
              autoplayTimeout: 5000,
              animateOut: 'fadeOut',
              animateIn: 'fadeIn',
              smartSpeed: 450,
              margin: 30,
              responsive: {
                0: {
                  items: 1
                },
                768: {
                  items: 2
                },
                991: {
                  items: 2
                },
                1200: {
                  items: 2
                },
                1920: {
                  items: 2
                }
              }
            });
          </script>


        </div>
      </div>
    </div>
  </div>
</section>

<?php include("layout/footer.php"); ?>