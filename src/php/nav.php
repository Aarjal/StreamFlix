<?php $currentPage = $currentPage ?? ''; ?>
<header class="site-header">
    <nav class="main-nav" aria-label="Main navigation">
        <a class="brand" href="home.php" aria-label="StreamFlix home">
            <span class="brand-mark" aria-hidden="true">&#9656;</span>
            <span>STREAMFLIX</span>
        </a>

        <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="primary-menu" data-nav-toggle>
            <span class="sr-only">Toggle navigation</span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </button>

        <ul id="primary-menu" class="nav-links" data-nav-menu>
            <li><a class="<?= $currentPage === 'home' ? 'active' : '' ?>" href="home.php">Home</a></li>
            <li><a class="<?= $currentPage === 'movies' ? 'active' : '' ?>" href="movies.php">Browse</a></li>
            <li><a class="<?= $currentPage === 'plans' ? 'active' : '' ?>" href="plans.php">Plans</a></li>
            <li><a class="<?= $currentPage === 'feedback' ? 'active' : '' ?>" href="feedback.php">Feedback</a></li>
            <li><a class="<?= $currentPage === 'faq' ? 'active' : '' ?>" href="faq.php">FAQs</a></li>
            <?php if ($username): ?>
                <li><a class="<?= $currentPage === 'profile' ? 'active' : '' ?>" href="profile.php">Profile</a></li>
                <li><a class="nav-account" href="../php/logout.php">Sign out</a></li>
            <?php else: ?>
                <li><a class="nav-account <?= $currentPage === 'login' ? 'active' : '' ?>" href="login.php">Sign in</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
