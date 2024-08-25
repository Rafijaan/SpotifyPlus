<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root"; // Default XAMPP username
$password = ""; // Default XAMPP password is empty
$dbname = "spotifyPlus";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $inputUsername);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($inputPassword, $user['password'])) {
            $_SESSION['username'] = $inputUsername;
            header("Location: index.php");
            exit;
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "Invalid username.";
    }
}

// Handle logout
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <style>
  body {
    font-family: Arial, sans-serif;
    background-color: #333; /* Background color */
    color: #ffffff; /* Text color */
  }
  
  .container {
    max-width: 400px;
    margin: 50px auto;
    padding: 20px;
    background-color: #222; /* Container background color */
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  
  h2 {
    text-align: center;
    color: #fff; /* Heading color */
  }
  
  .form-group {
    margin-bottom: 20px;
  }
  
  label {
    display: block;
    margin-bottom: 5px;
    color: #ccc; /* Label color */
  }
  
  input[type="text"],
  input[type="password"],
  button {
    width: calc(100% - 20px); /* Width */
    padding: 10px;
    border: 1px solid #666; /* Border color */
    border-radius: 3px;
    background-color: #444; /* Input background color */
    color: #fff; /* Input text color */
    box-sizing: border-box; /* Box sizing */
    margin-bottom: 10px; /* Margin bottom */
  }
  
  button {
    background-color: #00ff9d; /* Button background color */
    cursor: pointer;
    
  }
  
  button:hover {
    background-color: #0056b3; /* Button hover color */
  }
  
  /* Change sign-up link color */
button a {
  color: inherit; /* Inherit color from button */
  text-decoration: none;
  display: block;
}

button a:hover {
  text-decoration: none;
}

  #error-message {
    color: red; /* Error message color */
    text-align: center;
    margin-top: 10px;
  }

  .signup {
    text-align: center;
    margin-top: 10px;
  }

  .signup a {
    color: #007bff; /* Sign-up link color */
    text-decoration: none;
  }
  
  .signup a:hover {
    text-decoration: underline;
  }
  </style>
</head>
<body>
  <div class="container">
    <?php if (!isset($_SESSION['username'])): ?>
    <h2>Login</h2>
    <form id="loginForm" method="POST" action="index.php" onsubmit="return validateForm()">
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
      </div>
      <button type="submit" name="login">Login</button>
    </form>
    
    <p id="error-message"><?php if(isset($error)) echo $error; ?></p>
    
    <button class="google-btn" onclick="loginWithGoogle()">Login with Google</button>

    <div class="signup">
      <p>Don't have an account? <a href="signup.php">Sign up</a></p>
    </div>
    <?php else: ?>
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    <form method="POST" action="index.php">
      <button type="submit" name="logout">Logout</button>
    </form>
    <?php endif; ?>
  </div>

  <script>
  function loginWithGoogle() {
    alert("Logging in with Google...");
  }
  
  function validateForm() {
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    var errorMessage = document.getElementById('error-message');
  
    errorMessage.innerText = '';
  
    if (username.trim() === '' || password.trim() === '') {
      errorMessage.innerText = 'Username and password are required';
      return false;
    }
  
    if (username.length < 5) {
      errorMessage.innerText = 'Username must be at least 5 characters long';
      return false;
    }
  
    if (password.length < 8) {
      errorMessage.innerText = 'Password must be at least 8 characters long';
      return false;
    }
  
    var passwordRegex = /^(?=.*[!@#$%^&*(),.?":{}|<>])(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
    if (!passwordRegex.test(password)) {
      errorMessage.innerText = 'Password must contain at least one special character, one uppercase letter, one lowercase letter, and one numeric digit';
      return false;
    }
  
    return true;
  }
  </script>
</body>
</html>
