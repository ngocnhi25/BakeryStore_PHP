<?php
require_once("../../../connect/connectDB.php");
require_once("../../../handles_page/handle_calculate.php");

$limit = 10;
$page = 1;
$number = 0;
if(isset($_POST["page"])){
    $page = $_POST["page"];
}
$firstIndex = ($page - 1) * $limit;

$sql = "SELECT * FROM tb_products p
        INNER JOIN tb_category c 
        ON p.cate_id = c.cate_id WHERE 1 ";
$sqlCount = "SELECT COUNT(*) AS total FROM tb_products p
                INNER JOIN tb_category c 
                ON p.cate_id = c.cate_id WHERE 1 ";

if (isset($_POST["filter_search"]) && !empty($_POST["filter_search"])) {
    $searchName = $_POST["filter_search"];
    $sql .= "AND p.product_name LIKE '%$searchName%' ";
    $sqlCount .= "AND p.product_name LIKE '%$searchName%' ";
}

if (isset($_POST["filter_cate"]) && !empty($_POST["filter_cate"])) {
    $cateID = $_POST["filter_cate"];
    if($cateID != "all") {
        $sql .= "AND p.cate_id = $cateID ";
        $sqlCount .= "AND p.cate_id = $cateID ";
    }
}

if(isset($_POST["filter_price"])){
    $from = ($_POST["filter_price"]["from"] * 1000);
    $to = ($_POST["filter_price"]["to"] * 1000);
    $sql .= "AND p.price BETWEEN $from AND $to ";
    $sqlCount .= "AND p.price BETWEEN $from AND $to ";
}

if (isset($_POST["arrangeProduct"]) && !empty($_POST["arrangeProduct"])) {
    $arrangeProduct = $_POST["arrangeProduct"];
    if($arrangeProduct == "new_to_old"){
        $sql .= " ORDER BY p.product_id DESC ";
    } elseif($arrangeProduct == "old_to_new"){
        $sql .= " ORDER BY p.product_id ASC ";
    } elseif($arrangeProduct == "view"){
        $sql .= " ORDER BY p.view DESC ";
    } else{
        $sql .= " ORDER BY p.qty_warehouse DESC ";
    }
}

$sql .= " limit $firstIndex, $limit";
$products = executeResult($sql);
$countProducts = executeSingleResult($sqlCount);

if ($countProducts != null) {
    $count = $countProducts['total'];
    $number = ceil($count / $limit);
}

function showProduct()
{
    global $products;
    foreach ($products as $key => $product) {
        echo "<tr" . (($product["deleted"] == 1) ? "style='opacity: 0.5;'" : '') . ">";
        echo "<td>" . $key + 1 . "</td>";
        echo "<td>";
        echo "<img src='../../" . $product["image"] . "' alt='' style='width: 70px; border-radius: 8px;'>";
        echo "</td>";
        echo "<td>" . $product["product_name"] . "</td>";
        echo "<td>" . displayPrice($product["price"]) . " VNĐ</td>";
        echo "<td>" . $product["cate_name"] . "</td>";
        echo "<td>" . $product["view"] . "</td>";
        echo "<td>" . $product["qty_warehouse"] . "</td>";
        echo "<td class='button'>";
        echo "<button onclick='editProduct(" . $product["product_id"] . ")' type='button' class='update'>Update</button>";
        checkBtnAction($product);
        echo "<button type='button' onclick=\"deleteProduct('" . $product["product_name"] . "','" . $product["product_id"] . "')\" class='delete'>Delete</button>";
        echo "</td>";
        echo "</tr>";
    }
}

function checkBtnAction($product)
{
    if ($product["deleted"] == 0) {
        echo "<button onclick='hideProduct(" . $product["product_id"] . ")' type='button' class='hide'>Hide</button>";
    } else {
        echo "<button onclick='recoverProduct(" . $product["qty_warehouse"] . ", " . $product["product_id"] . ")' type='button' class='recover'>Recover</button>";
    }
}

function paginationProduct()
{
    global $page, $number;
    echo "<div class='example'>";
    if($page > 1){
        echo "<div onclick='product_previous(" . $page . ")' class='text'>previous project</div>";
    }
    echo "<div class='counter'>";
    echo "<span class='number curent_page'>" . $page . "</span>";
    echo "<div class='background'></div>";
    echo "<span class='number total_page'>" . $number . "</span>";
    echo "</div>";
    if($page < $number){
        echo "<div onclick='product_next(" . $page . ")' class='text'>next project</div>";
    }
    echo "</div>";
}

if ($products) {
    echo "<div class='table_box_product'>";
    echo "<table class='table-product'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Image</th>";
    echo "<th>Product Name</th>";
    echo "<th>Price</th>";
    echo "<th>Category</th>";
    echo "<th>View</th>";
    echo "<th>Product Quantity</th>";
    echo "<th>Actions</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    showProduct();
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
    if($number > 1){
        paginationProduct();
    }
} else {
    echo "No results found.";
}
