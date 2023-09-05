<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
require_once("../connect/connectDB.php");

$errors = [];
$errors["errorUsername"] =
    $errors["errorPhone"] =
    $errors["errorSex"] =
    $errors["errorAddress"] =
    $errors["errorBirthday"] = '';
$errorNum = 0; // Initialize error counter to 0

$userId = isset($_POST["userId"]) ? $_POST["userId"] : '';


if ($userId == '') {
    // Handle the case where user ID is missing or invalid
    echo json_encode(['error' => 'Invalid user ID']);
    exit;
}

// Validate username
if (isset($_POST["username"]) && !empty($_POST["username"])) {
    $username = trim($_POST["username"]);
    if (strlen($username) < 6 || strlen($username) > 20) {
        $errors["errorUsername"] = 'Username must be between 6 and 20 characters';
        $errorNum++;
    }
    if (strpos($username, ' ') !== false) {
        $errors["errorUsername"] = 'New password must not contain spaces';
        $errorNum++;
    }

} else {
    $errors["errorUsername"] = 'Username cannot be blank';
    $errorNum++;
}

// Validate phone number
if (isset($_POST["phone"]) && !empty($_POST["phone"])) {
    $phone = trim($_POST["phone"]);
    if (!preg_match("/^[0-9]{10,12}$/", $phone)) {
        $errors["errorPhone"] = 'Invalid Phone number';
        $errorNum++;
    }
} else {
    $errors["errorPhone"] = 'PhoneNumber cannot be blank';
    $errorNum++;
}

// Validate date of birth
if (isset($_POST["dob"]) && !empty($_POST["dob"])) {
    $dob = trim($_POST["dob"]);
    $currentDate = date('Y-m-d');
    $selectedDate = new DateTime($dob);
    $currentDateTime = new DateTime($currentDate);
    $dateDifference = $selectedDate->diff($currentDateTime);

    if ($dateDifference->y < 18 || $selectedDate > $currentDateTime) {
        $errors["errorBirthday"] = 'You must be at least 18 years old and provide a valid Date of Birth.';
        $errorNum++;
    }
}
if(isset($_POST['address'])){
    $address = trim($_POST["address"]);
    if (strlen($address) > 100) {
        $errors["errorAddress"] = 'Address must be smaller than 100 characters';
        $errorNum++;
    }
}

if(isset($_POST['sex'])){
    $sex = trim($_POST["sex"]);
}


if ($errorNum == 0) {
    // Perform the database update
    $sql_update_infor_user = "UPDATE tb_user SET username = '$username', phone = '$phone', sex = '$sex', birthday = '$dob', address = '$address' WHERE user_id = $userId";
    $sql_update_infor_user_run = mysqli_query($conn, $sql_update_infor_user);

    if ($sql_update_infor_user_run) {
        echo 'success'; // Signal a successful update
    } else {
        echo json_encode(['error' => 'Database error']); // Signal a database error
    }
} else {
    echo json_encode($errors); // Return the validation errors
}


?>
