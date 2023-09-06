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

$sql = "SELECT * from tb_comments c
inner join tb_products p
on p.product_id  = c.product_id inner join tb_user u on c.user_id  = u.user_id  WHERE 1 ";

$sqlCount = "SELECT COUNT(*) AS total FROM tb_comments c
INNER JOIN  tb_products p
on p.product_id  = c.product_id  inner join tb_user u on c.user_id  = u.user_id WHERE 1 ";

if (isset($_POST["filter_search"]) && !empty($_POST["filter_search"])) {
    $searchName = $_POST["filter_search"];
    $sql .= "AND ( u.username LIKE '%$searchName%') ";
    $sqlCount .= "AND (u.username LIKE '%$searchName%') ";
}

if (isset($_POST["arrangeComment"]) && !empty($_POST["arrangeComment"])) {
    $arrangeComment = $_POST["arrangeComment"];
    if ($arrangeComment == "all") {
        $sql .= " ORDER BY c.comment_id DESC ";
    } elseif ($arrangeComment == "new_to_old") {
        $sql .= " ORDER BY c.comment_id DESC ";
    } elseif ($arrangeComment == "old_to_new") {
        $sql .= " ORDER BY c.comment_id ASC ";
    } else {
        echo "No results found.";
    }
}


$sql .= " limit $firstIndex, $limit";
$com = executeResult($sql);
$countSales = executeSingleResult($sqlCount);


if ($countSales != null) {
    $count = $countSales['total'];
    $number = ceil($count / $limit);
}

if ($countSales != null) {
    $count = $countSales['total'];
    $number = ceil($count / $limit);
}

function  showCommnet()
{
    global $com;

    foreach ($com as $key => $c) {
        echo "<tr>";
        echo "<td>" . ($key + 1) . "</td>";
        echo "<td>" . $c["product_name"] . "</td>";
        echo '<td><img src="../../' . $c["image"] . '" alt="" style="width: 70px; border-radius: 8px;"></td>';
        echo "<td>" . $c["inbox_date"] . "</td>";
        // echo "<td>" . $c["vote"] . "</td>";
        // echo "<td>" . $c["vote"] . "</td>";
        echo "<td>" . $c["content"] . "</td>";
        echo "<td>" . $c["username"] . "</td>";
        echo "<td>";
        echo '<button id="DeleteButton' . $c["comment_id"] . '" onclick="DeleteCom(' . $c["comment_id"] . ')" style="background-color: red;">Delete</button>';
        echo "</td>";
        echo "</tr>";
    }
}


function paginationCom()
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

if ($com) {
    echo "<table class='table-admin'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>STT</th>";
    echo "<th>Product Name</th>";
    echo "<th>Image</th>";
    echo "<th>Create Date</th>";
    // echo "<th>All Like</th>";
    // echo "<th>All Unlike</th>";
    echo "<th>Content</th>";
    echo "<th>Username</th>";
    echo "<th>Action</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    showCommnet();
    echo "</tbody>";
    echo "</table>";
    if ($number > 1) {
        paginationCom();
    }
} else {
    echo "No results found.";
}
