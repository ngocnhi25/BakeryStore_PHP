<?php
session_start();
require_once('connect/connectDB.php');




if (isset($_SESSION["auth_user"])) {
  $user_id = $_SESSION["auth_user"]["user_id"];
}
// var_dump($user_id);
// die();

// get id form web
if(isset($_GET["product_id"])){
  $id = $_GET['product_id'];
}


//debug product_qty
$product_qty = executeSingleResult("SELECT product_qty FROM tb_warehouse WHERE product_id = $id");
// var_dump($product_qty);
// die();

// Lấy dữ liệu sản phẩm và danh mục tương ứng từ cơ sở dữ liệu
$query = "SELECT p.product_name, p.price, p.image, c.cate_name
          FROM tb_products p
          INNER JOIN tb_cate c ON p.cate_id = c.cate_id";
$products = executeResult($query);


$cartItems = executeResult("SELECT * FROM tb_cart");
$product = executeResult("select * from tb_products where product_id = $id");
$flaror = executeResult("select * from tb_flavor");
$size = executeResult("select * from tb_size");
$thumb = executeResult("select * from tb_thumbnail where product_id = $id");
$imageResult = executeSingleResult("SELECT image FROM tb_products WHERE product_id = $id");
$priceResult = executeSingleResult("SELECT price FROM tb_products WHERE product_id = $id");
$productResult = executeSingleResult("SELECT product_name FROM tb_products WHERE product_id = $id");
$priceResult = executeSingleResult("SELECT price FROM tb_products WHERE product_id = $id");
$percent_sale = executeSingleResult("SELECT percent_sale FROM tb_sale WHERE product_id = $id");
if ($imageResult) {
  $image = $imageResult['image'];
} else {
  echo "Image not available.";
}
if ($priceResult) {
  $price = $priceResult['price'];
} else {
  echo "Price not available.";
}
if ($percent_sale) {
  $percent = intval($percent_sale);
  $discountedPrice = $price - ($price * $percent / 100);
}
// var_dump($percent_sale);
// die();
$idproductResult = executeSingleResult("SELECT product_id FROM tb_products WHERE product_id = $id");
//get name value
if ($productResult) {
  $name = $productResult['product_name'];
} else {
  echo "Name not available.";
}
//get product_id
if ($idproductResult) {
  $id = $idproductResult['product_id'];
} else {
  echo "Name not available.";
}
//Breadcrumbs setup
$productDetails = executeSingleResult("SELECT p.product_name, c.cate_name FROM tb_products p
                                      JOIN tb_category c ON p.cate_id = c.cate_id
                                      WHERE p.product_id = $id");


?>




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
              <?php echo $productDetails['cate_name']; ?>
            </span>
            <meta itemprop="position" content="2" />
          </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page" itemprop="itemListElement" itemscope
          itemtype="https://schema.org/ListItem">
          <a href="#" itemprop="item">
            <span itemprop="name">
              <?php echo $productDetails['product_name']; ?>
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

      <div class="col-md-9">
        <div class="row">
          <div class="col-12 col-lg-7">
            <div class="detail-header show-mobile">

              <h5 class="product-name">
                <?php echo $product["product_name"] ?>
              </h5>

            </div>
            <div class="product-imgs">
              <div class="big-img">
                <img id="mainBigImage" src="../<?php echo $image ?>">
              </div>
              <div class="images">
                <div class="small-img">
                  <img id="originalImage" src="../<?php echo $image ?>">
                </div>
                <?php foreach ($thumb as $index => $t) { ?>
                  <div class="small-img">
                    <img src="../<?php echo $t['thumbnail'] ?>" class="thumbnail-img" data-index="<?php echo $index ?>">
                  </div>
                <?php } ?>
              </div>
            </div>

          </div>
          <div class="col-12 col-lg-5">

            <div class="left">

            </div>

            <div class="right">
              <div class="pname">
                <?php echo $name ?>
              </div>
              <div class="size">
                <p>increaseSize:</p>
                <div id="displayedIncreaseSize">N/A</div>
              </div>
              <div class="size">
                <p>Size:</p>
                <?php foreach ($size as $s) { ?>

                  <button class="sizeBtn" data-size="<?= $s['size_name'] ?>" value="<?= $s['size_name'] ?>"><?php echo $s["size_name"] ?></button>

                <?php } ?>
              </div>
              <div class="size">
                <p>Flavor:</p>
                <?php foreach ($flaror as $f) { ?>
                  <button class="flavorBtn" data-size="<?= $f['flavor_name'] ?>" value="<?= $f['flavor_name'] ?>"><?php echo $f["flavor_name"] ?></button>
                <?php } ?>
              </div>
              <form action="" class="form-submit">
                <!-- Display the original price -->
                <div class="price">
                  <span>Price:</span>
                  <p class="original-price">
                    <?php echo number_format($price, 0) ?>$
                  </p>
                </div>
                <div class="price">
                  <p class="discounted-price" id="price">
                    Sale Price:
                    <?php
                    if (isset($discountedPrice)) {
                      echo number_format($discountedPrice, 0);
                    } else {
                      echo "This product is not on sale.";
                    }
                    ?>
                  </p>
                </div>

                <div class="quantity">
                  <p>Quantity:</p>
                  <input type="number" min="1" max="5" value="1">
                </div>

                <div class="price">
                  <p class="discounted-price" id="price">
                    Cake in warehouse:
                    <?php echo $product_qty['product_qty'] ?> cake
                  </p>
                </div>

                <input type="hidden" class="pid" value="<?php echo $id ?>">
                <input type="hidden" class="name" value="<?php echo $name ?>">
                <input type="hidden" class="IncreaseSize" value="" id="hiddenIncreaseSize">
                <input type="hidden" class="lastPrice" value="<?php
                if (isset($discountedPrice)) {
                  echo $discountedPrice;
                } else {
                  $discountedPrice = $price;
                  echo $discountedPrice;
                }
                ?>">



                <div class="btn-box">
                  <button class="cart-btn add" id="add">Add to Cart</button>
                  <button class="buy-btn">Buy Now</button>
                </div>
              </form>
            </div>
          </div>
          <div class="col-12 mt-5">
            <div class="card-content-pro">
              <ul class="nav nav-pills tabs-categories" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="pills-home-tab-left" data-toggle="pill" href="#pills-home" role="tab"
                    aria-controls="pills-home" aria-selected="true">Mô
                    tả sản phẩm</a>
                </li>
              </ul>

              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                  <p><span style="font-size: 12px;">
                      <?php foreach ($product as $p) { ?>
                        <?php echo $p["description"] ?>
                      <?php } ?>
                    </span></p>

                </div>
              </div>
            </div>
          </div>
          <div class="col-12 mt-5">
            <div class="card-content-pro">

              <div class="clients-carousel owl-carousel">
                <?php foreach ($products as $carou) { ?>
                  <div class="single-box">
                    <div class="content">
                      <img src="<?php echo $carou['image']; ?>" alt="<?php echo $carou['product_name']; ?>">
                      <h4>
                        <?php echo $carou['product_name']; ?>
                      </h4>
                      <p>$
                        <?php echo $carou['price']; ?>
                      </p>
                      <p>Category:
                        <?php echo $carou['cate_name']; ?>
                      </p>
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

<script src="public/plugins/js/jquery3.3.1.min.js"></script>
<script src="public/frontend/assets/js/config.js"></script>
<script src="public/plugins/js/bootstrap4.min.js"></script>
<script src="public/plugins/js/owl.carousel.min.js"></script>
<script src="ajax/libs/lightslider/1.1.6/js/lightslider.min.js"></script>
<script src="ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<script src="public/frontend/js/main.js"></script>
<script src="public/frontend/assets/js/product_page.js"></script>
<script src="public/myplugins/js/messagebox.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  function checkLoginStatus() {
    $.ajax({
      type: "GET",
      url: "handles_page/check_login_status.php",
      success: function (response) {
        if (response === "loggedin") {
          Swal.fire({
            icon: 'success',
            title: 'Logged In',
            text: 'You are currently logged in.',
          });
        } else {
          Swal.fire({
            icon: 'info',
            title: 'Not Logged In',
            text: 'You are not logged in.',
            didClose: () => {
              window.location.href = "User/login.php";
            }
          });
        }
      }
    });
  }
  // Call the function when needed, e.g., on a button click
  $(document).ready(function () {
    $("#add").click(function () {
      checkLoginStatus();
    });
  });

  $(document).ready(function () {
    let selectedSize = "";
    let selectedFlavor = "";

    // Size buttons event listener
    $(".sizeBtn").on("click", function () {
      selectedSize = $(this).val();
      // alert("Selected Size: " + selectedSize);
    });

    // Flavor buttons event listener
    $(".flavorBtn").on("click", function () {
      selectedFlavor = $(this).val();
      // alert("Selected Flavor: " + selectedFlavor);
    });

    // Add to cart button event listener
    $(document).on("click", "#add", function (e) {
      e.preventDefault();
      if (selectedSize == "") {
        Swal.fire({
          icon: 'error',
          title: 'Choose your cake size',
          timer: 2000,
          showConfirmButton: false
        });
        return;
      }
      if (selectedFlavor == "") {
        Swal.fire({
          icon: 'error',
          title: 'Choose your cake size',
          timer: 2000,
          showConfirmButton: false
        });
        return;
      }

      const $form = $(this).closest(".form-submit");
      const pid = $form.find(".pid").val();
      const pname = $form.find(".name").val();
      const increaseSizeText = $("#hiddenIncreaseSize").val();
      const increaseSizeWithoutCommas = increaseSizeText.replace(/,/g, '');
      const increaseSize = parseFloat(increaseSizeWithoutCommas);
      const quantity = $form.find(".quantity input").val();
      const price = parseInt($form.find(".lastPrice").val());
      // alert(price);
      if (parseInt(quantity) > 20) {
        Swal.fire({
          icon: 'error',
          title: 'Quantity must be < 20 ',
          timer: 2000, // Automatically close after 2 seconds
          showConfirmButton: false
        });
        return; // Exit the function to prevent further processing
      }


      // // AJAX request to add product to cart
      $.ajax({
        url: "handles_page/add_to_cart.php",
        method: "POST",
        data: {
          pid: pid,
          pname: pname,
          size: selectedSize,    // Add selected size
          flavor: selectedFlavor, // Add selected flavor
          increaseSize: increaseSize,
          quantity: quantity,
          price: price
        },
        success: function (response) {
          // console.log("Selected Size (in AJAX): " + selectedSize);
          // console.log("Selected Flavor (in AJAX): " + selectedFlavor);
          Swal.fire({
            icon: 'success',
            title: 'Add to cart success',
            timer: 2000, // Automatically close after 2 seconds
            showConfirmButton: false
          });
          // alert(response);
        },
        error: function () {
          alert("Error adding product to cart");
        }
      });
    });
  });

</script>
<script>
  $(document).ready(function () {
    // Add click event listener to the size buttons
    $(".sizeBtn").on("click", function () {
      var selectedSize = $(this).data("size");
      // alert(selectedSize);
      // Make an Ajax request to get the increaseSize based on the selected size
      $.ajax({
        url: "../src/handles_page/get_increase_size.php", // Replace with the actual URL to fetch the increaseSize
        method: "POST",
        data: { size: selectedSize },
        success: function (response) {
          if (response !== "") {
            var formattedIncreaseSize = parseFloat(response).toFixed(0);
            formattedIncreaseSize = formattedIncreaseSize.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            formattedIncreaseSize = "+" + formattedIncreaseSize;

            // Update the displayed increaseSize
            $("#displayedIncreaseSize").text(formattedIncreaseSize);

            // Update the hidden input field
            $(".IncreaseSize").val(formattedIncreaseSize);
          } else {
            $("#displayedIncreaseSize").text("N/A");
            $(".IncreaseSize").val(""); // Reset the hidden input field if needed
          }
        },
        error: function () {
          $("#displayedIncreaseSize").text("Error fetching increaseSize");
          $(".IncreaseSize").val(""); // Reset the hidden input field in case of error
        }
      });
    });
  });


  //chang Big image
  document.addEventListener("DOMContentLoaded", function () {
    const mainBigImage = document.getElementById("mainBigImage");
    const originalImage = document.getElementById("originalImage");
    const thumbnailImages = document.querySelectorAll(".thumbnail-img");

    thumbnailImages.forEach(function (thumbnail) {
      thumbnail.addEventListener("click", function () {
        const index = this.getAttribute("data-index");
        const newImageSrc = this.getAttribute("src");
        updateBigImage(newImageSrc);
      });
    });

    originalImage.addEventListener("click", function () {
      const originalSrc = originalImage.getAttribute("src");
      updateBigImage(originalSrc);
    });

    function updateBigImage(newImageSrc) {
      mainBigImage.src = newImageSrc;
    }
  });

</script>
<script src="../public/frontend/js/product_page.js"></script>
</div>
</body>

</html>