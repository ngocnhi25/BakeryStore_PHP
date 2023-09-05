<?php
session_start();
require_once('connect/connectDB.php');
require_once('handles_page/handle_calculate.php');

$arraySale = [];
$saleProductID = '';
$product_id_from_url = isset($_GET['product_id']) ? $_GET['product_id'] : null;
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
$flaror = executeResult("SELECT * from tb_flavor WHERE deleted_flavor = 0 and qti_flavor > 0");
$size = executeResult("SELECT * from tb_size z 
                        INNER JOIN tb_cate_size cz ON z.size_id = cz.size_id 
                        where cz.cate_id = $cate_id and z.deleted_size = 0 and z.qti_boxes_size > 0 
                        ORDER BY z.size_name ASC");
$thumb = executeResult("SELECT * from tb_thumbnail where product_id = $id");

$sale = executeResult("SELECT * FROM tb_sale WHERE CURDATE() BETWEEN start_date AND end_date");

// Lấy dữ liệu sản phẩm và danh mục tương ứng từ cơ sở dữ liệu
$products = executeResult("SELECT * FROM tb_products p
                          INNER JOIN tb_category c ON p.cate_id = c.cate_id 
                          where c.cate_id = $cate_id and p.deleted = 0");

//Breadcrumbs setup
$productDetails = executeSingleResult("SELECT p.product_name, c.cate_name, p.cate_id FROM tb_products p
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
          <a href="home.php" itemprop="item">
            <span itemprop="name">Home Page</span>
            <meta itemprop="position" content="1" />
          </a>
        </li>
        <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
          <a href="product.php?cate_id=<?= $productDetails["cate_id"] ?>" itemprop="item">
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
        <div class="pname" id="proDetail-proID" data-id="<?= $product["product_id"] ?>"
          data-name="<?= $product["product_name"] ?>"><?= $product["product_name"] ?></div>
        <p class="pd-view">Views: <span>
            <?= $product["view"] ?>
          </span></p>
        <div class="price-details">Price:
          <?php if ($saleProductID != null) { ?>
            <span class="discounted-price"
              data-addCart="<?= calculatePercentPriceData($product['price'], $saleProductID["percent_sale"]) ?>"
              data-price="<?= $product['price'] ?>" data-percent="<?= $saleProductID["percent_sale"] ?>">
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
              <button class="sizeBtn <?= ($key == 0 ? 'active' : '') ?>" data-size="<?= $s['cate_size_id'] ?>"
                data-name="<?= $s['size_name'] ?>" data-increase="<?= $s["increase_size"] ?>">
                <?php echo $s["size_name"] ?>cm
              </button>
            <?php } ?>
          </div>
        </div>
        <div class="choose-gallery">
          <span>Choose cake flavor:</span>
          <div class="flavor-btn-items">
            <?php foreach ($flaror as $key => $f) { ?>
              <button class="flavorBtn <?= ($key == 0 ? 'active' : '') ?>" data-flavor="<?= $f['flavor_name'] ?>"
                value="<?= $f['flavor_name'] ?>">
                <?php echo $f["flavor_name"] ?>
              </button>
            <?php } ?>
          </div>
        </div>

        <div class="quantity">
          <span>Quantity:</span>
          <div class="btn-quantity">
            <button class="qty-btn-reduce">-</button>
            <input class="qty-product-detail" type="text" value="1"
              oninput="this.value = this.value.replace(/[^0-9]/g, '');" readonly>
            <button class="qty-btn-increase">+</button>
          </div>
        </div>

        <div class="warehouse">
          <span>Cake in warehouse:</span>
          <span>
            <?= $product['qty_warehouse'] ?> cake
          </span>
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
            <a class="nav-link active" id="pills-home-tab-left" data-toggle="pill" href="#pills-home" role="tab"
              aria-controls="pills-home" aria-selected="true">
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

<section class="section-paddingY middle-section product-page">
  <div class="container">
    <div class="section-body">
      <!-- Thêm form để thêm hoặc cập nhật đánh giá sản phẩm -->
      <?php
      $db = new Database();
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
          global $db;
          $this->db = new Database();
        }

        public function insert_danhgia($danhgia_id, $product_id, $user_id, $name, $email, $rating, $comment, $created_at)
        {
          $user_info_query = "SELECT username, email FROM tb_user WHERE user_id = $user_id";
          $user_info_result = $this->db->select($user_info_query);
          $user_info = $user_info_result->fetch_assoc();

          $name = $user_info['username'];
          $email = $user_info['email'];
          $query = "INSERT INTO tb_reviews (danhgia_id, product_id, user_id, name, email, rating, comment, created_at)
      VALUES ('$danhgia_id', '$product_id', '$user_id', '$name', '$email', '$rating', '$comment', '$created_at')";

          $result = $this->db->insert($query);
          // header('Location: coupon.php');
          return $result;
        }
        public function show_danhgia($product_id)
        {
          $query = "SELECT danhgia_id, product_id, name, email, rating, comment, created_at FROM tb_reviews ORDER BY danhgia_id
      ASC";
          $result = $this->db->select($query);

          return $result;
        }
      }
      $danhgia = new danhgia();
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once 'connect/connectDB.php'; // Đảm bảo đường dẫn đúng
      
        $db = new Database();

        // $product_id = isset($_GET['product_id']) ? $_GET['product_id'] : null;
      
        $user_id = $_POST["user_id"];
        $rating = $_POST["rating"];
        $comment = $_POST["comment"];
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $created_at = date('Y-m-d H:i:s');
        $product_id = isset($_GET['product_id']) ? $_GET['product_id'] : null;

        $user_id = $_SESSION["auth_user"]["user_id"];
        // $user_id = $_SESSION['id'];
        // Kiểm tra xem người dùng đã submit đánh giá chưa cho sản phẩm này
        $submission_query = "SELECT danhgia_id FROM tb_reviews WHERE user_id = $user_id AND product_id = $product_id";
        $submission_result = $db->select($submission_query);
        if ($submission_result && $submission_result->num_rows > 0) {
          // Người dùng đã submit rồi, không thực hiện gì cả
          $hasSubmitted = true;
        } else {
          // Người dùng chưa submit, thực hiện lưu đánh giá mới
          $insert_result = $danhgia->insert_danhgia(null, $product_id, $user_id, '', '', $rating, $comment, $created_at);
          if ($insert_result) {
            $hasSubmitted = true;
          }
        }
      }
      // Sử dụng biến tạm để giữ giá trị ban đầu từ URL
      $product_id = $product_id_from_url;
      $reviews = $danhgia->show_danhgia($product_id);
      $reviewCount = 0;
      $reviewArray = array();

      if ($reviews) {
        // Truy vấn thành công
        $reviewArray = array_reverse(mysqli_fetch_all($reviews, MYSQLI_ASSOC));
        foreach ($reviewArray as $review) {
          // Chỉ đếm các đánh giá của sản phẩm có product_id trùng khớp
          if ($review['product_id'] == $product_id) {
            $reviewCount++;
          }
        }
      }

      ?>
      <link rel='stylesheet prefetch' href='https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css'>
      <!-- <style>
        body {
          font-family: Arial, sans-serif;
          margin: 0;
          padding: 0;
        }

        .section-paddingY {
          padding: 20px 0;
        }

        .container {
          max-width: 1200px;
          margin: 0 auto;
          padding: 0 15px;
        }

        .middle-section {
          background-color: #f5f5f5;
        }

        .section-body {
          padding: 20px;
        }

        .danhgia {
          background-color: #fff;
          padding: 20px;
          border: 1px solid #ddd;
          border-radius: 5px;
        }

        .existing-reviews {
          margin-bottom: 20px;
        }

        .review {
          border-bottom: 1px solid #ddd;
          padding: 10px 0;
        }

        .star {
          font-size: 20px;
          color: #ffac00;
        }

        .review-form {
          margin-top: 20px;
        }

        label {
          font-weight: bold;
        }

        textarea {
          width: 100%;
          padding: 10px;
          border: 1px solid #ddd;
          border-radius: 5px;
        }

        .send {
          background-color: #007bff;
          color: #fff;
          border: none;
          padding: 10px 20px;
          border-radius: 5px;
          cursor: pointer;
        }

        .send:hover {
          background-color: #0056b3;
        }

        .star {
          font-size: 20px;
          color: #ffcc00;
          transition: color 0.2s;
          cursor: pointer;
        }

        .star:hover {
          color: #ffc700;
        }

        .star:checked~label {
          color: #ffc700;
        }

        .star-1 {
          grid-area: star-1;
        }

        .star-2 {
          grid-area: star-2;
        }

        .star-3 {
          grid-area: star-3;
        }

        .star-4 {
          grid-area: star-4;
        }

        .star-5 {
          grid-area: star-5;
        }
      </style> -->
      <style>
        
        .body_danhgia {
          font-family: Arial, sans-serif;
          margin: 0;
          padding: 0;
          background-color: #f4f4f4;
        }

        .container {
          width: 80%;
          margin: auto;
          overflow: hidden;
        }

        .danhgia {
          background-color: #fff;
          padding: 20px;
          margin-top: 20px;
          border-radius: 5px;
        }

        div.stars {
          width: 270px;
          display: inline-block;
        }

        input.star {
          display: none;
        }

        label.star {
          float: right;
          margin-bottom: -15px; /* Thay đổi giá trị margin-top tùy theo cần thiết */
          padding: 10px;
          font-size: 36px;
          color: #444;
          transition: all .2s;
        }

        input.star:checked~label.star:before {
          content: '\f005';
          color: #FD4;
          transition: all .25s;
        }

        input.star-5:checked~label.star:before {
          color: #FE7;
          text-shadow: 0 0 20px #952;
        }

        input.star-1:checked~label.star:before {
          color: #F62;
        }

        label.star:hover {
          transform: rotate(-15deg) scale(1.3);
        }

        label.star:before {
          content: '\f006';
          font-family: FontAwesome;
        }

        /* Additional CSS for the form and review section */
        .danhgia {
          max-width: 600px;
          margin: 0 auto;
          padding: 20px;
        }

        .existing-reviews {
          margin-top: 20px;
        }

        .review {
          border: 1px solid #ccc;
          padding: 10px;
          margin-bottom: 15px;
        }

        /* CSS for the comment textarea */
        label[for="comment"] {
          display: block;
          margin-top: 10px;
          max-width: 600px;
          margin: 0 auto;
          padding: 0; /* 20px*/
        }

        textarea[name="comment"] {
          width: 100%;
          border: 1px solid #ccc;
          border-radius: 5px;
          max-width: 600px;
          margin-left: 0;  /* 24% .Đặt giá trị margin-left về 0 để căn chỉnh vị trí */ 
          padding: 20px;
        }

        /* CSS for the submit button */
        .submit-container {
          text-align: center;
          margin-top: 20px;
        }

        .send {
          background-color: #007BFF;
          color: #fff;
          padding: 10px 20px;
          border: none;
          border-radius: 5px;
          cursor: pointer;
          transition: background-color 0.3s ease-in-out;
          margin-left: 43%;/*47% */
        }

        button[type="submit"]:hover {
          background-color: #0056b3;
        }

        span.star {
          color: #FFCC00;
        }
      </style>
      

      <script>
        function validateSurveyForm() {
          var isLoggedIn = <?php echo (isset($_SESSION["auth_user"]) ? 'true' : 'false'); ?>;
          var ratingValue = document.querySelector('input[name="rating"]:checked');

          if (!isLoggedIn) {
            alert('You need to be logged in to submit the survey.');
            return false;
          }
          if (!ratingValue) {
            alert('Please select a rating before submitting.');
            return false;
          }
        }
      </script>
      </head>
      <div clas="body_danhgia">
        <div class="container">
          <div class="danhgia">
            <div class="existing-reviews">
              <?php if ($reviewCount > 0): ?>
                <h2>
                  <?php echo $reviewCount; ?> Comment
                </h2>
              <?php endif; ?>
              <?php
              if ($reviewCount > 0) {
                foreach ($reviewArray as $review) {
                  // Chỉ hiển thị các đánh giá của sản phẩm có product_id trùng khớp
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
                echo "<p></p>";
              }
              ?>
            </div>
            <!-- Review form -->

            <h2>Leave a review</h2>
            <?php
            if (!isset($_SESSION["auth_user"])) {
              echo "<p>You need to <big><b><a href='User/login.php'>Login</a></b></big> to leave a review.</p>";
            } else {
              // Check if user has purchased the product
              $product_id = isset($_GET['product_id']) ? $_GET['product_id'] : null;
              $user_id = $_SESSION["auth_user"]['user_id'];

              // Check if the user has purchased the product
              $purchase_query = "SELECT * FROM tb_order_detail WHERE product_id = $product_id";
              $purchase_result = $db->select($purchase_query);

              if ($purchase_result && $purchase_result->num_rows > 0) {
                $purchase_data = $purchase_result->fetch_assoc();
                $order_id = $purchase_data['order_id'];

                // Check if the order status is 'delivered'
                $order_status_query = "SELECT * FROM tb_order WHERE order_id = $order_id AND status = 'completed'";
                $order_status_result = $db->select($order_status_query);

                if ($order_status_result && $order_status_result->num_rows > 0) {
                  // User can leave a review
                  ?>
                  <!-- Review form -->
                  <form class="review-form" action="" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                    <!-- <label for="name">Name:</label>
                <input type="text" name="name" value="" required>
                <label for="email">Email:</label>
                <input type="email" name="email" value="" required> -->
                    <label for="rating">Rating:</label>
                    <div class="stars">
                      <input class="star star-5" id="star-5" type="radio" name="rating" value="5" />
                      <label class="star star-5" for="star-5"></label>
                      <input class="star star-4" id="star-4" type="radio" name="rating" value="4" />
                      <label class="star star-4" for="star-4"></label>
                      <input class="star star-3" id="star-3" type="radio" name="rating" value="3" />
                      <label class="star star-3" for="star-3"></label>
                      <input class="star star-2" id="star-2" type="radio" name="rating" value="2" />
                      <label class="star star-2" for="star-2"></label>
                      <input class="star star-1" id="star-1" type="radio" name="rating" value="1" />
                      <label class="star star-1" for="star-1"></label>
                    </div>



                    <label for="comment">Comment:</label>
                    <textarea name="comment" rows="4" required></textarea>
                    <br>
                    <button class="send" type="submit" name="submit_danhgia"
                      onclick="return validateSurveyForm();">Send</button>
                  </form>
                  <?php
                } else {
                  echo "<p>You can only leave a review for products that have been prepare.</p>";
                }
              } else {
                echo "<p>You can only leave a review for products you've purchased.</p>";
              }
            }
            ?>
          </div>
        </div>
      </div>

    </div>
  </div>
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
                    <button><a href="details.php?product_id=<?= $p["product_id"] ?>"><span
                          class="material-symbols-sharp">visibility</span></a></button>
                    <button onclick="addNewCart(<?= $p['product_id'] ?>)" type="button"><span
                        class="material-symbols-sharp">add_shopping_cart</span></button>
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


<section class="section-paddingY middle-section product-page">
  <div class="container">
    <div class="section-body">
      <div class="form col-12 col-lg-12">
        <div class="comment-form">
          <h3>Comment</h3>
          <div class="commentForm">
            <textarea id="comment" name="comment" rows="3" placeholder="Please comment or ask questions"
              required></textarea>
            <br>
            <button type="button" class="submit-comment">Submit</button>
          </div>
        </div>
        <hr>

        <div class="comments"></div>
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
      success: function (response) {
        if (response === "loggedin") {
          addToCart(); // Call the addToCart function if logged in
        } else {
          Swal.fire({
            icon: 'info',
            title: 'Not Logged In',
            text: 'Please login your account before buying items.',
            didClose: () => {
              window.location.href = "User/login.php";
            }
          });
        }
      }
    });
  }

  function addToCart() {
    const $form = $("#add").closest(".form-submit");
    const pid = $("#proDetail-proID").data("id");
    const pname = $("#proDetail-proID").data("name");
    const increaseSize = $(".sizeBtn.active").data("increase");
    const size = $(".sizeBtn.active").data("name");
    const flavor = $(".flavorBtn.active").data("flavor");
    const quantity = $(".qty-product-detail").val();
    const price = $(".discounted-price").data("price");
    const user_id = $(".user_id").val();

    if (!size || !flavor) {
      Swal.fire({
        icon: 'warning',
        title: 'Missing Selection',
        text: 'Please select both size and flavor before adding to cart.',
      });
      return;
    }

    // AJAX request to add product to cart
    $.ajax({
      url: "handles_page/add_to_cart.php",
      method: "POST",
      data: {
        pid: pid,
        pname: pname,
        size: size,
        flavor: flavor,
        increaseSize: increaseSize,
        quantity: quantity,
        price: price,
        user_id: user_id,
      },
      success: function (response) {
        Swal.fire({
          icon: 'success',
          title: 'Add to cart success',
          timer: 2000,
          showConfirmButton: false
        });
      },
      error: function () {
        alert("Error adding product to cart");
      }
    });
  }

  $(document).ready(function () {
    // Add to cart button event listener
    $(document).on("click", "#add", function (e) {
      e.preventDefault();
      checkLoginStatus();
    });
  });
</script>

</body>

</html>