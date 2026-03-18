<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sproutly - Account</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/style-accountUser.css') }}">
</head>
<body>

  <!-- ========================
       SIDEBAR OVERLAY
  ========================= -->
  <div class="sidebar-overlay" id="sidebarOverlay"></div>

  <!-- ========================
       SIDEBAR
  ========================= -->
  <aside class="sidebar" id="sidebar">
    <div class="sidebar-logo">
      <div class="sidebar-logo-icon">
        <img src="{{ asset('images/logo.png') }}" alt="Sproutly" />
      </div>
      <span class="sidebar-logo-name">Sproutly</span>
    </div>

    <nav class="sidebar-nav">
      <a href="#" class="sidebar-link">
        <img src="{{ asset('images/dashboard.png') }}" alt="" class="nav-icon" width="20"/>
        <span>Dashboard</span>
      </a>
      <a href="#" class="sidebar-link">
        <img src="{{ asset('images/consultation.png') }}" alt="" class="nav-icon" width="20"/>
        <span>Consultation</span>
      </a>
      <a href="#" class="sidebar-link">
        <img src="{{ asset('images/article.png') }}" alt="" class="nav-icon" width="20"/>
        <span>Article</span>
      </a>
      <a href="#" class="sidebar-link">
        <img src="{{ asset('images/bookmark article.jpg') }}" alt="" class="nav-icon" />
        <span>Bookmarked Article</span>
      </a>
      <a href="#" class="sidebar-link">
        <img src="{{ asset('images/reviews.png') }}" alt="" class="nav-icon" width="20"/>
        <span>Reviews</span>
      </a>
      <a href="#" class="sidebar-link">
        <img src="{{ asset('images/payment.png') }}" alt="" class="nav-icon" width="20"/>
        <span>Payment</span>
      </a>
      <a href="#" class="sidebar-link sidebar-link--active">
        <img src="{{ asset('images/settings.png') }}" alt="" class="nav-icon" width="20"/>
        <span>Setting</span>
      </a>
    </nav>
  </aside>

  <!-- ========================
       MAIN LAYOUT
  ========================= -->
  <div class="layout" id="layout">

    <!-- TOP NAV -->
    <header class="topnav">
      <button class="logo-btn" id="sidebarToggle" aria-label="Toggle sidebar">
        <div class="logo-btn-icon">
          <img src="{{ asset('images/logo.png') }}" alt="Sproutly" />
        </div>
      </button>
      <span class="topnav-title">Account</span>
      <div class="topnav-spacer"></div>
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
          <span class="btn-edit-icon">✏️</span> Edit Profile
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
            <a href="#" class="menu-link">
              <span class="menu-link-left">
                <span class="menu-item-icon">❓</span>
                Help Center
              </span>
              <span class="menu-arrow">›</span>
            </a>
          </li>
          <li class="menu-item">
            <a href="#" class="menu-link">
              <span class="menu-link-left">
                <span class="menu-item-icon">🛡</span>
                Privacy Policy
              </span>
              <span class="menu-arrow">›</span>
            </a>
          </li>
          <li class="menu-item">
            <a href="#" class="menu-link">
              <span class="menu-link-left">
                <span class="menu-item-icon">📄</span>
                Terms of Service
              </span>
              <span class="menu-arrow">›</span>
            </a>
          </li>
          <li class="menu-item">
            <a href="#" class="menu-link">
              <span class="menu-link-left">
                <span class="menu-item-icon">⚠️</span>
                Report a Problem
              </span>
              <span class="menu-arrow">›</span>
            </a>
          </li>
          <li class="menu-item">
            <a href="#" class="menu-link">
              <span class="menu-link-left">
                <span class="menu-item-icon">🌿</span>
                About Sproutly
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

      <!-- FOOTER -->
      <p class="page-footer">© 2024 Sproutly Platform. All rights reserved.</p>

    </main>
  </div>

  <script src="{{ asset('js/script-accountUser.js') }}"></script>
</body>
</html>