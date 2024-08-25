<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "spotifyplus";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$searchResult = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchTerm = trim($_POST['search']);
    
    if (!empty($searchTerm)) {
        // Prepare the SQL query with a UNION
        $sql = $conn->prepare("
            (SELECT 'songs' AS source, title, artist, image_path, file_path FROM songs WHERE title LIKE ? OR artist LIKE ?)
            UNION
            (SELECT 'popularnasheed' AS source, title, artist, image_path, file_path FROM popularnasheed WHERE title LIKE ? OR artist LIKE ?)
        ");
        $likeSearchTerm = "%" . $searchTerm . "%";
        $sql->bind_param("ssss", $likeSearchTerm, $likeSearchTerm, $likeSearchTerm, $likeSearchTerm);
        $sql->execute();
        $result = $sql->get_result();
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $searchResult .= "<div class='song'>
                                    <img src='" . $row["image_path"] . "' alt='Song Image' class='song-image'>
                                    <div class='song-info'>
                                        <p>Title: " . $row["title"]. "</p>
                                        <p>Artist: " . $row["artist"]. "</p>
                                        <audio controls class='audio-player'>
                                            <source src='" . $row["file_path"] . "' type='audio/mpeg'>
                                            Your browser does not support the audio element.
                                        </audio>
                                    </div>
                                  </div>";
            }
        } else {
            $searchResult = "0 results";
        }
        
        $sql->close();
    } else {
        $searchResult = "Please enter a search term.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/23cecef777.js" crossorigin="anonymous"></script>
    <title>SpotifyPlus Song Search</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            margin-left: 260px; /* Adjust for sidebar width */
        }
        h1 {
            text-align: center;
        }
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 30px ;
            background-color: #083d1c;
            color: #fff;
            margin-top:-15px;
        }
        .top-bar form {
            display: flex;
            align-items: center;
            margin-bottom:0;
        }
        .top-bar input[type="text"] {
            width: 400px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .top-bar input[type="submit"] {
            padding: 10px 20px;
            border: none;
            background: gray;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 10px;
        }
        .top-bar input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .top-bar .prev-next-buttons {
            display: flex;
            align-items: center;
           
        }
        .top-bar .prev-next-buttons button {
            color: white;
            text-decoration: none;
            padding: 15px;
            margin-left:2px;
            background-color: #083d1c;
            border-radius: 4px;
            border: none;
            font-size: 20px;
            cursor: pointer;
            margin-right: 10px;
        }
        .top-bar .prev-next-buttons button:hover {
            background-color: #555;
        }
        .results {
            margin-top: 20px;
            width: 500px;
            margin-left: 30px;
        }
        .song {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            background-color: #fff;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .song-image {
            width: 60px;
            height: 60px;
            margin-right: 20px;
            border-radius: 8px;
        }
        .song-info {
            flex-grow: 1;
        }
        .audio-player {
            width: 100%;
        }
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
            justify-content left;
            margin-bottom: 20px;
        }
        .sidebar .logo img {
            margin-right: 5px;
        }
        .sidebar .logo h3 {
            margin: 0;
            color: #fff;
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
                <a href="search_songs.php">
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
<div class="container">
    <div class="top-bar">
      <div class="prev-next-buttons">
        <button type="button" class="fa fa-chevron-left" onclick="window.history.back();"></button>
        <button type="button" class="fa fa-chevron-right"onclick="window.history.forward();"></button>
      </div>
<!--
<div class="container">
    <div class="top-bar">
        <div class="prev-next-buttons">
            <button type="button" class="fa fa-chevron-left" onclick="window.history.back();"></button>
            <button type="button" class="fa fa-chevron-right" onclick="window.history.forward();"></button>
        </div>-->
        <form method="post" action="">
            <input type="text" name="search" placeholder="Search Naats">
            <input type="submit" value="Search">
        </form>
    </div>
    <div class="results">
        <?php echo $searchResult; ?>
    </div>
</div>

<script>

///

document.addEventListener('DOMContentLoaded', () => {
      const prevButton = document.querySelector('.fa-chevron-left');
      const nextButton = document.querySelector('.fa-chevron-right');

      // Function to navigate to the previous page
      const goToPreviousPage = () => {
       // window.history.back();
       window.location.href = 'index.php';
      };

      // Function to navigate to the next page
      const goToNextPage = () => {
        window.location.href = 'create_playlist.php'; // Replace 'search.html' with the URL of the next page
      };

      // Event listener for previous button click
      prevButton.addEventListener('click', goToPreviousPage);

      // Event listener for next button click
      nextButton.addEventListener('click', goToNextPage);
    });

</script>
</body>
</html>
