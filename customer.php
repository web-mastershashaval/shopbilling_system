<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Management</title>
    <style>

        h1, h2 {
            color: #333;
            text-align: center;
        }

        .customer-list, .customer-form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
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
            margin-bottom: 8px;
            font-size: 16px;
        }

        input[type="text"], input[type="tel"], input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }

        input:focus {
            border-color: #3498db;
            outline: none;
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <!-- View all customers -->
    <section class="customer-list" id="customer-list">
        <h2>Current Customers</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Outstanding Debt</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php include 'load_customers.php'; ?>
            </tbody>
        </table>
    </section>

    <!-- Add/Edit customer details -->
    <section class="customer-form">
        <h2>Add/Edit Customer</h2>
        <form method="POST" action="process_customer.php">
            <input type="hidden" id="customer-id" name="customer_id" value="">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required>

            <label for="contact">Contact</label>
            <input type="tel" id="contact" name="contact" required>

            <label for="address">Address</label>
            <input type="text" id="address" name="address" required>

            <label for="debt">Outstanding Debt</label>
            <input type="number" id="debt" name="debt" required>

            <button type="submit">Save Customer</button>
        </form>
    </section>

    <script>
        function editCustomer(id, name, contact, address, debt) {
            console.log("Edit customer called with:", id, name, contact, address, debt); // Debug log
            document.getElementById('customer-id').value = id;
            document.getElementById('name').value = name;
            document.getElementById('contact').value = contact;
            document.getElementById('address').value = address;
            document.getElementById('debt').value = debt;
        }
    </script>

</body>
</html>
