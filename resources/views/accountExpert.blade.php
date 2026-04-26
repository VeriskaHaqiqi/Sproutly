<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sproutly - Expert Account</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/style-accountExpert.css') }}">
</head>
<body>

  <!-- Sidebar Overlay -->
  <div class="sidebar-overlay" id="sidebarOverlay"></div>

  <!-- ========================
       SIDEBAR
  ========================= -->
  <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('homeExpert') }}" class="logo-wrap">
                <div class="logo-box">
                    <img src="images/logo.png" class="logo-img">
                </div>
                <span class="logo-text">Sproutly</span>
            </a>
        </div>

        <div class="sidebar-line"></div>

        <nav class="sidebar-menu">
            <a href="{{ route('dashboard-ahli') }}" 
            class="menu-link {{ request()->routeIs('dashboard-ahli') ? 'active' : '' }}">
                <img src="images/dashboard.png">
                <span>Dashboard</span>
            </a>

            <a href="{{ route('consultexpert') }}" 
            class="menu-link {{ request()->routeIs('consultexpert') ? 'active' : '' }}">
                <img src="images/consultation.png">
                <span>Consultation</span>
            </a>

            <a href="{{ route('articleExpert') }}" 
            class="menu-link {{ request()->routeIs('articleExpert') ? 'active' : '' }}">
                <img src="images/article.png">
                <span>Article</span>
            </a>

            <a href="{{ route('myarticleExpert') }}" 
            class="menu-link child-link {{ request()->routeIs('myarticleExpert') ? 'active' : '' }}">
                <img src="images/myarticle.png">
                <span>My Article</span>
            </a>

            <a href="{{ route('setpricingexpert') }}" 
            class="menu-link child-link {{ request()->routeIs('setpricingexpert') ? 'active' : '' }}">
                <img src="images/pricing.png">
                <span>Pricing</span>
            </a>

            <a href="{{ route('ConsultationhistoryExpert') }}" 
            class="menu-link child-link {{ request()->routeIs('ConsultationhistoryExpert') ? 'active' : '' }}">
                <img src="images/clienthistory.png">
                <span>Client History</span>
            </a>

            <a href="{{ route('accountExpert') }}" 
            class="menu-link active" {{ request()->routeIs('accountExpert') ? 'active' : '' }}">
                <img src="images/settings.png">
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
        <div class="avatar-wrap">
          <img src="images/fotoprofile.png" alt="Expert Sarah Chen" class="avatar-img" />
          <span class="avatar-badge">✏️</span>
        </div>
        <h2 class="expert-name">Expert Sarah Chen</h2>
        <p class="expert-title">Plant Pathologist &amp; Indoor Plant Expert</p>
        <p class="expert-contact">sarah.chen@sproutly.com</p>
        <p class="expert-contact">+1 (234) 567-890</p>
        <div class="expert-tags">
          <span class="tag tag--outline">Plant Pathology</span>
          <span class="tag tag--teal">Indoor Plants</span>
          <span class="tag tag--outline">Sustainable Farming</span>
        </div>
        <a href="{{ route('editProfileExpert') }}" class="btn-edit-profile">
          ✏️ Edit Profile
        </a>
      </div>

      <!-- ========================
           PROFESSIONAL SETTINGS
      ========================= -->
      <div class="account-card">
        <h3 class="card-section-title">Professional Settings</h3>
        <ul class="menu-list">
          <li class="menu-item">
            <a href="#" class="menu-link">
              <span class="menu-link-left">
                <span class="menu-item-icon">
                    <img src="{{ asset('images/ikon set consultation.png') }}" alt="">
                </span>
                Set Consultation Fee
              </span>
              <span class="menu-arrow">›</span>
            </a>
          </li>
          <li class="menu-item">
            <a href="{{ route('manageSchedule') }}" class="menu-link">
              <span class="menu-link-left">
                <span class="menu-item-icon">
                    <img src="{{ asset('images/ikon manage schedule.png') }}" alt="">
                </span>
                Manage Availability Schedule
              </span>
              <span class="menu-arrow">›</span>
            </a>
          </li>
          <li class="menu-item">
            <a href="#" class="menu-link">
              <span class="menu-link-left">
                <span class="menu-item-icon">
                    <img src="{{ asset('images/ikon histori pendapatan.png') }}" alt="">
                </span>
                Revenue History
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
        <h3 class="card-section-title">Reputation</h3>
        <ul class="menu-list">
          <li class="menu-item">
            <a href="#" class="menu-link">
              <span class="menu-link-left">
                <span class="menu-item-icon menu-item-icon--teal">
                    <img src="{{ asset('images/ikon list rating.png') }}" alt="">
                </span>
                <span class="ratings-info">
                  <span class="ratings-label">Ratings List</span>
                  <span class="ratings-stars">
                    ★★★★★ <span class="ratings-score">(4.8/5.0)</span>
                  </span>
                </span>
              </span>
              <span class="menu-arrow">›</span>
            </a>
          </li>
        </ul>
      </div>

      <!-- ========================
           PAYMENT
      ========================= -->
      <div class="account-card">
        <h3 class="card-section-title">Payment</h3>
        <ul class="menu-list">
          <li class="menu-item">
            <a href="{{ route('setPayMethod') }}" class="menu-link">
              <span class="menu-link-left">
                <span class="menu-item-icon">
                    <img src="{{ asset('images/ikon payment method.png') }}" alt="">
                </span>
                Payment Methods
              </span>
              <span class="menu-arrow">›</span>
            </a>
            </a>
          </li>
        </ul>
      </div>

      <!-- ========================
           PREFERENCES
      ========================= -->
      <div class="account-card">
        <h3 class="card-section-title">Preferences</h3>
        <ul class="menu-list">
          <li class="menu-item">
            <a href="#" class="menu-link">
              <span class="menu-link-left">
                <span class="menu-item-icon">
                    <img src="{{ asset('images/ikon language.png') }}" alt="">
                </span>
                <span class="pref-info">
                  <span class="pref-label">Language</span>
                  <span class="pref-value">English</span>
                </span>
              </span>
              <span class="menu-arrow">›</span>
            </a>
          </li>
        </ul>
      </div>

      <!-- ========================
           SUPPORT & INFO
      ========================= -->
      <div class="account-card support-card">
        <h3 class="card-section-title">Support & Info</h3>
        <ul class="menu-list">
          <li class="menu-item">
            <a href="/supportExpert" class="menu-link">
              <span class="menu-link-left">
                <span class="menu-item-icon">
                    <img src="{{ asset('images/settings.png') }}" alt="">
                </span>
                <span class="pref-info">
                  <span class="pref-label">Support & Info</span>
                </span>
              </span>
              <span class="menu-arrow">›</span>
            </a>
          </li>
        </ul>
      </div>

      <!-- ========================
           SIGN OUT
      ========================= -->
      <div class="account-card signout-card">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn-signout">
            <span class="signout-icon">→</span>
            Sign Out
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

  <script src="{{ asset('js/script-accountExpert.js') }}"></script>
</body>
</html>