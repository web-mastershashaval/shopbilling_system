<?php
include('db_connect.php'); // Make sure this file connects to your database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reportType = $_POST['report_type'];
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    $format = $_POST['format'];

    // Query to get data based on the report type
    if ($reportType === 'sales') {
        $query = "SELECT * FROM sales WHERE sale_date BETWEEN ? AND ?";
    } elseif ($reportType === 'debt') {
        $query = "SELECT * FROM debts WHERE due_date BETWEEN ? AND ?";
    } else {
        die("Invalid report type");
    }

    $stmt = $conn->prepare($query);
    $stmt->bind_param('ss', $startDate, $endDate);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check the format and generate report accordingly
    if ($format === 'pdf') {
        generatePDFReport($result);
    } elseif ($format === 'csv') {
        generateCSVReport($result);
    } else {
        die("Invalid format");
    }
}

// Function to generate PDF report (you may use libraries like TCPDF or FPDF)
function generatePDFReport($result) {
    // Here, implement your logic to generate a PDF
    // You would typically loop through the $result and build the PDF content
    echo "PDF report generated!";
}

// Function to generate CSV report
function generateCSVReport($result) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="report.csv"');

    $output = fopen('php://output', 'w');

    // Header row
    fputcsv($output, ['Column1', 'Column2', 'Column3']); // Adjust based on your columns

    // Data rows
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }

    fclose($output);
    exit();
}

$conn->close();
?>
