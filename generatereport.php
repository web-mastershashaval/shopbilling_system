
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Report</title>
    <link rel="stylesheet" href="styles/generatereport.css">
</head>
<body>

    <div class="container">
        <h1>Generate Report</h1>

        <form action="process_report.php" method="POST" class="report-form">
            <!-- Report Type -->
            <label for="report-type">Report Type</label>
            <select id="report-type" name="report_type" required>
                <option value="sales">Sales Report</option>
                <option value="debt">Debt Report</option>
            </select>

            <!-- Date Range -->
            <label for="start-date">Start Date</label>
            <input type="date" id="start-date" name="start_date" required>

            <label for="end-date">End Date</label>
            <input type="date" id="end-date" name="end_date" required>

            <!-- Report Format -->
            <label for="format">Report Format</label>
            <select id="format" name="format" required>
                <option value="pdf">PDF</option>
                <option value="csv">CSV</option>
            </select>

            <!-- Submit Button -->
            <button type="submit">Generate Report</button>
        </form>
    </div>
</body>
</html>
