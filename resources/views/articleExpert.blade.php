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
                <a href="{{ url('/homeExpert') }}" class="logo-wrap">
                    <div class="logo-box">
                        <img src="{{ asset('images/logo.png') }}" alt="Sproutly Logo" class="logo-img">
                    </div>
                    <span class="logo-text">Sproutly</span>
                </a>
            </div>

            <div class="sidebar-line"></div>

            <nav class="sidebar-menu">
                <a href="{{ url('/dashboard-ahli') }}" class="menu-link">
                    <img src="{{ asset('images/dashboard.png') }}" alt="Dashboard">
                    <span>Dashboard</span>
                </a>

                <a href="{{ url('/consulexpert') }}" class="menu-link">
                    <img src="{{ asset('images/consultation.png') }}" alt="Consultation">
                    <span>Consultation</span>
                </a>

                <a href="{{ url('/articleExpert') }}" class="menu-link active">
                    <img src="{{ asset('images/article.png') }}" alt="Article">
                    <span>Article</span>
                </a>

                <a href="{{ url('/myarticleExpert') }}" class="menu-link child-link">
                    <img src="{{ asset('images/myarticle.png') }}" alt="My Article">
                    <span>My Article</span>
                </a>

                <a href="{{ url('/setpricingexpert') }}" class="menu-link child-link">
                    <img src="{{ asset('images/pricing.png') }}" alt="Pricing">
                    <span>Pricing</span>
                </a>

                <a href="{{ url('/ConsultationhistoryExpert') }}" class="menu-link child-link">
                    <img src="{{ asset('images/clienthistory.png') }}" alt="Client History">
                    <span>Client History</span>
                </a>

                <a href="{{ url('/accountExpert') }}" class="menu-link child-link">
                    <img src="{{ asset('images/settings.png') }}" alt="Setting">
                    <span>Setting</span>
                </a>
            </nav>
        </aside>

        <!-- MAIN -->
        <div class="main-content shifted" id="mainContent">
            <header class="topbar">
                <div class="topbar-left">
                    <button class="sidebar-toggle" id="sidebarToggle" type="button" aria-label="Toggle Sidebar">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>

                    <div class="search-box">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" id="searchInput" placeholder="Search article title...">
                    </div>
                </div>

                <div class="topbar-right">
                    <select id="categoryFilter" class="filter-select">
                        <option value="all">All Categories</option>
                        <option value="Horticulture">Horticulture</option>
                        <option value="Tech Integration">Tech Integration</option>
                        <option value="Urban Planning">Urban Planning</option>
                        <option value="IoT & Sensors">IoT & Sensors</option>
                        <option value="Organic Care">Organic Care</option>
                        <option value="Education">Education</option>
                    </select>

                    <select id="statusFilter" class="filter-select">
                        <option value="all">All Status</option>
                        <option value="Published">Published</option>
                        <option value="Draft">Draft</option>
                        <option value="Archived">Archived</option>
                    </select>

                    <div class="date-filter-group">
                        <input type="date" id="startDate" class="date-input" aria-label="Start date">
                        <span class="date-separator">to</span>
                        <input type="date" id="endDate" class="date-input" aria-label="End date">
                    </div>

                    <button class="icon-btn" id="resetFilterBtn" type="button" title="Reset Filters">
                        <i class="fa-solid fa-rotate-left"></i>
                    </button>
                </div>
            </header>

            <main class="page-content">
                <section class="heading-row">
                    <div>
                        <h1>Articles</h1>
                        <p>Create, manage, and explore your articles</p>
                    </div>

                    <a href="{{ url('/tulisartikelExpert') }}" class="new-article-btn">
                        <i class="fa-solid fa-plus"></i>
                        New Article
                    </a>
                </section>

                <div class="divider"></div>

                <section class="meta-row">
                    <p id="resultsCount">Showing 0 articles</p>
                    <div class="pagination" id="pagination"></div>
                </section>

                <section class="article-grid" id="articleGrid">
                    <article class="article-card"
                        data-title="Sustainable Indoor Gardening"
                        data-category="Horticulture"
                        data-status="Published"
                        data-date="2023-10-12">
                        <div class="article-thumb">
                            <img src="https://images.unsplash.com/photo-1512428813834-c702c7702b78?auto=format&fit=crop&w=1200&q=80" alt="Sustainable Indoor Gardening">
                            <span class="article-tag">HORTICULTURE</span>
                        </div>
                        <div class="article-body">
                            <div class="article-meta">
                                Oct 12, 2023 <span>•</span> 8 min read
                            </div>
                            <div class="article-topline">
                                <h3>Sustainable Indoor Gardening</h3>
                                <span class="article-status published">Published</span>
                            </div>
                            <p>Discover the revolutionary methods of maintaining a lush, water-efficient indoor garden in modern living spaces...</p>
                            <a href="#" class="edit-link">Edit Article <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </article>

                    <article class="article-card"
                        data-title="Hydroponic Systems for Beginners"
                        data-category="Tech Integration"
                        data-status="Draft"
                        data-date="2023-10-10">
                        <div class="article-thumb">
                            <img src="https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?auto=format&fit=crop&w=1200&q=80" alt="Hydroponic Systems for Beginners">
                            <span class="article-tag tag-blue">TECH INTEGRATION</span>
                        </div>
                        <div class="article-body">
                            <div class="article-meta">
                                Oct 10, 2023 <span>•</span> 5 min read
                            </div>
                            <div class="article-topline">
                                <h3>Hydroponic Systems for Beginners</h3>
                                <span class="article-status draft">Draft</span>
                            </div>
                            <p>The ultimate guide to setting up your first soil-less growth kit with practical steps for beginners...</p>
                            <a href="#" class="edit-link">Edit Article <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </article>

                    <article class="article-card"
                        data-title="The Future of Urban Farming"
                        data-category="Urban Planning"
                        data-status="Published"
                        data-date="2023-10-08">
                        <div class="article-thumb">
                            <img src="https://images.unsplash.com/photo-1501004318641-b39e6451bec6?auto=format&fit=crop&w=1200&q=80" alt="The Future of Urban Farming">
                            <span class="article-tag tag-green">URBAN PLANNING</span>
                        </div>
                        <div class="article-body">
                            <div class="article-meta">
                                Oct 08, 2023 <span>•</span> 12 min read
                            </div>
                            <div class="article-topline">
                                <h3>The Future of Urban Farming</h3>
                                <span class="article-status published">Published</span>
                            </div>
                            <p>Exploring how smart city infrastructure and innovation are shaping the future of sustainable agriculture...</p>
                            <a href="#" class="edit-link">Edit Article <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </article>

                    <article class="article-card"
                        data-title="Smart Irrigation Tech"
                        data-category="IoT & Sensors"
                        data-status="Published"
                        data-date="2023-10-05">
                        <div class="article-thumb">
                            <img src="https://images.unsplash.com/photo-1523348837708-15d4a09cfac2?auto=format&fit=crop&w=1200&q=80" alt="Smart Irrigation Tech">
                            <span class="article-tag tag-yellow">IOT &amp; SENSORS</span>
                        </div>
                        <div class="article-body">
                            <div class="article-meta">
                                Oct 05, 2023 <span>•</span> 6 min read
                            </div>
                            <div class="article-topline">
                                <h3>Smart Irrigation Tech</h3>
                                <span class="article-status published">Published</span>
                            </div>
                            <p>How low-energy sensors and connected devices are revolutionizing water efficiency in modern agriculture...</p>
                            <a href="#" class="edit-link">Edit Article <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </article>

                    <article class="article-card"
                        data-title="Natural Pest Control"
                        data-category="Organic Care"
                        data-status="Archived"
                        data-date="2023-10-02">
                        <div class="article-thumb">
                            <img src="https://images.unsplash.com/photo-1461354464878-ad92f492a5a0?auto=format&fit=crop&w=1200&q=80" alt="Natural Pest Control">
                            <span class="article-tag tag-lime">ORGANIC CARE</span>
                        </div>
                        <div class="article-body">
                            <div class="article-meta">
                                Oct 02, 2023 <span>•</span> 10 min read
                            </div>
                            <div class="article-topline">
                                <h3>Natural Pest Control</h3>
                                <span class="article-status archived">Archived</span>
                            </div>
                            <p>Avoid chemicals by using safer organic predator-based methods for healthier plants and more sustainable results...</p>
                            <a href="#" class="edit-link">Edit Article <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </article>

                    <article class="article-card"
                        data-title="Seasonal Plant Care"
                        data-category="Education"
                        data-status="Draft"
                        data-date="2023-09-28">
                        <div class="article-thumb">
                            <img src="https://images.unsplash.com/photo-1468327768560-75b778cbb551?auto=format&fit=crop&w=1200&q=80" alt="Seasonal Plant Care">
                            <span class="article-tag tag-pink">EDUCATION</span>
                        </div>
                        <div class="article-body">
                            <div class="article-meta">
                                Sep 28, 2023 <span>•</span> 7 min read
                            </div>
                            <div class="article-topline">
                                <h3>Seasonal Plant Care</h3>
                                <span class="article-status draft">Draft</span>
                            </div>
                            <p>A month-by-month guide to ensuring your plants thrive during changing weather and seasonal transitions...</p>
                            <a href="#" class="edit-link">Edit Article <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </article>
                </section>

                <div class="empty-state" id="emptyState">
                    <i class="fa-regular fa-folder-open"></i>
                    <h3>No articles found</h3>
                    <p>Try changing the search keyword or filter combination.</p>
                </div>
            </main>

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
        </div>
    </div>

    <script src="{{ asset('js/articleExpert.js') }}"></script>
</body>
</html>