<?php
include('db_connect.php'); // Include your database connection

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Fetch total sales
$totalSalesQuery = "SELECT SUM(total_price) AS total_sales FROM sales";
$totalSalesResult = $conn->query($totalSalesQuery);
if (!$totalSalesResult) {
    die("Query failed: " . $conn->error);
}
$totalSales = $totalSalesResult->fetch_assoc()['total_sales'] ?? 0;

// Fetch total debt
$totalDebtQuery = "SELECT SUM(debt_amount) AS total_debt FROM debts"; // Updated column name
$totalDebtResult = $conn->query($totalDebtQuery);
if (!$totalDebtResult) {
    die("Query failed: " . $conn->error);
}
$totalDebt = $totalDebtResult->fetch_assoc()['total_debt'] ?? 0;

// Fetch pending payments
$pendingPaymentsQuery = "SELECT SUM(debt_amount) AS pending_payments FROM debts WHERE payment_status = 'Unpaid'"; // Updated column name
$pendingPaymentsResult = $conn->query($pendingPaymentsQuery);
if (!$pendingPaymentsResult) {
    die("Query failed: " . $conn->error);
}
$pendingPayments = $pendingPaymentsResult->fetch_assoc()['pending_payments'] ?? 0;

// Fetch total customers
$totalCustomersQuery = "SELECT COUNT(*) AS total_customers FROM customers";
$totalCustomersResult = $conn->query($totalCustomersQuery);
if (!$totalCustomersResult) {
    die("Query failed: " . $conn->error);
}
$totalCustomers = $totalCustomersResult->fetch_assoc()['total_customers'] ?? 0;

// Fetch recent transactions
$recentTransactionsQuery = "SELECT * FROM sales ORDER BY sale_date DESC LIMIT 5";
$recentTransactionsResult = $conn->query($recentTransactionsQuery);
if (!$recentTransactionsResult) {
    die("Query failed: " . $conn->error);
}

// Fetch pending payments details, including payment status
$pendingPaymentsDetailsQuery = "SELECT * FROM debts WHERE payment_status = 'Unpaid' ORDER BY due_date ASC"; 
$pendingPaymentsDetailsResult = $conn->query($pendingPaymentsDetailsQuery);
if (!$pendingPaymentsDetailsResult) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overview</title>
    <link rel="stylesheet" href="styles/overview.css">
</head>
<body>

<div class="container">
    <h1>Dashboard Overview</h1>

    <!-- Key Metrics -->
    <div class="metrics">
        <div class="metric-box">
            <h2>Total Sales</h2>
            <p>Ksh <?= number_format($totalSales, 2) ?></p>
        </div>
        <div class="metric-box">
            <h2>Total Debt</h2>
            <p>Ksh <?= number_format($totalDebt, 2) ?></p>
        </div>
        <div class="metric-box">
            <h2>Pending Payments</h2>
            <p>Ksh <?= number_format($pendingPayments, 2) ?></p>
        </div>
        <div class="metric-box">
            <h2>Total Customers</h2>
            <p><?= $totalCustomers ?></p>
        </div>
    </div>

    <!-- Recent Transactions -->
    <h2>Recent Transactions</h2>
    <table class="recent-transactions">
        <thead>
            <tr>
                <th>Date</th>
                <th>Customer</th>
                <th>Amount</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($transaction = $recentTransactionsResult->fetch_assoc()): ?>
            <tr>
                <td><?= $transaction['sale_date'] ?></td>
                <td><?= $transaction['customer_name'] ?></td>
                <td>Ksh <?= number_format($transaction['total_price'], 2) ?></td>
                <td><?= $transaction['status'] ?? 'N/A' ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <!-- Pending Payments -->
    <h2>Pending Payments</h2>
    <table class="pending-payments">
        <thead>
            <tr>
                <th>Date</th>
                <th>Customer</th>
                <th>Due Amount</th>
                <th>Due Date</th>
                <th>Payment Status</th> <!-- New column for Payment Status -->
            </tr>
        </thead>
        <tbody>
            <?php while ($pendingPayment = $pendingPaymentsDetailsResult->fetch_assoc()): ?>
            <tr>
                <td><?= $pendingPayment['due_date'] ?></td>
                <td><?= $pendingPayment['customer_name'] ?></td>
                <td>Ksh <?= number_format($pendingPayment['debt_amount'], 2) ?></td>
                <td><?= $pendingPayment['due_date'] ?></td>
                <td><?= $pendingPayment['payment_status'] ?></td> <!-- Displaying Payment Status -->
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>

<?php
$conn->close(); // Close the database connection
?>
