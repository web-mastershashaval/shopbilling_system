<?php
include('db_connect.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "SELECT * FROM sales WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $sale = $result->fetch_assoc();
}

// Handle form submission for updating sale
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get updated values from the form
    $customer_name = $_POST['customer_name'];
    $product_name = $_POST['product_name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $total_price = $quantity * $price;
    $sale_date = $_POST['sale_date'];

    $updateQuery = "UPDATE sales SET customer_name=?, product_name=?, quantity=?, price=?, total_price=?, sale_date=? WHERE id=?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("ssdsdsi", $customer_name, $product_name, $quantity, $price, $total_price, $sale_date, $id);
    
    if ($updateStmt->execute()) {
        echo  '<script>window.alert( "Sale updated successfully.")    </script> '   ;
    } else {
        echo "Error updating sale: " . $updateStmt->error;
    }

    $updateStmt->close();
    header("Location: dashboard.php"); 
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Sale</title>
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
    </style>
</head>
<body>
    <h1>Edit Sale</h1>
    <form action="edit_sale.php?id=<?php echo $id; ?>" method="POST">
        <label for="customer-name">Customer Name</label>
        <input type="text" id="customer-name" name="customer_name" value="<?php echo htmlspecialchars($sale['customer_name']); ?>" required>

        <label for="product-name">Product Name</label>
        <input type="text" id="product-name" name="product_name" value="<?php echo htmlspecialchars($sale['product_name']); ?>" required>

        <label for="quantity">Quantity</label>
        <input type="number" id="quantity" name="quantity" value="<?php echo htmlspecialchars($sale['quantity']); ?>" min="1" required>

        <label for="price">Price (per unit)</label>
        <input type="number" id="price" name="price" value="<?php echo htmlspecialchars($sale['price']); ?>" step="0.01" required>

        <label for="total-price">Total Price</label>
        <input type="number" id="total-price" name="total_price" value="<?php echo htmlspecialchars($sale['total_price']); ?>" readonly>

        <label for="sale-date">Date of Sale</label>
        <input type="date" id="sale-date" name="sale_date" value="<?php echo htmlspecialchars($sale['sale_date']); ?>" required>

        <button type="submit">Update Sale</button>
    </form>
</body>
</html>
