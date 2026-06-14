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
                        @foreach($artikels->pluck('kategori')->unique()->filter() as $kat)
                            <option value="{{ ucwords($kat) }}">{{ ucwords($kat) }}</option>
                        @endforeach
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
                    @foreach($artikels as $artikel)
                        @php
                            $authorName = $artikel->ahliBotani->nama_ahli ?? 'Expert';
                            $status = $artikel->status ?? 'Published';
                            $date = \Carbon\Carbon::parse($artikel->tanggal_unggah ?? $artikel->created_at)->format('Y-m-d');
                            $displayDate = \Carbon\Carbon::parse($artikel->tanggal_unggah ?? $artikel->created_at)->format('M d, Y');
                        @endphp
                        <article class="article-card"
                            data-title="{{ $artikel->judul }}"
                            data-category="{{ ucwords($artikel->kategori) }}"
                            data-status="{{ $status }}"
                            data-date="{{ $date }}">
                            <div class="article-thumb">
                                <img src="{{ $artikel->thumbnail ? (str_starts_with($artikel->thumbnail, 'http') ? $artikel->thumbnail : asset('storage/' . $artikel->thumbnail)) : 'https://images.unsplash.com/photo-1501004318641-b39e6451bec6' }}" alt="{{ $artikel->judul }}">
                                <span class="article-tag">{{ strtoupper($artikel->kategori) }}</span>
                            </div>
                            <div class="article-body">
                                <div class="article-meta">
                                    {{ $displayDate }} <span>•</span> 5 min read
                                </div>
                                <div class="article-topline">
                                    <h3>{{ $artikel->judul }}</h3>
                                    @if(strtolower($status) === 'draft')
                                        <span class="article-status draft">Draft</span>
                                    @elseif(strtolower($status) === 'archived')
                                        <span class="article-status archived">Archived</span>
                                    @endif
                                </div>
                                <p>{{ Str::limit(strip_tags($artikel->konten), 120) }}</p>
                            </div>
                        </article>
                    @endforeach
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