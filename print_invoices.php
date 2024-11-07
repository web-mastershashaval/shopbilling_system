<?php
session_start();
include('db_connect.php');

if (isset($_GET['id'])) {
    $invoiceId = intval($_GET['id']);

    // Fetch invoice details including customer name
    $stmt = $conn->prepare("
        SELECT invoices.id, customers.name AS customer_name, invoices.total_amount, invoices.created_at
        FROM invoices
        JOIN customers ON invoices.customer_id = customers.id
        WHERE invoices.id = ?
    ");
    $stmt->bind_param('i', $invoiceId);
    $stmt->execute();
    $result = $stmt->get_result();
    $invoice = $result->fetch_assoc();

    if (!$invoice) {
        echo "Invoice not found.";
        exit;
    }
} else {
    echo "No invoice ID provided.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #<?php echo htmlspecialchars($invoice['id']); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h1>Invoice #<?php echo htmlspecialchars($invoice['id']); ?></h1>
<p><strong>Customer Name:</strong> <?php echo htmlspecialchars($invoice['customer_name']); ?></p>
<p><strong>Total Amount:</strong> <?php echo htmlspecialchars($invoice['total_amount']); ?></p>
<p><strong>Date:</strong> <?php echo htmlspecialchars($invoice['created_at']); ?></p>

<script>
    window.onload = function() {
        window.print();
    };
</script>

</body>
</html>
