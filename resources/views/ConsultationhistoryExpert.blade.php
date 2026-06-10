<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sproutly - Consultation History</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/style-ConsultationhistoryExpert.css') }}">
</head>
<body>
<div class="layout">

  <!-- SIDEBAR -->
  <aside class="sidebar closed" id="sidebar">
    <div class="sidebar-header">
      <a href="{{ url('/homeExpert') }}" class="logo-wrap">
        <div class="logo-box">
          <img src="{{ asset('images/logo.png') }}" alt="Sproutly" class="logo-img">
        </div>
        <span class="logo-text">Sproutly</span>
      </a>
    </div>
    <div class="sidebar-line"></div>
    <nav class="sidebar-menu">
      <a href="{{ url('/dashboard-ahli') }}"         class="menu-link"><i class="fa-solid fa-chart-line"></i><span>Dashboard</span></a>
      <a href="{{ url('/consulexpert') }}"            class="menu-link"><i class="fa-solid fa-comments"></i><span>Consultation</span></a>
      <a href="{{ url('/articleExpert') }}"           class="menu-link"><i class="fa-solid fa-newspaper"></i><span>Article</span></a>
      <a href="{{ url('/myarticleExpert') }}"         class="menu-link child-link"><i class="fa-solid fa-file-lines"></i><span>My Article</span></a>
      <a href="{{ url('/setpricingexpert') }}"        class="menu-link child-link"><i class="fa-solid fa-dollar-sign"></i><span>Pricing</span></a>
      <a href="{{ url('/ConsultationhistoryExpert') }}" class="menu-link child-link active"><i class="fa-solid fa-clock-rotate-left"></i><span>Client History</span></a>
      <a href="{{ url('/accountExpert') }}"           class="menu-link child-link"><i class="fa-solid fa-gear"></i><span>Setting</span></a>
    </nav>
  </aside>

  <!-- MAIN -->
  <main class="main-content full" id="mainContent">

    <!-- TOPBAR -->
    <header class="topbar">
      <div class="topbar-left">
        <button class="sidebar-toggle" id="sidebarToggle" type="button">
          <span></span><span></span><span></span>
        </button>

      </div>
      <div class="topbar-right">
        <button class="notif-btn" type="button">
          <i class="fa-solid fa-bell"></i>
          <span class="notif-dot"></span>
        </button>
        <a href="{{ url('/accountExpert') }}" class="profile-chip">
          <div class="profile-info">
            <span class="profile-name">Sarah Green</span>
            <span class="profile-role">Agriculture Expert</span>
          </div>
          <img src="{{ asset('images/fotoprofile.png') }}" alt="Profile">
        </a>
      </div>
    </header>

    <!-- HERO BANNER -->
    <div class="hero-banner">
      <h1>Consultation History</h1>
      <p>Track and manage your agricultural consultations</p>
    </div>

    <!-- FILTER BAR -->
    <div class="filter-bar">
      <div class="search-group">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" id="searchInput" placeholder="Search consultations...">
      </div>
      <div class="select-wrapper">
        <select id="statusFilter">
          <option value="">All Status</option>
          <option value="Completed">Completed</option>
          <option value="Ongoing">Ongoing</option>
          <option value="Cancelled">Cancelled</option>
        </select>
        <i class="fa-solid fa-chevron-down sel-arrow"></i>
      </div>
      <div class="select-wrapper">
        <select id="paymentFilter">
          <option value="">Payment Status</option>
          <option value="Paid">Paid</option>
          <option value="Refunded">Refunded</option>
        </select>
        <i class="fa-solid fa-chevron-down sel-arrow"></i>
      </div>
      <input type="date" id="dateFilter" class="date-input-plain">

    </div>

    <!-- TABLE CARD -->
    <div class="table-wrap">
      <table class="consult-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Client</th>
            <th>Topic</th>
            <th>Date</th>
            <th>Status</th>
            <th>Payment</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="tableBody"></tbody>
      </table>

      <!-- Pagination -->
      <div class="pagination-wrap">
        <div class="pagination" id="pagination"></div>
      </div>
    </div>

  </main>
</div>

<!-- Detail Modal -->
<div class="modal-overlay hidden" id="detailModal">
  <div class="modal-card">
    <div class="modal-header">
      <h3>Consultation Details</h3>
      <button class="modal-close" id="modalClose" type="button"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="modal-body" id="modalBody">
      <!-- filled by JS -->
    </div>
  </div>
</div>

<script src="{{ asset('js/script-ConsultationhistoryExpert.js') }}"></script>
</body>
</html>