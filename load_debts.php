<?php
// load_debts.php
include('db_connect.php');

$sql = "SELECT * FROM debts";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data for each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['customer_name']}</td>
                <td>{$row['debt_amount']}</td>
                <td>{$row['due_date']}</td>
                <td>{$row['payment_status']}</td>
                <td>{$row['payment_date']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No debts found</td></tr>";
}

$conn->close();
?>
