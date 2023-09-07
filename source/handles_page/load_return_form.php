<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderId = isset($_POST['order_id']) ? $_POST['order_id'] : null;
    $productId = isset($_POST['product_id']) ? $_POST['product_id'] : null;
    $reason = isset($_POST['reason']) ? $_POST['reason'] : null;

    // Check if all required fields are provided
    if ($orderId === null || $productId === null || $reason === null) {
        // Handle the case where required fields are missing
        echo 'Missing required form data.';
        exit();
    }

    // Handle image upload
    $targetDir = 'public/images/returnImg/';
    $imageName = basename($_FILES['customer_image']['name']);
    $targetFilePath = $targetDir . $imageName;
    $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    // Check if the image file is a valid image
    $check = getimagesize($_FILES['customer_image']['tmp_name']);
    if ($check !== false) {
        // File is an image

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['customer_image']['tmp_name'], $targetFilePath)) {
            // Insert data into the database
            $dbHost = 'localhost';
            $dbName = 'projecthk2';
            $dbUser = 'root';
            $dbPassword = '';

            try {
                $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Insert data into your database table
                $sql = "INSERT INTO tb_return (order_id, product_id, reason, customer_image) 
                        VALUES (:order_id, :product_id, :reason, :customer_image)";
                $stmt = $pdo->prepare($sql);

                $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
                $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
                $stmt->bindParam(':reason', $reason, PDO::PARAM_STR);
                $stmt->bindParam(':customer_image', $targetFilePath, PDO::PARAM_STR);

                $stmt->execute();

                // Redirect to a success page or perform other actions as needed
                exit();
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        } else {
            echo 'Sorry, there was an error uploading your file.';
        }
    } else {
        echo 'File is not an image.';
    }
}
?>
