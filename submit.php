<?php
// Connect to the MySQL database
$conn = new mysqli("localhost", "root", "", "course");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and get form data
    $first_name = trim($_POST["first_name"]);
    $last_name = trim($_POST["last_name"]);
    $email = trim($_POST["email"]);
    $course_spec = trim($_POST["course_spec"]);

    // Prepare the SQL statement securely
    $stmt = $conn->prepare("INSERT INTO registration (first_name, last_name, email, course_spec) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $first_name, $last_name, $email, $course_spec);

    // Execute and give feedback
    if ($stmt->execute()) {
        echo "<script>alert('Registration successful!'); window.location.href='sample4.html';</script>";
    } else {
        echo "<script>alert('Error while registering. Please try again.'); window.history.back();</script>";
    }

    // Close connections
    $stmt->close();
    $conn->close();
}
?>
