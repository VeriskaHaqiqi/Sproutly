<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sproutly - Expert Dashboard</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/style-dashboard-ahli.css') }}">
</head>
<body>
<div class="layout">

  <!-- ===== SIDEBAR ===== -->
  <aside class="sidebar closed" id="sidebar">
    <div class="sidebar-header">
      <a href="{{ url('/homeExpert') }}" class="logo-wrap">
        <div class="logo-box">
          <img src="{{ asset('images/logo.png') }}" alt="Sproutly" class="logo-img">
        </div>
        <span class="logo-text">Sproutly</span>
      </a>
    </div>
    <div class="sidebar-line"></div>
    <nav class="sidebar-menu">
      <a href="{{ url('/dashboard-ahli') }}"         class="menu-link active"><i class="fa-solid fa-chart-line"></i><span>Dashboard</span></a>
      <a href="{{ url('/consulexpert') }}"            class="menu-link"><i class="fa-solid fa-comments"></i><span>Consultation</span></a>
      <a href="{{ url('/articleExpert') }}"           class="menu-link"><i class="fa-solid fa-newspaper"></i><span>Article</span></a>
      <a href="{{ url('/myarticleExpert') }}"         class="menu-link child-link"><i class="fa-solid fa-file-lines"></i><span>My Article</span></a>
      <a href="{{ url('/setpricingexpert') }}"        class="menu-link child-link"><i class="fa-solid fa-dollar-sign"></i><span>Pricing</span></a>
      <a href="{{ url('/ConsultationhistoryUser') }}" class="menu-link child-link"><i class="fa-solid fa-clock-rotate-left"></i><span>Client History</span></a>
      <a href="{{ url('/accountExpert') }}"           class="menu-link child-link"><i class="fa-solid fa-gear"></i><span>Setting</span></a>
    </nav>
  </aside>

  <!-- ===== MAIN ===== -->
  <main class="main-content full" id="mainContent">

    <!-- TOPBAR -->
    <header class="topbar">
      <div class="topbar-left">
        <button class="sidebar-toggle" id="sidebarToggle" type="button">
          <span></span><span></span><span></span>
        </button>
        <div class="search-box">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input type="text" placeholder="Search consultations, articles, users...">
        </div>
      </div>
      <div class="topbar-right">
        <button class="notif-btn" type="button">
          <i class="fa-solid fa-bell"></i>
          <span class="notif-dot"></span>
        </button>
        <a href="{{ url('/accountExpert') }}" class="profile-chip">
          <div class="profile-info">
            <span class="profile-name">Sarah Green</span>
            <span class="profile-role">Agriculture Expert</span>
          </div>
          <img src="{{ asset('images/fotoprofile.png') }}" alt="Profile">
        </a>
      </div>
    </header>

    <!-- ===== PAGE CONTENT ===== -->
    <div class="page-content">

      <!-- Welcome row -->
      <div class="welcome-row">
        <div class="welcome-text">
          <h1>Welcome back, Sarah!
            <span class="leaf-icon">
              <svg viewBox="0 0 34 30" fill="none">
                <path d="M7 19C7 19 5 10 11 6C17 2 25 6 24 14C23 21 15 22 10 20" fill="#6dbb1f"/>
                <path d="M18 27C18 27 17 12 28 7C32 5 34 8 34 13C34 23 24 28 19 28" fill="#88cf39"/>
                <path d="M18 29V15" stroke="#4f9b10" stroke-width="2.2" stroke-linecap="round"/>
              </svg>
            </span>
          </h1>
          <p>Here's what's happening with your consultations today</p>
        </div>
        <div class="date-chip">
          <i class="fa-solid fa-calendar-days"></i>
          <span id="todayDate">Dec 21, 2026</span>
        </div>
      </div>

      <!-- Stats cards -->
      <div class="stats-grid">
        <div class="stat-card card-yellow">
          <div class="stat-icon-wrap">
            <div class="stat-icon-box">
              <i class="fa-solid fa-comments"></i>
            </div>
          </div>
          <div class="stat-number">20</div>
          <div class="stat-label">Consultations this month</div>
          <div class="stat-deco"></div>
        </div>

        <div class="stat-card card-green">
          <div class="stat-icon-wrap">
            <div class="stat-icon-box">
              <i class="fa-solid fa-star"></i>
            </div>
          </div>
          <div class="stat-number">4.8</div>
          <div class="stat-label">Average Rating ⭐</div>
          <div class="stat-deco"></div>
        </div>

        <div class="stat-card card-teal">
          <div class="stat-icon-wrap">
            <div class="stat-icon-box">
              <i class="fa-solid fa-newspaper"></i>
            </div>
          </div>
          <div class="stat-number">20</div>
          <div class="stat-label">Published Articles</div>
          <div class="stat-deco"></div>
        </div>
      </div>

      <!-- Active Consultations -->
      <div class="section-card">
        <div class="section-head">
          <h2>Active Consultations</h2>
          <a href="{{ url('/consulexpert') }}" class="view-all-btn">View All</a>
        </div>
        <div class="consult-list">

          <div class="consult-item">
            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Michael Chen" class="consult-avatar">
            <div class="consult-info">
              <span class="consult-name">Michael Chen</span>
              <span class="consult-topic">Organic farming consultation</span>
            </div>
            <span class="consult-time">2 hours ago</span>
            <a href="{{ url('/roomChatExpert') }}" class="view-detail-btn">View Detail</a>
          </div>

          <div class="consult-item">
            <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Emma Rodriguez" class="consult-avatar">
            <div class="consult-info">
              <span class="consult-name">Emma Rodriguez</span>
              <span class="consult-topic">Pest control strategies</span>
            </div>
            <span class="consult-time">5 hours ago</span>
            <a href="{{ url('/roomChatExpert') }}" class="view-detail-btn">View Detail</a>
          </div>

          <div class="consult-item">
            <img src="https://randomuser.me/api/portraits/men/55.jpg" alt="David Thompson" class="consult-avatar">
            <div class="consult-info">
              <span class="consult-name">David Thompson</span>
              <span class="consult-topic">Crop rotation planning</span>
            </div>
            <span class="consult-time">1 day ago</span>
            <a href="{{ url('/roomChatExpert') }}" class="view-detail-btn">View Detail</a>
          </div>

        </div>
      </div>

      <!-- Quick Actions -->
      <div class="quick-actions-section">
        <h2 class="qa-title">Quick Actions</h2>
        <div class="quick-actions-grid">

          <a href="{{ url('/manageSchedule') }}" class="qa-card qa-yellow">
            <div class="qa-icon-box">
              <i class="fa-solid fa-calendar-days"></i>
            </div>
            <h3>Manage Schedule</h3>
            <p>Set your availability and manage consultation slots</p>
            <span class="qa-link">Go to Calendar <i class="fa-solid fa-arrow-right"></i></span>
          </a>

          <a href="{{ url('/setpricingexpert') }}" class="qa-card qa-lime">
            <div class="qa-icon-box">
              <i class="fa-solid fa-dollar-sign"></i>
            </div>
            <h3>Edit Pricing</h3>
            <p>Update your consultation rates and packages</p>
            <span class="qa-link">Update Pricing <i class="fa-solid fa-arrow-right"></i></span>
          </a>

        </div>
      </div>

    </div><!-- /page-content -->

    <!-- ===== FOOTER (exact dari articleExpert) ===== -->
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
      <div class="footer-bottom">&copy; 2025 Sproutly by AVI. All rights reserved.</div>
    </footer>

  </main>
</div>
<script src="{{ asset('js/script-dashboard-ahli.js') }}"></script>
</body>
</html>