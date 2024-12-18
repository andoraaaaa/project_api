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
    <div class="header">
        <h1>Trending Now</h1>
        <div class="filter-container">
            <select name="region" id="region">
                <option value="Indonesia">Indonesia</option>
                <option value="Global">Global</option>
            </select>
            <select name="category" id="category">
                <option value="Movies">Movies</option>
                <option value="Series">Series</option>
            </select>
        </div>
    </div>

    <?php
    // Ambil data film dengan views tertinggi, urutkan berdasarkan views
    usort($movies, function ($a, $b) {
        return $b['views'] - $a['views']; // Urutkan berdasarkan views tertinggi
    });
    $topMovies = array_slice($movies, 0, 10); // Ambil 10 film teratas berdasarkan views
    ?>

    <?php if (isset($topMovies['error'])): ?>
        <p style="text-align: center; color: red;"><?php echo $topMovies['error']; ?></p>
    <?php else: ?>
        <div class="movies-container">
            <?php foreach ($topMovies as $index => $movie): ?>
                <div class="movie-card">
                    <span class="rank"><?php echo $index + 1; ?></span>
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
                        <p class="recently-added">Recently Added</p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="header">
        <h1>Random Movies</h1>
    </div>
    <div class="more-movies-container">
        <?php
        // Acak urutan film untuk bagian Random Movies dan ambil hanya 8 film
        shuffle($movies);
        $randomMovies = array_slice($movies, 0, 8); // Ambil 8 film acak
        $counter = 0; // Counter untuk mengatur layout 4 film per baris
        foreach ($randomMovies as $movie):
            if ($counter % 4 == 0 && $counter != 0): ?>
    </div>
    <div class="more-movies-container"> <!-- New row every 4 movies -->
    <?php endif;
            $counter++;
    ?>
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
        </div>
    </div>
<?php endforeach; ?>
    </div>

    <!-- Tombol More Movies -->
    <div class="more-movies-button-container" style="text-align: center; margin-top: 20px;">
        <a href="all_movies.php" class="more-movies-button">More Movies</a>
    </div><br><br>

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