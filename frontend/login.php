<?php
$servername = "localhost"; // Change if necessary
$username = "root"; // Default username for XAMPP
$password = ""; // Default password for XAMPP
$dbname = "your_database"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Prevent SQL Injection
    $user = $conn->real_escape_string($user);
    $pass = $conn->real_escape_string($pass);

    // Simple SQL Query to check user credentials
    $sql = "SELECT * FROM users WHERE username='$user' AND password='$pass'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "Login successful!";
        // Redirect or start session as needed
    } else {
        echo "Invalid username or password.";
    }
}

$conn->close();
?>
