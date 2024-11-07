<?php
session_start();
include('db_connect.php'); // Include your database connection script

// Fetch invoices with customer names
$query = "
    SELECT invoices.id, customers.name AS customer_name, invoices.total_amount, invoices.created_at
    FROM invoices
    JOIN customers ON invoices.customer_id = customers.id
"; 
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Invoices</title>
    <style>
        .main-content {
            padding: 40px;
            background-color: #f5f5f5;
        }
        h1 {
            font-size: 32px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        #print-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
        }
        #print-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<main class="main-content">
    <h1>Invoices</h1>

    <table>
        <thead>
            <tr>
                <th>Invoice ID</th>
                <th>Customer Name</th>
                <th>Total Amount</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['customer_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['total_amount']); ?></td>
                    <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                    <td>
                        <button onclick="printInvoice(<?php echo htmlspecialchars($row['id']); ?>)">Print Invoice</button>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</main>

<script>
    function printInvoice(invoiceId) {
        // Open a new window with the invoice details
        const printWindow = window.open(`print_invoice.php?id=${invoiceId}`, '', 'height=600,width=800');
        printWindow.onload = function() {
            printWindow.print();
        };
    }
</script>

</body>
</html>
