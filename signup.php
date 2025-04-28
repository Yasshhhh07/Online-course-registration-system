<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "course");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle POST request when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Encrypt the password

    // Prepare SQL query to insert data into the users table
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ss", $username, $password); // Bind parameters
        if ($stmt->execute()) {
            // Success
            echo "<script>alert('Signup successful!'); window.location.href='login.html';</script>";
        } else {
            // Error during insert
            echo "<script>alert('Error inserting user: " . $stmt->error . "'); window.history.back();</script>";
        }
    } else {
        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
    }
    $stmt->close();
}

$conn->close();
?>
