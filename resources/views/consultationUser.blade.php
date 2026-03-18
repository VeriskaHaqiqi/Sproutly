<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sproutly - Consultation</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('css/style-consultationUser.css') }}">
</head>
<body>
  <div class="consultation-page">
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

        <button class="menu-item active" data-menu="Consultation" type="button">
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

        <button class="menu-item" data-menu="Bookmarked Article" type="button">
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

      <!-- PAGE INTRO -->
      <section class="consultation-header">
        <div class="consultation-header-left">
          <p>Connect with agricultural experts for personalized advice</p>

          <div class="search-box">
            <span class="search-icon">
              <svg viewBox="0 0 24 24" fill="none">
                <circle cx="11" cy="11" r="6.5" stroke="currentColor" stroke-width="2.2"/>
                <path d="M16 16L20 20" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
              </svg>
            </span>
            <input
              type="text"
              id="conversationSearch"
              placeholder="Search conversations..."
            />
          </div>
        </div>

        <div class="consultation-header-right">
          <div class="status-tabs" id="statusTabs">
            <button class="status-tab active" data-status="active" type="button">Active</button>
            <button class="status-tab" data-status="completed" type="button">Completed</button>
          </div>
        </div>
      </section>

      <!-- CHAT LIST CARD -->
      <section class="conversation-section">
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
            <button class="start-conversation-btn" id="startConversationBtn" type="button">
              <svg viewBox="0 0 24 24" fill="none">
                <path d="M12 5V19" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/>
                <path d="M5 12H19" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/>
              </svg>
              <span>Start New Conversation</span>
            </button>
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

  <script src="{{ asset('js/consultationUser.js') }}"></script>
</body>
</html>