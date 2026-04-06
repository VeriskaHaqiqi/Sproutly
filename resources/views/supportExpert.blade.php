<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support & Information - Sproutly Expert</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style-supportExpert.css') }}">
</head>
<body>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <aside class="sidebar-expert" id="sidebarExpert">
        <div class="sidebar-header">
            <div class="logo-container">
                <div class="logo-box">
                    <img src="{{ asset('images/logo.png') }}" alt="Sproutly Logo">
                </div>
                <span class="brand-name">Sproutly</span>
            </div>
            <button class="btn-close-sidebar" id="closeSidebar">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>
        
        <nav class="sidebar-nav">
            <a href="{{ url('/expert/dashboard') }}" class="nav-item">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                Dashboard
            </a>
            <a href="{{ url('/expert/consultation') }}" class="nav-item">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                Consultation
            </a>
            <a href="{{ url('/expert/history') }}" class="nav-item">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                Client History
            </a>
            <a href="{{ url('/expert/articles') }}" class="nav-item">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                Article
            </a>
            <a href="{{ url('/expert/reviews') }}" class="nav-item">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                Reviews
            </a>
            <a href="{{ url('/expert/payment') }}" class="nav-item">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                Payment
            </a>
            <a href="{{ url('/expert/settings') }}" class="nav-item">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                Setting
            </a>
            <a href="{{ url('/expert/support') }}" class="nav-item active">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                Support & Information
            </a>
        </nav>
    </aside>

    <div class="main-wrapper">
        <nav class="navbar">
            <div class="nav-left">
                <button class="hamburger-btn" id="hamburgerBtn">
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                </button>
                <div class="nav-brand-mobile">
                     <div class="logo-box">
                        <img src="{{ asset('images/logo.png') }}" alt="Sproutly">
                    </div>
                    <span class="brand-name">Sproutly</span>
                </div>
            </div>
            
            <div class="nav-right">
                <button class="notif-btn">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                    <span class="notif-dot"></span>
                </button>
                
                <div class="profile-card">
                    <div class="profile-info">
                        <span class="expert-name">Sarah Green</span>
                        <span class="expert-role">Agriculture Expert</span>
                    </div>
                    <div class="expert-avatar">
                        <img src="{{ asset('images/fotoprofile.png') }}" alt="Expert Sarah Green">
                    </div>
                </div>
            </div>
        </nav>

        <div class="page-content">
            <section class="hero-section">
                <div class="bubble-decor b-1"></div>
                <div class="bubble-decor b-2"></div>
                <div class="container">
                    <div class="pill-badge">Help Center</div>
                    <h1 class="hero-title">Support & Information</h1>
                    <p class="hero-subtitle">Find answers to common questions and understand the platform rules.</p>
                </div>
            </section>

            <section class="faq-section">
                <div class="container">
                    <div class="section-title">
                        <h2>Frequently Asked Questions</h2>
                        <p>Quick answers to common questions about Sproutly Expert experience</p>
                    </div>

                    <div class="faq-grid">
                        <div class="faq-card">
                            <div class="faq-icon-circle">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                            </div>
                            <div class="faq-txt">
                                <h3>How do I receive consultation requests?</h3>
                                <p>You will receive a real-time notification on your dashboard. You can review the client's plant history before accepting the session.</p>
                            </div>
                        </div>
                        <div class="faq-card">
                            <div class="faq-icon-circle">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                            </div>
                            <div class="faq-txt">
                                <h3>When will I receive my commission payout?</h3>
                                <p>Payouts are processed every Friday for all completed consultations from the previous week directly to your registered bank account.</p>
                            </div>
                        </div>
                        <div class="faq-card">
                            <div class="faq-icon-circle">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                            </div>
                            <div class="faq-txt">
                                <h3>How do I manage my availability?</h3>
                                <p>Navigate to the "Setting" menu. You can define your active hours and days to ensure you only receive requests when you are ready.</p>
                            </div>
                        </div>
                        <div class="faq-card">
                            <div class="faq-icon-circle">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                            </div>
                            <div class="faq-txt">
                                <h3>What happens if a user requests a refund?</h3>
                                <p>Refunds are only granted if the expert fails to respond within 48 hours. Our support team mediates any quality-related disputes.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="rules-section">
                <div class="container">
                    <div class="rules-card">
                        <div class="rules-header">
                            <div class="rules-icon-wrap">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#76ead0" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                            </div>
                            <div>
                                <h3>Expert Community Guidelines</h3>
                                <p>Guidelines to ensure a professional and positive experience</p>
                            </div>
                        </div>
                        
                        <div class="rules-body">
                            <div class="rule-row">
                                <div class="check-svg"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg></div>
                                <span>Provide clear and professional consultation responses</span>
                            </div>
                            <div class="rule-row">
                                <div class="check-svg"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg></div>
                                <span>Maintain respectful communication with users</span>
                            </div>
                            <div class="rule-row">
                                <div class="check-svg"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg></div>
                                <span>Do not share personal contact outside the platform</span>
                            </div>
                            <div class="rule-row">
                                <div class="check-svg"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg></div>
                                <span>Respond to priority consultations within the 12-hour window</span>
                            </div>
                        </div>

                        <div class="rules-warning">
                            <div class="warning-svg"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg></div>
                            <p><strong>Important:</strong> Professional conduct is monitored. Repeated violations may result in account suspension.</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="cta-section">
                <div class="container">
                    <div class="cta-box">
                        <div class="cta-circle-decor"></div>
                        <div class="cta-icon-main">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                        </div>
                        <h2>Still have questions?</h2>
                        <p>Our dedicated support team for experts is available 24/7 to help you provide the best advice for our community.</p>
                        <a href="#" class="btn-cta">
                            Contact Support 
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                        </a>
                    </div>
                </div>
            </section>

            <footer class="footer">
                <div class="container">
                    <div class="footer-grid">
                        <div class="f-brand">
                            <div class="logo-container">
                                <div class="logo-box">
                                    <img src="{{ asset('images/logo.png') }}" alt="Logo">
                                </div>
                                <span class="brand-name">Sproutly</span>
                            </div>
                            <p>Sproutly connects agriculture experts with plant lovers worldwide for better, greener living.</p>
                        </div>
                        <div class="f-links">
                            <h4>Platform</h4>
                            <ul>
                                <li><a href="#">Dashboard</a></li>
                                <li><a href="#">Expert Policy</a></li>
                                <li><a href="#">Community Rules</a></li>
                            </ul>
                        </div>
                        <div class="f-links">
                            <h4>Support</h4>
                            <ul>
                                <li><a href="#">Help Center</a></li>
                                <li><a href="#">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="f-bottom">
                        <p>© 2026 Sproutly by AVI. All rights reserved.</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="{{ asset('js/script-supportExpert.js') }}"></script>
</body>
</html>