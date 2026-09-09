<?php
require __DIR__ . '/../php/session.php';
$username = current_username();

$pageTitle = 'StreamFlix | Browse';
$currentPage = 'movies';
$extraStyles = ['../styles/movies.css'];
require __DIR__ . '/../php/head.php';
?>
<body class="movies-page" data-page="movies">
    <?php require __DIR__ . '/../php/nav.php'; ?>

    <main id="main-content" class="movies-section">
        <header class="page-intro">
            <p class="eyebrow">Find your next favorite</p>
            <h1>Browse the collection</h1>
            <p>From thrilling adventures to quiet, unforgettable stories—there is something for every mood.</p>
        </header>

        <div class="movie-tools" aria-label="Movie filters">
            <label class="sr-only" for="movie-search">Search movies</label>
            <input id="movie-search" type="search" placeholder="Search by title" autocomplete="off">
            <div class="movie-filter-row">
                <label class="sr-only" for="movie-genre">Genre</label>
                <select id="movie-genre">
                    <option value="all">All genres</option><option value="action">Action</option><option value="adventure">Adventure</option><option value="drama">Drama</option><option value="thriller">Thriller</option><option value="sci-fi">Sci-Fi</option>
                </select>
                <label class="sr-only" for="movie-sort">Sort movies</label>
                <select id="movie-sort">
                    <option value="title-asc">Sort: Title A-Z</option><option value="title-desc">Sort: Title Z-A</option><option value="year-desc">Sort: Newest</option><option value="year-asc">Sort: Oldest</option><option value="rating-desc">Sort: Top Rated</option>
                </select>
            </div>
            <p id="movie-count" class="status-text"></p><p id="movie-action" class="status-text" aria-live="polite"></p>
        </div>

        <div id="movies-grid" class="movies-grid">
            <article class="movie-card" data-title="Avengers" data-genre="action" data-year="2012" data-rating="8.0"><img src="../../assets/images/avengers.jpg" alt="Avengers movie poster"><div class="movie-card-body"><p class="movie-kicker">Action</p><h2>Avengers</h2><p class="meta">2012 <span>&middot;</span> &#9733; 8.0</p><a href="#" class="watch-button" data-movie="Avengers">Play preview <span aria-hidden="true">&#8594;</span></a></div></article>
            <article class="movie-card" data-title="Life of Pi" data-genre="adventure" data-year="2012" data-rating="7.9"><img src="../../assets/images/lifeofpie.jpg" alt="Life of Pi movie poster"><div class="movie-card-body"><p class="movie-kicker">Adventure</p><h2>Life of Pi</h2><p class="meta">2012 <span>&middot;</span> &#9733; 7.9</p><a href="#" class="watch-button" data-movie="Life of Pi">Play preview <span aria-hidden="true">&#8594;</span></a></div></article>
            <article class="movie-card" data-title="Inception" data-genre="sci-fi" data-year="2010" data-rating="8.8"><img src="../../assets/images/inception.jpg" alt="Inception movie poster"><div class="movie-card-body"><p class="movie-kicker">Sci-Fi</p><h2>Inception</h2><p class="meta">2010 <span>&middot;</span> &#9733; 8.8</p><a href="#" class="watch-button" data-movie="Inception">Play preview <span aria-hidden="true">&#8594;</span></a></div></article>
            <article class="movie-card" data-title="The Prestige" data-genre="thriller" data-year="2006" data-rating="8.5"><img src="../../assets/images/inception.jpg" alt="The Prestige movie poster"><div class="movie-card-body"><p class="movie-kicker">Thriller</p><h2>The Prestige</h2><p class="meta">2006 <span>&middot;</span> &#9733; 8.5</p><a href="#" class="watch-button" data-movie="The Prestige">Play preview <span aria-hidden="true">&#8594;</span></a></div></article>
            <article class="movie-card" data-title="Interstellar" data-genre="sci-fi" data-year="2014" data-rating="8.7"><img src="../../assets/images/inception.jpg" alt="Interstellar movie poster"><div class="movie-card-body"><p class="movie-kicker">Sci-Fi</p><h2>Interstellar</h2><p class="meta">2014 <span>&middot;</span> &#9733; 8.7</p><a href="#" class="watch-button" data-movie="Interstellar">Play preview <span aria-hidden="true">&#8594;</span></a></div></article>
            <article class="movie-card" data-title="Shutter Island" data-genre="drama" data-year="2010" data-rating="8.2"><img src="../../assets/images/lifeofpie.jpg" alt="Shutter Island movie poster"><div class="movie-card-body"><p class="movie-kicker">Drama</p><h2>Shutter Island</h2><p class="meta">2010 <span>&middot;</span> &#9733; 8.2</p><a href="#" class="watch-button" data-movie="Shutter Island">Play preview <span aria-hidden="true">&#8594;</span></a></div></article>
        </div>
    </main>
    <script src="../scripts/app.js"></script>
</body>
</html>
