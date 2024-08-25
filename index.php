<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "spotifyPlus";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch song data
$sql = "SELECT * FROM songs";
$result = $conn->query($sql);

$songs = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $songs[] = $row;
    }
} else {
    echo "0 results";
}

// Fetch nasheed data
$nasheed_sql = "SELECT * FROM popularnasheed"; // Adjust table name as needed
$nasheed_result = $conn->query($nasheed_sql);

$nasheeds = [];
if ($nasheed_result->num_rows > 0) {
    while($row = $nasheed_result->fetch_assoc()) {
        $nasheeds[] = $row;
    }
} else {
    echo "0 results";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Spotify+</title>
  <script src="https://kit.fontawesome.com/23cecef777.js" crossorigin="anonymous"></script>
   <style>
    body {
      display: flex;
      flex-direction: column;
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #121212;
      color: #ffffff;
      height: 100vh;
      overflow: hidden;
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
            justify-content: left;
            margin-bottom: 20px;
        }

        .sidebar .logo img {
            margin-right: 5px;
        }

        .sidebar .logo h3 {
            margin: 0;
            color: #ffff;
        }

        .sidebar .navigation ul, .sidebar .policies ul {
            list-style: none;
            padding: 0;
        }

        .sidebar .navigation ul li, .sidebar .policies ul li {
            margin: 20px 0;
        }

        .sidebar .navigation ul li a, .sidebar .policies ul li a {
            color: #b3b3b3;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .sidebar .navigation ul li a span {
            margin-right: 10px;
        }

    .main-container {
      margin-left: 240px;
      padding: 5px;
      flex-grow: 1;
      overflow-y: auto;
    }

    .topbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .topbar .prev-next-buttons button{
     margin-left: 10px;
    }
    
    .topbar .prev-next-buttons button, .topbar .navbar ul li a, .topbar button {
      background: none;
      border: none;
      color: #ffffff;
      cursor: pointer;
      
    }

    .topbar .navbar ul {
      display: flex;
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .topbar .navbar ul li {
      margin-right: 20px;
    }

    .topbar .navbar ul li.divider {
      margin-right: 0;
      margin-left: 10px;
    }

    .topbar .navbar button a {
      color: #070707;
      text-decoration: none;
    }

    .spotify-playlists {
      margin-top: 20px;
    }

    .spotify-playlists h2 {
      margin-bottom: 20px;
    }

    .list {
      display: flex;
      flex-wrap: wrap;
    }

    .list .item {
      width: 180px;
      margin-right: 20px;
      margin-bottom: 20px;
      position: relative;
      cursor: pointer;
    }

    .list .item img {
      width: 100%;
      border-radius: 8px;
    }

    .list .item .play {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background: rgba(0, 0, 0, 0.7);
      padding: 10px;
      border-radius: 50%;
      display: none;
    }

    .list .item:hover .play {
      display: block;
    }

    .preview {
      margin-top: 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: #282828;
      padding: 20px;
      border-radius: 8px;
    }

    .preview .text h6 {
      margin: 0 0 10px;
    }

    .preview .button button {
      background-color: #1db954;
      border: none;
      padding: 10px 20px;
      color: #ffffff;
      cursor: pointer;
      border-radius: 8px;
    }

    .player {
      position: fixed;
      bottom: 0;
      width: 100%;
      background: #181818;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 20px;
      box-sizing: border-box;
    }

    .player .song-info {
      display: flex;
      align-items: center;
    }

    .player .song-info img {
      width: 50px;
      height: 50px;
      border-radius: 4px;
      margin-right: 10px;
    }

    .player .controls {
      display: flex;
      align-items: center;
    }

    .player .controls button {
      background: none;
      border: none;
      color: #ffffff;
      font-size: 18px;
      margin: 0 10px;
      cursor: pointer;
      background-color: #121212;
    }

    .player .controls .seek-bar {
      width: 200px;
      margin-left: 10px;
    }

    .player .volume {
      display: flex;
      align-items: center;
      color: white;
    }

    .player .volume-button {
      background-color:white-gray;
    }

    .player .volume .volume-bar {
      width: 100px;
      margin-left: 10px;
    }

  </style>
</head>
<body>
  <div class="sidebar">
    <div class="logo">
      <a >
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
          <a href="Search.php">
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
       <!-- <li>
          <a href="liked Naats.html">
            <span class="fa fa-heart"></span>
            <span>Liked Naats</span>
          </a>
        </li>
      </ul>-->
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
            <a href="C:\Users\abid\Desktop\spotify+\index.php">playlist</a>
          </li>
          <li class="divider">|</li>
          <li>
            <a href="logout.php">logout</a>
          </li>
        </ul>
        <!--<button type="button"><a href="profiile.php">logout</a></button>-->
      </div>
    </div>
    <div class="spotify-playlists">
      <h2>Spotify+ Playlists</h2><br>
      <div class="list">
        <?php foreach ($songs as $song): ?>
                <div class="item" data-song-path="<?php echo $song['file_path']; ?>">
                    <img src="<?php echo $song['image_path']; ?>" alt="<?php echo $song['title']; ?>" />
                    <div class="play">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4><?php echo $song['title']; ?></h4>
                    <p><?php echo $song['artist']; ?></p>
                </div>
                <?php endforeach; ?>
        <!---Example item -->
        
         <!--More items... -->
      </div>
    </div>
    <hr>
    

    <div class="spotify-playlists">
      <h2>Popular Nasheeds</h2><br><br>
      <div class="list">
              <?php foreach ($nasheeds as $nasheed): ?>
                <div class="item" data-song-path="<?php echo $nasheed['file_path']; ?>">
                    <img src="<?php echo $nasheed['image_path']; ?>" alt="<?php echo $nasheed['title']; ?>" />
                    <div class="play">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4><?php echo $nasheed['title']; ?></h4>
                    <p><?php echo $nasheed['artist']; ?></p>
                    </div>
                <?php endforeach; ?>
        <!-- Example item -->
       
        <!--more example-->
      </div>
      <hr>
    </div>
  </div>
  
  <div class="player"data-song-path="C:\Users\abid\Desktop\UML\Allah-Allah-Arabic-Nasheed.mp3">
    <div class="song-info">
      <img src="http://localhost/spotifyPlus/naat/1721189713553.jpg">
      <div class="details">
        <h4>Title</h4>
        <p>Artist Name</p>
      </div>
    </div>
  
    <div class="controls">
      <button class="fa fa-step-backward"></button>
      <button class="fa fa-play player-play-button"></button>
      <button class="fa fa-step-forward"></button>
      <input type="range" class="seek-bar" value="0">
      <span class="current-time">0:00</span> / <span class="duration">0:00</span>
    </div>
    <div class="volume">
      <button class="fa fa-volume-up volume-button"></button>
      <input type="range" class="volume-bar" value="100">
      <span class="volume-level">100%</span>
    </div>
  </div>

  <audio id="audio-player"></audio>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const playButtons = document.querySelectorAll('.play');
      const audioPlayer = document.getElementById('audio-player');
      const playerPlayButton = document.querySelector('.player-play-button');
      const playerPrevButton = document.querySelector('.player .fa-step-backward');
      const playerNextButton = document.querySelector('.player .fa-step-forward');
      const volumeButton = document.querySelector('.volume-button');
      const volumeBar = document.querySelector('.volume-bar');
      const seekBar = document.querySelector('.seek-bar');
      const currentTimeElement = document.querySelector('.current-time');
      const durationElement = document.querySelector('.duration');
      const volumeLevelElement = document.querySelector('.volume-level');
  
      let currentSongIndex = 0;
      const songs = [];
  
      playButtons.forEach(button => {
        const songPath = button.parentElement.getAttribute('data-song-path');
        songs.push(songPath);
        button.addEventListener('click', () => {
          currentSongIndex = Array.from(playButtons).indexOf(button);
          playSong(songPath);
        });
      });
  
      function playSong(songPath) {
        const songTitle = document.querySelector('.player .details h4');
        const artistName = document.querySelector('.player .details p');
        const playerImage = document.querySelector('.player .song-info img');
  
        const songItem = playButtons[currentSongIndex].parentElement;
        songTitle.innerText = songItem.querySelector('h4').innerText;
        artistName.innerText = songItem.querySelector('p').innerText;
        playerImage.src = songItem.querySelector('img').src;
  
        audioPlayer.src = songPath;
        audioPlayer.play();
        updatePlayPauseButton(true);
      }
  
      function updatePlayPauseButton(isPlaying) {
        if (isPlaying) {
          playerPlayButton.classList.remove('fa-play');
          playerPlayButton.classList.add('fa-pause');
        } else {
          playerPlayButton.classList.remove('fa-pause');
          playerPlayButton.classList.add('fa-play');
        }
      }
  
      playerPlayButton.addEventListener('click', () => {
        if (audioPlayer.paused) {
          audioPlayer.play();
          updatePlayPauseButton(true);
        } else {
          audioPlayer.pause();
          updatePlayPauseButton(false);
        }
      });
  
      playerPrevButton.addEventListener('click', () => {
        if (currentSongIndex > 0) {
          currentSongIndex--;
          playSong(songs[currentSongIndex]);
        }
      });
  
      playerNextButton.addEventListener('click', () => {
        if (currentSongIndex < songs.length - 1) {
          currentSongIndex++;
          playSong(songs[currentSongIndex]);
        }
      });
  
      audioPlayer.addEventListener('timeupdate', () => {
        seekBar.value = (audioPlayer.currentTime / audioPlayer.duration) * 100;
        currentTimeElement.innerText = formatTime(audioPlayer.currentTime);
      });
  
      seekBar.addEventListener('input', () => {
        audioPlayer.currentTime = (seekBar.value / 100) * audioPlayer.duration;
      });
  
      audioPlayer.addEventListener('loadedmetadata', () => {
        durationElement.innerText = formatTime(audioPlayer.duration);
      });
  
      volumeButton.addEventListener('click', () => {
        audioPlayer.muted = !audioPlayer.muted;
        updateVolumeIcon();
        updateVolumeLevel();
      });
  
      volumeBar.addEventListener('input', () => {
        audioPlayer.volume = volumeBar.value / 100;
        audioPlayer.muted = audioPlayer.volume === 0;
        updateVolumeIcon();
        updateVolumeLevel();
      });
  
      function updateVolumeIcon() {
        if (audioPlayer.muted || audioPlayer.volume === 0) {
          volumeButton.classList.remove('fa-volume-up');
          volumeButton.classList.add('fa-volume-mute');
        } else {
          volumeButton.classList.remove('fa-volume-mute');
          volumeButton.classList.add('fa-volume-up');
        }
      }
  
      function updateVolumeLevel() {
        volumeLevelElement.innerText = `${Math.round(audioPlayer.volume * 100)}%`;
      }
  
      function formatTime(seconds) {
        const minutes = Math.floor(seconds / 60);
        const secs = Math.floor(seconds % 60);
        return `${minutes}:${secs < 10 ? '0' : ''}${secs}`;
      }
    });

    document.addEventListener('DOMContentLoaded', () => {
      const prevButton = document.querySelector('.fa-chevron-left');
      const nextButton = document.querySelector('.fa-chevron-right');

      // Function to navigate to the previous page
      const goToPreviousPage = () => {
        window.history.back();
      };

      // Function to navigate to the next page
      const goToNextPage = () => {
        window.location.href = 'Search.php'; // Replace 'search.html' with the URL of the next page
      };

      // Event listener for previous button click
      prevButton.addEventListener('click', goToPreviousPage);

      // Event listener for next button click
      nextButton.addEventListener('click', goToNextPage);
    });
  </script>
</body>
</html>
