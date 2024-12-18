<?php

include('api.php');

function filterMovies($movies, $filterType)
{
    switch ($filterType) {
        case 'most_watched':
            usort($movies, function ($a, $b) {
                return $b['views'] - $a['views']; // Urut berdasarkan views
            });
            break;

        case 'most_liked':
            usort($movies, function ($a, $b) {
                return $b['total_like'] - $a['total_like']; // Urut berdasarkan total like
            });
            break;

        case 'top_rated':
            usort($movies, function ($a, $b) {
                $ratingA = ($a['total_like'] / ($a['total_like'] + $a['total_dislike'])) * 100;
                $ratingB = ($b['total_like'] / ($b['total_like'] + $b['total_dislike'])) * 100;
                return $ratingB - $ratingA; // Urut berdasarkan persentase rating
            });
            break;

        case 'new_release':
            $movies = array_filter($movies, function ($movie) {
                return $movie['release_year'] == 2023 || $movie['release_year'] == 2024; // Filter tahun rilis
            });
            break;

        default:
            // Jika filter tidak valid, tampilkan semua film
            break;
    }

    return $movies;
}
$filterType = isset($_GET['filter']) ? $_GET['filter'] : 'most_watched';
$filteredMovies = filterMovies($movies, $filterType);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mateflix | Filter Movies</title>
    <script defer src="https://use.fontawesome.com/releases/v5.1.0/js/all.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <script src="main.js"></script>
</head>

<body>
    <div class="wrapper">
        <!-- HEADER -->
        <?php include('header.php'); ?>
        <!-- END OF HEADER -->

        <!-- MAIN CONTENT -->
        <section class="main-container">
            <!-- Filter Category Section -->
            <div class="filter-category">
                <h2>Filter Movies</h2>
                <form action="filter.php" method="GET">
                    <select name="filter" onchange="this.form.submit()">
                        <option class="watch-btn" value="most_watched" <?php echo $filterType == 'most_watched' ? 'selected' : ''; ?>>Most Watched</option>
                        <option class="watch-btn" value="most_liked" <?php echo $filterType == 'most_liked' ? 'selected' : ''; ?>>Most Liked</option>
                        <option class="watch-btn" value="top_rated" <?php echo $filterType == 'top_rated' ? 'selected' : ''; ?>>Top Rated</option>
                        <option class="watch-btn" value="new_release" <?php echo $filterType == 'new_release' ? 'selected' : ''; ?>>New Release (2023-2024)</option>
                    </select>
                </form>
            </div>

            <!-- Movie List Section -->
            <div class="wrapper">
                <h1>Movies</h1>
                <div class="box">
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
                </div>
            </div>
        </section>
        <!-- FOOTER -->
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