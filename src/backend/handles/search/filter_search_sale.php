<?php
require_once("../../../connect/connectDB.php");
require_once("../../../handles_page/handle_calculate.php");

$limit = 4;
$page = 1;
$number = 0;
if(isset($_POST["page"])){
    $page = $_POST["page"];
}
$firstIndex = ($page - 1) * $limit;

$sql = "SELECT * FROM tb_sale s INNER JOIN tb_products p ON s.product_id = p.product_id WHERE 1 ";
$sqlCount = "SELECT COUNT(*) AS total FROM tb_sale s INNER JOIN tb_products p ON s.product_id = p.product_id WHERE 1 ";

if (isset($_POST["filter_search"]) && !empty($_POST["filter_search"])) {
    $searchName = $_POST["filter_search"];
    $sql .= "AND p.product_name LIKE '%$searchName%' ";
    $sqlCount .= "AND p.product_name LIKE '%$searchName%' ";
}

if (isset($_POST["arrangeSale"]) && !empty($_POST["arrangeSale"])) {
    $arrangeSale = $_POST["arrangeSale"];
    if($arrangeSale == "new_to_old"){
        $sql .= " ORDER BY s.sale_id DESC ";
    } elseif($arrangeSale == "old_to_new"){
        $sql .= " ORDER BY s.sale_id ASC ";
    } elseif($arrangeSale == "a_z"){
        $sql .= " ORDER BY p.product_name ASC ";
    } elseif($arrangeSale == "z_a"){
        $sql .= " ORDER BY p.product_name DESC ";
    } elseif($arrangeSale == "ascending_percent"){
        $sql .= " ORDER BY s.percent_sale ASC ";
    } else {
        $sql .= " ORDER BY s.percent_sale DESC ";
    }
}

$sql .= " limit $firstIndex, $limit";
$sales = executeResult($sql);
$countSales = executeSingleResult($sqlCount);

if ($countSales != null) {
    $count = $countSales['total'];
    $number = ceil($count / $limit);
}

function showSale()
{
    global $sales;
    foreach ($sales as $key => $s) {
        echo "<tr>";
        echo "<td>". $key + 1 ."</td>";
        echo "<td>". $s["product_name"] ."</td>";
        echo "<td>". $s["percent_sale"] ."%</td>";
        echo "<td>". $s["start_date"] ."</td>";
        echo "<td>". $s["end_date"] ."</td>";
        echo "<td>";
        echo "<button onclick='updateSale(". $s['sale_id'] .")' type='button' class='update'>Edit</button>";
        echo "<button onclick='deleteSale('". $s['product_name'] ."', ". $s['sale_id'] .")' type='button' class='delete'>Delete</button>";
        echo "</td>";
        echo "</tr>";
    }
}

function paginationSale()
{
    global $page, $number;
    echo "<div class='pagination-sale'>";
    if($page > 1){
        echo "<button type='button' onclick='sale_previous(" . $page . ")'>";
        echo "<span class='material-symbols-sharp'>arrow_back_ios</span>";
        echo "</button>";
    }
    echo "<div>$page</div>";
    if($page < $number){
        echo "<button type='button'>";
        echo "<span class='material-symbols-sharp' onclick='sale_next(" . $page . ")'>arrow_forward_ios</span>";
        echo "</button>";
    }
    echo "</div>";
}

if ($sales) {
    echo "<table class='table-admin'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th></th>";
    echo "<th>Product name</th>";
    echo "<th>Percent sale</th>";
    echo "<th>Start date</th>";
    echo "<th>End date</th>";
    echo "<th>Action</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
        showSale();
    echo "</tbody>";
    echo "</table>";
    if($number > 1){
        paginationSale();
    }
} else {
    echo "No results found.";
}
