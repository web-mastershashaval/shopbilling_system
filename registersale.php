<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Management</title>
    <style>
        /* General styles */
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
        }

        /* Button styles */
        .scroll-button {
            display: block;
            padding: 10px 20px;
            margin: 20px 0;
            background-color: #3498db;
            color: white;
            text-align: center;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .scroll-button:hover {
            background-color: #2980b9;
        }

        /* Form and table styles */
        .sale-form {
            margin-bottom: 30px;
        }
        label {
            display: block;
            margin-top: 15px;
        }
        input[type="text"], input[type="number"], input[type="date"], input[type="file"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button.submit {
            margin-top: 20px;
            padding: 10px;
            background-color: #2ecc71;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        button.submit:hover {
            background-color: #27ae60;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            max-width: 100px; /* Resize image */
            max-height: 100px; /* Maintain aspect ratio */
            object-fit: cover; /* Crop if needed */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Sales Management</h1>

        <!-- Scroll Button to Register Sale -->
        <a href="#register-sale" class="scroll-button">Register Sale</a>

        <!-- Current Registered Sales -->
        <h2>Current Registered Sales</h2>
        <table>
            <thead>
                <tr>
                    <th>Customer Name</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total Price</th>
                    <th>Date</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="sales-table-body">
                <?php 
                include 'load_sale.php'; 
                ?>
            </tbody>
        </table>

        <!-- Register Sale Form -->
        <form action="process_sale.php" method="POST" class="sale-form" id="register-sale" enctype="multipart/form-data">
            <h2>Register Sale</h2>
            <label for="customer-name">Customer Name</label>
            <input type="text" id="customer-name" name="customer_name" required>

            <label for="product-name">Product Name</label>
            <input type="text" id="product-name" name="product_name" required>

            <label for="quantity">Quantity</label>
            <input type="number" id="quantity" name="quantity" min="1" required>

            <label for="price">Price (per unit)</label>
            <input type="number" id="price" name="price" step="0.01" required>

            <label for="item-image">Item Image</label>
            <input type="file" id="item-image" name="item_image" accept="image/*" required>

            <label for="total-price">Total Price</label>
            <input type="number" id="total-price" name="total_price" readonly>

            <label for="sale-date">Date of Sale</label>
            <input type="date" id="sale-date" name="sale_date" required>

            <button type="submit" class="submit">Register Sale</button>
        </form>
    </div>

    <script>
        // Calculate total price based on quantity and price per unit
        const quantityInput = document.getElementById('quantity');
        const priceInput = document.getElementById('price');
        const totalPriceInput = document.getElementById('total-price');

        function calculateTotalPrice() {
            const quantity = parseFloat(quantityInput.value) || 0;
            const price = parseFloat(priceInput.value) || 0;
            const total = quantity * price;
            totalPriceInput.value = total.toFixed(2);
        }

        quantityInput.addEventListener('input', calculateTotalPrice);
        priceInput.addEventListener('input', calculateTotalPrice);
    </script>
</body>
</html>
