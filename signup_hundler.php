<?php
include_once('db_connect.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = 'user'; // Default role

    // Simple validation
    if (empty($name) || empty($contact) || empty($email) || empty($password)) {
        echo "All fields are required!";
    } else {
        // Hash the password before storing it
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare the SQL query
        $sql = "INSERT INTO users (name, contact, email, password, role) VALUES ('$name', '$contact', '$email', '$hashed_password', '$role')";

        // Execute the query
        if ($conn->query($sql) === TRUE) {
            echo '<script> alert("New record created successfully") </script> ';
            header("Location: signin.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            header("Location: signup.php");
        }
    }
}

// Close connection
$conn->close();
?>
