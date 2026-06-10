<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Sproutly – Home</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style-homeUser.css') }}">
</head>
<body>

<!-- SIDEBAR OVERLAY -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- SIDEBAR -->
    <aside class="sidebar closed" id="sidebar">
      <div class="sidebar-header">
        <a href="{{ url('/homeUser') }}" class="logo-wrap">
          <div class="logo-box">
            <img src="{{ asset('images/logo.png') }}" alt="Sproutly Logo" class="logo-img">
          </div>
          <span class="logo-text">Sproutly</span>
        </a>
      </div>

      <div class="sidebar-line"></div>

      <nav class="sidebar-menu">
        <a href="{{ url('/dashboard-user') }}" class="menu-link">
          <i class="fa-solid fa-chart-line"></i>
          <span>Dashboard</span>
        </a>
        <a href="{{ url('/consultationUser') }}" class="menu-link">
          <i class="fa-solid fa-comments"></i>
          <span>Consultation</span>
        </a>
        <a href="{{ url('/daftarArtikel') }}" class="menu-link">
          <i class="fa-solid fa-newspaper"></i>
          <span>Article</span>
        </a>
        <a href="{{ url('/bookmarkArtikelUser') }}" class="menu-link">
          <i class="fa-solid fa-bookmark"></i>
          <span>Bookmarked Article</span>
        </a>
        <a href="{{ url('/reviewsUser') }}" class="menu-link">
          <i class="fa-solid fa-star"></i>
          <span>Reviews</span>
        </a>
        <a href="{{ url('/invoice') }}" class="menu-link">
          <i class="fa-solid fa-credit-card"></i>
          <span>Payment</span>
        </a>
        <a href="{{ url('/accountUser') }}" class="menu-link">
          <i class="fa-solid fa-gear"></i>
          <span>Setting</span>
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

        <div class="topbar-user">
            <div class="user-avatar">
                <img src="{{ asset('images/fotoprofile.png') }}" alt="Isyana Saraswati" />
            </div>
            <a href="/accountUser" class="user-name" > 
                <span class="user-name">Isyana Saraswati</span>
            </a>
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
            <a href="{{ url('/consultationUser') }}" class="action-card action-card--primary">
                <div class="action-card-icon">
                    <img src="{{ asset('images/consultation.png') }}" alt="" width="26"/>
                </div>
                <div class="action-card-body">
                    <h3 class="action-card-title">New Consultation <span class="action-arrow">→</span></h3>
                    <p class="action-card-desc">Start a consultation session with an agricultural expert to get the best solution.</p>
                </div>
            </a>
            <a href="{{ url('/daftarArtikel') }}" class="action-card action-card--secondary">
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
                <a href="/detailArtikelUser" class="article-card">
                    <div class="article-img-wrap">
                        <img src="{{ asset('images/cover-artikel1.jpg') }}" alt="Hidroponik" class="article-img"/>
                    </div>
                    <div class="article-info">
                        <p class="article-title">Tips Hidroponik untuk Pemula</p>
                    </div>
                </a>
                <a href="/detailArtikelUser" class="article-card">
                    <div class="article-img-wrap">
                        <img src="{{ asset('images/cover-artikel2.jpg') }}" alt="Pupuk Organik" class="article-img"/>
                    </div>
                    <div class="article-info">
                        <p class="article-title">Pupuk Organik Terbaik untuk Tanaman</p>
                    </div>
                </a>
                <a href="/detailArtikelUser" class="article-card">
                    <div class="article-img-wrap">
                        <img src="{{ asset('images/cover-artikel3.jpg') }}" alt="Hama Tanaman" class="article-img"/>
                    </div>
                    <div class="article-info">
                        <p class="article-title">Cara Mengatasi Hama Tanaman</p>
                    </div>
                </a>
                <a href="/detailArtikelUser" class="article-card">
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

    <footer class="site-footer">
        <div class="footer-grid">
          <div class="footer-brand">
            <div class="footer-brand-top">
              <div class="footer-logo-box">
                <img src="{{ asset('images/logo.png') }}" alt="Sproutly Logo" class="footer-logo">
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
              <a href="#"><img src="{{ asset('images/instagram.jpg') }}" alt="Instagram"></a>
              <a href="#"><img src="{{ asset('images/facebook.png') }}" alt="Facebook"></a>
              <a href="#"><img src="{{ asset('images/X.jpg') }}" alt="X"></a>
            </div>
          </div>
        </div>
        <div class="footer-bottom">
          &copy; 2025 Sproutly by AVI. All rights reserved.
        </div>
      </footer>

</div>

<script src="{{ asset('js/script-homeUser.js') }}"></script>
</body>
</html>