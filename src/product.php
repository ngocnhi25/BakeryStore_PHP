<?php
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

$page = 1;
if (!empty($_GET["page"])) {
  $page = $_GET["page"];
}

// Adjust the number of items per page here (e.g., 3 items per page)
$itemsPerPage = 3;
$start = ($page - 1) * $itemsPerPage;
if ($start < 0)
  $start = 0;

$query = $sql . " LIMIT " . $start . "," . $itemsPerPage;
$faq = $db_handle->runQuery($query);

if (empty($_GET["rowcount"])) {
  $_GET["rowcount"] = $db_handle->numRows($sql);
}

if ($pagination_setting == "prev-next") {
  $perpageresult = $perPage->getPrevNext($_GET["rowcount"], $paginationlink, $pagination_setting);
} else {
  $perpageresult = $perPage->getAllPageLinks($_GET["rowcount"], $paginationlink, $pagination_setting);
}

$output = '';
if (!empty($faq)) {
  foreach ($faq as $sp) {
    $output .= '
<div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
    <div class="one-product-container">
        <div class="product-images">
            <a class="product-image hover-animation" href="details.php?product_id=' . $sp["product_id"] . '">
                <img src="../' . $sp["image"] . '" alt="Valentine cake 006" />
                <img src="../' . $sp["image"] . '" alt="Valentine cake 006" />
            </a>
        </div>
        <div style="margin-left: 15px; margin-right: 15px;">
            <p style="font-size: 21px; font-weight:500; margin: 5px 0px ;">
                <a href="product_details.php?product_id=' . $sp["product_id"] . '">' . $sp["product_name"] . '</a>
                <input type="hidden" name="price" id="price' . $sp["product_id"] . '" value="' . $sp["price"] . '">
                <input type="hidden" name="name" id="name' . $sp["product_id"] . '" value="' . $sp["product_name"] . '">
            </p>
            <div class="">
                <span class="price" style="font-weight: 700; color: red;">' . $sp["price"] . '$</span>
            </div>
            <div class="input_quantity_product">
                
            </div>
            <div style="margin-top: 5px;" class="input_quantity_product">
                <input type="submit" value="Thêm vào giỏ hàng" class="add-to-cart add" id="' . $sp["product_id"] . '" name="add_to_cart">
                <input type="number" width="50px" id="quantity' . $sp["product_id"] . '">
            </div>
        </div>
    </div>
</div>';

  }
} else {
  $output .= '<div class="no-results">No products found.</div>';
}

if (!empty($perpageresult)) {
  $output .= '<div id="pagination">' . $perpageresult . '</div>';
}
// print($output)
?>
<!DOCTYPE html>
<html lang="en">

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
            <li class="item-nav">
              <a href="#" class="open-submenu active">
                B&aacute;nh Sinh Nhật
                <i class="fa fa-angle-down" aria-hidden="true"></i>
              </a>
              <ul class="submenu-category show">
                <?php foreach ($cate as $c) { ?>
                  <li class="item-nav">
                    <a href="danh-muc/gato-kem-tuoi">
                      <?php echo $c["cate_name"] ?>
                    </a>
                  </li>
                <?php } ?>
              </ul>
            </li>
          </ul>
        </div>
        <div class="col-md-9">
          <div class="section-header">
            <p class="section-title">B&aacute;nh Sinh Nhật</p>
            <input type="hidden" name="cate_id" value="1">
          </div>
          <div class="section-body">
            <div class="row" id="pagination-result">
              <?php print($output) ?>
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

  <?php include("layout/footer.php") ?>

  <script>
    $(document).ready(function () {
      $(document).on("click", ".add", function () {
        var id = $(this).attr("id");
        var name = $("#name" + id).val();
        var price = $("#price" + id).val();
        var quantity = $("#quantity" + id).val();

        // Validate the quantity to be a positive integer
        if (quantity === "" || isNaN(quantity) || parseInt(quantity) <= 0) {
          alert("Please enter a valid quantity.");
          return;
        }

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
      });
    });

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
  <script src="public/plugins/js/jquery3.3.1.min.js"></script>
  
  </div>
</body>