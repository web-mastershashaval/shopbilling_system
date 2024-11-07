<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Invoice</title>
    <style>
        .main-content {
            padding: 40px;
            width: calc(100%);
            background-color: #f5f5f5;
        }

        h1 {
            font-size: 32px;
            margin-bottom: 20px;
        }

        .invoice-form {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .invoice-form label {
            display: block;
            margin-bottom: 8px;
            font-size: 16px;
        }

        .invoice-form input, .invoice-form select {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
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

        #add-item-btn, #save-btn, #print-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            margin-right: 10px;
        }

        #add-item-btn:hover, #save-btn:hover, #print-btn:hover {
            background-color: #45a049;
        }

        .summary {
            margin-top: 20px;
        }

        .summary label {
            margin-bottom: 8px;
            font-size: 16px;
        }
    </style>
</head>
<body>

<main class="main-content">
    <h1>Create New Invoice</h1>

    <form class="invoice-form" id="invoice-form" action="save_invoice.php" method="POST">
        <section class="customer-selection">
            <label for="customer">Select Customer</label>
            <select id="customer" name="customer" required>
                <option value="" disabled selected>Select a customer</option>
                <?php
                include('db_connect.php');
                $result = $conn->query("SELECT id, name FROM customers");
                while ($row = $result->fetch_assoc()) {
                    echo "<option value=\"{$row['id']}\">{$row['name']}</option>";
                }
                ?>
            </select>
        </section>

        <section class="items">
            <h2>Purchased Items</h2>
            <table id="item-table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" name="item[]" placeholder="Item name" required></td>
                        <td><input type="number" name="quantity[]" min="1" placeholder="Quantity" required></td>
                        <td><input type="number" name="unit_price[]" min="0" placeholder="Unit price" required></td>
                        <td><input type="number" name="total[]" min="0" placeholder="Total" readonly></td>
                    </tr>
                </tbody>
            </table>
            <button type="button" id="add-item-btn">Add Item</button>
        </section>

        <section class="summary">
            <label for="discount">Discount (%)</label>
            <input type="number" id="discount" name="discount" min="0" max="100" placeholder="0">

            <label for="tax">Tax (%)</label>
            <input type="number" id="tax" name="tax" min="0" max="100" placeholder="0">

            <label for="final-total">Final Total</label>
            <input type="number" id="final-total" name="final_total" readonly>
        </section>

        <button type="submit" id="save-btn">Save Invoice</button>
        
    </form>
</main>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Function to add new item row
        document.getElementById('add-item-btn').addEventListener('click', function () {
            const table = document.getElementById('item-table').getElementsByTagName('tbody')[0];
            const newRow = table.insertRow();
            newRow.innerHTML = `
                <td><input type="text" name="item[]" placeholder="Item name" required></td>
                <td><input type="number" name="quantity[]" min="1" placeholder="Quantity" required></td>
                <td><input type="number" name="unit_price[]" min="0" placeholder="Unit price" required></td>
                <td><input type="number" name="total[]" min="0" placeholder="Total" readonly></td>
            `;

            // Add input event listeners for the new row
            newRow.querySelector('input[name="quantity[]"]').addEventListener('input', calculateFinalTotal);
            newRow.querySelector('input[name="unit_price[]"]').addEventListener('input', calculateFinalTotal);
        });

        // Function to calculate final total
        const calculateFinalTotal = () => {
            let subtotal = 0;
            const rows = document.querySelectorAll('#item-table tbody tr');
            rows.forEach(row => {
                const quantity = row.querySelector('input[name="quantity[]"]').value || 0;
                const unitPrice = row.querySelector('input[name="unit_price[]"]').value || 0;
                const total = quantity * unitPrice;
                row.querySelector('input[name="total[]"]').value = total;
                subtotal += total;
            });

            const discount = document.getElementById('discount').value || 0;
            const tax = document.getElementById('tax').value || 0;

            const discountedAmount = subtotal - (subtotal * discount / 100);
            const finalTotal = discountedAmount + (discountedAmount * tax / 100);
            document.getElementById('final-total').value = finalTotal.toFixed(2);
        };

        // Event listeners for existing inputs
        document.querySelectorAll('input[name="quantity[]"], input[name="unit_price[]"], #discount, #tax').forEach(input => {
            input.addEventListener('input', calculateFinalTotal);
        });

        // Print Invoice functionality (if you need this)
        document.getElementById('print-btn')?.addEventListener('click', function () {
            const printContent = document.querySelector('.main-content').innerHTML;
            const printWindow = window.open('', '', 'height=600,width=800');
            printWindow.document.write('<html><head><title>Print Invoice</title>');
            printWindow.document.write('</head><body>');
            printWindow.document.write(printContent);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });
    });
</script>
</body>
</html>
