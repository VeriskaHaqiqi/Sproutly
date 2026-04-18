<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sproutly - Article</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/style-daftarArtikel.css') }}">
</head>
<body>
<div class="article-page">

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
      <a href="{{ url('/dashboard-user') }}" class="menu-link"><i class="fa-solid fa-chart-line"></i><span>Dashboard</span></a>
      <a href="{{ url('/consultationUser') }}" class="menu-link"><i class="fa-solid fa-comments"></i><span>Consultation</span></a>
      <a href="{{ url('/daftarArtikel') }}" class="menu-link active"><i class="fa-solid fa-newspaper"></i><span>Article</span></a>
      <a href="{{ url('/bookmarkArtikelUser') }}" class="menu-link"><i class="fa-solid fa-bookmark"></i><span>Bookmarked Article</span></a>
      <a href="{{ url('/reviewsUser') }}" class="menu-link"><i class="fa-solid fa-star"></i><span>Reviews</span></a>
      <a href="{{ url('/invoice') }}" class="menu-link"><i class="fa-solid fa-credit-card"></i><span>Payment</span></a>
      <a href="{{ url('/supportUser') }}" class="menu-link"><i class="fa-solid fa-gear"></i><span>Setting</span></a>
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

    <!-- HERO -->
    <section class="hero-section">
      <div class="hero-circle hero-circle-left"></div>
      <div class="hero-circle hero-circle-right"></div>
      <div class="hero-inner">
        <h1>Discover Agricultural <span>Knowledge</span></h1>
        <p>Explore expert articles, guides, and insights to grow your farming success</p>
        <div class="hero-search">
          <span class="hero-search-icon">
            <svg viewBox="0 0 24 24" fill="none"><circle cx="11" cy="11" r="6.5" stroke="currentColor" stroke-width="2.2"/><path d="M16 16L20 20" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/></svg>
          </span>
          <input type="text" id="articleSearch" placeholder="Search articles, topics, or keywords..." />
          <button class="hero-search-btn" type="button" id="searchButton">
            <svg viewBox="0 0 24 24" fill="none"><circle cx="11" cy="11" r="6.5" stroke="currentColor" stroke-width="2.2"/><path d="M16 16L20 20" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/></svg>
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

        <article class="article-card" data-title="Modern Irrigation Techniques for Water Conservation" data-key="irrigation" data-topic="irrigation" data-keywords="irrigation water drip smart farming conservation" data-author="John Parker">
          <a href="{{ url('/detailArtikelUser') }}?article=irrigation" class="article-link">
            <div class="article-image-wrap">
              <img src="https://images.unsplash.com/photo-1464226184884-fa280b87c399?w=800&q=80" alt="Irrigation">
              <span class="article-topic-label">Irrigation</span>
            </div>
            <div class="article-body">
              <h3>Modern Irrigation Techniques for Water Conservation</h3>
              <p>Learn how to optimize water usage with advanced drip irrigation systems and smart scheduling methods.</p>
              <div class="article-meta">
                <div class="author-meta">
                  <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="John Parker">
                  <div><strong>John Parker</strong><span>Mar 15, 2024</span></div>
                </div>
              </div>
            </div>
          </a>
          <button class="bookmark-btn" type="button" aria-label="Bookmark article">
            <svg viewBox="0 0 24 24" fill="none"><path d="M8 4H16C17.1 4 18 4.9 18 6V20L12 16L6 20V6C6 4.9 6.9 4 8 4Z" stroke="currentColor" stroke-width="2"/></svg>
          </button>
        </article>

        <article class="article-card" data-title="Building Healthy Soil Through Composting" data-key="soil" data-topic="soil health" data-keywords="soil compost composting nutrients organic soil health" data-author="Sarah Mitchell">
          <a href="{{ url('/detailArtikelUser') }}?article=soil" class="article-link">
            <div class="article-image-wrap">
              <img src="https://images.unsplash.com/photo-1461354464878-ad92f492a5a0?w=800&q=80" alt="Soil">
              <span class="article-topic-label">Soil Health</span>
            </div>
            <div class="article-body">
              <h3>Building Healthy Soil Through Composting</h3>
              <p>Discover the benefits of composting and how to create nutrient-rich soil for improved crop growth.</p>
              <div class="article-meta">
                <div class="author-meta">
                  <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Sarah Mitchell">
                  <div><strong>Sarah Mitchell</strong><span>Mar 14, 2024</span></div>
                </div>
              </div>
            </div>
          </a>
          <button class="bookmark-btn" type="button" aria-label="Bookmark article">
            <svg viewBox="0 0 24 24" fill="none"><path d="M8 4H16C17.1 4 18 4.9 18 6V20L12 16L6 20V6C6 4.9 6.9 4 8 4Z" stroke="currentColor" stroke-width="2"/></svg>
          </button>
        </article>

        <article class="article-card" data-title="Organic Pest Management Strategies" data-key="pest" data-topic="pest control" data-keywords="pest control organic insects crop protection natural methods" data-author="Michael Chen">
          <a href="{{ url('/detailArtikelUser') }}?article=pest" class="article-link">
            <div class="article-image-wrap">
              <img src="https://images.unsplash.com/photo-1471193945509-9ad0617afabf?w=800&q=80" alt="Pest">
              <span class="article-topic-label">Pest Control</span>
            </div>
            <div class="article-body">
              <h3>Organic Pest Management Strategies</h3>
              <p>Explore natural and effective methods to protect your crops without harmful chemical pesticides.</p>
              <div class="article-meta">
                <div class="author-meta">
                  <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Michael Chen">
                  <div><strong>Michael Chen</strong><span>Mar 13, 2024</span></div>
                </div>
              </div>
            </div>
          </a>
          <button class="bookmark-btn" type="button" aria-label="Bookmark article">
            <svg viewBox="0 0 24 24" fill="none"><path d="M8 4H16C17.1 4 18 4.9 18 6V20L12 16L6 20V6C6 4.9 6.9 4 8 4Z" stroke="currentColor" stroke-width="2"/></svg>
          </button>
        </article>

        <article class="article-card" data-title="Using Drones for Precision Agriculture" data-key="drone" data-topic="technology" data-keywords="drone drones technology precision agriculture monitoring field" data-author="David Rodriguez">
          <a href="{{ url('/detailArtikelUser') }}?article=drone" class="article-link">
            <div class="article-image-wrap">
              <img src="https://images.unsplash.com/photo-1473448912268-2022ce9509d8?w=800&q=80" alt="Drone">
              <span class="article-topic-label">Technology</span>
            </div>
            <div class="article-body">
              <h3>Using Drones for Precision Agriculture</h3>
              <p>How aerial technology is revolutionizing crop monitoring and field management practices.</p>
              <div class="article-meta">
                <div class="author-meta">
                  <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="David Rodriguez">
                  <div><strong>David Rodriguez</strong><span>Mar 12, 2024</span></div>
                </div>
              </div>
            </div>
          </a>
          <button class="bookmark-btn" type="button" aria-label="Bookmark article">
            <svg viewBox="0 0 24 24" fill="none"><path d="M8 4H16C17.1 4 18 4.9 18 6V20L12 16L6 20V6C6 4.9 6.9 4 8 4Z" stroke="currentColor" stroke-width="2"/></svg>
          </button>
        </article>

        <article class="article-card" data-title="Crop Rotation for Long-Term Sustainability" data-key="rotation" data-topic="sustainability" data-keywords="crop rotation sustainable farming long term soil fertility" data-author="Emma Thompson">
          <a href="{{ url('/detailArtikelUser') }}?article=rotation" class="article-link">
            <div class="article-image-wrap">
              <img src="https://images.unsplash.com/photo-1500937386664-56d1dfef3854?w=800&q=80" alt="Crop Rotation">
              <span class="article-topic-label">Sustainability</span>
            </div>
            <div class="article-body">
              <h3>Crop Rotation for Long-Term Sustainability</h3>
              <p>Master the art of crop rotation to maintain soil fertility and reduce disease pressure over time.</p>
              <div class="article-meta">
                <div class="author-meta">
                  <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Emma Thompson">
                  <div><strong>Emma Thompson</strong><span>Mar 11, 2024</span></div>
                </div>
              </div>
            </div>
          </a>
          <button class="bookmark-btn" type="button" aria-label="Bookmark article">
            <svg viewBox="0 0 24 24" fill="none"><path d="M8 4H16C17.1 4 18 4.9 18 6V20L12 16L6 20V6C6 4.9 6.9 4 8 4Z" stroke="currentColor" stroke-width="2"/></svg>
          </button>
        </article>

        <article class="article-card" data-title="Climate-Smart Farming Practices" data-key="climate" data-topic="crop management" data-keywords="climate farming weather adaptation crop management resilience" data-author="James Wilson">
          <a href="{{ url('/detailArtikelUser') }}?article=climate" class="article-link">
            <div class="article-image-wrap">
              <img src="https://images.unsplash.com/photo-1501004318641-b39e6451bec6?w=800&q=80" alt="Climate Smart">
              <span class="article-topic-label">Crop Management</span>
            </div>
            <div class="article-body">
              <h3>Climate-Smart Farming Practices</h3>
              <p>Adapt your farming methods to changing weather patterns and build resilience against climate challenges.</p>
              <div class="article-meta">
                <div class="author-meta">
                  <img src="https://randomuser.me/api/portraits/men/11.jpg" alt="James Wilson">
                  <div><strong>James Wilson</strong><span>Mar 10, 2024</span></div>
                </div>
              </div>
            </div>
          </a>
          <button class="bookmark-btn" type="button" aria-label="Bookmark article">
            <svg viewBox="0 0 24 24" fill="none"><path d="M8 4H16C17.1 4 18 4.9 18 6V20L12 16L6 20V6C6 4.9 6.9 4 8 4Z" stroke="currentColor" stroke-width="2"/></svg>
          </button>
        </article>

        <article class="article-card" data-title="Introduction to Hydroponic Farming" data-key="hydroponic" data-topic="technology" data-keywords="hydroponic farming technology indoor water efficient" data-author="Lisa Anderson">
          <a href="{{ url('/detailArtikelUser') }}?article=hydroponic" class="article-link">
            <div class="article-image-wrap">
              <img src="https://images.unsplash.com/photo-1516253593875-bd7ba052fbc5?w=800&q=80" alt="Hydroponic">
              <span class="article-topic-label">Technology</span>
            </div>
            <div class="article-body">
              <h3>Introduction to Hydroponic Farming</h3>
              <p>Explore soil-less growing systems that maximize space efficiency and water conservation.</p>
              <div class="article-meta">
                <div class="author-meta">
                  <img src="https://randomuser.me/api/portraits/women/21.jpg" alt="Lisa Anderson">
                  <div><strong>Lisa Anderson</strong><span>Mar 9, 2024</span></div>
                </div>
              </div>
            </div>
          </a>
          <button class="bookmark-btn" type="button" aria-label="Bookmark article">
            <svg viewBox="0 0 24 24" fill="none"><path d="M8 4H16C17.1 4 18 4.9 18 6V20L12 16L6 20V6C6 4.9 6.9 4 8 4Z" stroke="currentColor" stroke-width="2"/></svg>
          </button>
        </article>

        <article class="article-card" data-title="Understanding Soil Nutrients and Fertilization" data-key="nutrients" data-topic="soil health" data-keywords="soil nutrients fertilization nitrogen phosphorus potassium" data-author="Robert Martinez">
          <a href="{{ url('/detailArtikelUser') }}?article=nutrients" class="article-link">
            <div class="article-image-wrap">
              <img src="https://images.unsplash.com/photo-1500382017468-9049fed747ef?w=800&q=80" alt="Soil Nutrients">
              <span class="article-topic-label">Soil Health</span>
            </div>
            <div class="article-body">
              <h3>Understanding Soil Nutrients and Fertilization</h3>
              <p>Learn how to test soil and apply the right nutrients for optimal plant growth and health.</p>
              <div class="article-meta">
                <div class="author-meta">
                  <img src="https://randomuser.me/api/portraits/men/51.jpg" alt="Robert Martinez">
                  <div><strong>Robert Martinez</strong><span>Mar 8, 2024</span></div>
                </div>
              </div>
            </div>
          </a>
          <button class="bookmark-btn" type="button" aria-label="Bookmark article">
            <svg viewBox="0 0 24 24" fill="none"><path d="M8 4H16C17.1 4 18 4.9 18 6V20L12 16L6 20V6C6 4.9 6.9 4 8 4Z" stroke="currentColor" stroke-width="2"/></svg>
          </button>
        </article>

        <article class="article-card" data-title="Rainwater Harvesting for Farm Use" data-key="rainwater" data-topic="irrigation" data-keywords="rainwater harvesting water storage irrigation farm use" data-author="Olivia Green">
          <a href="{{ url('/detailArtikelUser') }}?article=rainwater" class="article-link">
            <div class="article-image-wrap">
              <img src="https://images.unsplash.com/photo-1500651230702-0e2d8a49d4ad?w=800&q=80" alt="Rainwater">
              <span class="article-topic-label">Irrigation</span>
            </div>
            <div class="article-body">
              <h3>Rainwater Harvesting for Farm Use</h3>
              <p>Implement effective rainwater collection systems to reduce dependency on external water sources.</p>
              <div class="article-meta">
                <div class="author-meta">
                  <img src="https://randomuser.me/api/portraits/women/54.jpg" alt="Olivia Green">
                  <div><strong>Olivia Green</strong><span>Mar 7, 2024</span></div>
                </div>
              </div>
            </div>
          </a>
          <button class="bookmark-btn" type="button" aria-label="Bookmark article">
            <svg viewBox="0 0 24 24" fill="none"><path d="M8 4H16C17.1 4 18 4.9 18 6V20L12 16L6 20V6C6 4.9 6.9 4 8 4Z" stroke="currentColor" stroke-width="2"/></svg>
          </button>
        </article>

      </div>

      <div class="empty-state hidden" id="emptyState">
        <div class="empty-icon">
          <svg viewBox="0 0 64 64" fill="none"><circle cx="28" cy="28" r="16" stroke="#76d7ea" stroke-width="4"/><path d="M40 40L54 54" stroke="#76d7ea" stroke-width="4" stroke-linecap="round"/></svg>
        </div>
        <h3>No articles found</h3>
        <p>Try another title, keyword, topic, or author name.</p>
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
<script src="{{ asset('js/script-daftarArtikel.js') }}"></script>
</body>
</html>