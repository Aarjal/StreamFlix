<?php
require __DIR__ . '/../php/session.php';

$username = current_username();
$pageTitle = 'StreamFlix | FAQs';
$currentPage = 'faq';
$extraStyles = ['../styles/plans.css'];
require __DIR__ . '/../php/head.php';
?>
<body class="plans-page" data-page="faq">
    <?php require __DIR__ . '/../php/nav.php'; ?>

    <main id="main-content" class="plans-section faq-layout">
        <h1>Frequently Asked Questions</h1>
        <p class="subtitle">Quick answers about plans, login, and streaming features.</p>

        <div class="faq-list">
            <details>
                <summary>Can I change my plan later?</summary>
                <p>Yes, you can upgrade or downgrade your plan from the Plans page anytime.</p>
            </details>
            <details>
                <summary>Do you support multiple devices?</summary>
                <p>Yes, Standard and Premium plans support simultaneous streaming on multiple devices.</p>
            </details>
            <details>
                <summary>How do I report a problem?</summary>
                <p>Use the Feedback page from the More menu and submit your issue details.</p>
            </details>
        </div>
    </main>

    <script src="../scripts/app.js"></script>
</body>
</html>
