<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sproutly - Bookmarked Articles</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('css/style-bookmarkArtikelUser.css') }}">
</head>
<body>
  <div class="bookmark-page">
    <!-- SIDEBAR -->
    <aside class="sidebar open" id="sidebar">
      <div class="sidebar-top">
        <div class="brand-wrap">
          <div class="brand-logo-box">
            <img src="{{ asset('images/logo.png') }}" alt="Sproutly Logo">
          </div>
          <span class="brand-text">Sproutly</span>
        </div>
      </div>

      <div class="sidebar-divider"></div>

      <nav class="sidebar-menu" id="sidebarMenu">
        <button class="menu-item" data-menu="Dashboard" type="button">
          <span class="menu-icon">
            <img src="{{ asset('images/dashboard.png') }}" alt="Dashboard">
          </span>
          <span class="menu-label">Dashboard</span>
        </button>

        <button class="menu-item" data-menu="Consultation" type="button">
          <span class="menu-icon">
            <img src="{{ asset('images/consultation.png') }}" alt="Consultation">
          </span>
          <span class="menu-label">Consultation</span>
        </button>

        <button class="menu-item" data-menu="Article" type="button">
          <span class="menu-icon">
            <img src="{{ asset('images/article.png') }}" alt="Article">
          </span>
          <span class="menu-label">Article</span>
        </button>

        <button class="menu-item active" data-menu="Bookmarked Article" type="button">
          <span class="menu-icon">
            <img src="{{ asset('images/bookmark article.jpg') }}" alt="Bookmarked Article">
          </span>
          <span class="menu-label">Bookmarked Article</span>
        </button>

        <button class="menu-item" data-menu="Reviews" type="button">
          <span class="menu-icon">
            <img src="{{ asset('images/reviews.png') }}" alt="Reviews">
          </span>
          <span class="menu-label">Reviews</span>
        </button>

        <button class="menu-item" data-menu="Payment" type="button">
          <span class="menu-icon">
            <img src="{{ asset('images/payment.png') }}" alt="Payment">
          </span>
          <span class="menu-label">Payment</span>
        </button>

        <button class="menu-item" data-menu="Setting" type="button">
          <span class="menu-icon">
            <img src="{{ asset('images/settings.png') }}" alt="Setting">
          </span>
          <span class="menu-label">Setting</span>
        </button>
      </nav>
    </aside>

    <!-- MAIN -->
    <main class="main-content">
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

          <div class="brand-mobile">
            <div class="brand-mobile-logo">
              <img src="{{ asset('images/logo.png') }}" alt="Sproutly Logo">
            </div>
            <span>Sproutly</span>
          </div>
        </div>

        <div class="topbar-right">
          <button class="notif-btn" type="button" aria-label="Notifications">
            <svg viewBox="0 0 24 24" fill="none">
              <path d="M12 22C13.1 22 14 21.1 14 20H10C10 21.1 10.9 22 12 22ZM18 16V11C18 7.93 16.37 5.36 13.5 4.68V4C13.5 3.17 12.83 2.5 12 2.5C11.17 2.5 10.5 3.17 10.5 4V4.68C7.64 5.36 6 7.92 6 11V16L4.71 17.29C4.08 17.92 4.52 19 5.41 19H18.58C19.47 19 19.92 17.92 19.29 17.29L18 16Z" fill="currentColor"/>
            </svg>
          </button>

          <div class="user-chip">
            <div class="user-chip-text">
              <strong>Sarah Green</strong>
            </div>
            <img
              src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=300&q=80"
              alt="User"
            >
          </div>
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
            <input
              type="text"
              id="articleSearch"
              placeholder="Search saved articles..."
            />
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
      <footer class="custom-footer">
        <div class="footer-grid">
          <div class="footer-brand">
            <div class="footer-logo-wrap">
              <div class="footer-logo-icon">
                <img src="{{ asset('images/logo.png') }}" alt="Sproutly Logo">
              </div>
              <div class="footer-logo-text">
                <strong>Sproutly</strong>
                <small>by AVI</small>
              </div>
            </div>
            <p>A modern agriculture consultation platform for a greener and more sustainable future.</p>
          </div>

          <div class="footer-col">
            <h5>About Us</h5>
            <ul>
              <li><a href="#">Our Team</a></li>
              <li><a href="#">Blog</a></li>
              <li><a href="#">Privacy Policy</a></li>
            </ul>
          </div>

          <div class="footer-col footer-contact">
            <h5>Contact</h5>
            <p>
              <span class="footer-svg-icon">
                <svg viewBox="0 0 24 24" fill="none">
                  <path d="M4 6H20C20.55 6 21 6.45 21 7V17C21 17.55 20.55 18 20 18H4C3.45 18 3 17.55 3 17V7C3 6.45 3.45 6 4 6Z" fill="#e8d9f2"/>
                  <path d="M4 8L12 13L20 8" stroke="#ffffff" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </span>
              sproutly@gmail.com
            </p>
            <p>
              <span class="footer-svg-icon">
                <svg viewBox="0 0 24 24" fill="none">
                  <path d="M6.7 10.8C8.1 13.6 10.4 15.9 13.2 17.3L15.4 15.1C15.7 14.8 16.2 14.7 16.6 14.8C17.8 15.2 19 15.4 20.3 15.4C20.8 15.4 21.2 15.8 21.2 16.3V19.8C21.2 20.3 20.8 20.7 20.3 20.7C10.3 20.7 3.3 13.7 3.3 3.7C3.3 3.2 3.7 2.8 4.2 2.8H7.7C8.2 2.8 8.6 3.2 8.6 3.7C8.6 5 8.8 6.2 9.2 7.4C9.3 7.8 9.2 8.3 8.9 8.6L6.7 10.8Z" fill="#ff4da6"/>
                </svg>
              </span>
              +62 851 5693 2186
            </p>
            <div class="social-links">
              <a href="#" title="Instagram">
                <img src="{{ asset('images/instagram.jpg') }}" alt="Instagram">
              </a>
              <a href="#" title="Facebook">
                <img src="{{ asset('images/facebook.png') }}" alt="Facebook">
              </a>
              <a href="#" title="X">
                <img src="{{ asset('images/X.jpg') }}" alt="X">
              </a>
            </div>
          </div>
        </div>

        <div class="footer-bottom">
          © 2025 Sproutly by AVI. All rights reserved.
        </div>
      </footer>
    </main>
  </div>

  <script src="{{ asset('js/bookmarkArtikelUser.js') }}"></script>
</body>
</html>