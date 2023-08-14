<?php
session_start();

if (isset($_SESSION["authenticated"])) {
    echo "authenticated";
} else {
    echo "not_authenticated";
}
?>