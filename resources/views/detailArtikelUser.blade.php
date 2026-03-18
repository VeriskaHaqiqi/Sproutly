<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sproutly - Detail Article</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('css/style-detailArtikelUser.css') }}">
</head>
<body>
  <div class="detail-page">
    <!-- SIDEBAR -->
    <aside class="sidebar open" id="sidebar">
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

        <div class="topbar-right">
          <button class="notif-btn" type="button" aria-label="Notifications">
            <svg viewBox="0 0 24 24" fill="none">
              <path d="M12 22C13.1 22 14 21.1 14 20H10C10 21.1 10.9 22 12 22ZM18 16V11C18 7.93 16.37 5.36 13.5 4.68V4C13.5 3.17 12.83 2.5 12 2.5C11.17 2.5 10.5 3.17 10.5 4V4.68C7.64 5.36 6 7.92 6 11V16L4.71 17.29C4.08 17.92 4.52 19 5.41 19H18.58C19.47 19 19.92 17.92 19.29 17.29L18 16Z" fill="currentColor"/>
            </svg>
          </button>

          <div class="user-chip">
            <div class="user-chip-text">
              <strong>Sarah Green</strong>
            </div>
            <img
              src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=300&q=80"
              alt="User"
            >
          </div>
        </div>
      </header>

      <!-- HERO IMAGE -->
      <section class="article-hero" id="articleHero">
        <div class="hero-overlay"></div>
      </section>

      <!-- FLOAT META -->
      <section class="article-meta-wrap">
        <div class="article-meta-card">
          <div class="article-meta-left">
            <div class="author-avatar">
              <img
                id="authorAvatar"
                src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=300&q=80"
                alt="Author"
              >
            </div>

            <div class="author-info">
              <h4 id="articleAuthor">Dr. Sarah Chen</h4>
              <div class="author-subinfo">
                <span id="articleDate">March 15, 2024</span>
                <span class="meta-dot"></span>
                <span id="articleReadTime">8 min read</span>
              </div>
            </div>
          </div>

          <button class="save-btn" id="bookmarkBtn" type="button">
            <svg viewBox="0 0 24 24" fill="none">
              <path d="M8 4H16C17.1 4 18 4.9 18 6V20L12 16L6 20V6C6 4.9 6.9 4 8 4Z" stroke="currentColor" stroke-width="2"/>
            </svg>
            <span>Save</span>
          </button>
        </div>
      </section>

      <!-- ARTICLE BODY -->
      <section class="article-shell">
        <div class="side-accent left-accent"></div>
        <div class="side-accent right-accent"></div>

        <article class="article-detail-card">
          <div class="article-inner">
            <p class="article-lead" id="articleLead">
              As the global population continues to grow and climate change presents new challenges, sustainable agriculture has become more critical than ever. Modern farmers are embracing innovative practices that not only increase productivity but also protect our environment for future generations.
            </p>

            <h1 class="article-heading" id="articleTitle">Understanding Sustainable Agriculture</h1>

            <p class="article-text" id="paragraph1">
              Sustainable agriculture is a farming approach that focuses on producing food while maintaining the health of the environment, supporting economic viability, and promoting social equity. This holistic method considers the long-term impact of farming practices on soil health, water quality, biodiversity, and climate.
            </p>

            <p class="article-text" id="paragraph2">
              The core principles of sustainable agriculture include crop rotation, integrated pest management, conservation tillage, and the use of cover crops. These practices work together to create a farming system that is both productive and environmentally responsible.
            </p>

            <div class="quote-box">
              <div class="quote-symbol">“</div>
              <p id="articleQuote">
                Sustainable agriculture is not just about growing food — it’s about growing a future where farming works in harmony with nature, ensuring that we can feed the world while preserving our planet for generations to come.
              </p>
              <span id="articleQuoteAuthor">- Dr. Michael Rodriguez, Agricultural Sustainability Expert</span>
            </div>

            <h2 class="article-subheading" id="subtitle1">Key Sustainable Practices</h2>

            <p class="article-text" id="paragraph3">
              Several innovative practices are revolutionizing modern agriculture. Precision farming uses GPS technology and data analytics to optimize planting, fertilizing, and harvesting. This approach reduces waste, minimizes environmental impact, and maximizes crop yields.
            </p>

            <figure class="article-figure">
              <img
                id="articleInlineImage"
                src="https://images.unsplash.com/photo-1500937386664-56d1dfef3854?auto=format&fit=crop&w=1200&q=80"
                alt="Article illustration"
              >
              <figcaption id="articleImageCaption">
                Precision farming technology helps optimize resource use and reduce environmental impact
              </figcaption>
            </figure>

            <p class="article-text" id="paragraph4">
              Cover cropping is another essential practice that involves planting specific crops to cover the soil during off-seasons. These crops prevent soil erosion, improve soil fertility, and provide habitat for beneficial insects. Popular cover crops include clover, rye grass, and buckwheat.
            </p>

            <h2 class="article-subheading" id="subtitle2">The Role of Technology</h2>

            <p class="article-text" id="paragraph5">
              Modern technology plays a crucial role in sustainable agriculture. Drone technology allows farmers to monitor crop health, identify pest problems early, and apply treatments precisely where needed. IoT sensors can track soil moisture, temperature, and nutrient levels in real-time, enabling farmers to make data-driven decisions.
            </p>

            <p class="article-text" id="paragraph6">
              Artificial intelligence and machine learning are also transforming agriculture by predicting weather patterns, optimizing irrigation schedules, and identifying the best planting strategies for specific conditions. These technologies help farmers reduce resource consumption while maintaining or increasing productivity.
            </p>

            <h2 class="article-subheading" id="subtitle3">Looking Forward</h2>

            <p class="article-text" id="paragraph7">
              The future of sustainable agriculture looks promising, with continued innovations in biotechnology, renewable energy integration, and sustainable pest management. As consumers become more environmentally conscious, the demand for sustainably produced food continues to grow, creating economic incentives for farmers to adopt these practices.
            </p>

            <p class="article-text" id="paragraph8">
              By embracing sustainable agriculture practices, farmers can contribute to a healthier planet while building resilient, profitable farming operations. The key is to start with small changes and gradually implement more comprehensive sustainable practices as knowledge and resources allow.
            </p>
          </div>
        </article>
      </section>

      <!-- RECOMMENDED -->
      <section class="recommended-section">
        <h2>Recommended Articles</h2>

        <div class="recommended-grid">
          <button class="recommended-card" type="button" data-article="organic">
            <div class="recommended-image-wrap">
              <img src="https://images.unsplash.com/photo-1464226184884-fa280b87c399?w=900&q=80" alt="Organic Farming">
            </div>
            <div class="recommended-body">
              <span class="recommended-tag green">Organic Farming</span>
              <h3>Organic Pest Control: Natural Solutions for Healthy Crops</h3>
              <p>Discover effective organic methods to protect your crops without harmful chemicals...</p>
              <div class="recommended-author">
                <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?auto=format&fit=crop&w=200&q=80" alt="Emma Thompson">
                <div>
                  <strong>Emma Thompson</strong>
                </div>
              </div>
            </div>
          </button>

          <button class="recommended-card" type="button" data-article="irrigation">
            <div class="recommended-image-wrap">
              <img src="https://images.unsplash.com/photo-1500382017468-9049fed747ef?w=900&q=80" alt="Water Management">
            </div>
            <div class="recommended-body">
              <span class="recommended-tag blue">Water Management</span>
              <h3>Smart Irrigation: Maximizing Water Efficiency</h3>
              <p>Learn how smart irrigation systems can reduce water usage while improving crop yields...</p>
              <div class="recommended-author">
                <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=200&q=80" alt="James Wilson">
                <div>
                  <strong>James Wilson</strong>
                </div>
              </div>
            </div>
          </button>

          <button class="recommended-card" type="button" data-article="rotation">
            <div class="recommended-image-wrap">
              <img src="https://images.unsplash.com/photo-1471193945509-9ad0617afabf?w=900&q=80" alt="Crop Planning">
            </div>
            <div class="recommended-body">
              <span class="recommended-tag yellow">Crop Planning</span>
              <h3>Crop Rotation Strategies for Soil Health</h3>
              <p>Master the art of crop rotation to improve soil fertility and reduce pest pressure...</p>
              <div class="recommended-author">
                <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=200&q=80" alt="Maria Garcia">
                <div>
                  <strong>Maria Garcia</strong>
                </div>
              </div>
            </div>
          </button>
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
            <p>A modern agriculture consultation platform for a greener and more sustainable future.</p>
          </div>

          <div class="footer-col">
            <h5>About Us</h5>
            <ul>
              <li><a href="#">Our Team</a></li>
              <li><a href="#">Blog</a></li>
              <li><a href="#">Privacy Policy</a></li>
            </ul>
          </div>

          <div class="footer-col footer-contact">
            <h5>Contact</h5>
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

  <script src="{{ asset('js/detailArtikelUser.js') }}"></script>
</body>
</html>