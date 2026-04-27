<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sproutly - Modern Agricultural Consultation Platform</title>

  <!-- Google Fonts: Inter -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet" />

  <!-- Stylesheet -->
  <link rel="stylesheet" href="{{ asset('css/style-homePublic.css') }}" />
</head>
<body>

  <!-- Background blobs -->
  <div class="blob-bg"></div>
  <div class="blob-mid"></div>

  <!-- ======================== NAVBAR ======================== -->
  <nav>
    <a href="/" class="nav-logo">
      <div class="logo-icon">
        <img src="{{ asset('images/logo.png') }}" alt="Sproutly logo" />
      </div>
      <span class="nav-logo-text">Sproutly <small>by AVI</small></span>
    </a>
    <ul class="nav-links">
      <li><a href="/login" class="btn-masuk">Sign In</a></li>
    </ul>
  </nav>

  <!-- ======================== HERO ======================== -->
  <section class="hero">
    <div class="hero-badge">
      <span class="hero-badge-dot"></span>
      Trusted by 10,000+ Farmers &amp; Hobbyists
    </div>
    <h1>Grow Smarter with <span>Expert Guidance</span></h1>
    <p>
      Sproutly connects you with trusted plant experts in real time. Get instant advice,
      diagnose plant diseases through photos, and access thousands of educational articles —
      all in one platform.
    </p>
    <p>
      Whether you're a professional farmer, a weekend gardener, or just getting started,
      Sproutly is here to help your plants thrive.
    </p>
    <div class="hero-cta">
      <a href="/login" class="btn-hero-primary">Get Started Free →</a>
      <a href="/login" class="btn-hero-secondary">Explore Features</a>
    </div>

  </section>

  <!-- ======================== FEATURES ======================== -->
  <section class="features">
    <div class="features-inner">
      <h2 class="section-title">Everything You Need to Grow</h2>
      <p class="section-subtitle">
        A complete suite of tools designed to help you solve plant problems faster and farm smarter.
      </p>
      <div class="features-grid">

        <a href="/login" class="feature-card reveal">
          <div class="feature-icon fi-teal">
            <img src="{{ asset('images/consultation.png') }}" alt="Live Consultation" />
          </div>
          <h3>Live Consultation with Experts</h3>
          <p>Connect with experienced plant specialists in real time. Get instant answers about plant care, pests, and diseases.</p>
        </a>

        <a href="/login" class="feature-card reveal" style="transition-delay:.08s">
          <div class="feature-icon fi-green">
            <img src="{{ asset('images/check.png') }}" alt="Photo Diagnosis" />
          </div>
          <h3>Plant Diagnosis via Photo</h3>
          <p>Upload a photo of your plant and receive an accurate diagnosis from our experts with tailored treatment recommendations.</p>
        </a>

        <a href="/login" class="feature-card reveal" style="transition-delay:.16s">
          <div class="feature-icon fi-yellow">
            <img src="{{ asset('images/article.png') }}" alt="Articles" />
          </div>
          <h3>Educational Articles</h3>
          <p>Access thousands of high-quality articles on modern farming techniques, plant care tips, and comprehensive growing guides.</p>
        </a>

        <a href="/login" class="feature-card reveal" style="transition-delay:.24s">
          <div class="feature-icon fi-lime">
            <img src="{{ asset('images/ikon list rating.png') }}" alt="Ratings" />
          </div>
          <h3>Ratings &amp; Reviews</h3>
          <p>Our transparent rating system helps you choose the best expert. Read community reviews and share your own experience.</p>
        </a>

      </div>
    </div>
  </section>

  <!-- ======================== EXPERTS ======================== -->
  <section class="experts">
    <div class="experts-inner">
      <h2 class="section-title">Meet Our Experts</h2>
      <p class="section-subtitle">
        Our certified consultants bring years of hands-on experience to help your plants flourish.
      </p>
      <div class="experts-grid">

        <a href="/login" class="expert-card reveal">
          <div class="expert-avatar">
            <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Dr. Sarah Wijaya" />
          </div>
          <div class="expert-name">Dr. Sarah Wijaya</div>
          <div class="expert-spec">Pest &amp; Disease Specialist</div>
          <div class="stars">★★★★★ <span>(4.9)</span></div>
          <span class="btn-profile">View Profile</span>
        </a>

        <a href="/login" class="expert-card reveal" style="transition-delay:.1s">
          <div class="expert-avatar">
            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Budi Santoso" />
          </div>
          <div class="expert-name">Budi Santoso, S.P.</div>
          <div class="expert-spec">Ornamental Plant Expert</div>
          <div class="stars">★★★★★ <span>(4.8)</span></div>
          <span class="btn-profile">View Profile</span>
        </a>

        <a href="/login" class="expert-card reveal" style="transition-delay:.2s">
          <div class="expert-avatar">
            <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Ir. Maya Kusuma" />
          </div>
          <div class="expert-name">Ir. Maya Kusuma</div>
          <div class="expert-spec">Horticulture Specialist</div>
          <div class="stars">★★★★★ <span>(5.0)</span></div>
          <span class="btn-profile">View Profile</span>
        </a>

      </div>
    </div>
  </section>

  <!-- ======================== CTA ======================== -->
  <div class="cta-section">
    <div class="cta-grid">

      <div class="cta-card reveal">
        <div class="cta-card-icon ci-teal">
          <img src="{{ asset('images/user.png') }}" alt="Sign In" />
        </div>
        <h3>Already Have an Account?</h3>
        <p>Sign in to continue your consultations, read your favorite articles, and access your full consultation history.</p>
        <a href="/login" class="btn-cta-primary">Sign In Now</a>
      </div>

      <div class="cta-card reveal" style="transition-delay:.1s">
        <div class="cta-card-icon ci-lime">
          <img src="{{ asset('images/user.png') }}" alt="Register" />
        </div>
        <h3>New to Sproutly?</h3>
        <p>Create a free account and get access to all features — including a free first consultation and exclusive articles.</p>
        <a href="/login" class="btn-cta-yellow">Register for Free</a>
      </div>

    </div>
  </div>

  <!-- ======================== ARTICLES ======================== -->
  <section class="articles">
    <div class="articles-inner">
      <h2 class="section-title">Latest Articles</h2>
      <p class="section-subtitle">
        Stay informed with expert-written articles on farming, plant care, and sustainable growing.
      </p>
      <div class="articles-grid">

        <a href="/login" class="article-card reveal">
          <div class="article-img">
            <img src="https://images.unsplash.com/photo-1464226184884-fa280b87c399?w=400&q=80" alt="Tomatoes" />
          </div>
          <div class="article-body">
            <span class="article-tag">Growing Tips</span>
            <h4>How to Care for Tomato Plants During Rainy Season</h4>
            <span class="article-read">Read article →</span>
          </div>
        </a>

        <a href="/login" class="article-card reveal" style="transition-delay:.08s">
          <div class="article-img">
            <img src="https://images.unsplash.com/photo-1416879595882-3373a0480b5b?w=400&q=80" alt="Indoor Plants" />
          </div>
          <div class="article-body">
            <span class="article-tag">Indoor Plants</span>
            <h4>10 Easy-to-Care-for Indoor Ornamental Plants</h4>
            <span class="article-read">Read article →</span>
          </div>
        </a>

        <a href="/login" class="article-card reveal" style="transition-delay:.16s">
          <div class="article-img">
            <img src="https://images.unsplash.com/photo-1530836369250-ef72a3f5cda8?w=400&q=80" alt="Hydroponics" />
          </div>
          <div class="article-body">
            <span class="article-tag">Hydroponics</span>
            <h4>The Complete Beginner's Guide to Hydroponic Farming</h4>
            <span class="article-read">Read article →</span>
          </div>
        </a>

        <a href="/login" class="article-card reveal" style="transition-delay:.24s">
          <div class="article-img">
            <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=400&q=80" alt="Pest Control" />
          </div>
          <div class="article-body">
            <span class="article-tag">Pest Control</span>
            <h4>How to Eliminate Pests Without Chemical Pesticides</h4>
            <span class="article-read">Read article →</span>
          </div>
        </a>

      </div>
    </div>
  </section>

  <!-- ======================== FOOTER ======================== -->
  <footer>
    <div class="footer-grid">

      <div class="footer-brand">
        <a href="/" class="nav-logo">
          <div class="logo-icon">
            <img src="{{ asset('images/logo.png') }}" alt="logo" />
          </div>
          <span class="nav-logo-text">Sproutly <small>by AVI</small></span>
        </a>
        <p>A modern agricultural consultation platform for a greener and more sustainable future.</p>
      </div>

      <div class="footer-col">
        <h5>Company</h5>
        <ul>
          <li><a href="/login">Our Team</a></li>
          <li><a href="/login">Blog</a></li>
          <li><a href="/login">Privacy Policy</a></li>
          <li><a href="/login">Terms of Service</a></li>
        </ul>
      </div>

      <div class="footer-col footer-contact">
        <h5>Contact Us</h5>
        <p>✉️ sproutly@gmail.com</p>
        <p>📞 +62 851 5693 2186</p>
        <div class="social-links">
          <a href="/login" title="Instagram">
            <img src="{{ asset('images/instagram.jpg') }}" alt="Instagram" />
          </a>
          <a href="/login" title="Facebook">
            <img src="{{ asset('images/facebook.png') }}" alt="Facebook" />
          </a>
          <a href="/login" title="X">
            <img src="{{ asset('images/X.jpg') }}" alt="X" />
          </a>
        </div>
      </div>

    </div>

    <div class="footer-bottom">
      © 2025 Sproutly by AVI. All rights reserved.
    </div>
  </footer>

  <!-- JavaScript -->
  <script src="{{ asset('js/script-homePublic.js') }}"></script>

</body>
</html>