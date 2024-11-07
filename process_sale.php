<?php
session_start();
include_once('db_connect.php'); // Adjust as needed

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customerName = $_POST['customer_name'];
    $productName = $_POST['product_name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $totalPrice = $_POST['total_price'];
    $saleDate = $_POST['sale_date'];

    // Handle image upload
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["item_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is a actual image
    $check = getimagesize($_FILES["item_image"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size (e.g., limit to 2MB)
    if ($_FILES["item_image"]["size"] > 2000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo' <script>("Sorry, your file was not uploaded.")  </script> ';
    } else {
        // Try to upload file
        if (move_uploaded_file($_FILES["item_image"]["tmp_name"], $targetFile)) {
            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO sales (customer_name, product_name, quantity, price, total_price, sale_date, image_url) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssiddss", $customerName, $productName, $quantity, $price, $totalPrice, $saleDate, $targetFile);

            if ($stmt->execute()) {
                echo "Sale registered successfully.";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo ' <script> alert("Sorry, there was an error uploading your file.")   </script>' ;
        }
    }

    $conn->close();
}
