<?php
include('db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customerId = $_POST['customer'];
    $items = $_POST['item'];
    $quantities = $_POST['quantity'];
    $unitPrices = $_POST['unit_price'];
    $discount = $_POST['discount'];
    $tax = $_POST['tax'];

    // Calculate total price for the invoice
    $totalAmount = 0;
    for ($i = 0; $i < count($items); $i++) {
        $quantity = $quantities[$i];
        $unitPrice = $unitPrices[$i];
        $total = $quantity * $unitPrice;
        $totalAmount += $total;
    }

    // Insert into invoices table
    $stmt = $conn->prepare("INSERT INTO invoices (customer_id, total_amount, discount, tax, created_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param('iddd', $customerId, $totalAmount, $discount, $tax);
    
    if ($stmt->execute()) {
        $invoiceId = $stmt->insert_id; // Get the ID of the inserted invoice
        
        // Insert items into invoice_items table
        $itemStmt = $conn->prepare("INSERT INTO invoice_items (invoice_id, item_name, quantity, unit_price, total) VALUES (?, ?, ?, ?, ?)");
        
        foreach ($items as $index => $itemName) {
            $quantity = $quantities[$index];
            $unitPrice = $unitPrices[$index];
            $total = $quantity * $unitPrice;
            
            $itemStmt->bind_param('isidd', $invoiceId, $itemName, $quantity, $unitPrice, $total);
            $itemStmt->execute();
        }

        // Close statements
        $itemStmt->close();
        $stmt->close();
        
        header('Location: dashboard.php'); // Redirect after saving
    } else {
        echo "Error: " . $stmt->error; // Display error
    }

    $conn->close();
}
?>
