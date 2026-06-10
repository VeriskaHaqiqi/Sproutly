<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Support & Information - Sproutly Expert</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/style-supportExpert.css') }}">
</head>
<body>
<div class="dashboard-page">

  <!-- SIDEBAR (expert) -->
  <aside class="sidebar closed" id="sidebar">
    <div class="sidebar-header">
      <a href="{{ url('/homeExpert') }}" class="logo-wrap">
        <div class="logo-box">
          <img src="{{ asset('images/logo.png') }}" alt="Sproutly Logo" class="logo-img">
        </div>
        <span class="logo-text">Sproutly</span>
      </a>
    </div>
    <div class="sidebar-line"></div>
    <nav class="sidebar-menu">
      <a href="{{ url('/dashboard-ahli') }}"         class="menu-link"><i class="fa-solid fa-chart-line"></i><span>Dashboard</span></a>
      <a href="{{ url('/consulexpert') }}"            class="menu-link"><i class="fa-solid fa-comments"></i><span>Consultation</span></a>
      <a href="{{ url('/articleExpert') }}"           class="menu-link"><i class="fa-solid fa-newspaper"></i><span>Article</span></a>
      <a href="{{ url('/myarticleExpert') }}"         class="menu-link child-link"><i class="fa-solid fa-file-lines"></i><span>My Article</span></a>
      <a href="{{ url('/setpricingexpert') }}"        class="menu-link child-link"><i class="fa-solid fa-dollar-sign"></i><span>Pricing</span></a>
      <a href="{{ url('/ConsultationhistoryUser') }}" class="menu-link child-link"><i class="fa-solid fa-clock-rotate-left"></i><span>Client History</span></a>
      <a href="{{ url('/accountExpert') }}"           class="menu-link child-link"><i class="fa-solid fa-gear"></i><span>Setting</span></a>
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
        <button class="notif-btn" type="button" id="notifBtn">
          <svg viewBox="0 0 24 24" fill="none">
            <path d="M8 18H16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            <path d="M10 20C10.5 21 11.1 21.5 12 21.5C12.9 21.5 13.5 21 14 20" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            <path d="M18 17H6C6.9 16.2 7.5 15 7.5 13.8V10.8C7.5 8.2 9.4 6 12 6C14.6 6 16.5 8.2 16.5 10.8V13.8C16.5 15 17.1 16.2 18 17Z" fill="currentColor"/>
          </svg>
        </button>
        <a href="{{ url('/accountExpert') }}" class="profile-chip">
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
            Expert Help Center
          </div>
          <h1 class="hero-title">Support &amp; Information</h1>
          <p class="hero-subtitle">Everything you need to know about managing your expert account and serving clients effectively.</p>
        </div>
      </section>

      <!-- FAQ -->
      <section class="faq-section">
        <div class="section-header">
          <h2 class="section-title">Frequently Asked Questions</h2>
          <p class="section-subtitle">Common questions from Sproutly agricultural experts</p>
        </div>
        <div class="faq-list">

          <div class="faq-card">
            <div class="faq-icon-box faq-icon-blue"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></div>
            <div class="faq-content">
              <h3 class="faq-question">How do I register as an expert?</h3>
              <p class="faq-answer">Click "Join as Expert" on the homepage and complete your professional profile including credentials, specialization, and years of experience. Our team will review your application within 3–5 business days. You'll receive an email once your account is verified and activated.</p>
            </div>
          </div>

          <div class="faq-card">
            <div class="faq-icon-box faq-icon-green"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></div>
            <div class="faq-content">
              <h3 class="faq-question">How do I respond to client consultations?</h3>
              <p class="faq-answer">When a client submits a consultation, you'll receive a notification. Open the Consultation section, review the client's question and any attached photos, then submit your detailed response. You have up to 48 hours to reply. Timely responses improve your rating and visibility.</p>
            </div>
          </div>

          <div class="faq-card">
            <div class="faq-icon-box faq-icon-teal"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg></div>
            <div class="faq-content">
              <h3 class="faq-question">How and when do I get paid?</h3>
              <p class="faq-answer">Earnings are transferred to your registered bank account every 2 weeks. You can track your income in the Client History section. Sproutly deducts a 15% platform service fee from each consultation fee. Minimum withdrawal threshold is $20.</p>
            </div>
          </div>

          <div class="faq-card">
            <div class="faq-icon-box faq-icon-mint"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg></div>
            <div class="faq-content">
              <h3 class="faq-question">How do I set my consultation pricing?</h3>
              <p class="faq-answer">Go to the Pricing section in your sidebar to configure your rates. You can create multiple packages (Basic, Standard, Premium) with different response times and inclusions. We recommend researching market rates for your specialty to stay competitive and attract more clients.</p>
            </div>
          </div>

          <div class="faq-card">
            <div class="faq-icon-box faq-icon-green2"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg></div>
            <div class="faq-content">
              <h3 class="faq-question">How is my expert rating calculated?</h3>
              <p class="faq-answer">Your rating is based on client reviews after each completed consultation, scored 1–5 stars for response quality, communication, and helpfulness. Maintaining a rating above 4.0 gives you priority placement in search results and significantly increases your visibility to potential clients.</p>
            </div>
          </div>

          <div class="faq-card">
            <div class="faq-icon-box faq-icon-cyan"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 .49-3.27"/></svg></div>
            <div class="faq-content">
              <h3 class="faq-question">What happens if a client requests a refund?</h3>
              <p class="faq-answer">If a client requests a refund within 7 days, our team will review the consultation quality. If approved due to an incomplete or unsatisfactory response, the fee is returned to the client. Repeated refund incidents may affect your expert status and standing on the platform.</p>
            </div>
          </div>

        </div>
      </section>

      <!-- EXPERT GUIDELINES -->
      <section class="rules-section">
        <div class="section-header">
          <h2 class="section-title">Expert Guidelines</h2>
          <p class="section-subtitle">Standards to maintain quality and trust on the Sproutly platform</p>
        </div>
        <div class="rules-card">
          <div class="rules-card-header">
            <div class="rules-icon-box">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            </div>
            <div>
              <h3 class="rules-title">Professional Standards</h3>
              <p class="rules-subtitle">Follow these guidelines to maintain your expert status and rating</p>
            </div>
          </div>
          <div class="rules-divider"></div>
          <ul class="rules-list">
            <li class="rules-item"><span class="rules-check"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></span>Always respond to clients professionally and respectfully</li>
            <li class="rules-item"><span class="rules-check"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></span>Respond to all consultations within the agreed timeframe (48 hours)</li>
            <li class="rules-item"><span class="rules-check"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></span>Only provide advice within your verified area of expertise</li>
            <li class="rules-item"><span class="rules-check"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></span>Do not solicit clients for contact or payments outside the platform</li>
            <li class="rules-item"><span class="rules-check"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></span>Keep your credentials and profile information accurate and up to date</li>
            <li class="rules-item"><span class="rules-check"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></span>Never share client data or consultation details with third parties</li>
          </ul>
          <div class="rules-important">
            <span class="rules-important-icon"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg></span>
            <span><strong>Important:</strong> Violating expert guidelines may result in rating penalties or permanent account suspension</span>
          </div>
        </div>
      </section>

      <!-- PRIVACY POLICY -->
      <section class="privacy-section">
        <div class="section-header">
          <h2 class="section-title">Privacy Policy</h2>
          <p class="section-subtitle">How we collect, use, and protect your information as an expert</p>
        </div>
        <div class="privacy-grid">
          <div class="privacy-card">
            <div class="privacy-card-head">
              <div class="privacy-icon-box privacy-icon-blue"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
              <h3>Data We Collect</h3>
            </div>
            <p>We collect your professional credentials, consultation responses, earnings data, and platform activity. This helps us verify your expertise, process payments, and improve the platform for both experts and clients.</p>
          </div>
          <div class="privacy-card">
            <div class="privacy-card-head">
              <div class="privacy-icon-box privacy-icon-green"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg></div>
              <h3>How We Use Your Data</h3>
            </div>
            <p>Your data is used to process payouts, display your profile to potential clients, generate performance analytics, and send important platform updates. We never sell your personal or professional data to third parties.</p>
          </div>
          <div class="privacy-card">
            <div class="privacy-card-head">
              <div class="privacy-icon-box privacy-icon-teal"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg></div>
              <h3>Data Security</h3>
            </div>
            <p>All expert and client data is encrypted in transit and at rest. Bank account details for payouts are stored using PCI-compliant third-party processors. We conduct regular security audits to protect your information.</p>
          </div>
          <div class="privacy-card">
            <div class="privacy-card-head">
              <div class="privacy-icon-box privacy-icon-mint"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></div>
              <h3>Your Rights</h3>
            </div>
            <p>You can request access to, correction of, or deletion of your expert account data at any time. You may also export your consultation history and earnings records. Contact our support team to exercise these rights.</p>
          </div>
          <div class="privacy-card">
            <div class="privacy-card-head">
              <div class="privacy-icon-box privacy-icon-cyan"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8h1a4 4 0 0 1 0 8h-1"/><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/><line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/></svg></div>
              <h3>Cookies</h3>
            </div>
            <p>We use cookies to keep you logged in and track your dashboard activity for performance analytics. You can manage cookie preferences via your browser settings without affecting core platform functionality.</p>
          </div>
          <div class="privacy-card">
            <div class="privacy-card-head">
              <div class="privacy-icon-box privacy-icon-blue"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 .49-3.27"/></svg></div>
              <h3>Policy Updates</h3>
            </div>
            <p>We may update this policy periodically. Significant changes will be communicated via email or in-app notification. Continued use of the Sproutly Expert platform constitutes acceptance of the updated policy.</p>
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
            <h2 class="cta-title">Need further assistance?</h2>
            <p class="cta-desc">Our expert support team is ready to help. We'll get back to you within 24 hours.</p>
            <button class="cta-btn" id="ctaBtn" type="button">
              Report a Problem
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </button>
          </div>
        </div>
      </section>

    </div><!-- /page-content -->

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
            <svg viewBox="0 0 24 24" fill="none" width="36" height="36"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4" stroke="#c5d9ce" stroke-width="1.8" stroke-linecap="round"/><polyline points="17 8 12 3 7 8" stroke="#c5d9ce" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><line x1="12" y1="3" x2="12" y2="15" stroke="#c5d9ce" stroke-width="1.8" stroke-linecap="round"/></svg>
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

<script src="{{ asset('js/script-supportExpert.js') }}"></script>
</body>
</html>