<?php
$apiKey = '1234567890abcdef'; // Ganti dengan API key valid Anda
$movieId = isset($_GET['movie_id']) ? $_GET['movie_id'] : 0; // Ambil movie_id dari URL
$apiUrl = "http://localhost/project_api/api/index.php?api_key=$apiKey&movie_id=$movieId";

$response = file_get_contents($apiUrl);
$movies = json_decode($response, true);

// Cek jika film ditemukan
$movie = null;
foreach ($movies as $m) {
    if ($m['id'] == $movieId) {
        $movie = $m; // Temukan film yang sesuai dengan movie_id
        break;
}
}
// Pastikan data film ditemukan
if (!$movie) {
    echo "<p>Film tidak ditemukan.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Video Player</title>
    <link rel="stylesheet" href="css/player/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="video-container">
        <video onclick="playPause()" src="videos/<?php echo htmlspecialchars($movie['video_filename']); ?>"></video>        
            <div class="bottom__video-control">
                <div class="progress-bar">
                    <div class="watched-time"></div>
                    <div class="circle"></div>            
                </div>
                <div class="left">
                    <button onclick="playPause()" class="play-pause">
                        <i class="fas fa-play play"></i>
                        <i class="fas fa-pause pause"></i>
                    </button>
                    <button onclick="back()" class="back">
                        <i class="fas fa-undo-alt"></i>                        
                    </button>
                    <button onclick="forward()" class="forward">
                        <i class="fas fa-redo-alt"></i>
                    </button>
                    <button onclick="volume()" class="volume">
                        <i class="fas fa-volume-up up"></i>
                        <i class="fas fa-volume-mute muted"></i>
                    </button>
                    <span class="video-title"><?=$movie['title']; ?></span>
                </div>
                <div class="right">
                    <button onclick="changeScreenSize()" class="screen-size">
                        <i class="fas fa-expand full"></i>
                        <i class="fas fa-compress minimized"></i>
                    </button>
                </div>
            </div>
    </div>
    <script defer src="js/app.js"></script>
</body>
</html>
