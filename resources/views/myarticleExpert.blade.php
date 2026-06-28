<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Articles - Sproutly</title> 
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                    @if(isset($artikels) && count($artikels) > 0)
                        @foreach($artikels as $artikel)
                            <article class="article-card" data-id="{{ $artikel->id }}">
                                <button type="button" class="select-circle" aria-label="Select Article"></button>

                                <div class="article-image-wrap">
                                    <img src="{{ $artikel->thumbnail ? (str_starts_with($artikel->thumbnail, 'http') ? $artikel->thumbnail : asset('storage/' . $artikel->thumbnail)) : 'https://images.unsplash.com/photo-1501004318641-b39e6451bec6' }}" alt="Article Thumbnail">
                                </div>

                                <div class="article-body">
                                    <div class="article-meta">
                                        <span class="tag tag-green">{{ strtoupper($artikel->kategori ?? 'HYDROPONICS') }}</span>
                                        <span class="date">{{ \Carbon\Carbon::parse($artikel->tanggal_unggah ?? $artikel->created_at)->format('M d, Y') }}</span>
                                    </div>

                                    <h3>{{ $artikel->judul }}</h3>
                                    <p>{{ Str::limit(strip_tags($artikel->konten), 120) }}</p>

                                    <div class="article-footer">
                                        <span>0 Views</span>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    @else
                        <div class="empty-state" style="grid-column: 1 / -1; text-align: center; padding: 60px 20px;">
                            <h3>No articles yet</h3>
                            <p>Start creating your first article by clicking the "New Article" button.</p>
                            <a href="{{ url('/tulisartikelExpert') }}" class="btn-primary" style="display: inline-block; margin-top: 16px; padding: 12px 24px; background: #76ead0; color: #1a2636; border-radius: 8px; text-decoration: none; font-weight: 600;">
                                + New Article
                            </a>
                        </div>
                    @endif
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