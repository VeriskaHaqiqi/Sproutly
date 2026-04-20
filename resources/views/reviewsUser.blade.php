<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Reviews - Sproutly</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/style-reviewsUser.css') }}">
</head>
<body>
<div class="dashboard-page">

  <!-- SIDEBAR (exact dashboard-user) -->
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
      <a href="{{ url('/reviewsUser') }}"         class="menu-link active"><i class="fa-solid fa-star"></i><span>Reviews</span></a>
      <a href="{{ url('/invoice') }}"             class="menu-link"><i class="fa-solid fa-credit-card"></i><span>Payment</span></a>
      <a href="{{ url('/accountUser') }}"         class="menu-link"><i class="fa-solid fa-gear"></i><span>Setting</span></a>
    </nav>
  </aside>

  <!-- MAIN -->
  <main class="main-content full" id="mainContent">

    <!-- TOPBAR (exact dashboard-user) -->
    <header class="topbar">
      <div class="topbar-left">
        <button class="menu-toggle" id="menuToggle" type="button" aria-label="Toggle sidebar">
          <svg viewBox="0 0 24 24" fill="none">
            <path d="M4 7H20" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/>
            <path d="M4 12H20" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/>
            <path d="M4 17H20" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/>
          </svg>
        </button>
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
          <span class="profile-name">Sarah Green</span>
          <img src="{{ asset('images/fotoprofile.png') }}" alt="Profile">
        </a>
      </div>
    </header>

    <!-- CONTENT -->
    <section class="content-wrap">

      <!-- Page title -->
      <div class="page-title">
        <h1>My Reviews</h1>
        <p>View and manage the feedback you've given to experts.</p>
      </div>

      <!-- Filter bar -->
      <div class="filter-bar">
        <div class="search-group">
          <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
          </svg>
          <input type="text" id="searchInput" placeholder="Search expert name or consultation...">
        </div>
        <div class="dropdown-group">
          <div class="select-wrapper">
            <select id="ratingFilter">
              <option value="all">All Ratings</option>
              <option value="5">5 Stars</option>
              <option value="4">4 Stars</option>
              <option value="3">3 Stars</option>
              <option value="2">2 Stars</option>
              <option value="1">1 Star</option>
            </select>
          </div>
          <div class="select-wrapper">
            <select id="categoryFilter">
              <option value="all">All Specialties</option>
              <option value="Crop Specialist">Crop Specialist</option>
              <option value="Irrigation Expert">Irrigation Expert</option>
              <option value="Soil Scientist">Soil Scientist</option>
              <option value="Pest Control">Pest Control</option>
              <option value="Organic Farming">Organic Farming</option>
              <option value="Hydroponics">Hydroponics</option>
              <option value="Plant Disease">Plant Disease</option>
            </select>
          </div>
        </div>
      </div>

      <!-- Reviews list -->
      <div id="reviewsContainer" class="reviews-list"></div>

      <div class="load-more-wrapper">
        <button id="loadMoreBtn" class="btn-load-more">Load More Reviews</button>
      </div>

    </section>

    <!-- FOOTER (exact dashboard-user) -->
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

  </main>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal-overlay hidden" id="deleteModal">
  <div class="modal-card">
    <div class="modal-icon">
      <svg viewBox="0 0 24 24" fill="none" width="28" height="28">
        <path d="M3 6H21" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
        <path d="M8 6V4H16V6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M19 6L18.2 19.1C18.1 20.2 17.1 21 16 21H8C6.9 21 5.9 20.2 5.8 19.1L5 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
        <path d="M10 11V17" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
        <path d="M14 11V17" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
      </svg>
    </div>
    <h3>Delete Review</h3>
    <p>Are you sure you want to delete your review for <strong id="deleteExpertName"></strong>? This action cannot be undone.</p>
    <div class="modal-actions">
      <button class="modal-cancel-btn" id="deleteCancelBtn" type="button">Cancel</button>
      <button class="modal-confirm-btn" id="deleteConfirmBtn" type="button">Yes, Delete</button>
    </div>
  </div>
</div>

<script src="{{ asset('js/script-reviewsUser.js') }}"></script>
</body>
</html>