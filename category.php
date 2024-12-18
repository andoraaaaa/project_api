<?php
$apiKey = '1234567890abcdef'; // Ganti dengan API key valid Anda
$apiUrl = "http://localhost/project_api/api/index.php?api_key=$apiKey";

$response = file_get_contents($apiUrl);
$movies = json_decode($response, true);

// Ambil genre yang dicentang dari form
$selectedGenres = isset($_GET['genres']) ? $_GET['genres'] : [];

// Filter film berdasarkan genre yang dipilih
$filteredMovies = [];
foreach ($movies as $movie) {
    $movieGenres = array_filter([$movie['genre1'], $movie['genre2'], $movie['genre3']]);
    if (empty($selectedGenres) || array_intersect($selectedGenres, $movieGenres)) {
        $filteredMovies[] = $movie;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mateflix | Movie Categories</title>
    <script defer src="https://use.fontawesome.com/releases/v5.1.0/js/all.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="wrapper">
        <!-- HEADER -->
        <?php include('header.php') ?>
        <!-- END OF HEADER -->

        <!-- FILTER -->
        <section class="filter-section">
            <h1>Filter by Genre</h1>
            <form method="GET" action="category.php">
                <div class="checkbox-list">
                    <?php
                    // Ambil daftar genre unik
                    $genres = [];
                    foreach ($movies as $movie) {
                        foreach (['genre1', 'genre2', 'genre3'] as $genreKey) {
                            if (!empty($movie[$genreKey])) {
                                $genres[trim($movie[$genreKey])] = trim($movie[$genreKey]);
                            }
                        }
                    }
                    ksort($genres);

                    // Tampilkan checkbox
                    foreach ($genres as $genre) {
                        $isChecked = in_array($genre, $selectedGenres) ? 'checked' : '';
                        echo "<label><input type='checkbox' name='genres[]' value='$genre' $isChecked> $genre</label>";
                    }
                    ?>
                </div>
                <button type="submit" class="watch-btn">Apply Category</button>
            </form>
        </section>

        <!-- MOVIE LIST -->
        <section class="main-container">
            <h1>Movies</h1>
            <div class="box">
                <?php if (!empty($filteredMovies)): ?>
                    <?php foreach ($filteredMovies as $movie): ?>
                        <a href="watch.php?movie_id=<?= urlencode($movie['id']); ?>">
                            <div class="image-container"
                                data-id="<?= urlencode($movie['id']); ?>"
                                data-title="<?= htmlspecialchars($movie['title']); ?>"
                                data-image="<?= htmlspecialchars($movie['image_url']); ?>"
                                data-genre="<?= implode(', ', array_filter([$movie['genre1'], $movie['genre2'], $movie['genre3']])); ?>"
                                data-views="<?= number_format($movie['views']); ?>"
                                data-description="<?= htmlspecialchars($movie['description']); ?>">
                                <img src="<?= htmlspecialchars($movie['image_url']); ?>" alt="<?= htmlspecialchars($movie['title']); ?>">
                                <div class="overlay">
                                    <p class="title"><?= htmlspecialchars($movie['title']); ?></p>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No movies found for the selected genre(s).</p>
                <?php endif; ?>
            </div>
        </section>

        <!-- Modal -->
        <div id="movieModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <img id="modalImage" src="" alt="Movie Image">
                <h2 id="modalTitle">Movie Title</h2>
                <p id="modalDetails">Details</p>
                <a id="watchButton" href="#" class="watch-btn">Watch Now</a>
            </div>
        </div>

        <!-- FOOTER -->
        <footer>
            <p>&copy; 2024 Mateflix</p>
        </footer>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById('movieModal');
            const modalImage = document.getElementById('modalImage');
            const modalTitle = document.getElementById('modalTitle');
            const modalDetails = document.getElementById('modalDetails');
            const watchButton = document.getElementById('watchButton');
            const closeBtn = document.querySelector('.close');

            document.querySelectorAll('.box .image-container').forEach(container => {
                container.addEventListener('click', (e) => {
                    e.preventDefault();

                    const image = container.getAttribute('data-image');
                    const title = container.getAttribute('data-title');
                    const genre = container.getAttribute('data-genre');
                    const views = container.getAttribute('data-views');
                    const description = container.getAttribute('data-description') || 'Details not available';
                    const movieId = container.getAttribute('data-id');

                    const genres = genre.split(',').filter(g => g.trim() !== '');

                    modalImage.src = image;
                    modalTitle.textContent = title;
                    modalDetails.innerHTML = `
                        ${description}<br>
                        <strong>Genre:</strong> ${genres.join(', ')}<br>
                        <strong>Views:</strong> ${views}
                    `;

                    watchButton.href = `watch.php?movie_id=${encodeURIComponent(movieId)}`;
                    modal.style.display = 'block';
                });
            });

            closeBtn.addEventListener('click', () => {
                modal.style.display = 'none';
            });

            window.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.style.display = 'none';
                }
            });
        });
    </script>
</body>

</html>
