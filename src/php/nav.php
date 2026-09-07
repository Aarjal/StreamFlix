<?php $currentPage = $currentPage ?? ''; ?>
<header>
    <nav class="main-nav" aria-label="Main navigation">
        <ul>
            <li><a class="<?= $currentPage === 'home' ? 'active' : '' ?>" href="home.php">Home</a></li>
            <li><a class="<?= $currentPage === 'plans' ? 'active' : '' ?>" href="plans.php">Plans</a></li>
            <li><a class="<?= $currentPage === 'movies' ? 'active' : '' ?>" href="movies.php">Movies</a></li>
            <?php if ($username): ?>
                <li><a href="../php/logout.php">Logout</a></li>
            <?php else: ?>
                <li><a class="<?= $currentPage === 'login' ? 'active' : '' ?>" href="login.php">Login</a></li>
            <?php endif; ?>
            <li class="last"><a href="#">More ⮟</a>
                <ul class="dropdown">
                    <li><a class="<?= $currentPage === 'profile' ? 'active' : '' ?>" href="profile.php">Profile</a></li>
                    <li><a class="<?= $currentPage === 'feedback' ? 'active' : '' ?>" href="feedback.php">Feedback</a></li>
                    <li><a class="<?= $currentPage === 'faq' ? 'active' : '' ?>" href="faq.php">FAQs</a></li>
                    <?php if ($username): ?>
                        <li><a href="../php/logout.php">Sign Out</a></li>
                    <?php else: ?>
                        <li><a href="login.php">Sign In</a></li>
                    <?php endif; ?>
                </ul>
            </li>
        </ul>
    </nav>
</header>
