<?php

include('../api.php');

usort($movies, function ($a, $b) {
    return $b['views'] - $a['views'];
});
$topMovies = array_slice($movies, 0, 10); // Top 10 movies

shuffle($movies);
$randomMovies = array_slice($movies, 0, 8); // Random 8 movies
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mateflix | Layanan Streaming Film Sederhana</title>
    <script defer src="https://use.fontawesome.com/releases/v5.1.0/js/all.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <script src="main.js"></script>
</head>

<body>
    <div class="wrapper">
        <!-- HEADER -->
        <?php include('../header.php') ?>
        <!-- END OF HEADER -->

        <!-- MAIN CONTENT -->
        <section class="main-container">
            <!-- Trending Now Section -->
            <div class="location" id="trending">
                <h1>Trending Now</h1>
                <div class="box">
                    <?php foreach ($topMovies as $movie): ?>
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
                </div>
            </div>

            <!-- Random Movies Section -->
            <h1>Random Picks</h1>
            <div class="box">
                <?php foreach ($randomMovies as $movie): ?>
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
        document.querySelectorAll('.box a img').forEach(img => {
            img.addEventListener('mouseover', () => {
                img.style.opacity = '0.8';
            });
            img.addEventListener('mouseout', () => {
                img.style.opacity = '1';
            });
        });
    </script>
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

                    // Filter 
                    const genres = genre.split(',').filter(g => g.trim() !== '');

                    // Modal data
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