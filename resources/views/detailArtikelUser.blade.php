<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sproutly - Detail Article</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/style-detailArtikelUser.css') }}">
</head>
<body>
<div class="detail-page">

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
            <img id="authorAvatar" src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=300&q=80" alt="Author">
          </div>
          <div class="author-info">
            <h4 id="articleAuthor">Sarah Chen</h4>
            <div class="author-subinfo">
              <span id="articleDate">March 15, 2024</span>
              <span class="meta-dot"></span>
              <span id="articleReadTime">8 min read</span>
            </div>
          </div>
        </div>
        <button class="save-btn" id="bookmarkBtn" type="button">
          <svg viewBox="0 0 24 24">
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
          <p class="article-text" id="paragraph1">Sustainable agriculture is a farming approach that focuses on producing food while maintaining the health of the environment, supporting economic viability, and promoting social equity. This holistic method considers the long-term impact of farming practices on soil health, water quality, biodiversity, and climate.</p>
          <p class="article-text" id="paragraph2">The core principles of sustainable agriculture include crop rotation, integrated pest management, conservation tillage, and the use of cover crops. These practices work together to create a farming system that is both productive and environmentally responsible.</p>
          <div class="quote-box">
            <div class="quote-symbol">"</div>
            <p id="articleQuote">Sustainable agriculture is not just about growing food — it's about growing a future where farming works in harmony with nature, ensuring that we can feed the world while preserving our planet for generations to come.</p>
            <span id="articleQuoteAuthor">- Michael Rodriguez, Agricultural Sustainability Expert</span>
          </div>
          <h2 class="article-subheading" id="subtitle1">Key Sustainable Practices</h2>
          <p class="article-text" id="paragraph3">Several innovative practices are revolutionizing modern agriculture. Precision farming uses GPS technology and data analytics to optimize planting, fertilizing, and harvesting. This approach reduces waste, minimizes environmental impact, and maximizes crop yields.</p>
          <figure class="article-figure">
            <img id="articleInlineImage" src="https://images.unsplash.com/photo-1500937386664-56d1dfef3854?auto=format&fit=crop&w=1200&q=80" alt="Article illustration">
            <figcaption id="articleImageCaption">Precision farming technology helps optimize resource use and reduce environmental impact</figcaption>
          </figure>
          <p class="article-text" id="paragraph4">Cover cropping is another essential practice that involves planting specific crops to cover the soil during off-seasons. These crops prevent soil erosion, improve soil fertility, and provide habitat for beneficial insects.</p>
          <h2 class="article-subheading" id="subtitle2">The Role of Technology</h2>
          <p class="article-text" id="paragraph5">Modern technology plays a crucial role in sustainable agriculture. Drone technology allows farmers to monitor crop health, identify pest problems early, and apply treatments precisely where needed.</p>
          <p class="article-text" id="paragraph6">Artificial intelligence and machine learning are also transforming agriculture by predicting weather patterns, optimizing irrigation schedules, and identifying the best planting strategies for specific conditions.</p>
          <h2 class="article-subheading" id="subtitle3">Looking Forward</h2>
          <p class="article-text" id="paragraph7">The future of sustainable agriculture looks promising, with continued innovations in biotechnology, renewable energy integration, and sustainable pest management.</p>
          <p class="article-text" id="paragraph8">By embracing sustainable agriculture practices, farmers can contribute to a healthier planet while building resilient, profitable farming operations.</p>
        </div>
      </article>
    </section>

    <!-- RECOMMENDED — pakai <a> bukan <button> -->
    <section class="recommended-section">
      <h2>Recommended Articles</h2>
      <div class="recommended-grid">

        <a href="/detailArtikelUser?article=pest" class="recommended-card">
          <div class="recommended-image-wrap">
            <img src="https://images.unsplash.com/photo-1464226184884-fa280b87c399?w=900&q=80" alt="Organic Farming">
          </div>
          <div class="recommended-body">
            <span class="recommended-tag green">Organic Farming</span>
            <h3>Organic Pest Control: Natural Solutions for Healthy Crops</h3>
            <p>Discover effective organic methods to protect your crops without harmful chemicals...</p>
            <div class="recommended-author">
              <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?auto=format&fit=crop&w=200&q=80" alt="Emma Thompson">
              <div><strong>Emma Thompson</strong></div>
            </div>
          </div>
        </a>

        <a href="/detailArtikelUser?article=nutrients" class="recommended-card">
          <div class="recommended-image-wrap">
            <img src="https://images.unsplash.com/photo-1500382017468-9049fed747ef?w=900&q=80" alt="Water Management">
          </div>
          <div class="recommended-body">
            <span class="recommended-tag blue">Water Management</span>
            <h3>Smart Irrigation: Maximizing Water Efficiency</h3>
            <p>Learn how smart irrigation systems can reduce water usage while improving crop yields...</p>
            <div class="recommended-author">
              <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=200&q=80" alt="James Wilson">
              <div><strong>James Wilson</strong></div>
            </div>
          </div>
        </a>

        <a href="/detailArtikelUser?article=rotation" class="recommended-card">
          <div class="recommended-image-wrap">
            <img src="https://images.unsplash.com/photo-1471193945509-9ad0617afabf?w=900&q=80" alt="Crop Planning">
          </div>
          <div class="recommended-body">
            <span class="recommended-tag yellow">Crop Planning</span>
            <h3>Crop Rotation Strategies for Soil Health</h3>
            <p>Master the art of crop rotation to improve soil fertility and reduce pest pressure...</p>
            <div class="recommended-author">
              <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=200&q=80" alt="Maria Garcia">
              <div><strong>Maria Garcia</strong></div>
            </div>
          </div>
        </a>

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
<script src="{{ asset('js/detailArtikelUser.js') }}"></script>
</body>
</html>