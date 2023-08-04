<?php
require_once("../connect/dbcontroller.php");
require_once("pagination.class.php");
$db_handle = new DBController();
$perPage = new PerPage();

$sql = "SELECT * FROM tb_products";
$paginationlink = "getresult.php?page=";
$pagination_setting = isset($_GET["pagination_setting"]) ? $_GET["pagination_setting"] : "";

$page = 1;
if (!empty($_GET["page"])) {
    $page = $_GET["page"];
}

// Adjust the number of items per page here (e.g., 3 items per page)
$itemsPerPage = 3;
$start = ($page - 1) * $itemsPerPage;
if ($start < 0) $start = 0;

$query =  $sql . " LIMIT " . $start . "," . $itemsPerPage;
$faq = $db_handle->runQuery($query);

if (empty($_GET["rowcount"])) {
    $_GET["rowcount"] = $db_handle->numRows($sql);
}

if ($pagination_setting == "prev-next") {
    $perpageresult = $perPage->getPrevNext($_GET["rowcount"], $paginationlink, $pagination_setting);
} else {
    $perpageresult = $perPage->getAllPageLinks($_GET["rowcount"], $paginationlink, $pagination_setting);
}

$output = '';
if (!empty($faq)) {
    foreach ($faq as $sp) {
        $output .= '
        <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1">
            <div class="one-product-container">
                <div class="product-images">
                    <a class="product-image hover-animation">
                    <img src="../../' . $sp["image"] . '" alt="Valentine cake 006" />
                    <img src="../../' . $sp["image"] . '" alt="Valentine cake 006" />
                    </a>
                </div>
                <div style="margin-left: 15px; margin-right: 15px;">
                    <p style="font-size: 21px; font-weight:500; margin: 5px 0px ;">
                        <a href="#/">' . $sp["product_name"] . '</a>
                        <input type="hidden" name="price" id="price' . $sp["product_id"] . '" value="' . $sp["price"] . '">
                        <input type="hidden" name="name" id="name' . $sp["product_id"] . '" value="' . $sp["product_name"] . '">
                    </p>
                    <div class="">
                        <span class="price" style="font-weight: 700; color: red;">' . $sp["price"] . '$</span>
                    </div>
                    <div class="input_quantity_product">
                        
                    </div>
                    <div style="margin-top: 5px;" class="input_quantity_product">
                        <input type="submit" value="Thêm vào giỏ hàng" class="add-to-cart add" id="' . $sp["product_id"] . '" name="add_to_cart">
                        <input type="number" width="50px" id="quantity' . $sp["product_id"] . '">
                    </div>
                </div>
            </div>
        </div>';
    }
} else {
    $output .= '<div class="no-results">No products found.</div>';
}

if (!empty($perpageresult)) {
    $output .= '<div id="pagination">' . $perpageresult . '</div>';
}
print($output)
?>
