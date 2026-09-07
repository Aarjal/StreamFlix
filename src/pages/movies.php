<?php
require __DIR__ . '/../php/session.php';
$username = current_username();

$pageTitle = 'StreamFlix | Movies';
$currentPage = 'movies';
$extraStyles = ['../styles/movies.css'];
require __DIR__ . '/../php/head.php';
?>
<body class="movies-page" data-page="movies">
  <?php require __DIR__ . '/../php/nav.php'; ?>

  <section id="main-content" class="movies-section">
    <h1>Top Picks For You</h1>
    <div class="movie-tools">
      <input id="movie-search" type="text" placeholder="Filter movies by title" aria-label="Filter movies">
      <div class="movie-filter-row">
        <select id="movie-genre" aria-label="Filter by genre">
          <option value="all">All genres</option>
          <option value="action">Action</option>
          <option value="adventure">Adventure</option>
          <option value="drama">Drama</option>
          <option value="thriller">Thriller</option>
          <option value="sci-fi">Sci-Fi</option>
        </select>
        <select id="movie-sort" aria-label="Sort movies">
          <option value="title-asc">Sort: Title A-Z</option>
          <option value="title-desc">Sort: Title Z-A</option>
          <option value="year-desc">Sort: Newest</option>
          <option value="year-asc">Sort: Oldest</option>
          <option value="rating-desc">Sort: Top Rated</option>
        </select>
      </div>
      <p id="movie-count" class="status-text"></p>
      <p id="movie-action" class="status-text" aria-live="polite"></p>
    </div>

    <div id="movies-grid" class="movies-grid">
      <div class="movie-card" data-title="Avengers" data-genre="action" data-year="2012" data-rating="8.0">
        <img src="../../assets/images/avengers.jpg" alt="Avengers movie poster">
        <h2>AVENGERS</h2>
        <p>A thrilling adventure of mystery and excitement.</p>
        <p class="meta">Action • 2012 • ⭐ 8.0</p>
        <a href="#" class="watch-button" data-movie="Avengers">Watch Now</a>
      </div>

      <div class="movie-card" data-title="Life of Pi" data-genre="adventure" data-year="2012" data-rating="7.9">
        <img src="../../assets/images/lifeofpie.jpg" alt="Life of Pi movie poster">
        <h2>LIFE OF PI</h2>
        <p>An emotional journey that touches the soul.</p>
        <p class="meta">Adventure • 2012 • ⭐ 7.9</p>
        <a href="#" class="watch-button" data-movie="Life of Pi">Watch Now</a>
      </div>

      <div class="movie-card" data-title="Inception" data-genre="sci-fi" data-year="2010" data-rating="8.8">
        <img src="../../assets/images/inception.jpg" alt="Inception movie poster">
        <h2>INCEPTION</h2>
        <p>An action-packed blockbuster filled with drama.</p>
        <p class="meta">Sci-Fi • 2010 • ⭐ 8.8</p>
        <a href="#" class="watch-button" data-movie="Inception">Watch Now</a>
      </div>

      <div class="movie-card" data-title="The Prestige" data-genre="thriller" data-year="2006" data-rating="8.5">
        <img src="../../assets/images/inception.jpg" alt="The Prestige movie poster">
        <h2>THE PRESTIGE</h2>
        <p>Two magicians battle obsession, rivalry, and illusion.</p>
        <p class="meta">Thriller • 2006 • ⭐ 8.5</p>
        <a href="#" class="watch-button" data-movie="The Prestige">Watch Now</a>
      </div>

      <div class="movie-card" data-title="Interstellar" data-genre="sci-fi" data-year="2014" data-rating="8.7">
        <img src="../../assets/images/inception.jpg" alt="Interstellar movie poster">
        <h2>INTERSTELLAR</h2>
        <p>A visually stunning mission beyond space and time.</p>
        <p class="meta">Sci-Fi • 2014 • ⭐ 8.7</p>
        <a href="#" class="watch-button" data-movie="Interstellar">Watch Now</a>
      </div>

      <div class="movie-card" data-title="Shutter Island" data-genre="drama" data-year="2010" data-rating="8.2">
        <img src="../../assets/images/lifeofpie.jpg" alt="Shutter Island movie poster">
        <h2>SHUTTER ISLAND</h2>
        <p>A haunting investigation with unforgettable twists.</p>
        <p class="meta">Drama • 2010 • ⭐ 8.2</p>
        <a href="#" class="watch-button" data-movie="Shutter Island">Watch Now</a>
      </div>
    </div>
  </section>

  <script src="../scripts/app.js"></script>
</body>

</html>
