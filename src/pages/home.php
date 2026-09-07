<?php
require __DIR__ . '/../php/session.php';

$flash = pull_flash();
$username = current_username();

$pageTitle = 'StreamFlix | Home';
$currentPage = 'home';
$extraStyles = [];
require __DIR__ . '/../php/head.php';
?>
<body class="home-page" data-page="home">
    <?php require __DIR__ . '/../php/nav.php'; ?>

    <main id="main-content" class="hero hero-home">
        <?php if ($flash): ?>
            <p class="flash-message <?= htmlspecialchars($flash['type']) ?>"><?= htmlspecialchars($flash['message']) ?></p>
        <?php endif; ?>

        <section class="hero-main">
            <span class="hero-badge">Featured Tonight</span>

            <h1>Unlimited Movies, TV Shows, and More.</h1>
            <p>
                <?php if ($username): ?>
                    Welcome back, <?= htmlspecialchars($username) ?>. Find your next favorite title and start streaming instantly.
                <?php else: ?>
                    Find your next favorite title and start streaming instantly.
                <?php endif; ?>
            </p>

            <div class="hero-actions">
                <a href="movies.php" class="button">Start Watching</a>
                <a href="plans.php" class="button button-ghost">View Plans</a>
            </div>

            <div class="hero-search">
                <input id="searchbar" type="text" placeholder="Search movies, genres, or actors" aria-label="Search titles">
                <p id="search-feedback" class="status-text" aria-live="polite">Try: Inception, Avengers, Sci-Fi</p>
            </div>
        </section>

        <aside class="hero-side-panel" aria-label="Trending titles">
            <h2>Trending Now</h2>
            <div class="trend-list">
                <a href="movies.php" class="trend-item">
                    <img src="../../assets/images/inception.jpg" alt="Inception">
                    <span>Inception</span>
                </a>
                <a href="movies.php" class="trend-item">
                    <img src="../../assets/images/avengers.jpg" alt="Avengers">
                    <span>Avengers</span>
                </a>
                <a href="movies.php" class="trend-item">
                    <img src="../../assets/images/lifeofpie.jpg" alt="Life of Pi">
                    <span>Life of Pi</span>
                </a>
            </div>
        </aside>
    </main>

    <script src="../scripts/app.js"></script>
</body>
</html>
