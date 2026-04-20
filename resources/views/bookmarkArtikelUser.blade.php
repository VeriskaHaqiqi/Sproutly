<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sproutly - Bookmarked Articles</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/style-bookmarkArtikelUser.css') }}">
</head>
<body>
  <div class="bookmark-page">

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
        <a href="{{ url('/dashboard-user') }}" class="menu-link"><i class="fa-solid fa-chart-line"></i><span>Dashboard</span></a>
        <a href="{{ url('/consultationUser') }}" class="menu-link"><i class="fa-solid fa-comments"></i><span>Consultation</span></a>
        <a href="{{ url('/daftarArtikel') }}" class="menu-link"><i class="fa-solid fa-newspaper"></i><span>Article</span></a>
        <a href="{{ url('/bookmarkArtikelUser') }}" class="menu-link active"><i class="fa-solid fa-bookmark"></i><span>Bookmarked Article</span></a>
        <a href="{{ url('/reviewsUser') }}" class="menu-link"><i class="fa-solid fa-star"></i><span>Reviews</span></a>
        <a href="{{ url('/invoice') }}" class="menu-link"><i class="fa-solid fa-credit-card"></i><span>Payment</span></a>
        <a href="{{ url('/accountUser') }}" class="menu-link"><i class="fa-solid fa-gear"></i><span>Setting</span></a>
      </nav>
    </aside>

    <!-- MAIN -->
    <main class="main-content full" id="mainContent">
      <div class="main-bg blob-left"></div>
      <div class="main-bg blob-right"></div>

      <!-- TOPBAR -->
      <header class="topbar">
        <div class="topbar-left">
          <button class="menu-toggle" id="menuToggle" type="button" aria-label="Toggle sidebar">
            <svg viewBox="0 0 24 24" fill="none">
              <path d="M4 7H20" stroke="currentColor" stroke-width="2.6" stroke-linecap="round"/>
              <path d="M4 12H20" stroke="currentColor" stroke-width="2.6" stroke-linecap="round"/>
              <path d="M4 17H20" stroke="currentColor" stroke-width="2.6" stroke-linecap="round"/>
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

      <!-- HEADER CONTENT -->
      <section class="page-header">
        <div class="page-header-left">
          <h1>Bookmarked Articles</h1>
          <p>Manage your curated library of agricultural insights.</p>
        </div>
        <div class="page-header-right">
          <div class="search-box">
            <span class="search-icon">
              <svg viewBox="0 0 24 24" fill="none">
                <circle cx="11" cy="11" r="6.5" stroke="currentColor" stroke-width="2.2"/>
                <path d="M16 16L20 20" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
              </svg>
            </span>
            <input type="text" id="articleSearch" placeholder="Search saved articles..." />
          </div>
          <button class="filter-btn" id="filterToggle" type="button">
            <svg viewBox="0 0 24 24" fill="none">
              <path d="M4 6H20L14 13V18L10 20V13L4 6Z" fill="currentColor"/>
            </svg>
            <span>Filter</span>
          </button>
        </div>
      </section>

      <!-- FILTER PANEL -->
      <section class="filter-panel hidden" id="filterPanel">
        <div class="filter-group">
          <h4>Topic</h4>
          <div class="filter-chips" id="topicFilters">
            <button class="filter-chip active" type="button" data-topic="all">All Topics</button>
            <button class="filter-chip" type="button" data-topic="hydroponics">Hydroponics</button>
            <button class="filter-chip" type="button" data-topic="soil health">Soil Health</button>
            <button class="filter-chip" type="button" data-topic="smart farming">Smart Farming</button>
            <button class="filter-chip" type="button" data-topic="pest control">Pest Control</button>
            <button class="filter-chip" type="button" data-topic="climate">Climate</button>
            <button class="filter-chip" type="button" data-topic="vertical farming">Vertical Farming</button>
          </div>
        </div>
        <div class="filter-group filter-group-inline">
          <div>
            <h4>Sort By</h4>
            <select id="sortSelect">
              <option value="latest">Latest</option>
              <option value="oldest">Oldest</option>
              <option value="title-az">Title A-Z</option>
              <option value="title-za">Title Z-A</option>
            </select>
          </div>
          <div class="filter-actions">
            <button class="secondary-btn" id="resetFilters" type="button">Reset</button>
          </div>
        </div>
      </section>

      <!-- ARTICLE GRID -->
      <section class="bookmarked-section">
        <div class="bookmarked-grid" id="articleGrid"></div>
        <div class="empty-state hidden" id="emptyState">
          <div class="empty-icon">
            <svg viewBox="0 0 64 64" fill="none">
              <circle cx="28" cy="28" r="16" stroke="#76d7ea" stroke-width="4"/>
              <path d="M40 40L54 54" stroke="#76d7ea" stroke-width="4" stroke-linecap="round"/>
            </svg>
          </div>
          <h3>No saved articles found</h3>
          <p>Try another title, keyword, topic, or author name.</p>
        </div>
        <div class="pagination-wrap" id="paginationWrap"></div>
      </section>

      <!-- STATS -->
      <section class="stats-section">
        <div class="stats-grid">
          <div class="stat-card stat-card-blue">
            <div class="stat-icon">
              <svg viewBox="0 0 24 24" fill="none">
                <path d="M7 4H17C17.55 4 18 4.45 18 5V20L12 16.5L6 20V5C6 4.45 6.45 4 7 4Z" fill="currentColor"/>
              </svg>
            </div>
            <div class="stat-content">
              <strong id="totalSavedStat">247</strong>
              <span>Total Saved</span>
            </div>
            <div class="stat-deco"></div>
          </div>
          <div class="stat-card stat-card-green">
            <div class="stat-icon">
              <svg viewBox="0 0 24 24" fill="none">
                <path d="M7 3V6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <path d="M17 3V6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <rect x="4" y="5" width="16" height="15" rx="3" stroke="currentColor" stroke-width="2"/>
                <path d="M4 10H20" stroke="currentColor" stroke-width="2"/>
              </svg>
            </div>
            <div class="stat-content">
              <strong>12</strong>
              <span>Saved This Week</span>
            </div>
            <div class="stat-deco"></div>
          </div>
          <div class="stat-card stat-card-yellow">
            <div class="stat-icon">
              <svg viewBox="0 0 24 24" fill="none">
                <path d="M8 5H16V8C16 10.21 14.21 12 12 12C9.79 12 8 10.21 8 8V5Z" stroke="currentColor" stroke-width="2"/>
                <path d="M9 19H15" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <path d="M12 12V19" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <path d="M6 7H8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <path d="M16 7H18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              </svg>
            </div>
            <div class="stat-content">
              <strong id="topCategoryStat">Hydroponics</strong>
              <span>Top Category</span>
            </div>
            <div class="stat-deco"></div>
          </div>
        </div>
      </section>

      <!-- FOOTER -->
      <footer class="site-footer">
        <div class="footer-grid">
          <div class="footer-brand">
            <div class="footer-brand-top">
              <div class="footer-logo-box"><img src="{{ asset('images/logo.png') }}" alt="Sproutly Logo" class="footer-logo"></div>
              <div><h3>Sproutly</h3><span>by AVI</span></div>
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

  <script src="{{ asset('js/bookmarkArtikelUser.js') }}"></script>
</body>
</html>