<?php
/* ============================================================
   SIDEBAR + FOOTER USER — all-in-one partial
   Sproutly | sidebar-footer-user.php

   Cara pakai:
       <?php
           $activePage = 'article';
           include 'sidebar-footer-user.php';
       ?>

   Nilai $activePage:
       'dashboard' | 'consultation' | 'article' |
       'bookmarked' | 'reviews' | 'payment' | 'settings'
   ============================================================ */

function isActiveUser(string $page): string {
    global $activePage;
    return isset($activePage) && $activePage === $page ? ' active' : '';
}
?>

<!-- ===== INLINE STYLE: SIDEBAR + FOOTER USER ===== -->
<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

.sidebar,
.sidebar *,
.site-footer,
.site-footer * {
    font-family: 'Inter', sans-serif;
}

/* ----- SIDEBAR ----- */
.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    width: 260px;
    height: 100vh;
    background: linear-gradient(180deg, #d9f1eb 0%, #d7efe9 100%);
    border-right: 1px solid #c5e2db;
    padding: 22px 16px;
    overflow-y: auto;
    transition: left 0.35s ease;
    z-index: 1000;
}

.sidebar.closed {
    left: -260px;
}

.sidebar-header {
    display: flex;
    align-items: center;
    min-height: 56px;
}

.logo-wrap {
    display: flex;
    align-items: center;
    gap: 14px;
    text-decoration: none;
}

.logo-box {
    width: 42px;
    height: 42px;
    border-radius: 12px;
    background: linear-gradient(135deg, #7ae29f, #6bded7);
    display: flex;
    align-items: center;
    justify-content: center;
}

.logo-img {
    width: 24px;
    height: 24px;
    object-fit: contain;
}

.logo-text {
    font-size: 20px;
    font-weight: 800;
    color: #169857;
}

.sidebar-line {
    height: 1px;
    background: #bedfd7;
    margin: 18px -16px 22px;
}

.sidebar-menu {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.menu-link {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 14px 18px;
    border-radius: 18px;
    color: #5e6d84;
    font-size: 15px;
    font-weight: 500;
    text-decoration: none;
    transition: background 0.25s ease, color 0.25s ease;
}

.menu-link i {
    font-size: 18px;
    width: 22px;
    text-align: center;
    flex-shrink: 0;
    color: #7a9189;
    transition: color 0.25s ease;
}

.menu-link:hover {
    background: rgba(255, 255, 255, 0.55);
}

.menu-link:hover i {
    color: #118f54;
}

.menu-link.active {
    background: #ffffff;
    color: #118f54;
    font-weight: 700;
    box-shadow: 0 8px 18px rgba(0, 0, 0, 0.06);
}

.menu-link.active i {
    color: #118f54;
}

/* ----- MAIN CONTENT offset ----- */
.main-content {
    margin-left: 260px;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    transition: margin-left 0.35s ease;
}

.main-content.full {
    margin-left: 0;
}

/* ----- FOOTER ----- */
.site-footer {
    margin-top: 34px;
    background: #f7fbf8;
    border-top: 1px solid #dce9e3;
    padding: 36px 0 0;
    border-radius: 0 0 24px 24px;
}

.footer-grid {
    display: grid;
    grid-template-columns: 1.3fr 0.8fr 1fr;
    gap: 40px;
    padding: 0 10px 30px;
}

.footer-brand-top {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 16px;
}

.footer-logo-box {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, #7ae29f, #6bded7);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.footer-logo {
    width: 28px;
    height: 28px;
    object-fit: contain;
    filter: brightness(0) invert(1);
}

.footer-brand h3 {
    font-size: 24px;
    font-weight: 800;
    color: #263928;
    margin-bottom: 4px;
}

.footer-brand span {
    color: #7b8d74;
    font-size: 14px;
}

.footer-brand p {
    color: #688160;
    font-size: 16px;
    line-height: 1.7;
    max-width: 360px;
}

.footer-links h4,
.footer-contact h4 {
    font-size: 18px;
    color: #2b3d2c;
    font-weight: 800;
    margin-bottom: 18px;
}

.footer-links a {
    display: block;
    color: #6c8467;
    margin-bottom: 18px;
    font-size: 16px;
    text-decoration: underline;
}

.footer-contact p {
    display: flex;
    align-items: center;
    gap: 12px;
    color: #6c8467;
    font-size: 16px;
    margin-bottom: 18px;
}

.footer-contact i.fa-envelope { color: #d6b7df; }
.footer-contact i.fa-phone    { color: #ff4fa6; }

.social-icons {
    display: flex;
    gap: 18px;
    margin-top: 8px;
}

.social-icons a {
    width: 58px;
    height: 58px;
    border-radius: 50%;
    background: linear-gradient(135deg, #82e49d, #69ddd7);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.social-icons img {
    width: 28px;
    height: 28px;
    object-fit: contain;
}

.footer-bottom {
    border-top: 1px solid #dce9e3;
    text-align: center;
    padding: 22px 10px;
    color: #7f9276;
    font-size: 16px;
}

/* ----- RESPONSIVE ----- */
@media (max-width: 1024px) {
    .footer-grid { grid-template-columns: 1fr; gap: 28px; }
}

@media (max-width: 768px) {
    .sidebar { left: -270px; width: 270px; }
    .sidebar.show { left: 0; }
    .sidebar.closed { left: -270px; }
    .main-content,
    .main-content.full { margin-left: 0; }
}
</style>

<!-- ===== SIDEBAR HTML ===== -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <a href="#" class="logo-wrap">
            <div class="logo-box">
                <img src="images/logo.png" alt="Sproutly Logo" class="logo-img">
            </div>
            <span class="logo-text">Sproutly</span>
        </a>
    </div>

    <div class="sidebar-line"></div>

    <nav class="sidebar-menu">
        <a href="dashboard-user.blade.php" class="menu-link<?= isActiveUser('dashboard') ?>">
            <i class="fa-solid fa-chart-line"></i>
            <span>Dashboard</span>
        </a>

        <a href="consultation.php" class="menu-link<?= isActiveUser('consultation') ?>">
            <i class="fa-solid fa-comments"></i>
            <span>Consultation</span>
        </a>

        <a href="article.php" class="menu-link<?= isActiveUser('article') ?>">
            <i class="fa-solid fa-newspaper"></i>
            <span>Article</span>
        </a>

        <a href="bookmarked.php" class="menu-link<?= isActiveUser('bookmarked') ?>">
            <i class="fa-solid fa-bookmark"></i>
            <span>Bookmarked Article</span>
        </a>

        <a href="reviews.php" class="menu-link<?= isActiveUser('reviews') ?>">
            <i class="fa-solid fa-star"></i>
            <span>Reviews</span>
        </a>

        <a href="payment.php" class="menu-link<?= isActiveUser('payment') ?>">
            <i class="fa-solid fa-credit-card"></i>
            <span>Payment</span>
        </a>

        <a href="settings.php" class="menu-link<?= isActiveUser('settings') ?>">
            <i class="fa-solid fa-gear"></i>
            <span>Setting</span>
        </a>
    </nav>
</aside>

<!-- ===== FOOTER HTML ===== -->
<footer class="site-footer">
    <div class="footer-grid">
        <div class="footer-brand">
            <div class="footer-brand-top">
                <div class="footer-logo-box">
                    <img src="images/logo.png" alt="Sproutly Logo" class="footer-logo">
                </div>
                <div>
                    <h3>Sproutly</h3>
                    <span>by AVI</span>
                </div>
            </div>
            <p>A modern agriculture consultation platform for a greener and more sustainable future.</p>
        </div>

        <div class="footer-links">
            <h4>About Us</h4>
            <a href="#">Our Team</a>
            <a href="#">Blog</a>
            <a href="#">Privacy Policy</a>
        </div>

        <div class="footer-contact">
            <h4>Contact</h4>
            <p><i class="fa-solid fa-envelope"></i> sproutly@gmail.com</p>
            <p><i class="fa-solid fa-phone"></i> +62 851 5693 2186</p>
            <div class="social-icons">
                <a href="#"><img src="images/instagram.jpg" alt="Instagram"></a>
                <a href="#"><img src="images/facebook.png" alt="Facebook"></a>
                <a href="#"><img src="images/X.jpg" alt="X"></a>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        &copy; 2025 Sproutly by AVI. All rights reserved.
    </div>
</footer>

<!-- ===== SIDEBAR TOGGLE SCRIPT ===== -->
<script>
(function () {
    const sidebar       = document.getElementById('sidebar');
    const mainContent   = document.getElementById('mainContent');
    const sidebarToggle = document.getElementById('sidebarToggle');

    if (!sidebar || !mainContent || !sidebarToggle) return;

    sidebarToggle.addEventListener('click', function () {
        if (window.innerWidth <= 768) {
            sidebar.classList.toggle('show');
        } else {
            sidebar.classList.toggle('closed');
            mainContent.classList.toggle('full');
        }
    });

    window.addEventListener('resize', function () {
        if (window.innerWidth > 768) {
            sidebar.classList.remove('show');
        } else {
            sidebar.classList.remove('closed');
            mainContent.classList.remove('full');
        }
    });
})();
</script>