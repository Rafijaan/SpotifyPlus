<?php
$servername = "localhost";
$username = "root"; // Default XAMPP username
$password = ""; // Default XAMPP password is empty
$dbname = "spotifyPlus";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
session_destroy();
header("Location: signup.php");
exit();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Logged Out</title>
<style>
/* Styles similar to the sign-up page */
body {
  font-family: Arial, sans-serif;
  background-color: #333;
  color: #ffffff;
}

.container {
  max-width: 400px;
  margin: 50px auto;
  background: #222;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
  text-align: center;
}

h2 {
  margin-bottom: 20px;
}

button {
  width: 100%;
  padding: 10px;
  background-color: #00ff9d;
  color: #ffffff;
  border: none;
  border-radius: 3px;
  cursor: pointer;
  margin-top: 20px;
}

button:hover {
  background-color: #0056b3;
}

.logo-container {
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 20px;
}

.logo-container img {
  margin-right: 10px;
  width: 3%;
}

.logo-container h3 {
  margin: 0;
}
</style>
</head>
<body>

<div class="logo-container">
  <img src="Apple Music Icon34.png" alt="Spotify Icon" text="Spotify+">
  <h3>Spotify+</h3>
</div>

<div class="container">
  <h2>You have been logged out</h2>
  <button onclick="window.location.href='signup.php'">Go to Sign Up</button>
</div>

</body>
</html>
