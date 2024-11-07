<?php
// Include database connection
include('db_connect.php');

// Fetch sales data
$salesQuery = "SELECT * FROM sales";
$salesResult = $conn->query($salesQuery);

if ($salesResult->num_rows > 0) {
    while ($sale = $salesResult->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($sale['customer_name']) . '</td>';
        echo '<td>' . htmlspecialchars($sale['product_name']) . '</td>';
        echo '<td>' . htmlspecialchars($sale['quantity']) . '</td>';
        echo '<td>Ksh ' . number_format($sale['price'], 2) . '</td>';
        echo '<td>Ksh ' . number_format($sale['total_price'], 2) . '</td>';
        echo '<td>' . htmlspecialchars($sale['sale_date']) . '</td>';
        
        // Use 'image_url' to display the image
        if (isset($sale['image_url']) && !empty($sale['image_url'])) {
            $imageUrl = htmlspecialchars($sale['image_url']);
            echo '<td>';
            echo '<img src="' . $imageUrl . '" alt="Item Image" style="width: 100px; height: auto;">';
            echo '</td>';
        } else {
            echo '<td>No image available</td>';
        }

        echo '<td>';
        echo '<a href="edit_sale.php?id=' . $sale['id'] . '">Edit</a> | ';
        echo '<a href="delete_sale.php?id=' . $sale['id'] . '" onclick="return confirm(\'Are you sure you want to delete this sale?\')">Delete</a>';
        echo '</td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="8">No sales found</td></tr>';
}

$conn->close();
?>
