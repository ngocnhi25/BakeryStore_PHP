<?php
$hostname = 'localhost';
$usernamedb = 'root';
// $usernamedb = 'id19063450_group3_aptech_fpt';
$passworddb = '';
// $passworddb = '@Anonymous88888';
$database = 'projecthk2';
// $database = 'id19063450_projecthk2_fpt';
$conn = mysqli_connect($hostname, $usernamedb, $passworddb, $database);
if (!$conn) {
    die();
}

//su dung cho cau lenh select
function executeResult($sql)
{
    global $hostname, $usernamedb, $passworddb, $database;
    $con = mysqli_connect($hostname, $usernamedb, $passworddb, $database);
    $result = mysqli_query($con, $sql);
    $data = [];
    if ($result != null) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }
    mysqli_close($con);
    return $data;
}


//su dung cho cau lenh insert, update, delete
function execute($sql)
{
    global $hostname, $usernamedb, $passworddb, $database;
    $con = mysqli_connect($hostname, $usernamedb, $passworddb, $database);
    $result = mysqli_query($con, $sql);
    mysqli_close($con);
    return $result;
}

//su dung cho cau lenh select (1 record)
function executeSingleResult($sql)
{
    global $hostname, $usernamedb, $passworddb, $database;
    $con = mysqli_connect($hostname, $usernamedb, $passworddb, $database);
    $result = mysqli_query($con, $sql);
    if ($result != null) {
        $row = mysqli_fetch_array($result, 1);
    }
    mysqli_close($con);
    return $row;
}

function checkRowTable($sql)
{
    global $hostname, $usernamedb, $passworddb, $database;
    $con = mysqli_connect($hostname, $usernamedb, $passworddb, $database);
    $result = mysqli_query($con, $sql);
    if ($result != null) {
        $row = mysqli_num_rows($result);
    }
    mysqli_close($con);
    return $row;
}

function historyOperation($user_id, $content)
{
    date_default_timezone_set('Asia/Bangkok');
    $date = date('Y-m-d H:i:s');

    execute("INSERT INTO tb_shop_history (user_id, action, action_time) 
    VALUES ($user_id, '$content', '$date')");

    return false;
}
