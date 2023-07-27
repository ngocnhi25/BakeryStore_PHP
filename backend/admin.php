<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin NgocNhiBakery</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

</head>

<body>
    <div class="container">
        <aside>
            <div class="top">
                <div class="logo">
                    <div class="img-logo">
                        <img src="../public/images/logo/Screenshot 2023-06-23 205633.png" alt="logo">
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
                        <a href="./dashboad.html" class="nav-link">
                            <span class="material-symbols-sharp">grid_view</span>
                            <h3>Dashboard</h3>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./customer.php" class="nav-link">
                            <span class="material-symbols-sharp">person</span>
                            <h3>Customer</h3>
                        </a>
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
                                <a href="products/category.php">
                                    <span class="material-symbols-sharp unchecked">radio_button_unchecked</span>
                                    <span class="material-symbols-sharp checked">radio_button_checked</span>
                                    <h4>Category</h4>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="products/flavor_and_size.php">
                                    <span class="material-symbols-sharp unchecked">radio_button_unchecked</span>
                                    <span class="material-symbols-sharp checked">radio_button_checked</span>
                                    <h4>Flavor and Size</h4>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <div class="sub-btn nav-link">
                            <div class="title">
                                <span class="material-symbols-sharp">receipt_long</span>
                                <h3>Orders</h3>
                            </div>
                            <span class="material-symbols-sharp more">expand_more</span>
                            <span class="material-symbols-sharp less">expand_less</span>
                        </div>
                        <ul class="sub-menu">
                            <li class="menu-item">
                                <a href="./logIn.php">
                                    <span class="material-symbols-sharp unchecked">radio_button_unchecked</span>
                                    <span class="material-symbols-sharp checked">radio_button_checked</span>
                                    <h4>dsfsdfs</h4>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="./dashboad.html">
                                    <span class="material-symbols-sharp unchecked">radio_button_unchecked</span>
                                    <span class="material-symbols-sharp checked">radio_button_checked</span>
                                    <h4>detail</h4>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="./signIn.php" class="nav-link">
                            <span class="material-symbols-sharp">mail</span>
                            <h3>Feedbacks</h3>
                            <span class="message-count">27</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="products/add-product.php" class="nav-link">
                            <span class="material-symbols-sharp">shopping_cart_checkout</span>
                            <h3>Sale</h3>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="products/product_add.php" class="nav-link">
                            <span class="material-symbols-sharp">add</span>
                            <h3>Add Product</h3>
                        </a>
                    </li>
                    <li class="nav-item logout">
                        <a href="./signIn.php" class="nav-link">
                            <span class="material-symbols-sharp">logout</span>
                            <h3>Logout</h3>
                        </a>
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
                <div class="input-search">
                    <input type="search" placeholder="Search Data...">
                    <img src="images/search.png" alt="">
                </div>
                <div class="profile-theme">
                    <div class="theme-toggler">
                        <span class="material-symbols-sharp active">light_mode</span>
                        <span class="material-symbols-sharp">dark_mode</span>
                    </div>
                    <div class="profile">
                        <div class="info">
                            <p>Hey, <b>Ngoc Nhi</b></p>
                            <small class="text-muted">Admin</small>
                        </div>
                        <div class="profile-photo">
                            <img src="images/admin1.jpg" alt="admin 1">
                        </div>
                    </div>
                </div>
            </div>

            <div id="main-page">

            </div>
        </div>
    </div>

    <script src="js/admin.js"></script>
    <script src="js/adminJquery.js"></script>
</body>

</html>