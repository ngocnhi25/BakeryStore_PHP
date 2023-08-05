<?php
<<<<<<< HEAD
require_once("./connect/connectDB.php");
require_once("./connect/dbcontroller.php");
require_once("./handles_page/pagination.class.php");
$sanpham = executeResult("SELECT * from tb_products");
$cate = executeResult("SELECT * FROM tb_category");
$db_handle = new DBController();
$perPage = new PerPage();

$sql = "SELECT * FROM tb_products";
$paginationlink = "./handles_page/getresult.php?page=";
$pagination_setting = isset($_GET["pagination_setting"]) ? $_GET["pagination_setting"] : "";
=======
require_once("connect/connectDB.php");
// include("getresult.php");
// require_once("connect/dbcontroller.php");
// require_once("pagination.class.php");
require_once('handles_page/handle_display.php');
require_once('handles_page/handle_calculate.php');
require_once('handles_page/pagination.php');
>>>>>>> fcfbcdcff6f265b23034715116cd3ecfc28aa788

//xử lý phân trang
$limit = 1;
$page = 1;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}

$firstIndex = ($page - 1) * $limit;
$sql = 'SELECT * from tb_products where deleted = 0 ORDER BY product_id DESC limit ' . $firstIndex . ',' . $limit;
$product = executeResult($sql);

// đếm số trang
$countResult = executeSingleResult("SELECT count(product_id) AS total from tb_products where deleted = 0");
$number = 0;
if ($countResult != null) {
  $count = $countResult['total'];
  $number = ceil($count / $limit); // làm tròn chặn trên
}

$cate = executeResult("SELECT * FROM tb_category");
$sale = executeResult("SELECT * FROM tb_sale");

foreach ($sale as $key => $s) {
  $arraySale[$key] = $s["product_id"];
}

?>
<?php include("layout/header.php"); ?>

<<<<<<< HEAD
<head>
  <meta charset="utf-8">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Bánh Sinh Nhật - Bánh Sinh Nhật Thu Hương Bakery since 1996</title>

  <!-- FONT -->
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Cabin" />
  <!-- FONT -->

  <!-- PLUGIN JS -->
  <link rel="stylesheet" href="../public/frontend/js/librarys_js/jquery3.3.1.min.js">
  <link rel="stylesheet" href="../public/frontend/js/librarys_js/owl.carousel.min.js">
  <link rel="stylesheet" href="../public/frontend/js/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js">
  <link rel="stylesheet" href="../public/frontend/js/config.js">
  <link rel="stylesheet" href="../public/frontend/js/product_page.js">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css">
  <!-- PLUGIN JS -->

  <style>
    .link {
      padding: 10px 15px;
      background: transparent;
      border: #bccfd8 1px solid;
      border-left: 0px;
      cursor: pointer;
      color: #607d8b
    }

    .disabled {
      cursor: not-allowed;
      color: #bccfd8;
    }

    .current {
      background: #bccfd8;
    }

    .first {
      border-left: #bccfd8 1px solid;
    }

    .question {
      font-weight: bold;
    }

    .answer {
      padding-top: 10px;
    }

    #pagination {
      margin-top: 20px;
      padding-top: 30px;
      border-top: #F0F0F0 1px solid;
    }

    .dot {
      padding: 10px 15px;
      background: transparent;
      border-right: #bccfd8 1px solid;
    }

    #overlay {
      background-color: rgba(0, 0, 0, 0.6);
      z-index: 999;
      position: absolute;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      display: none;
    }

    #overlay div {
      position: absolute;
      left: 50%;
      top: 50%;
      margin-top: -32px;
      margin-left: -32px;
    }

    .page-content {
      padding: 20px;
      margin: 0 auto;
    }

    .pagination-setting {
      padding: 10px;
      margin: 5px 0px 10px;
      border: #bccfd8 1px solid;
      color: #607d8b;
    }
  </style>

  <!-- PLUGIN CSS -->
  <link rel="stylesheet" href="../public/frontend/js/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
  <link rel="stylesheet" href="../public/frontend/css/librarys_css/css/bootstrap4.min.css">
  <link rel="stylesheet" href="../public/frontend/css/lightslider.css">
  <link href="../public/frontend/css/style.css" rel="stylesheet">
  <!-- PLUGIN CSS -->

</head>

<body>
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
          <li class="breadcrumb-item active" aria-current="page" itemprop="itemListElement" itemscope
            itemtype="https://schema.org/ListItem">
            <a href="#" itemprop="item">
              <span itemprop="name">B&aacute;nh Sinh Nhật</span>
              <meta itemprop="position" content="2" />
            </a>
          </li>
        </ol>
      </nav>
    </div>
=======
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
          <a href="#" itemprop="item">
            <span itemprop="name">B&aacute;nh Sinh Nhật</span>
            <meta itemprop="position" content="2" />
          </a>
        </li>
      </ol>
    </nav>
>>>>>>> fcfbcdcff6f265b23034715116cd3ecfc28aa788
  </div>
</div>

<section class="section-paddingY product-collection has-loader">

<<<<<<< HEAD
    <div class="section-loader">
      <i class="fas fa-spinner fa-5x fa-pulse"></i>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <ul class="menu-category">
            <li><span class="title-category">Danh mục sản phẩm</span></li>
            <hr>
=======
  <div class="section-loader">
    <i class="fas fa-spinner fa-5x fa-pulse"></i>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-3">

        <ul class="menu-category">
          <li><span class="title-category">Danh mục sản phẩm</span></li>
          <hr>
          <?php foreach ($cate as $c) { ?>
>>>>>>> fcfbcdcff6f265b23034715116cd3ecfc28aa788
            <li class="item-nav">
              <a href="danh-muc/gato-kem-tuoi">
                <?php echo $c["cate_name"] ?>
              </a>
            </li>
          <?php } ?>
        </ul>
      </div>
      <div class="col-md-9">
        <div class="section-header">
          <p class="section-title">B&aacute;nh Sinh Nhật</p>
          <input type="hidden" name="cate_id" value="1">
        </div>
        <div class="section-body">
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
          <div>
            <?php Pagination($number, $page, ''); ?>
          </div>
        </div>
        <div class="page-content">
          <div>
            <input type="hidden" name="rowcount" id="rowcount" />
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<<<<<<< HEAD
<<<<<<< HEAD
  <?php include("layout/footer.php") ?>

=======
>>>>>>> 6a2cdc041073bd8d61e95e11d931b82734029d9e
  <script>
    $(document).ready(function () {
      $(document).on("click", ".add", function () {
        var id = $(this).attr("id");
        var name = $("#name" + id).val();
        var price = $("#price" + id).val();
        var quantity = $("#quantity" + id).val();
=======
<script>
  $(document).ready(function() {
    $(document).on("click", ".add", function() {
      var id = $(this).attr("id");
      var name = $("#name" + id).val();
      var price = $("#price" + id).val();
      var quantity = $("#quantity" + id).val();
>>>>>>> fcfbcdcff6f265b23034715116cd3ecfc28aa788

      // Validate the quantity to be a positive integer
      if (quantity === "" || isNaN(quantity) || parseInt(quantity) <= 0) {
        alert("Please enter a valid quantity.");
        return;
      }

      $.ajax({
        method: "POST",
        url: "add_to_cart.php",
        data: {
          id: id,
          name: name,
          price: price,
          quantity: quantity
        }, // Include the quantity in the data sent to the server
        success: function(data) {
          alert("You have added a new item to the cart.");
          // Optional: You may update the cart count or display a message to the user.
        },
        error: function(xhr, textStatus, errorThrown) {
          alert("An error occurred while adding the item to the cart. Please try again.");
        }
<<<<<<< HEAD

        $.ajax({
          method: "POST",
          url: "./handles_page/add_to_cart.php",
          data: { id: id, name: name, price: price, quantity: quantity }, // Include the quantity in the data sent to the server
          success: function (data) {
            alert("You have added a new item to the cart.");
            // Optional: You may update the cart count or display a message to the user.
          },
          error: function (xhr, textStatus, errorThrown) {
            alert("An error occurred while adding the item to the cart. Please try again.");
          }
        });
=======
>>>>>>> fcfbcdcff6f265b23034715116cd3ecfc28aa788
      });
    });
  });

<<<<<<< HEAD
    function getresult(url) {
      $.ajax({
        url: url,
        type: "GET",
        data: { rowcount: $("#rowcount").val(), "pagination_setting": $("#pagination-setting").val() },
        success: function (data) {
          $("#pagination-result").html(data);
        },
        error: function () { }
      });
    }
    // function changePagination(option) {
    //   if (option != "") {
    //     getresult("getresult.php");
    //   }
    // }
  </script>
<<<<<<< HEAD
  <script src="public/plugins/js/jquery3.3.1.min.js"></script>
  
  </div>
</body>
=======

  <?php include("layout/footer.php") ?>
>>>>>>> 6a2cdc041073bd8d61e95e11d931b82734029d9e
=======
  function getresult(url) {
    $.ajax({
      url: url,
      type: "GET",
      data: {
        rowcount: $("#rowcount").val(),
        "pagination_setting": $("#pagination-setting").val()
      },
      success: function(data) {
        $("#pagination-result").html(data);
      },
      error: function() {}
    });
  }
  // function changePagination(option) {
  //   if (option != "") {
  //     getresult("getresult.php");
  //   }
  // }
</script>

<?php include("layout/footer.php") ?>
>>>>>>> fcfbcdcff6f265b23034715116cd3ecfc28aa788
