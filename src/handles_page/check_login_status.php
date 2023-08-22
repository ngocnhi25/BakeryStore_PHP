<?php
session_start();

if (isset($_SESSION["auth_user"])) {
    echo "loggedin";
} else {
    echo "notloggedin";
}
?>
