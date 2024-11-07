<?php
include('db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $debt = $_POST['debt'];
    $customer_id = $_POST['customer_id']; // Check if this is set for editing

    if ($customer_id) {
        // Update existing customer
        $updateQuery = "UPDATE customers SET name=?, contact=?, address=?, outstanding_debt=? WHERE id=?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("ssssi", $name, $contact, $address, $debt, $customer_id);
    } else {
        // Insert new customer
        $insertQuery = "INSERT INTO customers (name, contact, address, outstanding_debt) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("sssd", $name, $contact, $address, $debt);
    }

    if ($stmt->execute()) {
        header("Location: dashboard.php"); 
    } else {
        echo "Error: " . $stmt->error;
    }
}

$conn->close();
?>
