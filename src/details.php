<?php
session_start();
require_once('connect/connectDB.php');
require_once('handles_page/handle_calculate.php');

$arraySale = [];
$saleProductID = '';

if (isset($_SESSION["auth_user"])) {
  $user_id = $_SESSION["auth_user"]["user_id"];
}
// get id form web
if (isset($_GET["product_id"])) {
  $id = $_GET['product_id'];
  execute("UPDATE tb_products SET view = view + 1 WHERE product_id = $id");
}

$cartItems = executeResult("SELECT * FROM tb_cart");
$product = executeSingleResult("SELECT * FROM tb_products p where product_id = $id");
$cate_id = $product["cate_id"];
$saleProductID = executeSingleResult("SELECT * FROM tb_sale WHERE product_id = $id and CURDATE() BETWEEN start_date AND end_date");
$flaror = executeResult("select * from tb_flavor");
$size = executeResult("SELECT * from tb_size z INNER JOIN tb_cate_size cz ON z.size_id = cz.size_id where cz.cate_id = $cate_id");
$thumb = executeResult("select * from tb_thumbnail where product_id = $id");

$sale = executeResult("SELECT * FROM tb_sale WHERE CURDATE() BETWEEN start_date AND end_date");

// Lấy dữ liệu sản phẩm và danh mục tương ứng từ cơ sở dữ liệu
$products = executeResult("SELECT * FROM tb_products p
                          INNER JOIN tb_category c ON p.cate_id = c.cate_id 
                          where c.cate_id = $cate_id and p.deleted = 0");

//Breadcrumbs setup
$productDetails = executeSingleResult("SELECT p.product_name, c.cate_name FROM tb_products p
                                      JOIN tb_category c ON p.cate_id = c.cate_id
                                      WHERE p.product_id = $id");

foreach ($sale as $key => $s) {
  $arraySale[$key] = $s["product_id"];
}

function calculateSaleProductDetails()
{
  global $saleProductID, $product;
  return calculatePercentPrice($product["price"], $saleProductID["percent_sale"]);
}


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
            <span itemprop="name">Home Page</span>
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
      </ol>
    </nav>
  </div>
</div>
<section class="section-paddingY middle-section product-page">
  <div class="container product_details">
    <div class="row">
      <div class="col-12 col-lg-1">
        <div class="proDetails-images">
          <div class="small-img">
            <img id="originalImage" src="../<?= $product["image"] ?>">
          </div>
          <?php foreach ($thumb as $index => $t) { ?>
            <div class="small-img">
              <img src="../<?php echo $t['thumbnail'] ?>" class="thumbnail-img" data-index="<?php echo $index ?>">
            </div>
          <?php } ?>
        </div>
      </div>
      <div class="col-12 col-lg-6">
        <div class="proDetails-big-img">
          <img id="mainBigImage" src="../<?= $product["image"] ?>">
        </div>
      </div>
      <div class="col-12 col-lg-5">
        <div class="pname" id="proDetail-proID" data-id="<?= $product["product_id"] ?>" data-name="<?= $product["product_name"] ?>"><?= $product["product_name"] ?></div>
        <p class="pd-view">Views: <span><?= $product["view"] ?></span></p>
        <div class="price-details">Price:
          <?php if ($saleProductID != null) { ?>
            <span class="discounted-price" data-addCart="<?= calculatePercentPriceData($product['price'], $saleProductID["percent_sale"]) ?>" data-price="<?= $product['price'] ?>" data-percent="<?= $saleProductID["percent_sale"] ?>">
              <?= calculateSaleProductDetails() ?> vnđ
            </span>
            <span class="original-price">
              <?= displayPrice($product["price"]) ?> vnđ
            </span>
          <?php } else { ?>
            <span class="discounted-price" data-price="<?= $product['price'] ?>" date-percent="0">
              <?= displayPrice($product["price"]) ?> vnđ
            </span>
          <?php } ?>
        </div>
        <div class="choose-gallery">
          <span>Choose cake size:</span>
          <div class="size-btn-items">
            <?php foreach ($size as $key => $s) { ?>
              <button class="sizeBtn <?= ($key == 0 ? 'active' : '') ?>" data-size="<?= $s['cate_size_id'] ?>" data-name="<?= $s['size_name'] ?>" data-increase="<?= $s["increase_size"] ?>">
                <?php echo $s["size_name"] ?>cm
              </button>
            <?php } ?>
          </div>
        </div>
        <div class="choose-gallery">
          <span>Choose cake flavor:</span>
          <div class="flavor-btn-items">
            <?php foreach ($flaror as $key => $f) { ?>
              <button class="flavorBtn <?= ($key == 0 ? 'active' : '') ?>" data-flavor="<?= $f['flavor_name'] ?>" value="<?= $f['flavor_name'] ?>">
                <?php echo $f["flavor_name"] ?>
              </button>
            <?php } ?>
          </div>
        </div>

        <div class="quantity">
          <span>Quantity:</span>
          <div class="btn-quantity">
            <button class="qty-btn-reduce">-</button>
            <input class="qty-product-detail" type="text" value="1" oninput="this.value = this.value.replace(/[^0-9]/g, '');" readonly>
            <button class="qty-btn-increase">+</button>
          </div>
        </div>

        <div class="warehouse">
          <span>Cake in warehouse:</span>
          <span><?= $product['qty_warehouse'] ?> cake</span>
        </div>
        <form action="" class="form-submit">
          <input type="hidden" class="pid" value="<?php echo $id ?>">
          <input type="hidden" class="name" value="<?php echo $name ?>">
          <input type="hidden" class="user_id" value="<?php echo $user_id ?>">
          <input type="hidden" class="IncreaseSize" value="" id="hiddenIncreaseSize">
          <input type="hidden" class="lastPrice" value="<?php
                                                        if (isset($discountedPrice)) {
                                                          echo $discountedPrice;
                                                        } else {
                                                          $discountedPrice = $price;
                                                          echo $discountedPrice;
                                                        }
                                                        ?>">
        </form>

        <div class="btn-box">
          <button class="cart-btn add" id="add">Add to Cart</button>
          <!-- <button class="buy-btn">Buy Now</button> -->
        </div>
      </div>
    </div>
    <div class="col-12 mt-5">
      <div class="card-content-pro">
        <ul class="nav nav-pills tabs-categories" role="tablist">
          <li class="nav-item" style="cursor: none;">
            <a class="nav-link active" id="pills-home-tab-left" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">
              Mô tả sản phẩm
            </a>
          </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

            <p><span style="font-size: 12px;">
                <?php echo $product["description"] ?>
              </span></p>

          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>
<section class="section-paddingY middle-section product-page">
  <!-- Thêm form để thêm hoặc cập nhật đánh giá sản phẩm -->
  <div class="row mt-5">
    <div class="col-12">
      <div class="danhgia">
        <h2>Leave a Review</h2>
        <form class="review-form" action="" method="POST">
          <input type="hidden" name="product_id" value="3"> <!-- Adjust the product ID accordingly -->
          <input type="hidden" name="user_id" value="3"> <!-- Adjust the user ID accordingly -->
          <label for="name">Name:</label>
          <input type="text" name="name" required><br>
          <label for="email">Email:</label>
          <input type="email" name="email" required><br>
          <label for="rating">Rating:</label>
          <select name="rating" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
          </select><br>
          <label for="comment">Comment:</label>
          <textarea name="comment" required></textarea><br>
          <button type="submit" name="submit_danhgia">Submit Review</button>
        </form>
      </div>
    </div>

    <?php
    // Include your danhgia class and other necessary code here
    class Database
    {
      private $hostname;
      private $usernamedb;
      private $passworddb;
      private $database;
      private $conn;

      public function __construct()
      {
        $this->hostname = 'localhost';
        $this->usernamedb = 'root';
        $this->passworddb = '';
        $this->database = 'projecthk2';

        $this->conn = new mysqli($this->hostname, $this->usernamedb, $this->passworddb, $this->database);
        if ($this->conn->connect_error) {
          die("Connection failed: " . $this->conn->connect_error);
        }
      }

      public function insert($query)
      {
        if ($this->conn->query($query) === TRUE) {
          return true;
        } else {
          return false;
        }
      }

      public function select($query)
      {
        $result = $this->conn->query($query);
        return $result;
      }

      // You can add other methods for updating, deleting, etc.
    }

    class danhgia
    {
      private $db;

      public function __construct()
      {
        $this->db = new Database();
      }

      public function insert_danhgia($danhgia_id, $product_id, $user_id, $name, $email, $rating, $comment, $created_at)
      {
        $query = "INSERT INTO reviews (danhgia_id, product_id, user_id, name, email, rating, comment, created_at) 
                  VALUES ('$danhgia_id', '$product_id', '$user_id', '$name', '$email', '$rating', '$comment', '$created_at')";

        $result = $this->db->insert($query);
        return $result;
      }

      public function show_danhgia()
      {
        $query = "SELECT danhgia_id, product_id, name, rating, comment, created_at FROM reviews ORDER BY danhgia_id ASC";
        $result = $this->db->select($query);

        return $result;
      }
      public function isEmailAlreadyReviewed($email, $product_id)
      {
        $query = "SELECT COUNT(*) as count FROM reviews WHERE email = '$email' AND product_id = '$product_id'";
        $result = $this->db->select($query);

        if ($result) {
          $row = $result->fetch_assoc();
          return intval($row['count']) > 0;
        }

        return false;
      }
    }

    $danhgia = new danhgia();

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_danhgia"])) {
      require_once 'connect/connectDB.php'; // Adjust the path to the database file

      $db = new Database();
      $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : null;
      $user_id = $_POST["user_id"];
      $name = $_POST["name"];
      $email = $_POST["email"];
      $rating = $_POST["rating"];
      $comment = $_POST["comment"];
      $created_at = date('Y-m-d H:i:s');

      // Include your review insertion logic here
      if ($danhgia->isEmailAlreadyReviewed($email, $product_id)) {
        echo "Địa chỉ email đã được sử dụng để đánh giá sản phẩm này.";
      } else {
        if (empty($product_id) || empty($user_id) || empty($name) || empty($email) || empty($rating) || empty($comment)) {
          echo "Vui lòng điền đầy đủ thông tin đánh giá.";
        } else {
          $result = $danhgia->insert_danhgia(null, $product_id, $user_id, $name, $email, $rating, $comment, $created_at);
          if ($result) {
            echo "Đánh giá đã được thêm thành công.";
          } else {
            echo "Đã xảy ra lỗi khi thêm đánh giá.";
          }
        }
      }
      // Redirect to a new page or show a success message
    }

    $reviews = $danhgia->show_danhgia();
    $reviewCount = 0;
    $reviewArray = array();

    // if ($reviews) {
    //   // Truy vấn thành công
    //   $reviewArray = array_reverse(mysqli_fetch_all($reviews, MYSQLI_ASSOC));
    //   foreach ($reviewArray as $review) {
    //     // Chỉ đếm các đánh giá của sản phẩm có product_id trùng khớp
    //     if ($review['product_id'] == $product_id) {
    //       $reviewCount++;
    //     }
    //   }
    // }
    if ($reviews) {
      // Truy vấn thành công
      $reviewArray = array_reverse(mysqli_fetch_all($reviews, MYSQLI_ASSOC));

      // Kiểm tra nếu biến $product_id đã khai báo và có giá trị
      if (isset($product_id)) {
        foreach ($reviewArray as $review) {
          // Chỉ đếm các đánh giá của sản phẩm có product_id trùng khớp
          if ($review['product_id'] == $product_id) {
            $reviewCount++;
          }
        }
      }
    }
    ?>
    <style>
      .review-section {
        margin-top: 5rem;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
      }

      .review-form {
        border: 1px solid #ccc;
        padding: 1rem;
        width: 70%;
        max-width: 600px;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
      }

      .review-form label {
        display: block;
        margin-bottom: 0.5rem;
      }

      .review-form input,
      .review-form select,
      .review-form textarea {
        width: 100%;
        padding: 0.5rem;
        margin-bottom: 1rem;
        border: 1px solid #ccc;
        border-radius: 4px;
      }

      .review-form button {
        padding: 0.5rem 1rem;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
      }

      .existing-reviews {
        margin-top: 2rem;
      }

      .review {
        border: 1px solid #ccc;
        padding: 1rem;
        margin-bottom: 1rem;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
      }

      .star {
        color: #f39c12;
      }
    </style>

    <div class="col-12">
      <div class="existing-reviews">
        <h2>
          <?php echo $reviewCount; ?> Comment
        </h2>
        <?php
        if ($reviewCount > 0) {
          foreach ($reviewArray as $review) {
            if ($review['product_id'] == $product_id) {
        ?>
              <div class="review">
                <p><strong>Name:</strong>
                  <?php echo $review['name']; ?> -
                  <?php echo date('M d,Y', strtotime($review['created_at'])); ?>
                </p>
                <p>
                  <?php
                  $ratingValue = intval($review['rating']);
                  for ($i = 1; $i <= 5; $i++) {
                    if ($i <= $ratingValue) {
                      echo '<span class="star star-' . $i . '">&#9733;</span>';
                    } else {
                      echo '<span class="star star-' . $i . '">&#9734;</span>';
                    }
                  }
                  ?>
                </p>
                <p>
                  <?php echo isset($review['comment']) ? $review['comment'] : ''; ?>
                </p>
              </div>
        <?php
            }
          }
        } else {
          echo "<p>No reviews yet.</p>";
        }
        ?>
      </div>
    </div>
  </div>
  <!-- Hiển thị phần đánh giá sản phẩm -->
  <!-- <div class="row mt-5">
            <div class="col-12">
              <h3>Đánh giá sản phẩm</h3>
              <?php
              // Thêm mã PHP để hiển thị danh sách đánh giá
              // $hostname = "localhost";
              // $usernamedb = "root";
              // $passworddb = "";
              // $database = "projecthk2";

              // $conn = new mysqli($hostname, $usernamedb, $passworddb, $database);

              // if ($conn->connect_error) {
              //   die("Connection failed: " . $conn->connect_error);
              // }

              $product_id = 1; // ID của sản phẩm

              // $sql = "SELECT * FROM reviews WHERE product_id = $product_id";
              // $result = $conn->query($sql);
              $reviews = executeResult("SELECT * FROM reviews WHERE product_id = $id");
              if ($reviews) {
                foreach ($reviews as $review) {
                  echo "<p>Người đánh giá: " . $review['name'] . "</p>";
                  echo "<p>Đánh giá: " . $review['rating'] . "/5</p>";
                  echo "<p>Bình luận: " . $review['comment'] . "</p>";
                  echo "<p>Ngày đánh giá: " . $review['created_at'] . "</p>";
                  echo "<hr>";
                }
              } else {
                echo "Chưa có đánh giá nào cho sản phẩm này.";
              }
              ?>
            </div>
          </div> -->
</section>
<section class="section-paddingY middle-section product-page">
  <div class="container">
    <div class="section-body">
      <div class="card-content-pro">
        <div class="related-text">
          <img src="../public/images/icon/nhandien.png" alt="Cookies v&agrave; Mini Cake">
          <span>Related Products</span>
        </div>
        <div class="clients-carousel owl-carousel owl-theme">
          <?php foreach ($products as $p) { ?>
            <div class='col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1 my-2'>
              <div class='one-product-container product-carousel product_detail_carosel'>
                <div class="product-images">
                  <a href="details.php?product_id=<?= $p["product_id"] ?>">
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
                        } ?> %
                      </span>
                    </div>
                  <?php } ?>
                  <div class="box-actions-hover">
                    <button><a href="details.php?product_id=<?= $p["product_id"] ?>"><span class="material-symbols-sharp">visibility</span></a></button>
                    <button onclick="addNewCart(<?= $p['product_id'] ?>)" type="button"><span class="material-symbols-sharp">add_shopping_cart</span></button>
                  </div>
                </div>
                <div class="product-info">
                  <div class="product-name">
                    <a href="details.php?product_id=<?php $p["product_id"] ?>">
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
                        } ?> vnđ
                      </span>
                      <span class="price-del">
                        <?php echo displayPrice($p["price"]) ?> vnđ
                      </span>
                    <?php } else { ?>
                      <span class="price">
                        <?php echo displayPrice($p["price"]) ?> vnđ
                      </span>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include("layout/footer.php"); ?>


<script>
  function checkLoginStatus() {
    $.ajax({
      type: "GET",
      url: "handles_page/check_login_status.php",
      success: function(response) {
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
  $(document).ready(function() {
    $("#add").click(function() {
      checkLoginStatus();
    });
  });

  $(document).ready(function() {

    $(".buy-btn").click(function() {
      const pid = $("#proDetail-proID").data("id");
      const pname = $("#proDetail-proID").data("name");
      const increaseSize = $(".sizeBtn.active").data("increase");
      const size = $(".sizeBtn.active").data("name");
      const flavor = $(".flavorBtn.active").data("flavor");
      const quantity = $(".qty-product-detail").val();
      const price = $(".discounted-price").data("price");
      alert("Product_id: " + pid + ", Product_name: " + pname + ", Increase size: " + increaseSize + ", Size name: " + size + ", Flavor: " + flavor + ", Quantity: " + quantity + ", Price: " + price);
    })


    // Add to cart button event listener
    $(document).on("click", "#add", function(e) {
      e.preventDefault();

      const $form = $(this).closest(".form-submit");
      // const pid = $form.find(".pid").val();
      // const pname = $form.find(".name").val();
      // const increaseSizeText = $("#hiddenIncreaseSize").val();
      // const increaseSizeWithoutCommas = increaseSizeText.replace(/,/g, '');
      // const increaseSize = parseFloat(increaseSizeWithoutCommas);
      // const quantity = $form.find(".quantity input").val();
      // const price = parseInt($form.find(".lastPrice").val());
      // const user_id = $form.find(".user_id").val();
      const pid = $("#proDetail-proID").data("id");
      const pname = $("#proDetail-proID").data("name");
      const increaseSize = $(".sizeBtn.active").data("increase");
      const size = $(".sizeBtn.active").data("name");
      const flavor = $(".flavorBtn.active").data("flavor");
      const quantity = $(".qty-product-detail").val();
      const price = $(".discounted-price").data("price");
      const user_id = $(".user_id").val();

      // // AJAX request to add product to cart
      $.ajax({
        url: "handles_page/add_to_cart.php",
        method: "POST",
        data: {
          pid: pid,
          pname: pname,
          size: size, // Add selected size
          flavor: flavor, // Add selected flavor
          increaseSize: increaseSize,
          quantity: quantity,
          price: price,
          user_id: user_id,
        },
        success: function(response) {
          alert(response);
          // console.log("Selected Flavor (in AJAX): " + selectedFlavor);
          Swal.fire({
            icon: 'success',
            title: 'Add to cart success',
            timer: 2000, // Automatically close after 2 seconds
            showConfirmButton: false
          });
          // alert(response);
        },
        error: function() {
          alert("Error adding product to cart");
        }
      });
    });
  });
</script>
</body>

</html>