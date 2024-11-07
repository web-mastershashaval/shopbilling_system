<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Debt</title>
    <link rel="stylesheet" href="managedebt.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px; /* Space between containers */
        }
        h1, h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: left;
            transition: background-color 0.3s;
        }
        th {
            background-color: #3498db;
            color: white;
        }
        tr:hover {
            background-color: #f2f2f2;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }
        input[type="text"], input[type="number"], input[type="date"], select {
            width: calc(100% - 20px);
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            transition: border-color 0.3s;
        }
        input:focus, select:focus {
            border-color: #3498db;
            outline: none;
        }
        button {
            margin-top: 20px;
            padding: 10px;
            background-color: #2ecc71;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #27ae60;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Manage Debt</h1>
    <h2>Current Customer Debts</h2>
    <table>
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Debt Amount</th>
                <th>Due Date</th>
                <th>Payment Status</th>
                <th>Payment Date</th>
            </tr>
        </thead>
        <tbody id="debt-table-body">
            <?php include 'load_debts.php'; ?>
        </tbody>
    </table>
</div>

<div class="container">
    <h2>Add New Debt</h2>
    <form action="process_debt.php" method="POST" class="debt-form" id="debt-form">
        <label for="customer-name">Customer Name</label>
        <input type="text" id="customer-name" name="customer_name" placeholder="Enter customer's name" required>

        <label for="debt-amount">Debt Amount</label>
        <input type="number" id="debt-amount" name="debt_amount" step="0.01" placeholder="Enter debt amount" required>

        <label for="due-date">Due Date</label>
        <input type="date" id="due-date" name="due_date" required>

        <label for="payment-status">Payment Status</label>
        <select id="payment-status" name="payment_status" required>
            <option value="Unpaid">Unpaid</option>
            <option value="Partially Paid">Partially Paid</option>
            <option value="Paid">Paid</option>
        </select>

        <label for="payment-date">Payment Date</label>
        <input type="date" id="payment-date" name="payment_date">

        <button type="submit">Save Debt</button>
    </form>
</div>

</body>
</html>
