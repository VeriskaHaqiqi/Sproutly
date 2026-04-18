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
        <a href="{{ url('/supportUser') }}" class="menu-link"><i class="fa-solid fa-gear"></i><span>Setting</span></a>
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

          <article class="expert-card"
            data-name="Reza Firmansyah"
            data-specialization="Crop Science"
            data-rating="4.9" data-experience="15" data-price="45000"
            data-online="true" data-fast-response="true" data-popular="true" data-indonesia="true"
            data-title="Senior Agronomist"
            data-university="Institut Pertanian Bogor (IPB)"
            data-location="Bogor, Jawa Barat"
            data-consultations="320"
            data-bio="Reza is a senior agronomist with over 15 years of experience in crop science and sustainable agriculture. His focus includes harvest optimization, crop rotation, and soil fertility management for both commercial farms and smallholders."
            data-avatar="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=200&auto=format&fit=crop">
            <div class="expert-top">
              <img class="expert-avatar" src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=200&auto=format&fit=crop" alt="Reza Firmansyah">
              <div class="rating-badge"><svg viewBox="0 0 24 24" fill="none"><path d="M12 3L14.4 8.1L20 8.9L16 12.8L17 18.3L12 15.6L7 18.3L8 12.8L4 8.9L9.6 8.1L12 3Z" fill="#d89a00"/></svg><span>4.9</span></div>
            </div>
            <h3>Reza Firmansyah</h3>
            <div class="specialization-tag tag-blue">Crop Science</div>
            <p class="expert-desc">Crop science specialist for harvest optimization and sustainable commercial-scale agriculture.</p>
            <div class="expert-bottom">
              <div class="price-wrap"><span class="price-main">Rp45.000</span><span class="price-sub">/hr</span></div>
              <button class="details-btn" type="button" onclick="openExpertModal(this.closest('.expert-card'))">View Details</button>
            </div>
          </article>

          <article class="expert-card"
            data-name="Sarah Chen"
            data-specialization="Soil Management"
            data-rating="4.8" data-experience="12" data-price="52000"
            data-online="true" data-fast-response="false" data-popular="true" data-indonesia="true"
            data-title="Konsultan Kesehatan Tanah"
            data-university="Universitas Gadjah Mada (UGM)"
            data-location="Yogyakarta, DIY"
            data-consultations="275"
            data-bio="Siti specializes in soil health assessment and nutrient management. She has helped over 200 farmers improve land productivity through in-depth soil analysis and science-based fertilizer recommendations."
            data-avatar="https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=200&auto=format&fit=crop">
            <div class="expert-top">
              <img class="expert-avatar" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=200&auto=format&fit=crop" alt="Sarah Chen">
              <div class="rating-badge"><svg viewBox="0 0 24 24" fill="none"><path d="M12 3L14.4 8.1L20 8.9L16 12.8L17 18.3L12 15.6L7 18.3L8 12.8L4 8.9L9.6 8.1L12 3Z" fill="#d89a00"/></svg><span>4.8</span></div>
            </div>
            <h3>Sarah Chen</h3>
            <div class="specialization-tag tag-blue">Soil Management</div>
            <p class="expert-desc">Expert in soil health assessment and nutrient management for improved land productivity.</p>
            <div class="expert-bottom">
              <div class="price-wrap"><span class="price-main">Rp52.000</span><span class="price-sub">/hr</span></div>
              <button class="details-btn" type="button" onclick="openExpertModal(this.closest('.expert-card'))">View Details</button>
            </div>
          </article>

          <article class="expert-card"
            data-name="Bagas Priyatno"
            data-specialization="Pest Control"
            data-rating="4.7" data-experience="10" data-price="38000"
            data-online="false" data-fast-response="true" data-popular="false" data-indonesia="true"
            data-title="Ahli Pengendalian Hama Terpadu"
            data-university="Universitas Brawijaya (UB)"
            data-location="Malang, Jawa Timur"
            data-consultations="198"
            data-bio="Bagas is an integrated pest management (IPM) specialist with an eco-friendly approach. He develops evidence-based biological and chemical solutions to protect crops from pests without disrupting the surrounding ecosystem."
            data-avatar="https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=200&auto=format&fit=crop">
            <div class="expert-top">
              <img class="expert-avatar" src="https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=200&auto=format&fit=crop" alt="Bagas Priyatno">
              <div class="rating-badge"><svg viewBox="0 0 24 24" fill="none"><path d="M12 3L14.4 8.1L20 8.9L16 12.8L17 18.3L12 15.6L7 18.3L8 12.8L4 8.9L9.6 8.1L12 3Z" fill="#d89a00"/></svg><span>4.7</span></div>
            </div>
            <h3>Bagas Priyatno</h3>
            <div class="specialization-tag tag-green">Pest Control</div>
            <p class="expert-desc">Eco-friendly IPM specialist with evidence-based biological solutions for crop protection.</p>
            <div class="expert-bottom">
              <div class="price-wrap"><span class="price-main">Rp38.000</span><span class="price-sub">/hr</span></div>
              <button class="details-btn" type="button" onclick="openExpertModal(this.closest('.expert-card'))">View Details</button>
            </div>
          </article>

          <article class="expert-card"
            data-name="Dewi Kusuma"
            data-specialization="Organic Farming"
            data-rating="4.9" data-experience="14" data-price="48000"
            data-online="true" data-fast-response="true" data-popular="false" data-indonesia="true"
            data-title="Konsultan Pertanian Organik Bersertifikat"
            data-university="Institut Pertanian Bogor (IPB)"
            data-location="Bandung, Jawa Barat"
            data-consultations="412"
            data-bio="Dewi is a certified organic farming consultant who has helped hundreds of farmers transition to organic systems. Her expertise covers organic certification, composting, and holistic farm ecosystem management."
            data-avatar="https://images.unsplash.com/photo-1504593811423-6dd665756598?q=80&w=200&auto=format&fit=crop">
            <div class="expert-top">
              <img class="expert-avatar" src="https://images.unsplash.com/photo-1504593811423-6dd665756598?q=80&w=200&auto=format&fit=crop" alt="Dewi Kusuma">
              <div class="rating-badge"><svg viewBox="0 0 24 24" fill="none"><path d="M12 3L14.4 8.1L20 8.9L16 12.8L17 18.3L12 15.6L7 18.3L8 12.8L4 8.9L9.6 8.1L12 3Z" fill="#d89a00"/></svg><span>4.9</span></div>
            </div>
            <h3>Dewi Kusuma</h3>
            <div class="specialization-tag tag-green">Organic Farming</div>
            <p class="expert-desc">Certified organic consultant for farm transition, composting, and organic certification.</p>
            <div class="expert-bottom">
              <div class="price-wrap"><span class="price-main">Rp48.000</span><span class="price-sub">/hr</span></div>
              <button class="details-btn" type="button" onclick="openExpertModal(this.closest('.expert-card'))">View Details</button>
            </div>
          </article>

          <article class="expert-card"
            data-name="Hendra Wibowo"
            data-specialization="Irrigation Systems"
            data-rating="4.6" data-experience="8" data-price="55000"
            data-online="true" data-fast-response="false" data-popular="false" data-indonesia="true"
            data-title="Insinyur Sistem Irigasi"
            data-university="Institut Teknologi Bandung (ITB)"
            data-location="Surabaya, Jawa Timur"
            data-consultations="143"
            data-bio="Hendra is an agricultural irrigation systems engineer experienced in designing drip irrigation, sprinkler, and canal systems for various farm scales. His focus is on water use efficiency and soil moisture sensor technology."
            data-avatar="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?q=80&w=200&auto=format&fit=crop">
            <div class="expert-top">
              <img class="expert-avatar" src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?q=80&w=200&auto=format&fit=crop" alt="Hendra Wibowo">
              <div class="rating-badge"><svg viewBox="0 0 24 24" fill="none"><path d="M12 3L14.4 8.1L20 8.9L16 12.8L17 18.3L12 15.6L7 18.3L8 12.8L4 8.9L9.6 8.1L12 3Z" fill="#d89a00"/></svg><span>4.6</span></div>
            </div>
            <h3>Hendra Wibowo</h3>
            <div class="specialization-tag tag-blue">Irrigation Systems</div>
            <p class="expert-desc">Agricultural irrigation engineer for drip irrigation, sprinkler design, and efficient water management.</p>
            <div class="expert-bottom">
              <div class="price-wrap"><span class="price-main">Rp55.000</span><span class="price-sub">/hr</span></div>
              <button class="details-btn" type="button" onclick="openExpertModal(this.closest('.expert-card'))">View Details</button>
            </div>
          </article>

          <article class="expert-card"
            data-name="Nadia Santoso"
            data-specialization="Plant Pathology"
            data-rating="4.8" data-experience="11" data-price="42000"
            data-online="true" data-fast-response="true" data-popular="true" data-indonesia="true"
            data-title="Ahli Patologi Tanaman"
            data-university="Universitas Padjadjaran (UNPAD)"
            data-location="Bandung, Jawa Barat"
            data-consultations="289"
            data-bio="Nadia specializes in plant disease diagnosis and treatment of fungal, bacterial, and viral infections. She uses both laboratory and field approaches to provide targeted solutions for cultivated plant health."
            data-avatar="https://images.unsplash.com/photo-1517841905240-472988babdf9?q=80&w=200&auto=format&fit=crop">
            <div class="expert-top">
              <img class="expert-avatar" src="https://images.unsplash.com/photo-1517841905240-472988babdf9?q=80&w=200&auto=format&fit=crop" alt="Nadia Santoso">
              <div class="rating-badge"><svg viewBox="0 0 24 24" fill="none"><path d="M12 3L14.4 8.1L20 8.9L16 12.8L17 18.3L12 15.6L7 18.3L8 12.8L4 8.9L9.6 8.1L12 3Z" fill="#d89a00"/></svg><span>4.8</span></div>
            </div>
            <h3>Nadia Santoso</h3>
            <div class="specialization-tag tag-green">Plant Pathology</div>
            <p class="expert-desc">Expert in diagnosing plant diseases from fungi, bacteria, and viruses for cultivated crops.</p>
            <div class="expert-bottom">
              <div class="price-wrap"><span class="price-main">Rp42.000</span><span class="price-sub">/hr</span></div>
              <button class="details-btn" type="button" onclick="openExpertModal(this.closest('.expert-card'))">View Details</button>
            </div>
          </article>

          <article class="expert-card"
            data-name="Aulia Pranata"
            data-specialization="Orchid Specialist"
            data-rating="4.9" data-experience="9" data-price="50000"
            data-online="true" data-fast-response="true" data-popular="true" data-indonesia="true"
            data-title="Spesialis Anggrek & Hortikultura"
            data-university="Institut Pertanian Bogor (IPB)"
            data-location="Jakarta Selatan, DKI Jakarta"
            data-consultations="356"
            data-bio="Aulia is an orchid specialist with deep expertise in care, blooming, and root health of tropical and subtropical orchids. She actively guides collectors and growers in greenhouse management and orchid growth optimization."
            data-avatar="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?q=80&w=200&auto=format&fit=crop">
            <div class="expert-top">
              <img class="expert-avatar" src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?q=80&w=200&auto=format&fit=crop" alt="Aulia Pranata">
              <div class="rating-badge"><svg viewBox="0 0 24 24" fill="none"><path d="M12 3L14.4 8.1L20 8.9L16 12.8L17 18.3L12 15.6L7 18.3L8 12.8L4 8.9L9.6 8.1L12 3Z" fill="#d89a00"/></svg><span>4.9</span></div>
            </div>
            <h3>Aulia Pranata</h3>
            <div class="specialization-tag tag-blue">Orchid Specialist</div>
            <p class="expert-desc">Tropical orchid specialist for care, optimal blooming, and greenhouse management.</p>
            <div class="expert-bottom">
              <div class="price-wrap"><span class="price-main">Rp50.000</span><span class="price-sub">/hr</span></div>
              <button class="details-btn" type="button" onclick="openExpertModal(this.closest('.expert-card'))">View Details</button>
            </div>
          </article>

          <article class="expert-card"
            data-name="Bima Nugraha"
            data-specialization="Tomato Specialist"
            data-rating="4.7" data-experience="7" data-price="36000"
            data-online="true" data-fast-response="false" data-popular="false" data-indonesia="true"
            data-title="Konsultan Budidaya Tomat"
            data-university="Universitas Brawijaya (UB)"
            data-location="Batu, Jawa Timur"
            data-consultations="167"
            data-bio="Bima is a tomato cultivation specialist focused on disease prevention, fruit quality improvement, and greenhouse production. He has extensive experience working with tomato farmers in the highlands of East Java."
            data-avatar="https://images.unsplash.com/photo-1507591064344-4c6ce005b128?q=80&w=200&auto=format&fit=crop">
            <div class="expert-top">
              <img class="expert-avatar" src="https://images.unsplash.com/photo-1507591064344-4c6ce005b128?q=80&w=200&auto=format&fit=crop" alt="Bima Nugraha">
              <div class="rating-badge"><svg viewBox="0 0 24 24" fill="none"><path d="M12 3L14.4 8.1L20 8.9L16 12.8L17 18.3L12 15.6L7 18.3L8 12.8L4 8.9L9.6 8.1L12 3Z" fill="#d89a00"/></svg><span>4.7</span></div>
            </div>
            <h3>Bima Nugraha</h3>
            <div class="specialization-tag tag-green">Tomato Specialist</div>
            <p class="expert-desc">Tomato consultant for disease prevention, fruit quality, and highland greenhouse production.</p>
            <div class="expert-bottom">
              <div class="price-wrap"><span class="price-main">Rp36.000</span><span class="price-sub">/hr</span></div>
              <button class="details-btn" type="button" onclick="openExpertModal(this.closest('.expert-card'))">View Details</button>
            </div>
          </article>

          <article class="expert-card"
            data-name="William Hartono"
            data-specialization="Orchid Specialist"
            data-rating="4.8" data-experience="6" data-price="40000"
            data-online="true" data-fast-response="true" data-popular="false" data-indonesia="true"
            data-title="Ahli Botani & Perawatan Anggrek"
            data-university="Universitas Indonesia (UI)"
            data-location="Depok, Jawa Barat"
            data-consultations="201"
            data-bio="William is a botanist specializing in orchid adaptation, leaf care, humidity management, and blooming stability. His science-based approach makes him the top choice for premium orchid collectors."
            data-avatar="https://images.unsplash.com/photo-1504257432389-52343af06ae3?q=80&w=200&auto=format&fit=crop">
            <div class="expert-top">
              <img class="expert-avatar" src="https://images.unsplash.com/photo-1504257432389-52343af06ae3?q=80&w=200&auto=format&fit=crop" alt="William Hartono">
              <div class="rating-badge"><svg viewBox="0 0 24 24" fill="none"><path d="M12 3L14.4 8.1L20 8.9L16 12.8L17 18.3L12 15.6L7 18.3L8 12.8L4 8.9L9.6 8.1L12 3Z" fill="#d89a00"/></svg><span>4.8</span></div>
            </div>
            <h3>William Hartono</h3>
            <div class="specialization-tag tag-blue">Orchid Specialist</div>
            <p class="expert-desc">Botanist for orchid adaptation, leaf care, humidity management, and premium blooming stability.</p>
            <div class="expert-bottom">
              <div class="price-wrap"><span class="price-main">Rp40.000</span><span class="price-sub">/hr</span></div>
              <button class="details-btn" type="button" onclick="openExpertModal(this.closest('.expert-card'))">View Details</button>
            </div>
          </article>

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