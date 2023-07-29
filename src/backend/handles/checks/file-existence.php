<?php
$fileName = $_POST['fileName'];

$filePath = '../../public/images/products/' . $fileName;

if (file_exists($filePath)) {
    echo 'exists';
} else {
    echo 'not_exists';
}
?>