<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sproutly - User Dashboard</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('css/style-dashboard-user.css') }}">
</head>
<body>
  <div class="dashboard-page">
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
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
        <button class="menu-item active" data-menu="Dashboard" type="button">
          <span class="menu-icon">
            <svg viewBox="0 0 24 24" fill="none">
              <path d="M4 17L9 12L13 15L20 8" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M20 8V13" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
            </svg>
          </span>
          <span class="menu-label">Dashboard</span>
        </button>

        <button class="menu-item" data-menu="Consultation" type="button">
          <span class="menu-icon">
            <svg viewBox="0 0 24 24" fill="none">
              <rect x="5" y="6" width="14" height="13" rx="2.5" stroke="currentColor" stroke-width="2"/>
              <path d="M8 3V8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              <path d="M16 3V8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              <path d="M5 10H19" stroke="currentColor" stroke-width="2"/>
            </svg>
          </span>
          <span class="menu-label">Consultation</span>
        </button>

        <button class="menu-item" data-menu="Article" type="button">
          <span class="menu-icon">
            <svg viewBox="0 0 24 24" fill="none">
              <rect x="4" y="5" width="16" height="14" rx="2.3" stroke="currentColor" stroke-width="2"/>
              <path d="M9 5V19" stroke="currentColor" stroke-width="2"/>
              <path d="M11.5 9H17" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              <path d="M11.5 12H17" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              <path d="M11.5 15H17" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
          </span>
          <span class="menu-label">Article</span>
        </button>

        <button class="menu-item" data-menu="Bookmarked Article" type="button">
          <span class="menu-icon">
            <svg viewBox="0 0 24 24" fill="none">
              <path d="M8 4H16C17.1 4 18 4.9 18 6V20L12 16L6 20V6C6 4.9 6.9 4 8 4Z" fill="currentColor"/>
            </svg>
          </span>
          <span class="menu-label">Bookmarked Article</span>
        </button>

        <button class="menu-item" data-menu="Reviews" type="button">
          <span class="menu-icon">
            <svg viewBox="0 0 24 24" fill="none">
              <path d="M12 3L14.78 8.63L21 9.54L16.5 13.92L17.56 20.1L12 17.18L6.44 20.1L7.5 13.92L3 9.54L9.22 8.63L12 3Z" fill="currentColor"/>
            </svg>
          </span>
          <span class="menu-label">Reviews</span>
        </button>

        <button class="menu-item" data-menu="Payment" type="button">
          <span class="menu-icon">
            <svg viewBox="0 0 24 24" fill="none">
              <rect x="3" y="6" width="18" height="12" rx="2.5" stroke="currentColor" stroke-width="2"/>
              <path d="M3 10H21" stroke="currentColor" stroke-width="2"/>
              <path d="M7 14H11" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
          </span>
          <span class="menu-label">Payment</span>
        </button>

        <button class="menu-item" data-menu="Setting" type="button">
          <span class="menu-icon">
            <svg viewBox="0 0 24 24" fill="none">
              <path d="M12 8.7A3.3 3.3 0 1 0 12 15.3A3.3 3.3 0 1 0 12 8.7Z" stroke="currentColor" stroke-width="2"/>
              <path d="M19.4 15A1 1 0 0 0 19.6 16.1L19.7 16.2A1.2 1.2 0 1 1 18 17.9L17.9 17.8A1 1 0 0 0 16.8 17.6A1 1 0 0 0 16.2 18.5V18.8A1.2 1.2 0 1 1 13.8 18.8V18.7A1 1 0 0 0 13.1 17.7A1 1 0 0 0 12 17.9L11.9 18A1.2 1.2 0 1 1 10.2 16.3L10.3 16.2A1 1 0 0 0 10.5 15.1A1 1 0 0 0 9.6 14.5H9.2A1.2 1.2 0 1 1 9.2 12.1H9.3A1 1 0 0 0 10.3 11.4A1 1 0 0 0 10.1 10.3L10 10.2A1.2 1.2 0 1 1 11.7 8.5L11.8 8.6A1 1 0 0 0 12.9 8.8A1 1 0 0 0 13.5 7.9V7.6A1.2 1.2 0 1 1 15.9 7.6V7.7A1 1 0 0 0 16.6 8.7A1 1 0 0 0 17.7 8.5L17.8 8.4A1.2 1.2 0 1 1 19.5 10.1L19.4 10.2A1 1 0 0 0 19.2 11.3A1 1 0 0 0 20.1 11.9H20.4A1.2 1.2 0 1 1 20.4 14.3H20.3A1 1 0 0 0 19.4 15Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>
            </svg>
          </span>
          <span class="menu-label">Setting</span>
        </button>
      </nav>
    </aside>

    <!-- Main -->
    <main class="main-content" id="mainContent">
      <div class="main-bg bg-circle bg-1"></div>
      <div class="main-bg bg-circle bg-2"></div>
      <div class="main-bg bg-circle bg-3"></div>
      <div class="main-bg bg-circle bg-4"></div>

      <!-- Topbar -->
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

          <div class="search-box">
            <span class="search-icon">
              <svg viewBox="0 0 24 24" fill="none">
                <circle cx="11" cy="11" r="6.5" stroke="currentColor" stroke-width="2.2"/>
                <path d="M16 16L20 20" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
              </svg>
            </span>
            <input type="text" placeholder="Search consultations, articles, experts..." />
          </div>
        </div>

        <div class="topbar-right">
          <button class="notif-btn" type="button" aria-label="Notifications">
            <svg viewBox="0 0 24 24" fill="none">
              <path d="M8 18H16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              <path d="M10 20C10.5 21 11.1 21.5 12 21.5C12.9 21.5 13.5 21 14 20" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              <path d="M18 17H6C6.9 16.2 7.5 15 7.5 13.8V10.8C7.5 8.2 9.4 6 12 6C14.6 6 16.5 8.2 16.5 10.8V13.8C16.5 15 17.1 16.2 18 17Z" fill="currentColor"/>
            </svg>
          </button>

          <div class="profile-chip">
            <span class="profile-name">Sarah Green</span>
            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=200&auto=format&fit=crop" alt="Profile">
          </div>
        </div>
      </header>

      <!-- Content -->
      <section class="content-wrap">
        <div class="hero-row">
          <div class="hero-text">
            <h1>Welcome back, Sarah! <span class="leaf-inline">
              <svg viewBox="0 0 34 30" fill="none">
                <path d="M7 19C7 19 5 10 11 6C17 2 25 6 24 14C23 21 15 22 10 20" fill="#6dbb1f"/>
                <path d="M18 27C18 27 17 12 28 7C32 5 34 8 34 13C34 23 24 28 19 28" fill="#88cf39"/>
                <path d="M18 29V15" stroke="#4f9b10" stroke-width="2.2" stroke-linecap="round"/>
              </svg>
            </span></h1>
            <p>Let's check on your agricultural consultations today</p>
          </div>

          <div class="date-chip">
            <span class="date-icon">
              <svg viewBox="0 0 24 24" fill="none">
                <rect x="4" y="5" width="16" height="15" rx="3" fill="currentColor"/>
                <path d="M8 3V7" stroke="#ffffff" stroke-width="2" stroke-linecap="round"/>
                <path d="M16 3V7" stroke="#ffffff" stroke-width="2" stroke-linecap="round"/>
                <path d="M4 9H20" stroke="#ffffff" stroke-width="2"/>
              </svg>
            </span>
            <span>Dec 21, 2026</span>
          </div>
        </div>

        <section class="stats-grid">
          <div class="stat-card card-article">
            <div class="stat-box">
              <svg viewBox="0 0 84 84" fill="none">
                <rect x="18" y="16" width="48" height="52" rx="8" fill="#ff7f11"/>
                <rect x="28" y="26" width="18" height="18" rx="4" fill="#ffd7a8"/>
                <rect x="50" y="26" width="10" height="5" rx="2.5" fill="#ffd7a8"/>
                <rect x="50" y="36" width="10" height="5" rx="2.5" fill="#ffd7a8"/>
                <rect x="28" y="50" width="32" height="5" rx="2.5" fill="#ffd7a8"/>
                <rect x="28" y="59" width="32" height="5" rx="2.5" fill="#ffd7a8"/>
                <rect x="20" y="26" width="4" height="36" rx="2" fill="#ffd7a8"/>
              </svg>
            </div>

            <div class="stat-info">
              <h2>30</h2>
              <p>Articles Viewed</p>
            </div>
          </div>

          <div class="stat-card card-completed">
            <div class="stat-card-circle"></div>

            <div class="stat-box">
              <svg viewBox="0 0 84 84" fill="none">
                <circle cx="42" cy="42" r="29" fill="#2e61e8"/>
                <path d="M29 43L39 53L56 34" stroke="#bde7c7" stroke-width="6" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </div>

            <div class="stat-info">
              <h2>20</h2>
              <p>Completed Consultations</p>
            </div>
          </div>
        </section>

        <section class="activity-section">
          <div class="section-head">
            <div class="section-title">
              <span class="activity-icon">
                <svg viewBox="0 0 26 26" fill="none">
                  <path d="M13 4C17.97 4 22 8.03 22 13C22 17.97 17.97 22 13 22C9.44 22 6.36 19.93 4.91 16.93" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/>
                  <path d="M4 7V12H9" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </span>
              <h3>Recent Activity</h3>
            </div>

            <button class="view-all-btn" id="viewAllBtn" type="button">View All</button>
          </div>

          <div class="activity-list" id="activityList">
            <article class="activity-card activity-green visible">
              <div class="activity-icon-box">
                <svg viewBox="0 0 28 28" fill="none">
                  <path d="M9 7L4 12L9 17" stroke="#ffffff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M5 12H14C18.42 12 22 15.58 22 20" stroke="#ffffff" stroke-width="3" stroke-linecap="round"/>
                </svg>
              </div>
              <div class="activity-content">
                <h4>Expert replied to your consultation</h4>
                <p>Dr. Martinez provided detailed feedback on your tomato disease inquiry</p>
                <div class="activity-meta">
                  <span class="time-chip">
                    <svg viewBox="0 0 18 18" fill="none">
                      <circle cx="9" cy="9" r="7" fill="#626b7a"/>
                      <path d="M9 5.5V9L11.5 10.5" stroke="#ffffff" stroke-width="1.7" stroke-linecap="round"/>
                    </svg>
                    2 hours ago
                  </span>
                  <span class="status-chip">New Reply</span>
                </div>
              </div>
            </article>

            <article class="activity-card activity-blue visible">
              <div class="activity-icon-box">
                <svg viewBox="0 0 28 28" fill="none">
                  <rect x="4" y="7" width="20" height="14" rx="3" fill="#ffffff"/>
                  <path d="M4 11H24" stroke="#67d7df" stroke-width="2"/>
                  <path d="M8 16H14" stroke="#67d7df" stroke-width="2" stroke-linecap="round"/>
                </svg>
              </div>
              <div class="activity-content">
                <h4>Payment verified</h4>
                <p>Your payment for the soil analysis consultation has been processed successfully</p>
                <div class="activity-meta">
                  <span class="time-chip">
                    <svg viewBox="0 0 18 18" fill="none">
                      <circle cx="9" cy="9" r="7" fill="#626b7a"/>
                      <path d="M9 5.5V9L11.5 10.5" stroke="#ffffff" stroke-width="1.7" stroke-linecap="round"/>
                    </svg>
                    5 hours ago
                  </span>
                  <span class="status-chip">Verified</span>
                </div>
              </div>
            </article>

            <article class="activity-card activity-yellow visible">
              <div class="activity-icon-box">
                <svg viewBox="0 0 28 28" fill="none">
                  <path d="M7 14L12 19L21 10" stroke="#2d3448" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M7 8L12 13L21 4" stroke="#2d3448" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" opacity="0.95"/>
                </svg>
              </div>
              <div class="activity-content">
                <h4>Consultation completed</h4>
                <p>Your organic farming consultation with Mr. Chen has been marked as complete</p>
                <div class="activity-meta">
                  <span class="time-chip">
                    <svg viewBox="0 0 18 18" fill="none">
                      <circle cx="9" cy="9" r="7" fill="#626b7a"/>
                      <path d="M9 5.5V9L11.5 10.5" stroke="#ffffff" stroke-width="1.7" stroke-linecap="round"/>
                    </svg>
                    Yesterday
                  </span>
                  <span class="status-chip">Completed</span>
                </div>
              </div>
            </article>

            <!-- hidden by default, shown on View All -->
            <article class="activity-card activity-green hidden-week">
              <div class="activity-icon-box">
                <svg viewBox="0 0 28 28" fill="none">
                  <path d="M8 6H20V18H12L7 22V7C7 6.45 7.45 6 8 6Z" fill="#ffffff"/>
                  <path d="M11 11H17" stroke="#6be39f" stroke-width="2" stroke-linecap="round"/>
                  <path d="M11 15H15" stroke="#6be39f" stroke-width="2" stroke-linecap="round"/>
                </svg>
              </div>
              <div class="activity-content">
                <h4>New article recommendation</h4>
                <p>You received a new article suggestion about hydroponic nutrient balance</p>
                <div class="activity-meta">
                  <span class="time-chip">
                    <svg viewBox="0 0 18 18" fill="none">
                      <circle cx="9" cy="9" r="7" fill="#626b7a"/>
                      <path d="M9 5.5V9L11.5 10.5" stroke="#ffffff" stroke-width="1.7" stroke-linecap="round"/>
                    </svg>
                    2 days ago
                  </span>
                  <span class="status-chip">Suggested</span>
                </div>
              </div>
            </article>

            <article class="activity-card activity-blue hidden-week">
              <div class="activity-icon-box">
                <svg viewBox="0 0 28 28" fill="none">
                  <path d="M14 4L17 10L24 11L19 15.5L20.3 22L14 18.5L7.7 22L9 15.5L4 11L11 10L14 4Z" fill="#ffffff"/>
                </svg>
              </div>
              <div class="activity-content">
                <h4>Review submitted</h4>
                <p>Your review for the consultation service has been published successfully</p>
                <div class="activity-meta">
                  <span class="time-chip">
                    <svg viewBox="0 0 18 18" fill="none">
                      <circle cx="9" cy="9" r="7" fill="#626b7a"/>
                      <path d="M9 5.5V9L11.5 10.5" stroke="#ffffff" stroke-width="1.7" stroke-linecap="round"/>
                    </svg>
                    4 days ago
                  </span>
                  <span class="status-chip">Published</span>
                </div>
              </div>
            </article>

            <article class="activity-card activity-yellow hidden-week">
              <div class="activity-icon-box">
                <svg viewBox="0 0 28 28" fill="none">
                  <path d="M8 8H20V20H8V8Z" fill="#ffffff"/>
                  <path d="M10 12H18" stroke="#2d3448" stroke-width="2.2" stroke-linecap="round"/>
                  <path d="M10 16H15" stroke="#2d3448" stroke-width="2.2" stroke-linecap="round"/>
                </svg>
              </div>
              <div class="activity-content">
                <h4>Consultation summary ready</h4>
                <p>Your weekly consultation summary has been generated and saved to your account</p>
                <div class="activity-meta">
                  <span class="time-chip">
                    <svg viewBox="0 0 18 18" fill="none">
                      <circle cx="9" cy="9" r="7" fill="#626b7a"/>
                      <path d="M9 5.5V9L11.5 10.5" stroke="#ffffff" stroke-width="1.7" stroke-linecap="round"/>
                    </svg>
                    6 days ago
                  </span>
                  <span class="status-chip">Saved</span>
                </div>
              </div>
            </article>

            <article class="activity-card activity-green hidden-week">
              <div class="activity-icon-box">
                <svg viewBox="0 0 28 28" fill="none">
                  <circle cx="14" cy="14" r="10" fill="#ffffff"/>
                  <path d="M14 9V14L17 16" stroke="#6be39f" stroke-width="2.2" stroke-linecap="round"/>
                </svg>
              </div>
              <div class="activity-content">
                <h4>Follow-up reminder</h4>
                <p>A follow-up reminder was added for your next consultation session this week</p>
                <div class="activity-meta">
                  <span class="time-chip">
                    <svg viewBox="0 0 18 18" fill="none">
                      <circle cx="9" cy="9" r="7" fill="#626b7a"/>
                      <path d="M9 5.5V9L11.5 10.5" stroke="#ffffff" stroke-width="1.7" stroke-linecap="round"/>
                    </svg>
                    1 week ago
                  </span>
                  <span class="status-chip">Reminder</span>
                </div>
              </div>
            </article>
          </div>
        </section>
      </section>
    </main>
  </div>

  <script src="{{ asset('js/script-dashboard-user.js') }}"></script>
</body>
</html>