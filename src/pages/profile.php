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
$extraStyles = ['../styles/account.css'];
require __DIR__ . '/../php/head.php';
?>
<body class="account-page">
    <?php require __DIR__ . '/../php/nav.php'; ?>
    <main id="main-content" class="account-shell">
        <header class="account-intro"><p class="eyebrow">Your account</p><h1>Welcome back, <?= htmlspecialchars($username) ?>.</h1><p>Everything you need for your next movie night, in one place.</p></header>
        <section class="account-grid" aria-label="Account overview">
            <article class="account-card account-card-primary"><span class="account-avatar" aria-hidden="true"><?= htmlspecialchars(strtoupper(substr($username, 0, 1))) ?></span><div><p class="account-label">Profile</p><h2><?= htmlspecialchars($username) ?></h2><p>Demo member</p></div><a class="text-link" href="../php/logout.php">Sign out <span aria-hidden="true">&#8594;</span></a></article>
            <article class="account-card"><p class="account-label">Watchlist</p><h2>Coming soon</h2><p>Save a title and pick up right where you left off.</p><a class="button button-ghost" href="movies.php">Browse titles</a></article>
            <article class="account-card"><p class="account-label">Membership</p><h2>Find your fit</h2><p>Explore plans for solo watching, sharing, and more.</p><a class="button button-ghost" href="plans.php">View plans</a></article>
        </section>
    </main>
<?php require __DIR__ . '/../php/footer.php'; ?>
