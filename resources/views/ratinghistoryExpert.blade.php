<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rating History - Sproutly</title>
    <link rel="stylesheet" href="{{ asset('css/style-ratinghistoryExpert.css') }}">
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

                    <a href="/consulexpert" class="menu-item">
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

                    <a href="/ConsultationhistoryExpert" class="menu-item active">
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

        <!-- MAIN CONTENT -->
        <div class="main-content" id="mainContent">
            <section class="rating-section">
                <div class="section-topbar">
                    <div class="title-row">
                        <button type="button" class="toggle-btn" id="sidebarToggle" aria-label="Toggle Sidebar">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>

                        <h1>Rating History</h1>
                    </div>
                </div>

                <div class="hero-text">
                    <h2>Expert Feedback Loop</h2>
                    <p>
                        View ratings and feedback from your past clients. Your expertise helps the
                        Sproutly community grow healthier indoor gardens.
                    </p>
                </div>

                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-top">
                            <div class="stat-icon">★</div>
                            <span class="stat-badge">+0.2 this week</span>
                        </div>
                        <span class="stat-label">AVERAGE RATING</span>
                        <h3 id="averageRating">4.8</h3>
                    </div>

                    <div class="stat-card">
                        <div class="stat-top">
                            <div class="stat-icon second">✮</div>
                        </div>
                        <span class="stat-label">TOTAL REVIEWS</span>
                        <h3 id="totalReviews">120</h3>
                    </div>
                </div>

                <div class="filter-bar">
                    <div class="search-box">
                        <span class="search-icon">⌕</span>
                        <input type="text" id="searchInput" placeholder="Search clients...">
                    </div>

                    <select id="ratingFilter" class="filter-select">
                        <option value="all">Rating: All</option>
                        <option value="5">Rating: 5 Star</option>
                        <option value="4">Rating: 4 Star</option>
                        <option value="3">Rating: 3 Star</option>
                    </select>

                    <select id="timeFilter" class="filter-select">
                        <option value="latest">Time: Latest</option>
                        <option value="oldest">Time: Oldest</option>
                    </select>

                    <select id="sortFilter" class="filter-select">
                        <option value="newest">Sort: Newest</option>
                        <option value="oldest">Sort: Oldest</option>
                        <option value="highest">Sort: Highest Rating</option>
                        <option value="lowest">Sort: Lowest Rating</option>
                    </select>
                </div>

                <div class="reviews-list" id="reviewsList">
                    <!-- Cards injected by JS -->
                </div>

                <div class="pagination" id="pagination">
                    <!-- Pagination injected by JS -->
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

    <script src="{{ asset('js/script-ratinghistoryExpert.js') }}"></script>
</body>
</html>