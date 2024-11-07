<?php
include('db_connect.php');

if (!isset($_GET['id'])) {
    die('Invoice ID not specified');
}

$invoiceId = $_GET['id'];

// Retrieve invoice details
$sql = "SELECT * FROM invoices WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $invoiceId);
$stmt->execute();
$invoiceResult = $stmt->get_result();
$invoice = $invoiceResult->fetch_assoc();

// Retrieve invoice items
$sql = "SELECT * FROM invoice_items WHERE invoice_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $invoiceId);
$stmt->execute();
$itemsResult = $stmt->get_result();
$items = $itemsResult->fetch_all(MYSQLI_ASSOC);

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #<?php echo $invoiceId; ?></title>
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
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Invoice #<?php echo $invoiceId; ?></h1>
    <p>Customer ID: <?php echo $invoice['customer_id']; ?></p>
    <p>Total Amount: $<?php echo number_format($invoice['total_amount'], 2); ?></p>
    <p>Discount: <?php echo $invoice['discount']; ?>%</p>
    <p>Tax: <?php echo $invoice['tax']; ?>%</p>
    <p>Date: <?php echo $invoice['created_at']; ?></p>

    <h2>Items</h2>
    <table>
        <thead>
            <tr>
                <th>Item</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
            <tr>
                <td><?php echo $item['item_name']; ?></td>
                <td><?php echo $item['quantity']; ?></td>
                <td>$<?php echo number_format($item['unit_price'], 2); ?></td>
                <td>$<?php echo number_format($item['total'], 2); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <button onclick="window.print()">Print Invoice</button>
</body>
</html>
