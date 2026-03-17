<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sproutly by AVI – Expert Dashboard</title>
  <link rel="stylesheet" href="expert.css" />
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
</head>
<body>

  <!-- ===================== SIDEBAR ===================== -->
  <aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
      <div class="brand-logo">🌱</div>
      <div class="brand-text">
        <span class="brand-name">Sproutly</span>
        <span class="brand-sub">by AVI</span>
      </div>
    </div>

    <nav class="sidebar-nav">
      <a href="dashboard-ahli.html" class="nav-item active" data-label="Dashboard">
        <span class="nav-icon">🏠</span>
        <span>Dashboard</span>
      </a>
      <a href="#" class="nav-item" data-label="Bookmarked Articles">
        <span class="nav-icon">🔖</span>
        <span>Consultation</span>
      </a>
      <a href="manage-articles.html" class="nav-item" data-label="Articles">
        <span class="nav-icon">📄</span>
        <span>Manage Articles</span>
      </a>
      <a href="profile-expert.html" class="nav-item" data-label="Consultations">
        <span class="nav-icon">💬</span>
        <span>My Profile</span>
      </a>
      <a href="#" class="nav-item" data-label="Reviews">
        <span class="nav-icon">⭐</span>
        <span>History</span>
      </a>
      <a href="#" class="nav-item" data-label="Settings">
        <span class="nav-icon">⚙️</span>
        <span>Settings</span>
      </a>
    </nav>

    <div class="sidebar-blob blob-top"></div>
    <div class="sidebar-blob blob-bottom"></div>
    <div class="sidebar-deco-leaf">🌱</div>
  </aside>

  <!-- ===================== MAIN ===================== -->
  <div class="main-wrapper">

    <!-- TOPBAR -->
    <header class="topbar">
      <button class="hamburger" id="hamburger" aria-label="Toggle menu">☰</button>
      <a href="homeExpert.html" class="topbar-brand">
        <div class="brand-logo small">🌱</div>
        <div class="brand-text">
          <span class="brand-name">Sproutly</span>
          <span class="brand-sub">by AVI</span>
        </div>
      </a>

      <a href="profile-expert.html" class="topbar-user">
        <span class="user-name">Sarah Green</span>
        <div class="user-avatar">
          <img src="https://i.pravatar.cc/40?img=47" alt="Sarah Green" />
        </div>
      </a>
    </header>

    <!-- PAGE CONTENT -->
    <main class="content">

      <!-- WELCOME CARD -->
      <div class="welcome-card reveal">
        <h1 class="welcome-title">Hallo, Ms. Sarah!</h1>
        <p class="welcome-desc">Ready to help Indonesian farmers achieve the best harvest today?</p>
      </div>

      <!-- ACTION CARDS -->
      <div class="action-grid">

        <div class="action-card reveal" style="--delay:0.1s">
          <div class="action-icon-wrap icon-lime">
            <span>✏️</span>
          </div>
          <h3 class="action-title">Write an Article</h3>
          <p class="action-desc">Share the agricultural knowledge and tips to help many people</p>
          <button class="btn btn-lime" onclick="window.location.href='#'" >Mulai Menulis</button>
        </div>

        <div class="action-card reveal" style="--delay:0.18s">
          <div class="action-icon-wrap icon-teal">
            <span>📅</span>
          </div>
          <h3 class="action-title">Set Schedule</h3>
          <p class="action-desc">Manage consultation schedules and mentoring sessions with people in need.</p>
          <button class="btn-cta btn-white" onclick="window.location.href='#'">Atur Jadwal</button>
        </div>

      </div>

      <!-- FOOTER -->
      <footer class="footer">
        <div class="footer-inner">
          <div class="footer-brand">
            <div class="footer-brand-head">
              <div class="brand-logo small">🌱</div>
              <span class="brand-name">Sproutly by AVI</span>
            </div>
            <p>A leading agricultural consulting platform that connects farmers with experienced agricultural experts.</p>
          </div>

          <div class="footer-col">
            <h4>Features</h4>
            <ul>
              <li><a href="consultation.html">Konsultasi Online</a></li>
              <li><a href="article.html">Artikel Pertanian</a></li>
            </ul>
          </div>

          <div class="footer-col">
            <h4>Kontak</h4>
            <ul>
              <li>• Email: sproutly@gmail.com</li>
              <li>• Telepon: +62 851 5693 2186</li>
              <li>• Alamat: Surabaya Indonesia</li>
            </ul>
          </div>
        </div>

        <div class="footer-bottom">
          <p>© 2026 Sproutly by AVI. Semua hak dilindungi.</p>
        </div>
      </footer>

    </main>
  </div>

  <!-- Mobile overlay -->
  <div class="sidebar-overlay" id="overlay"></div>

  <script src="expert.js"></script>
</body>
</html>