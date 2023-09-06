<?php
require_once("../../../connect/connectDB.php");
require_once("../../../handles_page/handle_calculate.php");

$limit = 13;
$page = 1;
$number = 0;
if (isset($_POST["page"])) {
    $page = $_POST["page"];
}
$firstIndex = ($page - 1) * $limit;

$sql = "SELECT * FROM tb_shop_history sh
        INNER JOIN tb_user u 
        ON sh.user_id = u.user_id WHERE 1 ";
$sqlCount = "SELECT COUNT(*) AS total FROM tb_shop_history sh
                    INNER JOIN tb_user u 
                    ON sh.user_id = u.user_id WHERE 1 ";

if (isset($_POST["filter_search"]) && !empty($_POST["filter_search"])) {
    $searchName = $_POST["filter_search"];
    $sql .= "AND (u.username LIKE '%$searchName%' or sh.action LIKE '%$searchName%') ";
    $sqlCount .= "AND (u.username LIKE '%$searchName%' or sh.action LIKE '%$searchName%') ";
}

if (isset($_POST["arrangeHistory"]) && !empty($_POST["arrangeHistory"])) {
    $arrangeHistory = $_POST["arrangeHistory"];
    if ($arrangeHistory == "today") {
        $sql .= "AND action_time = CURDATE() ";
        $sqlCount .= "AND action_time = CURDATE() ";
    } elseif ($arrangeHistory == "yesterday") {
        $sql .= "AND DATE(action_time) = DATE(NOW() - INTERVAL 1 DAY) ";
        $sqlCount .= "AND DATE(action_time) = DATE(NOW() - INTERVAL 1 DAY) ";
    } elseif ($arrangeHistory == "current_month") {
        $sql .= "AND MONTH(action_time) = MONTH(CURRENT_DATE())
                AND YEAR(action_time) = YEAR(CURRENT_DATE()) ";
        $sqlCount .= "AND MONTH(action_time) = MONTH(CURRENT_DATE())
                        AND YEAR(action_time) = YEAR(CURRENT_DATE()) ";
    } elseif ($arrangeHistory == "last_month") {
        $sql .= "AND DATE_FORMAT(action_time, '%Y-%m') = DATE_FORMAT(CURRENT_DATE - INTERVAL 1 MONTH, '%Y-%m') ";
        $sqlCount .= "AND DATE_FORMAT(action_time, '%Y-%m') = DATE_FORMAT(CURRENT_DATE - INTERVAL 1 MONTH, '%Y-%m') ";
    }
}

$sql .= " ORDER BY sh.shop_history_id DESC limit $firstIndex, $limit";
$historys = executeResult($sql);
$countHistory = executeSingleResult($sqlCount);

if ($countHistory != null) {
    $count = $countHistory['total'];
    $number = ceil($count / $limit);
}

function showHistory()
{
    global $historys;
    foreach ($historys as $key => $h) {
        echo "<tr>";
        echo "<td>".($key + 1)."</td>";
        echo "<td>".$h["username"]."</td>";
        echo "<td>".$h["action"]."</td>";
        echo "<td>".$h["action_time"]."</td>";
        echo "</tr>";
    }
}

function paginationHistory()
{
    global $page, $number;
    if ($number > 1) {
        echo '<ul class="prod-page-box">';
        if ($page > 1) {
            echo '<li class="prod-page-item"><div class="page-link" onclick="pageClickHistory(' . ($page - 1) . ')">Previous</div></li>';
        }

        $avaiablePage = [1, $page - 1, $page, $page + 1, $number]; //mảng gồm trang đầu, trang cuối, trang hiện tại và 2 trang kế trang hiện tại 
        $isFirst = $isLast = false; // 2 biến này để kiếm tra có dấu ... trước và sau trang hiện tại chưa
        for ($i = 0; $i < $number; $i++) {
            if (!in_array($i + 1, $avaiablePage)) { //nếu không có trong mảng thì ra khỏi vòng for
                if (!$isFirst && $page > 3) { //nếu chưa có dấu ... và số trang phải lớn hơn 3
                    echo '<li class="prod-page-item"><div class="page-link" onclick="pageClickHistory(' . ($page - 2) . ')">...</div></li>';
                    $isFirst = true; //xác nhận đã có dấu ...
                }
                if (!$isLast && $i > $page) {
                    echo '<li class="page-item"><div class="page-link" onclick="pageClickHistory(' . ($page + 2) . ')" >...</div></li>';
                    $isLast = true; //xác nhận đã có dấu ...
                }
                continue;
            }
            if ($page == $i + 1) {
                echo '<li class="prod-page-item active">
                <div class="page-link">' . ($i + 1) . '</div>
                </li>';
            } else {
                echo '<li class="prod-page-item">
                <div class="page-link" onclick="pageClickHistory(' . ($i + 1) . ')">' . ($i + 1) . '</div>
                </li>';
            }
        }
        if ($page < $number) {
            echo '<li class="prod-page-item">
            <div class="page-link" onclick="pageClickHistory(' . ($page + 1) . ')">Next</div></li>';
        }
    }
}

if ($historys) {
    echo "<div class='table_box_product'>";
    echo "<table class='table-admin'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th></th>";
    echo "<th>User</th>";
    echo "<th>Action</th>";
    echo "<th>Action time</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    showHistory();
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
    echo "<div class='pagination-history'>";
    if ($number > 1) {
        paginationHistory();
    }
    echo "</div>";
} else {
    echo "No results found.";
}
