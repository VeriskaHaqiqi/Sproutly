<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Sproutly – Home</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style-homeUser.css') }}">
</head>
<body>

<!-- SIDEBAR OVERLAY -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- SIDEBAR -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-top">
        <a href="{{ url('/home') }}" class="brand-wrap">
            <div class="brand-logo-box">
                <img src="{{ asset('images/logo.png') }}" alt="Sproutly Logo">
            </div>
            <span class="brand-text">Sproutly</span>
        </a>
    </div>

    <div class="sidebar-divider"></div>

    <nav class="sidebar-menu" id="sidebarMenu">
        <a href="{{ url('dashboard-user') }}"
           class="menu-item {{ request()->is('dashboard-user') ? 'active' : '' }}">
            <span class="menu-icon">
                <img src="{{ asset('images/dashboard.png') }}" alt="Dashboard">
            </span>
            <span class="menu-label">Dashboard</span>
        </a>

        <a href="{{ url('consultationUser') }}"
           class="menu-item {{ request()->is('consultationUser*') ? 'active' : '' }}">
            <span class="menu-icon">
                <img src="{{ asset('images/consultation.png') }}" alt="Consultation">
            </span>
            <span class="menu-label">Consultation</span>
        </a>

        <a href="{{ url('daftarArtikel') }}"
           class="menu-item {{ request()->is('daftarArtikel*') ? 'active' : '' }}">
            <span class="menu-icon">
                <img src="{{ asset('images/article.png') }}" alt="Article">
            </span>
            <span class="menu-label">Article</span>
        </a>

        <a href="{{ url('bookmarkArtikelUser') }}"
           class="menu-item {{ request()->is('bookmarkArtikelUser*') ? 'active' : '' }}">
            <span class="menu-icon">
                <img src="{{ asset('images/bookmark article.jpg') }}" alt="Bookmarked Article">
            </span>
            <span class="menu-label">Bookmarked Article</span>
        </a>

        <a href="{{ url('/reviews') }}"
           class="menu-item {{ request()->is('reviews*') ? 'active' : '' }}">
            <span class="menu-icon">
                <img src="{{ asset('images/reviews.png') }}" alt="Reviews">
            </span>
            <span class="menu-label">Reviews</span>
        </a>

        <a href="{{ url('paymentUser') }}"
           class="menu-item {{ request()->is('paymentUser*') ? 'active' : '' }}">
            <span class="menu-icon">
                <img src="{{ asset('images/payment.png') }}" alt="Payment">
            </span>
            <span class="menu-label">Payment</span>
        </a>

        <a href="{{ url('accountUser') }}"
           class="menu-item {{ request()->is('accountUser*') ? 'active' : '' }}">
            <span class="menu-icon">
                <img src="{{ asset('images/settings.png') }}" alt="Setting">
            </span>
            <span class="menu-label">Setting</span>
        </a>
    </nav>
</aside>

<!-- MAIN CONTENT -->
<div class="page-wrapper" id="pageWrapper">

    <!-- TOPBAR -->
    <header class="topbar">
        <button class="hamburger-btn" id="hamburgerBtn" aria-label="Toggle Sidebar">
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
        </button>

        <div class="topbar-logo">
            <a href="{{ url('/home') }}" class="topbar-logo-link">
                <div class="topbar-logo-icon">
                    <img src="{{ asset('images/logo.png') }}" alt="Sproutly" />
                </div>
                <span class="topbar-logo-name">Sproutly</span>
            </a>
        </div>

        <div class="topbar-user">
            <div class="user-avatar">
                <img src="{{ asset('images/fotoprofile.png') }}" alt="Isyana Saraswati" />
            </div>
            <span class="user-name">Isyana Saraswati</span>
        </div>
    </header>

    <!-- MAIN -->
    <main class="main-content">

        <!-- GREETING BANNER -->
        <section class="greeting-banner">
            <div class="greeting-text">
                <h1 class="greeting-title">
                    Hallo, Sarah! <span class="greeting-emoji">👋</span>
                </h1>
                <p class="greeting-desc">Welcome back to Sproutly! Today is a great day to learn about plant care and consult with the experts.</p>
            </div>
            <div class="greeting-date-badge">
                <span class="greeting-date-dot"></span>
                <span id="greetingDate">Today</span>
            </div>
            <div class="greeting-decoration"></div>
        </section>

        <!-- ACTION CARDS -->
        <section class="action-cards">
            <a href="{{ url('/consultation/new') }}" class="action-card action-card--primary">
                <div class="action-card-icon">
                    <img src="{{ asset('images/consultation.png') }}" alt="" width="26"/>
                </div>
                <div class="action-card-body">
                    <h3 class="action-card-title">New Consultation <span class="action-arrow">→</span></h3>
                    <p class="action-card-desc">Start a consultation session with an agricultural expert to get the best solution.</p>
                </div>
            </a>
            <a href="{{ url('/article') }}" class="action-card action-card--secondary">
                <div class="action-card-icon">
                    <img src="{{ asset('images/article.png') }}" alt="" width="26"/>
                </div>
                <div class="action-card-body">
                    <h3 class="action-card-title">Read Article <span class="action-arrow">→</span></h3>
                    <p class="action-card-desc">Explore the latest articles on modern farming tips and tricks.</p>
                </div>
            </a>
        </section>

        <!-- RECOMMENDED ARTICLES -->
        <section class="articles-section">
            <div class="articles-header">
                <h2 class="section-title">Artikel Rekomendasi</h2>
                <a href="{{ url('daftarArtikel') }}" class="articles-view-all">Lihat Semua →</a>
            </div>
            <div class="articles-grid">
                <a href="#" class="article-card">
                    <div class="article-img-wrap">
                        <img src="{{ asset('images/cover-artikel1.jpg') }}" alt="Hidroponik" class="article-img"/>
                    </div>
                    <div class="article-info">
                        <p class="article-title">Tips Hidroponik untuk Pemula</p>
                    </div>
                </a>
                <a href="#" class="article-card">
                    <div class="article-img-wrap">
                        <img src="{{ asset('images/cover-artikel2.jpg') }}" alt="Pupuk Organik" class="article-img"/>
                    </div>
                    <div class="article-info">
                        <p class="article-title">Pupuk Organik Terbaik untuk Tanaman</p>
                    </div>
                </a>
                <a href="#" class="article-card">
                    <div class="article-img-wrap">
                        <img src="{{ asset('images/cover-artikel3.jpg') }}" alt="Hama Tanaman" class="article-img"/>
                    </div>
                    <div class="article-info">
                        <p class="article-title">Cara Mengatasi Hama Tanaman</p>
                    </div>
                </a>
                <a href="#" class="article-card">
                    <div class="article-img-wrap">
                        <img src="{{ asset('images/cover-artikel4.jpg') }}" alt="Smart Farming" class="article-img"/>
                    </div>
                    <div class="article-info">
                        <p class="article-title">Teknologi Smart Farming</p>
                    </div>
                </a>
            </div>
        </section>

    </main>

    <footer>
        <div class="footer-grid">
            <div class="footer-brand">
                <div class="nav-logo">
                    <div class="logo-icon">
                        <img src="{{ asset('images/logo-hijau.png') }}" alt="logo" width="20">
                    </div>
                    <div>
                        Sproutly
                        <small>by AVI</small>
                    </div>
                </div>
                <p>A modern agriculture consultation platform for a greener and more sustainable future.</p>
            </div>

            <div class="footer-col">
                <h5>About Us</h5>
                <ul>
                    <li><a href="#">Our Tim</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Privacy and Policy</a></li>
                </ul>
            </div>

            <div class="footer-col footer-contact">
                <h5>Contact</h5>
                <p>✉️ sproutly@gmail.com</p>
                <p>📞 +62 851 5693 2186</p>
                <div class="social-links">
                    <a href="#" title="Instagram">
                        <img src="{{ asset('images/instagram.jpg') }}" width="16">
                    </a>
                    <a href="#" title="Facebook">
                        <img src="{{ asset('images/facebook.png') }}" width="16">
                    </a>
                    <a href="#" title="X">
                        <img src="{{ asset('images/X.jpg') }}" width="16">
                    </a>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            © 2025 Sproutly by AVI. All rights reserved.
        </div>
    </footer>

</div>

<script src="{{ asset('js/script-homeUser.js') }}"></script>
</body>
</html>