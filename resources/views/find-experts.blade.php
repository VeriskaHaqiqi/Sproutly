<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sproutly - Find Experts</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/style-find-experts.css') }}">
</head>
<body>
  <div class="dashboard-page">

    <!-- ===== SIDEBAR ===== -->
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
        <a href="{{ url('/dashboard-user') }}" class="menu-link"><i class="fa-solid fa-chart-line"></i><span>Dashboard</span></a>
        <a href="{{ url('/consultationUser') }}" class="menu-link"><i class="fa-solid fa-comments"></i><span>Consultation</span></a>
        <a href="{{ url('/daftarArtikel') }}" class="menu-link"><i class="fa-solid fa-newspaper"></i><span>Article</span></a>
        <a href="{{ url('/bookmarkArtikelUser') }}" class="menu-link"><i class="fa-solid fa-bookmark"></i><span>Bookmarked Article</span></a>
        <a href="{{ url('/reviewsUser') }}" class="menu-link"><i class="fa-solid fa-star"></i><span>Reviews</span></a>
        <a href="{{ url('/invoice') }}" class="menu-link"><i class="fa-solid fa-credit-card"></i><span>Payment</span></a>
        <a href="{{ url('/accountUser') }}" class="menu-link"><i class="fa-solid fa-gear"></i><span>Setting</span></a>
      </nav>
    </aside>

    <!-- ===== MAIN ===== -->
    <main class="main-content full" id="mainContent">

      <!-- Topbar -->
      <header class="topbar">
        <div class="topbar-row1">
          <div class="topbar-left">
            <button class="menu-toggle" id="menuToggle" type="button" aria-label="Toggle sidebar">
              <svg viewBox="0 0 24 24" fill="none">
                <path d="M4 7H20" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/>
                <path d="M4 12H20" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/>
                <path d="M4 17H20" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/>
              </svg>
            </button>
            <h1 class="page-title">Find Experts</h1>
          </div>
          <div class="topbar-right">
            <div class="search-box">
              <span class="search-icon"><svg viewBox="0 0 24 24" fill="none"><circle cx="11" cy="11" r="6.5" stroke="currentColor" stroke-width="2.2"/><path d="M16 16L20 20" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/></svg></span>
              <input type="text" id="expertSearch" placeholder="Search experts...">
            </div>
            <button class="notif-btn" type="button" aria-label="Notifications">
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
        </div>
        <div class="topbar-row2">
          <div class="filters-row">
            <div class="filter-group dropdown" id="specializationDropdown">
              <button class="filter-btn" type="button"><span>Specialization</span><svg viewBox="0 0 24 24" fill="none"><path d="M6 9L12 15L18 9" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
              <div class="dropdown-menu keep-open">
                <label><input type="checkbox" class="specialization-filter" value="Orchid Specialist"> Orchid Specialist</label>
                <label><input type="checkbox" class="specialization-filter" value="Tomato Specialist"> Tomato Specialist</label>
                <label><input type="checkbox" class="specialization-filter" value="Crop Science"> Crop Science</label>
                <label><input type="checkbox" class="specialization-filter" value="Soil Management"> Soil Management</label>
                <label><input type="checkbox" class="specialization-filter" value="Pest Control"> Pest Control</label>
                <label><input type="checkbox" class="specialization-filter" value="Organic Farming"> Organic Farming</label>
                <label><input type="checkbox" class="specialization-filter" value="Irrigation Systems"> Irrigation Systems</label>
                <label><input type="checkbox" class="specialization-filter" value="Plant Pathology"> Plant Pathology</label>
              </div>
            </div>
            <div class="filter-group dropdown" id="ratingDropdown">
              <button class="filter-btn small-btn" type="button"><span>Rating</span><svg viewBox="0 0 24 24" fill="none"><path d="M6 9L12 15L18 9" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
              <div class="dropdown-menu keep-open">
                <label><input type="radio" name="ratingFilter" class="rating-filter" value=""> Any rating</label>
                <label><input type="radio" name="ratingFilter" class="rating-filter" value="4.5"> 4.5+</label>
                <label><input type="radio" name="ratingFilter" class="rating-filter" value="4.7"> 4.7+</label>
                <label><input type="radio" name="ratingFilter" class="rating-filter" value="4.8"> 4.8+</label>
                <label><input type="radio" name="ratingFilter" class="rating-filter" value="4.9"> 4.9+</label>
              </div>
            </div>
            <div class="filter-group dropdown" id="experienceDropdown">
              <button class="filter-btn small-btn" type="button"><span>Experience</span><svg viewBox="0 0 24 24" fill="none"><path d="M6 9L12 15L18 9" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
              <div class="dropdown-menu keep-open">
                <label><input type="radio" name="experienceFilter" class="experience-filter" value=""> Any experience</label>
                <label><input type="radio" name="experienceFilter" class="experience-filter" value="3"> 3+ years</label>
                <label><input type="radio" name="experienceFilter" class="experience-filter" value="5"> 5+ years</label>
                <label><input type="radio" name="experienceFilter" class="experience-filter" value="8"> 8+ years</label>
                <label><input type="radio" name="experienceFilter" class="experience-filter" value="10"> 10+ years</label>
                <label><input type="radio" name="experienceFilter" class="experience-filter" value="15"> 15+ years</label>
              </div>
            </div>
            <div class="filter-group dropdown price-dropdown" id="priceDropdown">
              <button class="filter-btn" type="button"><span>Price Range</span><svg viewBox="0 0 24 24" fill="none"><path d="M6 9L12 15L18 9" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
              <div class="dropdown-menu price-menu keep-open">
                <div class="price-inputs">
                  <div class="price-field"><label for="minPrice">Min Price</label><input type="text" id="minPrice" placeholder="Rp 10.000"></div>
                  <div class="price-field"><label for="maxPrice">Max Price</label><input type="text" id="maxPrice" placeholder="Rp 50.000"></div>
                </div>
                <button type="button" class="apply-price-btn" id="applyPriceBtn">Apply</button>
              </div>
            </div>
            <div class="filter-group dropdown" id="advancedDropdown">
              <button class="advanced-btn" type="button">
                <svg viewBox="0 0 24 24" fill="none"><path d="M4 7H14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M17 7H20" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="15.5" cy="7" r="2.5" stroke="currentColor" stroke-width="2"/><path d="M4 12H7" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M10 12H20" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="8.5" cy="12" r="2.5" stroke="currentColor" stroke-width="2"/><path d="M4 17H11" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M14 17H20" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="12.5" cy="17" r="2.5" stroke="currentColor" stroke-width="2"/></svg>
                <span>Advanced Filters</span>
              </button>
              <div class="dropdown-menu advanced-menu keep-open">
                <label><input type="checkbox" class="advanced-filter" value="online"> Available Online</label>
                <label><input type="checkbox" class="advanced-filter" value="fast-response"> Fast Response</label>
                <label><input type="checkbox" class="advanced-filter" value="popular"> Most Popular</label>
                <label><input type="checkbox" class="advanced-filter" value="indonesia"> Indonesia Based</label>
                <div class="advanced-actions"><button type="button" class="apply-price-btn" id="resetFiltersBtn">Reset All Filters</button></div>
              </div>
            </div>
          </div>
        </div>
      </header>

      <!-- Experts Grid -->
      <div class="experts-main">
        <section class="experts-grid" id="expertsGrid">

          @foreach($experts as $expert)
          @php
            $fee = $expert->active_tarif ?? 45000;
            $feeFormatted = 'Rp' . number_format($fee, 0, ',', '.');
            $rating = 4.8;
            if ($expert->ratings()->exists()) {
                $rating = round($expert->ratings()->avg('nilai'), 1);
            }
            $avatar = $expert->user->profile_picture ? asset('storage/' . $expert->user->profile_picture) : ($expert->user->jenis_kelamin_user == 'P' ? 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=200&auto=format&fit=crop' : 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=200&auto=format&fit=crop');
          @endphp
          <article class="expert-card"
            data-id="{{ $expert->id }}"
            data-name="{{ $expert->nama_ahli }}"
            data-specialization="{{ $expert->spesialisasi ?? 'General Botanist' }}"
            data-rating="{{ $rating }}" data-experience="{{ $expert->pengalaman_tahun ?? 5 }}" data-price="{{ $fee }}"
            data-online="true" data-fast-response="true" data-popular="true" data-indonesia="true"
            data-title="{{ $expert->spesialisasi ?? 'Expert Botanist' }}"
            data-university="{{ $expert->nama_almamater ?? 'Institut Pertanian Bogor' }}"
            data-location="{{ $expert->domisili ?? 'Indonesia' }}"
            data-consultations="120"
            data-bio="{{ $expert->bio ?? 'Experienced botanist specializing in plant care.' }}"
            data-avatar="{{ $avatar }}">
            <div class="expert-top">
              <img class="expert-avatar" src="{{ $avatar }}" alt="{{ $expert->nama_ahli }}">
              <div class="rating-badge"><svg viewBox="0 0 24 24" fill="none"><path d="M12 3L14.4 8.1L20 8.9L16 12.8L17 18.3L12 15.6L7 18.3L8 12.8L4 8.9L9.6 8.1L12 3Z" fill="#d89a00"/></svg><span>{{ $rating }}</span></div>
            </div>
            <h3>{{ $expert->nama_ahli }}</h3>
            <div class="specialization-tag tag-blue">{{ $expert->spesialisasi ?? 'General Botanist' }}</div>
            <p class="expert-desc">{{ Str::limit($expert->bio ?? 'Experienced botanist specializing in plant care.', 80) }}</p>
            <div class="expert-bottom">
              <div class="price-wrap"><span class="price-main">{{ $feeFormatted }}</span><span class="price-sub">/hr</span></div>
              <button class="details-btn" type="button" onclick="openExpertModal(this.closest('.expert-card'))">View Details</button>
            </div>
          </article>
          @endforeach

        </section>

        <div class="no-results hidden" id="noResults">
          <div class="no-results-icon"><svg viewBox="0 0 64 64" fill="none"><circle cx="28" cy="28" r="16" stroke="#76d7ea" stroke-width="4"/><path d="M40 40L54 54" stroke="#76d7ea" stroke-width="4" stroke-linecap="round"/></svg></div>
          <h3>No experts found</h3>
          <p>Try adjusting your filters or search keywords.</p>
        </div>
      </div>

      <!-- ===== FOOTER ===== -->
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

  <!-- ===== EXPERT DETAIL MODAL ===== -->
  <div class="modal-overlay" id="expertModal" aria-hidden="true">
    <div class="modal-box">
      <button class="modal-close" id="modalClose" type="button" aria-label="Close">
        <svg viewBox="0 0 24 24" fill="none"><path d="M6 6L18 18" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/><path d="M18 6L6 18" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/></svg>
      </button>

      <div class="modal-top">
        <img class="modal-avatar" id="modalAvatar" src="" alt="">
        <div class="modal-hero">
          <h2 id="modalName"></h2>
          <p class="modal-title" id="modalTitle"></p>
          <div class="modal-badges">
            <span class="modal-rating" id="modalRating"></span>
            <span class="modal-spec" id="modalSpec"></span>
          </div>
        </div>
      </div>

      <div class="modal-meta-row">
        <div class="modal-meta-item"><i class="fa-solid fa-location-dot"></i><span id="modalLocation"></span></div>
        <div class="modal-meta-item"><i class="fa-solid fa-graduation-cap"></i><span id="modalUniversity"></span></div>
        <div class="modal-meta-item"><i class="fa-solid fa-briefcase"></i><span id="modalExperience"></span></div>
        <div class="modal-meta-item"><i class="fa-solid fa-comments"></i><span id="modalConsultations"></span></div>
      </div>

      <div class="modal-bio">
        <h4>About This Expert</h4>
        <p id="modalBio"></p>
      </div>

      <div class="modal-price-row">
        <div>
          <span class="modal-price" id="modalPrice"></span>
          <span class="modal-price-sub">/sesi</span>
        </div>
        <a href="{{ url('/lockRoomUser') }}" class="modal-consult-btn">Start Consultation</a>
      </div>
    </div>
  </div>

  <script src="{{ asset('js/script-find-experts.js') }}"></script>
</body>
</html>