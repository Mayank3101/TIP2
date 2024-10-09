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

    // Hash the password before storing
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

    // Check if username already exists
    $checkSql = "SELECT * FROM users WHERE username='$user'";
    $checkResult = $conn->query($checkSql);

    if ($checkResult->num_rows == 0) {
        // Insert new user
        $sql = "INSERT INTO users (username, password) VALUES ('$user', '$hashed_password')";
        if ($conn->query($sql) === TRUE) {
            echo "Signup successful!";
            // Redirect or start session as needed
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Username already exists.";
    }
}

$conn->close();
?>
