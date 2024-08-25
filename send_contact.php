<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database connection settings
    $host = 'localhost';  // Your MySQL host
    $db = 'spotifyplus';  // Your database name
    $user = 'root';  // Your MySQL username
    $pass = '';  // Your MySQL password

    // Create a new database connection
    $conn = new mysqli($host, $user, $pass, $db);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize and validate form input
    $name = $conn->real_escape_string(trim($_POST['name']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $phone = $conn->real_escape_string(trim($_POST['phone']));
    $message = $conn->real_escape_string(trim($_POST['message']));

    if (empty($name) || empty($email) || empty($phone) || empty($message)) {
        echo "Please fill in all fields.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Please enter a valid email address.";
        exit;
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO contacts (name, email, phone, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $phone, $message);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Your message has been sent successfully.";
    } else {
        echo "An error occurred. Please try again.";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
