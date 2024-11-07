<?php
include('db_connect.php');

$customersQuery = "SELECT id, name, contact, address, outstanding_debt FROM customers"; // Updated to use 'outstanding_debt'
$customersResult = $conn->query($customersQuery);

if ($customersResult->num_rows > 0) {
    while ($customer = $customersResult->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($customer['name']) . '</td>';
        echo '<td>' . htmlspecialchars($customer['contact']) . '</td>';
        echo '<td>' . htmlspecialchars($customer['address']) . '</td>';
        echo '<td>Ksh ' . number_format($customer['outstanding_debt'], 2) . '</td>'; // Updated to 'outstanding_debt'
        echo '<td>';
        echo '<button onclick="editCustomer(' . $customer['id'] . ', \'' . addslashes($customer['name']) . '\', \'' . addslashes($customer['contact']) . '\', \'' . addslashes($customer['address']) . '\', ' . $customer['outstanding_debt'] . ')">Edit</button>';
        echo ' <a href="delete_customer.php?id=' . $customer['id'] . '" onclick="return confirm(\'Are you sure you want to delete this customer?\')">Delete</a>';
        echo '</td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="5">No customers found</td></tr>';
}

$conn->close();
?>
