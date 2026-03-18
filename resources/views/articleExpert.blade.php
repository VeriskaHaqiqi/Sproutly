<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles - Sproutly Expert</title>
    <link rel="stylesheet" href="{{ asset('css/style-articleExpert.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <div class="layout">
        <!-- SIDEBAR -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <a href="#" class="logo-wrap">
                    <div class="logo-box">
                        <img src="{{ asset('images/logo.png') }}" alt="Sproutly" class="logo-img">
                    </div>
                    <span class="logo-text">Sproutly</span>
                </a>

                <button class="sidebar-toggle" id="sidebarToggle" type="button">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>

            <nav class="sidebar-menu">
                <a href="/dashboard-ahli" class="menu-link">
                    <img src="{{ asset('images/dashboard.png') }}" alt="Dashboard">
                    <span>Dashboard</span>
                </a>

                <a href="/consultation-ahli" class="menu-link">
                    <img src="{{ asset('images/consultation.png') }}" alt="Consultation">
                    <span>Consultation</span>
                </a>

                <a href="/article-expert" class="menu-link active">
                    <img src="{{ asset('images/article.png') }}" alt="Article">
                    <span>Article</span>
                </a>

                <a href="/myarticle" class="menu-link child-link">
                    <img src="{{ asset('images/myarticle.png') }}" alt="My Article">
                    <span>My Article</span>
                </a>

                <a href="/pricing" class="menu-link child-link">
                    <img src="{{ asset('images/pricing.png') }}" alt="Pricing">
                    <span>Pricing</span>
                </a>

                <a href="/clienthistory" class="menu-link child-link">
                    <img src="{{ asset('images/clienthistory.png') }}" alt="Client History">
                    <span>Client History</span>
                </a>

                <a href="/setting-ahli" class="menu-link child-link">
                    <img src="{{ asset('images/settings.png') }}" alt="Setting">
                    <span>Setting</span>
                </a>
            </nav>
        </aside>

        <!-- MAIN -->
        <main class="main-content">
            <div class="topbar">
                <div class="topbar-left">
                    <button class="mobile-toggle" id="mobileToggle" type="button">
                        <i class="fa-solid fa-bars"></i>
                    </button>

                    <div class="search-box">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" placeholder="Search articles...">
                    </div>
                </div>

                <div class="topbar-right">
                    <button class="toolbar-btn">Category <i class="fa-solid fa-angle-down"></i></button>
                    <button class="toolbar-btn">Status <i class="fa-solid fa-angle-down"></i></button>
                    <button class="toolbar-btn">Date Range <i class="fa-regular fa-calendar"></i></button>
                    <button class="toolbar-icon-btn"><i class="fa-solid fa-sliders"></i></button>
                </div>
            </div>

            <div class="heading-row">
                <div>
                    <h1>Articles</h1>
                    <p>Create, manage, and explore your articles</p>
                </div>

                <a href="/new-article" class="new-article-btn">
                    <i class="fa-solid fa-plus"></i>
                    New Article
                </a>
            </div>

            <div class="section-divider"></div>

            <div class="meta-row">
                <p>Showing 1 to 6 of 48 articles</p>

                <div class="pagination">
                    <button class="page-btn"><i class="fa-solid fa-angle-left"></i></button>
                    <button class="page-btn active">1</button>
                    <button class="page-btn">2</button>
                    <button class="page-btn">3</button>
                    <button class="page-btn"><i class="fa-solid fa-angle-right"></i></button>
                </div>
            </div>

            <section class="article-grid">
                <article class="article-card">
                    <div class="article-thumb thumb-1">
                        <span class="article-tag">HORTICULTURE</span>
                    </div>
                    <div class="article-body">
                        <div class="article-meta">Oct 12, 2023 <span>•</span> 8 min read</div>
                        <h3>Sustainable Indoor Gardening</h3>
                        <p>Discover the revolutionary methods of maintaining a lush, water-efficien...</p>
                        <a href="/edit-article" class="edit-link">Edit Article <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </article>

                <article class="article-card">
                    <div class="article-thumb thumb-2">
                        <span class="article-tag tag-blue">TECH INTEGRATION</span>
                    </div>
                    <div class="article-body">
                        <div class="article-meta">Oct 10, 2023 <span>•</span> 5 min read</div>
                        <h3>Hydroponic Systems for Beginners</h3>
                        <p>The ultimate guide to setting up your first soil-less growth kit with...</p>
                        <a href="/edit-article" class="edit-link">Edit Article <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </article>

                <article class="article-card">
                    <div class="article-thumb thumb-3">
                        <span class="article-tag tag-green">URBAN PLANNING</span>
                    </div>
                    <div class="article-body">
                        <div class="article-meta">Oct 08, 2023 <span>•</span> 12 min read</div>
                        <h3>The Future of Urban Farming</h3>
                        <p>Exploring how smart city infrastructure and IoT are turning...</p>
                        <a href="/edit-article" class="edit-link">Edit Article <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </article>

                <article class="article-card">
                    <div class="article-thumb thumb-4">
                        <span class="article-tag tag-yellow">IOT &amp; SENSORS</span>
                    </div>
                    <div class="article-body">
                        <div class="article-meta">Oct 05, 2023 <span>•</span> 6 min read</div>
                        <h3>Smart Irrigation Tech</h3>
                        <p>How low-energy Bluetooth sensors are revolutionizing water...</p>
                        <a href="/edit-article" class="edit-link">Edit Article <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </article>

                <article class="article-card">
                    <div class="article-thumb thumb-5">
                        <span class="article-tag tag-lime">ORGANIC CARE</span>
                    </div>
                    <div class="article-body">
                        <div class="article-meta">Oct 02, 2023 <span>•</span> 10 min read</div>
                        <h3>Natural Pest Control</h3>
                        <p>Avoid chemicals by using these organic predator-based methods fo...</p>
                        <a href="/edit-article" class="edit-link">Edit Article <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </article>

                <article class="article-card">
                    <div class="article-thumb thumb-6">
                        <span class="article-tag tag-pink">EDUCATION</span>
                    </div>
                    <div class="article-body">
                        <div class="article-meta">Sep 28, 2023 <span>•</span> 7 min read</div>
                        <h3>Seasonal Plant Care</h3>
                        <p>A month-by-month guide to ensuring your plants thrive during the...</p>
                        <a href="/edit-article" class="edit-link">Edit Article <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </article>
            </section>

            <footer class="site-footer">
                <div class="footer-grid">
                    <div class="footer-brand">
                        <div class="footer-brand-top">
                            <div class="footer-logo-box">
                                <img src="{{ asset('images/logo.png') }}" alt="Sproutly Logo" class="footer-logo">
                            </div>
                            <div>
                                <h3>Sproutly</h3>
                                <span>by AVI</span>
                            </div>
                        </div>

                        <p>
                            A modern agriculture consultation platform for a greener and more sustainable future.
                        </p>
                    </div>

                    <div class="footer-links">
                        <h4>About Us</h4>
                        <a href="#">Our Team</a>
                        <a href="#">Blog</a>
                        <a href="#">Privacy Policy</a>
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

                <div class="footer-bottom">
                    © 2025 Sproutly by AVI. All rights reserved.
                </div>
            </footer>
        </main>
    </div>

    <script src="{{ asset('js/articleExpert.js') }}"></script>
</body>
</html>