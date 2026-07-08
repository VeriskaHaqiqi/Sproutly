<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sproutly - Manage Schedule</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="{{ asset('css/style-manageSchedule.css') }}">
</head>
<body>

  <div class="sidebar-overlay" id="sidebarOverlay"></div>

  <aside class="sidebar closed" id="sidebar">
    <div class="sidebar-header">
      <a href="{{ route('homeExpert') }}" class="logo-wrap">
        <div class="logo-box">
          <img src="{{ asset('images/logo.png') }}" class="logo-img">
        </div>
        <span class="logo-text">Sproutly</span>
      </a>
    </div>

    <div class="sidebar-line"></div>

    <nav class="sidebar-menu">
      <a href="{{ route('dashboard-ahli') }}" class="menu-link {{ request()->routeIs('dashboard-ahli') ? 'active' : '' }}">
        <img src="{{ asset('images/dashboard.png') }}">
        <span>Dashboard</span>
      </a>
      <a href="#" class="menu-link active">
        <img src="{{ asset('images/schedule.png') }}">
        <span>Manage Schedule</span>
      </a>
    </nav>
  </aside>

  <div class="layout" id="mainContent">
    <header class="site-header">
      <button class="menu-toggle" id="menuToggle" aria-label="Toggle Sidebar">
        <i class="fa-solid fa-bars"></i>
      </button>
      <div class="header-right">
        <span class="welcome-text">Welcome, {{ Auth::user()->name }}</span>
        <div class="profile-box">
          <img src="{{ asset('images/profil.jpg') }}" alt="Profile">
        </div>
      </div>
    </header>

    <main class="main-padding">
      <div class="page-title-area">
        <h1>Manage Consultation Schedule</h1>
        <p>Set your availability slots so users can discover and book consultations with you.</p>
      </div>

      @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 12px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
      @endif

      @if(session('error'))
        <div style="background: #f8d7da; color: #721c24; padding: 12px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('error') }}
        </div>
      @endif

      <form action="{{ route('saveScheduleWeb') }}" method="POST" id="scheduleForm">
        @csrf

        <div class="schedule-container" id="daysList">
          @php
            $listHari = [
                'monday'    => 'Monday',
                'tuesday'   => 'Tuesday',
                'wednesday' => 'Wednesday',
                'thursday'  => 'Thursday',
                'friday'    => 'Friday',
                'saturday'  => 'Saturday',
                'sunday'    => 'Sunday'
            ];
          @endphp

          @foreach($listHari as $key => $label)
            @php
              // Membaca data berdasarkan struktur array rute GET kamu ($jadwalData)
              $isHariAktif = isset($jadwalData[$key]) && $jadwalData[$key]['active'];
              $slotsTersimpan = $jadwalData[$key]['slots'] ?? [];
            @endphp

            <div class="day-card {{ $isHariAktif ? 'day-card--active' : 'day-card--inactive' }}" data-day="{{ $key }}">
              <div class="day-header">
                <label class="switch-control">
                  <input type="checkbox" name="days[{{ $key }}][active]" value="1" class="toggle-input" {{ $isHariAktif ? 'checked' : '' }}>
                  <span class="control-slider"></span>
                </label>
                <span class="day-name">{{ $label }}</span>
                
                <span class="unavailable-label" style="{{ $isHariAktif ? 'display: none;' : '' }}">Unavailable</span>
              </div>

              <div class="day-slots" style="{{ $isHariAktif ? '' : 'display: none;' }}">
                <div id="slots-{{ $key }}">
                  
                  @foreach($slotsTersimpan as $index => $slot)
                    <div class="slot-row" data-slot="{{ $index }}">
                      <div class="slot-pill">
                        <input type="time" name="days[{{ $key }}][slots][{{ $index }}][start]" value="{{ substr($slot['start'], 0, 5) }}" class="time-input">
                        <span class="slot-sep">–</span>
                        <input type="time" name="days[{{ $key }}][slots][{{ $index }}][end]" value="{{ substr($slot['end'], 0, 5) }}" class="time-input">
                        <button type="button" class="slot-edit-btn" title="Edit">
                          <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        </button>
                        <button type="button" class="slot-remove-btn" title="Remove">
                          <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        </button>
                      </div>
                    </div>
                  @endforeach

                  <button type="button" class="btn-add-slot" data-day="{{ $key }}">
                    <span>+ Add Slot</span>
                  </button>
                </div>
              </div>
            </div>
          @endforeach

        </div><div class="form-actions">
          <button type="submit" class="save-schedule-btn">Save Schedule</button>
        </div>

      </form>
    </main>
  </div>

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
      </div>
    </div>
    <div class="footer-bottom">
      &copy; {{ date('Y') }} Sproutly. All rights reserved.
    </div>
  </footer>

  <script src="{{ asset('js/script-manageSchedule.js') }}"></script>
</body>
</html>