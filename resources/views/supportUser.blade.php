<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support & Information - Sproutly</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style-supportUser.css') }}">
</head>
<body>

<!-- NAVBAR -->
<header class="navbar">
    <a href="{{ url('/home') }}" class="navbar-brand">
        <div class="logo-box">
            <img src="{{ asset('images/logo.png') }}" alt="Sproutly" class="logo-img">
        </div>
        <span class="brand-text">Sproutly</span>
    </a>
    <div class="navbar-right">
        <button class="notif-btn" id="notifBtn" aria-label="Notifications">
            <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
            </svg>
        </button>
        <a href="{{ url('/account') }}" class="profile-card">
            <div class="profile-info">
                <span class="profile-name">Sarah Green</span>
            </div>
            <img src="{{ asset('images/fotoprofile.png') }}" alt="Profile" class="profile-avatar">
        </a>
    </div>
</header>

<!-- PAGE WRAPPER -->
<div class="page-wrapper">

    <!-- HERO SECTION -->
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

    <!-- FAQ SECTION -->
    <section class="faq-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Frequently Asked Questions</h2>
                <p class="section-subtitle">Quick answers to common questions about Sproutly</p>
            </div>

            <div class="faq-list">

                <div class="faq-card">
                    <div class="faq-icon-box faq-icon-blue">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                    </div>
                    <div class="faq-content">
                        <h3 class="faq-question">How do I create an account?</h3>
                        <p class="faq-answer">Click the "Sign Up" button in the top right corner. You can register using your email address or social media accounts. After verifying your email, you'll have full access to all platform features including expert consultations and educational articles.</p>
                    </div>
                </div>

                <div class="faq-card">
                    <div class="faq-icon-box faq-icon-green">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                        </svg>
                    </div>
                    <div class="faq-content">
                        <h3 class="faq-question">How does expert consultation work?</h3>
                        <p class="faq-answer">Browse our verified agricultural experts by specialty, select an expert, choose a consultation package, and submit your question with relevant photos. The expert will respond within 24–48 hours with detailed advice tailored to your specific situation.</p>
                    </div>
                </div>

                <div class="faq-card">
                    <div class="faq-icon-box faq-icon-teal">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="1" y="4" width="22" height="16" rx="2" ry="2"/>
                            <line x1="1" y1="10" x2="23" y2="10"/>
                        </svg>
                    </div>
                    <div class="faq-content">
                        <h3 class="faq-question">What payment methods are accepted?</h3>
                        <p class="faq-answer">We accept all major credit cards (Visa, MasterCard, American Express), debit cards, and digital wallets including PayPal and Apple Pay. All transactions are secured with industry-standard encryption to protect your financial information.</p>
                    </div>
                </div>

                <div class="faq-card">
                    <div class="faq-icon-box faq-icon-mint">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="18" height="18" rx="2"/>
                            <circle cx="8.5" cy="8.5" r="1.5"/>
                            <polyline points="21 15 16 10 5 21"/>
                        </svg>
                    </div>
                    <div class="faq-content">
                        <h3 class="faq-question">How should I take photos of my plants?</h3>
                        <p class="faq-answer">Take clear, well-lit photos in natural daylight. Include close-ups of affected areas, overall plant structure, and surrounding environment. Multiple angles help experts provide accurate diagnoses. Avoid blurry images and ensure the problem area is clearly visible.</p>
                    </div>
                </div>

                <div class="faq-card">
                    <div class="faq-icon-box faq-icon-green2">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12 6 12 12 16 14"/>
                        </svg>
                    </div>
                    <div class="faq-content">
                        <h3 class="faq-question">How long does it take to get a response?</h3>
                        <p class="faq-answer">Most experts respond within 24–48 hours. For urgent agricultural issues, you can select priority consultation packages that guarantee responses within 12 hours. Response times may vary during peak seasons or weekends.</p>
                    </div>
                </div>

                <div class="faq-card">
                    <div class="faq-icon-box faq-icon-cyan">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="1 4 1 10 7 10"/>
                            <path d="M3.51 15a9 9 0 1 0 .49-3.27"/>
                        </svg>
                    </div>
                    <div class="faq-content">
                        <h3 class="faq-question">What is your refund policy?</h3>
                        <p class="faq-answer">If you're not satisfied with the consultation, you can request a full refund within 7 days of receiving the expert's response. We're committed to ensuring you receive valuable agricultural guidance. Refunds are processed within 5–7 business days.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- PLATFORM RULES SECTION -->
    <section class="rules-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Platform Rules</h2>
                <p class="section-subtitle">Guidelines to ensure a positive experience for all users</p>
            </div>

            <div class="rules-card">
                <div class="rules-card-header">
                    <div class="rules-icon-box">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="rules-title">Community Guidelines</h3>
                        <p class="rules-subtitle">Please follow these rules to maintain a respectful environment</p>
                    </div>
                </div>

                <div class="rules-divider"></div>

                <ul class="rules-list">
                    <li class="rules-item">
                        <span class="rules-check">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                        </span>
                        Be respectful to experts and other users
                    </li>
                    <li class="rules-item">
                        <span class="rules-check">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                        </span>
                        Do not send spam messages
                    </li>
                    <li class="rules-item">
                        <span class="rules-check">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                        </span>
                        Only submit genuine agricultural questions
                    </li>
                    <li class="rules-item">
                        <span class="rules-check">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                        </span>
                        Do not request personal contact outside the platform
                    </li>
                    <li class="rules-item">
                        <span class="rules-check">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                        </span>
                        Upload clear plant images when requesting diagnosis
                    </li>
                    <li class="rules-item">
                        <span class="rules-check">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                        </span>
                        Complete payments before consultations begin
                    </li>
                </ul>

                <div class="rules-important">
                    <span class="rules-important-icon">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/>
                            <line x1="12" y1="8" x2="12" y2="12"/>
                            <line x1="12" y1="16" x2="12.01" y2="16"/>
                        </svg>
                    </span>
                    <span><strong>Important:</strong> Misuse of the platform may result in account suspension</span>
                </div>

                <div class="rules-deco">
                    <div class="rules-deco-circle"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA SECTION -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-card">
                <div class="cta-deco cta-deco-tl"></div>
                <div class="cta-deco cta-deco-br"></div>
                <div class="cta-deco cta-deco-tr"></div>
                <div class="cta-inner">
                    <div class="cta-icon-wrap">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <polyline points="22,6 12,13 2,6"/>
                        </svg>
                    </div>
                    <h2 class="cta-title">Still have questions?</h2>
                    <p class="cta-desc">Our support team is here to help. Reach out and we'll get back to you within 24 hours.</p>
                    <a href="#" class="cta-btn" id="ctaBtn">
                        Contact Support
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"/>
                            <polyline points="12 5 19 12 12 19"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

</div><!-- end page-wrapper -->

<script src="{{ asset('js/script-supportUser.js') }}"></script>
</body>
</html>