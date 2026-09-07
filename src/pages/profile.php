<?php
require __DIR__ . '/../php/session.php';

$username = current_username();
if (!$username) {
    set_flash('error', 'Please login first to view your profile.');
    header('Location: login.php');
    exit;
}

$pageTitle = 'StreamFlix | Profile';
$currentPage = 'profile';
$extraStyles = [];
require __DIR__ . '/../php/head.php';
?>
<body class="home-page">
    <?php require __DIR__ . '/../php/nav.php'; ?>

    <main id="main-content" class="hero">
        <h1>Your Profile</h1>
        <p>Welcome back, <strong><?= htmlspecialchars($username) ?></strong>.</p>
        <p class="status-text">Account type: Demo User • Watchlist: Coming soon</p>
        <a class="button" href="movies.php">Go to Movies</a>
    </main>
</body>
</html>
