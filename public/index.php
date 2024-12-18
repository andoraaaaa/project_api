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
    <title>Streaming Film Sederhana</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Streaming Film</h1>
    <?php if (isset($movies['error'])): ?>
        <p style="text-align: center; color: red;"><?php echo $movies['error']; ?></p>
    <?php else: ?>
        <div class="movies-container">
            <?php foreach ($movies as $movie): ?>
                <div class="movie-card">
                    <a href="watch.php?movie_id=<?php echo urlencode($movie['id']); ?>" target="_blank" class="movie-link">
                        <div class="video-thumbnail">
                            <img src="<?php echo htmlspecialchars($movie['image_url']); ?>" alt="<?php echo htmlspecialchars($movie['title']); ?>" class="thumbnail-image">
                            <!-- Video preview -->
                            <video class="preview-video" muted>
                                <source src="videos/<?php echo htmlspecialchars($movie['video_filename']); ?>" type="video/mp4">
                            </video>
                        </div></a>
                        <div class="movie-details">
                            <h2><?php echo htmlspecialchars($movie['title']); ?></h2>
                            <p><?php echo htmlspecialchars($movie['description']); ?></p>
                            <p class="genre">Genre: <?php echo htmlspecialchars($movie['genre']); ?></p>
                            <p class="release-year">Tahun Rilis: <?php echo $movie['release_year']; ?></p>
                        </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <script>
        const movieCards = document.querySelectorAll('.movie-card');
        
        movieCards.forEach(card => {
            const video = card.querySelector('.preview-video');
            const thumbnailImage = card.querySelector('.thumbnail-image');

            function playRandomClip() {
                const videoDuration = video.duration;
                const clipDuration = 5; 
                const randomStart = Math.random() * (videoDuration - clipDuration);

                video.currentTime = randomStart;
                video.play();

                setTimeout(() => {
                    video.pause();
                }, clipDuration * 1000);
            }

            card.addEventListener('mouseenter', () => {
                playRandomClip();
                thumbnailImage.style.opacity = '0';
            });

            card.addEventListener('mouseleave', () => {
                video.pause();
                video.currentTime = 0;
                thumbnailImage.style.opacity = '1';
            });
        });
    </script>
</body>
</html>
