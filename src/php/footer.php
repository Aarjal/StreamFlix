<?php
/**
 * Shared footer component
 */
?>
<footer class="site-footer" role="contentinfo">
    <div class="footer-inner">
        <div class="footer-brand">
            <a class="brand" href="home.php" aria-label="StreamFlix home">
                <span class="brand-mark" aria-hidden="true">&#9656;</span>
                <span>STREAMFLIX</span>
            </a>
            <p class="footer-tagline">Stories that stay with you.</p>
        </div>

        <nav class="footer-nav" aria-label="Footer navigation">
            <div class="footer-nav-group">
                <h3>Browse</h3>
                <ul>
                    <li><a href="movies.php">All Movies</a></li>
                    <li><a href="movies.php">New Releases</a></li>
                    <li><a href="movies.php">Popular</a></li>
                    <li><a href="movies.php">Genres</a></li>
                </ul>
            </div>
            <div class="footer-nav-group">
                <h3>Account</h3>
                <ul>
                    <li><a href="login.php">Sign In</a></li>
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="plans.php">Plans & Pricing</a></li>
                    <li><a href="feedback.php">Feedback</a></li>
                </ul>
            </div>
            <div class="footer-nav-group">
                <h3>Help</h3>
                <ul>
                    <li><a href="faq.php">FAQs</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms of Use</a></li>
                    <li><a href="#">Cookie Policy</a></li>
                </ul>
            </div>
            <div class="footer-nav-group">
                <h3>Company</h3>
                <ul>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Press</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
        </nav>

        <div class="footer-bottom">
            <p class="copyright">&copy; <?= date('Y') ?> StreamFlix. All rights reserved.</p>
            <div class="footer-social" aria-label="Social links">
                <a href="#" aria-label="StreamFlix on Twitter">&#x1F426;</a>
                <a href="#" aria-label="StreamFlix on Facebook">&#x1F310;</a>
                <a href="#" aria-label="StreamFlix on Instagram">&#x1F4F7;</a>
                <a href="#" aria-label="StreamFlix on YouTube">&#x25B6;&#xFE0F;</a>
            </div>
        </div>
    </div>
</footer>
</body>
</html>