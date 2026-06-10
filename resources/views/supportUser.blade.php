<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Support & Information - Sproutly</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/style-supportUser.css') }}">
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
      <a href="{{ url('/reviewsUser') }}"         class="menu-link"><i class="fa-solid fa-star"></i><span>Reviews</span></a>
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
        <button class="notif-btn" type="button" id="notifBtn">
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

    <!-- PAGE CONTENT -->
    <div class="page-content">

      <!-- HERO -->
      <section class="hero-section">
        <div class="hero-deco hero-deco-tl"></div>
        <div class="hero-deco hero-deco-br"></div>
        <div class="hero-inner">
          <div class="hero-badge">
            <span class="hero-badge-dot"></span>
            Help Center
          </div>
          <h1 class="hero-title">Support &amp; Information</h1>
          <p class="hero-subtitle">Find answers to common questions and understand the platform rules.</p>
        </div>
      </section>

      <!-- FAQ -->
      <section class="faq-section">
        <div class="section-header">
          <h2 class="section-title">Frequently Asked Questions</h2>
          <p class="section-subtitle">Quick answers to common questions about Sproutly</p>
        </div>
        <div class="faq-list">

          <div class="faq-card">
            <div class="faq-icon-box faq-icon-blue"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></div>
            <div class="faq-content">
              <h3 class="faq-question">How do I create an account?</h3>
              <p class="faq-answer">Click the "Sign Up" button in the top right corner. You can register using your email address or social media accounts. After verifying your email, you'll have full access to all platform features including expert consultations and educational articles.</p>
            </div>
          </div>

          <div class="faq-card">
            <div class="faq-icon-box faq-icon-green"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></div>
            <div class="faq-content">
              <h3 class="faq-question">How does expert consultation work?</h3>
              <p class="faq-answer">Browse our verified agricultural experts by specialty, select an expert, choose a consultation package, and submit your question with relevant photos. The expert will respond within 24–48 hours with detailed advice tailored to your specific situation.</p>
            </div>
          </div>

          <div class="faq-card">
            <div class="faq-icon-box faq-icon-teal"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg></div>
            <div class="faq-content">
              <h3 class="faq-question">What payment methods are accepted?</h3>
              <p class="faq-answer">We accept all major credit cards (Visa, MasterCard, American Express), debit cards, and digital wallets including PayPal and Apple Pay. All transactions are secured with industry-standard encryption to protect your financial information.</p>
            </div>
          </div>

          <div class="faq-card">
            <div class="faq-icon-box faq-icon-mint"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg></div>
            <div class="faq-content">
              <h3 class="faq-question">How should I take photos of my plants?</h3>
              <p class="faq-answer">Take clear, well-lit photos in natural daylight. Include close-ups of affected areas, overall plant structure, and surrounding environment. Multiple angles help experts provide accurate diagnoses. Avoid blurry images and ensure the problem area is clearly visible.</p>
            </div>
          </div>

          <div class="faq-card">
            <div class="faq-icon-box faq-icon-green2"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
            <div class="faq-content">
              <h3 class="faq-question">How long does it take to get a response?</h3>
              <p class="faq-answer">Most experts respond within 24–48 hours. For urgent agricultural issues, you can select priority consultation packages that guarantee responses within 12 hours. Response times may vary during peak seasons or weekends.</p>
            </div>
          </div>

          <div class="faq-card">
            <div class="faq-icon-box faq-icon-cyan"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 .49-3.27"/></svg></div>
            <div class="faq-content">
              <h3 class="faq-question">What is your refund policy?</h3>
              <p class="faq-answer">If you're not satisfied with the consultation, you can request a full refund within 7 days of receiving the expert's response. We're committed to ensuring you receive valuable agricultural guidance. Refunds are processed within 5–7 business days.</p>
            </div>
          </div>

        </div>
      </section>

      <!-- PLATFORM RULES -->
      <section class="rules-section">
        <div class="section-header">
          <h2 class="section-title">Platform Rules</h2>
          <p class="section-subtitle">Guidelines to ensure a positive experience for all users</p>
        </div>
        <div class="rules-card">
          <div class="rules-card-header">
            <div class="rules-icon-box">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            </div>
            <div>
              <h3 class="rules-title">Community Guidelines</h3>
              <p class="rules-subtitle">Please follow these rules to maintain a respectful environment</p>
            </div>
          </div>
          <div class="rules-divider"></div>
          <ul class="rules-list">
            <li class="rules-item"><span class="rules-check"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></span>Be respectful to experts and other users</li>
            <li class="rules-item"><span class="rules-check"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></span>Do not send spam messages</li>
            <li class="rules-item"><span class="rules-check"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></span>Only submit genuine agricultural questions</li>
            <li class="rules-item"><span class="rules-check"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></span>Do not request personal contact outside the platform</li>
            <li class="rules-item"><span class="rules-check"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></span>Upload clear plant images when requesting diagnosis</li>
            <li class="rules-item"><span class="rules-check"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></span>Complete payments before consultations begin</li>
          </ul>
          <div class="rules-important">
            <span class="rules-important-icon"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg></span>
            <span><strong>Important:</strong> Misuse of the platform may result in account suspension</span>
          </div>
        </div>
      </section>


      <!-- PRIVACY POLICY -->
      <section class="privacy-section">
        <div class="section-header">
          <h2 class="section-title">Privacy Policy</h2>
          <p class="section-subtitle">How we collect, use, and protect your information</p>
        </div>

        <div class="privacy-grid">

          <div class="privacy-card">
            <div class="privacy-card-head">
              <div class="privacy-icon-box privacy-icon-blue">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
              </div>
              <h3>Data We Collect</h3>
            </div>
            <p>We collect information you provide directly, such as your name, email address, and agricultural questions. We also collect usage data to improve our services, including pages visited and consultation history.</p>
          </div>

          <div class="privacy-card">
            <div class="privacy-card-head">
              <div class="privacy-icon-box privacy-icon-green">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
              </div>
              <h3>How We Use Your Data</h3>
            </div>
            <p>Your data is used to provide and improve our consultation services, send important updates, and personalize your experience. We never sell your personal data to third parties.</p>
          </div>

          <div class="privacy-card">
            <div class="privacy-card-head">
              <div class="privacy-icon-box privacy-icon-teal">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
              </div>
              <h3>Data Security</h3>
            </div>
            <p>All data is encrypted in transit and at rest using industry-standard protocols. We regularly audit our security practices to ensure your information remains safe and protected at all times.</p>
          </div>

          <div class="privacy-card">
            <div class="privacy-card-head">
              <div class="privacy-icon-box privacy-icon-mint">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
              </div>
              <h3>Your Rights</h3>
            </div>
            <p>You have the right to access, correct, or delete your personal data at any time. You can also request a copy of your data or opt out of non-essential communications by visiting your account settings.</p>
          </div>

          <div class="privacy-card">
            <div class="privacy-card-head">
              <div class="privacy-icon-box privacy-icon-cyan">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8h1a4 4 0 0 1 0 8h-1"/><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/><line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/></svg>
              </div>
              <h3>Cookies</h3>
            </div>
            <p>We use cookies to keep you logged in and remember your preferences. You can control cookie settings through your browser. Disabling cookies may affect some platform functionality.</p>
          </div>

          <div class="privacy-card">
            <div class="privacy-card-head">
              <div class="privacy-icon-box privacy-icon-blue">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 .49-3.27"/></svg>
              </div>
              <h3>Policy Updates</h3>
            </div>
            <p>We may update this policy periodically. When we make significant changes, we'll notify you via email or an in-app notification. Continued use of Sproutly constitutes acceptance of the updated policy.</p>
          </div>

        </div>

        <div class="privacy-footer-note">
          <i class="fa-solid fa-circle-info"></i>
          <span>Last updated: January 1, 2026 · For questions, contact <strong>sproutly@gmail.com</strong></span>
        </div>
      </section>

      <!-- CTA -->
      <section class="cta-section">
        <div class="cta-card">
          <div class="cta-deco cta-deco-tl"></div>
          <div class="cta-deco cta-deco-br"></div>
          <div class="cta-deco cta-deco-tr"></div>
          <div class="cta-inner">
            <div class="cta-icon-wrap">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            </div>
            <h2 class="cta-title">Still have questions?</h2>
            <p class="cta-desc">Our support team is here to help. Reach out and we'll get back to you within 24 hours.</p>
            <button class="cta-btn" id="ctaBtn" type="button">
              Report a Problem
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </button>
          </div>
        </div>
      </section>

    </div><!-- /page-content -->

    <!-- FOOTER (exact dashboard-user) -->
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

<!-- Report Modal -->
<div class="modal-overlay hidden" id="reportModal">
  <div class="modal-card">
    <div class="modal-header">
      <h3>Report a Problem</h3>
      <button class="modal-close" id="modalClose" type="button"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="modal-body">
      <p class="modal-desc">Encountered an issue? Let us know and we'll work to resolve it quickly.</p>
      <div class="form-group">
        <label>Issue Title</label>
        <input type="text" id="issueTitle" placeholder="Brief description of the issue">
        <span class="field-error hidden" id="titleError">This field is required.</span>
      </div>
      <div class="form-group">
        <label>Description</label>
        <textarea id="issueDesc" placeholder="Please provide details about the problem you're experiencing..." rows="4"></textarea>
        <span class="field-error hidden" id="descError">This field is required.</span>
      </div>
      <div class="form-group">
        <label>Optional Screenshot</label>
        <div class="upload-zone" id="uploadZone">
          <input type="file" id="fileInput" accept="image/png,image/jpeg" style="display:none">
          <div class="upload-inner" id="uploadInner">
            <svg viewBox="0 0 24 24" fill="none" width="36" height="36">
              <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4" stroke="#c5d9ce" stroke-width="1.8" stroke-linecap="round"/>
              <polyline points="17 8 12 3 7 8" stroke="#c5d9ce" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
              <line x1="12" y1="3" x2="12" y2="15" stroke="#c5d9ce" stroke-width="1.8" stroke-linecap="round"/>
            </svg>
            <p>Tap to upload screenshot</p>
            <span>PNG, JPG up to 5MB</span>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button class="submit-btn" id="submitReport" type="button">Submit Report</button>
    </div>
  </div>
</div>

<!-- Success Toast -->
<div class="toast hidden" id="successToast">
  <div class="toast-icon"><i class="fa-solid fa-circle-check"></i></div>
  <div class="toast-text">
    <strong>Report Submitted</strong>
    <span>We'll get back to you within 24 hours.</span>
  </div>
  <button class="toast-close" id="toastClose" type="button"><i class="fa-solid fa-xmark"></i></button>
</div>

<script src="{{ asset('js/script-supportUser.js') }}"></script>
</body>
</html>