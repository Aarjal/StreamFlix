<?php
require __DIR__ . '/../php/session.php';
$username = current_username();

$pageTitle = 'StreamFlix | Plans';
$currentPage = 'plans';
$extraStyles = ['../styles/plans.css'];
require __DIR__ . '/../php/head.php';
?>
<body class="plans-page" data-page="plans">
    <?php require __DIR__ . '/../php/nav.php'; ?>

    <section id="main-content" class="plans-section">
        <h1>Choose Your Plan</h1>
        <p class="subtitle">Flexible billing with simple pricing for every type of viewer.</p>

        <div class="billing-toggle" role="group" aria-label="Billing period switch">
            <button class="billing-button active" type="button" data-billing="monthly">Monthly</button>
            <button class="billing-button" type="button" data-billing="yearly">Yearly (Save 20%)</button>
        </div>

        <div class="plans-container">
            <div class="plan-card">
                <h2>Basic</h2>
                <p class="price" data-monthly="&#8377;99/month" data-yearly="&#8377;950/year">&#8377;99/month</p>
                <ul>
                    <li>Access to limited content</li>
                    <li>Standard Quality</li>
                    <li>1 Device at a time</li>
                </ul>
                <a href="#" class="buy-now" data-plan-button data-plan="Basic">Buy Now</a>
            </div>

            <div class="plan-card highlighted">
                <span class="badge">Most Popular</span>
                <h2>Standard</h2>
                <p class="price" data-monthly="&#8377;199/month" data-yearly="&#8377;1910/year">&#8377;199/month</p>
                <ul>
                    <li>Access to all content</li>
                    <li>HD Quality</li>
                    <li>2 Devices simultaneously</li>
                </ul>
                <a href="#" class="buy-now" data-plan-button data-plan="Standard">Buy Now</a>
            </div>

            <div class="plan-card">
                <h2>Premium</h2>
                <p class="price" data-monthly="&#8377;299/month" data-yearly="&#8377;2870/year">&#8377;299/month</p>
                <ul>
                    <li>All content unlocked</li>
                    <li>4K Ultra HD + HDR</li>
                    <li>4 Devices simultaneously</li>
                </ul>
                <a href="#" class="buy-now" data-plan-button data-plan="Premium">Buy Now</a>
            </div>
        </div>
        <p id="plan-message" class="status-text" aria-live="polite"></p>
    </section>

    <script src="../scripts/app.js"></script>
</body>
</html>
