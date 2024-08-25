<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Spotify Clone - Your Playlists</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="styles.css">
  <script src="https://kit.fontawesome.com/23cecef777.js" crossorigin="anonymous"></script>
  <style>
    /* Existing styles */
    /* Add any additional styles for new elements here */

    .song img {
      max-width: 50px;
      max-height: 50px;
      border-radius: 50%;
      margin-right: 10px;
    }
    /* Basic reset */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      background-color: black;
      color: white;
    }

    .sidebar {
      width: 200px;
      background-color: #121212;
      position: fixed;
      top: 0;
      left: 0;
      height: 100%;
      padding: 20px;
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
    .container {
      text-align: center;
      color: white;
      background-color: rgba(121, 112, 112, 0.342);
      padding: 20px;
    }

    .main-container {
      margin-left: 260px; /* Adjusted margin to fit the sidebar */
      padding: 20px;
    }

    #playlists {
      margin-top: 20px; /* Added margin for spacing */
    }

    .playlist {
      background-color: #1c1c1c;
      padding: 3%;
      margin-bottom: 20px; /* Adjusted margin for spacing */
      border-radius: 5px;
    }

    .playlist img {
      display: block;
      margin: 0 auto 10px auto; /* Center image horizontally and add bottom margin */
      max-width: 150px; /* Increased size */
      max-height: 150px; /* Increased size */
      border-radius: 50%;
    }

    .playlist h3 {
      color: #1DB954;
      font-size: 24px;
      margin-bottom: 10px;
      text-align: center; /* Center text content */
    }

    .playlist p {
      color: #b3b3b3;
      margin-bottom: 10px;
      text-align: center; /* Center text content */
    }

    .playlist button {
      background-color: #1DB954;
      color: white;
      border: none;
      padding: 10px 20px;
      margin-right: 10px;
      cursor: pointer;
      border-radius: 5px;
    }

    .playlist button.delete-button {
      background-color: #ff4d4d;
    }

    .song {
      background-color: #282828;
      padding: 10px;
      margin-bottom: 10px;
      display: flex;
      align-items: center;
      border-radius: 5px;
    }

    .song img {
      max-width: 50px;
      max-height: 50px;
      border-radius: 50%;
      margin-right: 10px;
    }

    .song p {
      flex: 1;
      color: #fff;
    }

    .song-controls {
      display: flex;
      align-items: center;
    }

    .song-controls button {
      background: none;
      border: none;
      color: white;
      font-size: 20px;
      cursor: pointer;
      margin-right: 10px;
    }

    .song-controls input[type="range"] {
      width: 100px;
      margin-left: 10px;
    }

  </style>
</head>
<body>
  <div class="sidebar">
    <!-- Sidebar content -->
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
            <a href="logout.php">Logout</a>
          </li>
        </ul>
       <!-- <button type="button"><a href="index.php">Login</a></button>-->
      </div>
    </div>
    <div class="main-container0">
      <div class="container">
        <H2>Create Favourite Nasheeds..........</H2><br>
          
        <P>Start Adding naats!</P>
        <p>Add recommended naats  and select to add to the playlist</p>

        <div id="playlists"></div>
      </div>
    </div>
    <script>
      function displayPlaylists() {
        const playlistsContainer = document.getElementById('playlists');
        playlistsContainer.innerHTML = '';

        const playlists = JSON.parse(localStorage.getItem('playlists')) || [];

        playlists.forEach((playlist, index) => {
          const playlistDiv = document.createElement('div');
          playlistDiv.className = 'playlist';

          if (playlist.image) {
            const img = document.createElement('img');
            img.src = playlist.image;
            playlistDiv.appendChild(img);
          }

          const title = document.createElement('h3');
          title.textContent = playlist.name;
          playlistDiv.appendChild(title);

          const description = document.createElement('p');
          description.textContent = playlist.description;
          playlistDiv.appendChild(description);

          const addSongButton = document.createElement('button');
          addSongButton.textContent = 'Add Naat';
          addSongButton.addEventListener('click', function() {
            addSongToPlaylist(index);
          });
          playlistDiv.appendChild(addSongButton);

          const deleteButton = document.createElement('button');
          deleteButton.className = 'delete-button';
          deleteButton.textContent = 'Delete';
          deleteButton.addEventListener('click', function() {
            deletePlaylist(index);
          });
          playlistDiv.appendChild(deleteButton);

          if (playlist.songs && playlist.songs.length > 0) {
            playlist.songs.forEach((song, songIndex) => {
              const songDiv = document.createElement('div');
              songDiv.className = 'song';

              // Add image for the song if available
              if (song.image) {
                const songImg = document.createElement('img');
                songImg.src = song.image;
                songDiv.appendChild(songImg);
              }

              const songTitle = document.createElement('p');
              songTitle.textContent = song.title;
              songDiv.appendChild(songTitle);

              const audio = document.createElement('audio');
              audio.src = song.url;
              audio.controls = true;
              songDiv.appendChild(audio);

              const songControls = document.createElement('div');
              songControls.className = 'song-controls';

              const volumeControl = document.createElement('input');
              volumeControl.type = 'range';
              volumeControl.min = '0';
              volumeControl.max = '1';
              volumeControl.step = '0.1';
              volumeControl.value = audio.volume;
              volumeControl.addEventListener('input', function() {
                audio.volume = volumeControl.value;
              });
              songControls.appendChild(volumeControl);

              songDiv.appendChild(songControls);
              playlistDiv.appendChild(songDiv);
            });
          }

          playlistsContainer.appendChild(playlistDiv);
        });
      }

      function deletePlaylist(index) {
        let playlists = JSON.parse(localStorage.getItem('playlists')) || [];
        playlists.splice(index, 1);
        localStorage.setItem('playlists', JSON.stringify(playlists));
        displayPlaylists();
      }

      function addSongToPlaylist(playlistIndex) {
        // Save the playlist index to localStorage to be used in the song list page
        localStorage.setItem('currentPlaylistIndex', playlistIndex);
        // Redirect to the song list page
        window.location.href = 'Song_List.php';
      }

      // Initial display of playlists
      displayPlaylists();
      document.addEventListener('DOMContentLoaded', () => {
        const prevButton = document.querySelector('.fa-chevron-left');
        const nextButton = document.querySelector('.fa-chevron-right');

        const goToPreviousPage = () => {
          window.history.back();
        };

        const goToNextPage = () => {
          window.location.href = 'index.php';
        };

        prevButton.addEventListener('click', goToPreviousPage);
        nextButton.addEventListener('click', goToNextPage);
      });
    </script>
  </div>
</body>
</html>
