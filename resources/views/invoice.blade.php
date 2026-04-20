<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sproutly - Invoices</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/style-invoice.css') }}">
</head>
<body>
<div class="dashboard-page">

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
      <a href="{{ url('/dashboard-user') }}"      class="menu-link"><i class="fa-solid fa-chart-line"></i><span>Dashboard</span></a>
      <a href="{{ url('/consultationUser') }}"    class="menu-link"><i class="fa-solid fa-comments"></i><span>Consultation</span></a>
      <a href="{{ url('/daftarArtikel') }}"       class="menu-link"><i class="fa-solid fa-newspaper"></i><span>Article</span></a>
      <a href="{{ url('/bookmarkArtikelUser') }}" class="menu-link"><i class="fa-solid fa-bookmark"></i><span>Bookmarked Article</span></a>
      <a href="{{ url('/reviewsUser') }}"         class="menu-link"><i class="fa-solid fa-star"></i><span>Reviews</span></a>
      <a href="{{ url('/invoice') }}"             class="menu-link active"><i class="fa-solid fa-credit-card"></i><span>Payment</span></a>
      <a href="{{ url('/supportUser') }}"         class="menu-link"><i class="fa-solid fa-gear"></i><span>Setting</span></a>
    </nav>
  </aside>

  <!-- MAIN -->
  <main class="main-content full" id="mainContent">

    <!-- TOPBAR -->
    <header class="topbar">
      <div class="topbar-left">
        <button class="menu-toggle" id="menuToggle" type="button" aria-label="Toggle sidebar">
          <svg viewBox="0 0 24 24" fill="none">
            <path d="M4 7H20" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/>
            <path d="M4 12H20" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/>
            <path d="M4 17H20" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/>
          </svg>
        </button>
        <div class="topbar-search">
          <svg viewBox="0 0 24 24" fill="none"><circle cx="11" cy="11" r="6.5" stroke="currentColor" stroke-width="2"/><path d="M16 16L20 20" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
          <input type="text" placeholder="Search consultations, articles, experts..."/>
        </div>
      </div>
      <div class="topbar-right">
        <button class="notif-btn" type="button">
          <svg viewBox="0 0 24 24" fill="none">
            <path d="M8 18H16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            <path d="M10 20C10.5 21 11.1 21.5 12 21.5C12.9 21.5 13.5 21 14 20" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            <path d="M18 17H6C6.9 16.2 7.5 15 7.5 13.8V10.8C7.5 8.2 9.4 6 12 6C14.6 6 16.5 8.2 16.5 10.8V13.8C16.5 15 17.1 16.2 18 17Z" fill="currentColor"/>
          </svg>
        </button>
        <a href="{{ url('/accountUser') }}" class="profile-chip">
          <div class="profile-info">
            <span class="profile-name">Sarah Green</span>
            <span class="profile-role">Agriculture Expert</span>
          </div>
          <img src="{{ asset('images/fotoprofile.png') }}" alt="Profile">
        </a>
      </div>
    </header>

    <!-- CONTENT -->
    <section class="content-wrap">

      <!-- Page header -->
      <div class="page-header">
        <div>
          <h1>Invoices</h1>
          <p>Manage and track all consultation invoices</p>
        </div>
        <div class="page-header-actions">
          <button class="filter-btn" id="filterToggle" type="button">
            <i class="fa-solid fa-filter"></i> Filter
          </button>
          <button class="new-invoice-btn" type="button">
            New Invoice
          </button>
        </div>
      </div>

      <!-- Filter panel (hidden by default) -->
      <div class="filter-panel hidden" id="filterPanel">
        <div class="filter-row">
          <select id="filterStatus">
            <option value="">All Status</option>
            <option value="Paid">Paid</option>
            <option value="Pending">Pending</option>
            <option value="Refund">Refund</option>
          </select>
          <input type="text" id="filterSearch" placeholder="Search by expert or consultation..."/>
          <button class="filter-reset-btn" id="filterReset" type="button">Reset</button>
        </div>
      </div>

      <!-- Stats cards -->
      <div class="stats-row">
        <div class="stat-card">
          <div class="stat-body">
            <p class="stat-label">Total Outstanding</p>
            <h2 class="stat-value">$24,580</h2>
            <span class="stat-sub positive">+12% from last month</span>
          </div>
          <div class="stat-icon-box red">
            <svg viewBox="0 0 24 24" fill="none" width="22" height="22">
              <path d="M12 9V13M12 17H12.01M10.29 3.86L1.82 18A2 2 0 003.54 21H20.46A2 2 0 0022.18 18L13.71 3.86A2 2 0 0010.29 3.86Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-body">
            <p class="stat-label">Paid This Month</p>
            <h2 class="stat-value">$45,230</h2>
            <span class="stat-sub positive">+8% from last month</span>
          </div>
          <div class="stat-icon-box green">
            <svg viewBox="0 0 24 24" fill="none" width="22" height="22">
              <path d="M22 11.08V12A10 10 0 1112 2a10 10 0 0110 9.92" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M22 4L12 14.01L9 11.01" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-body">
            <p class="stat-label">Pending Review</p>
            <h2 class="stat-value">18</h2>
            <span class="stat-sub urgent">3 urgent</span>
          </div>
          <div class="stat-icon-box yellow">
            <svg viewBox="0 0 24 24" fill="none" width="22" height="22">
              <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
              <path d="M12 6V12L16 14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
        </div>
      </div>

      <!-- Table -->
      <div class="table-card">
        <table class="invoice-table">
          <thead>
            <tr>
              <th>Invoice ID</th>
              <th>Expert</th>
              <th>Consultation</th>
              <th>Amount</th>
              <th>Due Date</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="invoiceTableBody"></tbody>
        </table>

        <!-- Pagination -->
        <div class="table-footer">
          <span class="showing-text" id="showingText">Showing 1 to 5 of 47 results</span>
          <div class="pagination" id="pagination"></div>
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
          <a href="#">Our Team</a><a href="#">Blog</a><a href="#">Privacy Policy</a>
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
<script src="{{ asset('js/script-invoice.js') }}"></script>
</body>
</html>