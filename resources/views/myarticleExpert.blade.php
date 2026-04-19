<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Articles - Sproutly</title> 
    <link rel="stylesheet" href="{{ asset('css/style-myarticleExpert.css') }}">
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

                    <a href="/myarticleExpert" class="menu-item active">
                        <img src="{{ asset('images/myarticle.png') }}" alt="My Article">
                        <span>My Article</span>
                    </a>

                    <a href="/setpricingexpert" class="menu-item">
                        <img src="{{ asset('images/pricing.png') }}" alt="Pricing">
                        <span>Pricing</span>
                    </a>

                    <a href="/ConsultationhistoryUser" class="menu-item">
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
            <section class="articles-section">
                <div class="articles-header">
                    <div class="articles-header-left">
                        <button type="button" class="toggle-btn" id="sidebarToggle" aria-label="Toggle Sidebar">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>

                        <div>
                            <h1>My Articles</h1>
                            <p>Manage and review your published articles across the platform.</p>
                        </div>
                    </div>

                    <button type="button" class="delete-mode-btn" id="deleteModeBtn" aria-label="Delete Articles">
                        🗑
                    </button>
                </div>

                <div class="selection-bar" id="selectionBar">
                    <span id="selectionText">Select article(s) you want to delete</span>
                    <div class="selection-actions">
                        <button type="button" class="cancel-selection-btn" id="cancelSelectionBtn">Cancel</button>
                        <button type="button" class="delete-selected-btn" id="deleteSelectedBtn">Delete Selected</button>
                    </div>
                </div>

                <div class="articles-grid" id="articlesGrid">
                    <!-- CARD 1 -->
                    <article class="article-card" data-id="1">
                        <button type="button" class="select-circle" aria-label="Select Article"></button>

                        <div class="article-image-wrap">
                            <img src="https://images.unsplash.com/photo-1501004318641-b39e6451bec6" alt="Article Thumbnail">
                        </div>

                        <div class="article-body">
                            <div class="article-meta">
                                <span class="tag tag-green">HYDROPONICS</span>
                                <span class="date">Oct 12, 2023</span>
                            </div>

                            <h3>Optimizing Nutrient Flow for Leafy Greens</h3>
                            <p>Discover the critical balance of nitrogen, phosphorus, and more for healthier crops.</p>

                            <div class="article-footer">
                                <span>1.2k Views</span>
                                <a href="#">Edit Article →</a>
                            </div>
                        </div>
                    </article>

                    <!-- CARD 2 -->
                    <article class="article-card" data-id="2">
                        <button type="button" class="select-circle" aria-label="Select Article"></button>

                        <div class="article-image-wrap">
                            <img src="https://plus.unsplash.com/premium_photo-1664299650802-c61f55b00c96?q=80&w=870&auto=format&fit=crop" alt="Article Thumbnail">
                        </div>

                        <div class="article-body">
                            <div class="article-meta">
                                <span class="tag tag-light-green">SOIL HEALTH</span>
                                <span class="date">Sep 28, 2023</span>
                            </div>

                            <h3>Restoring the Microbiome of Depleted Fields</h3>
                            <p>A deep dive into regenerative farming practices that bring life back to the soil.</p>

                            <div class="article-footer">
                                <span>845 Views</span>
                                <a href="#">Edit Article →</a>
                            </div>
                        </div>
                    </article>

                    <!-- CARD 3 -->
                    <article class="article-card" data-id="3">
                        <button type="button" class="select-circle" aria-label="Select Article"></button>

                        <div class="article-image-wrap">
                            <img src="https://images.unsplash.com/photo-1646237642132-1c74e65d0282?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTZ8fHdpbnRlciUyMHBsYW50fGVufDB8fDB8fHww" alt="Article Thumbnail">
                        </div>

                        <div class="article-body">
                            <div class="article-meta">
                                <span class="tag tag-blue">VERTICAL FARMING</span>
                                <span class="date">Sep 15, 2023</span>
                            </div>

                            <h3>LED Spectrum Tuning for Winter Growth</h3>
                            <p>How adjusting light wavelengths can trick plants into year-round productive cycles.</p>

                            <div class="article-footer">
                                <span>2.4k Views</span>
                                <a href="#">Edit Article →</a>
                            </div>
                        </div>
                    </article>

                    <!-- CARD 4 -->
                    <article class="article-card" data-id="4">
                        <button type="button" class="select-circle" aria-label="Select Article"></button>

                        <div class="article-image-wrap">
                            <img src="https://images.unsplash.com/photo-1740927115720-5e528c435e1a?q=80&w=874&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Article Thumbnail">
                        </div>

                        <div class="article-body">
                            <div class="article-meta">
                                <span class="tag tag-yellow">TECH TOOLS</span>
                                <span class="date">Aug 30, 2023</span>
                            </div>

                            <h3>AI-Driven Pest Detection Systems</h3>
                            <p>Implementing computer vision models to identify early signs of infestation in crops.</p>

                            <div class="article-footer">
                                <span>512 Views</span>
                                <a href="#">Edit Article →</a>
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

    <!-- CONFIRM DELETE MODAL -->
    <div class="modal-overlay" id="confirmDeleteModal">
        <div class="modal-box">
            <div class="modal-icon warning">!</div>
            <h2>Are you sure you want to delete this article?</h2>
            <p>This action cannot be undone.</p>
            <div class="modal-actions">
                <button type="button" class="btn-secondary" id="cancelDeleteBtn">Cancel</button>
                <button type="button" class="btn-danger" id="confirmDeleteBtn">Yes</button>
            </div>
        </div>
    </div>

    <!-- DELETED MODAL -->
    <div class="modal-overlay" id="deletedModal">
        <div class="modal-box">
            <div class="modal-icon success">✓</div>
            <h2>Article deleted</h2>
            <p>The selected article has been removed.</p>
            <button type="button" class="btn-success" id="closeDeletedModalBtn">OK</button>
        </div>
    </div>

    <script src="{{ asset('js/myarticleExpert.js') }}"></script>
</body>
</html>