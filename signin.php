<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="">
    <title>Sign In</title>
    <style>
        /* General Styles */
        body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
        }

        .main {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        section {
            background-color: white;
            padding: 40px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 350px;
            text-align: center;
        }

        h2 {
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 24px;
        }

        /* Form Styles */
        form {
            display: flex;
            flex-direction: column;
            align-items: stretch;
        }

        label {
            margin-bottom: 8px;
            color: #34495e;
            font-weight: bold;
            text-align: left;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #bdc3c7;
            border-radius: 5px;
            font-size: 16px;
        }

        input:focus {
            border-color: #3498db;
            outline: none;
        }

        /* Button Styles */
        button {
            width: 100%;
            padding: 10px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 10px;
        }

        button:hover {
            background-color: #2980b9;
        }

        /* Error Message */
        #error-message {
            margin-top: 10px;
            font-size: 14px;
            color: red;
            display: none; /* Hide by default */
        }

        /* Forgot Password Link */
        .forgot-password {
            margin-top: 15px;
            text-align: right;
        }

        .forgot-password a {
            color: #3498db;
            text-decoration: none;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 400px) {
            section {
                width: 100%;
                padding: 20px;
            }

            h2 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="main">
        <section>
            <h2>Login</h2>
            <form id="signinForm" action="signin_hundler.php"   method="POST" onsubmit="return validateForm()">  
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Sign In</button>
            </form>
            <p class="forgot-password">
                <a href="forgotpassword.php">Forgot Password?</a> <br>
                <a href="signup.php"> signup</a>
            </p>
            <p id="error-message"></p>
        </section>
    </div>

    <script>
        function validateForm() {
            const email = document.getElementById("email").value;
            const password = document.getElementById("password").value;
            const errorMessage = document.getElementById("error-message");

            errorMessage.style.display = "none"; // Hide previous error message

            if (!email || !password) {
                errorMessage.textContent = "Please fill in all fields.";
                errorMessage.style.display = "block";
                return false;
            }

            // Add additional validation logic here if needed

            return true; // Submit the form
        }
    </script>
</body>
</html>
