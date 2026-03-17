<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sproutly - Find Experts</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('css/style-find-experts.css') }}">
</head>
<body>
  <div class="find-page">
    <header class="topbar">
      <div class="topbar-left">
        <div class="brand">
          <div class="brand-logo-box">
            <img src="{{ asset('images/logo.png') }}" alt="Sproutly Logo">
          </div>
          <span class="brand-text">Sproutly</span>
        </div>
      </div>

      <div class="topbar-center">
        <h1>Find Experts</h1>

        <div class="filters-row">
          <!-- Specialization -->
          <div class="filter-group dropdown" id="specializationDropdown">
            <button class="filter-btn" type="button">
              <span>Specialization</span>
              <svg viewBox="0 0 24 24" fill="none">
                <path d="M6 9L12 15L18 9" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </button>
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

          <!-- Rating -->
          <div class="filter-group dropdown" id="ratingDropdown">
            <button class="filter-btn small-btn" type="button">
              <span>Rating</span>
              <svg viewBox="0 0 24 24" fill="none">
                <path d="M6 9L12 15L18 9" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </button>
            <div class="dropdown-menu keep-open">
              <label><input type="radio" name="ratingFilter" class="rating-filter" value=""> Any rating</label>
              <label><input type="radio" name="ratingFilter" class="rating-filter" value="4.5"> 4.5+</label>
              <label><input type="radio" name="ratingFilter" class="rating-filter" value="4.7"> 4.7+</label>
              <label><input type="radio" name="ratingFilter" class="rating-filter" value="4.8"> 4.8+</label>
              <label><input type="radio" name="ratingFilter" class="rating-filter" value="4.9"> 4.9+</label>
            </div>
          </div>

          <!-- Experience -->
          <div class="filter-group dropdown" id="experienceDropdown">
            <button class="filter-btn small-btn" type="button">
              <span>Experience</span>
              <svg viewBox="0 0 24 24" fill="none">
                <path d="M6 9L12 15L18 9" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </button>
            <div class="dropdown-menu keep-open">
              <label><input type="radio" name="experienceFilter" class="experience-filter" value=""> Any experience</label>
              <label><input type="radio" name="experienceFilter" class="experience-filter" value="3"> 3+ years</label>
              <label><input type="radio" name="experienceFilter" class="experience-filter" value="5"> 5+ years</label>
              <label><input type="radio" name="experienceFilter" class="experience-filter" value="8"> 8+ years</label>
              <label><input type="radio" name="experienceFilter" class="experience-filter" value="10"> 10+ years</label>
              <label><input type="radio" name="experienceFilter" class="experience-filter" value="15"> 15+ years</label>
            </div>
          </div>

          <!-- Price -->
          <div class="filter-group dropdown price-dropdown" id="priceDropdown">
            <button class="filter-btn" type="button">
              <span>Price Range</span>
              <svg viewBox="0 0 24 24" fill="none">
                <path d="M6 9L12 15L18 9" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </button>
            <div class="dropdown-menu price-menu keep-open">
              <div class="price-inputs">
                <div class="price-field">
                  <label for="minPrice">Min Price</label>
                  <input type="text" id="minPrice" placeholder="Rp 10.000">
                </div>
                <div class="price-field">
                  <label for="maxPrice">Max Price</label>
                  <input type="text" id="maxPrice" placeholder="Rp 50.000">
                </div>
              </div>
              <button type="button" class="apply-price-btn" id="applyPriceBtn">Apply</button>
            </div>
          </div>

          <!-- Advanced Filters -->
          <div class="filter-group dropdown" id="advancedDropdown">
            <button class="advanced-btn" type="button">
              <svg viewBox="0 0 24 24" fill="none">
                <path d="M4 7H14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <path d="M17 7H20" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <circle cx="15.5" cy="7" r="2.5" stroke="currentColor" stroke-width="2"/>
                <path d="M4 12H7" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <path d="M10 12H20" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <circle cx="8.5" cy="12" r="2.5" stroke="currentColor" stroke-width="2"/>
                <path d="M4 17H11" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <path d="M14 17H20" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <circle cx="12.5" cy="17" r="2.5" stroke="currentColor" stroke-width="2"/>
              </svg>
              <span>Advanced Filters</span>
            </button>

            <div class="dropdown-menu advanced-menu keep-open">
              <label><input type="checkbox" class="advanced-filter" value="online"> Available Online</label>
              <label><input type="checkbox" class="advanced-filter" value="fast-response"> Fast Response</label>
              <label><input type="checkbox" class="advanced-filter" value="popular"> Most Popular</label>
              <label><input type="checkbox" class="advanced-filter" value="indonesia"> Indonesia Based</label>

              <div class="advanced-actions">
                <button type="button" class="apply-price-btn" id="resetFiltersBtn">Reset All Filters</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="topbar-right">
        <div class="search-box">
          <span class="search-icon">
            <svg viewBox="0 0 24 24" fill="none">
              <circle cx="11" cy="11" r="6.5" stroke="currentColor" stroke-width="2.2"/>
              <path d="M16 16L20 20" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
            </svg>
          </span>
          <input type="text" id="expertSearch" placeholder="Search experts...">
        </div>

        <div class="profile-avatar">
          <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=200&auto=format&fit=crop" alt="Profile">
        </div>
      </div>
    </header>

    <main class="experts-main">
      <div class="bg-left"></div>
      <div class="bg-right"></div>

      <section class="experts-grid" id="expertsGrid">
        <article class="expert-card"
          data-name="James Wilson"
          data-specialization="Crop Science"
          data-rating="4.9"
          data-experience="15"
          data-price="45000"
          data-online="true"
          data-fast-response="true"
          data-popular="true"
          data-indonesia="false">
          <div class="expert-top">
            <img class="expert-avatar" src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=200&auto=format&fit=crop" alt="James Wilson">
            <div class="rating-badge">
              <svg viewBox="0 0 24 24" fill="none">
                <path d="M12 3L14.4 8.1L20 8.9L16 12.8L17 18.3L12 15.6L7 18.3L8 12.8L4 8.9L9.6 8.1L12 3Z" fill="#d89a00"/>
              </svg>
              <span>4.9</span>
            </div>
          </div>
          <h3>James Wilson</h3>
          <div class="specialization-tag tag-blue">Crop Science</div>
          <p class="expert-desc">Specializing in sustainable farming practices and crop optimization with 15+ years of experience.</p>
          <div class="expert-bottom">
            <div class="price-wrap">
              <span class="price-main">Rp45.000</span>
              <span class="price-sub">/hr</span>
            </div>
            <button class="details-btn" type="button">View Details</button>
          </div>
        </article>

        <article class="expert-card"
          data-name="Sarah Chen"
          data-specialization="Soil Management"
          data-rating="4.8"
          data-experience="12"
          data-price="52000"
          data-online="true"
          data-fast-response="false"
          data-popular="true"
          data-indonesia="false">
          <div class="expert-top">
            <img class="expert-avatar" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=200&auto=format&fit=crop" alt="Sarah Chen">
            <div class="rating-badge">
              <svg viewBox="0 0 24 24" fill="none">
                <path d="M12 3L14.4 8.1L20 8.9L16 12.8L17 18.3L12 15.6L7 18.3L8 12.8L4 8.9L9.6 8.1L12 3Z" fill="#d89a00"/>
              </svg>
              <span>4.8</span>
            </div>
          </div>
          <h3>Sarah Chen</h3>
          <div class="specialization-tag tag-blue">Soil Management</div>
          <p class="expert-desc">Expert in soil health assessment and nutrient management for improved agricultural productivity.</p>
          <div class="expert-bottom">
            <div class="price-wrap">
              <span class="price-main">Rp52.000</span>
              <span class="price-sub">/hr</span>
            </div>
            <button class="details-btn" type="button">View Details</button>
          </div>
        </article>

        <article class="expert-card"
          data-name="Michael Rodriguez"
          data-specialization="Pest Control"
          data-rating="4.7"
          data-experience="10"
          data-price="38000"
          data-online="false"
          data-fast-response="true"
          data-popular="false"
          data-indonesia="false">
          <div class="expert-top">
            <img class="expert-avatar" src="https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=200&auto=format&fit=crop" alt="Michael Rodriguez">
            <div class="rating-badge">
              <svg viewBox="0 0 24 24" fill="none">
                <path d="M12 3L14.4 8.1L20 8.9L16 12.8L17 18.3L12 15.6L7 18.3L8 12.8L4 8.9L9.6 8.1L12 3Z" fill="#d89a00"/>
              </svg>
              <span>4.7</span>
            </div>
          </div>
          <h3>Michael Rodriguez</h3>
          <div class="specialization-tag tag-green">Pest Control</div>
          <p class="expert-desc">Integrated pest management specialist with focus on eco-friendly solutions and crop protection.</p>
          <div class="expert-bottom">
            <div class="price-wrap">
              <span class="price-main">Rp38.000</span>
              <span class="price-sub">/hr</span>
            </div>
            <button class="details-btn" type="button">View Details</button>
          </div>
        </article>

        <article class="expert-card"
          data-name="Emily Thompson"
          data-specialization="Organic Farming"
          data-rating="4.9"
          data-experience="14"
          data-price="48000"
          data-online="true"
          data-fast-response="true"
          data-popular="false"
          data-indonesia="false">
          <div class="expert-top">
            <img class="expert-avatar" src="https://images.unsplash.com/photo-1504593811423-6dd665756598?q=80&w=200&auto=format&fit=crop" alt="Emily Thompson">
            <div class="rating-badge">
              <svg viewBox="0 0 24 24" fill="none">
                <path d="M12 3L14.4 8.1L20 8.9L16 12.8L17 18.3L12 15.6L7 18.3L8 12.8L4 8.9L9.6 8.1L12 3Z" fill="#d89a00"/>
              </svg>
              <span>4.9</span>
            </div>
          </div>
          <h3>Emily Thompson</h3>
          <div class="specialization-tag tag-green">Organic Farming</div>
          <p class="expert-desc">Certified organic farming consultant helping farmers transition to sustainable organic practices.</p>
          <div class="expert-bottom">
            <div class="price-wrap">
              <span class="price-main">Rp48.000</span>
              <span class="price-sub">/hr</span>
            </div>
            <button class="details-btn" type="button">View Details</button>
          </div>
        </article>

        <article class="expert-card"
          data-name="David Park"
          data-specialization="Irrigation Systems"
          data-rating="4.6"
          data-experience="8"
          data-price="55000"
          data-online="true"
          data-fast-response="false"
          data-popular="false"
          data-indonesia="false">
          <div class="expert-top">
            <img class="expert-avatar" src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?q=80&w=200&auto=format&fit=crop" alt="David Park">
            <div class="rating-badge">
              <svg viewBox="0 0 24 24" fill="none">
                <path d="M12 3L14.4 8.1L20 8.9L16 12.8L17 18.3L12 15.6L7 18.3L8 12.8L4 8.9L9.6 8.1L12 3Z" fill="#d89a00"/>
              </svg>
              <span>4.6</span>
            </div>
          </div>
          <h3>David Park</h3>
          <div class="specialization-tag tag-blue">Irrigation Systems</div>
          <p class="expert-desc">Water management and irrigation technology expert specializing in efficient water usage systems.</p>
          <div class="expert-bottom">
            <div class="price-wrap">
              <span class="price-main">Rp55.000</span>
              <span class="price-sub">/hr</span>
            </div>
            <button class="details-btn" type="button">View Details</button>
          </div>
        </article>

        <article class="expert-card"
          data-name="Lisa Martinez"
          data-specialization="Plant Pathology"
          data-rating="4.8"
          data-experience="11"
          data-price="42000"
          data-online="true"
          data-fast-response="true"
          data-popular="true"
          data-indonesia="false">
          <div class="expert-top">
            <img class="expert-avatar" src="https://images.unsplash.com/photo-1517841905240-472988babdf9?q=80&w=200&auto=format&fit=crop" alt="Lisa Martinez">
            <div class="rating-badge">
              <svg viewBox="0 0 24 24" fill="none">
                <path d="M12 3L14.4 8.1L20 8.9L16 12.8L17 18.3L12 15.6L7 18.3L8 12.8L4 8.9L9.6 8.1L12 3Z" fill="#d89a00"/>
              </svg>
              <span>4.8</span>
            </div>
          </div>
          <h3>Lisa Martinez</h3>
          <div class="specialization-tag tag-green">Plant Pathology</div>
          <p class="expert-desc">Plant disease diagnosis and treatment specialist with expertise in crop health management.</p>
          <div class="expert-bottom">
            <div class="price-wrap">
              <span class="price-main">Rp42.000</span>
              <span class="price-sub">/hr</span>
            </div>
            <button class="details-btn" type="button">View Details</button>
          </div>
        </article>

        <article class="expert-card"
          data-name="Aulia Pranata"
          data-specialization="Orchid Specialist"
          data-rating="4.9"
          data-experience="9"
          data-price="50000"
          data-online="true"
          data-fast-response="true"
          data-popular="true"
          data-indonesia="true">
          <div class="expert-top">
            <img class="expert-avatar" src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?q=80&w=200&auto=format&fit=crop" alt="Aulia Pranata">
            <div class="rating-badge">
              <svg viewBox="0 0 24 24" fill="none">
                <path d="M12 3L14.4 8.1L20 8.9L16 12.8L17 18.3L12 15.6L7 18.3L8 12.8L4 8.9L9.6 8.1L12 3Z" fill="#d89a00"/>
              </svg>
              <span>4.9</span>
            </div>
          </div>
          <h3>Aulia Pranata</h3>
          <div class="specialization-tag tag-blue">Orchid Specialist</div>
          <p class="expert-desc">Orchid care consultant focused on flowering optimization, root health, and greenhouse maintenance.</p>
          <div class="expert-bottom">
            <div class="price-wrap">
              <span class="price-main">Rp50.000</span>
              <span class="price-sub">/hr</span>
            </div>
            <button class="details-btn" type="button">View Details</button>
          </div>
        </article>

        <article class="expert-card"
          data-name="Bima Nugraha"
          data-specialization="Tomato Specialist"
          data-rating="4.7"
          data-experience="7"
          data-price="36000"
          data-online="true"
          data-fast-response="false"
          data-popular="false"
          data-indonesia="true">
          <div class="expert-top">
            <img class="expert-avatar" src="https://images.unsplash.com/photo-1507591064344-4c6ce005b128?q=80&w=200&auto=format&fit=crop" alt="Bima Nugraha">
            <div class="rating-badge">
              <svg viewBox="0 0 24 24" fill="none">
                <path d="M12 3L14.4 8.1L20 8.9L16 12.8L17 18.3L12 15.6L7 18.3L8 12.8L4 8.9L9.6 8.1L12 3Z" fill="#d89a00"/>
              </svg>
              <span>4.7</span>
            </div>
          </div>
          <h3>Bima Nugraha</h3>
          <div class="specialization-tag tag-green">Tomato Specialist</div>
          <p class="expert-desc">Tomato cultivation advisor for disease prevention, fruit quality improvement, and greenhouse production.</p>
          <div class="expert-bottom">
            <div class="price-wrap">
              <span class="price-main">Rp36.000</span>
              <span class="price-sub">/hr</span>
            </div>
            <button class="details-btn" type="button">View Details</button>
          </div>
        </article>

        <article class="expert-card"
          data-name="William Hartono"
          data-specialization="Orchid Specialist"
          data-rating="4.8"
          data-experience="6"
          data-price="40000"
          data-online="true"
          data-fast-response="true"
          data-popular="false"
          data-indonesia="true">
          <div class="expert-top">
            <img class="expert-avatar" src="https://images.unsplash.com/photo-1504257432389-52343af06ae3?q=80&w=200&auto=format&fit=crop" alt="William Hartono">
            <div class="rating-badge">
              <svg viewBox="0 0 24 24" fill="none">
                <path d="M12 3L14.4 8.1L20 8.9L16 12.8L17 18.3L12 15.6L7 18.3L8 12.8L4 8.9L9.6 8.1L12 3Z" fill="#d89a00"/>
              </svg>
              <span>4.8</span>
            </div>
          </div>
          <h3>William Hartono</h3>
          <div class="specialization-tag tag-blue">Orchid Specialist</div>
          <p class="expert-desc">Botany expert for orchid adaptation, leaf care, humidity settings, and blooming stability.</p>
          <div class="expert-bottom">
            <div class="price-wrap">
              <span class="price-main">Rp40.000</span>
              <span class="price-sub">/hr</span>
            </div>
            <button class="details-btn" type="button">View Details</button>
          </div>
        </article>
      </section>

      <div class="no-results hidden" id="noResults">
        <div class="no-results-icon">
          <svg viewBox="0 0 64 64" fill="none">
            <circle cx="28" cy="28" r="16" stroke="#76d7ea" stroke-width="4"/>
            <path d="M40 40L54 54" stroke="#76d7ea" stroke-width="4" stroke-linecap="round"/>
          </svg>
        </div>
        <h3>No experts found</h3>
        <p>Try adjusting your filters or search keywords.</p>
      </div>
    </main>

  <script src="{{ asset('js/script-find-experts.js') }}"></script>
</body>
</html>