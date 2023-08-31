<?php
session_start();
require_once('connect/connectDB.php');

if (isset($_GET["new_id"])) {
  $id = $_GET['new_id'];
  $product = executeSingleResult("SELECT * FROM tb_news WHERE new_id = $id");
  $cate = executeSingleResult("SELECT * FROM tb_news_cate ");
  $news = executeResult("SELECT * FROM tb_news");
}
// $maxProductsToShowCarosel = 10;


// Lấy dữ liệu sản phẩm và danh mục tương ứng từ cơ sở dữ liệu
// $cateProduct = $product["cate_id"];
// $products = executeResult("SELECT * FROM tb_news p
//                           INNER JOIN tb_category c ON p.cate_id = c.cate_id 
//                           where c.cate_id = $cate and p.deleted = 0");
//Breadcrumbs setup

// function productItemDisplay($p)
// {
//   return "
//   <div class='product-images'>
//       <a href='new_details.php?product_id=" . $p['new_title'] . "'>
//         <div class='product-image hover-animation'>
//           <img src='../" . $p['new_image'] . "' alt='Opera Cake ' />
//           <img src='../" . $p['new_image'] . "' alt='Opera Cake ' />
//         </div>
//       </a>


//     </div>
//     <div class='product-info'>
//       <p class='product-name'>
//         <a href='new_details.php?new__id=" . $p['new_id'] . "'>
//           " . $p['new_title'] . "
//         </a>
//       </p>

//     </div>
//   ";
// }
// function showProductCarosel($p)
// {
//   echo "
//   <div class='one-product-container product-carousel'>
//     " . productItemDisplay($p) . "
//   </div>
//   ";
// }
// ?>

<head>
  <style>
    .product_detail_carosel {
      width: 250px;
    }

    .product-page {
      text-align: center;
      /* Để căn giữa tất cả nội dung trong phần product-page */
    }

    .product-name {
      margin-bottom: 20px;
      /* Khoảng cách dưới tiêu đề */
    }

    .product-imgs {
      margin-bottom: 20px;
      /* Khoảng cách dưới hình ảnh */
    }

    .big-img {
      display: inline-block;
      /* Để hình ảnh hiển thị bên cạnh mô tả */
    }

    #mainBigImage {
      max-width: 100%;
      /* Đảm bảo hình ảnh không vượt quá kích thước của phần tử chứa */
    }

    .tab-content {
      text-align: left;
      /* Căn lề trái cho nội dung mô tả */
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
              <?php echo $cate['new_cate_name']; ?>
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

    <h5 class="product-name">
      <?php echo $product["new_title"] ?>
    </h5>


    <div class="product-imgs">
      <div class="big-img">
        <img id="mainBigImage" src="../<?php echo $product["new_image"] ?>">
      </div>

    </div>
    <!-- <div class="tab-content" id="pills-tabContent">
      <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">



      </div>
    </div> -->
    <p>
      <span style="font-size: 12px;">
        <?php echo $product["new_description"] ?>
      </span>
    </p>

  </div>
</section>
<section class="section-paddingY middle-section home-latest-products mt-5">
  <div class="container">
    <div class="section-header">
      <p class="section-title">Related News</p>
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
                <a class="product-image hover-animation" href="new_details.php?new_id=<?= $n["new_id"] ?>">
                  <img src="../<?= $n["new_image"] ?>" alt="">
                </a>
                <span class="name-category">Tin tức</span>
              </div>
              <div class="article-info">
                <p class="article-title">
                  <a href="new_details.php?new_id=<?= $n["new_id"] ?>">
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

<?php include("layout/footer.php"); ?>