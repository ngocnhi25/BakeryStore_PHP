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

$sql = "SELECT * FROM tb_coupon WHERE 1 ";
$sqlCount = "SELECT COUNT(*) AS total FROM tb_coupon WHERE 1 ";

if (isset($_POST["filter_search"]) && !empty($_POST["filter_search"])) {
    $searchName = $_POST["filter_search"];
    $sql .= "AND coupon_name LIKE '%$searchName%' ";
    $sqlCount .= "AND coupon_name LIKE '%$searchName%' ";
}

if (isset($_POST["arrangeCoupon"]) && !empty($_POST["arrangeCoupon"])) {
    $arrangeCoupon = $_POST["arrangeCoupon"];
    if($arrangeCoupon == "new_to_old"){
        $sql .= " ORDER BY coupon_id DESC ";
    } elseif($arrangeCoupon == "old_to_new"){
        $sql .= " ORDER BY coupon_id ASC ";
    } elseif($arrangeCoupon == "a_z"){
        $sql .= " ORDER BY coupon_name ASC ";
    } else{
        $sql .= " ORDER BY coupon_name DESC ";
    }
}

$sql .= " limit $firstIndex, $limit";
$coupons = executeResult($sql);
$countSales = executeSingleResult($sqlCount);


if ($countSales != null) {
    $count = $countSales['total'];
    $number = ceil($count / $limit);
}

function showCoupon()
{
    global $coupons;
    foreach ($coupons as $key => $c) {
        echo "<tr>";
        echo "<td>". $key + 1 ."</td>";
        echo "<td>". $c["coupon_name"] ."</td>";
        echo "<td>". displayPrice($c["discount_coupon"]) ." vnđ</td>";
        echo "<td>". displayPrice($c["condition_used_coupon"]) ." vnđ</td>";
        echo "<td>". $c["qti_used_coupon"] ."</td>";
        echo "<td>". $c["qti_coupon"] ."</td>";
        echo "<td>". $c["start_date"] ."</td>";
        echo "<td>". $c["end_date"] ."</td>";
        echo "<td>";
        echo "<button onclick='updateCoupon(". $c['coupon_id'] .")' class='update'>Update</button>";
        echo "<button onclick='deleteCoupon('". $c['coupon_name'] ."', ". $c['coupon_id'] .")' class='delete'>Delete</button>";
        echo "</td>";
        echo "</tr>";
    }
}

function paginationCoupon()
{
    global $page, $number;
    echo "<div class='pagination-coupon'>";
    if($page > 1){
        echo "<button type='button' onclick='coupon_previous(" . $page . ")'>";
        echo "<span class='material-symbols-sharp'>arrow_back_ios</span>";
        echo "</button>";
    }
    echo "<div>$page</div>";
    if($page < $number ){
        echo "<button type='button'>";
        echo "<span class='material-symbols-sharp' onclick='coupon_next(" . $page . ")'>arrow_forward_ios</span>";
        echo "</button>";
    }
    echo "</div>";
}

if ($coupons) {
    echo "<table class='table-admin'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th></th>";
    echo "<th>Code</th>";
    echo "<th>Reduction amount</th>";
    echo "<th>Conditions of use</th>";
    echo "<th>Users use</th>";
    echo "<th>Quantity coupon</th>";
    echo "<th>Start date</th>";
    echo "<th>End date</th>";
    echo "<th>Action</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
        showCoupon();
    echo "</tbody>";
    echo "</table>";
    if($number > 1){
        paginationCoupon();
    }
} else {
    echo "No results found.";
}
