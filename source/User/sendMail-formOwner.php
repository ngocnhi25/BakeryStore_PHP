<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
//Load Composer's autoloader
require_once("../User/vendor/autoload.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(isset($_GET['code'])){
    $user_id =$_GET['code'];


    $sql = "delete from tbProducts where code = '$code'";
    $product = execute($sql);
    header('Location: adminProduct.php');
}
?>