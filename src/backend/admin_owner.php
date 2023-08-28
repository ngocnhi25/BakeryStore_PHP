<?php
session_start();
require_once("../connect/connectDB.php");
if (isset($_SESSION["auth_user"])) {
    $user = $_SESSION["auth_user"]; // Retrieve the user data from the session
    if ($user["role"] == 3) {
        $user_name = $_SESSION["auth_user"]["username"];
        $user_id = $_SESSION["auth_user"]["user_id"];
        // $users = executeResult("SELECT * FROM tb_user WHERE role = 2 ");
    } else {
        header("location: ../User/login.php");
    }
} else {
    header("location: ../User/login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin NgocNhiBakery</title>
    <link rel="stylesheet" href="../../public/backend/css/admin.css">
    <link rel="stylesheet" href="../../public/backend/css/table.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
</head>

<body>
    <div class="container">
        <aside>
            <div class="top">
                <div class="logo">
                    <div class="img-logo">
                        <img src="../../public/images/logo/Screenshot 2023-06-23 205633.png" alt="logo">
                    </div>
                    <h2 class="text-muted">NGOCNHI
                        <span class="danger">BAKERY</span>
                    </h2>
                </div>
                <div class="close" id="close-btn">
                    <span class="material-symbols-sharp">close</span>
                </div>
            </div>

            <div class="sidebar">
                <ul>
                    <li class="nav-item active">
                        <a href="dashboad.php" class="nav-link">
                            <span class="material-symbols-sharp">grid_view</span>
                            <h3>Dashboard</h3>
                        </a>
                    </li>
                    <li class="nav-item">
                        <div class="sub-btn nav-link">
                            <div class="title">
                                <span class="material-symbols-sharp">supervisor_account</span>
                                <h3> Management</h3>
                            </div>
                            <span class="material-symbols-sharp more">expand_more</span>
                            <span class="material-symbols-sharp less">expand_less</span>
                        </div>
                        <ul class="sub-menu">
                            <li class="menu-item">
                                <a href="accounts/profile-Owner.php">
                                    <span class="material-symbols-sharp unchecked">radio_button_unchecked</span>
                                    <span class="material-symbols-sharp checked">radio_button_checked</span>
                                    <h4>Change Password </h4>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="accounts/customer.php">
                                    <span class="material-symbols-sharp unchecked">radio_button_unchecked</span>
                                    <span class="material-symbols-sharp checked">radio_button_checked</span>
                                    <h4>Customers</h4>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="accounts/employee.php">
                                    <span class="material-symbols-sharp unchecked">radio_button_unchecked</span>
                                    <span class="material-symbols-sharp checked">radio_button_checked</span>
                                    <h4>Employees</h4>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="accounts/add-employee.php">
                                    <span class="material-symbols-sharp unchecked">radio_button_unchecked</span>
                                    <span class="material-symbols-sharp checked">radio_button_checked</span>
                                    <h4>Add Employees</h4>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <div class="sub-btn nav-link">
                            <div class="title">
                                <span class="material-symbols-sharp">inventory</span>
                                <h3>Products</h3>
                            </div>
                            <span class="material-symbols-sharp more">expand_more</span>
                            <span class="material-symbols-sharp less">expand_less</span>
                        </div>
                        <ul class="sub-menu">
                            <li class="menu-item">
                                <a href="products/products.php">
                                    <span class="material-symbols-sharp unchecked">radio_button_unchecked</span>
                                    <span class="material-symbols-sharp checked">radio_button_checked</span>
                                    <h4>All Products</h4>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="products/gallery.php">
                                    <span class="material-symbols-sharp unchecked">radio_button_unchecked</span>
                                    <span class="material-symbols-sharp checked">radio_button_checked</span>
                                    <h4>Gallery</h4>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="products/product_add.php">
                                    <span class="material-symbols-sharp unchecked">radio_button_unchecked</span>
                                    <span class="material-symbols-sharp checked">radio_button_checked</span>
                                    <h4>Add Product</h4>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="orders.php" class="nav-link">
                            <span class="material-symbols-sharp">receipt_long</span>
                            <h3>Orders</h3>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./signIn.php" class="nav-link">
                            <span class="material-symbols-sharp">mail</span>
                            <h3>Feedbacks</h3>
                            <span class="message-count">27</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="sale.php" class="nav-link">
                            <span class="material-symbols-sharp">shopping_cart_checkout</span>
                            <h3>Sale</h3>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="ads.php" class="nav-link">
                            <span class="material-symbols-sharp">ad_units</span>
                            <h3>Advertising</h3>
                        </a>
                    </li>
                    <li class="nav-item">
                        <div class="sub-btn nav-link">
                            <div class="title">
                                <span class="material-symbols-sharp">news</span>
                                <h3>News</h3>
                            </div>
                            <span class="material-symbols-sharp more">expand_more</span>
                            <span class="material-symbols-sharp less">expand_less</span>
                        </div>
                        <ul class="sub-menu">
                            <li class="menu-item">
                                <a href="news/news.php">
                                    <span class="material-symbols-sharp unchecked">radio_button_unchecked</span>
                                    <span class="material-symbols-sharp checked">radio_button_checked</span>
                                    <h4>All News</h4>
                                </a>
                            </li>

                            <li class="menu-item">
                                <a href="news/news_add.php">
                                    <span class="material-symbols-sharp unchecked">radio_button_unchecked</span>
                                    <span class="material-symbols-sharp checked">radio_button_checked</span>
                                    <h4>Add News</h4>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li onclick="LogOut()" class="logout">
                        <span class="material-symbols-sharp">logout</span>
                        <h3>Logout</h3>
                    </li>
                </ul>
            </div>
        </aside>

        <div id="main">
            <div class="top">
                <div class="menu">
                    <button id="menu-btn">
                        <span class="material-symbols-sharp">menu</span>
                    </button>
                    <button id="show-menu">
                        <span class="material-symbols-sharp">arrow_right_alt</span>
                    </button>
                    <button id="shorten-menu">
                        <span class="material-symbols-sharp">arrow_left_alt</span>
                    </button>
                </div>
                <!-- <div class="input-search">
                    <input type="search" placeholder="Search Data...">
                    <img src="images/search.png" alt="">
                </div> -->
                <div class="profile-theme">
                    <div class="theme-toggler">
                        <span class="material-symbols-sharp active">light_mode</span>
                        <span class="material-symbols-sharp">dark_mode</span>
                    </div>
                    <div class="profile">
                        <div class="info">
                            <p>Hey, <b> <?php echo $user_name ?> </b></p>
                            <small class="text-muted"> Position : Owner </small>
                        </div>
                    </div>
                </div>
            </div>

            <div id="main-page">
                <?php include("dashboad.php"); ?>
            </div>
        </div>
    </div>

    <script src="../../public/backend/js/admin.js"></script>
    <script src="../../public/backend/js/adminJquery.js"></script>
    <script>
        function LogOut() {
            if (confirm("Are you sure you want to log out?")) {
                $.ajax({
                    type: "POST",
                    url: '../User/logout2-3.php', // Make sure the URL is correct
                    success: function(res) {
                        if (res === 'success') {
                            window.location.href = "../User/login.php"; // Redirect to login page
                        } else {
                            alert("Logout failed.");
                        }
                    },
                    error: function() {
                        alert("An error occurred during logout.");
                    }
                });
            }
        }

        function checkUserStatus() {
            $.ajax({
                type: "POST",
                url: 'accounts/check_user_status.php', // Replace with the actual path to your status-checking script
                success: function(response) {
                    if (response === 'inactive' || response === 'failstatus') {
                        alert("Your account is deactivated!");
                        window.location.href = "../User/login.php";
                    } else if (response === 'failtoken'){
                        alert("Your account is other page login !");
                        window.location.href = "../User/login.php";
                    }
                    else if (response === 'success') {
                        // User is active and token is valid, continue with normal flow
                    }
                },
                error: function() {
                    alert("An error occurred while checking user status.");
                }
            });
        }

        // Attach the click event listener to the document
        $(document).on('click', function() {
            checkUserStatus(); // Check user status on every click
        });

        // Initial check when the page loads
        $(document).ready(function() {
            checkUserStatus();
        });
    </script>
</body>
</section>

</html>
<?php if(isset($_SESSION['status'])) { ?>
        <script>
            alert('<?php echo $_SESSION['status']; ?>');
        </script>
    <?php
        unset($_SESSION['status']); // Clear the session status after displaying
    }
    ?>