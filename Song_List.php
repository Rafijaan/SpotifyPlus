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

// Fetch songs from the songs table
$songs_sql = "SELECT * FROM songs";
$songs_result = $conn->query($songs_sql);

// Fetch songs from the popularnasheed table
$nasheed_sql = "SELECT * FROM popularnasheed";
$nasheed_result = $conn->query($nasheed_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Song List</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Example CSS styles */
        body {
            font-family: Arial, sans-serif;
            background-color:  #121212;
        }

        .main-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #0f4f4f;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .song-list ul {
            list-style: none;
            padding: 0;
        }

        .song-list ul li {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 8px;
        }

        .song-list ul li img {
            width: 50px;
            height: 50px;
            margin-right: 10px;
            border-radius: 4px;
        }

        .song-info {
            flex-grow: 1;
            display: flex;
            align-items: center;
        }

        .song-info span {
            font-size: 16px;
            font-weight: 500;
        }

        .song-actions {
            display: flex;
            align-items: center;
        }

        .song-actions button {
            background-color: #1db954;
            color: #fff;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 4px;
            margin-left: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }

        .song-actions button i {
            margin-right: 4px;
        }

        .song-actions button:first-child {
            background-color: #1db954;
        }

        .song-actions button:last-child {
            background-color: #ff4b4b;
        }

    </style>
    <script>
        function addToPlaylist(songId, title, artist, imageUrl, url) {
            const playlistIndex = localStorage.getItem('currentPlaylistIndex');
            let playlists = JSON.parse(localStorage.getItem('playlists')) || [];
            let playlist = playlists[playlistIndex];

            if (!playlist.songs) {
                playlist.songs = [];
            }

            const newSong = {
                id: songId,
                title: title,
                artist: artist,
                image: imageUrl,
                url: url
            };

            playlist.songs.push(newSong);
            playlists[playlistIndex] = playlist;
            localStorage.setItem('playlists', JSON.stringify(playlists));

            alert('Song added to playlist');
        }

        function playPauseSong(audioId) {
            const audio = document.getElementById(audioId);
            const playBtn = document.querySelector(`[onclick="playPauseSong('${audioId}')"]`);

            if (audio.paused) {
                audio.play();
                playBtn.innerHTML = '<i class="fa fa-pause"></i>';
            } else {
                audio.pause();
                playBtn.innerHTML = '<i class="fa fa-play"></i>';
            }
        }
    </script>
</head>
<body>
    <div class="main-container">
        <h2>Recommended Songs</h2>
        <div class="song-list">
            <ul>
                <?php
                if ($songs_result->num_rows > 0) {
                    while ($row = $songs_result->fetch_assoc()) {
                        echo "<li>";
                        echo "<div class='song-info'>";
                        echo "<img src='{$row['image_path']}' alt='Song Image'>";
                        echo "<span>{$row['title']} - {$row['artist']}</span>";
                        echo "</div>";
                        echo "<div class='song-actions'>";
                        echo "<audio id='audio-{$row['id']}' src='{$row['file_path']}'></audio>";
                        echo "<button onclick=\"playPauseSong('audio-{$row['id']}')\"><i class='fa fa-play'></i> Play</button>";
                        echo "<button onclick=\"addToPlaylist({$row['id']}, '{$row['title']}', '{$row['artist']}', '{$row['image_path']}', '{$row['file_path']}')\"><i class='fa fa-plus'></i> Add</button>";
                        echo "</div>";
                        echo "</li>";
                    }
                } else {
                    echo "<li>No songs found in the songs table.</li>";
                }

                if ($nasheed_result->num_rows > 0) {
                    while ($row = $nasheed_result->fetch_assoc()) {
                        echo "<li>";
                        echo "<div class='song-info'>";
                        echo "<img src='{$row['image_path']}' alt='Song Image'>";
                        echo "<span>{$row['title']} - {$row['artist']}</span>";
                        echo "</div>";
                        echo "<div class='song-actions'>";
                        echo "<audio id='audio-{$row['Id']}' src='{$row['file_path']}'></audio>";
                        echo "<button onclick=\"playPauseSong('audio-{$row['Id']}')\"><i class='fa fa-play'></i> Play</button>";
                        echo "<button onclick=\"addToPlaylist({$row['Id']}, '{$row['title']}', '{$row['artist']}', '{$row['image_path']}', '{$row['file_path']}')\"><i class='fa fa-plus'></i> Add</button>";
                        echo "</div>";
                        echo "</li>";
                    }
                } else {
                    echo "<li>No songs found in the popularnasheed table.</li>";
                }
                ?>
            </ul>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
