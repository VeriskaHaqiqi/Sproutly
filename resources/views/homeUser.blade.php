<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sproutly by AVI – Dashboard</title>
  <link rel="stylesheet" href="dashboard.css" />
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Lora:ital,wght@1,600&display=swap" rel="stylesheet" />
</head>
<body>

  <!-- SIDEBAR -->
  <aside class="sidebar">
    <div class="sidebar-brand">
      <div class="brand-logo">🌱</div>
      <div class="brand-text">
        <span class="brand-name">Sproutly</span>
        <span class="brand-sub">by AVI</span>
      </div>
    </div>

    <nav class="sidebar-nav">
      <a href="dashboard-user.html" class="nav-item active">
        <span class="nav-icon">🏠</span>
        <span>Dashboard</span>
      </a>
      <a href="consultation-user.html" class="nav-item">
        <span class="nav-icon">💬</span>
        <span>Consultations</span>
      </a>
      <a href="#" class="nav-item">
        <span class="nav-icon">📄</span>
        <span>Articles</span>
      </a>
      <a href="#" class="nav-item">
        <span class="nav-icon">🔖</span>
        <span>Bookmarked Articles</span>
      </a>
      <a href="#" class="nav-item">
        <span class="nav-icon">⭐</span>
        <span>Reviews</span>
      </a>
      <a href="#" class="nav-item">
        <span class="nav-icon">⚙️</span>
        <span>Payment</span>
      </a>
      <a href="#" class="nav-item">
        <span class="nav-icon">⚙️</span>
        <span>Settings</span>
      </a>
    </nav>

    <!-- Sidebar decorative blobs -->
    <div class="sidebar-blob blob-top"></div>
    <div class="sidebar-blob blob-bottom"></div>
    <div class="sidebar-leaf">🌱</div>
  </aside>

  <!-- MAIN CONTENT -->
  <div class="main-wrapper">

    <!-- TOP NAVBAR -->
    <header class="topbar">
    <button class="hamburger" id="hamburger" aria-label="Toggle menu">☰</button>
      <div class="topbar-brand">
        <a href="homeUser.html"
            <div class="brand-logo small">🌱</div>
            <div class="brand-text">
                <span class="brand-name">Sproutly</span>
                <span class="brand-sub">by AVI</span>
            </div>
        </a>
      </div>
      <div class="topbar-user">
        <a href="setting.html" class="topbar-user"
            <span class="user-name">Sarah Green</span>
            <div class="user-avatar">
            <img src="https://i.pravatar.cc/40?img=47" alt="Sarah Green" />
            </div>
        </a>
      </div>
    </header>

    <!-- PAGE CONTENT -->
    <main class="content">

      <!-- WELCOME CARD -->
      <div class="welcome-card">
        <h1 class="welcome-title">Hallo, Sarah!</h1>
        <p class="welcome-desc">
          Welcome back to Sproutly! Today is the perfect day<br />
          to take care of your plants and consult with experts.
        </p>
      </div>

    <!-- QUICK ACTION CARDS -->
    <div class="action-grid">
        <a href="consultation-user.html" class="action-card action-teal">
            <div class="action-left">
                <div class="action-icon">💬</div>
                <div>
                    <h3>New Consultations</h3>
                    <p>Start a consultation session with an agricultural expert to get the best solution.</p>
                </div>
            </div>
        </a>
        <a href="article.html" class="action-card action-teal">
            <div class="action-left">
                <div class="action-icon">📖</div>
                <div>
                    <h3>Read Articles</h3>
                    <p>Explore the latest articles on modern farming tips and tricks.</p>
                </div>
            </div>
            <button class="action-arrow">→</button>
        </a>
    </div>

      <!-- ARTIKEL REKOMENDASI -->
      <div class="articles-card">
        <h2 class="articles-title">Read to Enhance Your Knowledge</h2>
        <div class="articles-grid">

          <a href="#" class="article-item"> 
            <div class="article-thumb" style="background: linear-gradient(135deg,#86efac,#16a34a)">
              <span>🌿</span>
            </div>
            <p>Tips Hidroponik untuk Pemula</p>
          </a> 

          <a href="#" class="article-item">
            <div class="article-thumb" style="background: linear-gradient(135deg,#fde68a,#92400e)">
              <span>🌱</span>
            </div>
            <p>Pupuk Organik Terbaik untuk Tanaman</p>
          </a>

          <a href="#" class="article-item">
            <div class="article-thumb" style="background: linear-gradient(135deg,#fed7aa,#f59e0b)">
              <span>🐛</span>
            </div>
            <p>Cara Mengatasi Hama Tanaman</p>
          </a>

          <a href="#" class="article-item">
            <div class="article-thumb" style="background: linear-gradient(135deg,#bfdbfe,#3b82f6)">
              <span>🤖</span>
            </div>
            <p>Teknologi Smart Farming</p>
          </a>

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

  <script src="homeUser.js"></script>
</body>
</html>