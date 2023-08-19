<?php
session_start();
require_once("../src/connect/connectDB.php");
// $priceResult = executeSingleResult("SELECT price FROM tb_products WHERE product_id = " . $row['product_id']);
// $price = $priceResult['price'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="author" content="Sahil Kumar">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Cart</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
</head>

<body>
  <?php include("layout/header.php"); ?>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <?php if (isset($_SESSION['showAlert'])): ?>
          <div style="display:<?= isset($_SESSION['showAlert']) ? $_SESSION['showAlert'] : 'none'; ?>"
            class="alert alert-success alert-dismissible mt-3">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>
              <?= isset($_SESSION['message']) ? $_SESSION['message'] : ''; ?>
            </strong>
          </div>
        <?php endif; ?>
        <div class="table-responsive mt-2">
          <table class="table table-bordered table-striped text-center">
            <thead>
              <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Product</th>
                <th>Flavor</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Remove</th>
              </tr>
            </thead>
            <tbody>
              <?php
              require '../src/connect/connection.php';

              $stmt = $conn->prepare('SELECT * FROM tb_cart');
              $stmt->execute();
              $result = $stmt->get_result();
              $grand_total = 0;

              while ($row = $result->fetch_assoc()) {
                $priceResult = executeSingleResult("SELECT price FROM tb_products WHERE product_id = " . $row['product_id']);
                $price = $priceResult['price'];
                ?>
                <tr>
                  <td>
                    <?= $row['product_id'] ?>
                  </td>
                  <td><img src="<?= $row['image'] ?>" width="50"></td>
                  <td>
                    <?= $row['product_name'] ?>
                  </td>
                  <td>
                    <?= $row['flavor'] ?>
                  </td>
                  <td>
                    <?= number_format($price, 0); ?>
                  </td>
                  <td>
                    <input type="number" class="form-control itemQty" value="<?= $row['quantity'] ?>"
                      style="width: 75px;">
                    <input type="hidden" class="pid" value="<?= $row['product_id'] ?>">
                    <input type="hidden" class="pprice" value="<?= $price ?>">
                  </td>
                  <td class="total_price">
                    <?= number_format($row['total_price'], 0); ?>
                  </td>
                  <td>
                    <a href="../src/handles_page/action.php?remove=<?= $row['product_id'] ?>" class="text-danger lead"
                      onclick="return confirm('Are you sure want to remove this item?');">
                      <i class="fas fa-trash-alt"></i>
                    </a>
                  </td>
                </tr>
                <?php
                $grand_total += $row['total_price'];
              }
              ?>
              <tr>
                <td colspan="3">
                  <a href="index.php" class="btn btn-success">
                    <i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Continue Shopping
                  </a>
                </td>
                <td colspan="2"><b>Grand Total</b></td>
                <td colspan="2"><b>
                    <?= number_format($grand_total, 0); ?>
                  </b></td>
                <td>
                  <a href="checkout.php" class="btn btn-info <?= ($grand_total > 1) ? '' : 'disabled'; ?>">
                    <i class="far fa-credit-card"></i>&nbsp;&nbsp;Checkout
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script type="text/javascript">
    $(document).ready(function () {

      // Change the item quantity
      $(document).ready(function () {
        // Change the item quantity
        $(".itemQty").on('change', function () {
          var $el = $(this).closest('tr');

          var pid = $el.find(".pid").val();
          var pprice = $el.find(".pprice").val();
          var qty = $el.find(".itemQty").val();
          if (parseInt(qty) > 20) {
            alert("Quantity cannot be greater than 20.");
            return;
          }
          // Calculate the new total price
          var tprice = pprice * qty;
          location.reload(true);

          $.ajax({
            url: '../src/handles_page/action.php',
            method: 'post',
            cache: false,
            data: {
              qty: qty,
              pid: pid,
              price: pprice  // Change 'pprice' to 'price' here
            },
            success: function (response) {
              // console.log(qty);
              // console.log(pprice);
              // console.log(pid);

              // Update the displayed total price
              $el.find(".total_price").html( + tprice.toFixed(2));
            }
          });
        });
      });


      // Load total no.of items added in the cart and display in the navbar
      load_cart_item_number();

      function load_cart_item_number() {
        $.ajax({
          url: '../src/handles_page/action.php',
          method: 'get',
          data: {
            cartItem: "cart_item"
          },
          success: function (response) {
            $("#cart-item").html(response);
          }
        });
      }
    });
  </script>
  <?php include("layout/footer.php"); ?>
</body>

</html>