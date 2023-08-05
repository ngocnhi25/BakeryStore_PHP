<?php
session_start();

require_once("connect/connectDB.php");

// Fetch coupon details from the database
$sale = executeResult("SELECT * FROM tb_sale");
foreach ($sale as $s) {
  $coupon_name = $s['coupon_name'];
  $discount = $s['discount'];
}

// Sender name and phone
$sender_name = "Loi Ngoc Nhi";
$sender_phone = "0123123123"; // Enclose phone number in quotes to treat it as a string

// Calculate total
$total_price = 0.0; // Initialize the total price as a float
$deposit = 0.0; // Initialize the deposit as a float
$couponDis = 0.0; // Initialize the variable to hold the coupon discount as a float

// Set user_id securely from your authentication system or database query
$_SESSION['user_id'] = "123";
$user_id = $_SESSION['user_id'];
$current_time = date('Y-m-d H:i:s'); // Get the current time in the format YYYY-MM-DD HH:MM:SS
$order_date = date('Y-m-d'); // Get the order date in the format YYYY-MM-DD

$username = $phone = $email = $address = $coupon = ''; // Initialize coupon variable
$errors = [
  "username" => "",
  "phone" => "",
  "email" => "",
  "address" => "",
  "coupon" => "" // Add coupon to the errors array
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = trim($_POST["username"]);
  $phone = trim($_POST["phone"]);
  $address = trim($_POST["address"]);
  $email = trim($_POST["email"]);
  $coupon = trim($_POST["coupon"]);

  if (empty($username)) {
    $errors["username"] = "Please enter a username";
  }
  if (empty($phone)) {
    $errors["phone"] = "Please enter a phone number";
  }
  if (empty($email)) {
    $errors["email"] = "Please enter an email address";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors["email"] = "Invalid email format";
  }
  if (empty($address)) {
    $errors["address"] = "Please enter an address";
  }
  if (empty($coupon)) {
    $errors["coupon"] = "Please enter a coupon"; // Correct the error message for coupon
  } else {
    // Check if a coupon code is submitted
    if ($coupon === $coupon_name) {
      $couponDis = $discount / 100; // Store the coupon discount percentage for later use
    } else {
      $errors["coupon"] = "Invalid coupon"; // Display an error if the coupon code is invalid
    }
  }
}

if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
  foreach ($_SESSION['cart'] as $key => $value) {
    // Calculate total and deposit (moved outside the loop)
    $product_price = floatval($value['price']); // Convert product price to a float
    $quantity = floatval($value['quantity']); // Convert quantity to a float
    $total_price += $product_price * $quantity;
  }
  // Calculate deposit after the loop
  $deposit = $total_price * 30 / 100;
  // Calculate final price after applying the coupon discount
  $final_price = $total_price - ($total_price * $couponDis);
  // var_dump($total_price);
  // var_dump($couponDis);
  // var_dump($final_price);
  // die();

}

// If there are no errors and the form is submitted, process the form data
if ($_SERVER["REQUEST_METHOD"] == "POST" && empty(array_filter($errors))) {
  // Process the form data here (e.g., save to database or send email)
  $query = "INSERT INTO tb_order (user_id, receiver_name, receiver_phone, receiver_address, receiver_datetime, order_date, rest, total_pay, deposit, sender_name, sender_phone, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Pending')";
  $stmt = $conn->prepare($query);

  if (!$stmt) {
    echo "Error: " . $conn->error; // Output any specific error messages from the database
    exit();
  }

  $stmt->bind_param("sssssssssss", $user_id, $username, $phone, $address, $current_time, $order_date, $total_price, $final_price, $deposit, $sender_name, $sender_phone); // Bind the coupon parameter

  if ($stmt->execute()) {
    // After processing, you may redirect the user to a success page
    header("Location: home.php");
    exit();
  } else {
    echo "Error: Failed to insert order details. " . $stmt->error;
  }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Giỏ hàng</title>

  <!-- FONT -->
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Cabin" />
  <!-- FONT -->

  <!-- PLUGIN CSS -->
  <link rel="stylesheet" href="../public/frontend/css/librarys_css/css/bootstrap4.min.css">
  <link rel="stylesheet" href="../public/frontend/css/librarys_css/css/owl.carousel.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css">
  <link rel="stylesheet" href="../public/frontend/css/lightslider.css">
  <link rel="stylesheet" href="../public/frontend/js/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- PLUGIN CSS -->

  <link href="../public/frontend/css/style.css" rel="stylesheet">

  <style>
    .error-msg {
      color: red;
      font-size: 14px;
      margin-top: 5px;
    }

    .error {
      border-color: red;
    }
  </style>
</head>

<body>

  <?php include("layout/header.php"); ?>

  <section class="section-paddingY cart-page">
    <div class="container">
      <div class="section-header">
        <p class="section-title">Giỏ hàng của bạn</p>
      </div>
      <div class="section-body">
        <div class="row">
          <div class="col-12">
            <div class="cart-container">
              <ul class="cart-list">
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="section-footer">
        <?php if (!empty($_SESSION['cart'])) { ?>
          <table class="table table-bordered my-5">
            <!-- display column -->
            <tr>
              <th>product_id</th>
              <th>image</th>
              <th>cate_id</th>
              <th>price</th>
              <th>quantity</th>
              <th>size</th>
              <th>action</th>
            </tr>
            <!-- display column -->
            <?php
            foreach ($_SESSION['cart'] as $key => $value) {
              ?>
              <tr>
                <td>
                  <?php echo $value['id']; ?>
                </td>
                <td>
                  <img src="<?php echo $product['image'] ?>" alt="" width="100px">
                </td>
                <td>
                  <?php echo $value['name']; ?>
                </td>
                <td>
                  <?php echo $value['price']; ?>
                </td>
                <td>
                  <?php echo $value['quantity']; ?>
                </td>
                <td>
                  <?php echo $value['size']; ?>
                </td> <!-- Print the size value -->
                <td>
                  <button class="btn btn-danger remove" id="<?php echo $value['id']; ?>">Remove</button>
                </td>
              </tr>

              <?php
            }
            ?>

            <tr>
              <td colspan="7">
                <?php if ($couponDis > 0): ?>
                  <p>Total Price: $
                    <?php echo number_format($total_price, 2); ?>
                  </p>
                  <p>Coupon Discount:
                    <?php echo $discount; ?>%
                  </p>
                  <p>Final Price: $
                    <?php echo number_format($final_price, 2); ?>
                  </p>
                <?php else: ?>
                  <p>Total Price: $
                    <?php echo number_format($total_price, 2); ?>
                  </p>
                <?php endif; ?>
              </td>
            </tr>

            <tr>
              <td colspan="7">
                <button class="btn btn-warning clearall">Clear All</button>
              </td>
            </tr>

          </table>

        <?php } else { ?>
          <p class="text-center">NO ITEM SELECTED</p>
        <?php } ?>
      </div>


    </div>
  </section>

  <section class="section-paddingY cart-page">
    <div class="container">
      <div class="section-header">
        <p class="section-title">Xac Minh Don Hang</p>
      </div>
      <div class="section-body">
        <div class="row">
          <div class="col-12">
            <div class="cart-container">
              <ul class="cart-list">
                <!-- Your cart items go here -->
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="section-footer">
        <form method="post">
          <!-- Your form fields go here -->
          <div class="form-row">
            <div class="col-md-6 form-group">
              <label for="Username">Username</label>
              <input type="text" class="form-control <?php echo (!empty($error['username'])) ? 'error' : ''; ?>"
                id="Username" placeholder="Username" name="username" value="<?php echo $username; ?>">
              <p class="error-msg">
                <?php echo $errors["username"]; ?>
              </p>
            </div>
            <div class="col-md-6 form-group">
              <label for="Phone">Phone</label>
              <input type="text" class="form-control <?php echo (!empty($errors['phone'])) ? 'error' : ''; ?>"
                id="Phone" placeholder="Phone" name="phone" value="<?php echo $phone; ?>">
              <p class="error-msg">
                <?php echo $errors["phone"]; ?>
              </p>
            </div>
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control <?php echo (!empty($errors['email'])) ? 'error' : ''; ?>" id="email"
              placeholder="you@example.com" name="email" value="<?php echo $email; ?>">
            <p class="error-msg">
              <?php echo $errors["email"]; ?>
            </p>
          </div>
          <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control <?php echo (!empty($errors['address'])) ? 'error' : ''; ?>"
              id="address" placeholder="1234 Main Street" name="address" value="<?php echo $address; ?>">
            <p class="error-msg">
              <?php echo $errors["address"]; ?>
            </p>
          </div>
          <div class="form-group">
            <label for="coupon">Coupon Code:</label>
            <input type="text" name="coupon" id="coupon" value="<?php echo htmlspecialchars($coupon); ?>">
            <span class="error">
              <?php echo $errors["coupon"]; ?>
            </span>
            <button type="submit" name="checkCounpon">Apply Coupon</button>
          </div>

          <!-- Display order summary -->
          <div>
            <h2>Order Summary</h2>
          </div>

          <hr>

          <h4 class="mb-4"> Payment </h4>
          <div class="form-check">
            <input type="radio" class="form-check-input" id="credit" name="payment-method" checked>
            <label for="credit" class="form-check-label"> COD </label>
          </div>
          <div class="form-check">
            <input type="radio" class="form-check-input" id="debit" name="payment-method">
            <label for="debit" class="form-check-label"> Card </label>
          </div>
          <div class="form-check">
            <input type="radio" class="form-check-input" id="paypal" name="payment-method">
            <label for="paypal" class="form-check-label"> MoMo </label>
          </div>

          <!-- <div class="row mt-4">
                        <div class="col-md-6 form-group">
                            <label for="card-name"> Name on card </label>
                            <input type="text" class="form-control" id="card-name" placeholder >
                            <div class="invalid-feedback">
                                Name on card is 
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="card-no"> Card Number </label>
                            <input type="text" class="form-control" id="card-no" placeholder >
                            <div class="invalid-feedback">
                                Credit card number is 
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-5 form-group">
                            <label for="expiration"> Expire Date </label>
                            <input type="text" class="form-control" id="card-name" placeholder >
                            <div class="invalid-feedback">
                                Expiration date 
                            </div>
                        </div>
                        <div class="col-md-5 form-group">
                            <label for="ccv-no"> Security Number </label>
                            <input type="text" class="form-control" id="sec-no" placeholder >
                            <div class="invalid-feedback">
                                Security code 
                            </div>
                        </div>
                    </div> -->
          <hr class="mb-4">
          <input type="submit" name="submit" value="Continue to Checkout"
            class="btn btn-primary btn-lg btn-block submit">
        </form>
      </div>
    </div>
  </section>

  <?php include("layout/footer.php"); ?>

  <button class="gototop text-yellow">
    <img src="public/frontend/assets/img/icons/goto.png" alt="ve dau trang" style="margin-right: 10px"> Về đầu trang
  </button>
  
  <!-- script link -->
  <script src="public/plugins/js/jquery3.3.1.min.js"></script>
  <script src="public/frontend/assets/js/config.js"></script>
  <script src="public/plugins/js/bootstrap4.min.js"></script>
  <script src="public/plugins/js/owl.carousel.min.js"></script>
  <script src="ajax/libs/lightslider/1.1.6/js/lightslider.min.js"></script>
  <script src="ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
  <script src="public/frontend/assets/js/main.js?v=1.0.8"></script>
  <script src="public/myplugins/js/messagebox.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
  <!-- script link -->


  <script type="text/javascript">
    $(document).ready(function () {

      $(".remove").click(function () {
        var id = $(this).attr("id");
        var action = "remove";
        $.ajax({
          method: "POST",
          url: "handles_page/action.php",
          data: { action: action, id: id },
          success: function (data) {
            alert("you have Remove item with ID " + id + "");
            setInterval('location.reload()', 1000);
          }
        });
      });


      $(".clearall").click(function () {
        var action = "clear";
        $.ajax({
          method: "POST",
          url: "handles_page/action.php",
          data: { action: action },
          success: function (data) {
            alert("you have cleared all item");
            window.location.href = "product.php";
          }
        });
      });


      $(".submit").click(function () {
        var action = "clear";
        $.ajax({
          method: "POST",
          data: { action: action },
          success: function (data) {
            alert("success!");
          }
        });
      });
      
    });
  </script>
</body>

</html>