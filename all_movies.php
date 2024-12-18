<?php
$apiKey = '1234567890abcdef'; // Ganti dengan API key valid Anda
$apiUrl = "http://localhost/project_api/api/index.php?api_key=$apiKey";

$response = file_get_contents($apiUrl);
$movies = json_decode($response, true);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Streaming Film Sederhana - All Movies</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="header">
        <h1>All Movies</h1>
        <div class="filter-container">
            <select name="region" id="region">
                <option value="Default">Default</option>
                <option value="Global">Global</option>
            </select>
            <select name="category" id="category">
                <option value="Movies">Movies</option>
                <option value="Series">Series</option>
            </select>
        </div>
    </div>

    <?php if (isset($movies['error'])): ?>
        <p style="text-align: center; color: red;"><?php echo $movies['error']; ?></p>
    <?php else: ?>
        <div class="more-movies-container">
            <?php foreach ($movies as $movie): ?>
                <div class="movie-card">
                    <a href="watch.php?movie_id=<?php echo urlencode($movie['id']); ?>" target="_blank">
                        <div class="video-thumbnail">
                            <img src="<?php echo htmlspecialchars($movie['image_url']); ?>" alt="<?php echo htmlspecialchars($movie['title']); ?>" class="thumbnail-image">
                            <video class="preview-video" muted>
                                <source src="videos/<?php echo htmlspecialchars($movie['video_filename']); ?>" type="video/mp4">
                            </video>
                        </div>
                    </a>
                    <div class="movie-details">
                        <h2><?php echo htmlspecialchars($movie['title']); ?></h2>
                        <p class="movie-description"><?php echo htmlspecialchars($movie['description']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <script>
        document.querySelectorAll('.movie-card').forEach(card => {
            const video = card.querySelector('.preview-video');
            const thumbnail = card.querySelector('.thumbnail-image');

            card.addEventListener('mouseenter', () => {
                video.play();
                thumbnail.style.opacity = '0';
            });

            card.addEventListener('mouseleave', () => {
                video.pause();
                video.currentTime = 0;
                thumbnail.style.opacity = '1';
            });
        });
    </script>
</body>

</html>
