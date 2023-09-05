<?php
require_once("../../../connect/connectDB.php");
require_once("../../../handles_page/handle_calculate.php");

$nameProduct = $nameCate = [];

$limit = 4;
$page = 1;
$number = 0;
if (isset($_POST["page"])) {
    $page = $_POST["page"];
}
$firstIndex = ($page - 1) * $limit;

$sql = "SELECT * FROM tb_ads WHERE 1 ";
$sqlCount = "SELECT COUNT(*) AS total FROM tb_ads WHERE 1 ";

if (isset($_POST["filter_search"]) && !empty($_POST["filter_search"])) {
    $searchName = $_POST["filter_search"];
    $product = executeResult("SELECT * FROM tb_ads a 
                                INNER JOIN tb_products p ON a.product_id = p.product_id 
                                where p.product_name like '%$searchName%'");
    $cate = executeResult("SELECT * FROM tb_ads a 
                                INNER JOIN tb_category c ON a.cate_id = c.cate_id 
                                where c.cate_name like '%$searchName%'");
    foreach ($product as $key => $p) {
        $nameProduct[$key] = $p["product_id"];
    }
    foreach ($cate as $key => $c) {
        $nameCate[$key] = $c["cate_id"];
    }
    $product_id = implode(",", $nameProduct);
    $cate_id = implode(",", $nameCate);
    if($product_id != null && $cate_id != null){
        $sql .= "AND (product_id IN(" . $product_id . ") OR cate_id IN(" .$cate_id. ")) ";
        $sqlCount .= "AND (product_id IN(" . $product_id . ") OR cate_id IN(" .$cate_id. ")) ";
    } elseif($product_id != null && $cate_id == null){
        $sql .= "AND product_id IN(" . $product_id . ") ";
        $sqlCount .= "AND product_id IN(" . $product_id . ") ";
    } elseif($product_id == null && $cate_id != null){
        $sql .= "AND cate_id IN(" .$cate_id. ") ";
        $sqlCount .= "AND cate_id IN(" .$cate_id. ") ";
    } else {
        $sql .= "AND type_ads = 'nodata' ";
        $sqlCount .= "AND type_ads = 'nodata' ";
    }
}

if (isset($_POST["arrangeAds"]) && !empty($_POST["arrangeAds"])) {
    $arrangeAds = $_POST["arrangeAds"];
    if ($arrangeAds == "new_to_old") {
        $sql .= " ORDER BY ads_id DESC ";
    } elseif ($arrangeAds == "old_to_new") {
        $sql .= " ORDER BY ads_id ASC ";
    } elseif ($arrangeAds == "ongoing") {
        $sql .= "AND CURDATE() BETWEEN start_date AND end_date ";
        $sqlCount .= "AND CURDATE() BETWEEN start_date AND end_date ";
    } elseif ($arrangeAds == "ceased") {
        $sql .= "AND CURDATE() > end_date ";
        $sqlCount .= "AND CURDATE() > end_date ";
    } elseif ($arrangeAds == "pending") {
        $sql .= "AND CURDATE() < start_date ";
        $sqlCount .= "AND CURDATE() < start_date ";
    }
}

$sql .= " limit $firstIndex, $limit";
$ads = executeResult($sql);
$countAds = executeSingleResult($sqlCount);


if ($countAds != null) {
    $count = $countAds['total'];
    $number = ceil($count / $limit);
}

function showAds()
{
    global $ads;
    foreach ($ads as $key => $a) {
        echo "<tr>";
        echo "<td>" . $key + 1 . "</td>";
        echo "<td>";
        if ($a["type_ads"] == "product") {
            $showProductID = $a["product_id"];
            $productShow = executeSingleResult("SELECT product_name FROM tb_products Where product_id = $showProductID");
            echo $a["type_ads"] . ": " . $productShow["product_name"];
        } elseif ($a["type_ads"] == "category") {
            $showCateID = $a["cate_id"];
            $cateShow = executeSingleResult("SELECT cate_name FROM tb_category Where cate_id = $showCateID");
            echo $a["type_ads"] . ": " . $cateShow["cate_name"];
        } else {
            echo $a["type_ads"];
        }
        echo "</td>";
        echo "<td class='image-banner'>";
        echo "<img src='../../" . $a["image_ads"] . "' alt=''>";
        echo "</td>";
        echo "<td>" . $a["start_date"] . "</td>";
        echo "<td>" . $a["end_date"] . "</td>";
        echo "<td>";
        echo "<button class='update' type='button' onclick='updateAds(" . $a['ads_id'] . ")'><span class='material-symbols-sharp icon'>edit_square</span></button>";
        echo "<button class='delete' type='button' onclick='deleteAds(" . $a['ads_id'] . ")'>Delete</button>";
        echo "</td>";
        echo "</tr>";
    }
}

function paginationAds()
{
    global $page, $number;
    echo "<div class='pagination-ads'>";
    if ($page > 1) {
        echo "<button type='button' onclick='ads_previous(" . $page . ")'>";
        echo "<span class='material-symbols-sharp'>arrow_back_ios</span>";
        echo "</button>";
    }
    echo "<div>$page</div>";
    if ($page < $number) {
        echo "<button type='button'>";
        echo "<span class='material-symbols-sharp' onclick='ads_next(" . $page . ")'>arrow_forward_ios</span>";
        echo "</button>";
    }
    echo "</div>";
}

if ($ads) {
    echo "<table class='table-admin'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th></th>";
    echo "<th>Type</th>";
    echo "<th>Image</th>";
    echo "<th>Start Date</th>";
    echo "<th>End Date</th>";
    echo "<th>Action</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    showAds();
    echo "</tbody>";
    echo "</table>";
    if ($number > 1) {
        paginationAds();
    }
} else {
    echo "No results found.";
}
