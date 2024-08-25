<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "spotifyplus";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['playlist-name']);
    $description = $conn->real_escape_string($_POST['playlist-description']);

    $image = null;
    if (isset($_FILES['playlist-image']) && $_FILES['playlist-image']['size'] > 0) {
        $image = file_get_contents($_FILES['playlist-image']['tmp_name']);
    }

    $stmt = $conn->prepare("INSERT INTO playlists (name, description, image) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $description, $image);

    if ($stmt->execute()) {
        header('Location: Your_Playlist.php');
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Spotify+</title>

  <link rel="stylesheet" href="style.css">
  <script src="https://kit.fontawesome.com/23cecef777.js" crossorigin="anonymous"></script>
  <style>
    /* Your existing CSS styles */
    .sidebar {
      width: 240px;
      background-color: #000;
      padding: 20px;
      position: fixed;
      height: 100%;
      overflow-y: auto;
    }

    .sidebar .logo img {
      width: 50px;
      height: 50px;
    }

    .sidebar .logo {
      display: flex;
      align-items: center;
      justify-content: left;
      margin-bottom: 20px;
    }

    .sidebar .logo img {
      margin-right: 5px; /* Reduced space */
    }

    .sidebar .logo h3 {
      margin: 0;
      color: #fff; /* Same color as the button */
    }

    .navigation ul, .policies ul {
      list-style: none;
      padding: 0;
    }

    .navigation ul li, .policies ul li {
      margin: 20px 0;
    }

    .navigation ul li a, .policies ul li a {
      color: #b3b3b3;
      text-decoration: none;
      display: flex;
      align-items: center;
    }

    .navigation ul li a span, .policies ul li a span {
      margin-right: 10px;
    }

    .create-playlist {
      background-color: #282828;
      padding: 20px;
      border-radius: 8px;
      max-width: 600px;
      margin: auto;
      margin-top: 50px;
    }

    .create-playlist h2 {
      margin-top: 0;
      text-align: center;
      color: #ffffff;
    }

    .create-playlist .form-group {
      margin-bottom: 15px;
    }

    .create-playlist label {
      display: block;
      margin-bottom: 5px;
      color: #ffffff;
    }

    .create-playlist input[type="text"],
    .create-playlist textarea {
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 4px;
      background-color: #404040;
      color: #ffffff;
    }

    .create-playlist input[type="file"] {
      display: none;
    }

    .create-playlist .custom-file-upload {
      display: inline-block;
      padding: 10px 20px;
      cursor: pointer;
      border: 1px solid #ffffff;
      border-radius: 4px;
    }

    .create-playlist button[type="submit"] {
      background-color: #1db954;
      color: #ffffff;
      font-size: 14px;
      font-weight: bold;
      padding: 14px 30px;
      border: none;
      border-radius: 40px;
      cursor: pointer;
      margin-left: 50%;
      transform: translateX(-50%);
      display: block;
    }

    .main-container {
      margin-left: 260px;
      padding: 5px;
    }

    .topbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 14px 30px ;
      background-color: #083d1c;
      color: #fff;
    }

    .topbar .prev-next-buttons button {
      background: none;
      border: none;
      color: #fff;
      cursor: pointer;
      font-size: 20px;
    }

    .navbar ul {
      list-style: none;
      display: flex;
      padding: 0;
    }

    .navbar ul li {
      margin: 0 10px;
    }

    .navbar ul li a {
      color: #b3b3b3;
      text-decoration: none;
    }

    .navbar ul li.divider {
      color: #fff;
    }

    .navbar button {
      background-color: #1db954;
      border: none;
      color: #fff;
      padding: 10px 30px;
      border-radius: 20px;
      cursor: pointer;
    }

    .navbar button a {
      color: #0e0d0d;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="sidebar">
    <div class="logo">
      <a href="#">
        <img src="Apple Music Icon34.png" alt="Logo" />
      </a>
      <h3>Spotify+</h3>
    </div>
    <div class="navigation">
      <ul>
        <li>
          <a href="index.php">
            <span class="fa fa-home"></span>
            <span>Home</span>
          </a>
        </li>
        <li>
          <a href="search.php">
            <span class="fa fa-search"></span>
            <span>Search</span>
          </a>
        </li>
        <!--<li>
          <a href="library.php">
            <span class="fa fa-book"></span>
            <span>Your Library</span>
          </a>
        </li>-->
      </ul>
    </div>
    <div class="navigation">
      <ul>
        <li>
          <a href="create_playlist.php">
            <span class="fa fa-plus-square"></span>
            <span>Create Playlist</span>
          </a>
        </li>
        <li>
          <a href="Your_Playlist.php">
            <span class="fa fa-heart"></span>
            <span>Your Playlist</span>
          </a>
        </li>
        
      </ul>
    </div>
    <div class="policies">
      <ul>
        <li>
          <a href="about.php">About</a>
        </li>
        <li>
          <a href="privacy.php">Privacy</a>
        </li>
      </ul>
    </div>
  </div>
  <div class="main-container">
    <div class="topbar">
      <div class="prev-next-buttons">
        <button type="button" class="fa fa-chevron-left"></button>
        <button type="button" class="fa fa-chevron-right"></button>
      </div>
      <div class="navbar">
        <ul>
          <li>
            <a href="index.php">Playlist</a>
          </li>
          <li class="divider">|</li>
          <li>
            <a href="signup.php">Sign Up</a>
          </li>
        </ul>
         <!--<button type="button"><a href="profiile.php">logout</a></button>-->
      </div>
    </div>
    <div class="create-playlist">
      <h2>Create Playlist</h2>
      <form id="playlist-form" action="create_playlist.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="playlist-name">Name:</label>
          <input type="text" id="playlist-name" name="playlist-name" required>
        </div>
        <div class="form-group">
          <label for="playlist-description">Description:</label>
          <textarea id="playlist-description" name="playlist-description"></textarea>
        </div>
        <div class="form-group">
          <label for="playlist-image" class="custom-file-upload">
            Choose Image
            <input type="file" id="playlist-image" name="playlist-image">
          </label>
        </div>
        <button type="submit">Create Playlist</button>
      </form>
    </div>
  </div>
  <script>
    document.getElementById('playlist-form').addEventListener('submit', function(event) {
      const name = document.getElementById('playlist-name').value;
      const description = document.getElementById('playlist-description').value;
      const imageFile = document.getElementById('playlist-image').files[0];

      if (!name || (imageFile && imageFile.size > 5000000)) { // limit image size to 5MB
        event.preventDefault();
        alert('Please provide a name and ensure the image size is less than 5MB.');
        return;
      }

      const reader = new FileReader();
      reader.onload = function() {
        try {
          let playlists = JSON.parse(localStorage.getItem('playlists')) || [];
          let image = null;

          if (imageFile && reader.result.length <= 5000000) { // limit image size to 5MB
            image = reader.result;
          }

          playlists.push({ name, description, image });

          localStorage.setItem('playlists', JSON.stringify(playlists));
          alert('Playlist created successfully!');
          document.getElementById('playlist-form').reset(); // Clear form fields
          window.location.href = 'Your_Playlist.php'; // Redirect to the playlists page
        } catch (e) {
          console.error('Failed to save playlist: ', e);
          alert('Failed to save playlist. Storage quota exceeded.');
        }
      };

      if (imageFile) {
        reader.readAsDataURL(imageFile);
      } else {
        reader.onload();  // Call directly if no image
      }
    });

    document.addEventListener('DOMContentLoaded', () => {
      const prevButton = document.querySelector('.fa-chevron-left');
      const nextButton = document.querySelector('.fa-chevron-right');

      const goToPreviousPage = () => {
        window.history.back();
      };

      const goToNextPage = () => {
        window.location.href = "Your_Playlist.php";
      };

      prevButton.addEventListener('click', goToPreviousPage);
      nextButton.addEventListener('click', goToNextPage);
    });
  </script>
</body>
</html>
