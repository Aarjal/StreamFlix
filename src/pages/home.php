<?php
require __DIR__ . '/../php/session.php';

$flash = pull_flash();
$username = current_username();

$pageTitle = 'StreamFlix | Home';
$currentPage = 'home';
$extraStyles = ['../styles/home.css', '../styles/movie-details.css'];
$pageDescription = 'StreamFlix - Discover award-winning films, fan favorites, and something new for every mood. Stream movies on your terms.';
require __DIR__ . '/../php/head.php';
?>
<body class="home-page" data-page="home">
    <?php require __DIR__ . '/../php/nav.php'; ?>

    <main id="main-content">
        <section class="home-hero">
            <div class="home-hero-overlay"></div>
            <div class="home-hero-content">
                <?php if ($flash): ?>
                    <p class="flash-message <?= htmlspecialchars($flash['type']) ?>"><?= htmlspecialchars($flash['message']) ?></p>
                <?php endif; ?>

                <p class="eyebrow">StreamFlix original</p>
                <h1>Stories that stay with you.</h1>
                <p class="hero-copy">
                    <?php if ($username): ?>
                        Welcome back, <?= htmlspecialchars($username) ?>. Your next unforgettable story starts here.
                    <?php else: ?>
                        Discover award-winning films, fan favorites, and something new for every mood.
                    <?php endif; ?>
                </p>
                <div class="hero-meta"><span>2026</span><span>16+</span><span>2h 28m</span><span>Drama &middot; Mystery</span></div>
                <div class="hero-actions">
                    <a href="movies.php" class="button">&#9656;&nbsp; Browse titles</a>
                    <a href="plans.php" class="button button-ghost">See membership options</a>
                </div>
                <div class="hero-search">
                    <label class="sr-only" for="searchbar">Search titles</label>
                    <input id="searchbar" type="search" placeholder="Search movies, genres, or actors" autocomplete="off">
                    <p id="search-feedback" class="status-text" aria-live="polite">Try: Inception, Avengers, Sci-Fi</p>
                </div>
            </div>
        </section>

        <section class="home-section" aria-labelledby="popular-heading">
            <div class="section-heading">
                <div>
                    <p class="eyebrow">Start here</p>
                    <h2 id="popular-heading">Popular on StreamFlix</h2>
                </div>
                <a href="movies.php" class="text-link">View all titles <span aria-hidden="true">&#8594;</span></a>
            </div>
            <div class="poster-rail">
                <article class="poster-card">
                    <img src="../../assets/images/inception.jpg" alt="Inception poster">
                    <div class="poster-card-content"><span>Mind-bending sci-fi</span><h3>Inception</h3></div>
                </article>
                <article class="poster-card">
                    <img src="../../assets/images/avengers.jpg" alt="Avengers poster">
                    <div class="poster-card-content"><span>Action event</span><h3>Avengers</h3></div>
                </article>
                <article class="poster-card">
                    <img src="../../assets/images/lifeofpie.jpg" alt="Life of Pi poster">
                    <div class="poster-card-content"><span>Critically acclaimed</span><h3>Life of Pi</h3></div>
                </article>
            </div>
        </section>

        <?php if ($username): ?>
        <section class="home-section discovery-row" aria-labelledby="continue-watching-heading">
            <div class="section-heading">
                <div>
                    <p class="eyebrow">Pick up where you left off</p>
                    <h2 id="continue-watching-heading">Continue Watching</h2>
                </div>
            </div>
            <div class="discovery-rail" role="list">
                <article class="discovery-card" role="listitem">
                    <img src="../../assets/images/inception.jpg" alt="Inception" loading="lazy">
                    <div class="discovery-card-content">
                        <span class="discovery-progress" aria-label="45% watched">45%</span>
                        <h3>Inception</h3>
                        <p class="discovery-meta">2h 28m &middot; 1h 12m left</p>
                    </div>
                </article>
                <article class="discovery-card" role="listitem">
                    <img src="../../assets/images/avengers.jpg" alt="Avengers" loading="lazy">
                    <div class="discovery-card-content">
                        <span class="discovery-progress" aria-label="78% watched">78%</span>
                        <h3>Avengers</h3>
                        <p class="discovery-meta">2h 23m &middot; 32m left</p>
                    </div>
                </article>
                <article class="discovery-card" role="listitem">
                    <img src="../../assets/images/lifeofpie.jpg" alt="Life of Pi" loading="lazy">
                    <div class="discovery-card-content">
                        <span class="discovery-progress" aria-label="22% watched">22%</span>
                        <h3>Life of Pi</h3>
                        <p class="discovery-meta">2h 7m &middot; 1h 38m left</p>
                    </div>
                </article>
                <article class="discovery-card" role="listitem">
                    <img src="../../assets/images/interstellar.jpg" alt="Interstellar" loading="lazy">
                    <div class="discovery-card-content">
                        <span class="discovery-progress" aria-label="60% watched">60%</span>
                        <h3>Interstellar</h3>
                        <p class="discovery-meta">2h 49m &middot; 1h 7m left</p>
                    </div>
                </article>
                <article class="discovery-card" role="listitem">
                    <img src="../../assets/images/the-prestige.jpg" alt="The Prestige" loading="lazy">
                    <div class="discovery-card-content">
                        <span class="discovery-progress" aria-label="90% watched">90%</span>
                        <h3>The Prestige</h3>
                        <p class="discovery-meta">2h 10m &middot; 13m left</p>
                    </div>
                </article>
            </div>
        </section>
        <?php endif; ?>

        <section class="home-section discovery-row" aria-labelledby="weekend-picks-heading">
            <div class="section-heading">
                <div>
                    <p class="eyebrow">Curated for you</p>
                    <h2 id="weekend-picks-heading">Weekend Picks</h2>
                </div>
            </div>
            <div class="discovery-rail" role="list">
                <article class="discovery-card" role="listitem">
                    <img src="../../assets/images/interstellar.jpg" alt="Interstellar" loading="lazy">
                    <div class="discovery-card-content">
                        <span class="discovery-badge">Sci-Fi Epic</span>
                        <h3>Interstellar</h3>
                        <p class="discovery-meta">2014 &middot; &#9733; 8.7</p>
                    </div>
                </article>
                <article class="discovery-card" role="listitem">
                    <img src="../../assets/images/the-prestige.jpg" alt="The Prestige" loading="lazy">
                    <div class="discovery-card-content">
                        <span class="discovery-badge">Mind-Bending</span>
                        <h3>The Prestige</h3>
                        <p class="discovery-meta">2006 &middot; &#9733; 8.5</p>
                    </div>
                </article>
                <article class="discovery-card" role="listitem">
                    <img src="../../assets/images/shutter-island.jpg" alt="Shutter Island" loading="lazy">
                    <div class="discovery-card-content">
                        <span class="discovery-badge">Mystery Thriller</span>
                        <h3>Shutter Island</h3>
                        <p class="discovery-meta">2010 &middot; &#9733; 8.2</p>
                    </div>
                </article>
                <article class="discovery-card" role="listitem">
                    <img src="../../assets/images/inception.jpg" alt="Inception" loading="lazy">
                    <div class="discovery-card-content">
                        <span class="discovery-badge">Dream Heist</span>
                        <h3>Inception</h3>
                        <p class="discovery-meta">2010 &middot; &#9733; 8.8</p>
                    </div>
                </article>
                <article class="discovery-card" role="listitem">
                    <img src="../../assets/images/lifeofpie.jpg" alt="Life of Pi" loading="lazy">
                    <div class="discovery-card-content">
                        <span class="discovery-badge">Visual Masterpiece</span>
                        <h3>Life of Pi</h3>
                        <p class="discovery-meta">2012 &middot; &#9733; 7.9</p>
                    </div>
                </article>
            </div>
        </section>

        <section class="home-section discovery-row" aria-labelledby="because-watched-heading">
            <div class="section-heading">
                <div>
                    <p class="eyebrow">Because you watched Inception</p>
                    <h2 id="because-watched-heading">More Like This</h2>
                </div>
            </div>
            <div class="discovery-rail" role="list">
                <article class="discovery-card" role="listitem">
                    <img src="../../assets/images/the-prestige.jpg" alt="The Prestige" loading="lazy">
                    <div class="discovery-card-content">
                        <h3>The Prestige</h3>
                        <p class="discovery-meta">2006 &middot; Thriller &middot; &#9733; 8.5</p>
                    </div>
                </article>
                <article class="discovery-card" role="listitem">
                    <img src="../../assets/images/shutter-island.jpg" alt="Shutter Island" loading="lazy">
                    <div class="discovery-card-content">
                        <h3>Shutter Island</h3>
                        <p class="discovery-meta">2010 &middot; Drama/Mystery &middot; &#9733; 8.2</p>
                    </div>
                </article>
                <article class="discovery-card" role="listitem">
                    <img src="../../assets/images/interstellar.jpg" alt="Interstellar" loading="lazy">
                    <div class="discovery-card-content">
                        <h3>Interstellar</h3>
                        <p class="discovery-meta">2014 &middot; Sci-Fi &middot; &#9733; 8.7</p>
                    </div>
                </article>
                <article class="discovery-card" role="listitem">
                    <img src="../../assets/images/avengers.jpg" alt="Avengers" loading="lazy">
                    <div class="discovery-card-content">
                        <h3>Avengers</h3>
                        <p class="discovery-meta">2012 &middot; Action &middot; &#9733; 8.0</p>
                    </div>
                </article>
                <article class="discovery-card" role="listitem">
                    <img src="../../assets/images/lifeofpie.jpg" alt="Life of Pi" loading="lazy">
                    <div class="discovery-card-content">
                        <h3>Life of Pi</h3>
                        <p class="discovery-meta">2012 &middot; Adventure &middot; &#9733; 7.9</p>
                    </div>
                </article>
            </div>
        </section>

        <section class="home-section benefits-section" aria-labelledby="benefits-heading">
            <div class="section-heading compact-heading">
                <div>
                    <p class="eyebrow">Made for movie nights</p>
                    <h2 id="benefits-heading">More ways to enjoy your time</h2>
                </div>
            </div>
            <div class="benefit-grid">
                <article class="benefit-card"><span class="benefit-icon" aria-hidden="true">&#10022;</span><h3>Curated picks</h3><p>Find your next favorite from a focused collection of memorable stories.</p></article>
                <article class="benefit-card"><span class="benefit-icon" aria-hidden="true">&#9646;&#9646;</span><h3>Watch your way</h3><p>Choose the plan that fits your household and your streaming habits.</p></article>
                <article class="benefit-card"><span class="benefit-icon" aria-hidden="true">&#9825;</span><h3>Keep exploring</h3><p>Save your favorites and come back whenever the mood strikes.</p></article>
            </div>
        </section>

        <section class="membership-banner">
            <div><p class="eyebrow">One membership, endless evenings</p><h2>Ready for your next great watch?</h2></div>
            <a href="plans.php" class="button">Explore plans</a>
        </section>
    </main>

    <script src="../scripts/app.js"></script>
<?php require __DIR__ . '/../php/footer.php'; ?>
