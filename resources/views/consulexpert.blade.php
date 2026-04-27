<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultation Requests - Sproutly</title>
    <link rel="stylesheet" href="{{ asset('css/style-consulexpert.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <div class="page-layout">
        <!-- SIDEBAR -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-inner">
                <div class="sidebar-top">
                    <a href="#" class="logo-wrap">
                        <div class="logo-box">
                            <img src="{{ asset('images/logo.png') }}" alt="Sproutly Logo">
                        </div>
                        <span class="logo-text">Sproutly</span>
                    </a>
                </div>

                <nav class="sidebar-menu">
                    <a href="/dashboard-ahli" class="menu-item">
                        <img src="{{ asset('images/dashboard.png') }}" alt="Dashboard">
                        <span>Dashboard</span>
                    </a>

                    <a href="/consulexpert" class="menu-item active">
                        <img src="{{ asset('images/consultation.png') }}" alt="Consultation">
                        <span>Consultation</span>
                    </a>

                    <a href="/articleExpert" class="menu-item">
                        <img src="{{ asset('images/article.png') }}" alt="Article">
                        <span>Article</span>
                    </a>

                    <a href="/myarticleExpert" class="menu-item">
                        <img src="{{ asset('images/myarticle.png') }}" alt="My Article">
                        <span>My Article</span>
                    </a>

                    <a href="/setpricingexpert" class="menu-item">
                        <img src="{{ asset('images/pricing.png') }}" alt="Pricing">
                        <span>Pricing</span>
                    </a>

                    <a href="/ConsultationhistoryExpert" class="menu-item">
                        <img src="{{ asset('images/clienthistory.png') }}" alt="Client History">
                        <span>Client History</span>
                    </a>

                    <a href="/accountExpert" class="menu-item">
                        <img src="{{ asset('images/settings.png') }}" alt="Setting">
                        <span>Setting</span>
                    </a>
                </nav>
            </div>
        </aside>

        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <!-- MAIN -->
        <div class="main-content" id="mainContent">
            <section class="consultation-section">
                <div class="consultation-header">
                    <div class="consultation-title-group">
                        <button type="button" class="toggle-btn" id="sidebarToggle" aria-label="Toggle Sidebar">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>

                        <div class="consultation-title-text">
                            <h1>Consultation Requests</h1>
                            <p>Review incoming consultation requests from farmers and users.</p>
                        </div>
                    </div>
                </div>

                <div class="search-wrap">
                    <div class="search-box">
                        <span class="search-icon">⌕</span>
                        <input type="text" placeholder="Search consultation requests..." id="searchInput">
                    </div>
                </div>

                <div class="requests-list" id="requestsList">
                    <article class="request-card" data-url="/roomChatExpert">
                        <div class="request-left">
                            <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=300&auto=format&fit=crop" alt="Michael Thompson" class="avatar">

                            <div class="request-content">
                                <div class="request-topline">
                                    <h3>Michael Thompson</h3>
                                    <span class="expertise">Soil Science</span>
                                    <span class="time">5m ago</span>
                                </div>

                                <h4>Soil pH levels affecting crop yield</h4>
                                <p>
                                    I've been experiencing poor crop yields in my wheat field. Recent tests show pH levels around 5.2.
                                    What amendments would you recommend to bring it to optimal levels?
                                </p>
                            </div>
                        </div>
                    </article>

                    <article class="request-card" data-url="/roomChatExpert">
                        <div class="request-left">
                            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=300&auto=format&fit=crop" alt="Sarah Martinez" class="avatar">

                            <div class="request-content">
                                <div class="request-topline">
                                    <h3>Sarah Martinez</h3>
                                    <span class="expertise">Pest Control</span>
                                    <span class="time">1h ago</span>
                                </div>

                                <h4>Aphid infestation on tomato plants</h4>
                                <p>
                                    My greenhouse tomatoes are heavily infested with aphids. I prefer organic solutions.
                                    What's the most effective treatment that won't harm beneficial insects?
                                </p>
                            </div>
                        </div>
                    </article>

                    <article class="request-card" data-url="/roomChatExpert">
                        <div class="request-left">
                            <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?q=80&w=300&auto=format&fit=crop" alt="Robert Chen" class="avatar">

                            <div class="request-content">
                                <div class="request-topline">
                                    <h3>Robert Chen</h3>
                                    <span class="expertise">Irrigation</span>
                                    <span class="time">2h ago</span>
                                </div>

                                <h4>Drip irrigation system design for vineyard</h4>
                                <p>
                                    Planning to install a drip irrigation system for my 5-acre vineyard. Need advice on optimal spacing,
                                    flow rates, and whether to use pressure compensating emitters.
                                </p>
                            </div>
                        </div>
                    </article>

                    <article class="request-card" data-url="/roomChatExpert">
                        <div class="request-left">
                            <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?q=80&w=300&auto=format&fit=crop" alt="Emily Johnson" class="avatar">

                            <div class="request-content">
                                <div class="request-topline">
                                    <h3>Emily Johnson</h3>
                                    <span class="expertise">Crop Rotation</span>
                                    <span class="time">3h ago</span>
                                </div>

                                <h4>Rotation plan for corn-soybean system</h4>
                                <p>
                                    I've been doing corn-soybean rotation for years. Wondering if I should incorporate cover crops
                                    or add another cash crop to improve soil health and profitability.
                                </p>
                            </div>
                        </div>
                    </article>

                    <article class="request-card" data-url="/roomChatExpert">
                        <div class="request-left">
                            <img src="https://images.unsplash.com/photo-1502685104226-ee32379fefbe?q=80&w=300&auto=format&fit=crop" alt="David Kumar" class="avatar">

                            <div class="request-content">
                                <div class="request-topline">
                                    <h3>David Kumar</h3>
                                    <span class="expertise">Soil Science</span>
                                    <span class="time">5h ago</span>
                                </div>

                                <h4>Nutrient deficiency in rice paddies</h4>
                                <p>
                                    Noticing yellowing leaves in my rice crop, particularly older leaves. Soil test shows low nitrogen.
                                    What's the best fertilization strategy at this growth stage?
                                </p>
                            </div>
                        </div>
                    </article>

                    <article class="request-card" data-url="/roomChatExpert">
                        <div class="request-left">
                            <img src="https://images.unsplash.com/photo-1504593811423-6dd665756598?q=80&w=300&auto=format&fit=crop" alt="Lisa Anderson" class="avatar">

                            <div class="request-content">
                                <div class="request-topline">
                                    <h3>Lisa Anderson</h3>
                                    <span class="expertise">Pest Control</span>
                                    <span class="time">6h ago</span>
                                </div>

                                <h4>Fungal disease on apple trees</h4>
                                <p>
                                    Apple scab appearing on my orchard trees. Already did dormant spray in spring. Should I apply fungicide now
                                    or wait until next season? Trees are 5 years old.
                                </p>
                            </div>
                        </div>
                    </article>
                </div>
            </section>

            <!-- FOOTER -->
            <footer class="footer">
                <div class="footer-top">
                    <div class="footer-brand">
                        <div class="footer-brand-row">
                            <div class="footer-logo-circle">
                                <img src="{{ asset('images/logo.png') }}" alt="Sproutly Logo">
                            </div>
                            <div>
                                <h2>Sproutly</h2>
                                <span>by AVI</span>
                            </div>
                        </div>
                        <p>
                            A modern agriculture consultation platform for a greener and
                            more sustainable future.
                        </p>
                    </div>

                    <div class="footer-links">
                        <h3>About Us</h3>
                        <a href="#">Our Team</a>
                        <a href="#">Blog</a>
                        <a href="#">Privacy Policy</a>
                    </div>

                    <div class="footer-contact">
                        <h3>Contact</h3>
                        <p>✉ sproutly@gmail.com</p>
                        <p>📞 +62 851 5693 2186</p>

                        <div class="social-row">
                            <a href="#"><img src="{{ asset('images/instagram.jpg') }}" alt="Instagram"></a>
                            <a href="#"><img src="{{ asset('images/facebook.png') }}" alt="Facebook"></a>
                            <a href="#"><img src="{{ asset('images/X.jpg') }}" alt="X"></a>
                        </div>
                    </div>
                </div>

                <div class="footer-bottom">
                    © 2025 Sproutly by AVI. All rights reserved.
                </div>
            </footer>
        </div>
    </div>

    <script src="{{ asset('js/script-consulexpert.js') }}"></script>
</body>
</html>