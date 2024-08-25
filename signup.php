<?php
$servername = "localhost";
$username = "root"; // Default XAMPP MySQL username
$password = ""; // Default XAMPP MySQL password is empty 
$dbname = "spotifyPlus";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process the form data when submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Server-side validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        echo "Username can only contain letters, numbers, and underscores";
    } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*(),.?":{}|<>]).{8,}$/', $password)) {
        echo "Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, one number, and one special character";
    } else {
        // Check if email already exists
        $checkEmailStmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $checkEmailStmt->bind_param("s", $email);
        $checkEmailStmt->execute();
        $checkEmailStmt->store_result();
        
        if ($checkEmailStmt->num_rows > 0) {
            echo "Email is already registered";
        } else {
            $hashed_password = password_hash($password, PASSWORD_BCRYPT); // Hash the password

            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $hashed_password);

            // Execute the query
            if ($stmt->execute()) {
                header("Location: index.php");
                exit;
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        }

        $checkEmailStmt->close();
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sign Up</title>
<style>
/* Your CSS styles from the HTML code above */
body {
  font-family: Arial, sans-serif;
  background-color: #333;
  color: #ffffff;
}

.container {
  max-width: 400px;
  margin: 50px auto;
  background: #222;
  padding: 30px;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
}

h3 {
  text-align: center;
  margin-bottom: 20px;
}

h2 {
  text-align: center;
  margin-bottom: 20px;
}

.input-group {
  margin-bottom: 15px;
}

.input-group label {
  display: block;
  margin-bottom: 5px;
}

.input-group input {
  width: 100%;
  padding: 10px;
  color:#ffffff;
  border: 1px solid #adaaaa44;
  border-radius: 3px;
  background-color: #444;
}

button {
  width: 100%;
  padding: 10px;
  background-color: #00ff9d;
  color: #ffffff;
  border: none;
  border-radius: 3px;
  cursor: pointer;
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

button:hover {
  background-color: #0056b3;
}

.oauth-options {
  text-align: center;
}

.oauth-options p {
  margin-bottom: 10px;
}

.oauth-options button {
  margin-bottom: 10px;
  color:white;
}

.spotify-icon {
  text-align: center;
  font-size: 15px;
  margin-bottom: 20px;
}

.spotify-icon img {
  width: 30px;
  height: 30px;
  margin-right: 10px;
}

.signin-link {
  text-align: center;
  margin-top: 20px;
  
}
.signin-link a {
    color: #007bff; /* Changed sign-up link color to blue */
    text-decoration: none;
  }
  
  .signin-link a:hover {
    text-decoration: underline;
  }

/* Updated styles for form inputs */
#username,
#email,
#password {
  width: calc(100% - 22px);
}

#password {
  margin-top: 15px;
}

/* Password strength indicator */
.password-strength {
  color: #f7f7f7;
  margin-top: 5px;
  font-size: 12px;
}

/* Password strength classes */
.weak {
  color: red;
}

.medium {
  color: orange;
}

.strong {
  color: green;
}

.logo-container {
  display:flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 20px;
}

.logo-container img {
  margin-right: 10px;
  width:3%;
}

.logo-container h3 {
  margin: 0;
}
</style>
</head>
<body>

<div class="logo-container">
  <img src="Apple Music Icon34.png" alt="Spotify Icon"text="Spotify+">
  <h3>Spotify+</h3>
  </div>

  <div class="spotify-icon">
  <h3> Listen Beautiful naats</h3>
</div>

<div class="container">
  <h2>Sign Up</h2>
  <form id="signup-form" action="signup.php" method="post" onsubmit="return validateForm()">
    <div class="input-group">
      <label for="username">Username</label>
      <input type="text" id="username" name="username" required>
    </div>
    <div class="input-group">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" required>
    </div>
    <div class="input-group">
      <label for="password">Password</label>
      <input type="password" id="password" name="password" required>
      <div class="password-strength" id="password-strength"></div>
    </div>
    <button type="submit">Sign Up</button>
  </form>
  <div class="oauth-options">
    <p>Sign up with</p>
    <button id="google-signup"onclick="loginWithGoogle()">Google</button>
    <br>
    <button id="facebook-signup"onclick="loginWithFaceBook()">Facebook</button>
  </div>
  <div class="signin-link">
    <p>Already have an account?<a href="login.php"> Login</a></p>
  </div>
</div>

<script>
function validateForm() {
  var username = document.getElementById("username").value;
  var email = document.getElementById("email").value;
  var password = document.getElementById("password").value;
  var strengthText = document.getElementById("password-strength");

  var usernamePattern = /^[a-zA-Z0-9_]+$/;
  if (!username.match(usernamePattern)) {
    alert("Username can only contain letters, numbers, and underscores");
    return false;
  }

  var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*(),.?":{}|<>]).{8,}$/;
  if (!password.match(passwordPattern)) {
    alert("Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, one number, and one special character");
    return false;
  }

  return true;
}

// Password strength checker
document.getElementById("password").addEventListener("input", function() {
  var password = this.value;
  var strengthText = document.getElementById("password-strength");
  
  var strength = 0;
  if (password.match(/[a-z]+/)) {
    strength += 1;
  }
  if (password.match(/[A-Z]+/)) {
    strength += 1;
  }
  if (password.match(/[0-9]+/)) {
    strength += 1;
  }
  if (password.match(/[!@#$%^&*(),.?":{}|<>]+/)) {
    strength += 1;
  }
  
  if (password.length >= 8 && strength >= 3) {
    strengthText.textContent = "Strong";
    strengthText.className = "strong";
  } else if (password.length >= 6 && strength >= 2) {
    strengthText.textContent = "Medium";
    strengthText.className = "medium";
  } else {
    strengthText.textContent = "Weak";
    strengthText.className = "weak";
  }
});
function loginWithGoogle() {
    alert("signup with Google...");
  }
  function loginWithFaceBook() {
    alert("signup with FaceBook...");
  }
</script>

</body>
</html>
