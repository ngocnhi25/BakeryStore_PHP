<?php
session_start();
require_once('connect/connectDB.php');
require_once('handles_page/handle_calculate.php');

$arraySale = [];


if (isset($_SESSION["auth_user"])) {
  $user_id = $_SESSION["auth_user"]["user_id"];
}
// get id form web
if (isset($_GET["product_id"])) {
  $id = $_GET['product_id'];
  execute("UPDATE tb_products SET view = view + 1 WHERE product_id = $id");
}

$cartItems = executeResult("SELECT * FROM tb_cart");
$product = executeSingleResult("SELECT * FROM tb_products where product_id = $id");
$cate_id = $product["cate_id"];
$flaror = executeResult("select * from tb_flavor");
$size = executeResult("SELECT * from tb_size z INNER JOIN tb_cate_size cz ON z.size_id = cz.size_id where cz.cate_id = $cate_id");
var_dump($size);
$thumb = executeResult("select * from tb_thumbnail where product_id = $id");
$sale = executeResult("SELECT * FROM tb_sale WHERE CURDATE() BETWEEN start_date AND end_date");
$percent_sale = executeSingleResult("SELECT percent_sale FROM tb_sale WHERE product_id = $id");

// Lấy dữ liệu sản phẩm và danh mục tương ứng từ cơ sở dữ liệu
$cateProduct = $product["cate_id"];
$products = executeResult("SELECT * FROM tb_products p
                          INNER JOIN tb_category c ON p.cate_id = c.cate_id 
                          where c.cate_id = $cateProduct and p.deleted = 0");

if ($product) {
  $image = $product['image'];
} else {
  echo "Image not available.";
}
if ($product) {
  $price = $product['price'];
} else {
  echo "Price not available.";
}
if ($percent_sale) {
  $percent = intval($percent_sale);
  $discountedPrice = $price - ($price * $percent / 100);
}

$idproductResult = executeSingleResult("SELECT product_id FROM tb_products WHERE product_id = $id");
//get name value
if ($product) {
  $name = $product['product_name'];
} else {
  echo "Name not available.";
}
//get product_id
if ($product) {
  $id = $product['product_id'];
} else {
  echo "Name not available.";
}
//Breadcrumbs setup
$productDetails = executeSingleResult("SELECT p.product_name, c.cate_name FROM tb_products p
                                      JOIN tb_category c ON p.cate_id = c.cate_id
                                      WHERE p.product_id = $id");

foreach ($sale as $key => $s) {
  $arraySale[$key] = $s["product_id"];
}


?>


<head>
  <style>
    .product_detail_carosel {
      width: 250px;
    }
    .form {
      margin-left: 200px;
      margin-right: 200px;
      margin-top: 50px;
      background-color:#fff;
    }
    .form .comment-form {
      padding: 20px ;
    }
    comment-form, .comments {
    width: 80%;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="text"], textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
  margin-top: 20px;
    padding: 10px 20px;
    background-color:darkgray;
    width: 100px;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

ul {
    list-style: none;
    padding: 0;
}

li {
    margin-bottom: 10px;
    
    padding: 10px;
    
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
            <img id="originalImage" src="../<?php echo $image ?>">
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
          <img id="mainBigImage" src="../<?php echo $image ?>">
        </div>
      </div>
      <div class="col-12 col-lg-5">
        <div class="pname"><?php echo $name ?></div>
        <p class="pd-view">Views: <span><?= $product["view"] ?></span></p>
        <div class="price-details">Price:
          <?php if (in_array($product["product_id"], $arraySale)) { ?>
            <span class="discounted-price">
              <?php foreach ($sale as $s) {
                if ($product["product_id"] == $s["product_id"]) {
                  echo calculatePercentPrice($product["price"], $s["percent_sale"]);
                  break;
                }
              } ?> vnđ
            </span>
            <span class="original-price">
              <?php echo displayPrice($product["price"]) ?> vnđ
            </span>
          <?php } else { ?>
            <span class="discounted-price">
              <?= displayPrice($product["price"]) ?> vnđ
            </span>
          <?php } ?>
        </div>
        <div class="choose-gallery">
          <span>Choose cake size:</span>
          <div class="size-btn-items">
            <?php foreach ($size as $key => $s) { ?>
              <button class="sizeBtn <?= ($key == 0 ? 'active' : '') ?>" data-size="<?= $s['cate_size_id'] ?>" data-cate="<?= $s['cate_id'] ?>">
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
          <p>Quantity:</p>
          <input type="number" min="1" max="5" value="1">
        </div>

        <div class="price">
          <p class="discounted-price" id="price">
            Cake in warehouse:
            <?php echo $product['qty_warehouse'] ?> cake
          </p>
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
          <button class="buy-btn">Buy Now</button>
        </div>
      </div>
    </div>
    <div class="col-12 mt-5">
      <div class="card-content-pro">
        <ul class="nav nav-pills tabs-categories" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="pills-home-tab-left" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">
              Description
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

<div class="form">
<div class="comment-form">
        <h3>Comment</h3>
        <form id="commentForm">
            <!-- <label for="name">Name:</label> -->
            <input type="hidden" id="name" name="name" required>
            
            <!-- <label for="comment">Comment:</label> -->
            <textarea id="comment" name="comment" rows="3" placeholder="Please comment or ask questions" required></textarea>
            <br><br>
            
            <button type="submit">Submit</button>
        </form>
    </div>
    
    <div class="comments">
        <ul id="commentList">
            <!-- Comments will be added dynamically here -->
        </ul>
    </div>
</div>

    

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
  <div class="col-12 mt-5">
    <div class="card-content-pro">

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
      autoplayTimeout: 3000,
      animateOut: 'fadeOut',
      animateIn: 'fadeIn',
      smartSpeed: 450,
      margin: 10,
      autoplaySpeed: 1000,
      responsive: {
        0: {
          items: 2,
        },
        600: {
          items: 3,
        },
        1000: {
          items: 3,
        },
      },
      navText: [
        '<i class="fa fa-chevron-left" aria-hidden="true"></i>',
        '<i class="fa fa-chevron-right" aria-hidden="true"></i>',
      ],
    });
  </script>
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
    let selectedSize = "";
    let selectedFlavor = "";

    $(".buy-btn").click(function() {
      const valueSize = $(".sizeBtn.active").data("size");
      const valueFlavor = $(".flavorBtn.active").data("flavor");
      alert(valueSize + ", " + valueFlavor);
    })

    $(".sizeBtn").on("click", function() {
      $(this).siblings().removeClass("active");
      $(this).addClass("active");
      selectedSize = $(this).val();
      var selectedSize_id = $(this).data("size");
      // var selectedCateID = $(this).data("cate");

      console.log(selectedSize_id);
      $.ajax({
        url: "handles_page/get_increase_size.php", // Replace with the actual URL to fetch the increaseSize
        method: "POST",
        data: {
          size: selectedSize_id
        },
        success: function(res) {
          alert(res)
          // if (response !== "") {
          //   var formattedIncreaseSize = parseFloat(response).toFixed(0);
          //   formattedIncreaseSize = formattedIncreaseSize.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
          //   formattedIncreaseSize = "+" + formattedIncreaseSize;

          //   // Update the displayed increaseSize
          //   $("#displayedIncreaseSize").text(formattedIncreaseSize);

          //   // Update the hidden input field
          //   $(".IncreaseSize").val(formattedIncreaseSize);
          // } else {
          //   $("#displayedIncreaseSize").text("N/A");
          //   $(".IncreaseSize").val(""); // Reset the hidden input field if needed
          // }
        },
        error: function() {
          $("#displayedIncreaseSize").text("Error fetching increaseSize");
          $(".IncreaseSize").val(""); // Reset the hidden input field in case of error
        }
      });
    });

    // Flavor buttons event listener
    $(".flavorBtn").on("click", function() {
      $(this).siblings().removeClass("active");
      $(this).addClass("active");
      selectedFlavor = $(this).val();
    });

    // Add to cart button event listener
    $(document).on("click", "#add", function(e) {
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
      const user_id = $form.find(".user_id").val();
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
          size: selectedSize, // Add selected size
          flavor: selectedFlavor, // Add selected flavor
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
<script>
  //chang Big image
  document.addEventListener("DOMContentLoaded", function() {
    const mainBigImage = document.getElementById("mainBigImage");
    const originalImage = document.getElementById("originalImage");
    const thumbnailImages = document.querySelectorAll(".thumbnail-img");

    thumbnailImages.forEach(function(thumbnail) {
      thumbnail.addEventListener("click", function() {
        const index = this.getAttribute("data-index");
        const newImageSrc = this.getAttribute("src");
        updateBigImage(newImageSrc);
      });
    });

    originalImage.addEventListener("click", function() {
      const originalSrc = originalImage.getAttribute("src");
      updateBigImage(originalSrc);
    });

    function updateBigImage(newImageSrc) {
      mainBigImage.src = newImageSrc;
    }
  });
</script>
</body>

</html>