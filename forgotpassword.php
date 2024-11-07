<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
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
    align-items: flex-start;
}

label {
    margin-bottom: 8px;
    color: #34495e;
    font-weight: bold;
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
}

button:hover {
    background-color: #2980b9;
}

/* Error Message */
#error-message {
    margin-top: 10px;
    font-size: 14px;
    color: red;
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
            <h2>forgot password</h2>
            <form id="forgot password" onsubmit="return validateForm()">  
                <label for="email">Email:</label>
                <input type="text" id="email" name="email"><br><br>

                <label for="password">New password:</label>
                <input type="text" id="password" name="password"><br>

                <label for="password">Confirm password:</label>
                <input type="text" id="password" name="password"><br>

                <button type="submit">Get password </button>
            </form>
            <p id="error-message" style="color: red;"></p>
        </section>
     </div>
</body>