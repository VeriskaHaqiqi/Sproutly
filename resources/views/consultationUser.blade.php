<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sproutly - Consultation</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/style-consultationUser.css') }}">
</head>
<body>
<div class="dashboard-page">

  <!-- SIDEBAR — copy persis dari dashboard-user -->
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
      <a href="{{ url('/dashboard-user') }}"    class="menu-link"><i class="fa-solid fa-chart-line"></i><span>Dashboard</span></a>
      <a href="{{ url('/consultationUser') }}"  class="menu-link active"><i class="fa-solid fa-comments"></i><span>Consultation</span></a>
      <a href="{{ url('/daftarArtikel') }}"     class="menu-link"><i class="fa-solid fa-newspaper"></i><span>Article</span></a>
      <a href="{{ url('/bookmarkArtikelUser') }}" class="menu-link"><i class="fa-solid fa-bookmark"></i><span>Bookmarked Article</span></a>
      <a href="{{ url('/reviewsUser') }}"       class="menu-link"><i class="fa-solid fa-star"></i><span>Reviews</span></a>
      <a href="{{ url('/invoice') }}"           class="menu-link"><i class="fa-solid fa-credit-card"></i><span>Payment</span></a>
      <a href="{{ url('/supportUser') }}"       class="menu-link"><i class="fa-solid fa-gear"></i><span>Setting</span></a>
    </nav>
  </aside>

  <!-- MAIN — copy persis dari dashboard-user -->
  <main class="main-content full" id="mainContent">

    <!-- TOPBAR -->
    <header class="topbar">
      <div class="topbar-left">
        <button class="menu-toggle" id="menuToggle" type="button" aria-label="Toggle sidebar">
          <svg viewBox="0 0 24 24" fill="none">
            <path d="M4 7H20" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/>
            <path d="M4 12H20" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/>
            <path d="M4 17H20" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/>
          </svg>
        </button>
      </div>
      <div class="topbar-right">
        <button class="notif-btn" type="button" aria-label="Notifications">
          <svg viewBox="0 0 24 24" fill="none">
            <path d="M8 18H16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            <path d="M10 20C10.5 21 11.1 21.5 12 21.5C12.9 21.5 13.5 21 14 20" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            <path d="M18 17H6C6.9 16.2 7.5 15 7.5 13.8V10.8C7.5 8.2 9.4 6 12 6C14.6 6 16.5 8.2 16.5 10.8V13.8C16.5 15 17.1 16.2 18 17Z" fill="currentColor"/>
          </svg>
        </button>
        <a href="{{ url('/accountUser') }}" class="profile-chip">
          <span class="profile-name">Sarah Green</span>
          <img src="{{ asset('images/fotoprofile.png') }}" alt="Profile">
        </a>
      </div>
    </header>

    <!-- CONTENT WRAP — sama struktur dengan dashboard-user -->
    <section class="content-wrap">

      <!-- Page intro -->
      <div class="consultation-header">
        <div class="consultation-header-left">
          <p class="consultation-desc">Connect with agricultural experts for personalized advice</p>
          <div class="search-box">
            <span class="search-icon">
              <svg viewBox="0 0 24 24" fill="none">
                <circle cx="11" cy="11" r="6.5" stroke="currentColor" stroke-width="2.2"/>
                <path d="M16 16L20 20" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
              </svg>
            </span>
            <input type="text" id="conversationSearch" placeholder="Search conversations..." />
          </div>
        </div>
        <div class="consultation-header-right">
          <div class="status-tabs" id="statusTabs">
            <button class="status-tab active" data-status="active" type="button">Active</button>
            <button class="status-tab" data-status="completed" type="button">Completed</button>
          </div>
        </div>
      </div>

      <!-- Chat list -->
      <div class="conversation-card">
        <div class="conversation-list" id="conversationList"></div>

        <div class="empty-state hidden" id="emptyState">
          <div class="empty-icon">
            <svg viewBox="0 0 64 64" fill="none">
              <circle cx="28" cy="28" r="16" stroke="#76d7ea" stroke-width="4"/>
              <path d="M40 40L54 54" stroke="#76d7ea" stroke-width="4" stroke-linecap="round"/>
            </svg>
          </div>
          <h3>No conversations found</h3>
          <p>Try another expert name, crop keyword, or topic.</p>
        </div>

        <div class="conversation-footer-action">
          <a href="{{ url('/find-experts') }}" class="start-conversation-btn">
            <svg viewBox="0 0 24 24" fill="none">
              <path d="M12 5V19" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/>
              <path d="M5 12H19" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/>
            </svg>
            <span>Start New Conversation</span>
          </a>
        </div>
      </div>

      <div class="secure-note">
        <span class="secure-icon">
          <svg viewBox="0 0 24 24" fill="none">
            <path d="M12 3L19 6V11C19 16 15.5 20.5 12 21C8.5 20.5 5 16 5 11V6L12 3Z" fill="currentColor"/>
          </svg>
        </span>
        <span>Secure peer-to-peer advisor encryption active</span>
      </div>

    </section>

    <!-- FOOTER — copy persis dari dashboard-user -->
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

  </main>
</div>
<script src="{{ asset('js/script-ConsultationhistoryUser.js') }}"></script>
</body>
</html>