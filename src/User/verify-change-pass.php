<!-- <?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
require_once("../connect/connectDB.php");
if(isset($_GET["newtoken"])){
    $newtoken = $_GET["newtoken"] ;
    $sql_verify = " SELECT token , status  FROM tb_user WHERE token = '$newtoken' LIMIT 1";
    $sql_verify_run = mysqli_query($conn,  $sql_verify);

    if(mysqli_num_rows($sql_verify_run) > 0 ){
        $row = mysqli_fetch_array($sql_verify_run);
        if($row['status'] == "0"){
            $clicked_token = $row['token'] ;
            $sql_update = "UPDATE tb_user SET status = '1' WHERE token = '$clicked_token'";
            $sql_update_run = mysqli_query($conn, $sql_update );
            if( $sql_update_run){
                $_SESSION['status'] = "Your account has been successfully verified. New password has been updated!";;
                header("Location: ../my_account_user.php");
                exit();
            }else{
                $_SESSION['status'] = "Verification Failed !";
                header("Location: ../my_account_user.php");
                exit();
            }
        }else {
            $_SESSION['status'] = "Email already verified for update new password!";
            header("Location: ../my_account_user.php");
            exit();
        }
    }
}else {
    $_SESSION['status'] = " Not Allowed !";
    header("Location: ../my_account_user.php");
    exit();
}

?> -->