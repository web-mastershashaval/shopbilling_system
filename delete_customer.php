<?php
include('db_connect.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $deleteQuery = "DELETE FROM customers WHERE id=?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        header("Location: dashboard.php"); // Redirect after deletion
        exit();
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
