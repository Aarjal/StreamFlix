<?php
require __DIR__ . '/../php/session.php';

$flash = pull_flash();
$username = current_username();
$savedUsername = trim($_COOKIE['remembered_username'] ?? '');

$pageTitle = 'StreamFlix | Login';
$currentPage = 'login';
$extraStyles = ['../styles/login.css'];
$pageDescription = 'Sign in to your StreamFlix account to access your profile, watchlist, and personalized recommendations.';
require __DIR__ . '/../php/head.php';
?>
<body class="login-page">
    <?php require __DIR__ . '/../php/nav.php'; ?>

    <main id="main-content" class="body">
        <h1>Login</h1>
        <form class="form-container" action="../php/login_handler.php" method="post">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token()) ?>">

            <?php if ($flash): ?>
                <p class="form-message <?= htmlspecialchars($flash['type']) ?>"><?= htmlspecialchars($flash['message']) ?></p>
            <?php endif; ?>

            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter username" value="<?= htmlspecialchars($savedUsername) ?>" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter password" required>
            </div>
            <div class="login-options">
                <label>
                    <input type="checkbox" name="remember_me" <?= $savedUsername !== '' ? 'checked' : '' ?>>
                    Remember username
                </label>
                <button type="button" class="text-button" data-toggle-password>Show password</button>
            </div>
            <p class="form-note">Demo login: <strong>demo / demo123</strong></p>
            <button type="submit" class="button">Login</button>
        </form>

        <p class="helper-links">New here? Start with the <a href="plans.php">Plans</a> page.</p>
    </main>

    <script src="../scripts/app.js"></script>
<?php require __DIR__ . '/../php/footer.php'; ?>
