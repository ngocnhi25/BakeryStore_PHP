<?php
require_once("../../../connect/connectDB.php");
require_once("../../../handles_page/handle_calculate.php");

$limit = 5;
$page = 1;
$number = 0;
if(isset($_POST["page"])){
    $page = $_POST["page"];
}
$firstIndex = ($page - 1) * $limit;

$sql = "SELECT * FROM tb_user WHERE role = 1 AND 1   ";
$sqlCount = "SELECT COUNT(*) AS total FROM tb_user WHERE 1 ";

if (isset($_POST["filter_search"]) && !empty($_POST["filter_search"])) {
    $searchName = $_POST["filter_search"];
    $sql .= "AND (username LIKE '%$searchName%' OR phone LIKE '%$searchName%' OR email LIKE '%$searchName%') ";
    $sqlCount .= "AND (username LIKE '%$searchName%' OR phone LIKE '%$searchName%' OR  email LIKE '%$searchName%' ) ";
}

if (isset($_POST["arrangeCustomer"]) && !empty($_POST["arrangeCustomer"])) {
    $arrangeCustomer = $_POST["arrangeCustomer"];
    if($arrangeCustomer == "all"){
        $sql .= " ORDER BY user_id DESC ";
    }
    else if($arrangeCustomer == "new_to_old"){
        $sql .= " ORDER BY user_id DESC ";
    } elseif($arrangeCustomer == "old_to_new"){
        $sql .= " ORDER BY user_id ASC ";
    } elseif($arrangeCustomer == "Active"){
        $sql .= " AND status = 1 ";
    } elseif($arrangeCustomer == "Deactive"){
        $sql .= " AND status = 0 ";
    }else {
        echo "No results found.";
    }
}

$sql .= " limit $firstIndex, $limit";
$cus = executeResult($sql);
$countSales = executeSingleResult($sqlCount);

if ($countSales != null) {
    $count = $countSales['total'];
    $number = ceil($count / $limit);
}

if ($countSales != null) {
    $count = $countSales['total'];
    $number = ceil($count / $limit);
}

function showCus()
{
    global $cus ;

    foreach ($cus as $key => $c) {
        echo "<tr>";
        echo "<td>". ($key + 1) ."</td>";
        echo "<td>". $c["username"] ."</td>";
        echo "<td>". $c["email"] ."</td>";
        echo "<td>". $c["phone"] ."</td>";
        echo "<td>". $c["create_date"] ."</td>";
        echo "<td>";

        if ($c["status"] == 1) {
            echo '<button id="deactivateButton' . $c["user_id"] . '" onclick="deactivateUser(' . $c["user_id"] . ')" style="background-color: greenyellow;">Activate</button>';
        }
         if ($c["status"] == 0){
            echo '<button id="deactivateButton' . $c["user_id"] . '" onclick="ActivateUser(' . $c["user_id"] . ')" style="background-color: gray;">Deactivate</button>';
        }

        echo "</td>";
        echo "</tr>";
    }
}


function paginationCus()
{
        global $page, $number;
        echo "<div class='example'>";
        if($page > 1){
            echo "<div onclick='product_previous(" . $page . ")' class='text'>previous </div>";
        }
        echo "<div class='counter'>";
        echo "<span class='number curent_page'>" . $page . "</span>";
        echo "<div class='background'></div>";
        echo "<span class='number total_page'>" . $number . "</span>";
        echo "</div>";
        if($page < $number){
            echo "<div onclick='product_next(" . $page . ")' class='text'>Next</div>";
        }
        echo "</div>";
    
}

if ($cus) {
    echo "<table class='table-admin'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Customer</th>";
    echo "<th>Email</th>";
    echo "<th>Telephone</th>";
    echo "<th>Create Date</th>";
    echo "<th>Status</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    showCus();
    echo "</tbody>";
    echo "</table>";
    if ($number > 1) {
        paginationCus();
    }
} else {
    echo "No results found.";
}
