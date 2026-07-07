<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Income History – Sproutly</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/style-incomeHistory.css') }}" />
</head>
<body>
<div class="layout">

  <!-- ===== SIDEBAR ===== -->
  <aside class="sidebar closed" id="sidebar">
    <div class="sidebar-header">
      <a href="{{ url('/homeExpert') }}" class="logo-wrap">
        <div class="logo-box">
          <img src="{{ asset('images/logo.png') }}" alt="Sproutly Logo" class="logo-img">
        </div>
        <span class="logo-text">Sproutly</span>
      </a>
    </div>

    <div class="sidebar-line"></div>

    <nav class="sidebar-menu">
      <a href="{{ url('/dashboard-ahli') }}" class="menu-link">
        <i class="fa-solid fa-chart-line"></i><span>Dashboard</span>
      </a>
      <a href="{{ url('/consulexpert') }}" class="menu-link">
        <i class="fa-solid fa-comments"></i><span>Consultation</span>
      </a>
      <a href="{{ url('/articleExpert') }}" class="menu-link">
        <i class="fa-solid fa-newspaper"></i><span>Article</span>
      </a>
      <a href="{{ url('/myarticleExpert') }}" class="menu-link">
        <i class="fa-solid fa-file-pen"></i><span>My Article</span>
      </a>
      <a href="{{ url('/setpricingexpert') }}" class="menu-link">
        <i class="fa-solid fa-tag"></i><span>Pricing</span>
      </a>
      <a href="{{ url('/ConsultationhistoryExpert') }}" class="menu-link">
        <i class="fa-solid fa-clock-rotate-left"></i><span>Client History</span>
      </a>
      <a href="{{ url('/accountExpert') }}" class="menu-link">
        <i class="fa-solid fa-gear"></i><span>Setting</span>
      </a>
    </nav>
  </aside>

  <!-- ===== MAIN CONTENT ===== -->
  <div class="main-content full" id="mainContent">

    <!-- TOPBAR -->
    <header class="topbar">
      <div class="topbar-left">
        <button class="burger-btn" id="sidebarToggle" type="button" aria-label="Toggle sidebar">
          <span></span><span></span><span></span>
        </button>
        <div class="page-breadcrumb">
          <span class="breadcrumb-parent">Payment</span>
          <span class="breadcrumb-sep">/</span>
          <span class="breadcrumb-current">Income History</span>
        </div>
      </div>
      <div class="topbar-right">
        <div class="topbar-avatar">
          <img src="{{ auth()->check() && auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('images/fotoprofile.png') }}" alt="Expert"
               onerror="this.style.display='none';this.parentElement.classList.add('avatar-fallback')" />
        </div>
        <div class="topbar-info">
          <span class="topbar-name">{{ auth()->check() ? auth()->user()->nama_user : 'Alex Green' }}</span>
          <span class="topbar-role">{{ auth()->check() && auth()->user()->role === 'ahli' ? 'Expert Botanist' : 'User' }}</span>
        </div>
      </div>
    </header>

    <!-- SCROLLABLE BODY -->
    <div class="content-body">

      <!-- PAGE HEADING -->
      <div class="page-heading">
        <h1 class="page-title">Income History</h1>
        <p class="page-sub">Track your consultation earnings and payment records</p>
      </div>

      <!-- SUMMARY CARDS -->
      <section class="summary-section">
        <div class="summary-card card-total">
          <div class="summary-icon icon-mint">
            <i class="fa-solid fa-wallet"></i>
          </div>
          <div class="summary-body">
            <span class="summary-label">Total Income</span>
            <span class="summary-value" id="totalIncome">Rp {{ number_format($totalIncome, 0, ',', '.') }}</span>
          </div>
        </div>
        <div class="summary-card card-month">
          <div class="summary-icon icon-sky">
            <i class="fa-solid fa-calendar-days"></i>
          </div>
          <div class="summary-body">
            <span class="summary-label">This Month</span>
            <span class="summary-value" id="monthIncome">Rp {{ number_format($thisMonthIncome, 0, ',', '.') }}</span>
          </div>
        </div>
        <div class="summary-card card-session">
          <div class="summary-icon icon-lime">
            <i class="fa-solid fa-comments"></i>
          </div>
          <div class="summary-body">
            <span class="summary-label">Completed Consultations</span>
            <span class="summary-value summary-small" id="sessionCount">{{ $totalSessions }} sessions</span>
          </div>
        </div>
      </section>

      <!-- FILTER ROW -->
      <div class="filter-row">
        <div class="filter-tabs">
          <button class="filter-tab active" data-filter="all" type="button">All Time</button>
          <button class="filter-tab" data-filter="this-month" type="button">This Month</button>
          <button class="filter-tab" data-filter="last-month" type="button">Last Month</button>
        </div>
        <div class="sort-wrap">
          <i class="fa-solid fa-arrow-down-wide-short"></i>
          <span>Newest</span>
        </div>
      </div>

      <!-- TRANSACTION LIST -->
      <section class="transaction-section">
        <div class="transaction-list" id="transactionList">
          @forelse($transactions as $tx)
            <div class="tx-card" data-period="{{ $tx['period'] }}">
              <div class="tx-avatar tx-avatar-blue"></div>
              <div class="tx-info">
                <span class="tx-name">{{ $tx['user_name'] }}</span>
                <span class="tx-type">{{ $tx['type'] }}</span>
                <span class="tx-date">{{ $tx['date'] }}</span>
              </div>
              <div class="tx-right">
                <span class="tx-amount">Rp {{ number_format($tx['amount'], 0, ',', '.') }}</span>
                <span class="tx-badge {{ $tx['badge_class'] }}">● {{ $tx['status'] }}</span>
                <span class="tx-id">ID: #CON-{{ str_pad($tx['id'], 4, '0', STR_PAD_LEFT) }}</span>
              </div>
            </div>
          @empty
            <div class="empty-state" id="emptyState" style="display:flex;">
              <i class="fa-solid fa-inbox" style="font-size:48px;color:#c5ddd7;margin-bottom:14px;"></i>
              <p>No completed consultations yet.</p>
            </div>
          @endforelse
        </div>

        <div class="empty-state hidden" id="emptyStateFilter">
          <i class="fa-solid fa-inbox" style="font-size:48px;color:#c5ddd7;margin-bottom:14px;"></i>
          <p>No transactions found for this period.</p>
        </div>
      </section>

      <!-- WEEKLY CHART -->
      <section class="chart-section">
        <h2 class="chart-title">Weekly Earnings Trend</h2>
        <div class="chart-wrap">
          <div class="line-chart-container">
            <svg class="line-chart" viewBox="0 0 500 200" preserveAspectRatio="none">
              <defs>
                <linearGradient id="chartGradient" x1="0" y1="0" x2="0" y2="1">
                  <stop offset="0%" stop-color="#169857" stop-opacity="0.35"/>
                  <stop offset="100%" stop-color="#169857" stop-opacity="0"/>
                </linearGradient>
              </defs>
              
              <!-- Grid lines -->
              <line x1="0" y1="40" x2="500" y2="40" stroke="#e1e8e6" stroke-width="1" stroke-dasharray="5,5" />
              <line x1="0" y1="90" x2="500" y2="90" stroke="#e1e8e6" stroke-width="1" stroke-dasharray="5,5" />
              <line x1="0" y1="140" x2="500" y2="140" stroke="#e1e8e6" stroke-width="1" stroke-dasharray="5,5" />
              
              <!-- Area under path -->
              <path d="M 50 144 L 150 110 L 250 82 L 350 46 L 450 64 L 450 200 L 50 200 Z" fill="url(#chartGradient)"></path>
              
              <!-- The Line -->
              <path d="M 50 144 L 150 110 L 250 82 L 350 46 L 450 64" fill="none" stroke="#169857" stroke-width="4" stroke-linecap="round"></path>
              
              <!-- Data Points (Circles) -->
              <circle cx="50" cy="144" r="6" fill="#ffffff" stroke="#169857" stroke-width="3"></circle>
              <circle cx="150" cy="110" r="6" fill="#ffffff" stroke="#169857" stroke-width="3"></circle>
              <circle cx="250" cy="82" r="6" fill="#ffffff" stroke="#169857" stroke-width="3"></circle>
              <circle cx="350" cy="46" r="6" fill="#ffffff" stroke="#169857" stroke-width="3"></circle>
              <circle cx="450" cy="64" r="6" fill="#ffffff" stroke="#169857" stroke-width="3"></circle>
            </svg>
            
            <div class="chart-labels">
              <div class="chart-label-item">
                <span class="tooltip">Rp 125.000</span>
                <span class="day">Mon</span>
              </div>
              <div class="chart-label-item">
                <span class="tooltip">Rp 180.000</span>
                <span class="day">Tue</span>
              </div>
              <div class="chart-label-item">
                <span class="tooltip">Rp 225.000</span>
                <span class="day">Wed</span>
              </div>
              <div class="chart-label-item">
                <span class="tooltip">Rp 285.000</span>
                <span class="day">Thu</span>
              </div>
              <div class="chart-label-item">
                <span class="tooltip">Rp 200.000</span>
                <span class="day">Fri</span>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- FOOTER -->
      <footer class="site-footer">
        <div class="footer-grid">
          <div class="footer-brand">
            <div class="footer-brand-top">
              <div class="footer-logo-box">
                <img src="{{ asset('images/logo.png') }}" alt="Sproutly Logo" class="footer-logo">
              </div>
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

    </div><!-- end content-body -->
  </div><!-- end main-content -->
</div><!-- end layout -->

<script src="{{ asset('js/script-incomeHistory.js') }}"></script>
</body>
</html>