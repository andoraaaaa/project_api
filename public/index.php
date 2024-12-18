<?php
$apiKey = '1234567890abcdef'; // Ganti dengan API key valid Anda
$apiUrl = "http://localhost/project_api/api/index.php?api_key=$apiKey";

$response = file_get_contents($apiUrl);
$movies = json_decode($response, true);

// Sort top movies by views
usort($movies, function ($a, $b) {
    return $b['views'] - $a['views'];
});
$topMovies = array_slice($movies, 0, 10); // Top 10 movies

// Shuffle for random movies
shuffle($movies);
$randomMovies = array_slice($movies, 0, 8); // Random 8 movies
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netflix Clone</title>
    <script defer src="https://use.fontawesome.com/releases/v5.1.0/js/all.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <script src="main.js"></script>
</head>

<body>
    <div class="wrapper">
        <!-- HEADER -->
        <header>
            <div class="netflixLogo">
                <a id="logo" href="#home"><img src="https://github.com/carlosavilae/Netflix-Clone/blob/master/img/logo.PNG?raw=true" alt="Logo Image"></a>
            </div>
            <nav class="main-nav">
                <a href="#home">Home</a>
                <a href="#tvShows">TV Shows</a>
                <a href="#movies">Movies</a>
                <a href="#originals">Originals</a>
                <a href="#trending">Trending Now</a>
            </nav>
            <nav class="sub-nav">
                <a href="#"><i class="fas fa-search sub-nav-logo"></i></a>
                <a href="#"><i class="fas fa-bell sub-nav-logo"></i></a>
                <a href="#">Account</a>
            </nav>
        </header>
        <!-- END OF HEADER -->

        <!-- MAIN CONTENT -->
        <section class="main-container">
            <!-- Trending Now Section -->
            <div class="location" id="trending">
                <h1>Trending Now</h1>
                <div class="box">
                    <?php foreach ($topMovies as $movie): ?>
                        <a href="watch.php?movie_id=<?= urlencode($movie['id']); ?>">
                            <img src="<?= htmlspecialchars($movie['image_url']); ?>" alt="<?= htmlspecialchars($movie['title']); ?>">
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Random Movies Section -->
            <h1>Random Picks</h1>
            <div class="box">
                <?php foreach ($randomMovies as $movie): ?>
                    <a href="watch.php?movie_id=<?= urlencode($movie['id']); ?>">
                        <img src="<?= htmlspecialchars($movie['image_url']); ?>" alt="<?= htmlspecialchars($movie['title']); ?>">
                    </a>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- LINKS -->
        <section class="link">
            <div class="logos">
                <a href="#"><i class="fab fa-facebook-square fa-2x logo"></i></a>
                <a href="#"><i class="fab fa-instagram fa-2x logo"></i></a>
                <a href="#"><i class="fab fa-twitter fa-2x logo"></i></a>
                <a href="#"><i class="fab fa-youtube fa-2x logo"></i></a>
            </div>
            <div class="sub-links">
                <ul>
                    <li><a href="#">Audio and Subtitles</a></li>
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">Privacy</a></li>
                </ul>
            </div>
        </section>

        <!-- FOOTER -->
        <footer>
            <p>&copy; 2024 Netflix Clone</p>
        </footer>
    </div>

    <script>
        document.querySelectorAll('.box a img').forEach(img => {
            img.addEventListener('mouseover', () => {
                img.style.opacity = '0.8';
            });
            img.addEventListener('mouseout', () => {
                img.style.opacity = '1';
            });
        });
    </script>
</body>

</html>