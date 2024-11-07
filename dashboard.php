<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles/dashboard.css">
</head>
<body>
    <div class="dashboard">
        <nav class="sidebar">
            <ul>
                <li><a href="home.php" class="sidebar-link" data-target="overview.php">Dashboard</a></li>
                <li><a href="registersale.php" class="sidebar-link" data-target="registersale.php">Register Sales</a></li>
                <li><a href="managedept.php" class="sidebar-link" data-target="managedebt.php">Manage Debts</a></li>
                <li><a href="customer.php" class="sidebar-link" data-target="customer.php">Manage Customer</a></li>
                <li><a href="billing.php" class="sidebar-link" data-target="billing.php">Billing Reports</a></li>
                <li><a href="view_invoices.php" class="sidebar-link" data-target="view_invoices.php">Invoices</a></li>
                <li><a href="generatereport.php" class="sidebar-link" data-target="generatereport.php">Generate Reports</a></li>
                <li><a href="#" class="sidebar-link" id="logout-btn" onclick="confirmLogout(event)">Log out</a></li>
            </ul>
        </nav>

        <div class="main-content">
            <header class="header">
                <h1>Dashboard</h1>
                <div class="user-info">
                    <strong>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?></strong>
                </div>
            </header>

            <section class="content" id="content-area">
                <div class="spinner" id="spinner"></div>
                <span><h2>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h2></span>
                <p>Select a section from the sidebar to begin.</p>
            </section>
        </div>
    </div>

    <script>
        function confirmLogout(event) {
        event.preventDefault(); // Prevent the default action
        const confirmation = confirm("Are you sure you want to log out?");
        if (confirmation) {
            window.location.href = 'logout.php'; // Redirect to logout.php if confirmed
        }
    }
        const links = document.querySelectorAll('.sidebar-link');
        const contentArea = document.getElementById('content-area');
        const spinner = document.getElementById('spinner');

        links.forEach(link => {
            link.addEventListener('click', function(event) {
                if (this.getAttribute('href') === 'logout.php') return; // Prevent loading if logout

                event.preventDefault();
                const targetPage = this.getAttribute('data-target');
                spinner.style.display = 'block';

                fetch(targetPage)
                    .then(response => {
                        if (!response.ok) throw new Error('Network response was not ok');
                        return response.text();
                    })
                    .then(data => {
                        contentArea.innerHTML = data;
                    })
                    .catch(error => {
                        console.error('Error loading page:', error);
                        contentArea.innerHTML = '<p>Error loading content.</p>';
                    })
                    .finally(() => {
                        spinner.style.display = 'none';
                    });
            });
        });

        function printInvoice(invoiceId) {
            console.log("printInvoice function called with ID:", invoiceId); // Debug log
            const printWindow = window.open(`print_invoices.php?id=${invoiceId}`, '', 'height=600,width=800');
            printWindow.onload = function() {
                printWindow.print();
            };
        }

        function editCustomer(id, name, contact, address, debt) {
            document.getElementById('customer-id').value = id;
            document.getElementById('name').value = name;
            document.getElementById('contact').value = contact;
            document.getElementById('address').value = address;
            document.getElementById('debt').value = debt;
        }
        

    </script>
</body>
</html>
