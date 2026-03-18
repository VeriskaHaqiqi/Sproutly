<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sproutly - Daftar Artikel</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('css/style-daftarArtikel.css') }}">
</head>
<body>
  <div class="article-page">
    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">
      <div class="sidebar-top">
        <div class="brand-wrap">
          <div class="brand-logo-box">
            <img src="{{ asset('images/logo.png') }}" alt="Sproutly Logo">
          </div>
          <span class="brand-text">Sproutly</span>
        </div>
      </div>

      <div class="sidebar-divider"></div>

      <nav class="sidebar-menu" id="sidebarMenu">
        <button class="menu-item" data-menu="Dashboard" type="button">
          <span class="menu-icon">
            <img src="{{ asset('images/dashboard.png') }}" alt="Dashboard">
          </span>
          <span class="menu-label">Dashboard</span>
        </button>

        <button class="menu-item" data-menu="Consultation" type="button">
          <span class="menu-icon">
            <img src="{{ asset('images/consultation.png') }}" alt="Consultation">
          </span>
          <span class="menu-label">Consultation</span>
        </button>

        <button class="menu-item active" data-menu="Article" type="button">
          <span class="menu-icon">
            <img src="{{ asset('images/article.png') }}" alt="Article">
          </span>
          <span class="menu-label">Article</span>
        </button>

        <button class="menu-item" data-menu="Bookmarked Article" type="button">
          <span class="menu-icon">
            <img src="{{ asset('images/bookmark article.jpg') }}" alt="Bookmarked Article">
          </span>
          <span class="menu-label">Bookmarked Article</span>
        </button>

        <button class="menu-item" data-menu="Reviews" type="button">
          <span class="menu-icon">
            <img src="{{ asset('images/reviews.png') }}" alt="Reviews">
          </span>
          <span class="menu-label">Reviews</span>
        </button>

        <button class="menu-item" data-menu="Payment" type="button">
          <span class="menu-icon">
            <img src="{{ asset('images/payment.png') }}" alt="Payment">
          </span>
          <span class="menu-label">Payment</span>
        </button>

        <button class="menu-item" data-menu="Setting" type="button">
          <span class="menu-icon">
            <img src="{{ asset('images/settings.png') }}" alt="Setting">
          </span>
          <span class="menu-label">Setting</span>
        </button>
      </nav>
    </aside>

    <!-- MAIN -->
    <main class="main-content">
      <div class="main-bg blob-left"></div>
      <div class="main-bg blob-right"></div>

      <!-- TOPBAR -->
      <header class="topbar">
        <div class="topbar-left">
          <button class="menu-toggle" id="menuToggle" type="button" aria-label="Toggle sidebar">
            <svg viewBox="0 0 24 24" fill="none">
              <path d="M4 7H20" stroke="currentColor" stroke-width="2.6" stroke-linecap="round"/>
              <path d="M4 12H20" stroke="currentColor" stroke-width="2.6" stroke-linecap="round"/>
              <path d="M4 17H20" stroke="currentColor" stroke-width="2.6" stroke-linecap="round"/>
            </svg>
          </button>

          <div class="brand-mobile">
            <div class="brand-mobile-logo">
              <img src="{{ asset('images/logo.png') }}" alt="Sproutly Logo">
            </div>
            <span>Sproutly</span>
          </div>
        </div>
      </header>

      <!-- HERO -->
      <section class="hero-section">
        <div class="hero-circle hero-circle-left"></div>
        <div class="hero-circle hero-circle-right"></div>

        <div class="hero-inner">
          <h1>
            Discover Agricultural
            <span>Knowledge</span>
          </h1>
          <p>
            Explore expert articles, guides, and insights to grow your farming success
          </p>

          <div class="hero-search">
            <span class="hero-search-icon">
              <svg viewBox="0 0 24 24" fill="none">
                <circle cx="11" cy="11" r="6.5" stroke="currentColor" stroke-width="2.2"/>
                <path d="M16 16L20 20" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
              </svg>
            </span>
            <input
              type="text"
              id="articleSearch"
              placeholder="Search articles, topics, or keywords..."
            />
            <button class="hero-search-btn" type="button" id="searchButton" aria-label="Search">
              <svg viewBox="0 0 24 24" fill="none">
                <circle cx="11" cy="11" r="6.5" stroke="currentColor" stroke-width="2.2"/>
                <path d="M16 16L20 20" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
              </svg>
            </button>
          </div>
        </div>
      </section>

      <!-- FILTER -->
      <section class="topic-section">
        <div class="topic-wrap" id="topicWrap">
          <button class="topic-chip active" data-topic="all" type="button">All Articles</button>
          <button class="topic-chip" data-topic="crop management" type="button">Crop Management</button>
          <button class="topic-chip" data-topic="soil health" type="button">Soil Health</button>
          <button class="topic-chip" data-topic="pest control" type="button">Pest Control</button>
          <button class="topic-chip" data-topic="irrigation" type="button">Irrigation</button>
          <button class="topic-chip" data-topic="sustainability" type="button">Sustainability</button>
          <button class="topic-chip" data-topic="technology" type="button">Technology</button>
        </div>
      </section>

      <!-- ARTICLE GRID -->
      <section class="article-section">
        <div class="article-grid" id="articleGrid">
          <article class="article-card" data-title="Modern Irrigation Techniques for Water Conservation" data-topic="irrigation" data-keywords="irrigation water drip smart farming conservation" data-author="John Parker">
            <div class="article-image-wrap">
              <img src="https://images.unsplash.com/photo-1464226184884-fa280b87c399?w=800&q=80" alt="Irrigation">
              <button class="bookmark-btn" type="button" aria-label="Bookmark article">
                <svg viewBox="0 0 24 24" fill="none">
                  <path d="M8 4H16C17.1 4 18 4.9 18 6V20L12 16L6 20V6C6 4.9 6.9 4 8 4Z" stroke="currentColor" stroke-width="2"/>
                </svg>
              </button>
              <span class="article-topic-label">Irrigation</span>
            </div>
            <div class="article-body">
              <h3>Modern Irrigation Techniques for Water Conservation</h3>
              <p>Learn how to optimize water usage with advanced drip irrigation systems and smart scheduling methods.</p>
              <div class="article-meta">
                <div class="author-meta">
                  <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="John Parker">
                  <div>
                    <strong>John Parker</strong>
                    <span>Mar 15, 2024</span>
                  </div>
                </div>
              </div>
            </div>
          </article>

          <article class="article-card" data-title="Building Healthy Soil Through Composting" data-topic="soil health" data-keywords="soil compost composting nutrients organic soil health" data-author="Sarah Mitchell">
            <div class="article-image-wrap">
              <img src="https://images.unsplash.com/photo-1461354464878-ad92f492a5a0?w=800&q=80" alt="Soil">
              <button class="bookmark-btn" type="button" aria-label="Bookmark article">
                <svg viewBox="0 0 24 24" fill="none">
                  <path d="M8 4H16C17.1 4 18 4.9 18 6V20L12 16L6 20V6C6 4.9 6.9 4 8 4Z" stroke="currentColor" stroke-width="2"/>
                </svg>
              </button>
              <span class="article-topic-label">Soil Health</span>
            </div>
            <div class="article-body">
              <h3>Building Healthy Soil Through Composting</h3>
              <p>Discover the benefits of composting and how to create nutrient-rich soil for improved crop growth.</p>
              <div class="article-meta">
                <div class="author-meta">
                  <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Sarah Mitchell">
                  <div>
                    <strong>Sarah Mitchell</strong>
                    <span>Mar 14, 2024</span>
                  </div>
                </div>
              </div>
            </div>
          </article>

          <article class="article-card" data-title="Organic Pest Management Strategies" data-topic="pest control" data-keywords="pest control organic insects crop protection natural methods" data-author="Michael Chen">
            <div class="article-image-wrap">
              <img src="https://images.unsplash.com/photo-1471193945509-9ad0617afabf?w=800&q=80" alt="Pest">
              <button class="bookmark-btn" type="button" aria-label="Bookmark article">
                <svg viewBox="0 0 24 24" fill="none">
                  <path d="M8 4H16C17.1 4 18 4.9 18 6V20L12 16L6 20V6C6 4.9 6.9 4 8 4Z" stroke="currentColor" stroke-width="2"/>
                </svg>
              </button>
              <span class="article-topic-label">Pest Control</span>
            </div>
            <div class="article-body">
              <h3>Organic Pest Management Strategies</h3>
              <p>Explore natural and effective methods to protect your crops without harmful chemical pesticides.</p>
              <div class="article-meta">
                <div class="author-meta">
                  <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Michael Chen">
                  <div>
                    <strong>Michael Chen</strong>
                    <span>Mar 13, 2024</span>
                  </div>
                </div>
              </div>
            </div>
          </article>

          <article class="article-card" data-title="Using Drones for Precision Agriculture" data-topic="technology" data-keywords="drone drones technology precision agriculture monitoring field" data-author="David Rodriguez">
            <div class="article-image-wrap">
              <img src="https://images.unsplash.com/photo-1473448912268-2022ce9509d8?w=800&q=80" alt="Drone">
              <button class="bookmark-btn" type="button" aria-label="Bookmark article">
                <svg viewBox="0 0 24 24" fill="none">
                  <path d="M8 4H16C17.1 4 18 4.9 18 6V20L12 16L6 20V6C6 4.9 6.9 4 8 4Z" stroke="currentColor" stroke-width="2"/>
                </svg>
              </button>
              <span class="article-topic-label">Technology</span>
            </div>
            <div class="article-body">
              <h3>Using Drones for Precision Agriculture</h3>
              <p>How aerial technology is revolutionizing crop monitoring and field management practices.</p>
              <div class="article-meta">
                <div class="author-meta">
                  <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="David Rodriguez">
                  <div>
                    <strong>David Rodriguez</strong>
                    <span>Mar 12, 2024</span>
                  </div>
                </div>
              </div>
            </div>
          </article>

          <article class="article-card" data-title="Crop Rotation for Long-Term Sustainability" data-topic="sustainability" data-keywords="crop rotation sustainable farming long term soil fertility" data-author="Emma Thompson">
            <div class="article-image-wrap">
              <img src="https://images.unsplash.com/photo-1500937386664-56d1dfef3854?w=800&q=80" alt="Crop Rotation">
              <button class="bookmark-btn" type="button" aria-label="Bookmark article">
                <svg viewBox="0 0 24 24" fill="none">
                  <path d="M8 4H16C17.1 4 18 4.9 18 6V20L12 16L6 20V6C6 4.9 6.9 4 8 4Z" stroke="currentColor" stroke-width="2"/>
                </svg>
              </button>
              <span class="article-topic-label">Sustainability</span>
            </div>
            <div class="article-body">
              <h3>Crop Rotation for Long-Term Sustainability</h3>
              <p>Master the art of crop rotation to maintain soil fertility and reduce disease pressure over time.</p>
              <div class="article-meta">
                <div class="author-meta">
                  <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Emma Thompson">
                  <div>
                    <strong>Emma Thompson</strong>
                    <span>Mar 11, 2024</span>
                  </div>
                </div>
              </div>
            </div>
          </article>

          <article class="article-card" data-title="Climate-Smart Farming Practices" data-topic="crop management" data-keywords="climate farming weather adaptation crop management resilience" data-author="James Wilson">
            <div class="article-image-wrap">
              <img src="https://images.unsplash.com/photo-1501004318641-b39e6451bec6?w=800&q=80" alt="Climate Smart">
              <button class="bookmark-btn" type="button" aria-label="Bookmark article">
                <svg viewBox="0 0 24 24" fill="none">
                  <path d="M8 4H16C17.1 4 18 4.9 18 6V20L12 16L6 20V6C6 4.9 6.9 4 8 4Z" stroke="currentColor" stroke-width="2"/>
                </svg>
              </button>
              <span class="article-topic-label">Crop Management</span>
            </div>
            <div class="article-body">
              <h3>Climate-Smart Farming Practices</h3>
              <p>Adapt your farming methods to changing weather patterns and build resilience against climate challenges.</p>
              <div class="article-meta">
                <div class="author-meta">
                  <img src="https://randomuser.me/api/portraits/men/11.jpg" alt="James Wilson">
                  <div>
                    <strong>James Wilson</strong>
                    <span>Mar 10, 2024</span>
                  </div>
                </div>
              </div>
            </div>
          </article>

          <article class="article-card" data-title="Introduction to Hydroponic Farming" data-topic="technology" data-keywords="hydroponic farming technology indoor water efficient" data-author="Lisa Anderson">
            <div class="article-image-wrap">
              <img src="https://images.unsplash.com/photo-1516253593875-bd7ba052fbc5?w=800&q=80" alt="Hydroponic">
              <button class="bookmark-btn" type="button" aria-label="Bookmark article">
                <svg viewBox="0 0 24 24" fill="none">
                  <path d="M8 4H16C17.1 4 18 4.9 18 6V20L12 16L6 20V6C6 4.9 6.9 4 8 4Z" stroke="currentColor" stroke-width="2"/>
                </svg>
              </button>
              <span class="article-topic-label">Technology</span>
            </div>
            <div class="article-body">
              <h3>Introduction to Hydroponic Farming</h3>
              <p>Explore soil-less growing systems that maximize space efficiency and water conservation.</p>
              <div class="article-meta">
                <div class="author-meta">
                  <img src="https://randomuser.me/api/portraits/women/21.jpg" alt="Lisa Anderson">
                  <div>
                    <strong>Lisa Anderson</strong>
                    <span>Mar 9, 2024</span>
                  </div>
                </div>
              </div>
            </div>
          </article>

          <article class="article-card" data-title="Understanding Soil Nutrients and Fertilization" data-topic="soil health" data-keywords="soil nutrients fertilization nitrogen phosphorus potassium" data-author="Robert Martinez">
            <div class="article-image-wrap">
              <img src="https://images.unsplash.com/photo-1500382017468-9049fed747ef?w=800&q=80" alt="Soil Nutrients">
              <button class="bookmark-btn" type="button" aria-label="Bookmark article">
                <svg viewBox="0 0 24 24" fill="none">
                  <path d="M8 4H16C17.1 4 18 4.9 18 6V20L12 16L6 20V6C6 4.9 6.9 4 8 4Z" stroke="currentColor" stroke-width="2"/>
                </svg>
              </button>
              <span class="article-topic-label">Soil Health</span>
            </div>
            <div class="article-body">
              <h3>Understanding Soil Nutrients and Fertilization</h3>
              <p>Learn how to test soil and apply the right nutrients for optimal plant growth and health.</p>
              <div class="article-meta">
                <div class="author-meta">
                  <img src="https://randomuser.me/api/portraits/men/51.jpg" alt="Robert Martinez">
                  <div>
                    <strong>Robert Martinez</strong>
                    <span>Mar 8, 2024</span>
                  </div>
                </div>
              </div>
            </div>
          </article>

          <article class="article-card" data-title="Rainwater Harvesting for Farm Use" data-topic="irrigation" data-keywords="rainwater harvesting water storage irrigation farm use" data-author="Olivia Green">
            <div class="article-image-wrap">
              <img src="https://images.unsplash.com/photo-1500651230702-0e2d8a49d4ad?w=800&q=80" alt="Rainwater Harvesting">
              <button class="bookmark-btn" type="button" aria-label="Bookmark article">
                <svg viewBox="0 0 24 24" fill="none">
                  <path d="M8 4H16C17.1 4 18 4.9 18 6V20L12 16L6 20V6C6 4.9 6.9 4 8 4Z" stroke="currentColor" stroke-width="2"/>
                </svg>
              </button>
              <span class="article-topic-label">Irrigation</span>
            </div>
            <div class="article-body">
              <h3>Rainwater Harvesting for Farm Use</h3>
              <p>Implement effective rainwater collection systems to reduce dependency on external water sources.</p>
              <div class="article-meta">
                <div class="author-meta">
                  <img src="https://randomuser.me/api/portraits/women/54.jpg" alt="Olivia Green">
                  <div>
                    <strong>Olivia Green</strong>
                    <span>Mar 7, 2024</span>
                  </div>
                </div>
              </div>
            </div>
          </article>
        </div>

        <div class="empty-state hidden" id="emptyState">
          <div class="empty-icon">
            <svg viewBox="0 0 64 64" fill="none">
              <circle cx="28" cy="28" r="16" stroke="#76d7ea" stroke-width="4"/>
              <path d="M40 40L54 54" stroke="#76d7ea" stroke-width="4" stroke-linecap="round"/>
            </svg>
          </div>
          <h3>No articles found</h3>
          <p>Try another title, keyword, topic, or author name.</p>
        </div>
      </section>

      <!-- FOOTER -->
      <footer class="custom-footer">
        <div class="footer-grid">
          <div class="footer-brand">
            <div class="footer-logo-wrap">
              <div class="footer-logo-icon">
                <img src="{{ asset('images/logo.png') }}" alt="Sproutly Logo">
              </div>
              <div class="footer-logo-text">
                <strong>Sproutly</strong>
                <small>by AVI</small>
              </div>
            </div>
            <p>Platform konsultasi pertanian modern untuk masa depan yang lebih hijau.</p>
          </div>

          <div class="footer-col">
            <h5>Tentang Kami</h5>
            <ul>
              <li><a href="#">Tim Kami</a></li>
              <li><a href="#">Blog</a></li>
              <li><a href="#">Kebijakan Privasi</a></li>
            </ul>
          </div>

          <div class="footer-col footer-contact">
            <h5>Kontak</h5>
            <p>
              <span class="footer-svg-icon">
                <svg viewBox="0 0 24 24" fill="none">
                  <path d="M4 6H20C20.55 6 21 6.45 21 7V17C21 17.55 20.55 18 20 18H4C3.45 18 3 17.55 3 17V7C3 6.45 3.45 6 4 6Z" fill="#e8d9f2"/>
                  <path d="M4 8L12 13L20 8" stroke="#ffffff" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </span>
              sproutly@gmail.com
            </p>
            <p>
              <span class="footer-svg-icon">
                <svg viewBox="0 0 24 24" fill="none">
                  <path d="M6.7 10.8C8.1 13.6 10.4 15.9 13.2 17.3L15.4 15.1C15.7 14.8 16.2 14.7 16.6 14.8C17.8 15.2 19 15.4 20.3 15.4C20.8 15.4 21.2 15.8 21.2 16.3V19.8C21.2 20.3 20.8 20.7 20.3 20.7C10.3 20.7 3.3 13.7 3.3 3.7C3.3 3.2 3.7 2.8 4.2 2.8H7.7C8.2 2.8 8.6 3.2 8.6 3.7C8.6 5 8.8 6.2 9.2 7.4C9.3 7.8 9.2 8.3 8.9 8.6L6.7 10.8Z" fill="#ff4da6"/>
                </svg>
              </span>
              +62 851 5693 2186
            </p>
            <div class="social-links">
              <a href="#" title="Instagram">
                <img src="{{ asset('images/instagram.jpg') }}" alt="Instagram">
              </a>
              <a href="#" title="Facebook">
                <img src="{{ asset('images/facebook.png') }}" alt="Facebook">
              </a>
              <a href="#" title="X">
                <img src="{{ asset('images/X.jpg') }}" alt="X">
              </a>
            </div>
          </div>
        </div>

        <div class="footer-bottom">
          © 2025 Sproutly by AVI. All rights reserved.
        </div>
      </footer>
    </main>
  </div>

  <script src="{{ asset('js/script-daftarArtikel.js') }}"></script>
</body>
</html>