<?php
$hostname='localhost';
$usernamedb='root';
$passworddb='';
$database='projecthk2';

//su dung cho cau lenh select
function executeResult($sql){
    global $hostname, $usernamedb, $passworddb, $database;
    $con = mysqli_connect($hostname, $usernamedb, $passworddb, $database);
    $result = mysqli_query($con, $sql);
    $data = [];
    if($result != null){
        while($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
        }
    }
    mysqli_close($con);
    return $data;
}


//su dung cho cau lenh insert, update, delete
function execute($sql){
    global $hostname, $usernamedb, $passworddb,$database;
    $con = mysqli_connect($hostname, $usernamedb, $passworddb, $database);
    $result = mysqli_query($con, $sql);
    mysqli_close($con);
    return $result;
}

//su dung cho cau lenh select (1 record)
function executeSingleResult($sql){
    global $hostname, $usernamedb, $passworddb,$database;
    $con = mysqli_connect($hostname, $usernamedb, $passworddb, $database);
    $result = mysqli_query($con, $sql);
    if($result != null){
        $row = mysqli_fetch_array($result,1);
    }
    mysqli_close($con);
    return $row;
}