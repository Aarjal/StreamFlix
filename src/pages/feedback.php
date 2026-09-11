<?php
require __DIR__ . '/../php/session.php';

$username = current_username();
$pageTitle = 'StreamFlix | Feedback';
$currentPage = 'feedback';
$extraStyles = ['../styles/login.css'];
require __DIR__ . '/../php/head.php';
?>
<body class="login-page" data-page="feedback">
    <?php require __DIR__ . '/../php/nav.php'; ?>
    <main id="main-content" class="body">
        <h1>Help shape StreamFlix.</h1>
        <form class="form-container" action="#" method="post" onsubmit="return false;">
            <p class="form-note">Tell us what you are enjoying, missing, or hoping we build next.</p>
            <div class="input-group"><label for="name">Name</label><input type="text" id="name" placeholder="Your name" value="<?= htmlspecialchars($username ?? '') ?>"></div>
            <div class="input-group"><label for="rating">Overall experience (1–5)</label><input type="number" id="rating" min="1" max="5" value="5"></div>
            <div class="input-group"><label for="feedback-message">Your feedback</label><textarea id="feedback-message" rows="4" maxlength="160" placeholder="Share your suggestion..."></textarea></div>
            <p class="form-note"><span id="feedback-count">0</span> / 160 characters</p>
            <button type="button" class="button" data-feedback-submit>Send feedback</button>
            <p id="feedback-status" class="form-message" style="display:none;"></p>
        </form>
    </main>
    <script src="../scripts/app.js"></script>
<?php require __DIR__ . '/../php/footer.php'; ?>
