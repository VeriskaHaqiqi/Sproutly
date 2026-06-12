<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sproutly - Account</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <!-- Font Awesome — untuk icon sidebar -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <link rel="stylesheet" href="{{ asset('css/style-accountUser.css') }}">
</head>
<body>

  <!-- ========================
       SIDEBAR OVERLAY
  ========================= -->
  <!-- Sidebar Overlay -->
  <div class="sidebar-overlay" id="sidebarOverlay"></div>

  <!-- ===== SIDEBAR ===== -->
  <aside class="sidebar closed" id="sidebar">
    <div class="sidebar-header">
      <a href="{{ url('/homeUser') }}" class="logo-wrap">
        <div class="logo-box">
          <!-- Pastikan file logo-hijau.png ada di folder public/images -->
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
      <a href="{{ url('/accountUser') }}" class="menu-link active">
        <i class="fa-solid fa-gear"></i>
        <span>Setting</span>
      </a>
    </nav>
  </aside>

  <!-- ========================
       MAIN LAYOUT
  ========================= -->
  <div class="layout" id="mainContent">

    <!-- TOP NAV -->
    <header class="topnav">
      <button class="burger-btn" id="sidebarToggle" aria-label="Toggle sidebar">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <div class="topnav-title">
        <h1>Account</h1>
      </div>
    </header>

    <!-- PAGE BODY -->
    <main class="page-body">

      <!-- ========================
           PROFILE CARD
      ========================= -->
      <div class="account-card profile-card">
        <div class="profile-left">
          <div class="avatar-wrap">
            <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Sarah Johnson" class="avatar-img" />
            <span class="avatar-badge">✏️</span>
          </div>
          <div class="profile-info">
            <h2 class="profile-name">Sarah Johnson</h2>
            <p class="profile-meta">
              <span class="meta-icon">✉</span> sarah.johnson@example.com
            </p>
            <p class="profile-meta">
              <span class="meta-icon">📞</span> +1 (555) 123-4567
            </p>
          </div>
        </div>
        <button class="btn-edit-profile">
          <a href="{{ route('editProfileUser') }}">Edit Profile</a>
        </button>
      </div>

      <!-- ========================
           PAYMENT & BILLING
      ========================= -->
      <div class="account-card">
        <div class="section-header">
          <div class="section-icon section-icon--teal">💳</div>
          <h3 class="section-title">Payment &amp; Billing</h3>
        </div>
        <ul class="menu-list">
          <li class="menu-item">
            <a href="#" class="menu-link">
              <span class="menu-link-left">
                <span class="menu-item-icon">💳</span>
                Payment Methods
              </span>
              <span class="menu-arrow">›</span>
            </a>
          </li>
          <li class="menu-item">
            <a href="#" class="menu-link">
              <span class="menu-link-left">
                <span class="menu-item-icon">🕒</span>
                Payment History
              </span>
              <span class="menu-arrow">›</span>
            </a>
          </li>
        </ul>
      </div>

      <!-- ========================
           SUPPORT & INFO
      ========================= -->
      <div class="account-card">
        <div class="section-header">
          <div class="section-icon section-icon--sky">ℹ️</div>
          <h3 class="section-title">Support &amp; Info</h3>
        </div>
        <ul class="menu-list">
          <li class="menu-item">
            <a href="/supportUser" class="menu-link">
              <span class="menu-link-left">
                <span class="menu-item-icon">❓</span>
                Support & Info
              </span>
              <span class="menu-arrow">›</span>
            </a>
          </li>
        </ul>
      </div>

      <!-- ======================== 
           REPUTATION
      ========================= -->
      <div class="account-card">
        <div class="section-header">
          <div class="section-icon section-icon--yellow">⭐</div>
          <h3 class="section-title">Reputation</h3>
        </div>
        <ul class="menu-list">
          <li class="menu-item">
            <a href="#" class="menu-link">
              <span class="menu-link-left">
                <span class="menu-item-icon">📋</span>
                Ratings List
              </span>
              <span class="menu-link-right">
                <span class="star-rating">★★★★★</span>
                <span class="menu-arrow menu-arrow--yellow">›</span>
              </span>
            </a>
          </li>
        </ul>
      </div>

      <!-- ========================
           LOG OUT
      ========================= -->
      <div class="account-card logout-card">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">
                <span class="logout-icon">↗</span> Log Out
            </button>
        </form>
      </div>
    </main>
  </div>
  <!-- Footer -->
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

  <script src="{{ asset('js/script-accountUser.js') }}"></script>
</body>
</html>