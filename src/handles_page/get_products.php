<?php
require_once '../connect/connectDB.php';
require_once 'handle_calculate.php';
require_once 'pagination.php';
$arraySale = [];
$sale = executeResult("SELECT * FROM tb_sale WHERE CURDATE() BETWEEN start_date AND end_date");

foreach ($sale as $key => $s) {
    $arraySale[$key] = $s["product_id"];
}

function showPecentSale($p)
{
    global $arraySale;
    if (in_array($p['product_id'], $arraySale)) {
        echo "
    <div class='product-discount'>
      <span class='text'>-
        " . checkProductPecentSale($p) . " %</span>
    </div>
    ";
    }
}

function checkProductPecentSale($p)
{
    global $sale;
    foreach ($sale as $s) {
        if ($p['product_id'] == $s['product_id']) {
            return ($s['percent_sale']);
            break;
        }
    }
}
function checkProductSalePriceFor($p)
{
    global $sale;
    foreach ($sale as $s) {
        if ($p['product_id'] == $s['product_id']) {
            return calculatePercentPrice($p['price'], $s['percent_sale']);
            break;
        }
    }
}

function showProductSalePrice($p)
{
    global $arraySale;
    if (in_array($p['product_id'], $arraySale)) {
        echo "<span class='price'> " . checkProductSalePriceFor($p) . " vnđ</span>";
        echo "<span class='price-del'> " . displayPrice($p['price']) . " vnđ</span>";
    } else {
        echo "<span class='price'>" . displayPrice($p['price']) . " vnđ</span>";
    }
}

function getAllProducts($product)
{
    foreach ($product as $p) {
        echo "<div class='col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1 my-2'>";
        echo "<div class='one-product-container'>";
        echo "<div class='product-images'>";
        echo "<a href='details.php?product_id=" . $p["product_id"] . "'>";
        echo "<div class='product-image hover-animation'>";
        echo "<img src='../" . $p["image"] . "' alt='Opera Cake' />";
        echo "<img src='../" . $p["image"] . "' alt='Opera Cake' />";
        echo "</div>";
        echo "</a>";
        showPecentSale($p);
        echo "<div class='box-actions-hover'>";
        echo "<button><a href='details.php?product_id=" . $p["product_id"] . "'><span class='material-symbols-sharp'>visibility</span></a></button>";
        echo "<button onclick='addNewCart(" . $p['product_id'] . ")' type='button'><span class='material-symbols-sharp'>add_shopping_cart</span></button>";
        echo "</div>";
        echo "</div>";
        echo "<div class='product-info'>";
        echo "<div class=,product-name,>";
        echo "<a href='details.php?product_id=" . $p["product_id"] . "'>" . $p["product_name"] . "</a>";
        echo "</div>";
        echo "<div class='product-price'>";
        showProductSalePrice($p);
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
}


if (isset($_POST['action']) && !empty($_POST["action"])) {
    $limit = 12;
    $page = 1;
    $number = 0;
    $cate_id = $countResult = '';
    $orderBy = "p.product_id";
    if (isset($_POST['page'])) {
        $page = $_POST['page'];
    }
    $firstIndex = ($page - 1) * $limit;

    $sql = "SELECT * FROM tb_products p
        INNER JOIN tb_category c 
        ON p.cate_id = c.cate_id where p.deleted = 0 ";
    $sqlCount = "SELECT count(product_id) AS total 
                FROM tb_products p
                INNER JOIN tb_category c 
                ON p.cate_id = c.cate_id where deleted = 0 ";

    if (isset($_POST["cate"]) && !empty($_POST["cate"])) {
        $cate = implode(",", $_POST["cate"]);
        $sql .= "AND p.cate_id IN(" . $cate . ") ";
        $sqlCount .= "AND p.cate_id IN(" . $cate . ") ";
    }

    if (isset($_POST["cate_id"]) && !empty($_POST["cate_id"])) {
        $cate_id = $_POST["cate_id"];
        $sql .= "AND p.cate_id = " . $cate_id . " ";
        $sqlCount .= "AND p.cate_id = " . $cate_id . " ";
    }

    if (isset($_POST["onSale"]) && !empty($_POST["onSale"])) {
        $onSale = $_POST["onSale"][0];
        if ($onSale == "on_sale") {
            $saleFilter = implode(",", $arraySale);
            $sql .= "AND p.product_id IN(" . $saleFilter . ") ";
            $sqlCount .= "AND p.product_id IN(" . $saleFilter . ") ";
        }
    }

    if (isset($_POST["view"]) && !empty($_POST["view"])) {
        $view = $_POST["view"][0];
        if ($view == "view") {
            $orderBy = "p.view";
        }
    }

    if (isset($_POST["price"]) && !empty($_POST["price"]["from"])) {
        $from = $_POST["price"]["from"];
        $to = $_POST["price"]["to"];
        $sql .= "AND p.price BETWEEN $from AND $to ";
        $sqlCount .= "AND p.price BETWEEN $from AND $to ";
    }

    
    $sql .= " AND p.deleted = 0 ORDER BY $orderBy DESC limit $firstIndex, $limit";
    $product = executeResult($sql);
    $countProducts = executeSingleResult($sqlCount);

    if ($countProducts != null) {
        $count = $countProducts['total'];
        $number = ceil($count / $limit);
    }

    if ($product != null) {
        echo "<div class='row'>";
        getAllProducts($product);
        echo "</div>";
        echo "<div class='pagination-prod'>";
        PaginationProduct($number, $page);
        echo "</div>";
    } else {
        echo "<p>No data</p>";
    }
} else {
    echo "Invalid request";
}
