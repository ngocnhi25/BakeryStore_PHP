<?php
session_start();
require_once("../connect/connectDB.php");

if(isset($_GET["token"])){
    $token = $_GET["token"] ;
    $sql_verify = " SELECT token , status FROM tb_user WHERE token = '$token' LIMIT 1";
    $sql_verify_run = mysqli_query($conn,  $sql_verify);

    if(mysqli_num_rows($sql_verify_run) > 0 ){
        $row = mysqli_fetch_array($sql_verify_run);
        if($row['status'] == "0"){
            $clicked_token = $row['token'] ;
            $sql_update = "UPDATE tb_user SET status = '1' WHERE token = '$clicked_token' LIMIT 1";
            $sql_update_run = mysqli_query($conn, $sql_update );

            if( $sql_update_run){
                $_SESSION['status'] = "Your Account has been verified successfully !";
                header("Location: login.php ") ;
                exit();
            }else{
                $_SESSION['status'] = "Verification Failed !";
                header("Location: login.php ") ;
                exit();
            }
        }else {
            $_SESSION['status'] = "Email already verified . Please login !";
            header("Location: login.php ") ;
            exit();
        }
    }
}else {
    $_SESSION['status'] = " Not Allowed !";
    header("Location: login.php ") ;
    exit();
}


?>