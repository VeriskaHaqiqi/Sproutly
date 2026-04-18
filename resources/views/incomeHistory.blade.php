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
      <a href="{{ url('/ConsultationhistoryUser') }}" class="menu-link">
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
          <img src="{{ asset('images/fotoprofile.png') }}" alt="Expert"
               onerror="this.style.display='none';this.parentElement.classList.add('avatar-fallback')" />
        </div>
        <div class="topbar-info">
          <span class="topbar-name">Alex Green</span>
          <span class="topbar-role">Expert Botanist</span>
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
            <span class="summary-value" id="totalIncome">$2,847</span>
          </div>
        </div>
        <div class="summary-card card-month">
          <div class="summary-icon icon-sky">
            <i class="fa-solid fa-calendar-days"></i>
          </div>
          <div class="summary-body">
            <span class="summary-label">This Month</span>
            <span class="summary-value" id="monthIncome">$485</span>
          </div>
        </div>
        <div class="summary-card card-session">
          <div class="summary-icon icon-lime">
            <i class="fa-solid fa-comments"></i>
          </div>
          <div class="summary-body">
            <span class="summary-label">Completed Consultations</span>
            <span class="summary-value summary-small" id="sessionCount">23 sessions</span>
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

          <div class="tx-card" data-period="this-month">
            <div class="tx-avatar tx-avatar-blue"></div>
            <div class="tx-info">
              <span class="tx-name">Sarah Chen</span>
              <span class="tx-type">Chat Consultation</span>
              <span class="tx-date">Dec 15, 2024 · 2:30 PM</span>
            </div>
            <div class="tx-right">
              <span class="tx-amount">$45</span>
              <span class="tx-badge badge-paid">● Paid</span>
              <span class="tx-id">ID: #CON-2847</span>
            </div>
          </div>

          <div class="tx-card" data-period="this-month">
            <div class="tx-avatar tx-avatar-green"></div>
            <div class="tx-info">
              <span class="tx-name">Michael Rodriguez</span>
              <span class="tx-type">Video Call</span>
              <span class="tx-date">Dec 14, 2024 · 10:15 AM</span>
            </div>
            <div class="tx-right">
              <span class="tx-amount">$85</span>
              <span class="tx-badge badge-paid">● Paid</span>
              <span class="tx-id">ID: #CON-2846</span>
            </div>
          </div>

          <div class="tx-card" data-period="this-month">
            <div class="tx-avatar tx-avatar-orange"></div>
            <div class="tx-info">
              <span class="tx-name">Emma Johnson</span>
              <span class="tx-type">Plant Care Plan</span>
              <span class="tx-date">Dec 13, 2024 · 4:45 PM</span>
            </div>
            <div class="tx-right">
              <span class="tx-amount">$65</span>
              <span class="tx-badge badge-pending">● Pending</span>
              <span class="tx-id">ID: #CON-2845</span>
            </div>
          </div>

          <div class="tx-card" data-period="this-month">
            <div class="tx-avatar tx-avatar-teal"></div>
            <div class="tx-info">
              <span class="tx-name">David Park</span>
              <span class="tx-type">Chat Consultation</span>
              <span class="tx-date">Dec 12, 2024 · 11:20 AM</span>
            </div>
            <div class="tx-right">
              <span class="tx-amount">$45</span>
              <span class="tx-badge badge-paid">● Paid</span>
              <span class="tx-id">ID: #CON-2844</span>
            </div>
          </div>

          <div class="tx-card" data-period="this-month">
            <div class="tx-avatar tx-avatar-green"></div>
            <div class="tx-info">
              <span class="tx-name">Lisa Thompson</span>
              <span class="tx-type">Video Call</span>
              <span class="tx-date">Dec 11, 2024 · 3:00 PM</span>
            </div>
            <div class="tx-right">
              <span class="tx-amount">$85</span>
              <span class="tx-badge badge-paid">● Paid</span>
              <span class="tx-id">ID: #CON-2843</span>
            </div>
          </div>

          <div class="tx-card" data-period="last-month">
            <div class="tx-avatar tx-avatar-blue"></div>
            <div class="tx-info">
              <span class="tx-name">Rachel Kim</span>
              <span class="tx-type">Plant Care Plan</span>
              <span class="tx-date">Nov 28, 2024 · 9:00 AM</span>
            </div>
            <div class="tx-right">
              <span class="tx-amount">$120</span>
              <span class="tx-badge badge-paid">● Paid</span>
              <span class="tx-id">ID: #CON-2842</span>
            </div>
          </div>

          <div class="tx-card" data-period="last-month">
            <div class="tx-avatar tx-avatar-orange"></div>
            <div class="tx-info">
              <span class="tx-name">James Wu</span>
              <span class="tx-type">Video Call</span>
              <span class="tx-date">Nov 20, 2024 · 1:30 PM</span>
            </div>
            <div class="tx-right">
              <span class="tx-amount">$85</span>
              <span class="tx-badge badge-paid">● Paid</span>
              <span class="tx-id">ID: #CON-2841</span>
            </div>
          </div>

          <div class="tx-card" data-period="last-month">
            <div class="tx-avatar tx-avatar-teal"></div>
            <div class="tx-info">
              <span class="tx-name">Sophia Martinez</span>
              <span class="tx-type">Chat Consultation</span>
              <span class="tx-date">Nov 15, 2024 · 11:00 AM</span>
            </div>
            <div class="tx-right">
              <span class="tx-amount">$45</span>
              <span class="tx-badge badge-pending">● Pending</span>
              <span class="tx-id">ID: #CON-2840</span>
            </div>
          </div>

        </div>

        <div class="empty-state hidden" id="emptyState">
          <i class="fa-solid fa-inbox" style="font-size:48px;color:#c5ddd7;margin-bottom:14px;"></i>
          <p>No transactions found for this period.</p>
        </div>
      </section>

      <!-- WEEKLY CHART -->
      <section class="chart-section">
        <h2 class="chart-title">Weekly Earnings Trend</h2>
        <div class="chart-wrap">
          <div class="bar-chart">
            <div class="bar-col">
              <div class="bar-value">$125</div>
              <div class="bar-bg"><div class="bar-fill" style="height:44%" data-color="mint"></div></div>
              <div class="bar-label">Mon</div>
            </div>
            <div class="bar-col">
              <div class="bar-value">$180</div>
              <div class="bar-bg"><div class="bar-fill" style="height:63%" data-color="sky"></div></div>
              <div class="bar-label">Tue</div>
            </div>
            <div class="bar-col">
              <div class="bar-value">$225</div>
              <div class="bar-bg"><div class="bar-fill" style="height:79%" data-color="lime1"></div></div>
              <div class="bar-label">Wed</div>
            </div>
            <div class="bar-col">
              <div class="bar-value">$285</div>
              <div class="bar-bg"><div class="bar-fill" style="height:100%" data-color="yellow"></div></div>
              <div class="bar-label">Thu</div>
            </div>
            <div class="bar-col">
              <div class="bar-value">$200</div>
              <div class="bar-bg"><div class="bar-fill" style="height:70%" data-color="lime2"></div></div>
              <div class="bar-label">Fri</div>
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