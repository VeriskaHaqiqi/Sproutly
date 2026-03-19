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
        <span>My Article</span>
      </a>
      <a href="#" class="sidebar-link">
        <img src="{{ asset('images/reviews.png') }}" alt="" class="nav-icon" width="20"/>
        <span>Pricing</span>
      </a>
      <a href="#" class="sidebar-link">
        <img src="{{ asset('images/payment.png') }}" alt="" class="nav-icon" width="20"/>
        <span>Client History</span>
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
      <span class="topnav-brand">Sproutly</span>
      <span class="topnav-title">Manage Schedule</span>
      <div class="topnav-spacer"></div>
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

      <!-- Footer -->
      <p class="page-footer">© 2024 Sproutly Agricultural Solutions. All rights reserved.</p>

    </main>
  </div><!-- /.layout -->

  <script src="{{ asset('js/script-manageSchedule.js') }}"></script>
</body>
</html>