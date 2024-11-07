<?php
include('db_connect.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $deleteQuery = "DELETE FROM sales WHERE id = ?";
    
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "Sale deleted successfully.";
    } else {
        echo "Error deleting sale: " . $stmt->error;
    }
    
    $stmt->close();
}

$conn->close();

// Redirect back to the sales page
header("Location: registersale.php"); // Change's back to registerd sales page
exit;
?>
