<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Articles - Sproutly</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style-myarticleExpert.css') }}">
</head>
<body>
    <div class="page-wrap">
        <!-- SIDEBAR -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-top">
                <div class="brand-wrap">
                    <div class="brand-logo-box">
                        <img src="{{ asset('images/logo.png') }}" alt="Sproutly Logo">
                    </div>
                    <span class="brand-text">Sproutly</span>
                </div>

                <button class="sidebar-toggle" id="sidebarToggle" type="button" aria-label="Toggle sidebar">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M5 7H19" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
                        <path d="M5 12H19" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
                        <path d="M5 17H19" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
                    </svg>
                </button>
            </div>

            <div class="sidebar-divider"></div>

            <nav class="sidebar-menu">
                <a href="#" class="menu-item">
                    <span class="menu-icon">
                        <img src="{{ asset('images/dashboard.png') }}" alt="Dashboard">
                    </span>
                    <span class="menu-label">Dashboard</span>
                </a>

                <a href="#" class="menu-item">
                    <span class="menu-icon">
                        <img src="{{ asset('images/consultation.png') }}" alt="Consultation">
                    </span>
                    <span class="menu-label">Consultation</span>
                </a>

                <a href="#" class="menu-item">
                    <span class="menu-icon">
                        <img src="{{ asset('images/article.png') }}" alt="Article">
                    </span>
                    <span class="menu-label">Article</span>
                </a>

                <a href="#" class="menu-item active sub-item">
                    <span class="menu-icon">
                        <img src="{{ asset('images/myarticle.png') }}" alt="My Article">
                    </span>
                    <span class="menu-label">My Article</span>
                </a>

                <a href="#" class="menu-item">
                    <span class="menu-icon">
                        <img src="{{ asset('images/pricing.png') }}" alt="Pricing">
                    </span>
                    <span class="menu-label">Pricing</span>
                </a>

                <a href="#" class="menu-item">
                    <span class="menu-icon">
                        <img src="{{ asset('images/clienthistory.png') }}" alt="Client History">
                    </span>
                    <span class="menu-label">Client History</span>
                </a>

                <a href="#" class="menu-item">
                    <span class="menu-icon">
                        <img src="{{ asset('images/settings.png') }}" alt="Setting">
                    </span>
                    <span class="menu-label">Setting</span>
                </a>
            </nav>
        </aside>

        <!-- MAIN -->
        <main class="main-content" id="mainContent">
            <section class="page-section">
                <div class="page-header">
                    <div>
                        <h1>My Articles</h1>
                        <p>Manage and review your published articles across the platform.</p>
                    </div>

                    <button class="top-delete-btn" type="button" aria-label="Delete all">
                        <svg viewBox="0 0 24 24" fill="none">
                            <path d="M9 3H15L16 5H20V7H4V5H8L9 3Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                            <path d="M7 8H17L16 19C15.95 20.1 15.05 21 13.95 21H10.05C8.95 21 8.05 20.1 8 19L7 8Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                            <path d="M10 11V17" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <path d="M14 11V17" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </button>
                </div>

                <section class="article-grid">
                    <!-- CARD 1 -->
                    <article class="article-card">
                        <div class="article-image-wrap">
                            <img src="https://plus.unsplash.com/premium_photo-1663045399046-762c27ffe872?q=80&w=870&auto=format&fit=crop" alt="Hydroponics">
                            <button class="card-trash-btn" type="button" aria-label="Delete article">
                                <svg viewBox="0 0 24 24" fill="none">
                                    <path d="M9 3H15L16 5H20V7H4V5H8L9 3Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                                    <path d="M7 8H17L16 19C15.95 20.1 15.05 21 13.95 21H10.05C8.95 21 8.05 20.1 8 19L7 8Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                                    <path d="M10 11V17" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                    <path d="M14 11V17" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                            </button>
                        </div>

                        <div class="article-content">
                            <div class="article-meta-top">
                                <span class="tag tag-teal">HYDROPONICS</span>
                                <span class="article-date">Oct 12, 2023</span>
                            </div>

                            <h3>Optimizing Nutrient Flow for Leafy Greens</h3>
                            <p>Discover the critical balance of nitrogen, phosphorus, and...</p>

                            <div class="article-bottom">
                                <span>1.2k Views</span>
                                <a href="#">Edit Article <span>→</span></a>
                            </div>
                        </div>
                    </article>

                    <!-- CARD 2 -->
                    <article class="article-card">
                        <div class="article-image-wrap">
                            <img src="https://images.unsplash.com/photo-1559660499-41de8b38a6b2?w=600&auto=format&fit=crop&q=60" alt="Soil Health">
                            <button class="card-trash-btn" type="button" aria-label="Delete article">
                                <svg viewBox="0 0 24 24" fill="none">
                                    <path d="M9 3H15L16 5H20V7H4V5H8L9 3Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                                    <path d="M7 8H17L16 19C15.95 20.1 15.05 21 13.95 21H10.05C8.95 21 8.05 20.1 8 19L7 8Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                                    <path d="M10 11V17" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                    <path d="M14 11V17" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                            </button>
                        </div>

                        <div class="article-content">
                            <div class="article-meta-top">
                                <span class="tag tag-green">SOIL HEALTH</span>
                                <span class="article-date">Sep 28, 2023</span>
                            </div>

                            <h3>Restoring the Microbiome of Depleted Fields</h3>
                            <p>A deep dive into regenerative farming practices that bring life...</p>

                            <div class="article-bottom">
                                <span>845 Views</span>
                                <a href="#">Edit Article <span>→</span></a>
                            </div>
                        </div>
                    </article>

                    <!-- CARD 3 -->
                    <article class="article-card">
                        <div class="article-image-wrap">
                            <img src="https://images.unsplash.com/photo-1501004318641-b39e6451bec6?w=800&q=80" alt="Vertical Farming">
                            <button class="card-trash-btn" type="button" aria-label="Delete article">
                                <svg viewBox="0 0 24 24" fill="none">
                                    <path d="M9 3H15L16 5H20V7H4V5H8L9 3Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                                    <path d="M7 8H17L16 19C15.95 20.1 15.05 21 13.95 21H10.05C8.95 21 8.05 20.1 8 19L7 8Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                                    <path d="M10 11V17" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                    <path d="M14 11V17" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                            </button>
                        </div>

                        <div class="article-content">
                            <div class="article-meta-top">
                                <span class="tag tag-blue">VERTICAL FARMING</span>
                                <span class="article-date">Sep 15, 2023</span>
                            </div>

                            <h3>LED Spectrum Tuning for Winter Growth</h3>
                            <p>How adjusting light wavelengths can trick plants into year-round...</p>

                            <div class="article-bottom">
                                <span>2.4k Views</span>
                                <a href="#">Edit Article <span>→</span></a>
                            </div>
                        </div>
                    </article>

                    <!-- CARD 4 -->
                    <article class="article-card">
                        <div class="article-image-wrap">
                            <img src="https://images.unsplash.com/photo-1516253593875-bd7ba052fbc5?w=800&q=80" alt="Tech Tools">
                            <button class="card-trash-btn" type="button" aria-label="Delete article">
                                <svg viewBox="0 0 24 24" fill="none">
                                    <path d="M9 3H15L16 5H20V7H4V5H8L9 3Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                                    <path d="M7 8H17L16 19C15.95 20.1 15.05 21 13.95 21H10.05C8.95 21 8.05 20.1 8 19L7 8Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                                    <path d="M10 11V17" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                    <path d="M14 11V17" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                            </button>
                        </div>

                        <div class="article-content">
                            <div class="article-meta-top">
                                <span class="tag tag-yellow">TECH TOOLS</span>
                                <span class="article-date">Aug 30, 2023</span>
                            </div>

                            <h3>AI-Driven Pest Detection Systems</h3>
                            <p>Implementing computer vision models to identify early signs of..</p>

                            <div class="article-bottom">
                                <span>512 Views</span>
                                <a href="#">Edit Article <span>→</span></a>
                            </div>
                        </div>
                    </article>
                </section>
            </section>

            <!-- FOOTER -->
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

    <script src="{{ asset('js/myarticleExpert.js') }}"></script>
</body>
</html>