<?php
// process_debt.php
$servername = "localhost";
$username = "root"; // change this if your MySQL username is different
$password = ""; // add your MySQL password if you have one
$dbname = "shopbillingsystem";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO debts (customer_name, debt_amount, due_date, payment_status, payment_date) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sdsss", $customer_name, $debt_amount, $due_date, $payment_status, $payment_date);

// Set parameters and execute
$customer_name = $_POST['customer_name'];
$debt_amount = $_POST['debt_amount'];
$due_date = $_POST['due_date'];
$payment_status = $_POST['payment_status'];
$payment_date = $_POST['payment_date'] ?? null; // Optional

if ($stmt->execute()) {
    echo "New debt record created successfully.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
echo '<script> alert("New Dept Recode added Successfully ! ")</script>';
header("Location: dashboard.php"); // Redirect back to the debt management page
exit();
?>
