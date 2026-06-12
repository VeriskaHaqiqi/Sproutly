<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sproutly - Manage Schedule</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/style-manageSchedule.css') }}">
</head>
<body>

  <!-- Sidebar Overlay -->
  <div class="sidebar-overlay" id="sidebarOverlay"></div>

  <!-- ========================
       SIDEBAR
  ========================= -->
  <!-- ===== SIDEBAR ===== -->
    <style>
    /* (SEMUA CSS SIDEBAR KAMU — TIDAK DIUBAH) */
    </style>

    <aside class="sidebar closed" id="sidebar">
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
            <h1>Manage Schedule</h1>
        </div>
    </header>

    <!-- PAGE BODY -->
    <main class="page-body">

      <!-- Page heading -->
      <div class="page-heading">
        <h1 class="heading-title">Availability</h1>
        <p class="heading-sub">Set your consultation hours and manage your weekly routine for agricultural advising.</p>
      </div>

      <!-- ========================
           SCHEDULE FORM
      ========================= -->
      <form id="scheduleForm" method="POST" action="{{ route('expert.schedule.save') }}">
        @csrf

        <!-- Day cards will be rendered here -->
        <div class="days-list" id="daysList">

          <!-- MONDAY (active) -->
          <div class="day-card day-card--active" data-day="monday">
            <div class="day-header">
              <div class="day-left">
                <span class="day-name">Monday</span>
                <label class="toggle">
                  <input type="checkbox" name="days[monday][active]" value="1" checked class="toggle-input" />
                  <span class="toggle-track"></span>
                </label>
              </div>
            </div>
            <div class="day-slots" id="slots-monday">
              <div class="slot-row" data-slot="0">
                <div class="slot-pill">
                  <input type="time" name="days[monday][slots][0][start]" value="09:00" class="time-input" />
                  <span class="slot-sep">–</span>
                  <input type="time" name="days[monday][slots][0][end]" value="12:00" class="time-input" />
                  <button type="button" class="slot-edit-btn" title="Edit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                  </button>
                  <button type="button" class="slot-remove-btn" title="Remove">
                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                  </button>
                </div>
              </div>
              <div class="slot-row" data-slot="1">
                <div class="slot-pill">
                  <input type="time" name="days[monday][slots][1][start]" value="14:00" class="time-input" />
                  <span class="slot-sep">–</span>
                  <input type="time" name="days[monday][slots][1][end]" value="17:00" class="time-input" />
                  <button type="button" class="slot-edit-btn" title="Edit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                  </button>
                  <button type="button" class="slot-remove-btn" title="Remove">
                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                  </button>
                </div>
              </div>
              <button type="button" class="btn-add-slot" data-day="monday">+ Add Time Slot</button>
            </div>
          </div>

          <!-- TUESDAY (active) -->
          <div class="day-card day-card--active" data-day="tuesday">
            <div class="day-header">
              <div class="day-left">
                <span class="day-name">Tuesday</span>
                <label class="toggle">
                  <input type="checkbox" name="days[tuesday][active]" value="1" checked class="toggle-input" />
                  <span class="toggle-track"></span>
                </label>
              </div>
            </div>
            <div class="day-slots" id="slots-tuesday">
              <div class="slot-row" data-slot="0">
                <div class="slot-pill">
                  <input type="time" name="days[tuesday][slots][0][start]" value="10:00" class="time-input" />
                  <span class="slot-sep">–</span>
                  <input type="time" name="days[tuesday][slots][0][end]" value="15:00" class="time-input" />
                  <button type="button" class="slot-edit-btn" title="Edit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                  </button>
                  <button type="button" class="slot-remove-btn" title="Remove">
                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                  </button>
                </div>
              </div>
              <button type="button" class="btn-add-slot" data-day="tuesday">+ Add Time Slot</button>
            </div>
          </div>

          <!-- WEDNESDAY (inactive) -->
          <div class="day-card day-card--inactive" data-day="wednesday">
            <div class="day-header">
              <div class="day-left">
                <span class="day-name">Wednesday</span>
                <label class="toggle">
                  <input type="checkbox" name="days[wednesday][active]" value="1" class="toggle-input" />
                  <span class="toggle-track"></span>
                </label>
              </div>
              <span class="unavailable-label">Unavailable</span>
            </div>
            <div class="day-slots" id="slots-wednesday" style="display:none;">
              <button type="button" class="btn-add-slot" data-day="wednesday">+ Add Time Slot</button>
            </div>
          </div>

          <!-- THURSDAY (active) -->
          <div class="day-card day-card--active" data-day="thursday">
            <div class="day-header">
              <div class="day-left">
                <span class="day-name">Thursday</span>
                <label class="toggle">
                  <input type="checkbox" name="days[thursday][active]" value="1" checked class="toggle-input" />
                  <span class="toggle-track"></span>
                </label>
              </div>
            </div>
            <div class="day-slots" id="slots-thursday">
              <div class="slot-row" data-slot="0">
                <div class="slot-pill">
                  <input type="time" name="days[thursday][slots][0][start]" value="09:00" class="time-input" />
                  <span class="slot-sep">–</span>
                  <input type="time" name="days[thursday][slots][0][end]" value="12:00" class="time-input" />
                  <button type="button" class="slot-edit-btn" title="Edit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                  </button>
                  <button type="button" class="slot-remove-btn" title="Remove">
                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                  </button>
                </div>
              </div>
              <button type="button" class="btn-add-slot" data-day="thursday">+ Add Time Slot</button>
            </div>
          </div>

          <!-- FRIDAY (active) -->
          <div class="day-card day-card--active" data-day="friday">
            <div class="day-header">
              <div class="day-left">
                <span class="day-name">Friday</span>
                <label class="toggle">
                  <input type="checkbox" name="days[friday][active]" value="1" checked class="toggle-input" />
                  <span class="toggle-track"></span>
                </label>
              </div>
            </div>
            <div class="day-slots" id="slots-friday">
              <div class="slot-row" data-slot="0">
                <div class="slot-pill">
                  <input type="time" name="days[friday][slots][0][start]" value="13:00" class="time-input" />
                  <span class="slot-sep">–</span>
                  <input type="time" name="days[friday][slots][0][end]" value="18:00" class="time-input" />
                  <button type="button" class="slot-edit-btn" title="Edit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                  </button>
                  <button type="button" class="slot-remove-btn" title="Remove">
                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                  </button>
                </div>
              </div>
              <button type="button" class="btn-add-slot" data-day="friday">+ Add Time Slot</button>
            </div>
          </div>

          <!-- SUNDAY (inactive) -->
          <div class="day-card day-card--inactive" data-day="sunday">
            <div class="day-header">
              <div class="day-left">
                <span class="day-name">Sunday</span>
                <label class="toggle">
                  <input type="checkbox" name="days[sunday][active]" value="1" class="toggle-input" />
                  <span class="toggle-track"></span>
                </label>
              </div>
              <span class="unavailable-label">Unavailable</span>
            </div>
            <div class="day-slots" id="slots-sunday" style="display:none;">
              <button type="button" class="btn-add-slot" data-day="sunday">+ Add Time Slot</button>
            </div>
          </div>

          <!-- SATURDAY (active) -->
          <div class="day-card day-card--active" data-day="saturday">
            <div class="day-header">
              <div class="day-left">
                <span class="day-name">Saturday</span>
                <label class="toggle">
                  <input type="checkbox" name="days[saturday][active]" value="1" checked class="toggle-input" />
                  <span class="toggle-track"></span>
                </label>
              </div>
            </div>
            <div class="day-slots" id="slots-saturday">
              <div class="slot-row" data-slot="0">
                <div class="slot-pill">
                  <input type="time" name="days[saturday][slots][0][start]" value="10:00" class="time-input" />
                  <span class="slot-sep">–</span>
                  <input type="time" name="days[saturday][slots][0][end]" value="14:00" class="time-input" />
                  <button type="button" class="slot-edit-btn" title="Edit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                  </button>
                  <button type="button" class="slot-remove-btn" title="Remove">
                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                  </button>
                </div>
              </div>
              <button type="button" class="btn-add-slot" data-day="saturday">+ Add Time Slot</button>
            </div>
          </div>

        </div><!-- /.days-list -->

        <!-- ========================
             SCHEDULING TIPS
        ========================= -->
        <div class="tips-card">
          <div class="tips-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/>
            </svg>
          </div>
          <div class="tips-body">
            <h4 class="tips-title">Scheduling Tips</h4>
            <ul class="tips-list">
              <li>Keep a <strong>15-minute buffer</strong> between consultations to prepare notes.</li>
              <li>Sync your Google Calendar to avoid overbooking.</li>
              <li>Most farmers prefer early morning or late evening slots.</li>
            </ul>
          </div>
        </div>

        <!-- ========================
             SAVE BUTTON
        ========================= -->
        <div class="save-row">
          <button type="submit" class="btn-save">
            <img src="{{ asset('images/ikon manageSchedule.png') }}" alt="save icon">
            Save Schedule
          </button>
        </div>

      </form>
    </main>
  </div><!-- /.layout -->
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

  <script src="{{ asset('js/script-manageSchedule.js') }}"></script>
</body>
</html>